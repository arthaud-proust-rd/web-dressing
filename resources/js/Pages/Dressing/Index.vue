<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import DressingCard from "@/Components/Dressing/DressingCard.vue";

const props = defineProps({
    dressings: {
        type: Object,
    }
});
</script>

<template>
    <Head title="Mes dressings"/>

    <AuthenticatedLayout>
        <template #header>
            <h1 class="h1">Mes dressings</h1>
        </template>

        <div class="flex flex-wrap gap-2">
            <Link class="btn-primary" :href="route('dressing.create')">Créer un dressing</Link>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 my-4">
            <DressingCard
                v-for="dressing of dressings"
                :dressing="dressing"/>
        </div>
    </AuthenticatedLayout>
</template>
