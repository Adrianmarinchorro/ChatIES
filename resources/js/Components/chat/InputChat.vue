<template>
    <div class="bg-gray-800 min-w-full">

            <form  @submit.prevent="submit">
                <div class="flex">
                <input type="text" placeholder="Intruduce tu pregunta" class="break-words h-auto rounded w-5/6" v-model="message">
                <button type="submit" class="ml-2 btn btn-active btn glass w-20">Enviar</button>
                </div>
            </form>


    </div>
</template>

<script>
import {router} from "@inertiajs/vue3";

export default {
    props: ['chats'],
    data() {
        return {
            message: '',
        }
    },

    methods: {
        submit(){

            if(this.message != '') {
                var chat_id = null;

                if(this.chats){
                    chat_id = this.chats.id
                }

                var data = {message: this.message , chats_id : chat_id};

                router.post('chat', data);
                this.message = '';
            }

        },
    },



}
</script>
