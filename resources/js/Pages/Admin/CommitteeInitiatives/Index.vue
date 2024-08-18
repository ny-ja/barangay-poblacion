<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import Drawer from '@/Components/Drawer.vue';
import { Inertia } from '@inertiajs/inertia';
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';

const props = defineProps(['initiatives', 'committees', 'filters']);

const isDrawerOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    user_id: '',
    committee_id: '',
    title: '',
    description: '',
    start_date: '',
    end_date: '',
    status: '',
    budget: '',
    source: '',
    beneficiaries: '',
    contact_person: '',
    remarks: '',
    initiative_photo: null,

});

function openDrawerForCreate() {
    form.reset();
    isEditMode.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(initiative) {
    form.id = initiative.id;
    form.committee_id = initiative.committee_id,
    form.title = initiative.title;
    form.description = initiative.description;
    form.start_date = initiative.start_date;
    form.end_date = initiative.end_date;
    form.status = initiative.status;
    form.budget = initiative.budget;
    form.source = initiative.source;
    form.beneficiaries = initiative.beneficiaries;
    form.contact_person = initiative.contact_person;
    form.remarks = initiative.remarks;
    form.initiative_photo = null;
    isEditMode.value = true;
    isDrawerOpen.value = true;
}

function handleFileChange(event) {
    form.initiative_photo = event.target.files[0];
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(route('admin.committee-initiatives.update', form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("Committee Initiative has been successfully updated!", {
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
        form.post(route('admin.committee-initiatives.store'), {
            forceFormData: true,
            onSuccess: () => {
                toast("Committee Initiative has been successfully created!", {
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

const deleteInitiative = (initiativeId) => {
    if (confirm('Are you sure you want to delete this initiative?')) {
        Inertia.delete(route('admin.committee-initiatives.destroy', initiativeId), {
            onSuccess: () => {
                toast("Committee initiative has been successfully deleted!", {
                    "type": "success",
                    "position": "bottom-right",
                    "autoClose": 1000,
                    "hideProgressBar": true,
                    "transition": "flip",
                    "dangerouslyHTMLString": true
                })
            },
            onError: (error) => {
                alert('Failed to delete initiative. Please try again.');
                console.error(error);
            },
        });
    }
};
</script>


<template>
    <AdminLayout title="Committee Initiatives">
        <div
            class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
            <h1 class="text-2xl font-semibold whitespace-nowrap">Committee Initiatives</h1>
            <button @click="openDrawerForCreate"
                class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-gray-200 rounded-md shadow hover:bg-opacity-20">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <span>Add Initiative</span>
            </button>
        </div>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.committee-initiatives.index" />
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
                                        Title</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Description</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Contact Person</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Status</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="initiative in initiatives.data" :key="initiative.id"
                                    class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <img :src="`/storage/${initiative.initiative_photo_path}`" alt="initiative Photo"
                                                    class="w-10 h-10 rounded-full" v-if="initiative.initiative_photo_path" />
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ initiative.title }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ initiative.committee.name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">{{ initiative.description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ initiative.contact_person }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ initiative.status }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <Link :href="route('admin.committee-initiatives.show', initiative)"
                                            class="text-green-600 hover:text-indigo-900">Show</Link>
                                        <button @click="openDrawerForEdit(initiative)"
                                            class="ml-4 text-indigo-600 hover:text-indigo-900">Edit</button>
                                        <button @click="deleteInitiative(initiative.id)"
                                            class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination Component -->
            <Pagination :pagination="initiatives" />
        </div>
        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? 'Edit Initiative' : 'Create Initiative' }}
            </template>
            <template #content>
                <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
                        <div v-if="errorMessage" class="text-red-500 text-sm">
                            {{ errorMessage }}
                        </div>
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" v-model="form.title" id="title"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">
                                {{ form.errors.title }}
                            </div>
                        </div>
                        <div>
                            <label for="committee_id" class="block text-sm font-medium text-gray-700">Committee</label>
                            <select v-model="form.committee_id" id="committee"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option v-for="committee in committees" :value="committee.id">
                                    {{ committee.name }}
                                </option>
                            </select>
                            <div v-if="form.errors.committee_id" class="text-red-500 text-sm mt-1">
                                {{ form.errors.committee_id }}
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea type="text" v-model="form.description" id="description"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">
                                {{ form.errors.description }}
                            </div>
                        </div>
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" v-model="form.start_date" id="start_date"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.start_date" class="text-red-500 text-sm mt-1">
                                {{ form.errors.start_date }}
                            </div>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" v-model="form.end_date" id="end_date"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.end_date" class="text-red-500 text-sm mt-1">
                                {{ form.errors.end_date }}
                            </div>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <input type="text" v-model="form.status" id="status"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.status" class="text-red-500 text-sm mt-1">
                                {{ form.errors.status }}
                            </div>
                        </div>
                        <div>
                            <label for="budget" class="block text-sm font-medium text-gray-700">budget</label>
                            <input type="number" v-model="form.budget" id="budget"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.budget" class="text-red-500 text-sm mt-1">
                                {{ form.errors.budget }}
                            </div>
                        </div>
                        <div>
                            <label for="source" class="block text-sm font-medium text-gray-700">Source</label>
                            <input type="text" v-model="form.source" id="source"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.source" class="text-red-500 text-sm mt-1">
                                {{ form.errors.source }}
                            </div>
                        </div>
                        <div>
                            <label for="beneficiaries" class="block text-sm font-medium text-gray-700">Beneficiaries</label>
                            <input type="text" v-model="form.beneficiaries" id="beneficiaries"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.beneficiaries" class="text-red-500 text-sm mt-1">
                                {{ form.errors.beneficiaries }}
                            </div>
                        </div>
                        <div>
                            <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person</label>
                            <input type="text" v-model="form.contact_person" id="contact_person"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.contact_person" class="text-red-500 text-sm mt-1">
                                {{ form.errors.contact_person }}
                            </div>
                        </div>
                        <div>
                            <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                            <textarea type="text" v-model="form.remarks" id="remarks"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            <div v-if="form.errors.remarks" class="text-red-500 text-sm mt-1">
                                {{ form.errors.remarks }}
                            </div>
                        </div>
                        <div>
                            <label for="initiative_photo" class="block text-sm font-medium text-gray-700">Committee Initiative
                                Photo</label>
                            <input type="file" @change="handleFileChange" id="initiative_photo"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <div v-if="form.errors.initiative_photo" class="text-red-500 text-sm mt-1">
                                {{ form.errors.initiative_photo }}
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
