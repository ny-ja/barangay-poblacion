<script setup>
import { ref } from "vue";
import Icon from "@/Components/Icon.vue";

const props = defineProps({
    isSidebarOpen: Boolean,
});

const isDropdownOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};
</script>
<template>
    <div @click="toggleDropdown" class="flex text-white items-center p-2 rounded-md hover:bg-teal-700 cursor-pointer"
        :class="[!isSidebarOpen ? 'justify-center' : 'justify-between']">
        <div class="flex space-x-2">
            <slot name="icon" />

            <span :class="{ 'lg:hidden': !isSidebarOpen }">
                <slot name="text" />
            </span>
        </div>

        <span :class="{ 'lg:hidden': !isSidebarOpen }">
            <Icon name="chevron" />
        </span>
    </div>
    <ul class="border border-teal-500 mt-1 p-2 rounded-lg"
        :class="isDropdownOpen ? 'py-2 space-y-1' : 'hidden py-2 space-y-1'">
        <slot name="nav" />
    </ul>
</template>