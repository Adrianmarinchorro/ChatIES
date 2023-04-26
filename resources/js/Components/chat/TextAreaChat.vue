<template>
    <div class="bg-gray-500 m-5 h-100">
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
    watch: {
        allChats() {
            for (const key in this.allChats) {
                console.log(key);
            }
        }
    }
}
</script>
