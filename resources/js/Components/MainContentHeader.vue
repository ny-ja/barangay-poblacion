<script setup>
</script>
<template>
    <div
        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold whitespace-nowrap">
            <slot name="title" />
        </h1>
        <slot name="buttons" />
    </div>
</template>