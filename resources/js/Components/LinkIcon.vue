<script setup>
import { Link } from '@inertiajs/vue3';</script>
<template>
    <Link
    class="inline-flex items-center space-x-2 px-4 py-2 bg-teal-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <span>
            <slot name="icon" />
        </span>
        <span>
            <slot name="text" />
        </span>
    </Link>
</template>