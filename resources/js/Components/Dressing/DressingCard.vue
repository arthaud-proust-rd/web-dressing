<script setup>
import ClothingImage from "@/Components/Clothing/ClothingImage.vue";
import {Link} from '@inertiajs/inertia-vue3';
import {ChevronRightIcon} from "@heroicons/vue/24/outline";

defineProps({
    dressing: Object
})
</script>
<template>
    <div class="card gap-0 pb-0">
        <div class="position-relative overflow-x-auto flex flex-row gap-2">
            <div class="w-2/5 flex-shrink-0" v-for="clothing of dressing.clothes">
                <ClothingImage
                    :clothing="clothing"/>
            </div>
        </div>
        <Link
            class="flex flex-row justify-between gap-2 pr-4 py-6 rounded-md"
            :href="route('dressing.show', dressing)"
        >
            <div class="flex flex-col">
                <h3 class="text-2xl">
                    {{ dressing.name }}
                </h3>
                <div class="flex flex-row gap-1 text-neutral-400">
                    <span>{{ dressing.clothes.length }} Vêtements</span>
                    <span>-</span>
                    <span>{{ dressing.city.name }}</span>
                </div>
            </div>

            <div class="flex flex-row justify-center items-center gap-2 rounded-md text-neutral-600">
                <ChevronRightIcon class="h-6 w-6"/>
            </div>
            <!--            <ul class="flex flex-col">-->
            <!--                <template v-for="category of dressing.clothes_categories_stats">-->
            <!--                    <li v-if="category.count > 0" class="text-neutral-600">-->
            <!--                        {{ category.count }} {{ category.name }}-->
            <!--                    </li>-->
            <!--                </template>-->
            <!--            </ul>-->
        </Link>
    </div>
</template>
