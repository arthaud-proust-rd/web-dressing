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
                    <span x-show="isUploading"><x-icons.loading class="text-white"  /></span>
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
        @else
            <input class="input" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}">
        @endif
    </label>
    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
