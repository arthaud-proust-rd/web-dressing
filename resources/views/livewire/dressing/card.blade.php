<div class="card">
    <div class="grid auto-cols-fr grid-flow-col gap-1">
        @foreach($dressing->clothes()->take(3)->get() as $clothing)
            <livewire:clothing.image :clothing="$clothing"/>
        @endforeach
    </div>
    <a class="flex flex-col gap-2" href="{{ route('dressing.show', $dressing->id) }}">
        <h3 class="text-2xl -mb-3">
            {{ $dressing->name }}
        </h3>
        <span class="text-neutral-400">{{ $dressing->clothes->count() }} Vêtements</span>
        <ul class="flex flex-col">
            @foreach( $dressing->clothesCategoriesStats as $category)
                @if($category['count']>0)
                <li
                    @if($category['class']===\App\Enums\ClothingCategory::ToCategorize)
                        class="text-amber-500"
                    @else
                        class="text-neutral-600"
                    @endif
                >
                    {{ $category['count'] }} {{ $category['class']->toString() }}
                </li>
                @endif
            @endforeach
        </ul>
    </a>
</div>
