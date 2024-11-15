<script setup>
</script>
<template>
    <section class="text-gray-600 body-font bg-teal-800">
        <div class="px-5 py-16 mx-auto">
            <slot name="header" />

            <div class="flex flex-wrap -m-4">
                <slot name="cards" />
            </div>

        </div>
    </section>
</template>