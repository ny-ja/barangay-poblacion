<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Icon from '@/Components/Icon.vue';
import CommitteeHeader from "@/CustomComponents/CommitteeHeader.vue";
import CommitteeMemberCard from "@/CustomComponents/CommitteeMemberCard.vue";
import CommitteeMemberHeader from "@/CustomComponents/CommitteeMemberHeader.vue";
import CommitteeMemberContainer from "@/CustomComponents/CommitteeMemberContainer.vue";
import InitiativeContainer from "@/CustomComponents/InitiativeContainer.vue";
import InitiativeCard from "@/CustomComponents/InitiativeCard.vue";
import DocumentTabs from "@/CustomComponents/DocumentTabs.vue";
import DocumentCard from "@/CustomComponents/DocumentCard.vue";
import { ref, computed } from "vue";

const props = defineProps(['committeeDocuments', 'initiatives', 'members', 'documentTypes', 'committees']);

const currentTab = ref('materials');

const tabs = [
    { name: 'materials', label: 'Educational Materials' },
    { name: 'supports', label: 'Support and Funding' },
];

const filteredDocuments = computed(() => {
    return props.committeeDocuments.data.filter(doc => {
        if (currentTab.value === 'materials') {
            return doc.document_type.name === 'Educational Materials';
        } else if (currentTab.value === 'supports') {
            return doc.document_type.name === 'Support and Funding';
        }
        return false;
    });
});
</script>
<template>
    <AppLayout title="DRRM">
        <div class="">
            <template v-for="committee in committees">
                <template v-if="committee.name == 'DRRM'">
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
                        <template #description>The Barangay DRRM Council members are
                            dedicated to enhancing disaster preparedness and response within our community. Their
                            unwavering commitment to public safety and proactive planning plays a crucial role in
                            mitigating the impact of disasters and ensuring the resilience of our barangay.</template>
                    </CommitteeMemberHeader>
                </template>
                <template #cards>
                    <template v-for="member in members" :key="member.id">
                        <template v-if="member.committee.name == 'DRRM'">
                            <CommitteeMemberCard>
                                <template #image><img
                                        class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                        :src="`/storage/${member.member_photo_path}`" alt="member photo" /></template>
                                <template #name>{{ member.full_name }}</template>
                                <template #role>{{ member.role }}</template>
                                <template #profile>{{ member.profile }}</template>
                                <template #icons>
                                    <a class="" href="tel:{{ member.contact_number }}"
                                        aria-label="Call {{ member.contact_number }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                        </svg>
                                    </a>
                                    <a class="ml-2" href="mailto:{{ member.email }}"
                                        aria-label="Email {{ member.email }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
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

            <section class="text-gray-600 body-font bg-gray-100">
                <div class="container px-5 py-16 flex flex-wrap flex-col">
                    <DocumentTabs :tabs="tabs" v-model:currentTab="currentTab" />

                    <div v-if="filteredDocuments.length" class="px-5">
                        <div class="flex flex-wrap -m-4">
                            <DocumentCard v-for="document in filteredDocuments" :key="document.id"
                                :document="document" />
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-center text-gray-500">No documents available.</p>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>