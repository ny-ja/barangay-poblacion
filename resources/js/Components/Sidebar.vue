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
        <div class="overflow-y-auto overflow-x-hidden">
            <div class="flex items-center justify-between flex-shrink-0 p-2"
                :class="{ 'lg:justify-center': !isSidebarOpen }">
                <span
                    class="flex items-center flex-nowrap space-x-2 text-xl leading-8 tracking-wider uppercase whitespace-nowrap">
                    <img src="/images/poblacion-logo.svg" class="w-12 h-auto" alt="Barangay Logo" />
                    <span class="antialiased tracking-wider font-black leading-none text-white"
                        :class="{ 'lg:hidden': !isSidebarOpen }">Brgy.<br /> Poblacion</span>
                </span>
                <button @click="closeDrawer" class="p-2 rounded-md lg:hidden">
                    <Icon name="close" stroke="white" />
                </button>
            </div>
            <!-- Sidebar links -->
            <nav class="flex-1 overflow-hidden">
                <ul class="flex flex-col gap-y-1 p-2 overflow-hidden">
                    <li>
                        <SideNavLink :href="route('admin.index')" :active="route().current('admin.index')"
                            :isSidebarOpen="isSidebarOpen">
                            <Icon name="home" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <DropdownButton :isSidebarOpen="isSidebarOpen">
                            <template #icon>
                                <Icon name="category" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            </template>
                            <template #text>
                                Categories & Types
                            </template>
                            <template #nav>
                                <SideNavLink :href="route('admin.document-categories.index')"
                                    :active="route().current('admin.document-categories.index')"
                                    :isSidebarOpen="isSidebarOpen">
                                    <Icon name="rectangle_stack" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                    <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Document Categories</span>
                                </SideNavLink>
                                <SideNavLink :href="route('admin.document-types.index')"
                                    :active="route().current('admin.document-types.index')"
                                    :isSidebarOpen="isSidebarOpen">
                                    <Icon name="numbered_list" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                    <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Document Types</span>
                                </SideNavLink>
                                <SideNavLink :href="route('admin.news-categories.index')"
                                    :active="route().current('admin.news-categories.index')"
                                    :isSidebarOpen="isSidebarOpen">
                                    <Icon name="square_stack_3" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                    <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">News Categories</span>
                                </SideNavLink>
                            </template>
                        </DropdownButton>
                    </li>
                    <li>
                        <DropdownButton :isSidebarOpen="isSidebarOpen" >
                            <template #icon>
                                <Icon name="folder_open" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            </template>
                            <template #text>
                                Documents
                            </template>
                            <template #nav>
                                <SideNavLink :href="route('admin.documents.index')"
                                    :active="route().current('admin.documents.index')" :isSidebarOpen="isSidebarOpen">
                                    <Icon name="folder" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                    <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Barangay Documents</span>
                                </SideNavLink>
                                <SideNavLink :href="route('admin.committee-documents.index')"
                                    :active="route().current('admin.committee-documents.index')"
                                    :isSidebarOpen="isSidebarOpen">
                                    <Icon name="square_stack_2" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                    <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Committee Documents</span>
                                </SideNavLink>
                            </template>
                        </DropdownButton>
                    </li>
                    <li>
                        <DropdownButton :isSidebarOpen="isSidebarOpen">
                            <template #icon>
                                <Icon name="group" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            </template>
                            <template #text>
                                People
                            </template>
                            <template #nav>
                                <SideNavLink :href="route('admin.barangay-officials.index')"
                                    :active="route().current('admin.barangay-officials.index')"
                                    :isSidebarOpen="isSidebarOpen">
                                    <Icon name="user" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                    <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Barangay Officials</span>
                                </SideNavLink>
                                <SideNavLink :href="route('admin.committee-members.index')"
                                    :active="route().current('admin.committee-members.index')"
                                    :isSidebarOpen="isSidebarOpen">
                                    <Icon name="users" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                    <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Committee Members</span>
                                </SideNavLink>
                                <SideNavLink :href="route('admin.users.index')"
                                    :active="route().current('admin.users.index')" :isSidebarOpen="isSidebarOpen">
                                    <Icon name="user_circle" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                    <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Users</span>
                                </SideNavLink>
                                <SideNavLink :href="route('admin.subscribers.index')"
                                    :active="route().current('admin.subscribers.index')" :isSidebarOpen="isSidebarOpen">
                                    <Icon name="user_plus" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                                    <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Subscribers</span>
                                </SideNavLink>
                            </template>
                        </DropdownButton>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.news.index')" :active="route().current('admin.news.index')"
                            :isSidebarOpen="isSidebarOpen">
                            <Icon name="newspaper" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">News</span>
                        </SideNavLink>

                    </li>
                    <li>
                        <SideNavLink :href="route('admin.committees.index')"
                            :active="route().current('admin.committees.index')" :isSidebarOpen="isSidebarOpen">
                            <Icon name="squares" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Committees</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.committee-initiatives.index')"
                            :active="route().current('admin.committee-initiatives.index')"
                            :isSidebarOpen="isSidebarOpen">
                            <Icon name="light" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Committee Initiatives</span>
                        </SideNavLink>
                    </li>
                    <li>
                        <SideNavLink :href="route('admin.feedback.index')"
                            :active="route().current('admin.feedback.index')" :isSidebarOpen="isSidebarOpen">
                            <Icon name="message" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                            <span class="text-nowrap" :class="{ 'lg:hidden': !isSidebarOpen }">Feedback</span>
                        </SideNavLink>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>