<template>
    <div class="bg-gray-500 m-5 h-100">
        <div v-for="chat in chats" :key="chat.id">
            <TextUser  :chat="chat.search.message"></TextUser>
            <TextIA :chat="chat.respuesta.message"></TextIA>
        </div>
    </div>
</template>

<script>
import TextUser from '@/Components/chat/TextUser.vue';
import TextIA from '@/Components/chat/TextIA.vue';
export default {
    data() {
        chats: [];
    },
    created() {
        this.chats = [{
            id: 1,
            search: {
                message: 'Hola'
            },
            respuesta: {
                message: 'Buenos dias'
            }
        }];
    },
    components: {
        TextUser, TextIA
    }
}
</script>
