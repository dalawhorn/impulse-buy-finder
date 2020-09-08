<div>
    <h1>Location Search</h1>
    <div>
        <input type="text" name="zip" wire:model="zip" wire:keypress.enter="locationSearch" />
        @error('zip')
            <div>{{ $message }}</div>
        @enderror
        <button wire:click="locationSearch">Search</button>
    </div>

{{--    <div>Searched Zip {{ $zip }}</div>--}}
    @isset($locations['data'])
        <ul>
            @foreach($locations['data'] as $location)
                <li>
                    {{ $location['name'] }} - <a href="#" wire:prevent wire:click="selectLocation('{{ $location['locationId'] }}')">Shop this store</a>
                </li>
            @endforeach
        </ul>
    @endisset
</div>
