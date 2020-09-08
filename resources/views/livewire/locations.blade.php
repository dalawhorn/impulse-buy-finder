<div class="px-10">
    <h1 class="text-4xl font-bold mb-4">Location Search</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 mb-10">
        <div>
            <input class="border rounded py-1 px-2" type="text" placeholder="Zip Code" name="zip" wire:model="zip" wire:keypress.enter="locationSearch" />
            <button class="rounded bg-blue-500 text-white py-1 px-2" wire:click="locationSearch">Search</button>
            @error('zip')
            <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            Start your search for random impulse buy items by finding a Kroger location to shop at.
        </div>
    </div>

    @isset($locations['data'])
        <ul>
            @foreach($locations['data'] as $location)
                <li>
                    {{ $location['name'] }} - <a class="text-blue-500 underline" href="#" wire:prevent wire:click="selectLocation('{{ $location['locationId'] }}')">Shop this store</a>
                </li>
            @endforeach
        </ul>
    @endisset
</div>
