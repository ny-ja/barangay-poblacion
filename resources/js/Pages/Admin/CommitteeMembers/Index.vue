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

const props = defineProps(['members', 'committees', 'filters']);

const isDrawerOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    user_id: '',
    committee_id: '',
    full_name: '',
    position: '',
    start_date: '',
    end_date: '',
    contact_number: '',
    email: '',
    address: '',
    role: '',
    profile: '',
    member_photo: null,

});

function openDrawerForCreate() {
    form.reset();
    isEditMode.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(member) {
    form.id = member.id;
    form.committee_id = member.committee_id,
    form.full_name = member.full_name;
    form.position = member.position;
    form.start_date = member.start_date;
    form.end_date = member.end_date;
    form.contact_number = member.contact_number;
    form.email = member.email;
    form.address = member.address;
    form.role = member.role;
    form.profile = member.profile;
    form.member_photo = null;
    isEditMode.value = true;
    isDrawerOpen.value = true;
}

function handleFileChange(event) {
    form.member_photo = event.target.files[0];
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(route('admin.committee-members.update', form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("Committee Member has been successfully updated!", {
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
        form.post(route('admin.committee-members.store'), {
            forceFormData: true,
            onSuccess: () => {
                toast("Committee Member has been successfully created!", {
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

const deleteMember = (memberId) => {
    if (confirm('Are you sure you want to delete this member?')) {
        Inertia.delete(route('admin.committee-members.destroy', memberId), {
            onSuccess: () => {
                toast("Committee member has been successfully deleted!", {
                    "type": "success",
                    "position": "bottom-right",
                    "autoClose": 1000,
                    "hideProgressBar": true,
                    "transition": "flip",
                    "dangerouslyHTMLString": true
                })
            },
            onError: (error) => {
                alert('Failed to delete news. Please try again.');
                console.error(error);
            },
        });
    }
};
</script>


<template>
    <AdminLayout title="Committee Members">
        <div
            class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
            <h1 class="text-2xl font-semibold whitespace-nowrap">Committee Members</h1>
            <button @click="openDrawerForCreate"
                class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-gray-200 rounded-md shadow hover:bg-opacity-20">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <span>Add Member</span>
            </button>
        </div>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.committee-members.index" />
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
                                        Full Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Contact</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Email</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Address</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="member in members.data" :key="member.id"
                                    class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <img :src="`/storage/${member.member_photo_path}`" alt="Member Photo"
                                                    class="w-10 h-10 rounded-full" v-if="member.member_photo_path" />
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ member.full_name }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ member.committee.name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">{{ member.contact_number }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ member.email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ member.address }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <Link :href="route('admin.committee-members.show', member)"
                                            class="text-green-600 hover:text-indigo-900">Show</Link>
                                        <button @click="openDrawerForEdit(member)"
                                            class="ml-4 text-yellow-600 hover:text-indigo-900">Edit</button>
                                        <button @click="deleteMember(member.id)"
                                            class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination Component -->
            <Pagination :pagination="members" />
        </div>
        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? 'Edit Member' : 'Create Member' }}
            </template>
            <template #content>
                <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
                        <div v-if="errorMessage" class="text-red-500 text-sm">
                            {{ errorMessage }}
                        </div>
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" v-model="form.full_name" id="full_name"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <div v-if="form.errors.full_name" class="text-red-500 text-sm mt-1">
                                {{ form.errors.full_name }}
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
                            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                            <select v-model="form.position" id="position"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="Committee Chairman/Chairwoman">Committee Chairman/Chairwoman</option>
                                <option value="Committee Member">Committee Member</option>
                            </select>
                            <div v-if="form.errors.position" class="text-red-500 text-sm mt-1">
                                {{ form.errors.position }}
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
                            <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact
                                Number</label>
                            <input type="text" v-model="form.contact_number" id="contact_number"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.contact_number" class="text-red-500 text-sm mt-1">
                                {{ form.errors.contact_number }}
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" v-model="form.email" id="email"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                                {{ form.errors.email }}
                            </div>
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" v-model="form.address" id="address"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.address" class="text-red-500 text-sm mt-1">
                                {{ form.errors.address }}
                            </div>
                        </div>
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <input type="text" v-model="form.role" id="role"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></input>
                            <div v-if="form.errors.role" class="text-red-500 text-sm mt-1">
                                {{ form.errors.role }}
                            </div>
                        </div>
                        <div>
                            <label for="profile" class="block text-sm font-medium text-gray-700">Biographical
                                Sketch</label>
                            <textarea type="text" v-model="form.profile" id="profile"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            <div v-if="form.errors.profile" class="text-red-500 text-sm mt-1">
                                {{ form.errors.profile }}
                            </div>
                        </div>
                        <div>
                            <label for="member_photo" class="block text-sm font-medium text-gray-700">Committee Member
                                Photo</label>
                            <input type="file" @change="handleFileChange" id="member_photo"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <div v-if="form.errors.member_photo" class="text-red-500 text-sm mt-1">
                                {{ form.errors.member_photo }}
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
