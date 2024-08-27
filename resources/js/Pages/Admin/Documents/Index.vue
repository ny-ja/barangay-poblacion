<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import Drawer from '@/Components/Drawer.vue';
import MainContentHeader from '@/Components/MainContentHeader.vue';
import TableContainer from '@/Components/TableContainer.vue';
import ButtonIcon from '@/Components/ButtonIcon.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Icon from '@/Components/Icon.vue';
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DeleteConfirmation from '@/Components/DeleteConfirmation.vue';

const props = defineProps(['documents', 'documentCategories', 'documentTypes', 'filters']);

const isDrawerOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    name: '',
    file: null,
    background_image: null,
    user_id: '',
    document_category_id: '',
    document_type_id: '',
});

function openDrawerForCreate() {
    form.reset();
    form.clearErrors();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(document) {
    form.clearErrors();
    form.id = document.id;
    form.name = document.name;
    form.file = null;
    form.background_image = null;
    form.document_category_id = document.document_category_id;
    form.document_type_id = document.document_type_id;
    isEditMode.value = true;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openModalForDelete(document) {
    form.id = document.id;
    form.name = document.name;
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
    form.transform((data) => ({
        ...data,
        _method: 'DELETE',
    })).post(route('admin.documents.destroy', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Document has been successfully deleted!", {
                "type": "success",
                "position": "bottom-right",
                "autoClose": 1000,
                "hideProgressBar": true,
                "transition": "flip",
                "dangerouslyHTMLString": true
            })
            form.reset();
            isDeleteModalOpen.value = false;
        }
    });
};
</script>


<template>
    <AdminLayout title="Barangay Documents">
        <MainContentHeader>
            <template #title>
                Barangay Documents
            </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" />
                    </template>
                    <template #text>Add Document</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.documents.index" placeholder="Search by name" />
        </div>

        <TableContainer>
            <template #table>
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
                                Document</th>
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
                                    <img :src="`/storage/${document.background_image_path}`" alt="Document image"
                                        class="w-24 h-auto rounded" v-if="document.background_image_path" />
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <button @click="openDrawerForEdit(document)"
                                    class="text-teal-600 hover:text-teal-900">Edit</button>
                                <button @click="isDeleteModalOpen = true, openModalForDelete(document)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="documents" />
            </template>
        </TableContainer>

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
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                autocomplete="name" />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="document_category_id" value="Document Category" />
                            <select v-model="form.document_category_id" id="document_category"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option v-for="documentCategory in documentCategories" :value="documentCategory.id">
                                    {{ documentCategory.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.document_category_id" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="document_type_id" value="Document Type" />
                            <select v-model="form.document_type_id" id="document_type"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option v-for="documentType in documentTypes" :value="documentType.id">
                                    {{ documentType.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.document_type_id" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="file" value="File" />
                            <input type="file" @input="form.file = $event.target.files[0]" id="file"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.file" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="background_image" value="Document background image" />
                            <input type="file" @input="form.background_image = $event.target.files[0]" id="background_image"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.background_image" class="mt-2" />
                        </div>
                        <div class="flex justify-end">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                {{ isEditMode ? 'Update' : 'Create' }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </template>
        </Drawer>

        <DeleteConfirmation :isOpen="isDeleteModalOpen" @close="isDeleteModalOpen = false">
            <template #message>
                Are you sure you want to
                delete <span class="font-bold">{{ form.name }}</span>?
            </template>
            <template #button>
                <DeleteButton @click.prevent="deleteDocument"
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Yes, I'm sure
                </DeleteButton>
                <SecondaryButton @click="isDeleteModalOpen = false" class="ms-4">
                    Cancel
                </SecondaryButton>
            </template>
        </DeleteConfirmation>

    </AdminLayout>
</template>
