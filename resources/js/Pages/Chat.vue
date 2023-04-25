<template>
    <Head title="Chat"/>
    <PruebaLayout>

        <div class="flex h-128">

            <div class="w-1/6 bg-blue-400 min-h-full">

            </div>

            <div class="w-5/6 min-h-full bg-gray-800">

                <div class="">
                    <p>
                        <TextAreaChat></TextAreaChat>
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
    components: {
        InputChat , Head, PruebaLayout, TextAreaChat
    },

    methods: {
        prueba() {
            router.post('/chat2');
        },
    },

    created() {
      this.prueba();
    }
}
</script>

