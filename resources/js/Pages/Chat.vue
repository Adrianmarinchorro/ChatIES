<template>
    <Head title="Chat" />
    <PruebaLayout>

        <div class="flex h-128">

            <div class="w-1/6 bg-gray-800 border-4 border-gray-600 min-h-full max-h-full">
                <SideBarChat @recharge="recharge" @refresh="refresh"></SideBarChat>
            </div>

            <div class="w-5/6 min-h-full bg-gray-800">

                <div class="">
                    <p>
                        <TextAreaChat :allChats="chat"></TextAreaChat>
                    </p>
                </div>

                <InputChat class="absolute bottom-0 p-6">

                </InputChat>

            </div>

        </div>
    </PruebaLayout>
</template>

<script>
import PruebaLayout from '@/Layouts/PruebaLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import InputChat from '@/Components/chat/InputChat.vue';
import TextAreaChat from '@/Components/chat/TextAreaChat.vue';
import SideBarChat from "@/Components/chat/SideBarChat.vue";

export default {

    data() {
        return {
            allChats: [],
        };
    },

    components: {
        SideBarChat,
        InputChat, Head, PruebaLayout, TextAreaChat
    },

    props: [
        'chat', 'history'
    ],

    methods: {
        recharge() {
            this.allChats = [];
        },

        refresh() {
            this.allChats = JSON.parse(localStorage.getItem('conversation')).chat;
        },
    },
    created() {
        if (localStorage.getItem('conversation')) {
            this.allChats = JSON.parse(localStorage.getItem('conversation')).chat;
        }
    },

    watch: {
        response() {
            if (this.request && this.response) {
                if (localStorage.getItem('conversation')) {

                    var chat = JSON.parse(localStorage.getItem('conversation'));

                    chat.chat.push({
                        id: chat.chat.length + 1,
                        request: this.request,
                        response: this.response
                    });

                    localStorage.setItem('conversation', JSON.stringify(chat));
                    this.allChats = chat.chat;

                } else {

                    var chat = { chat: [{
                            id: 1,
                            request: this.request,
                            response: this.response
                        }], wasSaved: false };

                    localStorage.setItem('conversation', JSON.stringify(chat));
                    this.allChats = chat.chat;
                }
            }
        }
    }
}
</script>

