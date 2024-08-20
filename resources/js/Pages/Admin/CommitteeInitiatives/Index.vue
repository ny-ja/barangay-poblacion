<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import Drawer from '@/Components/Drawer.vue';
import MainContentHeader from '@/Components/MainContentHeader.vue';
import TableContainer from '@/Components/TableContainer.vue';
import ButtonIcon from '@/Components/ButtonIcon.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Icon from '@/Components/Icon.vue';
import { Inertia } from '@inertiajs/inertia';
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';

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
    form.clearErrors();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(initiative) {
    form.clearErrors();
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
    errorMessage.value = false;
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
        <MainContentHeader>
            <template #title>
                Committee Initiatives
            </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" />
                    </template>
                    <template #text>Add Committee Initiative</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.committee-initiatives.index" />
        </div>

        <TableContainer>
            <template #table>
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
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Image</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="initiative in initiatives.data" :key="initiative.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ initiative.title }}</div>
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0">
                                    <img :src="`/storage/${initiative.initiative_photo_path}`" alt="Initiative Photo"
                                        class="w-24 h-auto rounded" v-if="initiative.initiative_photo_path" />
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <Link :href="route('admin.committee-initiatives.show', initiative)"
                                    class="text-green-600 hover:text-teal-900">Show</Link>
                                <button @click="openDrawerForEdit(initiative)"
                                    class="ml-4 text-teal-600 hover:text-teal-900">Edit</button>
                                <button @click="deleteInitiative(initiative.id)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="initiatives" />
            </template>
        </TableContainer>

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
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full"
                                autocomplete="title" />
                            <InputError :message="form.errors.title" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="committee_id" value="Committee" />
                            <select v-model="form.committee_id" id="committee"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option v-for="committee in committees" :value="committee.id">
                                    {{ committee.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.committee_id" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="description" value="Description" />
                            <Textarea v-model="form.description" id="description" :rows="5" :cols="60" />
                            <InputError :message="form.errors.description" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="start_date" value="Start Date" />
                            <TextInput id="start_date" v-model="form.start_date" type="date" class="mt-1 block w-full"
                                autocomplete="start_date" />
                            <InputError :message="form.errors.start_date" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="end_date" value="End Date" />
                            <TextInput id="end_date" v-model="form.end_date" type="date" class="mt-1 block w-full"
                                autocomplete="end_date" />
                            <InputError :message="form.errors.end_date" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="status" value="Status" />
                            <select v-model="form.status" id="status"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Completed">Completed</option>
                                <option value="On Going">On Going</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                            <InputError :message="form.errors.status" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="budget" value="Budget" />
                            <TextInput id="budget" v-model="form.budget" type="number" class="mt-1 block w-full"
                                autocomplete="budget" />
                            <InputError :message="form.errors.budget" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="source" value="Source" />
                            <TextInput id="source" v-model="form.source" type="text" class="mt-1 block w-full"
                                autocomplete="source" />
                            <InputError :message="form.errors.source" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="beneficiaries" value="Beneficiaries" />
                            <TextInput id="beneficiaries" v-model="form.beneficiaries" type="text"
                                class="mt-1 block w-full" autocomplete="beneficiaries" />
                            <InputError :message="form.errors.beneficiaries" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="contact_person" value="Contact Person" />
                            <TextInput id="contact_person" v-model="form.contact_person" type="text"
                                class="mt-1 block w-full" autocomplete="contact_person" />
                            <InputError :message="form.errors.contact_person" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="remarks" value="Remarks" />
                            <TextInput id="remarks" v-model="form.remarks" type="text" class="mt-1 block w-full"
                                autocomplete="remarks" />
                            <InputError :message="form.errors.remarks" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="initiative_photo" value="Initiative Photo" />
                            <input type="file" @change="handleFileChange" id="initiative_photo"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.initiative_photo" class="mt-2" />
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
    </AdminLayout>
</template>
