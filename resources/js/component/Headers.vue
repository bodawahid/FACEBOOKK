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
        "HomeHeader": HomeHeader,
        "NavigationSide": NavigationSide,

    }, data() {


    }, methods: {

    },


}


</script>