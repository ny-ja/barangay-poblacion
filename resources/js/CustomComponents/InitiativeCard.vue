<script setup>
</script>
<template>
    <div class="p-4 md:w-1/3">
        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
            <slot name="image" />
            <div class="p-6">
                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                    <slot name="committee" />
                </h2>
                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                    <slot name="title" />
                </h1>
                <p class="leading-relaxed mb-3">
                    <slot name="description" />
                </p>
            </div>
        </div>
    </div>
</template>