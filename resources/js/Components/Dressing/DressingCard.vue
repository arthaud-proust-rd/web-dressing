<script setup>
import ClothingImage from "@/Components/Clothing/ClothingImage.vue";
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
  dressing: Object
})
</script>
<template>
    <div class="card">
        <div class="grid auto-cols-fr grid-flow-col gap-1">
            <ClothingImage
                v-for="clothing of dressing.clothes.slice(-3)"
                :clothing="clothing"/>
        </div>
        <Link class="flex flex-col gap-2" :href="route('dressing.show', dressing)">
            <h3 class="text-2xl -mb-3">
                {{ dressing.name }}
            </h3>
            <div class="flex flex-row gap-1 text-neutral-400">
                <span>{{ dressing.clothes.length }} Vêtements</span>
                <span>-</span>
                <span>{{ dressing.city.name }}</span>
            </div>
            <ul class="flex flex-col">
                <template v-for="category of dressing.clothes_categories_stats">
                    <li v-if="category.count > 0" class="text-neutral-600">
                        {{ category.count }} {{ category.name }}
                    </li>
                </template>
            </ul>
        </Link>
    </div>
</template>
