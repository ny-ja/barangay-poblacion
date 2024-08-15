<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import Drawer from '@/Components/Drawer.vue';
import { Inertia } from '@inertiajs/inertia';
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';

const props = defineProps(['documents', 'documentCategories', 'documentTypes', 'filters']);

const isDrawerOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    name: '',
    file: null,
    user_id: '',
    document_category_id: '',
    document_type_id: '',
});

function openDrawerForCreate() {
    form.reset();
    isEditMode.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(document) {
    form.id = document.id;
    form.name = document.name;
    form.file = null;
    form.document_category_id = document.document_category_id;
    form.document_type_id = document.document_type_id;
    isEditMode.value = true;
    isDrawerOpen.value = true;
}

function handleFileChange(event) {
    form.file = event.target.files[0];
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(route('admin.documents.update', form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("Document has been successfully updated!", {
                    "type": "success",
                    "position": "bottom-right",
                    "autoClose": 1000,
                    "hideProgressBar": true,
                    "transition": "flip",
                    "dangerouslyHTMLString": true
                })
                form.reset();
                isDrawerOpen.value = false;
            },
            onError: (errors) => {
                if (errors) {
                    errorMessage.value = 'There was an error submitting the form. Please check the fields and try again.';
                }
            },
            onFinish: () => {
                if (!form.hasErrors) {
                    errorMessage.value = '';
                }
            },
        });
    } else {
        form.post(route('admin.documents.store'), {
            forceFormData: true,
            onSuccess: () => {
                toast("Document has been successfully created!", {
                    "type": "success",
                    "position": "bottom-right",
                    "autoClose": 1000,
                    "hideProgressBar": true,
                    "transition": "flip",
                    "dangerouslyHTMLString": true
                })
                form.reset();
                isDrawerOpen.value = false;
            },
            onError: (errors) => {
                if (errors) {
                    errorMessage.value = 'There was an error submitting the form. Please check the fields and try again.';
                }
            },
            onFinish: () => {
                if (!form.hasErrors) {
                    errorMessage.value = '';
                }
            },
        });
    }
}

const deleteDocument = (documentId) => {
    if (confirm('Are you sure you want to delete this document?')) {
        Inertia.delete(route('admin.documents.destroy', documentId), {
            onSuccess: () => {
                toast("Document has been successfully deleted!", {
                    "type": "success",
                    "position": "bottom-right",
                    "autoClose": 1000,
                    "hideProgressBar": true,
                    "transition": "flip",
                    "dangerouslyHTMLString": true
                })
            },
            onError: (error) => {
                alert('Failed to delete document. Please try again.');
                console.error(error);
            },
        });
    }
};
</script>


<template>
    <AdminLayout title="Documents">
        <div
            class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
            <h1 class="text-2xl font-semibold whitespace-nowrap">Documents</h1>
            <button @click="openDrawerForCreate"
                class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-gray-200 rounded-md shadow hover:bg-opacity-20">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <span>Add Document</span>
            </button>
        </div>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.documents.index" />
        </div>

        <div class="flex flex-col mt-6">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                        <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Type</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Category</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Image</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="document in documents.data" :key="document.id"
                                    class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ document.name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">{{ document.document_type.name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ document.document_category.name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0">
                                            <iframe class="w-24 h-auto border rounded-md"
                                                :src="`/storage/${document.file_path}`" frameborder="0"></iframe>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <button @click="openDrawerForEdit(document)"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                        <button @click="deleteDocument(document.id)"
                                            class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination Component -->
            <Pagination :pagination="documents" />
        </div>
        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? 'Edit Document' : 'Create Document' }}
            </template>
            <template #content>
                <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
                        <div v-if="errorMessage" class="text-red-500 text-sm">
                            {{ errorMessage }}
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" v-model="form.name" id="name"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                                {{ form.errors.name }}
                            </div>
                        </div>
                        <div>
                            <label for="document_category_id" class="block text-sm font-medium text-gray-700">Document
                                Category</label>
                            <select v-model="form.document_category_id" id="document_category"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option v-for="documentCategory in documentCategories" :value="documentCategory.id">
                                    {{ documentCategory.name }}
                                </option>
                            </select>
                            <div v-if="form.errors.document_category_id" class="text-red-500 text-sm mt-1">
                                {{ form.errors.document_category_id }}
                            </div>
                        </div>
                        <div>
                            <label for="document_type_id" class="block text-sm font-medium text-gray-700">Document
                                Type</label>
                            <select v-model="form.document_type_id" id="document_type"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option v-for="documentType in documentTypes" :value="documentType.id">
                                    {{ documentType.name }}
                                </option>
                            </select>
                            <div v-if="form.errors.document_type_id" class="text-red-500 text-sm mt-1">
                                {{ form.errors.document_type_id }}
                            </div>
                        </div>
                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700">File</label>
                            <input type="file" @change="handleFileChange" id="file"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <div v-if="form.errors.file" class="text-red-500 text-sm mt-1">
                                {{ form.errors.file }}
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ isEditMode ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>
                </div>
            </template>
        </Drawer>

    </AdminLayout>
</template>
