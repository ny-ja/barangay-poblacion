<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Icon from '@/Components/Icon.vue';
import { ref } from "vue";

const props = defineProps(['documents', 'documentTypes']);

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
    <AppLayout title="DRRM">
        <div class="">
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="px-5 py-16 mx-auto">
                    <div class="lg:w-4/5 mx-auto flex flex-wrap flex-row-reverse">
                        <img alt="barangay" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                            src="/images/drrm.webp" />
                        <div class="lg:w-1/2 w-full lg:pr-24 lg:py-6 mt-6 lg:mt-0">
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">
                                Welcome to the Disaster Risk Reduction Management Committee Section
                            </h1>
                            <div class="flex mb-4">
                                <span class="flex py-2 space-x-2">
                                    <div class="flex flex-row space-x-1 items-center">
                                        <Icon name="phone" :classes="'size-4'" :fill="'#115e59'" /><a href="#"
                                            class="text-sm text-gray-900 hover:underline">(888) 888-8888</a>
                                    </div>
                                    <div class="flex flex-row space-x-1 items-center">
                                        <Icon name="mobile" :classes="'size-4'" :fill="'#115e59'" /><a href="#"
                                            class="text-sm text-gray-900 hover:underline">(999) 999-9999</a>
                                    </div>
                                </span>
                            </div>
                            <p class="leading-relaxed pb-5 border-b-2 border-gray-100 mb-5">
                                Welcome to Barangay Poblacion, where we prioritize disaster preparedness and community
                                resilience.
                                Our barangay is committed to implementing effective disaster risk reduction strategies
                                to ensure the safety and well-being of all residents.
                                Join us in our mission to build a disaster-resilient community through proactive
                                measures and collaborative efforts.
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
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">The Barangay DRRM Council members are
                            dedicated to enhancing disaster preparedness and response within our community. Their
                            unwavering commitment to public safety and proactive planning plays a crucial role in
                            mitigating the impact of disasters and ensuring the resilience of our barangay.</p>
                    </div>
                    <div class="flex flex-wrap -m-4">
                        <div class="p-4 lg:w-1/2">
                            <div
                                class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                <img alt="team"
                                    class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                    src="/images/man.webp">
                                <div class="flex-grow sm:pl-8">
                                    <h2 class="title-font font-medium text-lg text-gray-900">Juan Dela Cruz</h2>
                                    <h3 class="text-gray-500 mb-3">DRRM Program Organizer</h3>
                                    <p class="mb-4">Juan Dela Cruz has been instrumental in organizing disaster
                                        preparedness programs that enhance community resilience. His efforts in
                                        mobilizing resources and volunteers have greatly benefited the barangay's
                                        disaster readiness.</p>
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
                        <div class="p-4 lg:w-1/2">
                            <div
                                class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                <img alt="team"
                                    class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                    src="/images/woman.webp">
                                <div class="flex-grow sm:pl-8">
                                    <h2 class="title-font font-medium text-lg text-gray-900">Maria Santos</h2>
                                    <h3 class="text-gray-500 mb-3">Community Education Advocate</h3>
                                    <p class="mb-4">Maria Santos focuses on improving disaster awareness and
                                        preparedness among the residents. She has spearheaded numerous initiatives to
                                        provide training, enhance emergency response skills, and promote resilient
                                        practices.</p>
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
                        <div class="p-4 lg:w-1/2">
                            <div
                                class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                <img alt="team"
                                    class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                    src="/images/man.webp">
                                <div class="flex-grow sm:pl-8">
                                    <h2 class="title-font font-medium text-lg text-gray-900">Carlos Reyes</h2>
                                    <h3 class="text-gray-500 mb-3">Health and Safety Advocate</h3>
                                    <p class="mb-4">Carlos Reyes is dedicated to promoting the health and safety of our
                                        residents. He has organized health camps, vaccination drives, and wellness
                                        programs to ensure the well-being of our community during emergencies.</p>
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
                        <div class="p-4 lg:w-1/2">
                            <div
                                class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                <img alt="team"
                                    class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                    src="/images/woman.webp">
                                <div class="flex-grow sm:pl-8">
                                    <h2 class="title-font font-medium text-lg text-gray-900">Anna Mendoza</h2>
                                    <h3 class="text-gray-500 mb-3">Youth DRRM Coordinator</h3>
                                    <p class="mb-4">Anna Mendoza is passionate about empowering the youth in disaster
                                        risk reduction. She has established various youth programs that focus on
                                        leadership, skills development, and community service in the context of DRRM.
                                    </p>
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
                        <div class="p-4 lg:w-1/2">
                            <div
                                class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                <img alt="team"
                                    class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                    src="/images/man.webp">
                                <div class="flex-grow sm:pl-8">
                                    <h2 class="title-font font-medium text-lg text-gray-900">Luis Rivera</h2>
                                    <h3 class="text-gray-500 mb-3">Disaster Response Officer</h3>
                                    <p class="mb-4">Luis Rivera is responsible for coordinating disaster response and
                                        preparedness efforts in our barangay. His proactive measures have ensured the
                                        safety and resilience of our community during emergencies.</p>
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
                    </div>
                </div>
            </section>
            <section class="text-gray-600 body-font">
                <div class="px-5 py-16 mx-auto">
                    <h1 class="text-2xl w-full border-b mb-12 uppercase">Disaster Risk Reduction Management Programs
                    </h1>
                    <div class="flex flex-wrap -m-4">
                        <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                    src="/images/drrm-programs.webp" alt="drrm programs" />
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                        DRRM INITIATIVE
                                    </h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                        Emergency Response Training
                                    </h1>
                                    <p class="leading-relaxed mb-3">
                                        Participate in our comprehensive emergency response training session this
                                        Sunday. Equip yourself with the skills to respond effectively to disasters.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                    src="/images/drrm-programs.webp" alt="drrm programs" />
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                        AWARENESS CAMPAIGN
                                    </h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                        Disaster Preparedness Workshop
                                    </h1>
                                    <p class="leading-relaxed mb-3">
                                        Join our workshop to learn about disaster preparedness and resilience. Ensure
                                        your family's safety by being well-prepared for any emergency.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                    src="/images/drrm-programs.webp" alt="drrm programs" />
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                        COMMUNITY MEETING
                                    </h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                        Town Hall Meeting
                                    </h1>
                                    <p class="leading-relaxed mb-3">
                                        Attend the barangay-wide town hall meeting to discuss disaster risk reduction
                                        projects and community concerns. Your participation is crucial!
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
                            :class="{ 'border-[#73BBA3] text-[#73BBA3] rounded-t bg-gray-100': isFirstTab }"
                            class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none cursor-pointer tracking-wider  hover:border-[#73BBA3] hover:text-[#73BBA3] hover:rounded-t hover:bg-gray-100">

                            Educational Materials
                        </button>
                        <button @click="isFirstTab = false, isSecondTab = true"
                            :class="{ 'border-[#73BBA3] text-[#73BBA3] rounded-t bg-gray-100': isSecondTab }"
                            class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none cursor-pointer tracking-wider  hover:border-[#73BBA3] hover:text-[#73BBA3] hover:rounded-t hover:bg-gray-100">

                            Support and Funding
                        </button>
                    </div>
                    <div v-if="isFirstTab" class="px-5">
                        <div class="flex flex-wrap -m-4">
                            <temmplate v-for="document in documents.data" :key="document.id">
                                <div v-if="document.document_type.name == 'Educational Materials'" class="p-4 md:1/3">
                                    <div
                                        class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                        <iframe class="w-full h-auto border rounded-md"
                                            :src="`/storage/${document.file_path}`" frameborder="0"></iframe>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-4'" :fill="'white'" />
                                                </button>
                                                <button @click="downloadPDF(document.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-4'" :fill="'white'" />
                                                </button>
                                            </div>
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-0">
                                                {{ document.name }}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </temmplate>
                        </div>
                    </div>
                    <div v-if="isSecondTab" class="px-5">
                        <div class="flex flex-wrap -m-4">
                            <temmplate v-for="document in documents.data" :key="document.id">
                                <div v-if="document.document_type.name == 'Support and Funding'" class="p-4 md:1/3">
                                    <div
                                        class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                        <iframe class="w-full h-auto border rounded-md"
                                            :src="`/storage/${document.file_path}`" frameborder="0"></iframe>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-4'" :fill="'white'" />
                                                </button>
                                                <button @click="downloadPDF(document.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-4'" :fill="'white'" />
                                                </button>
                                            </div>
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-0">
                                                {{ document.name }}
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