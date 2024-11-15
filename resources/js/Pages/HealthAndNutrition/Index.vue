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
                                    <a class="">
                                        <Icon name="phone" :classes="'size-5'" fill="none" stroke="currentColor"
                                            stroke_width="1.5" />
                                    </a>
                                    <a class="ml-2">
                                        <Icon name="mail" :classes="'size-5'" fill="none"
                                            stroke="currentColor" stroke_width="1.5" />
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