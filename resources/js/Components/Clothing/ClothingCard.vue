<script setup>
import ClothingImage from "@/Components/Clothing/ClothingImage.vue";
import {Link} from '@inertiajs/inertia-vue3';
import {PencilIcon, StarIcon} from '@heroicons/vue/24/solid';

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
        <ClothingImage :clothing="clothing">
            <template v-slot:actions>
                <Link class="btn-icon" :href="route('clothing.edit', clothing)">
                    <PencilIcon class="h-4 w-4"/>
                </Link>
            </template>
        </ClothingImage>
        <Link class="p-4" :href="route('clothing.show', clothing)">
            <div class="flex flex-row text-amber-600">
                <StarIcon
                    v-for="n in clothing.note"
                    class="h-6 w-6"
                />
            </div>
            <h4 v-if="clothing.name" class="text-xl">{{ clothing.name }}</h4>
        </Link>
        <div v-if="showActions" class="flex flex-col gap-2 px-2 pb-2">
            <Link class="btn-primary" :href="route('clothing.edit', clothing)">
                Modifier
            </Link>
        </div>
    </div>
</template>
