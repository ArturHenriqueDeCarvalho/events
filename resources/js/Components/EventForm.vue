<template>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Cadastrar Novo Evento</h2>
            <form @submit.prevent="submitForm">
                <!-- Nome do Evento -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" id="name" v-model="event.name"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Descrição do Evento -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea id="description" v-model="event.description"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        rows="4" required></textarea>
                </div>

                <!-- Localização -->
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Localização</label>
                    <input type="text" id="location" v-model="event.location"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Preço -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Preço</label>
                    <input type="number" id="price" v-model="event.price"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Data do Evento -->
                <div class="mb-4">
                    <label for="event_date" class="block text-sm font-medium text-gray-700">Data do Evento</label>
                    <input type="date" id="event_date" v-model="event.event_date"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Imagem -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Imagem</label>
                    <input type="file" id="image" @change="handleImageChange"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Botões -->
                <div class="flex gap-4">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Salvar
                    </button>
                    <button type="button" @click="closeForm"
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    setup(_, { emit }) {
        const event = ref({
            name: '',
            description: '',  // Novo campo de descrição
            location: '',
            price: 0,
            event_date: '',
            image: null,
        });

        const submitForm = async () => {
            try {
                const formData = new FormData();
                formData.append('name', event.value.name);
                formData.append('description', event.value.description); // Envia a descrição
                formData.append('location', event.value.location);
                formData.append('price', event.value.price);
                formData.append('event_date', event.value.event_date);
                if (event.value.image) {
                    formData.append('image', event.value.image);
                }

                // Envia a requisição para a rota de criação de eventos
                const response = await axios.post('/events', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                console.log('Evento cadastrado com sucesso:', response.data);
                // Limpar o formulário após envio
                event.value = { name: '', description: '', location: '', price: 0, event_date: '', image: null };
                closeForm();  // Fecha o formulário após o envio
            } catch (error) {
                console.error('Erro ao cadastrar evento:', error.response ? error.response.data : error.message);
            }
        };

        const closeForm = () => {
            emit('close');
        };

        const handleImageChange = (e) => {
            event.value.image = e.target.files[0];
        };

        return {
            event,
            submitForm,
            closeForm,
            handleImageChange,
        };
    },
};
</script>

<style scoped>
/* Estilos do formulário */
</style>
