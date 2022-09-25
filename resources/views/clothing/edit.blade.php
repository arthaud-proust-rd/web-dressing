<x-app-layout>
    <h1 class="h1">Ajouter un vêtement</h1>
    <form
        action="{{ route('clothing.destroy', $clothing) }}"
        method="post"
        class="flex flex-col gap-4 mt-4"
    >
        @csrf
        @method('DELETE')
        <button class="btn-danger ml-auto">
            <x-icon.trash/>
        </button>
    </form>
    <form
        action="{{ route('clothing.update', $clothing) }}"
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

        <livewire:input type="select"
                        name="dressing_id"
                        title="Dressing"
                        :bind="$clothing"
                        :options="$dressings->pluck('id', 'name')->toArray()"/>


        <livewire:input type="text" name="name" title="Nom" :bind="$clothing"/>

        <livewire:input type="select"
                        name="note"
                        title="Note"
                        :bind="$clothing"
                        :options="[0,1,2,3,4,5]"/>

        <livewire:input type="select"
                        name="category"
                        title="Catégorie"
                        :bind="$clothing"
                        :options="$clothingCategories"/>

        <livewire:input type="file" name="image_front" title="Image face" :bind="$clothing"/>
        <livewire:input type="file" name="image_back" title="Image dos" :bind="$clothing"/>

        <input class="btn-primary" type="submit" value="Enregistrer"/>

    </form>
</x-app-layout>

