<script>
export default {
    props: {
        clothing: Object,
    },
    data() {
        return {
            displayImageIndex: 0
        }
    },
    methods: {
        nextImage() {
            if (!this.clothing.images) {
                return
            }

            if (this.displayImageIndex + 1 === this.clothing.images.length) {
                this.displayImageIndex = 0;
            } else {
                this.displayImageIndex++;
            }
        }
    }
}
</script>
<template>
    <div class="relative rounded-xl overflow-hidden flex flex-row">
        <div class="w-full" @click="nextImage">
            <template v-if="clothing.images">
                <img
                    v-for="(image, index) of clothing.images"
                    :key="index"
                    v-show="index===displayImageIndex"
                    class="w-full aspect-3/4 object-cover"
                    :src="'/storage/'+image"
                />
            </template>
            <template v-else>
                <div class="w-full aspect-3/4 select-none bg-gray-200 text-gray-400 flex items-center justify-center">
                    Image
                </div>
            </template>
        </div>
        <div class="absolute bottom-0 left-O w-full flex flex-row items-center justify-center gap-2 p-2">
            <div
                v-for="(image, index) of clothing.images"
                class="h-2 rounded-full bg-opacity-30"
                :class="index===displayImageIndex?'w-4 bg-neutral-600':'w-2 bg-neutral-600'"
            >
            </div>
        </div>
        <div class="absolute top-0 right-0 flex flex-col gap-2 p-2">
            <slot name="actions"></slot>
        </div>
    </div>
</template>
