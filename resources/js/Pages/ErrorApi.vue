<template>
    <Head title="Chat" />
    <ChatLayout>
        <div class="bg-gray-800 flex justify-center mt-5">
            <p class="text-gray-300 uppercase" style="font-size: 48px">La petición a la API no se ha procesado</p>
        </div>
    </ChatLayout>
</template>

<script>
import ChatLayout from '@/Layouts/ChatLayout.vue';
import { Head, router } from '@inertiajs/vue3';
export default {
    props: ['status'],
    components: {
        ChatLayout, Head
    }
}
</script>
