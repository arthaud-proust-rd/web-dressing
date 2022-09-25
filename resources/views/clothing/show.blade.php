<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-4">
        <livewire:clothing.image :clothing="$clothing" />
        <div class="flex flex-col items-start mt-2">
            <a class="text-gray-400 mb-5" href="{{ route('dressing.show', $clothing->dressing) }}">Retour au dressing {{ $clothing->dressing->name }}</a>
            <h1 class="text-2xl">{{ $clothing->name }}</h1>
            <span class="text-gray-400">Noté {{ $clothing->note }}/5</span>
            <a class="btn-secondary mt-2" href="{{ route('clothing.edit', $clothing) }}">Modifier</a>
        </div>
    </div>
</x-app-layout>
