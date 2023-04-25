<template>
    <Head title="Chat"/>
    <PruebaLayout>

        <div class="flex h-128">

            <div class="w-1/6 bg-blue-400 min-h-full">

            </div>

            <div class="w-5/6 min-h-full bg-gray-800">

                <div class="">
                    <p>
                        <TextAreaChat :request="request" :response="response"></TextAreaChat>
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
        InputChat , Head, PruebaLayout, TextAreaChat
    },

    props: [
        'request', 'response'
    ],

    methods: {

    },

    created() {
      if(!localStorage.getItem('conversation')) {
          localStorage.setItem('conversation', []);
      }

      if(this.request && this.response) {

          const chat = localStorage.getItem('conversation');

          if(chat.length == 0) {

              localStorage.setItem('conversation', [
                  {
                      id: chat.length++,
                      request: this.request,
                      response: this.response,
                  }
              ]);
          } else {

              chat.push({
                  id: chat.length++,
                  request: this.request,
                  response: this.response,
              });

          }

          this.allChats = chat;
      }

    }
}
</script>

