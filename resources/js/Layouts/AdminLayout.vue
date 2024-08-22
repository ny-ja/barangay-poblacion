<script setup>
import { ref } from "vue";
import { Head, router, Link } from "@inertiajs/vue3";
import Sidebar from "@/Components/Sidebar.vue";

defineProps({
    title: String,
});

const isSidebarOpen = ref(true);
const isNotificationMenuOpen = ref(false);
const isUserMenuOpen = ref(false);

const menus = [isUserMenuOpen, isNotificationMenuOpen];

const onClickAway = () => {
    menus.forEach((menu) => {
        if (menu.value) {
            menu.value = false;
        }
    });
};

const logout = () => {
    router.post(route("logout"));
};
</script>

<template>

    <Head :title="title" />

    <div class="antialiased text-gray-900 bg-white">
        <div class="flex h-screen overflow-y-hidden bg-white">
            <!-- Sidebar -->
            <Sidebar :isSidebarOpen="isSidebarOpen" @close="isSidebarOpen = false" />

            <div class="flex flex-col flex-1 h-full overflow-hidden">
                <header class="flex-shrink-0 border-b">
                    <div class="flex items-center justify-between p-2">
                        <!-- Navbar left -->
                        <div class="flex items-center space-x-3">
                            <span class="text-xl font-semibold tracking-wider uppercase lg:hidden"><img
                                    src="/images/poblacion-logo.svg" class="w-12 h-auto" alt="Barangay Logo" /></span>
                            <button @click="isSidebarOpen = !isSidebarOpen"
                                class="p-2 rounded-md focus:outline-none focus:ring focus:ring-teal-800">
                                <svg class="w-4 h-4 text-gray-600" :class="{
        'transform transition-transform -rotate-180':
            isSidebarOpen,
    }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <!-- Navbar right -->
                        <div class="relative flex items-center space-x-3">
                            <div class="items-center hidden space-x-3 md:flex">
                                <!-- Notification Menu -->
                                <div class="relative">
                                    <!-- red dot -->
                                    <div class="absolute right-0 p-1 bg-red-400 rounded-full animate-ping"></div>
                                    <div class="absolute right-0 p-1 bg-red-400 border rounded-full"></div>
                                    <button @click="
        isNotificationMenuOpen =
        !isNotificationMenuOpen
        " class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring">
                                        <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </button>

                                    <div v-if="isNotificationMenuOpen" v-click-away="onClickAway"
                                        class="absolute z-50 w-48 max-w-md mt-3 transform bg-white rounded-md shadow-lg -translate-x-3/4 min-w-max">
                                        <div class="p-4 font-medium border-b">
                                            <span class="text-gray-800">Notification</span>
                                        </div>
                                        <ul class="flex flex-col p-2 my-2 space-y-1">
                                            <li>
                                                <a href="#"
                                                    class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Link</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Another
                                                    Link</a>
                                            </li>
                                        </ul>
                                        <div
                                            class="flex items-center justify-center p-4 text-blue-700 underline border-t">
                                            <a href="#">See All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Menu -->
                            <div class="relative">
                                <button @click="isUserMenuOpen = !isUserMenuOpen"
                                    class="p-1 bg-gray-200 rounded-full focus:outline-none focus:ring">
                                    <img class="object-cover w-8 h-8 rounded-full" :src="$page.props.auth.user
        .profile_photo_url
        " :alt="$page.props.auth.user
        .name
        " />
                                </button>
                                <!-- green dot -->
                                <div class="absolute right-0 p-1 bg-green-400 rounded-full bottom-3 animate-ping"></div>
                                <div
                                    class="absolute right-0 p-1 bg-green-400 border border-white rounded-full bottom-3">
                                </div>

                                <div v-if="isUserMenuOpen" v-click-away="onClickAway"
                                    class="absolute z-50 w-48 max-w-md mt-3 transform bg-white rounded-md shadow-lg -translate-x-3/4 min-w-max">
                                    <div class="flex flex-col p-4 space-y-1 font-medium border-b">
                                        <span class="text-gray-800">{{ $page.props.auth.user.name }}</span>
                                        <span class="text-sm text-gray-400">{{ $page.props.auth.user.email }}</span>
                                    </div>
                                    <ul class="flex flex-col p-2 space-y-1">
                                        <li class=" hover:bg-teal-100">
                                            <Link :href="route('profile.show')"
                                                class="block px-2 py-1 transition rounded-md">Profile
                                            </Link>
                                        </li>
                                    </ul>
                                    <div class="flex items-center justify-center p-4 border-t">
                                        <form @submit.prevent="logout">
                                            <button class="underline  text-teal-800 hover:text-teal-600" type="submit">
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main content -->
                <main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
