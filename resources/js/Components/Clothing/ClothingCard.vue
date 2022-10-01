<script>
import ClothingImage from "@/Components/Clothing/ClothingImage.vue";
export default {
    components: {
        ClothingImage
    },
    props: {
        clothing: Object,
        showActions: {
            type: Boolean,
            default: false
        }
    }
}
</script>
<template>
    <div class="card p-0 gap-0 snap-start">
        <ClothingImage :clothing="clothing"/>
        <a class="p-4" :href="route('clothing.show', clothing)">
            <span class="text-sm text-gray-400">Noté {{ clothing.note }}/3</span>
            <h4 v-if="clothing.name" class="text-xl">{{ clothing.name }}</h4>
        </a>
        <div v-if="showActions" class="flex flex-col gap-2 px-2 pb-2">
            <a class="btn-primary" href="{{ route('clothing.edit', clothing) }}">
                Modifier
            </a>
        </div>
    </div>
</template>
