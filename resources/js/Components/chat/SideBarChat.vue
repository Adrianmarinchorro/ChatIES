<template>
    <div class="overflow-y-auto overflow-hidden scrollbar scrollbar-thumb-gray-800">
        <button class="btn btn-warning w-full rounded border-4 border-gray-800" @click="createNewChat">Nuevo Chat</button>
        <button class="btn btn-error w-full rounded border-4 border-gray-800" @click="deleteChat">Eliminar Chat actual</button>

        <div v-if="allChats">
            <div v-for="(chat, index) in allChats" :key="index">
                <div>
                    <button class="btn btn-success w-full rounded border-4 border-gray-800" v-if="chat.data != '[]'" @click="getChat(chat.id)">{{
                        getName(chat.data) }}</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import {router} from "@inertiajs/vue3";
export default {

    props: ['allChats', 'chat', 'loadingResponse'],

    data() {
        return {
            history: [],
        }
    },

    methods: {
        createNewChat() {
            if(!this.loadingResponse){
                router.get('newChat');
            }
        },

        getName(data) {
            data = JSON.parse(data);

            name = data[0].request;

            return name.length < 24 ? name : name.substring(0, 24) + '...';
        },

        deleteChat(){
            if(this.chat && !this.loadingResponse){
                router.delete('deleteChat/' + this.chat.id);
            }
        },

        getChat(id) {
            if(!this.loadingResponse){
                router.get('chat', {id: id});
            }
        },
    }


}
</script>

