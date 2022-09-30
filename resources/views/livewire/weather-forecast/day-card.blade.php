<div class="snap-start flex flex-col">
    <span class="capitalize text-xl">{{ $dayForecast->first()->date }}</span>
    <div class="flex flex-row gap-2">
        @foreach($dayForecast as $hourForecast)
            <div class="bg-white flex flex-col px-5 py-3 rounded-xl">
                <span class="text-neutral-500">à {{ $hourForecast->datetime->hour }}h</span>
                <span>{{ (int)$hourForecast->temp }}°C</span>
                <span>{{ $hourForecast->description }}</span>
            </div>
        @endforeach
    </div>
</div>
