<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  users: Object,
  news: Object,
});

</script>

<template>
  <AdminLayout title="Dashboard">
    <div
      class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
      <h1 class="text-2xl font-semibold whitespace-nowrap">Dashboard</h1>
    </div>
    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-4">
      <Link :href="route('admin.users.index')"
        class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
      <div class="flex items-start">
        <div class="flex flex-col flex-shrink-0 space-y-2">
          <span class="text-gray-400">Total Users</span>
          <span class="text-lg font-semibold">{{
        users.length
      }}</span>
        </div>
        <div class="relative min-w-0 ml-auto h-14">
          <canvas id="usersChart"></canvas>
        </div>
      </div>
      <div>
        <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
        <span>from 2020</span>
      </div>
      </Link>
      <Link :href="route('admin.news.index')" class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
      <div class="flex items-start">
        <div class="flex flex-col flex-shrink-0 space-y-2">
          <span class="text-gray-400">Total News</span>
          <span class="text-lg font-semibold">{{
        news.length
            }}</span>
        </div>
        <div class="relative min-w-0 ml-auto h-14">
          <canvas id="usersChart"></canvas>
        </div>
      </div>
      <div>
        <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
        <span>from 2020</span>
      </div>
      </Link>
    </div>
  </AdminLayout>
</template>
