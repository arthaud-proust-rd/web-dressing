<script setup >
import { PlusIcon } from '@heroicons/vue/24/outline';
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Clothes from "@/Components/Dressing/DressingClothes.vue";

const props = defineProps({
    dressing: {
        type: Object,
    },
    categories: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <a class="text-gray-400 mb-3" :href="route('dressing.index')">Retour à la liste des dressings</a>
        <h1 class="h1">Dressing {{ dressing.name }}</h1>
        <div class="mb-6 flex flex-wrap gap-2">
            <a class="btn-primary" :href="route('dressing.add-clothing', dressing)">
                <PlusIcon class="h-6 w-6"/>
                Vêtement
            </a>
            <a class="btn-secondary" :href="route('dressing.edit', dressing)">
                Modifier le dressing
            </a>
        </div>
        <Clothes :dressing="dressing" :categories="categories" />
    </AuthenticatedLayout>
</template>
