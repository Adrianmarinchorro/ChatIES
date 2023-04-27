<template>
    <div ref="chatWindow" class="bg-gray-500 m-5 h-100 overflow-y-auto scroll-bottomº">
        <div v-for="(chat, index) in allChats" :key="index">
            <TextUser  :chat="chat.request"></TextUser>
            <TextIA :chat="chat.response"></TextIA>
        </div>
    </div>
</template>

<script>
import TextUser from '@/Components/chat/TextUser.vue';
import TextIA from '@/Components/chat/TextIA.vue';
export default {

    props: [
        'allChats'
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
