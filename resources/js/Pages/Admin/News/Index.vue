<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import Drawer from '@/Components/Drawer.vue';
import { Inertia } from '@inertiajs/inertia';
import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css';

const props = defineProps(['news', 'newsCategories', 'filters']);

const isDrawerOpen = ref(false);
const isEditMode = ref(false);
const errorMessage = ref('');

const form = useForm({
    id: null,
    title: '',
    description: '',
    news_photo: null,
    user_id: '',
    news_category_id: '',
});

function openDrawerForCreate() {
    form.reset();
    isEditMode.value = false;
    isDrawerOpen.value = true;
}

function openDrawerForEdit(news) {
    form.id = news.id;
    form.title = news.title;
    form.description = news.description;
    form.news_photo = null;
    form.news_category_id = news.news_category_id;
    isEditMode.value = true;
    isDrawerOpen.value = true;
}

function handleFileChange(event) {
    form.news_photo = event.target.files[0];
}

function submit() {
    if (isEditMode.value) {
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(route('admin.news.update', form.id), {
            forceFormData: true,
            onSuccess: () => {
                toast("News has been successfully updated!", {
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
        form.post(route('admin.news.store'), {
            forceFormData: true,
            onSuccess: () => {
                toast("News has been successfully created!", {
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

const deleteNews = (newsId) => {
    if (confirm('Are you sure you want to delete this news?')) {
        Inertia.delete(route('admin.news.destroy', newsId), {
            onSuccess: () => {
                toast("News has been successfully deleted!", {
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
    <AdminLayout title="News">
        <div
            class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
            <h1 class="text-2xl font-semibold whitespace-nowrap">News</h1>
            <button @click="openDrawerForCreate"
                class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-gray-200 rounded-md shadow hover:bg-opacity-20">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <span>Add News</span>
            </button>
        </div>

        <!-- Search Form -->
        <div class="mt-4">
            <SearchForm :filters="filters" routeName="admin.news.index" />
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
                                        Category</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Image</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="news_item in news.data" :key="news_item.id"
                                    class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ news_item.title }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">{{ news_item.description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ news_item.news_category.name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0">
                                            <img :src="`/storage/${news_item.news_photo_path}`" alt="News Photo"
                                                class="w-24 h-auto rounded" v-if="news_item.news_photo_path" />
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <button @click="openDrawerForEdit(news_item)"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                        <button @click="deleteNews(news_item.id)"
                                            class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination Component -->
            <Pagination :pagination="news" />
        </div>
        <Drawer :isOpen="isDrawerOpen" @close="isDrawerOpen = false">
            <template #title>
                {{ isEditMode ? 'Edit News' : 'Create News' }}
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
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea type="text" v-model="form.description" id="description"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">
                                {{ form.errors.description }}
                            </div>
                        </div>
                        <div>
                            <label for="news_category_id" class="block text-sm font-medium text-gray-700">News
                                Category</label>
                            <select v-model="form.news_category_id" id="news_category"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option v-for="newsCategory in newsCategories" :value="newsCategory.id">
                                    {{ newsCategory.name }}
                                </option>
                            </select>
                            <div v-if="form.errors.news_category_id" class="text-red-500 text-sm mt-1">
                                {{ form.errors.news_category_id }}
                            </div>
                        </div>
                        <div>
                            <label for="news_photo" class="block text-sm font-medium text-gray-700">News
                                Photo</label>
                            <input type="file" @change="handleFileChange" id="news_photo"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <div v-if="form.errors.news_photo" class="text-red-500 text-sm mt-1">
                                {{ form.errors.news_photo }}
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
