<?php

namespace App\Http\Livewire;

use App\Apis\Kroger\Kroger;
use Livewire\Component;

class Locations extends Component
{
    public $locations = [];
    public $zip = "";
    public $selected_location_id = "";

    public function locationSearch() {
        $this->validate([
            'zip' => 'required|min:5'
        ]);

        if($this->zip != "") {
            if(strlen($this->zip) >= 5) {
                $kroger = new Kroger();
                $this->locations = $kroger->locations()->list($this->zip);
            }
            else {
                $this->locations = [];
            }
        }
    }

    public function selectLocation($id) {
        if($id != "" && is_numeric($id)) {
            $kroger = new Kroger();
            $location = $kroger->locations()->getById($id);

            if($location !== false && isset($location['data'])) {
                session([
                    'location_id' => $id,
                    'location_data' => $location['data']
                ]);
                return redirect('products');
            }
        }
    }

    public function render()
    {
        return view('livewire.locations');
    }
}
