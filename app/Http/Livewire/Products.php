<?php

namespace App\Http\Livewire;

use App\Apis\Kroger\Kroger;
use Livewire\Component;

class Products extends Component
{
    public $location_id = "";
    public $location_data = [];
    public $search_query = "";
    public $last_search = "";
    public $current_products = [];
    public $random_display_product = [];
    public $product_image = "";
    public $recently_viewed = [];
    public $start = 1;
    public $limit = 50;

    public function searchProducts() {
        if($this->search_query != "") {
            $this->last_search = $this->search_query;
            $kroger = new Kroger();
            $this->current_products = $kroger->products()->search($this->search_query, $this->location_id, $this->start, $this->limit);
            $this->random_display_product = [];

            if($this->current_products['meta']['pagination']['limit'] >= $this->current_products['meta']['pagination']['total']) {
                $this->start = 1;
            }
            else {
                $this->start = $this->current_products['meta']['pagination']['limit'];
            }

        }
    }

    public function nextItem() {
        $this->random_display_product = [];
        if(count($this->current_products['data']) == 0) {
            $this->searchProducts();
        }
    }

    public function render()
    {
        $this->location_id = session('location_id');
        $this->location_data = session('location_data');

        if(!is_null(session('recently_viewed', null))) {
            $this->recently_viewed = session('recently_viewed');
        }

        if($this->location_id == "" || !is_numeric($this->location_id) ) {
            return redirect('locations');
        }

        //The search field isn't being typed in so do the update item thing.
        if($this->search_query == $this->last_search) {
            if(isset($this->current_products['data']) && count($this->current_products['data']) > 0) {
                $random_key = array_rand($this->current_products['data'], 1);
                $this->random_display_product = $this->current_products['data'][$random_key];

                foreach($this->random_display_product['images'] as $image) {
                    if(isset($image['featured']) && $image['featured']) {
                        foreach($image['sizes'] as $image_size) {
                            if($image_size['size'] == "medium") {
                                $this->product_image = $image_size['url'];
                            }
                        }
                    }
                }

                array_splice($this->current_products['data'], $random_key,1);
                array_unshift($this->recently_viewed, $this->random_display_product);
                session(['recently_viewed' => $this->recently_viewed]);

                if(count($this->recently_viewed) > 20) {
                    array_pop($this->recently_viewed);
                }

            }
        }

        return view('livewire.products');
    }
}
