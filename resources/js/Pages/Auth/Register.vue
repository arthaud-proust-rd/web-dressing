<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register"/>

        <form @submit.prevent="submit" class="flex flex-col gap-5">
            <div>
                <InputLabel for="name" value="Nom"/>
                <TextInput id="name"
                           type="text"
                           placeholder="Dressy Hing"
                           class="mt-1 block w-full"
                           v-model="form.name"
                           required autofocus
                           autocomplete="name"/>
                <InputError class="mt-2" :message="form.errors.name"/>
            </div>

            <div>
                <InputLabel for="email" value="Email"/>
                <TextInput id="email"
                           type="email"
                           placeholder="dressy.hing@webdressing.me"
                           class="mt-1 block w-full"
                           v-model="form.email" required
                           autocomplete="username"/>
                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div>
                <InputLabel for="password" value="Mot de passe"/>
                <TextInput id="password" type="password"
                           class="mt-1 block w-full" v-model="form.password" required
                           autocomplete="new-password"/>
                <InputError class="mt-2" :message="form.errors.password"/>
            </div>

            <div>
                <InputLabel for="password_confirmation" value="Confirmer le mot de passe"/>
                <TextInput id="password_confirmation"
                           type="password"
                           class="mt-1 block w-full"
                           v-model="form.password_confirmation"
                           required autocomplete="new-password"/>
                <InputError class="mt-2" :message="form.errors.password_confirmation"/>
            </div>

            <div class="flex flex-col gap-2">
                <button class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Créer un compte
                </button>

                <Link class="btn btn-tertiary" :href="route('login')">
                    J'ai déjà un compte
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
