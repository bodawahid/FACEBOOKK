import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Headers from "./component/Headers.vue";
import Facebook from "./component/Facebook.vue";
import MainContent from "./component/MainContent.vue";
import Posts from './component/Posts.vue';
import UserProfile from "./component/UserProfile.vue";
const app = createApp({
    components: {
        'Facebook': Facebook,
        'Headers': Headers,
        "MainContent": MainContent,
        'Posts': Posts,
        "UserProfile": UserProfile,
    },
    data() {
        return {
            user: null,
            current_posts: [],
            userId: window.userId,
            profileUser: null,
        }

    },
    methods: {

    },
    created() {

    },
    beforeCreate() {

    },
    updated() {

    },

});
app.mount("#app");