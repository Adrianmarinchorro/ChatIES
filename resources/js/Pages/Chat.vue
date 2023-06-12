<template>
    <Head title="Chat" />
    <ChatLayout>

        <div class="flex">

            <div class="w-1/6 bg-gray-800 border-4 border-gray-600">
                <SideBarChat :allChats="allChats" :chat="chats" :loadingResponse="loadingResponse"></SideBarChat>
            </div>

            <div class="w-5/6 min-h-full bg-gray-800">

                <div>
                    <TextAreaChat :chats="chats"></TextAreaChat>
                </div>

                <InputChat class="max-w-full pl-6" :chats="chats" @loadingResponse="loadingResponse = true">

                </InputChat>

            </div>

        </div>
    </ChatLayout>
</template>

<script>
import ChatLayout from '@/Layouts/ChatLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import InputChat from '@/Components/chat/InputChat.vue';
import TextAreaChat from '@/Components/chat/TextAreaChat.vue';
import SideBarChat from "@/Components/chat/SideBarChat.vue";

export default {

    components: {
        SideBarChat,
        InputChat, Head, ChatLayout, TextAreaChat
    },

    props: [
        'chats', 'history' , 'allChats'
    ],
    data() {
        return {
            loadingResponse: false
        };
    },
    updated() {
        this.loadingResponse = false;
    }
}
</script>

