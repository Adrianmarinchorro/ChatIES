<template>
    <div class="max-h-full overflow-y-auto overflow-hidden scrollbar scrollbar-thumb-gray-800">
        <button class="btn btn-warning w-full rounded border-4 border-gray-800" @click="createNewChat">Nuevo Chat</button>

        <div v-if="allChats">
            <div v-for="(chat, index) in allChats" :key="index">
                <div>
                    <button class="btn btn-success w-full rounded border-4 border-gray-800" @click="getChat(chat.id)">{{
                        getName('hola') }}</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import {router} from "@inertiajs/vue3";
export default {

    props: ['allChats'],

    data() {
        return {
            history: [],
        }
    },

    methods: {
        createNewChat() {
            router.get('newChat');
        },

        getName(name) {
            return name.length < 24 ? name : name.substring(0, 24) + '...';
        },

        getChat(id) {
        },
    }


}
</script>

