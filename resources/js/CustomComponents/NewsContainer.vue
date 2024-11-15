<script setup>
</script>
<template>
    <section class="text-gray-600 body-font">
        <div class="px-5 py-16 mx-auto">
            <h1 class="title-font sm:text-4xl text-center text-3xl mb-10 font-medium text-gray-900">
                <slot name="title" />
            </h1>
            <div class="flex flex-wrap -m-4">
                <slot name="cards" />
            </div>
            <slot name="pagination" />
        </div>
    </section>
</template>