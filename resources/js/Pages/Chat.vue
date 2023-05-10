<template>
    <Head title="Chat" />
    <PruebaLayout>

        <div class="flex h-128">

            <div class="w-1/6 bg-gray-800 border-4 border-gray-600 min-h-full max-h-full">
                <SideBarChat :allChats="allChats"></SideBarChat>
            </div>

            <div class="w-5/6 min-h-full bg-gray-800">

                <div class="">
                    <p>
                        <TextAreaChat :chats="chats"></TextAreaChat>
                    </p>
                </div>

                <InputChat class="absolute bottom-0 p-6" :chatsId="chats.id">

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

    components: {
        SideBarChat,
        InputChat, Head, PruebaLayout, TextAreaChat
    },

    props: [
        'chats', 'history' , 'allChats'
    ],
}
</script>

