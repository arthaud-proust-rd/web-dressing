<div class="card p-0 gap-0">
    <livewire:clothing.image :clothing="$clothing"/>
    <a class="p-4" href="{{ route('clothing.show', $clothing->id) }}">
        <span class="text-sm text-gray-400">Noté {{ $clothing->note }}/3</span>
        @if($clothing->name)
            <h4 class="text-xl">{{ $clothing->name }}</h4>
        @endif
    </a>
    @if($showActions)
        <div class="lex flex-wrap gap-2">
            <a class="btn-primary" href="{{ route('clothing.edit', $clothing) }}">
                Modifier
            </a>
        </div>
    @endif
</div>
