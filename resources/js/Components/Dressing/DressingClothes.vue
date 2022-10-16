<script>
import {CloudIcon, ListBulletIcon, Squares2X2Icon} from '@heroicons/vue/24/outline';
import ClothingImage from "@/Components/Clothing/ClothingImage.vue";
import ClothingCard from "@/Components/Clothing/ClothingCard.vue";
import DressingWeatherSuggestions from "@/Components/Dressing/DressingWeatherSuggestions.vue";
import ClothingAddCard from "@/Components/Clothing/ClothingAddInCategoryCard.vue";

export default {
    components: {
        ClothingAddCard,
        ListBulletIcon,
        Squares2X2Icon,
        CloudIcon,
        ClothingImage,
        ClothingCard,
        DressingWeatherSuggestions,
    },
    props: {
        dressing: Object,
        categories: Object
    },
    data() {
        return {
            view: 'list',
            orderBy: 'note:desc',
            showWeather: true,
        }
    },
    methods: {
        clothesOfCategory(categoryInt) {
            return this.orderedClothes(
                this.dressing.clothes.filter(clothing => parseInt(clothing.category) === categoryInt)
            )
        },
        orderedClothes(clothes = this.dressing.clothes) {
            return clothes.sort((a, b) => {
                if (this.orderBy === 'note:desc') {
                    return Date.parse(a.created_at) - Date.parse(b.created_at);
                }
                if (this.orderBy === 'note:asc') {
                    return Date.parse(b.created_at) - Date.parse(a.created_at);
                }
                if (this.orderBy === 'note:desc') {
                    return a.note - b.note;
                }
                if (this.orderBy === 'note:asc') {
                    return b.note - a.note;
                }
            })
        }
    }
}
</script>
<template>
    <div class="mb-4 flex flex-row flex-wrap gap-2">
        <div class="flex flex-row bg-neutral-100 rounded-md">
            <button :class="view==='list' ? 'btn-primary' : 'btn-secondary'" @click="view='list'">
                <ListBulletIcon class="h-6 w-6"/>
            </button>
            <button :class="view==='grid' ? 'btn-primary' : 'btn-secondary'" @click="view='grid'">
                <Squares2X2Icon class="h-6 w-6"/>
            </button>
        </div>
        <button :class="showWeather ? 'btn-primary' : 'btn-secondary'" @click="showWeather=!showWeather">
            <CloudIcon class="h-6 w-6"/>
        </button>
        <select v-if="false" v-model="orderBy" class="btn-secondary pr-8 border-0" id="">
            <option value="note:asc">Note - à +</option>
            <option value="note:desc">Note + à -</option>
            <option value="created_at:asc">Date - à +</option>
            <option value="created_at:desc">Date + à -</option>
        </select>
    </div>

    <DressingWeatherSuggestions v-show="showWeather" :dressing="dressing"/>
    <!--    <livewire:dressing.weather-suggestions :dressing="$dressing" />-->

    <div v-if="view==='grid'" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 my-6">
        <ClothingCard
            v-for="clothing of this.dressing.clothes"
            :clothing="clothing"
            :key="Date.now() + clothing.id"/>
    </div>
    <template v-else v-for="[categoryName, categoryInt] of Object.entries(categories)">
        <div class="mt-6" v-if="clothesOfCategory(categoryInt).length">
            <h2 class="h2">{{ categoryName }}</h2>
            <div
                class="overflow-auto grid grid-flow-col auto-cols-[40vw] sm:auto-cols-[35vw] md:auto-cols-[20vw] grid-rows-1 gap-4 -mx-3 my-4 px-3 pb-4 scroll-px-4 snap-x">
                <ClothingCard
                    v-for="clothing of clothesOfCategory(categoryInt)"
                    :clothing="clothing"
                    :showActions="categoryInt===0"
                    :key="Date.now() + clothing.id"
                />
                <ClothingAddCard
                    :dressing="dressing"
                    :category="categoryInt"
                />
            </div>
        </div>
    </template>
</template>
