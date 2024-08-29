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
import DeleteButton from '@/Components/DeleteButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Icon from '@/Components/Icon.vue';
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DeleteConfirmation from '@/Components/DeleteConfirmation.vue';

const props = defineProps(['members', 'committees', 'filters']);

const isDrawerOpen = ref(false);
const isDeleteModalOpen = ref(false);
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
    form.clearErrors();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(member) {
    form.clearErrors();
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
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openModalForDelete(member) {
    form.id = member.id;
    form.full_name = member.full_name;
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

const deleteMember = () => {
    form.transform((data) => ({
        ...data,
        _method: 'DELETE',
    })).post(route('admin.committee-members.destroy', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Committee Member has been successfully deleted!", {
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
    <AdminLayout title="Committee Members">
        <MainContentHeader>
            <template #title>
                Committee Members
            </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </template>
                    <template #text>Add Committee Member</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.committee-members.index" placeholder="Search by full name" />
        </div>

        <TableContainer>
            <template #table>
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
                                    class="text-green-600 hover:text-teal-900">Show</Link>
                                <button @click="openDrawerForEdit(member)"
                                    class="ml-4 text-yellow-600 hover:text-teal-900">Edit</button>
                                <button @click="isDeleteModalOpen = true, openModalForDelete(member)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="members" />
            </template>
        </TableContainer>

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
                            <InputLabel for="full_name" value="Full Name" />
                            <TextInput id="full_name" v-model="form.full_name" type="text" class="mt-1 block w-full"
                                autocomplete="full_name" />
                            <InputError :message="form.errors.full_name" class="mt-2" />
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
                            <InputLabel for="position" value="Position" />
                            <select v-model="form.position" id="position"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Committee Chairman/Chairwoman">Committee Chairman/Chairwoman</option>
                                <option value="Committee Member">Committee Member</option>
                            </select>
                            <InputError :message="form.errors.position" class="mt-2" />
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
                            <InputLabel for="contact_number" value="Contact Number" />
                            <TextInput id="contact_number" v-model="form.contact_number" type="text"
                                class="mt-1 block w-full" autocomplete="contact_number" />
                            <InputError :message="form.errors.contact_number" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full"
                                autocomplete="email" />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="address" value="Address" />
                            <TextInput id="address" v-model="form.address" type="text" class="mt-1 block w-full"
                                autocomplete="address" />
                            <InputError :message="form.errors.address" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="role" value="Role" />
                            <TextInput id="role" v-model="form.role" type="text" class="mt-1 block w-full"
                                autocomplete="role" />
                            <InputError :message="form.errors.role" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="profile" value="Profile" />
                            <Textarea v-model="form.profile" id="profile" :rows="5" :cols="60" />
                            <InputError :message="form.errors.profile" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="member_photo" value="Committee Member Photo" />
                            <input type="file" @change="handleFileChange" id="member_photo"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.member_photo" class="mt-2" />
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
                delete <span class="font-bold">{{ form.full_name }}</span>?
            </template>
            <template #button>
                <DeleteButton @click.prevent="deleteMember"
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
