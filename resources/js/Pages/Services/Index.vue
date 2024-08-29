<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Icon from '@/Components/Icon.vue';

const props = defineProps(['documents', 'documentTypes']);

const isFirstTab = ref(true);
const isSecondTab = ref(false);
const isThirdTab = ref(false);
const isFourthTab = ref(false);

const viewPDF = (filePath) => {
    window.open(`/storage/${filePath}`, '_blank');
}

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
                    <div v-if="isFirstTab" class="px-5">
                        <div class="flex flex-wrap -m-4">
                            <temmplate v-for="document in documents.data" :key="document.id">
                                <div v-if="document.document_type.name == 'Application Form'" class="p-4 md:1/3">
                                    <div
                                        class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                        <div :style="{ backgroundImage: `url(/storage/${document.background_image_path})` }"
                                            class="image-container object-contain w-full h-40 px-40 bg-center bg-no-repeat bg-transparent bg-blend-multiply overflow-hidden flex items-center justify-center relative">
                                            <div class="icon-container bg-gray-800 opacity-60 px-5 py-5 rounded-full">
                                                <Icon name="chevron_double_down" :classes="'size-6'" stroke="white" />
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button @click="viewPDF(document.file_path)"
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-5'" fill="white" stroke="none" />
                                                </button>
                                                <button @click="downloadPDF(document.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-5'" fill="white" stroke="white" />
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
                                <div v-if="document.document_type.name == 'Barangay Clearance Requirements'"
                                    class="p-4 md:1/3">
                                    <div
                                        class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                        <div :style="{ backgroundImage: `url(/storage/${document.background_image_path})` }"
                                            class="image-container object-contain w-full h-40 px-40 bg-center bg-no-repeat bg-transparent bg-blend-multiply overflow-hidden flex items-center justify-center relative">
                                            <div class="icon-container bg-gray-800 opacity-60 px-5 py-5 rounded-full">
                                                <Icon name="chevron_double_down" :classes="'size-6'" stroke="white" />
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-5'" fill="white" stroke="none" />
                                                </button>
                                                <button @click="downloadPDF(document.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-5'" fill="white" stroke="white" />
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
                    <div v-if="isThirdTab" class="px-5">
                        <div class="flex flex-wrap -m-4">
                            <temmplate v-for="document in documents.data" :key="document.id">
                                <div v-if="document.document_type.name == 'Health Services'" class="p-4 md:1/3">
                                    <div
                                        class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                        <div :style="{ backgroundImage: `url(/storage/${document.background_image_path})` }"
                                            class="image-container object-contain w-full h-40 px-40 bg-center bg-no-repeat bg-transparent bg-blend-multiply overflow-hidden flex items-center justify-center relative">
                                            <div class="icon-container bg-gray-800 opacity-60 px-5 py-5 rounded-full">
                                                <Icon name="chevron_double_down" :classes="'size-6'" stroke="white" />
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-5'" fill="white" stroke="none" />
                                                </button>
                                                <button @click="downloadPDF(document.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-5'" fill="white" stroke="white" />
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
                    <div v-if="isFourthTab" class="px-5">
                        <div class="flex flex-wrap -m-4">
                            <temmplate v-for="document in documents.data" :key="document.id">
                                <div v-if="document.document_type.name == 'Informational Materials'" class="p-4 md:1/3">
                                    <div
                                        class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
                                        <div :style="{ backgroundImage: `url(/storage/${document.background_image_path})` }"
                                            class="image-container object-contain w-full h-40 px-40 bg-center bg-no-repeat bg-transparent bg-blend-multiply overflow-hidden flex items-center justify-center relative">
                                            <div class="icon-container bg-gray-800 opacity-60 px-5 py-5 rounded-full">
                                                <Icon name="chevron_double_down" :classes="'size-6'" stroke="white" />
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-5'" fill="white" stroke="none" />
                                                </button>
                                                <button @click="downloadPDF(document.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-5'" fill="white" stroke="white" />
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