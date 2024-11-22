<script setup>
import BarChart from '@/ChartComponents/BarChart.vue';
import PieChart from '@/ChartComponents/PieChart.vue';
import DoughnutChart from '@/ChartComponents/DoughnutChart.vue';

const props = defineProps({
    chartTitle: String,
    labels: Array,
    data: Object,
    backgroundColor: Array,
    chartType: String,
});

const chartData = {
    labels: props.labels,
    datasets: [
        {
            data: props.data,
            backgroundColor: props.backgroundColor,
        }
    ]
}

const chartOptions = {
    // Add any additional options if needed
}

const chartTitle = props.chartTitle;
</script>

<template>
    <div v-if="chartType === 'Bar'">
        <BarChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>
    <div v-else-if="chartType === 'Pie'">
        <PieChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>
    <div v-else-if="chartType === 'Doughnut'">
        <DoughnutChart :data="chartData" :options="chartOptions" :title="chartTitle" />
    </div>

</template>