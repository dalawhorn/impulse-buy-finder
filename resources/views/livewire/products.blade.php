<div class="px-5">
    <h1>Random Product Search</h1>
    <form wire:submit.prevent="searchProducts" class="mb-5">
        <input type="text" name="search_query" wire:model.lazy="search_query" class="border rounded py-1 px-2" />
        <button type="submit" class="rounded bg-blue-500 text-white py-1 px-2">Search</button>
    </form>

    <div>
        @if(count($current_products) == 0)
            @if($search_query == "")
                <div>Please search to begin.</div>
            @endif
        @else
            @if(count($random_display_product) == 0)
                <div>No items found for search.</div>
            @else
                <div class="flex flex-wrap mb-5">
                    <div class="w-full md:w-1/2">
                        <img class="object-center" src="{{ $product_image }}" />
                    </div>
                    <div class="w-full md:w-1/2">
                        <h2>{{ $random_display_product['description'] }}</h2>
                        @if(isset($random_display_product['items'][0]['price']))
                            <div>
                                Price: ${{ ($random_display_product['items'][0]['price']['promo'] != 0)? $random_display_product['items'][0]['price']['promo'] : $random_display_product['items'][0]['price']['regular'] }}
                            </div>
                        @endif
                        <div>
                            Size: {{ $random_display_product['items'][0]['size'] }}
                        </div>
                    </div>

                </div>
                <div>
                    <button wire:click="nextItem" class="rounded bg-blue-500 text-white py-2 px-4">Next Item</button>
                </div>
            @endif
        @endif
    </div>
</div>
