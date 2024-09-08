<script setup>
</script>
<template>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-16 mx-auto flex flex-col">
            <div class="lg:w-4/6 mx-auto">
                <div class="rounded-lg px-4 py-4 h-64 overflow-hidden">
                    <slot name="image" />
                </div>
                <div class="flex flex-col sm:flex-row mt-10">
                    <div class="sm:w-1/3 sm:pr-8 sm:py-8">
                        <div class="flex flex-col justify-start">
                            <h2 class="font-medium title-font text-2xl text-gray-900">
                                <slot name="title" />
                            </h2>
                            <div class="w-full h-1 bg-teal-800 rounded mt-2 mb-4"></div>
                            <p class="leading-relaxed tracking-wider text-lg mb-4">
                                <slot name="date" />
                            </p>
                        </div>
                    </div>
                    <div
                        class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                        <p class="leading-relaxed text-lg mb-4">
                            <slot name="description" />
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>