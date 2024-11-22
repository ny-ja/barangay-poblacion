<script setup>
import { ref, computed, onMounted } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import MainContentHeader from '@/Components/MainContentHeader.vue';
import ChartCard from '@/Components/ChartCard.vue';

const props = defineProps({
  news: Object,
  initiatives: Object,
  subscribers: Object,
  feedback: Object,
});

const currentDate = ref('');
onMounted(() => {
  const today = new Date();
  currentDate.value = today.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  });
});

</script>

<template>
  <AdminLayout title="Dashboard">
    <MainContentHeader>
      <template #title>
        Dashboard
      </template>
    </MainContentHeader>

    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-4">
      <ChartCard :href="route('admin.feedback.index')">
        <template #title>
          Total Feedback
        </template>
        <template #value>{{ feedback.length }}</template>
        <template #date>{{ currentDate }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.subscribers.index')">
        <template #title>
          Total Subscribers
        </template>
        <template #value>{{ subscribers.length }}</template>
        <template #date>{{ currentDate }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.news.index')">
        <template #title>
          Total News
        </template>
        <template #value>{{ news.length }}</template>
        <template #date>{{ currentDate }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.committee-initiatives.index')">
        <template #title>
          Total Committee Initiatives
        </template>
        <template #value>{{ initiatives.length }}</template>
        <template #date>{{ currentDate }}</template>
      </ChartCard>

    </div>
  </AdminLayout>
</template>