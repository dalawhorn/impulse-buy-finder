<div class="px-10">
    <h1 class="text-4xl font-bold mb-4">Product Search</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 mb-10">
        <div>
            <form wire:submit.prevent="searchProducts">
                <input type="text" name="search_query" wire:model.lazy="search_query" class="border rounded py-1 px-2" />
                <button type="submit" class="rounded bg-blue-500 text-white py-1 px-2">Search</button>
            </form>
        </div>
        <div>
            <div class="text-sm"><strong>Shopping at:</strong> {{ $location_data['name'] }}</div>
            <a class="text-blue-500 text-sm" href="/locations">Change Store</a>
        </div>
    </div>

    <div>
        @if(count($current_products) == 0)
            @if($search_query == "")
                <div>Please search to begin.</div>
            @endif
        @else
            @if(count($random_display_product) == 0)
                <div>No items found for search.</div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 mb-4">
                    <div class="flex justify-center mb-4">
                        <img src="{{ $product_image }}" />
                    </div>
                    <div>
                        <h2 class="font-bold text-xl mb-4">{{ $random_display_product['description'] }}</h2>
                        @if(isset($random_display_product['items'][0]['price']))
                            <div>
                                <strong>Price:</strong> ${{ ($random_display_product['items'][0]['price']['promo'] != 0)? $random_display_product['items'][0]['price']['promo'] : $random_display_product['items'][0]['price']['regular'] }}
                            </div>
                        @endif
                        <div>
                            <strong>Size:</strong> {{ $random_display_product['items'][0]['size'] }}
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button wire:click="nextItem" class="rounded bg-red-500 text-white text-2xl py-2 px-4">Next Item</button>
                </div>
            @endif
        @endif
    </div>
</div>
