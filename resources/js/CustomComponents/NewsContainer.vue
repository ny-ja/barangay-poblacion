<script setup>
</script>
<template>
    <section class="text-gray-600 body-font">
        <div class="px-5 py-16 mx-auto">
            <h1 class="text-2xl w-full border-b mb-12 uppercase">
                Barangay News
            </h1>
            <div class="flex flex-wrap -m-4">
                <slot name="cards" />
            </div>
            <slot name="pagination" />
        </div>
    </section>
</template>