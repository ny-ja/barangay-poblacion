<script setup>
import Icon from "@/Components/Icon.vue";
import SideNavLink from "@/Components/SideNavLink.vue";
import DropdownButton from "@/Components/DropdownButton.vue";

const props = defineProps({
    isSidebarOpen: Boolean,
});

const emit = defineEmits(['close']);

const closeDrawer = () => {
    emit('close');
};

</script>
<template>
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
            <button @click="closeDrawer" class="p-2 rounded-md lg:hidden">
                <Icon name="close" stroke="white" />
            </button>
        </div>
        <!-- Sidebar links -->
        <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
            <ul class="flex flex-col gap-y-1 p-2 overflow-hidden">
                <li>
                    <SideNavLink :href="route('admin.index')" :active="route().current('admin.index')"
                        :isSidebarOpen="isSidebarOpen">
                        <Icon name="home" :stroke="'white'" />
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
                    </SideNavLink>
                </li>
                <li>
                    <DropdownButton :isSidebarOpen="isSidebarOpen">
                        <template #icon>
                            <Icon name="category" />
                        </template>
                        <template #text>
                            Categories & Types
                        </template>
                        <template #nav>
                            <SideNavLink :href="route('admin.document-categories.index')"
                                :active="route().current('admin.document-categories.index')"
                                :isSidebarOpen="isSidebarOpen">
                                <Icon name="category" :stroke="'white'" />
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Document Categories</span>
                            </SideNavLink>
                            <SideNavLink :href="route('admin.document-types.index')"
                                :active="route().current('admin.document-types.index')" :isSidebarOpen="isSidebarOpen">
                                <Icon name="category" :stroke="'white'" />
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Document Types</span>
                            </SideNavLink>
                            <SideNavLink :href="route('admin.news-categories.index')"
                                :active="route().current('admin.news-categories.index')" :isSidebarOpen="isSidebarOpen">
                                <Icon name="category" :stroke="'white'" />
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">News Categories</span>
                            </SideNavLink>
                        </template>
                    </DropdownButton>
                </li>
                <li>
                    <DropdownButton :isSidebarOpen="isSidebarOpen">
                        <template #icon>
                            <Icon name="folder" />
                        </template>
                        <template #text>
                            Documents
                        </template>
                        <template #nav>
                            <SideNavLink :href="route('admin.documents.index')"
                                :active="route().current('admin.documents.index')" :isSidebarOpen="isSidebarOpen">
                                <Icon name="folder" :stroke="'white'" />
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Barangay Documents</span>
                            </SideNavLink>
                            <SideNavLink :href="route('admin.committee-documents.index')"
                                :active="route().current('admin.committee-documents.index')"
                                :isSidebarOpen="isSidebarOpen">
                                <Icon name="folder" :stroke="'white'" />
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Committee Documents</span>
                            </SideNavLink>
                        </template>
                    </DropdownButton>
                </li>
                <li>
                    <DropdownButton :isSidebarOpen="isSidebarOpen">
                        <template #icon>
                            <Icon name="group" />
                        </template>
                        <template #text>
                            People
                        </template>
                        <template #nav>
                            <SideNavLink :href="route('admin.barangay-officials.index')"
                                :active="route().current('admin.barangay-officials.index')"
                                :isSidebarOpen="isSidebarOpen">
                                <Icon name="group" :stroke="'white'" />
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Barangay Officials</span>
                            </SideNavLink>
                            <SideNavLink :href="route('admin.committee-members.index')"
                                :active="route().current('admin.committee-members.index')"
                                :isSidebarOpen="isSidebarOpen">
                                <Icon name="group" :stroke="'white'" />
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Committee Members</span>
                            </SideNavLink>
                            <SideNavLink :href="route('admin.users.index')"
                                :active="route().current('admin.users.index')" :isSidebarOpen="isSidebarOpen">
                                <Icon name="group" :stroke="'white'" />
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Users</span>
                            </SideNavLink>
                            <SideNavLink :href="route('admin.subscribers.index')"
                                :active="route().current('admin.subscribers.index')" :isSidebarOpen="isSidebarOpen">
                                <Icon name="group" :stroke="'white'" />
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Subscribers</span>
                            </SideNavLink>
                        </template>
                    </DropdownButton>
                </li>
                <li>
                    <SideNavLink :href="route('admin.news.index')" :active="route().current('admin.news.index')"
                        :isSidebarOpen="isSidebarOpen">
                        <Icon name="newspaper" :stroke="'white'" />
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">News</span>
                    </SideNavLink>

                </li>
                <li>
                    <SideNavLink :href="route('admin.committees.index')"
                        :active="route().current('admin.committees.index')" :isSidebarOpen="isSidebarOpen">
                        <Icon name="squares" :stroke="'white'" />
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">Committees</span>
                    </SideNavLink>
                </li>
                <li>
                    <SideNavLink :href="route('admin.committee-initiatives.index')"
                        :active="route().current('admin.committee-initiatives.index')" :isSidebarOpen="isSidebarOpen">
                        <Icon name="light" :stroke="'white'" />
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">Committee Initiatives</span>
                    </SideNavLink>
                </li>
                <li>
                    <SideNavLink :href="route('admin.feedback.index')" :active="route().current('admin.feedback.index')"
                        :isSidebarOpen="isSidebarOpen">
                        <Icon name="message" :stroke="'white'" />
                        <span :class="{ 'lg:hidden': !isSidebarOpen }">Feedback</span>
                    </SideNavLink>
                </li>
            </ul>
        </nav>
    </aside>
</template>