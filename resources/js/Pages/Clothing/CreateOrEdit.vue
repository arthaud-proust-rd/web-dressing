<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CheckboxButton from "@/Components/Form/CheckboxButton.vue";
import ClothingImage from "@/Components/Clothing/ClothingImage.vue";

import {Head, Link} from '@inertiajs/inertia-vue3';
import Select from "@/Components/Form/Select.vue";
import vueFilePond, {setOptions} from "vue-filepond";
import "filepond/dist/filepond.min.css";
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

// Import the plugin styles
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

const FilePond = vueFilePond(
    FilePondPluginImagePreview,
    FilePondPluginFileValidateType,
);

export default {
    components: {
        ClothingImage,
        CheckboxButton,
        Select,
        AuthenticatedLayout,
        Checkbox,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
        Head,
        Link,
        FilePond
    },
    props: {
        clothing: Object,
        dressings: Array,
        clothingCategories: Array,
        clothingWeatherOptions: Array,
        status: String,
    },
    data() {
        return {
            form: this.$inertia.form({
                dressing_id: this.clothing?.dressing.id || this.dressings[0].id,
                name: this.clothing?.name || '',
                note: this.clothing?.note || 1,
                category: this.clothing?.category || this.clothingCategories[0].value,
                image_front: null,
                image_back: null,
                weather_options: this.clothing?.weather_options,
            }),
        }
    },
    methods: {
        handleFPInit() {
            setOptions({
                server: {
                    url: '/filepond/api',
                    process: '/process',
                    revert: '/process',
                    patch: "?patch=",
                    headers: {
                        'X-CSRF-TOKEN': this.$page.props.csrf_token
                    }
                }
            });
        },
        handleFPImageFaceProcess: function (error, file) {
            this.form.image_front = file.serverId;
        },
        handleFPImageFaceRemove: function (error, file) {
            this.form.image_front = null;
        },
        handleFPImageBackProcess: function (error, file) {
            this.form.image_front = file.serverId;
        },
        handleFPImageBackRemove: function (error, file) {
            this.form.image_back = null;
        },
        submit() {
            this.isCreating ? this.submitCreate() : this.submitUpdate();
        },
        submitCreate() {
            this.form.post(this.route('clothing.store'))
        },
        submitUpdate() {
            this.form.put(this.route('clothing.update', this.clothing))
        },
        submitDelete() {
            this.form.delete(this.route('clothing.destroy', this.clothing.id))
        },
        log() {
            console.log('qsd')
        }
    },
    computed: {
        dressingOptions() {
            return this.dressings.map(city => ({
                label: city.name,
                value: city.id
            }))
        },
        noteOptions() {
            return [1, 2, 3].map(i => ({
                label: i,
                value: i
            }))
        },
        weatherOptions() {
            return [
                {label: 'Pluvieux', value: 'rainy'},
                {label: 'Sec', value: 'dry'},
                {label: 'Froid', value: 'cold'},
                {label: 'Chaud', value: 'hot'},
            ]
        },
        isCreating() {
            return !this.clothing
        }
    }
}
</script>

<template>
    <Head :title="isCreating ? 'Ajouter un vêtement' : 'Modifier un vêtement'"/>

    <AuthenticatedLayout>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="flex items-center justify-between mt-4">
            <template v-if="isCreating">
                <Link class="text-gray-400 mb-3" href="#" onclick="history.back();return false;">Retour</Link>
            </template>
            <template v-else>
                <Link class="text-gray-400 mb-3" :href="route('dressing.show', {dressing: clothing.dressing.id})">Retour
                    au dressing
                </Link>
                <PrimaryButton class="ml-4 btn-danger" :class="{ 'opacity-25': form.processing }"
                               :disabled="form.processing" @click="submitDelete">
                    Supprimer
                </PrimaryButton>
            </template>
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-3">
            <div>
                <InputLabel for="name" value="Nom"/>
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus/>
                <InputError class="mt-2" :message="form.errors.name"/>
            </div>

            <div>
                <InputLabel for="dressing_id" value="Dressing"/>
                <Select id="dressing_id" class="mt-1 block w-full" v-model="form.dressing_id" required
                        :options="dressingOptions"/>
                <InputError class="mt-2" :message="form.errors.dressing_id"/>
            </div>

            <div>
                <InputLabel for="note" value="Note"/>
                <Select id="note" class="mt-1 block w-full" v-model="form.note" required :options="noteOptions"/>
                <InputError class="mt-2" :message="form.errors.note"/>
            </div>

            <div>
                <InputLabel for="category" value="Catégorie"/>
                <Select id="category" class="mt-1 block w-full" v-model="form.category" required
                        :options="clothingCategories"/>
                <InputError class="mt-2" :message="form.errors.category"/>
            </div>

            <div>
                <InputLabel for="category" value="Image face"/>
                <div class="flex flex-row w-full gap-2">
                    <div class="flex-1 basis-1/3" v-if="clothing?.image_front && !form.image_front">
                        <img class="rounded-md w-full aspect-3/4 object-cover" :src="'/storage/'+clothing.image_front">
                    </div>
                    <div class="flex-1 basis-2/3">
                        <FilePond
                            :credits="false"
                            name="file"
                            accepted-file-types="image/*"
                            @init="handleFPInit"
                            @processfile="handleFPImageFaceProcess"
                            @removefile="handleFPImageFaceRemove"
                        />
                    </div>
                </div>

            </div>

            <div>
                <InputLabel for="category" value="Image dos"/>
                <div class="flex flex-row w-full gap-2">
                    <div class="flex-1 basis-1/3" v-if="clothing?.image_back && !form.image_back">
                        <img class="rounded-md w-full aspect-3/4 object-cover" :src="'/storage/'+clothing.image_back">
                    </div>
                    <div class="flex-1 basis-2/3">
                        <FilePond
                            :credits="false"
                            name="file"
                            accepted-file-types="image/*"
                            @init="handleFPInit"
                            @processfile="handleFPImageBackProcess"
                            @removefile="handleFPImageBackRemove"
                        />
                    </div>
                </div>
            </div>

            <div>
                <InputLabel for="weatherOptions" value="Image dos"/>
                <CheckboxButton
                    v-for="option of weatherOptions"
                    :key="option.value"
                    :value="option.value"
                    :checked="form.weather_options[option.value]"
                    @update:checked="value=>form.weather_options[option.value]=value"
                    :label="option.label"/>
            </div>


            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Enregistrer
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
