<template>
    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
        <div class="card-body d-block p-4">
            <h4 class="fw-700 mb-3 font-xsss text-grey-900">About</h4>
            <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">
                {{ $root.user[0].bio }}
            </p>
        </div>
        <div class="card-body border-top-xs d-flex">
            <i class="feather-lock text-grey-500 me-3 font-lg"></i>
            <h4 class="fw-700 text-grey-900 font-xssss mt-0">
                Private
                <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"
                    >What's up, how are you?</span
                >
            </h4>
        </div>

        <div class="card-body d-flex pt-0">
            <i class="feather-eye text-grey-500 me-3 font-lg"></i>
            <h4 class="fw-700 text-grey-900 font-xssss mt-0">
                Visble
                <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"
                    >Anyone can find you</span
                >
            </h4>
        </div>
        <!-- <div class="card-body d-flex pt-0">
            <i class="feather-map-pin text-grey-500 me-3 font-lg"></i>
            <h4 class="fw-700 text-grey-900 font-xssss mt-1">Flodia, Austia </h4>
        </div> -->
        <div class="card-body d-flex pt-0">
            <i class="feather-users text-grey-500 me-3 font-lg"></i>
            <h4 class="fw-700 text-grey-900 font-xssss mt-1">
                Joined At &nbsp;
            </h4>
            <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{
                timeAgo($root.profileUser[0].created_at_)
            }}</span>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    methods: {
        timeAgo(Time) {
            return moment(Time).format("YYYY-MM-DD");
        },
    },
};
</script>
