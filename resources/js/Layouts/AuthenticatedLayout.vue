<script setup>
import BottomNav from "@/Components/BottomNav.vue";


defineProps({
    withback: {
        default: false
    },
    bottomNav: {
        default: true
    }
})
</script>
<template>
    <div>
        <nav class="z-50 bg-neutral-50 fixed bottom-0 w-full" v-if="$slots.bottomNavigation">
            <slot name="bottomNavigation"/>
        </nav>
        <BottomNav v-else-if="bottomNav"/>

        <div class="bg-neutral-50 min-h-screen container mx-auto py-4 px-3 flex flex-col pb-24">
            <nav class="flex justify-between items-center pb-2" v-if="$slots.navigation">
                <slot name="navigation"/>
            </nav>

            <!-- Page Heading -->
            <header class="" v-if="$slots.header">
                <slot name="header"/>
            </header>

            <!-- Page Content -->
            <main class="h-max flex-grow">
                <slot/>
            </main>

        </div>
    </div>
</template>
