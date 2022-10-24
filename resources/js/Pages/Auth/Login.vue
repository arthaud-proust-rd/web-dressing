<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
    env: Object
});

const form = useForm({
    email: props.env.local ? 'user@email.com' : '',
    password: props.env.local ? 'password' : '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-5">
            <div>
                <InputLabel for="email" value="Email"/>
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                           autocomplete="username"/>
                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div>
                <InputLabel for="password" value="Mot de passe"/>
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                           autocomplete="current-password"/>
                <Link v-if="canResetPassword" :href="route('password.request')"
                      class="text-xs text-neutral-500 hover:text-gray-900">
                    Vous l'avez oublié?
                </Link>
                <InputError class="mt-2" :message="form.errors.password"/>
            </div>

            <!--            <div class="block mt-4">-->
            <!--                <label class="flex items-center">-->
            <!--                    <Checkbox name="remember" v-model:checked="form.remember"/>-->
            <!--                    <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>-->
            <!--                </label>-->
            <!--            </div>-->

            <div class="flex flex-col gap-2">
                <button class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Se connecter
                </button>

                <Link class="btn btn-tertiary" :class="{ 'opacity-25': form.processing }" :href="route('register')">
                    Je n'ai pas de compte
                </Link>
            </div>


        </form>
    </GuestLayout>
</template>
