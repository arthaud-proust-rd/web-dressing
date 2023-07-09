<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import BackLink from "@/Components/BackLink.vue";

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Mot de passe oublié"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-5">
            <BackLink :href="route('login')"/>

            <p class="text-neutral-600">
                Vous avez oublié votre mot de passe? Pas de souci! Nous allons vous envoyer un lien pour le
                réinitialiser
            </p>

            <div>
                <InputLabel for="email" value="Email"/>
                <TextInput id="email"
                           type="email"
                           placeholder="dressy.hing@webdressing.me"
                           class="mt-1 block w-full" v-model="form.email" required autofocus
                           autocomplete="username"/>
                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <button class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Recevoir le lien
            </button>
        </form>
    </GuestLayout>
</template>
