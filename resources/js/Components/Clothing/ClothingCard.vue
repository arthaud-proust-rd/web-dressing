<script setup>
import ClothingImage from "@/Components/Clothing/ClothingImage.vue";
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    clothing: Object,
    showActions: {
        type: Boolean,
        default: false
    }
});
</script>
<template>
    <div class="card p-0 gap-0 snap-start">
        <ClothingImage :clothing="clothing"/>
        <Link class="p-4" :href="route('clothing.show', clothing)">
            <span class="text-sm text-gray-400">Noté {{ clothing.note }}/3</span>
            <h4 v-if="clothing.name" class="text-xl">{{ clothing.name }}</h4>
        </Link>
        <div v-if="showActions" class="flex flex-col gap-2 px-2 pb-2">
            <Link class="btn-primary" :href="route('clothing.edit', clothing)">
                Modifier
            </Link>
        </div>
    </div>
</template>
