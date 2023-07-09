<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import BackLink from "@/Components/BackLink.vue";

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    })
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirmer le mot de passe"/>

        <form @submit.prevent="submit" class="flex flex-col gap-5">
            <BackLink/>

            <p class="text-neutral-600">
                Pour des raisons de sécurité, veuillez confirmer votre mot de passe avant de continuer.
            </p>

            <div>
                <InputLabel for="password" value="Mot de passe"/>
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                           autocomplete="current-password" autofocus/>
                <InputError class="mt-2" :message="form.errors.password"/>
            </div>

            <button class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Continuer
            </button>
        </form>
    </GuestLayout>
</template>
