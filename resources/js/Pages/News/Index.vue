<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from '@/Components/Pagination.vue';

const props = defineProps(['news', 'newsCategories']);
</script>

<template>
    <AppLayout title="News">
        <div class="">
            <section class="text-gray-600 body-font">
                <div class="px-5 py-16 mx-auto">
                    <h1 class="text-2xl w-full border-b mb-12 uppercase">Barangay News</h1>
                    <div class="flex flex-wrap -m-4">
                        <div v-for="news_item in news.data" :key="news_item.id" class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                    :src="`/storage/${news_item.news_photo_path}`" alt="news" />
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                        {{ news_item.news_category.name }}
                                    </h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                        {{ news_item.title }}
                                    </h1>
                                    <p class="leading-relaxed mb-3">
                                        {{ news_item.description }}
                                    </p>
                                    <div class="flex items-center flex-wrap justify-end">
                                        <a class="text-teal-800 inline-flex items-center md:mb-2 lg:mb-0">View
                                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path d="M12 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <Pagination :pagination="news" />
                </div>
            </section>
        </div>
    </AppLayout>
</template>
