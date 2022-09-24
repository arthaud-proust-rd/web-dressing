<x-app-layout>
    <h1 class="h1">Mes dressings</h1>
    <div class="mb-6">
        <a class="btn-secondary" href="{{ route('dressing.create') }}">Créer un dressing</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 my-4">
        @foreach($dressings as $dressing)
            <livewire:dressing.card :dressing="$dressing" />
        @endforeach
    </div>
</x-app-layout>

