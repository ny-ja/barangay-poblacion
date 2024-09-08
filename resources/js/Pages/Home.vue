<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import NewsContainer from "@/CustomComponents/NewsContainer.vue";
import NewsCard from "@/CustomComponents/NewsCard.vue";

const props = defineProps(['news', 'newsCategories'])
</script>

<template>
    <AppLayout title="Home">
        <div class="">
            <section
                class="bg-center bg-no-repeat bg-[url('/images/admin-building.webp')] bg-teal-800 bg-blend-multiply">
                <div class="px-4 mx-auto max-w-screen-xl text-center py-16 lg:py-56">
                    <h1
                        class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                        Investing in Our Community's Future
                    </h1>
                    <p class="mb-8 text-lg font-normal text-white lg:text-xl sm:px-16 lg:px-48">
                        At our Barangay, we focus on areas where community engagement,
                        innovation, and resources can create long-term benefits and
                        foster economic growth.
                    </p>
                </div>
            </section>

            <NewsContainer>
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
                                    class="text-teal-800 inline-flex items-center md:mb-2 lg:mb-0 hover:text-teal-500">Read more...
                                </Link>
                            </template>
                        </NewsCard>
                    </template>
                </template>
            </NewsContainer>

            <section class="text-gray-600 body-font overflow-hidden">
                <div class="px-5 py-16 mx-auto">
                    <h1 class="text-2xl w-full border-b mb-12 uppercase">About Us</h1>
                    <div class="mx-auto flex flex-wrap flex-row-reverse">
                        <img alt="barangay" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                            src="/images/admin.webp" />
                        <div class="lg:w-1/2 w-full lg:pr-24 lg:py-6 mt-6 lg:mt-0">
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">
                                Welcome to Barangay Poblacion
                            </h1>
                            <div class="flex mb-4">
                                <span class="flex py-2">
                                    <a class="text-gray-500">
                                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a class="text-gray-500">
                                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <path
                                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a class="text-gray-500">
                                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                            <path
                                                d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                            </path>
                                        </svg>
                                    </a>
                                </span>
                            </div>
                            <p class="leading-relaxed pb-5 text-justify text-xl border-b-2 border-gray-100 mb-5">
                                Welcome to Barangay Poblacion, a vibrant community where we cherish our culture and
                                traditions.
                                Our barangay is known for its unity and hospitality, where every resident is considered
                                family.
                                We strive to maintain a peaceful and progressive environment through various community
                                programs
                                and initiatives that cater to the needs of our constituents. Join us in our journey
                                towards a
                                brighter future as we work hand-in-hand to uplift the lives of every member of our
                                barangay.
                            </p>
                            <div class="flex">
                                <Link :href="route('about.index')"
                                    class="flex text-white bg-teal-800 border-0 py-2 px-6 focus:outline-none hover:bg-teal-700 rounded">
                                Read more
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
