<script setup>
</script>
<template>
    <div class="p-4 lg:w-1/2">
        <div
            class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
            <slot name="image" />
            <div class="flex-grow sm:pl-8">
                <h2 class="title-font font-medium text-lg text-white">
                    <slot name="name" />
                </h2>
                <h3 class="text-amber-400 mb-3">
                    <slot name="role" />
                </h3>
                <p class="mb-4 text-gray-400">
                    <slot name="profile" />
                </p>
                <span class="inline-flex text-gray-400">
                    <slot name="icons" />
                </span>
            </div>
        </div>
    </div>
</template>