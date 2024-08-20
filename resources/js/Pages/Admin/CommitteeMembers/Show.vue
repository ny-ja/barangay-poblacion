<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MainContentHeader from '@/Components/MainContentHeader.vue';
import ShowInformationContainer from '@/Components/ShowInformationContainer.vue';
import LinkIcon from '@/Components/LinkIcon.vue';
import Icon from '@/Components/Icon.vue';

const props = defineProps(['member', 'committee']);

</script>


<template>
    <AdminLayout title="Committee Member Information">
        <MainContentHeader>
            <template #title>
                {{ member.full_name }} Information
            </template>
            <template #buttons>
                <LinkIcon :href="route('admin.committee-members.index')">
                    <template #icon>
                        <Icon name="back" />
                    </template>
                    <template #text>Back</template>
                </LinkIcon>
            </template>
        </MainContentHeader>

        <ShowInformationContainer>
            <template #content>
                <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ member.committee.name }}
                    </h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{ member.full_name }}</h1>
                    <p class="leading-relaxed mb-4">{{ member.profile }}</p>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Position</span>
                        <span class="ml-auto text-gray-900">{{ member.position }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Role</span>
                        <span class="ml-auto text-gray-900">{{ member.role }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Email</span>
                        <span class="ml-auto text-gray-900">{{ member.email }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Contact</span>
                        <span class="ml-auto text-gray-900">{{ member.contact_number }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Address</span>
                        <span class="ml-auto text-gray-900">{{ member.position }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Start Date</span>
                        <span class="ml-auto text-gray-900">{{ member.start_date }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">End Date</span>
                        <span class="ml-auto text-gray-900">{{ member.end_date }}</span>
                    </div>
                </div>
                <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                    :src="`/storage/${member.member_photo_path}`" v-if="member.member_photo_path" />
            </template>
        </ShowInformationContainer>
    </AdminLayout>
</template>
