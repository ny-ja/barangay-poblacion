<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MainContentHeader from '@/Components/MainContentHeader.vue';
import ShowInformationContainer from '@/Components/ShowInformationContainer.vue';
import LinkIcon from '@/Components/LinkIcon.vue';
import Icon from '@/Components/Icon.vue';

const props = defineProps(['initiative', 'committee']);

</script>


<template>
    <AdminLayout title="Committee Initiative Information">
        <MainContentHeader>
            <template #title>
                {{ initiative.title }} Information
            </template>
            <template #buttons>
                <LinkIcon :href="route('admin.committee-initiatives.index')">
                    <template #icon>
                        <Icon name="back" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </template>
                    <template #text>Back</template>
                </LinkIcon>
            </template>
        </MainContentHeader>

        <ShowInformationContainer>
            <template #content>
                <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ initiative.committee.name }}
                    </h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{ initiative.title }}</h1>
                    <p class="leading-relaxed mb-4">{{ initiative.description }}</p>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Status</span>
                        <span class="ml-auto text-gray-900">{{ initiative.status }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Budget</span>
                        <span class="ml-auto text-gray-900">{{ initiative.budget }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Source</span>
                        <span class="ml-auto text-gray-900">{{ initiative.source }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Beneficiaries</span>
                        <span class="ml-auto text-gray-900">{{ initiative.beneficiaries }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Contact Person</span>
                        <span class="ml-auto text-gray-900">{{ initiative.contact_person }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Remarks</span>
                        <span class="ml-auto text-gray-900">{{ initiative.remarks }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Start Date</span>
                        <span class="ml-auto text-gray-900">{{ initiative.start_date }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">End Date</span>
                        <span class="ml-auto text-gray-900">{{ initiative.end_date }}</span>
                    </div>
                </div>
                <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                    :src="`/storage/${initiative.initiative_photo_path}`" v-if="initiative.initiative_photo_path" />
            </template>
        </ShowInformationContainer>
    </AdminLayout>
</template>
