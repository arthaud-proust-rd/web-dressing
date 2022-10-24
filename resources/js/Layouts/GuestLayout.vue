<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {Link} from '@inertiajs/inertia-vue3';</script>

<template>
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 sm:bg-gray-100">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 stroke-current text-gray-500"/>
            </Link>
        </div>

        <div class="
            w-full sm:max-w-md
            mt-6 px-6 py-6
            bg-white overflow-hidden
            rounded-xl
        ">
            <slot/>
        </div>
    </div>
</template>
