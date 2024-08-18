<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['official']);

</script>


<template>
    <AdminLayout title="Barangay Official Information">
        <div
            class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
            <h1 class="text-2xl font-semibold whitespace-nowrap">Barangay Official Information</h1>
            <Link :href="route('admin.barangay-officials.index')"
                class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-gray-200 rounded-md shadow hover:bg-opacity-20">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </span>
            <span>Back</span>
            </Link>
        </div>

        <div class="flex flex-col mt-6">
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-24 mx-auto">
                    <div class="lg:w-4/5 mx-auto flex flex-wrap">
                        <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{ official.full_name }}</h1>
                            <p class="leading-relaxed mb-4">{{ official.profile }}</p>
                            <div class="flex border-t border-gray-200 py-2">
                                <span class="text-gray-500">Position</span>
                                <span class="ml-auto text-gray-900">{{ official.position }}</span>
                            </div>
                            <div class="flex border-t border-gray-200 py-2">
                                <span class="text-gray-500">Role</span>
                                <span class="ml-auto text-gray-900">{{ official.role }}</span>
                            </div>
                            <div class="flex border-t border-gray-200 py-2">
                                <span class="text-gray-500">Email</span>
                                <span class="ml-auto text-gray-900">{{ official.email }}</span>
                            </div>
                            <div class="flex border-t border-gray-200 py-2">
                                <span class="text-gray-500">Contact</span>
                                <span class="ml-auto text-gray-900">{{ official.contact_number }}</span>
                            </div>
                            <div class="flex border-t border-gray-200 py-2">
                                <span class="text-gray-500">Address</span>
                                <span class="ml-auto text-gray-900">{{ official.position }}</span>
                            </div>
                            <div class="flex border-t border-gray-200 py-2">
                                <span class="text-gray-500">Start Date</span>
                                <span class="ml-auto text-gray-900">{{ official.start_date }}</span>
                            </div>
                            <div class="flex border-t border-gray-200 py-2">
                                <span class="text-gray-500">End Date</span>
                                <span class="ml-auto text-gray-900">{{ official.end_date }}</span>
                            </div>
                        </div>
                        <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                            :src="`/storage/${official.photo_path}`" v-if="official.photo_path" />
                    </div>
                </div>
            </section>
        </div>
    </AdminLayout>
</template>
