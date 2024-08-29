<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Icon from '@/Components/Icon.vue';
import CommitteeHeader from "@/CustomComponents/CommitteeHeader.vue";
import CommitteeMemberCard from "@/CustomComponents/CommitteeMemberCard.vue";
import CommitteeMemberHeader from "@/CustomComponents/CommitteeMemberHeader.vue";
import CommitteeMemberContainer from "@/CustomComponents/CommitteeMemberContainer.vue";
import InitiativeContainer from "@/CustomComponents/InitiativeContainer.vue";
import InitiativeCard from "@/CustomComponents/InitiativeCard.vue";
import { ref } from "vue";

const props = defineProps(['committeeDocuments', 'initiatives', 'members', 'documentTypes', 'committees']);

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
    <AppLayout title="Health">
        <div class="">
            <template v-for="committee in committees">
                <template v-if="committee.name == 'Health And Nutrition'">
                    <CommitteeHeader>
                        <template #image><img alt="barangay"
                                class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                                :src="`/storage/${committee.committee_profile_photo_path}`"
                                v-if="committee.committee_profile_photo_path" /></template>
                        <template #welcome>Welcome to the {{ committee.name }} Committee
                            Section</template>
                        <template #contact>{{
                committee.contact_number
            }}</template>
                        <template #profile>{{
                    committee.committee_profile
                }}</template>
                    </CommitteeHeader>
                </template>
            </template>

            <CommitteeMemberContainer>
                <template #header>
                    <CommitteeMemberHeader>
                        <template #description>The Barangay Health and Nutrition Council
                            members are dedicated to enhancing the well-being of our community. Their unwavering
                            commitment to promoting health and nutrition plays a crucial role in ensuring the overall
                            wellness of our barangay.</template>
                    </CommitteeMemberHeader>
                </template>
                <template #cards>
                    <template v-for="member in members" :key="member.id">
                        <template v-if="member.committee.name == 'Health And Nutrition'">
                            <CommitteeMemberCard>
                                <template #image><img
                                        class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                        :src="`/storage/${member.member_photo_path}`" alt="member photo" /></template>
                                <template #name>{{ member.full_name }}</template>
                                <template #role>{{ member.role }}</template>
                                <template #profile>{{ member.profile }}</template>
                                <template #icons>
                                    <a class="text-gray-500">
                                        <Icon name="outline_fb" :classes="'size-5'" fill="none" stroke="currentColor"
                                            stroke_width="2" />
                                    </a>
                                    <a class="ml-2 text-gray-500">
                                        <Icon name="outline_twitter" :classes="'size-5'" fill="none"
                                            stroke="currentColor" stroke_width="2" />
                                    </a>
                                    <a class="ml-2 text-gray-500">
                                        <Icon name="outline_whatsapp" :classes="'size-5'" fill="none"
                                            stroke="currentColor" stroke_width="2" />
                                    </a></template>
                            </CommitteeMemberCard>
                        </template>
                    </template>
                </template>
            </CommitteeMemberContainer>

            <InitiativeContainer>
                <template #cards>
                    <template v-for="initiative in initiatives.data" :key="initiative.id">
                        <InitiativeCard>
                            <template #image><img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                    :src="`/storage/${initiative.initiative_photo_path}`"
                                    alt="initiatives" /></template>
                            <template #committee>{{ initiative.committee.name }}</template>
                            <template #title>{{ initiative.title }}</template>
                            <template #description>{{ initiative.description }}</template>

                        </InitiativeCard>
                    </template>
                </template>
                <template #pagination>
                    <Pagination :pagination="initiatives" />
                </template>
            </InitiativeContainer>

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
                                                <Icon name="chevron_double_down" :classes="'size-6'" stroke="white" />
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-5'" fill="white" stroke="none" />
                                                </button>
                                                <button @click="downloadPDF(committeeDocument.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-5'" fill="white"
                                                        stroke="white" />
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
                                                <Icon name="chevron_double_down" :classes="'size-6'" stroke="white" />
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center pt-4">
                                            <div class="flex gap-3">
                                                <button
                                                    class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                                                    <Icon name="view" :classes="'size-5'" fill="white" stroke="none" />
                                                </button>
                                                <button @click="downloadPDF(committeeDocument.file_path)"
                                                    class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                                                    <Icon name="download" :classes="'size-5'" fill="white"
                                                        stroke="white" />
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