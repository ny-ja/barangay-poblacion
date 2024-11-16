<script setup>
import { Link } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';
import NewsInfoContainer from "@/CustomComponents/NewsInfoContainer.vue";
import NewsContainer from "@/CustomComponents/NewsContainer.vue";
import NewsCard from "@/CustomComponents/NewsCard.vue";
import moment from 'moment';

const props = defineProps(['news', 'newsCategories', 'news_item']);

const formatDate = (date) => {
    return moment(date).format('MMMM Do YYYY');
};

</script>

<template>
    <AppLayout title="News Information">
        <NewsInfoContainer>
            <template #image><img class="object-cover object-center h-full w-full"
                    :src="`/storage/${news_item.news_photo_path}`" alt="news" /></template>
            <template #title>{{ news_item.title }}</template>
            <template #date>{{ formatDate(news_item.date) }}</template>
            <template #description>{{ news_item.description }}</template>
        </NewsInfoContainer>
        <NewsContainer>
            <template #title>
                Related News
            </template>
            <template #cards>
                <template v-for="news_item in news.data" :key="news_item.id">
                    <NewsCard>
                        <template #image><img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                :src="`/storage/${news_item.news_photo_path}`" alt="news" /></template>
                        <template #category>{{ news_item.news_category.name }}</template>
                        <template #title>{{ news_item.title }}</template>
                        <template #description>{{ news_item.description }}</template>
                        <template #link>
                            <Link :href="route('news.show', news_item)"
                                class="text-teal-800 inline-flex items-center md:mb-2 lg:mb-0 hover:text-teal-500">Read
                            more
                            </Link>
                        </template>
                    </NewsCard>
                </template>
            </template>
            <template #pagination>
                <Pagination :pagination="news" />
            </template>
        </NewsContainer>
    </AppLayout>
</template>
