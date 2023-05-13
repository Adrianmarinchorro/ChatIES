<template>
    <div class="bg-gray-800 w-max pr-10">
        <div>

            <form @submit.prevent="submit">
                <input type="text" placeholder="Intruduce tu pregunta" class="md:w-128 lg:w-98 break-words h-auto rounded" v-model="message">
                <button type="submit" class="ml-2 btn btn-active btn glass">Enviar</button>
            </form>

        </div>

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
