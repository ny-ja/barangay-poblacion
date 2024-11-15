<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DocumentTabs from "@/CustomComponents/DocumentTabs.vue";
import DocumentCard from "@/CustomComponents/DocumentCard.vue";
import { ref, computed } from "vue";

const props = defineProps(['documents', 'documentTypes']);

const currentTab = ref('resolutions');

const tabs = [
    { name: 'resolutions', label: 'Approved Resolutions' },
    { name: 'ordinances', label: 'Approved Ordinances' },
];

const filteredDocuments = computed(() => {
    return props.documents.data.filter(doc => {
        if (currentTab.value === 'resolutions') {
            return doc.document_type.name === 'Approved Resolutions';
        } else if (currentTab.value === 'ordinances') {
            return doc.document_type.name === 'Approved Ordinances';
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
