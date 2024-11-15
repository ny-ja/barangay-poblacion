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
                <template #title>
                    Barangay News
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
                                    class="text-teal-800 inline-flex items-center md:mb-2 lg:mb-0 hover:text-teal-500">
                                Read more...
                                </Link>
                            </template>
                        </NewsCard>
                    </template>
                </template>
            </NewsContainer>

            <section class="text-gray-600 body-font bg-gray-100">
                <div class="container mx-auto flex px-5 py-16 md:flex-row flex-col items-center">
                    <div
                        class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">About Us
                        </h1>
                        <p class="mb-8 leading-relaxed text-lg text-justify">Welcome to Barangay Poblacion, a vibrant
                            community
                            where we
                            cherish our
                            culture and
                            traditions.
                            Our barangay is known for its unity and hospitality, where every resident is considered
                            family.
                            We strive to maintain a peaceful and progressive environment through various community
                            programs
                            and initiatives that cater to the needs of our constituents. Join us in our journey
                            towards a
                            brighter future as we work hand-in-hand to uplift the lives of every member of our
                            barangay.</p>
                        <div class="flex justify-center">
                            <Link :href="route('about.index')"
                                class="inline-flex text-white bg-teal-800 border-0 py-2 px-6 focus:outline-none hover:bg-teal-700 rounded text-lg">
                            Read more</Link>
                        </div>
                    </div>
                    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                        <img class="object-cover object-center rounded" alt="hero" src="/images/admin.webp">
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
