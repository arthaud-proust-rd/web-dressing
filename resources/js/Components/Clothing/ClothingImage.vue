<script>
export default {
    props: {
        clothing: Object,
    },
    data() {
        return {
            displayImage: 'front'
        }
    },
    methods: {
        toggleImage() {
            this.displayImage = this.displayImage === 'front' ? 'back' : 'front'
        }
    }
}
</script>
<template>
    <div class="relative rounded-xl overflow-hidden flex flex-row">
        <div @click="toggleImage">
            <template v-if="clothing.image_front">
                <img v-show="displayImage==='front'" class="w-full aspect-3/4 object-cover"
                     :src="'/storage/'+clothing.image_front">
            </template>
            <template v-else>
                <div v-show="displayImage==='front'"
                     class="w-full aspect-3/4 select-none bg-gray-200 text-gray-400 flex items-center justify-center">
                    Face
                </div>
            </template>

            <template v-if="clothing.image_back">
                <img v-show="displayImage==='back'" class="w-full aspect-3/4 object-cover"
                     :src="'/storage/'+clothing.image_back">
            </template>
            <template v-else>
                <div v-show="displayImage==='back'"
                     class="w-full aspect-3/4 select-none bg-gray-200 text-gray-400 flex items-center justify-center">
                    Dos
                </div>
            </template>
        </div>
        <div class="absolute top-0 right-0 flex flex-col gap-2 p-2">
            <slot name="actions"></slot>
        </div>
    </div>
</template>
