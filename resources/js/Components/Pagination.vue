<template>
    <div class="mt-4 flex justify-between">
        <Link
            v-if="pagination.prev_page_url"
            :href="pagination.prev_page_url"
            class="text-gray-800 px-3 py-2 bg-gray-300 rounded shadow-md"
        >
            &lt;&lt; Previous
        </Link>
        <Link
            v-if="pagination.next_page_url"
            :href="pagination.next_page_url"
            class="text-gray-800 px-3 py-2 bg-gray-300 rounded shadow-md"
        >
            Next &gt;&gt;
        </Link>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    pagination: Object
});
</script>
