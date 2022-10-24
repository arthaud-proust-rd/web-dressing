<script setup>
import {computed} from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Vérification de l'email"/>

        <form @submit.prevent="submit" class="flex flex-col gap-5">

            <p class="text-neutral-600">
                Merci de vous être inscrit! Pouvez-vous confirmer votre adresse mail avant de continuer? Nous vous avons
                envoyé un mail, il suffit de cliquer sur le lien qu'il contient.
            </p>

            <p class="font-medium text-green-600" v-if="verificationLinkSent">
                Un nouveau lien vous a été renvoyé à l'adresse que vous avez fourni lors de votre inscription.
            </p>

            <div class="flex flex-col gap-2">
                <button class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Renvoyer un lien
                </button>

                <Link :href="route('logout')" method="post" as="button" class="btn btn-tertiary">Se déconnecter</Link>
            </div>
        </form>
    </GuestLayout>
</template>
