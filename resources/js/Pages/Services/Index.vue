<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Icon from '@/Components/Icon.vue';

const isFirstTab = ref(true);
const isSecondTab = ref(false);
const isThirdTab = ref(false);
const isFourthTab = ref(false);

const files = ref([
    { id: 1, title: "Dummy file 1", pdfUrl: "/pdfs/pdf1.pdf" },
    { id: 2, title: "Dummy file 2", pdfUrl: "/pdfs/pdf2.pdf" },
    { id: 3, title: "Dummy file 3", pdfUrl: "/pdfs/pdf3.pdf" },
    { id: 1, title: "Dummy file 4", pdfUrl: "/pdfs/pdf4.pdf" },
    { id: 2, title: "Dummy file 5", pdfUrl: "/pdfs/pdf5.pdf" },
    { id: 3, title: "Dummy file 6", pdfUrl: "/pdfs/pdf6.pdf" },
]);

const downloadPDF = (url) => {
    const link = document.createElement('a');
    link.href = url;
    link.download = url.substring(url.lastIndexOf('/') + 1);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>
<template>
    <AppLayout title="Services">
        <div class="">
            <section class="text-gray-600 body-font">
                <div class="container px-5 py-16 mx-auto flex flex-wrap flex-col">
                    <div class="flex mx-auto w-full flex-wrap mb-6">
                        <button @click="isFirstTab = true, isSecondTab = false, isThirdTab = false, isFourthTab = false"
                            :class="{ 'border-teal-800 text-teal-800 rounded-t bg-gray-100': isFirstTab }"
                            class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none cursor-pointer tracking-wider  hover:border-teal-800 hover:text-teal-800 hover:rounded-t hover:bg-gray-100">

                            Application Form
                        </button>
                        <button @click="isFirstTab = false, isSecondTab = true, isThirdTab = false, isFourthTab = false"
                            :class="{ 'border-teal-800 text-teal-800 rounded-t bg-gray-100': isSecondTab }"
                            class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none cursor-pointer tracking-wider  hover:border-teal-800 hover:text-teal-800 hover:rounded-t hover:bg-gray-100">

                            Barangay Clearance Requirements
                        </button>
                        <button @click="isFirstTab = false, isSecondTab = false, isThirdTab = true, isFourthTab = false"
                            :class="{ 'border-teal-800 text-teal-800 rounded-t bg-gray-100': isThirdTab }"
                            class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none cursor-pointer tracking-wider  hover:border-teal-800 hover:text-teal-800 hover:rounded-t hover:bg-gray-100">

                            Health Services
                        </button>
                        <button @click="isFirstTab = false, isSecondTab = false, isThirdTab = false, isFourthTab = true"
                            :class="{ 'border-teal-800 text-teal-800 rounded-t bg-gray-100': isFourthTab }"
                            class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none cursor-pointer tracking-wider  hover:border-teal-800 hover:text-teal-800 hover:rounded-t hover:bg-gray-100">

                            Informational Materials
                        </button>
                    </div>
                    <div v-if="isFirstTab" class="px-5 mx-auto">
                        <div class="flex flex-wrap -m-4">
                            <div class="p-4 md:w-1/3" v-for="file in files" :key="file.id">
                                <div
                                    class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                    <iframe class="w-full h-auto border rounded-md" :src="file.pdfUrl"
                                        frameborder="0"></iframe>
                                    <div class="flex justify-between items-center pt-4">
                                        <div class="flex gap-3">
                                            <button
                                                class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                <Icon name="view" :classes="'size-4'" />
                                            </button>
                                            <button @click="downloadPDF(file.pdfUrl)"
                                                class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                <Icon name="download" :classes="'size-4'" />
                                            </button>
                                        </div>

                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-0">
                                            {{ file.title }}
                                        </h1>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div v-if="isSecondTab" class="px-5 mx-auto">
                        <div class="flex flex-wrap -m-4">
                            <div class="p-4 md:w-1/3" v-for="file in files" :key="file.id">
                                <div
                                    class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                    <iframe class="w-full h-auto border rounded-md" :src="file.pdfUrl"
                                        frameborder="0"></iframe>
                                    <div class="flex justify-between items-center pt-4">
                                        <div class="flex gap-3">
                                            <button
                                                class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                <Icon name="view" :classes="'size-4'" />
                                            </button>
                                            <button @click="downloadPDF(file.pdfUrl)"
                                                class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                <Icon name="download" :classes="'size-4'" />
                                            </button>
                                        </div>

                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-0">
                                            {{ file.title }}
                                        </h1>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div v-if="isThirdTab" class="px-5 mx-auto">
                        <div class="flex flex-wrap -m-4">
                            <div class="p-4 md:w-1/3" v-for="file in files" :key="file.id">
                                <div
                                    class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                    <iframe class="w-full h-auto border rounded-md" :src="file.pdfUrl"
                                        frameborder="0"></iframe>
                                    <div class="flex justify-between items-center pt-4">
                                        <div class="flex gap-3">
                                            <button
                                                class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                <Icon name="view" :classes="'size-4'" />
                                            </button>
                                            <button @click="downloadPDF(file.pdfUrl)"
                                                class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                <Icon name="download" :classes="'size-4'" />
                                            </button>
                                        </div>

                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-0">
                                            {{ file.title }}
                                        </h1>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div v-if="isFourthTab" class="px-5 mx-auto">
                        <div class="flex flex-wrap -m-4">
                            <div class="p-4 md:w-1/3" v-for="file in files" :key="file.id">
                                <div
                                    class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                    <iframe class="w-full h-auto border rounded-md" :src="file.pdfUrl"
                                        frameborder="0"></iframe>
                                    <div class="flex justify-between items-center pt-4">
                                        <div class="flex gap-3">
                                            <button
                                                class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                <Icon name="view" :classes="'size-4'" />
                                            </button>
                                            <button @click="downloadPDF(file.pdfUrl)"
                                                class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                <Icon name="download" :classes="'size-4'" />
                                            </button>
                                        </div>

                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-0">
                                            {{ file.title }}
                                        </h1>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>