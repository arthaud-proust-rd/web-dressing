<x-app-layout>
    <h1 class="h1">Modifier le dressing {{ $dressing->name }}</h1>
    <div class="mb-10 flex flex-wrap justify-between">
        <a class="btn-secondary" href="{{ route('dressing.show', $dressing) }}">Retour au dressing</a>
        <form
            action="{{ route('dressing.destroy', $dressing) }}"
            method="post"
            class="flex flex-col gap-4"
        >
            @csrf
            @method('DELETE')
            <button class="btn-danger ml-auto">
                <x-icon.trash/>
            </button>
        </form>
    </div>

    <form
        action="{{ route('dressing.update', $dressing) }}"
        method="post"
        enctype="multipart/form-data"
        class="flex flex-col gap-4"
    >
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <div class="flex-col gap-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <livewire:input type="text" property="name" title="Nom" :bind="$dressing"/>

        <livewire:input type="select"
                        property="city_id"
                        title="Ville"
                        :bind="$dressing"
                        :options="$cities->pluck('id', 'name')->toArray()"/>

        <input class="btn-primary" type="submit" value="Enregistrer"/>

    </form>
</x-app-layout>

