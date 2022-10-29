<script>
import FullFormLayout from '@/Layouts/FullFormLayout.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CheckboxButton from "@/Components/Form/CheckboxButton.vue";
import ClothingImage from "@/Components/Clothing/ClothingImage.vue";
import {Head, Link} from '@inertiajs/inertia-vue3';
import Select from "@/Components/Form/Select.vue";
import BackLink from "@/Components/BackLink.vue";
import ClothingImagesInput from "@/Components/Form/ClothingImagesInput.vue";
import {ArrowSmallRightIcon} from '@heroicons/vue/24/outline';


export default {
    components: {
        FullFormLayout,
        ClothingImagesInput,
        BackLink,
        ClothingImage,
        CheckboxButton,
        Select,
        Checkbox,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
        Head,
        Link,
        ArrowSmallRightIcon,
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
            step: 0,
            customError: {},
            files: [],
            form: this.$inertia.form({
                dressing_id: this.clothing?.dressing.id || parseInt(this.$page.props.ziggy?.query?.dressing) || this.dressings[0].id,
                name: this.clothing?.name || '',
                note: this.clothing?.note || 1,
                category: this.clothing?.category || parseInt(this.$page.props.ziggy?.query?.category) || this.clothingCategories[0].value,
                images: [],
                weather_options: this.clothing?.weather_options || this.defaultWeatherOptionsForSelectedClothingCategory,
            }),
        }
    },
    mounted() {
        if (!this.form.weather_options) {
            this.form.weather_options = this.defaultWeatherOptionsForSelectedClothingCategory;
        }
    },
    methods: {
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
        handleImagesChange(images) {
            this.form.images = images;
        }
    },
    computed: {
        title() {
            return (this.isCreating ? 'Ajouter' : 'Modifier') + ' un vêtement';
        },
        dressingOptions() {
            return this.dressings.map(city => ({
                label: city.name,
                value: city.id
            }))
        },
        defaultWeatherOptionsForSelectedClothingCategory() {
            const opts = {};
            this.weatherOptions.forEach(opt => opts[opt.value] = true)
            return opts;
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
    <Head :title="title"/>

    <FullFormLayout :bottomNav="false">
        <template #navigation>
            <BackLink text="Annuler" :showIcon="false"/>

            <button v-if="!isCreating" class="btn text-red-600" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing" @click="submitDelete">
                Supprimer
            </button>
        </template>

        <template #bottomNavigation>
            <div class="container p-3 mx-auto flex justify-evenly items-center">
                <button v-if="step===0" class="btn btn-primary w-full" @click="step=1">
                    Étape suivante
                    <ArrowSmallRightIcon class="h-6 w-6"/>
                </button>
                <div v-if="step===1" class="flex flex-row gap-2 w-full">
                    <button class="btn btn-secondary" @click="step=0">
                        Précédent
                    </button>
                    <button class="btn btn-primary flex-grow" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing " @click="submit">
                        {{ this.isCreating ? 'Ajouter' : 'Modifier' }} le vêtement
                    </button>
                </div>
            </div>
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <h2 class="text-xl text-center mt-6">{{ title }}</h2>

        <form @submit.prevent="submit" class="block h-max mt-auto flex flex-col gap-4">
            <div v-if="step===0" class="flex flex-col gap-4">
                <div>
                    <InputLabel for="file" value="Images"/>
                    <div class="flex flex-row w-full gap-2">
                        <div class="flex-1 basis-2/3">
                            <ClothingImagesInput
                                :alreadyUploadedImages="clothing?.images || []"
                                @change:images="handleImagesChange"
                            />
                        </div>
                    </div>
                    <InputError class="mt-2" :message="customError.file"/>
                </div>


            </div>


            <div v-if="step===1" class="flex flex-col gap-4">

                <!--            <div>-->
                <!--                <InputLabel for="name" value="Nom"/>-->
                <!--                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus/>-->
                <!--                <InputError class="mt-2" :message="form.errors.name"/>-->
                <!--            </div>-->


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
                    <InputLabel for="weatherOptions" value="Je mets le vêtement quand il fait..."/>
                    <div class="grid grid-cols-2 gap-2">
                        <CheckboxButton
                            v-for="option of weatherOptions"
                            :key="option.value"
                            :value="option.value"
                            :checked="form.weather_options?.[option.value]"
                            @update:checked="value=>form.weather_options[option.value]=value"
                            :label="option.label"
                        >
                            <img class="h-8 pr-2" :src="'/img/' + option.value + '.png'">
                        </CheckboxButton>
                    </div>
                </div>
            </div>
        </form>
    </FullFormLayout>
</template>
