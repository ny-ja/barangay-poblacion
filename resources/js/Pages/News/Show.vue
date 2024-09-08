<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NewsInfoContainer from "@/CustomComponents/NewsInfoContainer.vue";
import moment from 'moment';

const props = defineProps(['news_item']);

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
    </AppLayout>
</template>
