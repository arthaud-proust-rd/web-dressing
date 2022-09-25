<x-app-layout>
    <h1 class="h1">Ajouter un vêtement</h1>
    <div class="mb-10 flex flex-wrap justify-between">
        @if($selectedDressing->id)
            <a class="btn-secondary" href="{{ route('dressing.show', $selectedDressing) }}">Retour au dressing</a>
        @else
            <a class="btn-secondary" href="{{ route('dressing.index') }}">Retour aux dressings</a>
        @endif
    </div>
    <form
        action="{{ route('clothing.store') }}"
        method="post"
        enctype="multipart/form-data"
        class="flex flex-col gap-6"
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

        <livewire:input type="radio-select"
                        name="dressing_id"
                        title="Dressing"
                        :value="$selectedDressing->id"
                        :options="$dressings->pluck('id', 'name')->toArray()"/>

        <livewire:input type="file" name="image_front" title="Image face"/>
        <livewire:input type="file" name="image_back" title="Image dos"/>

        <livewire:input type="radio-select"
                        name="category"
                        title="Catégorie"
                        :value="0"
                        :options="$clothingCategories"/>

        <livewire:input type="radio-select"
                        name="note"
                        title="Note"
                        :value="2"
                        :options="['1'=>1,'2'=>2,'3'=>3]"/>

{{--        <livewire:input type="text" name="name" title="Nom"/>--}}




        <input class="btn-primary mt-6" type="submit" value="Enregistrer"/>

    </form>
</x-app-layout>

