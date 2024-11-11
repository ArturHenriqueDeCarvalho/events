<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import EventList from '@/Components/EventList.vue';
import TodayEvents from '@/Components/TodayEvents.vue';
import CreateEventButton from '@/Components/CreateEventButton.vue';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <CreateEventButton />
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-1 gap-4">
                <!-- Componente de Eventos de Hoje -->
                <div class="bg-white shadow-sm sm:rounded-lg p-4 lg:w-full">
                    <TodayEvents />
                </div>
                <!-- Componente de Lista de Eventos -->
                <div class="bg-white shadow-sm sm:rounded-lg p-4 lg:w-full">
                    <EventList :events="events" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import EventList from '@/Components/EventList.vue';
import TodayEvents from '@/Components/TodayEvents.vue';

export default {
    components: { EventList, TodayEvents },
    props: {
        events: Array,
    },
};
</script>
