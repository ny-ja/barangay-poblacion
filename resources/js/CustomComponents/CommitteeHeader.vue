<script setup>
import Icon from '@/Components/Icon.vue';
</script>
<template>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="px-5 py-16 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap flex-row-reverse">
                <slot name="image" />
                <div class="lg:w-1/2 w-full lg:pr-24 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">
                        <slot name="welcome" />
                    </h1>
                    <div class="flex mb-4">
                        <span class="flex py-2 space-x-2">
                            <div class="flex flex-row space-x-1 items-center">
                                <Icon name="mobile" :classes="'size-4'" :fill="'#115e59'" /><a href="#"
                                    class="text-sm text-gray-900 hover:underline">
                                    <slot name="contact" />
                                </a>
                            </div>
                        </span>
                    </div>
                    <p class="leading-relaxed pb-5 border-b-2 border-gray-100 mb-5">
                        <slot name="profile" />
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>