<template>
    <div>
        <!-- Botão para abrir o formulário -->
        <button @click="openForm" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Adicionar Evento
        </button>

        <!-- Condicional para mostrar o formulário -->
        <EventForm v-if="formVisible" @close="closeForm" />
    </div>
</template>

<script>
import { ref } from 'vue';
import EventForm from './EventForm.vue';  // Importe o componente do formulário

export default {
    components: {
        EventForm,
    },
    setup() {
        const formVisible = ref(false);  // Controle de visibilidade do formulário

        // Função para abrir o formulário
        const openForm = () => {
            formVisible.value = true;
        };

        // Função para fechar o formulário
        const closeForm = () => {
            formVisible.value = false;
        };

        return {
            formVisible,
            openForm,
            closeForm,
        };
    },
};
</script>
