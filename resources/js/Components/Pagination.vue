<template>
    <div class="mt-4 flex justify-between">
        <Link
            v-if="pagination.prev_page_url"
            :href="pagination.prev_page_url"
            class="text-white px-4 py-2 bg-teal-600 rounded shadow-md hover:bg-teal-700 transition-colors"
        >
            &lt;&lt; Previous
        </Link>
        <Link
            v-if="pagination.next_page_url"
            :href="pagination.next_page_url"
            class="text-white px-4 py-2 bg-teal-600 rounded shadow-md hover:bg-teal-700 transition-colors"
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
