<template>
    <create-post></create-post>
    <post-content></post-content>
    <Spinner></Spinner>
    <create-post-modal></create-post-modal>
    <edit-post v-if="isEditModalVisisble"></edit-post>
    <share-modal></share-modal>
    <!-- <comment-modal></comment-modal> -->
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
import ShareModal from "./ShareModal.vue";
// import CommentModal from "./CommentModal.vue";
import axios from "axios";
export default {
    components: {
        CreatePost: CreatePost,
        PostContent: PostContent,
        FollowPeople: FollowPeople,
        Loading: Loading,
        CreatePostModal: CreatePostModal,
        Spinner: Spinner,
        EditPost: EditPost,
        ShareModal: ShareModal,
        // "CommentModal": CommentModal,
    },
    data() {
        return {
            mediaFiles: [],
            isModalVisible: false,
            spinner: false,
            post: null,
            isEditModalVisisble: false,
            current_editing_index: null,
            sharingPostId: null,
        };
    },
    methods: {},
    mounted() {
        // if (!this.$root.user) {
        //     axios.get('api/current/user/profile/data').then((response) => {
        //         this.$root.user = response.data.user;
        //     }).catch((error) => { })
        //     console.log(this.$root.userId);
        // }
        axios
            .get("api/retrieve/data")
            .then((response) => {
                console.log(response.data.posts);
                // console.log(response.data.user);
                this.$root.current_posts = response.data.posts;
            })
            .catch((error) => {});
    },
};
</script>
