<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';

const props = defineProps({});
</script>

<template>
    <Head title="Mon profil"/>

    <AuthenticatedLayout>
        <template #header>
            <h1 class="h1">Mon profil</h1>
        </template>

        <div class="flex flex-col items-start gap-2">
            <span>{{ $page.props.auth.user.name }}</span>
            <span>{{ $page.props.auth.user.email }}</span>
            <Link :href="route('logout')" method="post" as="button" class="btn btn-secondary">
                Se déconnecter
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
