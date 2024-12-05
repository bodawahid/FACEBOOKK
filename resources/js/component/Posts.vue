<template>
    <create-post></create-post>
    <post-content></post-content>
    <Spinner></Spinner>
    <create-post-modal></create-post-modal>
    <edit-post v-if="isEditModalVisisble"></edit-post>
    <follow-people></follow-people>
    <Loading></Loading>
    <!-- profile -->
</template>
<script>
import CreatePost from "./CreatePost.vue";
import PostContent from "./PostContent.vue";
import FollowPeople from "./FollowPeople.vue";
import Loading from "./Loading.vue";
import CreatePostModal from "./CreatePostModal.vue";
import Spinner from "./Spinner.vue";
import EditPost from "./EditPost.vue";
import axios from "axios";
export default {
    components: {
        "CreatePost": CreatePost,
        "PostContent": PostContent,
        "FollowPeople": FollowPeople,
        "Loading": Loading,
        "CreatePostModal": CreatePostModal,
        "Spinner": Spinner,
        "EditPost": EditPost,
    }, data() {
        return {
            mediaFiles: [],
            isModalVisible: false,
            spinner: false,
            post: null,
            isEditModalVisisble: false,
            current_editing_index: null,
        }


    },
    mounted() {
        if (!this.$root.user) {
            axios.get(`api/current/user/${this.$root.userId}/profile/data`).then((response) => {
                this.$root.user = response.data.user;
            }).catch((error) => { })
        }
        axios.get('api/retrieve/data').then((response) => {
            console.log(response.data.posts);
            // console.log(response.data.user);
            this.$root.current_posts = response.data.posts;
        }).catch((error) => { });

    }
}
</script>