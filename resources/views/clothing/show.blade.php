<x-app-layout>
    <div class="m-4">
        <livewire:clothing.image :clothing="$clothing" />
    </div>
    <h1 class="text-2xl">{{ $clothing->name }}</h1>
    <h2 class="text-gray-400">Dans le dressing <a class="underline" href="{{ route('dressing.show', $clothing->dressing) }}">{{ $clothing->dressing->name }}</a></h2>
    <span class="text-gray-400">Noté {{ $clothing->note }}/5</span>
</x-app-layout>
