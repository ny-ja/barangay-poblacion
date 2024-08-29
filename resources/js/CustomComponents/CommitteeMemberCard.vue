<script setup>
</script>
<template>
    <div class="p-4 lg:w-1/2">
        <div
            class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
            <slot name="image" />
            <div class="flex-grow sm:pl-8">
                <h2 class="title-font font-medium text-lg text-gray-900">
                    <slot name="name" />
                </h2>
                <h3 class="text-gray-500 mb-3">
                    <slot name="role" />
                </h3>
                <p class="mb-4">
                    <slot name="profile" />
                </p>
                <span class="inline-flex">
                    <slot name="icons" />
                </span>
            </div>
        </div>
    </div>
</template>