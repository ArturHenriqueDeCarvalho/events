<template>
    <div class="card">
        <h2 class="text-lg font-bold mb-4">Eventos para Hoje</h2>
        <div v-if="eventsToday.length" class="flex flex-wrap">
            <div v-for="event in eventsToday" :key="event.id" class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                <div class="bg-gray-100 rounded p-4">
                    <h3 class="font-semibold">{{ event.name }}</h3>
                    <div>{{ event.location }}</div>
                    <img :src="`/${event.image}`" :alt="event.description" class="w-24 rounded mt-2" />
                </div>
            </div>
        </div>
        <p v-else>Não há eventos programados para hoje.</p>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    setup() {
        const eventsToday = ref([]);

        const fetchTodayEvents = async () => {
            const response = await fetch('/api/events/today');
            eventsToday.value = await response.json();
        };

        const formatCurrency = (value) => {
            return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        };

        onMounted(fetchTodayEvents);

        return {
            eventsToday,
            formatCurrency,
        };
    },
};
</script>

<style scoped>
.card {
    padding: 1rem;
    border: 1px solid #e0e0e0;
    border-radius: 0.5rem;
    background-color: #ffffff;
}
</style>
