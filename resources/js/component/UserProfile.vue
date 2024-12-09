<template>
    <profile-information></profile-information>
    <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
        <!-- <AboutUser /> -->
        <!-- <UserPhotos /> -->
        <!-- <div class="col-xl-8 col-xxl-9 col-lg-8"> -->
        <CreatePost />
        <PostContent />
        <!-- </div> -->
    </div>
</template>
<script>
import ProfileInformation from "./ProfileInformation.vue";
import AboutUser from "./AboutUser.vue";
import UserPhotos from "./UserPhotos.vue";
import CreatePost from "./CreatePost.vue";
import PostContent from "./PostContent.vue";
import axios from "axios";
export default {
    components: {
        ProfileInformation: ProfileInformation,
        AboutUser: AboutUser,
        UserPhotos: UserPhotos,
        CreatePost: CreatePost,
        PostContent: PostContent,
    },
    data() {},
    methods: {},
    mounted() {
        const path = window.location.pathname;
        const segments = path.split("/");
        const userId = segments[2];
        console.log(userId);
        // current user_data
        axios
            .post(`http://127.0.0.1:8000/api/current/user/posts`, {
                user_id: userId,
            })
            .then((response) => {
                console.log(response.data.posts);
                this.$root.profileUser = response.data.profile_user_data;
                console.log(this.$root.profileUser);
                this.$root.current_posts = response.data.posts;
            })
            .catch((error) => {});
    },
};
</script>
