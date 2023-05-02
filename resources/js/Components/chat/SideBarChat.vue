<template>
    <div class="max-h-full overflow-y-auto overflow-hidden scrollbar scrollbar-thumb-gray-800">
        <button class="btn btn-warning w-full rounded border-4 border-gray-800" @click="createNewChat">Nuevo Chat</button>

        <div v-for="(chat, index) in history" :key="index">
            <div>
                <button class="btn btn-success w-full rounded border-4 border-gray-800" @click="getChat(chat.id)">{{
                    getName(chat.chat.chat[0].request) }}</button>
            </div>
        </div>
    </div>
</template>


<script>
export default {

    data() {
        return {
            history: [],
        }
    },

    created() {
        this.getHistory();
    },

    methods: {
        getHistory() {
            if (localStorage.getItem('history')) {
                this.history = JSON.parse(localStorage.getItem('history'));
            }
        },
        createNewChat() {

            if (!localStorage.getItem('history')) {

                var chat = JSON.parse(localStorage.getItem('conversation'));

                if (chat) {
                    chat.wasSaved = true;

                    localStorage.setItem('history', JSON.stringify([{
                        id: 1,
                        chat: chat,
                    }]));
                }

            } else {

                var history = JSON.parse(localStorage.getItem('history'));
                var chat = JSON.parse(localStorage.getItem('conversation'));

                if (chat && chat.wasSaved === false) {
                    chat.wasSaved = true;

                    history.push({
                        id: history.length + 1,
                        chat: chat,
                    });

                    localStorage.setItem('history', JSON.stringify(history));

                }
            }

            localStorage.removeItem('conversation');

            this.history = JSON.parse(localStorage.getItem('history'));

            this.$emit('recharge');

        },

        getName(name) {
            return name.length < 24 ? name : name.substring(0, 24) + '...';
        },

        getChat(id) {

            var history = JSON.parse(localStorage.getItem('history'));
            var chat = JSON.parse(localStorage.getItem('conversation'));


            if (chat && chat.wasSaved === false) {
                history.push({
                    id: history.length + 1,
                    chat: chat,
                });

                localStorage.setItem('history', JSON.stringify(history));

                localStorage.removeItem('conversation');

            }

            chat = history[id - 1].chat;

            localStorage.setItem('conversation', JSON.stringify(chat));

            this.$emit('refresh');
        },
    }


}
</script>

