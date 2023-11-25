<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
});

</script>

<template>
    <nav class="flex items-center space-x-1">
        <template v-for="(link, key) in links" :key="key">
            <Link :href="link.url"
                class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10"
                v-html="link.label">
            </Link>
        </template>
    </nav>
</template>

  