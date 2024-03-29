<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import Select from "@/Components/Form/Select.vue";
import BackLink from "@/Components/BackLink.vue";

export default {
    components: {
        BackLink,
        Select,
        AuthenticatedLayout,
        Checkbox,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
        Head,
        Link,
    },
    props: {
        dressing: Object,
        cities: Array,
        status: String,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.dressing?.name || '',
                city_id: this.dressing?.city.id || this.cities[0].id,
            }),
        }
    },
    methods: {
        submit() {
            this.isCreating ? this.submitCreate() : this.submitUpdate();
        },
        submitCreate() {
            this.form.post(this.route('dressing.store'))
        },
        submitUpdate() {
            this.form.put(this.route('dressing.update', this.dressing.id))
        },
        submitDelete() {
            this.form.delete(this.route('dressing.destroy', this.dressing.id))
        },
    },
    computed: {
        citiesOptions() {
            return this.cities.map(city => ({
                label: city.name,
                value: city.id
            }))
        },
        isCreating() {
            return !this.dressing
        }
    }
}
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #navigation>
            <BackLink/>

            <button v-if="!isCreating" class="btn text-red-600" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing" @click="submitDelete">
                Supprimer
            </button>
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-3">
            <div>
                <InputLabel for="name" value="Nom"/>
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus/>
                <InputError class="mt-2" :message="form.errors.name"/>
            </div>

            <div>
                <InputLabel for="city_id" value="Ville"/>
                <Select id="city_id" class="mt-1 block w-full" v-model="form.city_id" required
                        :options="citiesOptions"/>
                <InputError class="mt-2" :message="form.errors.city_id"/>
            </div>

            <PrimaryButton class="mt-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Enregistrer
            </PrimaryButton>
        </form>
    </AuthenticatedLayout>
</template>
