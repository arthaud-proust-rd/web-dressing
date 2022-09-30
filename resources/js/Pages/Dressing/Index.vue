<script setup >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import DressingCard from "@/Components/Dressing/DressingCard.vue";

const props = defineProps({
    dressings: {
        type: Object,
    }
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

        <h2 class="h2">Mes dressings</h2>
        <div class="flex flex-wrap gap-2">
            <a class="btn-primary" href="{{ route('dressing.create') }}">Créer un dressing</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 my-4">
            <DressingCard
                v-for="dressing of dressings"
                :dressing="dressing" />
        </div>
    </AuthenticatedLayout>
</template>
