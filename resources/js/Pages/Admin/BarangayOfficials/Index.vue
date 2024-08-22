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

const props = defineProps(['officials', 'filters']);

const isDrawerOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    user_id: '',
    full_name: '',
    position: '',
    start_date: '',
    end_date: '',
    contact_number: '',
    email: '',
    address: '',
    role: '',
    profile: '',
    official_photo: null,

});

function openDrawerForCreate() {
    form.clearErrors();
    form.reset();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(official) {
    form.clearErrors();
    form.id = official.id;
    form.full_name = official.full_name;
    form.position = official.position;
    form.start_date = official.start_date;
    form.end_date = official.end_date;
    form.contact_number = official.contact_number;
    form.email = official.email;
    form.address = official.address;
    form.role = official.role;
    form.profile = official.profile;
    form.official_photo = null;
    isEditMode.value = true;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openModalForDelete(official) {
    form.id = official.id;
    form.full_name = official.full_name;
}

function handleFileChange(event) {
    form.official_photo = event.target.files[0];
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(route('admin.barangay-officials.update', form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("Barangay Official has been successfully updated!", {
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
        form.post(route('admin.barangay-officials.store'), {
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

const deleteOfficial = () => {
    form.transform((data) => ({
        ...data,
        _method: 'DELETE',
    })).post(route('admin.barangay-officials.destroy', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Barangay Official has been successfully deleted!", {
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
    <AdminLayout title="Barangay Officials">
        <MainContentHeader>
            <template #title>
                Barangay Officials
            </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" />
                    </template>
                    <template #text>Add Official</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.barangay-officials.index"
                placeholder="Search by full name" />
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
                        <tr v-for="official in officials.data" :key="official.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img :src="`/storage/${official.photo_path}`" alt="Official Photo"
                                            class="w-10 h-10 rounded-full" v-if="official.photo_path" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ official.full_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ official.position }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ official.contact_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ official.email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ official.address }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <Link :href="route('admin.barangay-officials.show', official)"
                                    class="text-green-600 hover:text-teal-900">Show</Link>
                                <button @click="openDrawerForEdit(official)"
                                    class="ml-4 text-teal-600 hover:text-teal-900">Edit</button>
                                <button @click="isDeleteModalOpen = true, openModalForDelete(official)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="officials" />
            </template>
        </TableContainer>

        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? 'Edit Official' : 'Create Official' }}
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
                            <InputLabel for="position" value="Position" />
                            <select v-model="form.position" id="position"
                                class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-full">
                                <option value="Barangay Captain">Barangay Captain</option>
                                <option value="Barangay Kagawad">Barangay Kagawad</option>
                                <option value="SK Chairman/Chairwoman">SK Chairman/Chairwoman</option>
                                <option value="SK Kagawad">SK Kagawad</option>
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
                            <InputLabel for="profile" value="Biographical Sketch" />
                            <Textarea v-model="form.profile" id="profile" :rows="5" :cols="60" />
                            <InputError :message="form.errors.profile" class="mt-2" />
                        </div>
                        <div>
                            <InputLabel for="official_photo" value="Official Photo" />
                            <input type="file" @change="handleFileChange" id="official_photo"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <InputError :message="form.errors.official_photo" class="mt-2" />
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
                <DeleteButton @click.prevent="deleteOfficial"
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
