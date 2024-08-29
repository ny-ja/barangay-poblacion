<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Icon from '@/Components/Icon.vue';
import { ref } from "vue";

const props = defineProps(['committeeDocuments', 'members', 'documentTypes', 'committees']);

const isFirstTab = ref(true);
const isSecondTab = ref(false);

const downloadPDF = (filePath) => {
    const url = encodeURI(`/storage/${filePath}`);
    const link = document.createElement('a');
    link.href = url;
    link.download = filePath.substring(filePath.lastIndexOf('/') + 1);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>
<template>
    <AppLayout title="Peace and order">
        <div class="">
            <section v-for="committee in committees" class="text-gray-600 body-font overflow-hidden">
                <div v-if="committee.name == 'Peace And Order'" class="px-5 py-16 mx-auto">
                    <div class="lg:w-4/5 mx-auto flex flex-wrap flex-row-reverse">
                        <img alt="barangay" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                            :src="`/storage/${committee.committee_profile_photo_path}`"
                            v-if="committee.committee_profile_photo_path" />
                        <div class="lg:w-1/2 w-full lg:pr-24 lg:py-6 mt-6 lg:mt-0">
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">
                                Welcome to the {{ committee.name }} Committee Section
                            </h1>
                            <div class="flex mb-4">
                                <span class="flex py-2 space-x-2">
                                    <div class="flex flex-row space-x-1 items-center">
                                        <Icon name="mobile" :classes="'size-4'" :fill="'#115e59'" /><a href="#"
                                            class="text-sm text-gray-900 hover:underline">{{
                committee.contact_number }}</a>
                                    </div>
                                </span>
                            </div>
                            <p class="leading-relaxed pb-5 border-b-2 border-gray-100 mb-5">{{
                committee.committee_profile }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="text-gray-600 body-font">
                <div class="px-5 py-16 mx-auto">
                    <div class="flex flex-col text-center w-full mb-20">
                        <h1 class="text-2xl font-medium title-font mb-4 text-gray-900 tracking-widest">Committee Members
                        </h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">The Barangay Peace and Order Council
                            members are
                            dedicated to enhancing the safety and security of our community. Their unwavering commitment
                            to
                            public service and proactive planning plays a crucial role in maintaining peace and order
                            within our
                            barangay.</p>
                    </div>
                    <div class="flex flex-wrap -m-4">
                        <template v-for="member in members" :key="member.id">
                            <div v-if="member.committee.name == 'Peace And Order'" class="p-4 lg:w-1/2">
                                <div
                                    class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                    <img class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                        :src="`/storage/${member.member_photo_path}`" alt="member photo">
                                    <div class="flex-grow sm:pl-8">
                                        <h2 class="title-font font-medium text-lg text-gray-900">{{ member.full_name
                                            }}</h2>
                                        <h3 class="text-gray-500 mb-3">{{ member.role }}</h3>
                                        <p class="mb-4">{{ member.profile }}</p>
                                        <span class="inline-flex">
                                            <a class="text-gray-500">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a class="ml-2 text-gray-500">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a class="ml-2 text-gray-500">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>
            <section class="text-gray-600 body-font">
                <div class="px-5 py-16 mx-auto">
                    <h1 class="text-2xl w-full border-b mb-12 uppercase">Peace and Order Programs</h1>
                    <div class="flex flex-wrap -m-4">
                        <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                    src="/images/peace-programs.webp" alt="news" />
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                        COMMUNITY EVENT
                                    </h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                        Clean-Up Drive
                                    </h1>
                                    <p class="leading-relaxed mb-3">
                                        Join us for a barangay-wide clean-up drive this Saturday. Let's keep our
                                        community clean and green!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                    src="/images/peace-programs.webp" alt="news" />
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                        SAFETY INITIATIVE
                                    </h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                        Community Watch Program
                                    </h1>
                                    <p class="leading-relaxed mb-3">
                                        The barangay will launch a community watch program next week. Ensure your
                                        family's safety by participating in this initiative.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                    src="/images/peace-programs.webp" alt="news" />
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                        ANNOUNCEMENT
                                    </h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                        Town Hall Meeting
                                    </h1>
                                    <p class="leading-relaxed mb-3">
                                        There will be a barangay-wide town hall meeting to discuss upcoming peace and
                                        order projects and community concerns. Your presence is important!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="text-gray-600 body-font">
                <div class="container px-5 py-16 mx-auto flex flex-wrap flex-col">
                    <div class="flex mx-auto w-full flex-wrap mb-6">
                        <button @click="isFirstTab = true, isSecondTab = false"
                            :class="{ 'border-teal-800 text-teal-800 rounded-t bg-gray-100': isFirstTab }"
                            class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none cursor-pointer tracking-wider  hover:border-teal-800 hover:text-teal-800 hover:rounded-t hover:bg-gray-100">

                            Educational Materials
                        </button>
                        <button @click="isFirstTab = false, isSecondTab = true"
                            :class="{ 'border-teal-800 text-teal-800 rounded-t bg-gray-100': isSecondTab }"
                            class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none cursor-pointer tracking-wider  hover:border-teal-800 hover:text-teal-800 hover:rounded-t hover:bg-gray-100">

                            Support and Funding
                        </button>
                    </div>
                    <div v-if="isFirstTab" class="px-5">
                        <div class="flex flex-wrap -m-4">
                            <temmplate v-for="committeeDocument in committeeDocuments.data" :key="committeeDocument.id">
                                <div v-if="committeeDocument.document_type.name == 'Educational Materials'"
                                    class="p-4 md:1/3">
                                    <div
                                        class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                        <div :style="{ backgroundImage: `url(/storage/${committeeDocument.background_image_path})` }"
                                            class="image-container object-contain w-full h-40 px-40 bg-center bg-no-repeat bg-transparent bg-blend-multiply overflow-hidden flex items-center justify-center relative">
                                            <div class="icon-container bg-gray-800 opacity-60 px-5 py-5 rounded-full">
                                                <Icon name="chevron-double-down" />
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-4'" :fill="'white'" />
                                                </button>
                                                <button @click="downloadPDF(committeeDocument.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-4'" :fill="'white'" />
                                                </button>
                                            </div>
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-0">
                                                {{ committeeDocument.name }}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </temmplate>
                        </div>
                    </div>
                    <div v-if="isSecondTab" class="px-5">
                        <div class="flex flex-wrap -m-4">
                            <temmplate v-for="committeeDocument in committeeDocuments.data" :key="committeeDocument.id">
                                <div v-if="committeeDocument.document_type.name == 'Support and Funding'"
                                    class="p-4 md:1/3">
                                    <div
                                        class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                        <div :style="{ backgroundImage: `url(/storage/${committeeDocument.background_image_path})` }"
                                            class="image-container object-contain w-full h-40 px-40 bg-center bg-no-repeat bg-transparent bg-blend-multiply overflow-hidden flex items-center justify-center relative">
                                            <div class="icon-container bg-gray-800 opacity-60 px-5 py-5 rounded-full">
                                                <Icon name="chevron-double-down" />
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-4'" :fill="'white'" />
                                                </button>
                                                <button @click="downloadPDF(committeeDocument.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-4'" :fill="'white'" />
                                                </button>
                                            </div>
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-0">
                                                {{ committeeDocument.name }}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </temmplate>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </AppLayout>
</template>

<style scoped>
.image-container {
    background-position: top;
    background-size: cover;
    transition: background-position 1s ease-in-out;
    position: relative;
}

.image-container:hover {
    background-position: center bottom;
}

.icon-container {
    transition: transform 1s ease-in-out, opacity 1s ease-in-out;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.image-container:hover .icon-container {
    transform: translate(-50%, calc(-50% + 50px));
    opacity: 0;
}
</style>