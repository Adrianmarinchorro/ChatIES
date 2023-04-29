<template>
    <div>
        <button class="btn btn-warning w-full rounded border-4 border-gray-800" @click="createNewChat">Nuevo Chat</button>

        <div v-for="(chat, index) in history" :key="index">
            <div>
                <button class="btn btn-warning w-full rounded border-4 border-gray-800" @click="getChat()">{{ getName(chat.chat[0].request) }}</button>
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
                    localStorage.setItem('history', JSON.stringify([{
                        id: 1,
                        chat: chat,
                    }]));
                }


                localStorage.removeItem('conversation');

            } else {

                var history = JSON.parse(localStorage.getItem('history'));
                var chat = JSON.parse(localStorage.getItem('conversation'));
                if (chat) {
                    history.push({
                        id: history.length + 1,
                        chat: chat,
                    });
                    localStorage.setItem('history', JSON.stringify(history));

                    localStorage.removeItem('conversation');
                }

            }

            this.history = JSON.parse(localStorage.getItem('history'));

            this.$emit('recharge');

        },

        getName(name) {
            return name.length < 10 ? name : name.substring(0, 10) + '...';
        },
        getChat() {

        },
    }


}
</script>

