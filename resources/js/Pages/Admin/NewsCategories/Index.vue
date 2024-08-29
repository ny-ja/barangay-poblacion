<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
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

const props = defineProps(['categories']);

const isDrawerOpen = ref(false);
const isDeleteModalOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    name: '',
});

function openDrawerForCreate() {
    form.reset();
    form.clearErrors();
    isEditMode.value = false;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(category) {
    form.clearErrors();
    form.id = category.id;
    form.name = category.name;
    isEditMode.value = true;
    errorMessage.value = false;
    isDrawerOpen.value = true;
}

function openModalForDelete(category) {
    form.id = category.id;
    form.name = category.name;
}

function submit() {
    if (isEditMode.value) {
        form.put(route('admin.news-categories.update', form.id), {
            onSuccess: () => {
                toast("News category has been successfully updated!", {
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
        form.post(route('admin.news-categories.store'), {
            onSuccess: () => {
                toast("News category has been successfully created!", {
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

const deleteCategory = () => {
    form.transform((data) => ({
        ...data,
        _method: 'DELETE',
    })).post(route('admin.news-categories.destroy', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("News Category has been successfully deleted!", {
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
    <AdminLayout title="News Categories">
        <MainContentHeader>
            <template #title>
                News Categories
            </template>
            <template #buttons>
                <ButtonIcon @click="openDrawerForCreate">
                    <template #icon>
                        <Icon name="plus" :classes="'size-6'" stroke="white" fill="none" stroke_width="1.5" />
                    </template>
                    <template #text>Add News Category</template>
                </ButtonIcon>
            </template>
        </MainContentHeader>

        <TableContainer>
            <template #table>
                <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                News Category ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                News Category Name</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="category in categories.data" :key="category.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ category.id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ category.name }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <button @click="openDrawerForEdit(category)"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <button @click="isDeleteModalOpen = true, openModalForDelete(category)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="categories" />
            </template>
        </TableContainer>

        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? 'Edit News Category' : 'Create News Category' }}
            </template>
            <template #content>
                <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <form @submit.prevent="submit" class="space-y-4">
                        <div v-if="errorMessage" class="text-red-500 text-sm">
                            {{ errorMessage }}
                        </div>
                        <div>
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                autocomplete="name" />
                            <InputError :message="form.errors.name" class="mt-2" />
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
                delete <span class="font-bold">{{ form.name }}</span> category?
            </template>
            <template #button>
                <DeleteButton @click.prevent="deleteCategory"
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
