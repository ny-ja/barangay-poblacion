<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import MainContentHeader from '@/Components/MainContentHeader.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import TableContainer from '@/Components/TableContainer.vue';
import { useForm } from '@inertiajs/vue3';
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DeleteConfirmation from '@/Components/DeleteConfirmation.vue';

const props = defineProps(['feedback', 'filters']);

const isDeleteModalOpen = ref(false);

const form = useForm({
    id: null,
    name: '',
});

function openModalForDelete(feedback_item) {
    form.id = feedback_item.id;
    form.name = feedback_item.name;
}

const deleteFeedback = () => {
    form.transform((data) => ({
        ...data,
        _method: 'DELETE',
    })).post(route('admin.feedback.destroy', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Feedback has been successfully deleted!", {
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
    <AdminLayout title="Feedback">
        <MainContentHeader>
            <template #title>
                Feedback
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.feedback.index" placeholder="Search by name" />
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
                                Email</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Message</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="feedback_item in feedback.data" :key="feedback_item.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ feedback_item.name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ feedback_item.email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ feedback_item.message }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <button @click="isDeleteModalOpen = true, openModalForDelete(feedback_item)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="feedback" />
            </template>
        </TableContainer>

        <DeleteConfirmation :isOpen="isDeleteModalOpen" @close="isDeleteModalOpen = false">
            <template #message>
                Are you sure you want to
                delete <span class="font-bold">{{ form.name }}'s</span> feedback?
            </template>
            <template #button>
                <DeleteButton @click.prevent="deleteFeedback"
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
