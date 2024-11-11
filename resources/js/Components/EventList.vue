<template>
    <div class="card">
        <!-- Título da lista de eventos -->
        <h2 class="text-lg font-bold mb-4">Eventos</h2>

        <!-- Lista de eventos -->
        <div v-if="events.length" class="flex flex-wrap">
            <div v-for="event in events" :key="event.id" class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                <!-- Card de evento -->
                <div class="bg-gray-100 rounded p-4">
                    <h3 class="font-semibold">{{ event.name }}</h3>
                    <div>{{ formatCurrency(event.price) }}</div>
                    <div>{{ event.location }}</div>
                    <img :src="`/${event.image}`" :alt="event.name" class="w-24 rounded mt-2" />
                </div>
            </div>
        </div>

        <!-- Mensagem caso não haja eventos -->
        <p v-else>Não há eventos disponíveis.</p>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    props: {
        events: Array,
    },
    setup(props) {
        const events = ref(props.events);

        const formatCurrency = (value) => {
            return value ? value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) : '-';
        };

        return { events, formatCurrency };
    },
};
</script>

<style scoped>
.card {
    padding: 1.5rem;
    width: 100%;
    overflow-x: auto;
}

.bg-gray-100 {
    background-color: #f7fafc;
}

.rounded {
    border-radius: 0.375rem;
}
</style>
