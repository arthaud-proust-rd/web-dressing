<div class="snap-center flex flex-col">
    <span class="capitalize text-xl">{{ $dayForecasts->first()->date }}</span>
    @foreach($dayForecasts as $hourForecast)
        <div class="flex flex-col">
            <span class="text-neutral-500">à {{ $hourForecast->datetime->hour }}h</span>
            <span>{{ (int)$hourForecast->temp }}°C</span>
            <span>{{ $hourForecast->description }}</span>
        </div>
    @endforeach
</div>
