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
    mounted() {
        if (!this.$root.user) {
            axios
                .post(`api/current/user/profile/data`)
                .then((response) => {
                    this.$root.user = response.data.user;
                })
                .catch((error) => {});
        }
    },
};
</script>
