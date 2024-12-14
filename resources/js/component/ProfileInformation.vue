<template>
    <div class="col-lg-12">
        <div class="card w-100 border-0 p-0 bg-white shadow-xss rounded-xxl">
            <div class="card-body h250 p-0 rounded-xxl overflow-hidden m-3">
                <img :src="'/storage/users/image/' +
                    ($root.profileUser[0].cover_picture ??
                        'default121000000.jpg')
                    " alt="image" />
            </div>
            <div class="card-body p-0 position-relative">
                <figure class="avatar position-absolute w100 z-index-1" style="top: -40px; left: 30px">
                    <img :src="'/storage/users/image/' +
                        ($root.profileUser[0].profile_picture ??
                            'default121000000.jpg')
                        " alt="image" class="float-right p-1 bg-white rounded-circle w-100" />
                </figure>
                <h4 class="fw-700 font-sm mt-2 mb-lg-5 mb-4 pl-15">
                    {{ $root.profileUser[0].name }}
                    <span class="fw-500 font-xssss text-grey-500 mt-1 mb-3 d-block">{{ $root.profileUser[0].email
                    }}</span>
                </h4>
                <div v-if="$root.profileUser[0].userID != $root.user[0].id"
                    class="d-flex align-items-center justify-content-center position-absolute-md right-15 top-0 me-2">
                    <a href="#"
                        class="d-none d-lg-block p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3"
                        :class="isFollowing ? 'bg-danger' : 'bg-success'"
                        @click.prevent="toggleFollow($root.profileUser[0].userID)">
                        {{ isFollowing ? 'Unfollow' : 'Follow' }}
                    </a>
                    <a href="#" class="d-none d-lg-block bg-greylight btn-round-lg ms-2 rounded-3 text-grey-700"><i
                            class="feather-mail font-md"></i></a>
                </div>
            </div>
            <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab" role="tablist">
                    <li class="active list-inline-item me-5">
                        <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active" href="#navtabs1"
                            data-toggle="tab">About</a>
                    </li>
                    <li class="list-inline-item me-5">
                        <button type="button" class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                            style="border: none; background-color: white;"
                            @click="fetchFollowing($root.profileUser[0].userID)"
                            data-bs-toggle="modal"
                            data-bs-target="#followingModal">
                            Following
                        </button>
                    </li>
                    <li class="list-inline-item me-5">
                        <button type="button" class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                            style="border: none; background-color: white;"
                            @click="fetchFollowers($root.profileUser[0].userID)"
                            data-bs-toggle="modal"
                            data-bs-target="#followersModal">
                            Followers
                        </button>
                    </li>

                    <!-- followers modal -->
                    <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="followersModalLabel">Followers</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="overflow-y: auto; max-height: 400px;">
                                    <ul class="list-unstyled">
                                        <li v-if="followers.length === 0">No followers yet</li>
                                        <li v-for="user in followers" :key="user.id">{{ user.name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- following modal -->
                    <div class="modal fade" id="followingModal" tabindex="-1" aria-labelledby="followingModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="followingModalLabel">Following</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="overflow-y: auto; max-height: 400px;">
                                    <ul class="list-unstyled">
                                        <li v-for="user in following" :key="user.id">{{ user.name }}</li>
                                        <li v-if="following.length === 0">Not following anyone yet</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                    href="#navtabs2" data-toggle="tab">Membership</a></li>
            <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                    href="#navtabs3" data-toggle="tab">Discussion</a></li>
            <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                    href="#navtabs4" data-toggle="tab">Video</a></li>
            <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                    href="#navtabs3" data-toggle="tab">Group</a></li>
            <li class="list-inline-item me-5"><a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                    href="#navtabs1" data-toggle="tab">Events</a></li>
            <li class="list-inline-item me-5"><a
                    class="fw-700 me-sm-5 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs7"
                    data-toggle="tab">Media</a></li> -->
                </ul>
            </div>
        </div>
    </div>
</template>




<script>
import axios from 'axios';

export default {
    data() {
        return {
            isFollowing: false,     // tracks if the active user is following the user in page
            followers: [],      // list of followers
            following: []       // list of following
        };
    }, created(){
        this.checkFollowing();  // updates the 'isFollowing' on page load
    }, methods: {
        // follow(id) {
        //     axios.post('api/follow/people', { "user_id": id })
        //         .then((response) => { console.log(response.data) })
        //         .catch((error) => { });
        
        async checkFollowing(userId){
            try {
                const response = await axios.get(`/api/is-following/${userId}`);
                this.isFollowing = response.data.is_following;
            } catch(error) {
                console.error('Error checking follow status:', error);
            }
        },
        async toggleFollow(userId){
            try {
                if (this.isFollowing) {     // unfollow
                    await axios.post('/api/unfollow/people', {user_id: userId});
                    this.isFollowing = false;
                }
                else {      // follow
                    await axios.post('/api/follow/people', {user_id: userId});
                    this.isFollowing = true;
                }
            } catch (error) {
                console.error('Error toggling follow status:', error);
            }
        },

        fetchFollowers(userId) {
            axios
                .post('/api/followers', {user_id: userId })
                .then(response => {
                    this.followers = response.data.followers;
                })
                .catch(error => {
                    console.error("Error fetching followers:", error);
                });
        },

        fetchFollowing(userId) {
            axios
                .post('/api/following', { user_id: userId })
                .then(response => {
                    this.following = response.data.following;
                })
                .catch(error => {
                    console.error("Error fetching following:", error);
                });
        }
    },
    props: {
        profileUserId: {type: Number, required: true}
    },
    mounted() {     //check follow status when the component is mounted
        this.checkFollowing(this.$root.profileUser[0].userID);
    },
};



</script>
