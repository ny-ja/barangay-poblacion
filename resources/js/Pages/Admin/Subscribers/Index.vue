<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import MainContentHeader from '@/Components/MainContentHeader.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TableContainer from '@/Components/TableContainer.vue';
import { Inertia } from '@inertiajs/inertia';
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DeleteConfirmation from '@/Components/DeleteConfirmation.vue';

const props = defineProps(['subscribers', 'filters']);

const isDeleteModalOpen = ref(false);

const form = useForm({
    id: null,
    name: '',
});

function openModalForDelete(subscriber) {
    form.id = subscriber.id;
    form.name = subscriber.name;
}

const deleteSubscriber = () => {
    form.transform((data) => ({
        ...data,
        _method: 'DELETE',
    })).post(route('admin.subscribers.destroy', form.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Subscriber has been successfully deleted!", {
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
    <AdminLayout title="Subscribers">
        <MainContentHeader>
            <template #title>
                Subscribers
            </template>
        </MainContentHeader>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.subscribers.index" placeholder="Search by name" />
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
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="subscriber in subscribers.data" :key="subscriber.id"
                            class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ subscriber.name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ subscriber.email }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <button @click="isDeleteModalOpen = true, openModalForDelete(subscriber)"
                                    class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #pagination>
                <Pagination :pagination="subscribers" />
            </template>
        </TableContainer>

        <DeleteConfirmation :isOpen="isDeleteModalOpen" @close="isDeleteModalOpen = false">
            <template #message>
                Are you sure you want to
                delete <span class="font-bold">{{ form.name }}</span>?
            </template>
            <template #button>
                <PrimaryButton @click.prevent="deleteSubscriber"
                    class="ms-4 bg-red-800  hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Yes, I'm sure
                </PrimaryButton>
                <SecondaryButton @click="isDeleteModalOpen = false" class="ms-4">
                    Cancel
                </SecondaryButton>
            </template>
        </DeleteConfirmation>
    </AdminLayout>
</template>
