<template>
    <!-- nevigation top -->
    <home-header />
    <!-- navigation left -->
    <navigation-side />
</template>

<script>
// importing parts ...
import axios from "axios";
import HomeHeader from "./HomeHeader.vue";
import NavigationSide from "./NavigationSide.vue";
export default {
    components: {
        HomeHeader: HomeHeader,
        NavigationSide: NavigationSide,
    },
    data() {},
    methods: {},
    beforeMount() {
        if (!this.$root.user) {
            axios.defaults.baseURL = "http://127.0.0.1:8000/";
            axios
                .get("api/current/user/profile/data")
                .then((response) => {
                    this.$root.user = response.data.user;
                    console.log("hello from header");
                    console.log(this.$root.user[0].name);
                })
                .catch((error) => {});
            console.log(this.$root.userId);
        }
    },
};
</script>
