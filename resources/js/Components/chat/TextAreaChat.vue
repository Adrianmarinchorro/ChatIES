<template>
    <div ref="chatWindow" class="bg-gray-500 m-5 h-100 overflow-y-auto scroll-bottom">
        <div v-if="chats" v-for="(chat, index) in chats.data" :key="index">
            <TextUser  :chat="chat.request" class="mt-2"></TextUser>
            <TextIA :chat="chat.response" class="mt-2"></TextIA>
        </div>
    </div>
</template>

<script>
import TextUser from '@/Components/chat/TextUser.vue';
import TextIA from '@/Components/chat/TextIA.vue';
export default {

    props: [
        'chats'
    ],
    components: {
        TextUser, TextIA
    },
    mounted() {
        this.$refs.chatWindow.scrollTop = this.$refs.chatWindow.scrollHeight;
    },
    updated() {
        this.$refs.chatWindow.scrollTop = this.$refs.chatWindow.scrollHeight;
    },
}
</script>
