<template>
    <div
        class="modal fade"
        id="followerModal"
        tabindex="-1"
        aria-labelledby="followerModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="followerModalLabel">
                        Followers
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div
                    class="modal-body"
                    style="overflow-y: auto; max-height: 400px"
                >
                    <ul class="list-unstyled">
                        <li v-if="followers.length === 0">No followers yet</li>
                        <li
                            class="reaction-item"
                            v-for="user in followers"
                            :key="user.id"
                        >
                            <img
                                :src="
                                    '/storage/users/image/' +
                                    (user.profile_picture ??
                                        'default121000000.jpg')
                                "
                            />
                            {{ user.name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation scroll-bar">
        <div class="container ps-0 pe-0">
            <div class="nav-content">
                <div
                    class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2 mt-2"
                >
                    <div class="nav-caption fw-600 font-xssss text-grey-500">
                        <span>New </span>Feeds
                    </div>
                    <ul class="mb-1 top-content">
                        <li class="logo d-none d-xl-block d-lg-block"></li>
                        <li>
                            <a
                                @click="fetchFollowers($root.user[0].id)"
                                data-bs-toggle="modal"
                                data-bs-target="#followerModal"
                                href="#"
                                class="nav-content-bttn open-font"
                                ><i
                                    class="feather-zap btn-round-md bg-mini-gradiant me-3"
                                ></i
                                ><span>Follower List</span></a
                            >
                        </li>
                        <!-- follower modal -->
                        <li>
                            <a
                                type="button"
                                @click.prevent="$parent.goToMyProfile()"
                                class="nav-content-bttn open-font"
                                ><i
                                    class="feather-user btn-round-md bg-primary-gradiant me-3"
                                ></i
                                ><span>Author Profile </span></a
                            >
                        </li>
                    </ul>
                </div>

                <!-- <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2">
                    <div class="nav-caption fw-600 font-xssss text-grey-500"><span>More </span>Pages</div>
                    <ul class="mb-3">
                        <li><a href="default-email-box.html" class="nav-content-bttn open-font"><i
                                    class="font-xl text-current feather-inbox me-3"></i><span>Email
                                    Box</span><span class="circle-count bg-warning mt-1">584</span></a></li>
                        <li><a href="default-hotel.html" class="nav-content-bttn open-font"><i
                                    class="font-xl text-current feather-home me-3"></i><span>Near
                                    Hotel</span></a>
                        </li>
                        <li><a href="default-event.html" class="nav-content-bttn open-font"><i
                                    class="font-xl text-current feather-map-pin me-3"></i><span>Latest
                                    Event</span></a></li>
                        <li><a href="default-live-stream.html" class="nav-content-bttn open-font"><i
                                    class="font-xl text-current feather-youtube me-3"></i><span>Live
                                    Stream</span></a></li>
                    </ul>
                </div> -->
                <!-- <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1">
                    <div class="nav-caption fw-600 font-xssss text-grey-500"><span></span> Account</div>
                    <ul class="mb-1">
                        <li class="logo d-none d-xl-block d-lg-block"></li>
                        <li><a href="default-settings.html" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i
                                    class="font-sm feather-settings me-3 text-grey-500"></i><span>Settings</span></a>
                        </li>
                        <li><a href="default-analytics.html" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i
                                    class="font-sm feather-pie-chart me-3 text-grey-500"></i><span>Analytics</span></a>
                        </li>
                        <li><a href="default-message.html" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i
                                    class="font-sm feather-message-square me-3 text-grey-500"></i><span>Chat</span><span
                                    class="circle-count bg-warning mt-0">23</span></a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </nav>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            followers: [], // list of followers
        };
    },
    methods: {
        fetchFollowers(userId) {
            axios
                .post("/api/followers", { user_id: userId })
                .then((response) => {
                    this.followers = response.data.followers;
                })
                .catch((error) => {
                    console.error("Error fetching followers:", error);
                });
        },
    },
};
</script>
<style scoped>
.modal-content {
    top: 80px;
}

.modal-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 9999;
}
.reaction-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.reaction-item img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    margin-right: 10px;
}

.reaction-item span {
    font-weight: bold;
}
</style>
