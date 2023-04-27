<template>
    <div>
        <button class="btn btn-warning w-full rounded border-4 border-gray-800" @click="createNewChat">Nuevo Chat</button>

    </div>

    <div>
        <div v-for="(chat, index) in history" :key="index">
            <TextUser  :chat="chat.chat.request" class="mt-2"></TextUser>
        </div>
    </div>

</template>


<script>
import { Head, router } from '@inertiajs/vue3';


export default {

    data() {
        return {
            history: [],
        }
    },

    created() {
        if (localStorage.getItem('history')) {
            this.history = JSON.parse(localStorage.getItem('history'));
        }
    },

    methods: {

        createNewChat(){

            if(!localStorage.getItem('history')){
            localStorage.setItem('history', JSON.stringify([{
                    id: 1,
                    chat: JSON.parse(localStorage.getItem('conversation')),
            }]));

            localStorage.removeItem('conversation');

            } else {

                var history = JSON.parse(localStorage.getItem('history'));

                history.push({
                    id: history.length + 1,
                    chat: JSON.parse(localStorage.getItem('conversation')),
                });

                localStorage.setItem('history', JSON.stringify(history));

                localStorage.removeItem('conversation');
            }

            this.history = JSON.parse(localStorage.getItem('history'));

            this.$emit('recharge');

        }

    }


}
</script>

