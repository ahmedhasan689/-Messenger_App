
import { createApp } from "@vue/runtime-dom";
import Messenger from "./components/messages/Messenger.vue";
import ChatList from "./components/messages/ChatList.vue";

// Start Pusher With Vue.js
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});
// End Pusher With Vue.js


const chatApp = createApp({
    data() {
        return {
            conversation: null,
            messages: [],
            userId: userId,
            csrfToken: csrf_token,
            laravelEcho: null
        }
    },

    mounted() {
        this.laravelEcho = new Echo({
            broadcaster: 'pusher',
            key: process.env.MIX_PUSHER_APP_KEY,
            cluster: process.env.MIX_PUSHER_APP_CLUSTER,
            forceTLS: true
        });

        this.laravelEcho.join(`Messenger.${this.userId}`)
            .listen('.new-message', (data) => {
                this.messages.push(data.message);
                let container = document.querySelector('#chat-body');
                container.scrollTop = container.scrollHeight
            });
    },

    methods: {
        moment(time) {
            return moment(time)
        },
    }

});

chatApp.component('ChatList', ChatList);
chatApp.component('Messenger', Messenger);
chatApp.mount('#chat-app');
