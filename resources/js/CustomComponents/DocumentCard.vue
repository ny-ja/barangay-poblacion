<template>
    <div class="p-4 md:1/3">
        <div class="h-full px-6 py-6 border-2 border-gray-300 rounded-lg overflow-hidden shadow-lg">
            <div :style="{ backgroundImage: `url(/storage/${document.background_image_path})` }"
                class="image-container object-contain w-full h-40 px-40 bg-center bg-no-repeat bg-transparent bg-blend-multiply overflow-hidden flex items-center justify-center relative">
                <div class="icon-container bg-gray-800 opacity-60 px-5 py-5 rounded-full">
                    <Icon name="chevron_double_down" :classes="'size-6'" stroke="white" />
                </div>
            </div>
            <div class="flex justify-between items-center pt-4">
                <div class="flex gap-3">
                    <button @click="viewPDF(document.file_path)"
                        class="p-2 bg-amber-400 rounded-md hover:bg-amber-300 transition duration-300">
                        <Icon name="view" :classes="'size-5'" fill="white" stroke="none" />
                    </button>
                    <button @click="downloadPDF(document.file_path)"
                        class="p-2 bg-teal-800 rounded-md hover:bg-teal-700 transition duration-300">
                        <Icon name="download" :classes="'size-5'" fill="white" stroke="white" />
                    </button>
                </div>
                <h1 class="title-font text-lg font-medium text-gray-900 mb-0">
                    {{ document.name }}
                </h1>
            </div>
        </div>
    </div>
</template>

<script setup>
import Icon from '@/Components/Icon.vue';

const props = defineProps({
    document: Object
});

const viewPDF = (filePath) => {
    window.open(`/storage/${filePath}`, '_blank');
}

const downloadPDF = (filePath) => {
    const url = encodeURI(`/storage/${filePath}`);
    const link = document.createElement('a');
    link.href = url;
    link.download = filePath.substring(filePath.lastIndexOf('/') + 1);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>

<style scoped>
.image-container {
    background-position: top;
    background-size: cover;
    transition: background-position 1s ease-in-out;
    position: relative;
}

.image-container:hover {
    background-position: center bottom;
}

.icon-container {
    transition: transform 1s ease-in-out, opacity 1s ease-in-out;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.image-container:hover .icon-container {
    transform: translate(-50%, calc(-50% + 50px));
    opacity: 0;
}
</style>
