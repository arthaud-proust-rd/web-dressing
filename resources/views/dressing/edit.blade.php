<x-app-layout>
    <h1 class="h1">Modifier le dressing {{ $dressing->name }}</h1>
    <form
        action="{{ route('dressing.destroy', $dressing) }}"
        method="post"
        class="flex flex-col gap-4 mt-4"
    >
        @csrf
        @method('DELETE')
        <input class="btn-danger ml-auto" type="submit" value="Supprimer"/>
    </form>
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

        <livewire:input type="text" name="name" title="Nom" :bind="$dressing"/>

        <input class="btn-primary" type="submit" value="Enregistrer"/>

    </form>
</x-app-layout>

