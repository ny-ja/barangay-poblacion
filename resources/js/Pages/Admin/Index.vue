<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import MainContentHeader from '@/Components/MainContentHeader.vue';
import ChartCard from '@/Components/ChartCard.vue';

const props = defineProps({
  users: Object,
  news: Object,
  documents: Object,
  officials: Object,
  committees: Object,
  members: Object,
  committeeDocuments: Object,
  initiatives: Object,
  subscribers: Object,
  feedback: Object,
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
      <ChartCard :href="route('admin.users.index')">
        <template #title>
          Total Users
        </template>
        <template #value>{{ (users.length - 1) }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.news.index')">
        <template #title>
          Total News
        </template>
        <template #value>{{ news.length }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.documents.index')">
        <template #title>
          Total Documents
        </template>
        <template #value>{{ documents.length }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.barangay-officials.index')">
        <template #title>
          Total Barangay Officials
        </template>
        <template #value>{{ officials.length }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.committees.index')">
        <template #title>
          Total Committees
        </template>
        <template #value>{{ committees.length }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.committee-members.index')">
        <template #title>
          Total Committee Members
        </template>
        <template #value>{{ members.length }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.committee-documents.index')">
        <template #title>
          Total Committee Documents
        </template>
        <template #value>{{ committeeDocuments.length }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.committee-initiatives.index')">
        <template #title>
          Total Committee Initiatives
        </template>
        <template #value>{{ initiatives.length }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.subscribers.index')">
        <template #title>
          Total Subscribers
        </template>
        <template #value>{{ subscribers.length }}</template>
      </ChartCard>
      <ChartCard :href="route('admin.feedback.index')">
        <template #title>
          Total Feedback
        </template>
        <template #value>{{ feedback.length }}</template>
      </ChartCard>
    </div>
    <div class="px-4 py-6 bg-gray-200 my-4 rounded-lg">
      <div class="bg-red-500 px-6 py-8">
        <div
          class="image-container object-contain h-60 bg-center bg-no-repeat bg-[url('/images/captain.webp')] bg-transparent bg-blend-multiply lg:w-2/3 md:w-1/2 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
        </div>
      </div>

    </div>

  </AdminLayout>
</template>

<style scoped>
.image-container {
  background-position: top;
  background-size: cover;
  transition: background-position 1s ease-in-out;
}

.image-container:hover {
  background-position: center bottom;
}
</style>