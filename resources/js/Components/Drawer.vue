<script setup>
const props = defineProps({
    isOpen: {
        type: Boolean,
    },
});

const emit = defineEmits(['close']);

const closeDrawer = () => {
    emit('close');
};
</script>
<template>
    <div v-if="isOpen" class="fixed inset-0 bg-teal-800 opacity-5" @click="closeDrawer"></div>

    <Transition name="drawer">
        <div v-if="isOpen" class="fixed inset-y-0 right-0 z-50 flex flex-col bg-white shadow-lg w-1/2">
            <div class="flex items-center text-[#F7F5F5] justify-between flex-shrink-0 p-2 bg-teal-800">
                <h6 class="p-2 text-lg">
                    <slot name="title" />
                </h6>
                <button @click="closeDrawer"
                    class="p-1 rounded-md text-[#F7F5F5] focus:outline-none focus:ring ring-[#F7F5F5]">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 max-h-full p-4 overflow-auto">
                <slot name="content" />
            </div>
            <div class="flex flex-row justify-end px-6 py-4 bg-[#F7F5F5] text-end">
                <slot name="footer" />
            </div>
        </div>
    </Transition>

</template>
<style scoped>
.drawer-enter-active {
    transition: all 0.5s ease-out;
}

.drawer-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.drawer-enter-from,
.drawer-leave-to {
    transform: translateX(100%);
    opacity: 0;
}
</style>