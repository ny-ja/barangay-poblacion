<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Icon from "@/Components/Icon.vue";

defineProps({
    title: String,
});

const isSidebarOpen = ref(true);

const toggleSidbarMenu = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
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
            <aside
                class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-teal-800 shadow-lg lg:z-auto lg:static lg:shadow-none"
                :class="{
        '-translate-x-full lg:translate-x-0 lg:w-20':
            !isSidebarOpen,
    }">
                <!-- sidebar header -->
                <div class="flex items-center justify-between flex-shrink-0 p-2"
                    :class="{ 'lg:justify-center': !isSidebarOpen }">
                    <span
                        class="flex flex-nowrap p-2 space-x-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
                        <img src="/images/poblacion-logo.svg" class="w-12 h-auto -mt-2" alt="Barangay Logo" /><span
                            class="tracking-tighter leading-none text-white"
                            :class="{ 'lg:hidden': !isSidebarOpen }">Brgy.<br /> Poblacion</span>
                    </span>
                    <button @click="toggleSidbarMenu" class="p-2 rounded-md lg:hidden">
                        <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Sidebar links -->
                <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
                    <ul class="flex flex-col gap-y-1 p-2 overflow-hidden">
                        <li>
                            <Link :href="route('admin.index')"
                                class="flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700" :class="{
        'justify-center': !isSidebarOpen, 'bg-teal-700':
            $page.component === 'Admin/Index'
    }">
                            <Icon name="home" :stroke="'white'" />
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.users.index')"
                                class="flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700" :class="{
        'justify-center': !isSidebarOpen, 'bg-teal-700':
            $page.component === 'Admin/Users/Index'
    }">
                            <Icon name="group" :stroke="'white'" />
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Users</span>
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.news-categories.index')"
                                class="flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700" :class="{
        'justify-center': !isSidebarOpen, 'bg-teal-700':
            $page.component === 'Admin/NewsCategories/Index'
    }">
                            <Icon name="category" :stroke="'white'" />
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">News Categories</span>
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.news.index')"
                                class="flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700" :class="{
        'justify-center': !isSidebarOpen, 'bg-teal-700':
            $page.component === 'Admin/News/Index'
    }">
                            <Icon name="newspaper" :stroke="'white'" />
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">News</span>
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.document-categories.index')"
                                class="flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700" :class="{
        'justify-center': !isSidebarOpen, 'bg-teal-700':
            $page.component === 'Admin/DocumentCategories/Index'
    }">
                            <Icon name="category" :stroke="'white'" />
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Document Categories</span>
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.document-types.index')"
                                class="flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700" :class="{
        'justify-center': !isSidebarOpen, 'bg-teal-700':
            $page.component === 'Admin/DocumentTypes/Index'
    }">
                            <Icon name="category" :stroke="'white'" />
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Document Types</span>
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.documents.index')"
                                class="flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700" :class="{
        'justify-center': !isSidebarOpen, 'bg-teal-700':
            $page.component === 'Admin/Documents/Index'
    }">
                            <Icon name="folder" :stroke="'white'" />
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Documents</span>
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.barangay-officials.index')"
                                class="flex text-white items-center p-2 space-x-2 rounded-md hover:bg-teal-700" :class="{
        'justify-center': !isSidebarOpen, 'bg-teal-700':
            $page.component === 'Admin/BarangayOfficials/Index'
    }">
                            <Icon name="folder" :stroke="'white'" />
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Officials</span>
                            </Link>
                        </li>
                    </ul>
                </nav>
                <!-- Sidebar footer -->
                <div class="flex-shrink-0 p-2 max-h-14">
                    <button
                        class="flex items-center justify-center w-full px-4 py-2 space-x-1 font-medium tracking-wider uppercase bg-gray-100 border rounded-md focus:outline-none focus:ring">
                        <span>
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">
                            Logout
                        </span>
                    </button>
                </div>
            </aside>

            <div class="flex flex-col flex-1 h-full overflow-hidden">
                <header class="flex-shrink-0 border-b">
                    <div class="flex items-center justify-between p-2">
                        <!-- Navbar left -->
                        <div class="flex items-center space-x-3">
                            <span class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden"><img
                                    src="/images/poblacion-logo.svg" class="w-12 h-auto -mt-2"
                                    alt="Barangay Logo" /></span>
                            <!-- Toggle sidebar button -->
                            <button @click="toggleSidbarMenu" class="p-2 rounded-md focus:outline-none focus:ring">
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
                            </div>
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <div class="ms-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <button v-if="$page.props.jetstream
        .managesProfilePhotos
        " class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user
        .profile_photo_url
        " :alt="$page.props.auth.user.name
        " />
                                            </button>

                                            <span v-else class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                    {{ $page.props.auth.user.name }}

                                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Account
                                            </div>

                                            <DropdownLink :href="route('profile.show')">
                                                Profile
                                            </DropdownLink>

                                            <DropdownLink v-if="$page.props.jetstream
        .hasApiFeatures
        " :href="route('api-tokens.index')">
                                                API Tokens
                                            </DropdownLink>

                                            <div class="border-t border-gray-200" />

                                            <form @submit.prevent="logout">
                                                <DropdownLink as="button">
                                                    Log Out
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </Dropdown>
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
