<script setup>
</script>
<template>
    <div class="flex flex-col text-center w-full mb-20">
        <h1 class="text-2xl font-medium title-font mb-4 text-gray-900 tracking-widest">
            Committee Members
        </h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
            <slot name="description" />
        </p>
    </div>
</template>