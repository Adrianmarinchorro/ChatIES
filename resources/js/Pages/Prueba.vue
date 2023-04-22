<template>
    <Head title="Prueba" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Prueba</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">{{num}}</div>
                    <button class="m-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="increment">Incrementame esta!</button>
                    <button class="m-6 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click="decrement">Decrementame esta!</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>


<!-- Setup es para que cargue primero el script y luego el template que es el html -->
<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        Head
    },
    data() {
        return {
            num: 0,
        }
    },
    methods: {
        increment() {
            this.num++;
        },
        decrement() {
            this.num--;
        }
    },

    //funcionalidad de view que escucha lo que hay en data
    watch: {
        num() {
            if(this.num < 0) {
                this.num = 0;
            }
        }
    },
}

</script>
