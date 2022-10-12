<script>
import {ListBulletIcon, Squares2X2Icon} from '@heroicons/vue/24/outline';

export default {
    components: {
        ListBulletIcon,
        Squares2X2Icon,
    },
    props: {
        forecast: Object,
    },
    data() {
        return {
            view: 'list',
            orderBy: 'note:desc'
        }
    },
    computed: {
        weatherImageSrc() {
            return '/img/' + (this.forecast.is_rainy ? 'rainy' : 'dry') + '.png'
        },
        temperatureImageSrc() {
            return '/img/' + (this.forecast.is_cold ? 'cold' : 'hot') + '.png'
        },
        temperature() {
            return Math.round(this.forecast.temp * 10) / 10
        },
        temperatureMin() {
            return Math.floor(this.forecast.temp_min * 10) / 10
        },
        temperatureMax() {
            return Math.ceil(this.forecast.temp_max * 10) / 10
        },
    }
}
</script>
<template>
    <div class="my-8 w-full grid grid-cols-3 items-center justify-items-center">
        <img class="h-16" :src="weatherImageSrc">
        <img class="h-16" :src="temperatureImageSrc">
        <div class="flex flex-col items-center">
            <span class="text-3xl">{{ temperature }}°C</span>
            <!--            <span class="text-sky-500">{{ temperatureMin }}°C</span>-->
            <!--            <span class="text-orange-500">{{ temperatureMax }}°C</span>-->
        </div>
    </div>
</template>
