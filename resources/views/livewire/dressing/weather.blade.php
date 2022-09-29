<div class="card my-6">
    <h3 class="text-neutral-600 text-md">Météo à {{$dressing->city->name}}</h3>
    <div class="-mt-2 pt-2 -mb-10 pb-10 overflow-auto grid grid-flow-col auto-cols-[100%] snap-x">
        @foreach($dressing->city->daysWeatherForecasts as $dayForecasts)
            <livewire:weather-forecast.day-card :dayForecasts="$dayForecasts"/>
        @endforeach
    </div>
{{--    <a href="#" class="btn-secondary bg-neutral-200">Voir les vêtemens proposés</a>--}}
</div>
