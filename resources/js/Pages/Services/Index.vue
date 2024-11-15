<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DocumentTabs from "@/CustomComponents/DocumentTabs.vue";
import DocumentCard from "@/CustomComponents/DocumentCard.vue";
import { ref, computed } from "vue";

const props = defineProps(['documents', 'documentTypes']);

const currentTab = ref('forms');

const tabs = [
    { name: 'forms', label: 'Application Forms' },
    { name: 'requirements', label: 'Barangay Clearance Requirements' },
    { name: 'services', label: 'Health Services' },
    { name: 'materials', label: 'Informational Materials' },
];

const filteredDocuments = computed(() => {
    return props.documents.data.filter(doc => {
        if (currentTab.value === 'forms') {
            return doc.document_type.name === 'Application Forms';
        } else if (currentTab.value === 'requirements') {
            return doc.document_type.name === 'Barangay Clearance Requirements';
        } else if (currentTab.value === 'services') {
            return doc.document_type.name === 'Health Services';
        } else if (currentTab.value === 'materials') {
            return doc.document_type.name === 'Informational Materials';
        }
        return false;
    });
});
</script>

<template>
    <AppLayout title="Resources">
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-16 flex flex-wrap flex-col">
                <DocumentTabs :tabs="tabs" v-model:currentTab="currentTab" />
                
                <div v-if="filteredDocuments.length" class="px-5">
                    <div class="flex flex-wrap -m-4">
                        <DocumentCard v-for="document in filteredDocuments" :key="document.id" :document="document" />
                    </div>
                </div>
                <div v-else>
                    <p class="text-center text-gray-500">No documents available.</p>
                </div>
            </div>
        </section>
    </AppLayout>
</template>