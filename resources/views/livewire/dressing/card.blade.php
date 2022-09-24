<a class="card" href="{{ route('dressing.show', $dressing->id) }}">
    <h1 class="text-xl">
        {{ $dressing->name }}
    </h1>
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
