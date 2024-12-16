<template>
    <profile-information></profile-information>
    <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0 mt-4">
        <AboutUser />
        <UserPhotos />
    </div>
    <div class="col-xl-8 col-xxl-9 col-lg-8 mt-4">
        <posts></posts>
    </div>
</template>
<script>
import ProfileInformation from "./ProfileInformation.vue";
import AboutUser from "./AboutUser.vue";
import UserPhotos from "./UserPhotos.vue";
import Posts from "./Posts.vue";

import axios from "axios";
// import LikeModal from "./LikeModal.vue";

export default {
    components: {
        ProfileInformation: ProfileInformation,
        AboutUser: AboutUser,
        UserPhotos: UserPhotos,
        Posts: Posts,
    },
    data() {
        return {
            isFollowing: false,     // tracks if the active user is following the user in page
        }
        currentUserId: null;
    },
    methods: {},
    mounted() {
        const path = window.location.pathname;
        const segments = path.split("/");
        const userId = segments[2];
        this.currentUserId = userId;
        // current user_data
        axios
            .post(`http://127.0.0.1:8000/api/current/user/posts`, {
                user_id: userId,
            })
            .then((response) => {
                this.isFollowing = response.data.is_following[0].is_following;
                this.$root.profileUser = response.data.profile_user_data;
                this.$root.current_posts = response.data.posts;
            })
            .catch((error) => { });
    },
};
</script>
