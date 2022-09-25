<div class="rounded-xl overflow-hidden flex flex-row" @click="displayImage = displayImage==='front'?'back':'front'" x-data="{ displayImage: 'front' }">
    @if($clothing->image_front)
        <img x-show="displayImage==='front'" class="w-full aspect-square object-cover" src="{{ asset('storage/'.$clothing->image_front) }}">
    @else
        <div x-show="displayImage==='front'" class="w-full aspect-square select-none bg-gray-200 text-gray-400 flex items-center justify-center">
            Face
        </div>
    @endif

    @if($clothing->image_back)
        <img x-show="displayImage==='back'" class="w-full aspect-square object-cover" src="{{ asset('storage/'.$clothing->image_back) }}">
    @else
        <div x-show="displayImage==='back'" class="w-full aspect-square select-none bg-gray-200 text-gray-400 flex items-center justify-center">
            Dos
        </div>
    @endif
</div>
