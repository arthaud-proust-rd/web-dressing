<script>
import ClothingImage from "@/Components/Clothing/ClothingImage.vue";
import {ArrowLeftIcon, ArrowRightIcon} from '@heroicons/vue/24/outline';
import WeatherForecastInfo from "@/Components/WeatherForecastInfo.vue";

export default {
    components: {
        ArrowLeftIcon,
        ArrowRightIcon,
        ClothingImage,
        WeatherForecastInfo,
    },
    props: {
        dressing: Object
    },
    data() {
        return {
            dayIndex: 0,
            clothesSuggestions: []
        }
    },
    mounted() {
        for (let i = 0; i < this.daysWeatherForecasts.length; i++) {
            if (Date.now() < new Date(this.daysWeatherForecasts[i].forecast_dt).getTime()) {
                this.dayIndex = i;
                break;
            }
        }
        this.fetchForecastClothesSuggestions()
    },
    methods: {
        previousDay() {
            this.canPreviousDay && --this.dayIndex;
            this.handleDayChange();
        },
        nextDay() {
            this.canNextDay && ++this.dayIndex;
            this.handleDayChange();
        },
        handleDayChange() {
            this.fetchForecastClothesSuggestions()
        },
        async fetchForecastClothesSuggestions() {
            const res = await axios.get(route('api.dressing.weather-suggestions', {
                'dressing': this.dressing.id,
                'weatherForecast': this.dayWeatherForecast.id
            }));

            this.clothesSuggestions = res.data;
        },
    },
    computed: {
        canPreviousDay() {
            return this.dayIndex > 0
        },
        canNextDay() {
            return this.dayIndex < this.daysWeatherForecasts.length - 1;
        },
        daysWeatherForecasts() {
            // return Object.values(this.dressing.city.days_weather_forecasts)
            return Object.values(this.dressing.city.weather_forecasts);
        },
        dayWeatherForecast() {
            return this.daysWeatherForecasts[this.dayIndex];
        }
    }
}
</script>
<template>
    <div class="card">
        <div class="flex flex-row justify-between items-center">
            <button
                @click="previousDay"
                class="btn-secondary"
                :class="!canPreviousDay&&'opacity-0 pointer-events-none'"
            >
                <ArrowLeftIcon class="h-6 w-6"/>
            </button>
            <div class="flex flex-col items-center">
                <span class="capitalize">{{ dayWeatherForecast.date }}</span>
                <span class="text-neutral-500">{{ dayWeatherForecast.day_part_string }}</span>
            </div>
            <button
                @click="nextDay"
                class="btn-secondary"
                :class="!canNextDay&&'opacity-0 pointer-events-none'"
            >
                <ArrowRightIcon class="h-6 w-6"/>
            </button>
        </div>

        <div class="flex flex-row justify-between">
            <WeatherForecastInfo :forecast="dayWeatherForecast"/>
        </div>

        <span class="mx-auto">Vêtements recommandés</span>
        <div
            class="overflow-auto grid grid-flow-col auto-cols-[30vw] sm:auto-cols-[35vw] md:auto-cols-[20vw] grid-rows-1 gap-4 -mx-4 -mb-10 pb-12 px-3 pb-4 scroll-px-4 snap-x">
            <ClothingImage
                v-for="clothing of clothesSuggestions"
                :clothing="clothing"/>
        </div>
    </div>
</template>
