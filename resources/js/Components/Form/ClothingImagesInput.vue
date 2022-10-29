<script>
import {CameraIcon, DocumentPlusIcon, TrashIcon, XMarkIcon} from '@heroicons/vue/24/outline';
import Draggable from 'vuedraggable';
import {v4 as uuid} from 'uuid';
import TakePhoto from "@/Components/TakePhoto.vue";

export default {
    components: {
        Draggable,
        XMarkIcon,
        DocumentPlusIcon,
        CameraIcon,
        TakePhoto,
        TrashIcon,
    },
    props: {
        alreadyUploadedImages: {
            type: Array,
            default: [],
        },
    },
    mounted() {
        this.images = [
            ...this.alreadyUploadedImages.map(img => ({
                id: uuid(),
                uploading: false,
                src: img
            }))
        ];
    },
    data() {
        return {
            images: [],
            isCameraOpen: false,
            uploadForm: this.$inertia.form({
                image: null,
            }),
            deleteForm: this.$inertia.form({
                image_path: null
            }),
        }
    },
    methods: {
        handleTakenPhoto(photo) {
            this.uploadImage(photo);
        },
        async uploadImages(e) {
            e.target.files.forEach(image => this.uploadImage(image));
        },
        async uploadImage(image) {
            const imgId = uuid();

            this.images.push({
                id: imgId,
                uploading: true,
                src: null,
            })

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

            this.images = this.images.filter(img => img.id !== imgId);
            this.images.push({
                id: imgId,
                uploading: false,
                src: response.data
            })
        },
        async deleteImage(imageSrc) {
            const data = {
                image_path: imageSrc
            };

            await axios.post(
                this.route('clothing.images.destroy'),
                data,
                {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                });

            this.images = this.images.filter(img => img.src !== imageSrc);
        },
    },
    computed: {
        allUploadedImagesSrc() {
            return this.images.reduce((a, b) => {
                if (!b.uploading) {
                    a.push(b.src)
                }
                return a;
            }, []);
        }
    },
    watch: {
        images: {
            handler() {
                this.$emit('change:images', this.allUploadedImagesSrc)
            },
            deep: true
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
                    class="flex-shrink-0 relative overflow-hidden rounded-md w-1/3"
                >
                    <div v-if="element.uploading"
                         class="flex flex-row justify-center items-center w-full aspect-3/4 object-cover bg-neutral-100 text-neutral-400 font-semibold">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Envoi...
                    </div>
                    <img
                        v-else
                        class="w-full aspect-3/4 object-cover"
                        :src="'/storage/' + element.src"
                    />
                    <div class="absolute top-0 right-0 flex flex-col gap-2 p-2">
                        <button v-if="!element.uploading  && !element.src.startsWith('test')" type="button"
                                class="btn-icon-danger"
                                @click="deleteImage(element.src)">
                            <TrashIcon class="h-4 w-4"/>
                        </button>
                    </div>
                </div>
            </template>
        </Draggable>
        <input class="hidden" type="file" multiple id="clothing-images" name="clothing-images"
               @change="uploadImages"/>
        <div class="grid grid-cols-2 gap-2" v-show="!isCameraOpen">
            <label class="btn btn-secondary flex-col" for="clothing-images">
                <DocumentPlusIcon class="h-6 w-6"/>
                Depuis les fichiers
            </label>
            <button type="button" class="btn flex-col" :class="isCameraOpen?'btn-primary':'btn-secondary'"
                    @click="isCameraOpen = !isCameraOpen">
                <CameraIcon class="h-6 w-6"/>
                {{ isCameraOpen ? 'Fermer' : 'Ouvrir' }} la caméra
            </button>
        </div>
        <TakePhoto :isOpen="isCameraOpen" @photo:taken="handleTakenPhoto" @close="isCameraOpen=false"/>
    </div>
</template>
