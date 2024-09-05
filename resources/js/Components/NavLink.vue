<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center h-full px-1 pt-1 border-b-2 border-teal-500 text-md font-medium leading-5 bg-teal-100 text-teal-500 focus:outline-none focus:border-teal-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center h-full px-1 pt-1 border-b-2 border-transparent text-md font-medium leading-5 text-white hover:text-teal-500 hover:bg-teal-100 hover:border-teal-500 focus:outline-none focus:text-teal-500 focus:bg-teal-100 focus:border-teal-500 transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
