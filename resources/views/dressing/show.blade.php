<x-app-layout>
    <a class="text-gray-400 mb-3" href="{{ route('dressing.index') }}">Retour à la liste des dressings</a>
    <h1 class="h1">Dressing {{ $dressing->name }}</h1>
    <div class="mb-6">
        <a class="btn-primary" href="{{ route('clothing.create') }}">Ajouter un vêtement</a>
    </div>
    <livewire:dressing.clothes :dressing="$dressing" />
</x-app-layout>

