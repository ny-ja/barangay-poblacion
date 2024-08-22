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
import Textarea from '@/Components/Textarea.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DeleteConfirmation from '@/Components/DeleteConfirmation.vue';

const props = defineProps(['committees', 'filters']);

const isDrawerOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    user_id: '',
    name: '',
    committee_profile: '',
    start_date: '',
    end_date: '',
    contact_number: '',
    committee_profile_photo: null,

});

function openDrawerForCreate() {
    form.reset();
    form.clearErrors();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(committee) {
    form.clearErrors();
    form.id = committee.id;
    form.name = committee.name;
    form.committee_profile = committee.committee_profile;
    form.start_date = committee.start_date;
    form.end_date = committee.end_date;
    form.contact_number = committee.contact_number;
    form.committee_profile_photo = null;
    isEditMode.value = true;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openModalForDelete(committee) {
    form.id = committee.id;
    form.name = committee.name;
}

function handleFileChange(event) {
    form.committee_profile_photo = event.target.files[0];
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(route('admin.committees.update', form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("Committee has been successfully updated!", {
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
        form.post(route('admin.committees.store'), {
            forceFormData: true,
            onSuccess: () => {
                toast("Barangay Official has been successfully created!", {
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

const deleteCommittee = (committeeId) => {
    form.transform((data) => ({
        ...data,
        _method: 'DELETE',
    })).post(route('admin.committees.destroy', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("News has been successfully deleted!", {
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
    <AdminLayout title="Committees">
        <MainContentHeader>
            <template #title>
                Committees
            </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" />
                    </template>
                    <template #text>Add Committee</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.committees.index" placeholder="Search by name" />
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
                                Committee Profile</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Date Started</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="committee in committees.data" :key="committee.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img :src="`/storage/${committee.committee_profile_photo_path}`"
                                            alt="Committee Profile Photo" class="w-10 h-10 rounded-full"
                                            v-if="committee.committee_profile_photo_path" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ committee.name }}</div>
                                        <div class="text-sm text-gray-500">{{ committee.contact_number }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ committee.committee_profile }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ committee.start_date }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <button @click="openDrawerForEdit(committee)"
                                    class="text-teal-600 hover:text-teal-900">Edit</button>
                                <button @click="isDeleteModalOpen = true, openModalForDelete(committee)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="committees" />
            </template>
        </TableContainer>

        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? 'Edit Committee' : 'Create Committee' }}
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
                            <InputLabel for="committee_profile" value="Committee Profile" />
                            <Textarea v-model="form.committee_profile" id="committee_profile" :rows="5" :cols="60" />
                            <InputError :message="form.errors.committee_profile" class="mt-2" />
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
                            <InputLabel for="committee_profile_photo" value="Committee Profile Photo" />
                            <input type="file" @change="handleFileChange" id="committee_profile_photo"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.committee_profile_photo" class="mt-2" />
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
                delete <span class="font-bold">{{ form.name }}</span> committee?
            </template>
            <template #button>
                <DeleteButton @click.prevent="deleteCommittee"
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
