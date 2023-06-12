<template>
    <div class="bg-gray-800 min-w-full">

            <form  @submit.prevent="submit">
                <div class="flex" v-if="!loadingResponse">
                <input type="text" placeholder="Introduce tu pregunta" class="break-words h-auto rounded w-5/6" v-model="message">
                <button type="submit"  class="ml-2 btn btn-active glass w-1/6 w-40">Enviar</button>
                </div>
                <div v-else class="flex justify-center">
                    <button  class="ml-2 btn loading btn-active glass w-40">loading</button>
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
            loadingResponse: false,
        }
    },

    watch: {
        chats() {
            this.loadingResponse = false;
        }
    },
    methods: {
        submit(){

            if(this.message != '') {
                this.loadingResponse = true;
                this.$emit('loadingResponse')
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
