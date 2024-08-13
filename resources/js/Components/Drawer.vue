<script setup>
const emit = defineEmits(['close']);

defineProps({
    isOpen: Boolean,
});

const closeDrawer = () => {
    emit('close');
};
</script>

<template>
    <div v-if="isOpen" class="relative overflow-hidden">
        <div @click="closeDrawer" class="fixed inset-0 bg-black opacity-50 z-40"></div>

        <div class="fixed inset-y-0 right-0 z-50 flex flex-col bg-white shadow-lg w-[50vw]">
            <div class="flex items-center justify-between flex-shrink-0 p-2">
                <slot name="title" />
                <button @click="closeDrawer" class="p-2 rounded-md focus:outline-none focus:ring">
                    <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 max-h-full p-4">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
