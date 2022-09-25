<x-app-layout>
    <a class="text-gray-400 mb-3" href="{{ route('dressing.index') }}">Retour à la liste des dressings</a>
    <h1 class="h1">Dressing {{ $dressing->name }}</h1>
    <div class="mb-6 flex flex-wrap gap-2">
        <a class="btn-primary" href="{{ route('dressing.add-clothing', $dressing) }}">
            <x-icon.plus />
            Vêtement
        </a>
        <a class="btn-secondary" href="{{ route('dressing.edit', $dressing) }}">
            Modifier le dressing
        </a>
    </div>
    <livewire:dressing.clothes :dressing="$dressing" :categories="$categories" />
</x-app-layout>

