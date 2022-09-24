<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-4">
        <div class="m-4">
            <livewire:clothing.image :clothing="$clothing" />
        </div>
        <div class="flex flex-col">
            <a class="text-gray-400 mb-5" href="{{ route('dressing.show', $clothing->dressing) }}">Retour au dressing {{ $clothing->dressing->name }}</a>
            <h1 class="text-2xl">{{ $clothing->name }}</h1>
            <span class="text-gray-400">Noté {{ $clothing->note }}/5</span>
        </div>
    </div>
</x-app-layout>
