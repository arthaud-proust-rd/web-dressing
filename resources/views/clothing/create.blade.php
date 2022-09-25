<x-app-layout>
    @if($selectedDressing->id)
        <a class="text-gray-400 mb-3" href="{{ route('dressing.show', $selectedDressing) }}">Retour au dressing</a>
    @else
        <a class="text-gray-400 mb-3" href="{{ route('dressing.index') }}">Retour aux dressings</a>
    @endif
    <h1 class="h1">Ajouter un vêtement</h1>
    <form
        action="{{ route('clothing.store') }}"
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

        <livewire:input type="select"
                        name="dressing_id"
                        title="Dressing"
                        :value="$selectedDressing->id"
                        :options="$dressings->pluck('id', 'name')->toArray()"/>


        <livewire:input type="text" name="name" title="Nom"/>

        <livewire:input type="select"
                        name="note"
                        title="Note"
                        :options="[0,1,2,3,4,5]"/>

        <livewire:input type="select"
                        name="category"
                        title="Catégorie"
                        :options="$clothingCategories"/>

        <livewire:input type="file" name="image_front" title="Image face"/>
        <livewire:input type="file" name="image_back" title="Image dos"/>

        <input class="btn-primary" type="submit" value="Enregistrer"/>

    </form>
</x-app-layout>

