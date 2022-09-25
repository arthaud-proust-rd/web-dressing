<x-app-layout>
    <h1 class="h1">Hello, {{ Auth::user()->name }}</h1>
    <div class="mb-6 flex flex-wrap gap-2">
        <form
            method="POST"
            action="{{ route('logout') }}"
        >
            @csrf
            <button class="btn-secondary">
                Se déconnecter
            </button>
        </form>
    </div>
    <h2 class="h2">Mes dressings</h2>
    <div class="flex flex-wrap gap-2">
        <a class="btn-primary" href="{{ route('dressing.create') }}">Créer un dressing</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 my-4">
        @foreach($dressings as $dressing)
            <livewire:dressing.card :dressing="$dressing" />
        @endforeach
    </div>
</x-app-layout>

