<x-app-layout>
    <h1 class="h1">Créer un dressing</h1>
    <div class="mb-10 flex flex-wrap justify-between">
        <a class="btn-secondary" href="{{ route('dressing.index') }}">Retour aux dressings</a>
    </div>
    <form
        action="{{ route('dressing.store') }}"
        method="post"
        enctype="multipart/form-data"
        class="flex flex-col gap-4"
    >
        @csrf
        @method('POST')

        @if ($errors->any())
            <div class="flex-col gap-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <livewire:input type="text" property="name" title="Nom"/>

        <livewire:input type="select"
                        property="city_id"
                        title="Ville"
                        :options="$cities->pluck('id', 'name')->toArray()"/>

        <input class="btn-primary" type="submit" value="Enregistrer"/>

    </form>
</x-app-layout>

