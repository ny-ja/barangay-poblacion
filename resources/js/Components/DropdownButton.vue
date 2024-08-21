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
    <div @click="toggleDropdown"
        class="flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700 cursor-pointer"
        :class="{ 'justify-center': !isSidebarOpen }">
        <slot name="icon" />

        <span :class="{ 'lg:hidden': !isSidebarOpen }">
            <slot name="text" />
        </span>

        <span :class="{ 'lg:hidden': !isSidebarOpen }">
            <Icon name="chevron" />
        </span>
    </div>
    <ul :class="isDropdownOpen ? 'py-2 space-y-2' : 'hidden py-2 space-y-2'">
        <slot name="nav" />
    </ul>
</template>