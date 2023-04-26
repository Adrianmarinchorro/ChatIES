<template>
    <Head title="Chat" />
    <PruebaLayout>

        <div class="flex h-128">

            <div class="w-1/6 bg-gray-800 border-4 border-gray-600 min-h-full">

            </div>

            <div class="w-5/6 min-h-full bg-gray-800">

                <div class="">
                    <p>
                        <TextAreaChat :allChats="allChats"></TextAreaChat>
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
import axios from 'axios';

export default {

    data() {
        return {
            allChats: [],
        };
    },

    components: {
        InputChat, Head, PruebaLayout, TextAreaChat
    },

    props: [
        'request', 'response'
    ],

    methods: {

    },
    created() {
        if (localStorage.getItem('conversation')) {
            this.allChats = JSON.parse(localStorage.getItem('conversation'));
        }
    },

    watch: {
        response() {
            if (this.request && this.response) {
                if (localStorage.getItem('conversation')) {

                    var chat = JSON.parse(localStorage.getItem('conversation'));

                    chat.push({
                        id: chat.length + 1,
                        request: this.request,
                        response: this.response
                    });

                    localStorage.setItem('conversation', JSON.stringify(chat));
                    this.allChats = chat;

                } else {

                    var chat = [];
                    chat.push({
                        id: 1,
                        request: this.request,
                        response: this.response
                    });
                    localStorage.setItem('conversation', JSON.stringify(chat));
                    this.allChats = chat;
                }
            }
        }
    }
}
</script>

