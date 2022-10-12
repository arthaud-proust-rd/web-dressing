<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import {ChevronLeftIcon} from '@heroicons/vue/24/outline';</script>
<template>
    <Link class="text-gray-400 flex flex-row items-center gap-2 py-2" href="#"
          onclick="history.back();return false;">
        <ChevronLeftIcon class="h-4 w-4"/>
        Retour
    </Link>
</template>
