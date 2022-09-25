<x-app-layout>
    <h1 class="h1">Éditer un vêtement</h1>
    <div class="mb-10 flex flex-wrap justify-between">
        <a href="{{ route('dressing.show', $clothing->dressing) }}" class="btn-secondary">Retour au dressing</a>
        <form
            action="{{ route('clothing.destroy', $clothing) }}"
            method="post"
            class="flex flex-col gap-4 "
        >
            @csrf
            @method('DELETE')
            <button class="btn-danger ml-auto">
                <x-icon.trash/>
            </button>
        </form>
    </div>
    <form
        action="{{ route('clothing.update', $clothing) }}"
        method="post"
        enctype="multipart/form-data"
        class="flex flex-col gap-6"
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

        <livewire:input type="radio-select"
                        name="dressing_id"
                        title="Dressing"
                        :bind="$clothing"
                        :options="$dressings->pluck('id', 'name')->toArray()"/>

        <livewire:input type="file" name="image_front" title="Image face" :bind="$clothing"/>
        <livewire:input type="file" name="image_back" title="Image dos" :bind="$clothing"/>

        <livewire:input type="radio-select"
                        name="category"
                        title="Catégorie"
                        :bind="$clothing"
                        :options="$clothingCategories"/>

        <livewire:input type="radio-select"
                        name="note"
                        title="Note"
                        :bind="$clothing"
                        :options="['1'=>1,'2'=>2,'3'=>3]"/>

{{--        <livewire:input type="text" name="name" title="Nom" :bind="$clothing"/>--}}

        <input class="btn-primary mt-6" type="submit" value="Enregistrer"/>

    </form>
</x-app-layout>

