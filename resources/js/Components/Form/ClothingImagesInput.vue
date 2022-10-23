<script>
import {XMarkIcon} from '@heroicons/vue/24/solid';
import Draggable from 'vuedraggable';

export default {
    components: {
        Draggable,
        XMarkIcon
    },
    props: {
        uploadedImages: {
            type: Array,
            default: [],
        },
    },
    mounted() {
        this.images = [
            ...this.uploadedImages
        ];
    },
    data() {
        return {
            images: [],
            uploadForm: this.$inertia.form({
                image: null,
            }),
            deleteForm: this.$inertia.form({
                image_path: null
            }),
        }
    },
    methods: {
        async uploadImages(e) {
            e.target.files.forEach(image => this.uploadImage(image));
        },
        async uploadImage(image) {
            const formData = new FormData();
            formData.set('image', image);

            const response = await axios.post(
                this.route('clothing.images.store'),
                formData,
                {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
            );

            this.images = [
                ...this.images,
                response.data
            ];
        },
        async deleteImage(imagePath) {
            const data = {
                image_path: imagePath
            };

            await axios.post(
                this.route('clothing.images.destroy'),
                data,
                {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                });

            this.images = this.images.filter(img => img !== imagePath);
        }
    },
    watch: {
        images() {
            this.$emit('change:images', this.images)
        }
    }
}
</script>

<template>
    <div class="flex flex-col gap-2">
        <Draggable
            v-model="images"
            item-key="id"
            class="flex flex-row gap-2 w-full overflow-x-auto"
        >
            <template #item="{element}">
                <div
                    class="relative overflow-hidden rounded-md w-1/3"
                >
                    <img
                        class="w-full aspect-3/4 object-cover"
                        :src="'/storage/' + element"
                    />
                    <div class="absolute top-0 right-0 flex flex-col gap-2 p-2">
                        <button v-if="!element.startsWith('test')" type="button" class="btn-icon-danger"
                                @click="deleteImage(element)">
                            <XMarkIcon class="h-4 w-4"/>
                        </button>
                    </div>
                </div>
            </template>
        </Draggable>
        <label class="rounded-md text-center bg-neutral-100 p-3 cursor-pointer select-none" for="clothing-images">
            Ajouter une image
        </label>
        <input class="hidden" type="file" multiple id="clothing-images" name="clothing-images" @change="uploadImages"/>
    </div>
</template>
