<script >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Select from "@/Components/Form/Select.vue";
import vueFilePond, { setOptions } from "vue-filepond";
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
            this.form.put(this.route('clothing.update',this.clothing))
        },
        submitDelete() {
            this.form.delete(this.route('clothing.destroy', this.clothing.id))
        },
    },
    computed: {
        dressingsOptions() {
            return this.dressings.map(city=>({
                label: city.name,
                value: city.id
            }))
        },
        isCreating() {
            return !this.clothing
        }
    }
}
</script>

<template>
    <Head :title="isCreating ? 'Ajouter un vêtement' : 'Modifier un vêtement'" />

    <AuthenticatedLayout>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="flex items-center justify-between mt-4">
            <template v-if="isCreating">
                <Link class="text-gray-400 mb-3" href="#" onclick="history.back();return false;">Retour</Link>
            </template>
            <template v-else>
                <Link class="text-gray-400 mb-3" :href="route('dressing.show', {dressing: clothing.dressing.id})">Retour au dressing</Link>
                <PrimaryButton class="ml-4 btn-danger" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="submitDelete">
                    Supprimer
                </PrimaryButton>
            </template>
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-3">
            <div>
                <InputLabel for="name" value="Nom" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="dressing_id" value="Dressing" />
                <Select id="dressing_id" class="mt-1 block w-full" v-model="form.dressing_id" required :options="dressingsOptions"/>
                <InputError class="mt-2" :message="form.errors.dressing_id" />
            </div>

            <div>
                <InputLabel for="note" value="Note" />
                <Select id="note" class="mt-1 block w-full" v-model="form.note" required :options="dressingsOptions"/>
                <InputError class="mt-2" :message="form.errors.note" />
            </div>

            <div>
                <InputLabel for="category" value="Catégorie" />
                <Select id="category" class="mt-1 block w-full" v-model="form.category" required :options="clothingCategories"/>
                <InputError class="mt-2" :message="form.errors.category" />
            </div>

            <div>
                <InputLabel for="category" value="Image face" />
                <FilePond
                    name="file"
                    accepted-file-types="image/*"
                    @init="handleFPInit"
                    @processfile="handleFPImageFaceProcess"
                    @removefile="handleFPImageFaceRemove"
                />
            </div>

            <div>
                <InputLabel for="category" value="Image dos" />
                <FilePond
                    name="file"
                    accepted-file-types="image/*"
                    @init="handleFPInit"
                    @processfile="handleFPImageBackProcess"
                    @removefile="handleFPImageBackRemove"
                />
            </div>


            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Enregistrer
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
