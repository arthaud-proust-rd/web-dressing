<div class="card">
    <livewire:clothing.image :clothing="$clothing"/>
    <a href="{{ route('clothing.show', $clothing->id) }}">
        <span class="text-sm text-gray-400">Noté {{ $clothing->note }}/5</span>
        <h4 class="text-xl">
            {{ $clothing->name }}
        </h4>
    </a>
</div>
