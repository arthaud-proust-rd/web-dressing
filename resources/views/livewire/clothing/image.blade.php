<div class="-m-4 mb-2 rounded-xl overflow-hidden flex flex-row" wire:click="toggleDisplayedImage">
    @if($clothing->getImage($displayed_image))
        <img class="w-full aspect-square object-cover" src="{{ asset('storage/'.$clothing->getImage($displayed_image)) }}">
    @else
        <div class="w-full aspect-square select-none bg-gray-200 text-gray-400 flex items-center justify-center">
            {{ $displayed_image }}
        </div>
    @endif
</div>
