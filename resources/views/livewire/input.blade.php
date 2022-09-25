<div class="relative">
    <label class="flex flex-col">
        <span>{{ $title  }}</span>
        @if($type==="file")
            <div
                x-data="{ isUploading: false, isUploaded: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false; isUploaded = true; console.log($event)"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
                <input class="hidden" type="{{ $type }}" name="{{ $name }}" wire:model="value">
                <div class="btn-secondary">
                    <span x-show="isUploading"><x-icon.loading class="text-white"  /></span>
                    <span x-show="!isUploaded">Choisir un fichier</span>
                    <span x-show="isUploaded">Choisir un autre fichier</span>
                </div>
            </div>
        @elseif($type==="select")
            <select class="input" name="{{ $name }}">
                @foreach($options as $optKey=>$optValue)
                    <option value="{{ $optValue }}" @if($optValue === $value) selected @endif>
                        {{ $optKey }}
                    </option>
                @endforeach
            </select>
        @elseif($type==="radio-select")
            @if(count($options)>3)
                <div class="grid grid-cols-2 gap-1 bg-neutral-100 rounded-md">
            @else
                <div class="grid grid-flow-col gap-1 bg-neutral-100 rounded-md">
            @endif
                @foreach($options as $optKey=>$optValue)
                    <div>
                        <input @if($optValue === $value) checked @endif class="hidden peer" type="radio" name="{{ $name }}" id="{{$name}}-{{$optValue}}" value="{{$optValue}}">
                        <label class="btn-secondary peer-checked:btn-primary" for="{{$name}}-{{$optValue}}">{{$optKey}}</label>
                    </div>
                @endforeach
            </div>
        @else
            <input class="input" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}">
        @endif
    </label>
    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
