<template>
    <div v-if="isDeleted" class="alert alert-success" role="alert">
        Post updated successfully!
    </div>
    <transition-group name="fade" tag="ul">
        <div v-for="(post, index)
     in $root.current_posts" class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
            <div class="card-body p-0 d-flex">
                <figure style="cursor: pointer;" @click.prevent="goToProfile(post.post.user_id)" class="avatar me-3">
                    <img :src="'storage/users/image/' + (post.post.profile_picture ?? 'default121000000.jpg')"
                        alt="image" class="shadow-sm rounded-circle w45">
                </figure>
                <h4 style="cursor: pointer;" @click.prevent="goToProfile(post.post.user_id)"
                    class="fw-700 text-grey-900 font-xssss mt-1">{{ post.post.user_name }} <span
                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ timeAgo(post.post.created_at)
                        }}</span>
                </h4>
                <!-- {{ --more options on the post... --}} -->
                <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                    aria-labelledby="dropdownMenu2">
                    <div class="card-body p-0 d-flex mt-2" v-if="$root.user[0].id == post.post.user_id">
                        <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#editPostModal"
                            class="fw-600 text-grey-900 font-xssss mt-0 me-4"
                            @click.prevent="editPost(post, index)">Edit
                            Post
                            <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Edit your post</span></a>
                    </div>
                    <div class="card-body p-0 d-flex mt-2">
                        <i class="feather-alert-octagon text-grey-500 me-3 font-lg"
                            v-if="post.post.user_id == $root.user[0].id"></i>
                        <a style="cursor: pointer;" class="fw-600 text-grey-900 font-xssss mt-0 me-4"
                            @click.prevent="deletePost(post, index)">Delete
                            Post
                            <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Move To trash bin</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- {{ --post content-- }} -->
            <div class="card-body p-0 me-lg-5">
                <p class="fw-500 text-grey-500 lh-26 font-xssss w-100"
                    :style="'text-align:' + (detectLanguage(post.post.content) ? 'right' : 'left')">
                    {{ post.post.content ?? '' }}
                    <!-- <a href="#" class="fw-600 text-primary ms-2">See more</a> -->
                </p>
            </div>
            <!-- only one image -->
            <div class="card-body d-block p-0 mb-3"
                v-if="post.postMedia.length == 1 && post.postMedia[0].media_type == 'image'">
                <div class="row ps-2 pe-2">
                    <div class="col-sm-12 p-1"><a href="images/t-30.jpg" data-lightbox="roadtr"><img
                                :src="'storage/posts/media/' + post.postMedia[0].media_path" class="rounded-3 w-100"
                                alt="image"></a></div>
                </div>
            </div>
            <!-- if videos are required here-->
            <div v-if="post.postMedia.length == 1 && post.postMedia[0].media_type == 'video'"
                class="card-body p-0 mb-3 rounded-3 overflow-hidden">
                <a href="default-video.html" class="video-btn">
                    <video autoplay loop class="float-right w-100">
                        <source :src="'storage/posts/media/' + post.postMedia[0].media_path" type="video/mp4">
                    </video>
                </a>
            </div>
            <!-- {{ --post images more than one image here ... --}} -->
            <div class="card-body d-block p-0" v-else-if="post.postMedia.length > 1">
                <div class="row">
                    <div v-for="(image, index) in post.postMedia.slice(0, 3)" :key="index"
                        class="col-xs-4 col-sm-4 p-1 position-relative">
                        <span v-if="image.media_type === 'image'" style="position: relative;">
                            <!-- Link to view the image in lightbox -->
                            <a :href="'images/t-12.jpg'" data-lightbox="roadtrip" class="position-relative d-block">
                                <img :src="'storage/posts/media/' + image.media_path" class="rounded-3 w-100"
                                    alt="image">

                                <!-- Show the number on the 3rd image (or any condition) -->
                                <div v-if="index === 2 && post.postMedia.length - 3 > 0"
                                    class="position-absolute top-50 left-50 start-0  bg-dark text-white p-2 rounded-circle">
                                    + {{ post.postMedia.length - 3 }}
                                </div>
                            </a>
                        </span>
                    </div>
                </div>
            </div>



            <!-- if five images or more  -->
            <!-- <div class="card-body d-block p-0 mb-3">
            <div class="row ps-2 pe-2">
                <div class="col-xs-6 col-sm-6 p-1"><a href="images/t-36.jpg" data-lightbox="roadtri"><img
                            src="images/t-21.jpg" class="rounded-3 w-100" alt="image"></a></div>
                <div class="col-xs-6 col-sm-6 p-1"><a href="images/t-32.jpg" data-lightbox="roadtri"><img
                            src="images/t-22.jpg" class="rounded-3 w-100" alt="image"></a></div>
            </div>
            <div class="row ps-2 pe-2">
                <div class="col-xs-4 col-sm-4 p-1"><a href="images/t-33.jpg" data-lightbox="roadtri"><img
                            src="images/t-23.jpg" class="rounded-3 w-100" alt="image"></a></div>
                <div class="col-xs-4 col-sm-4 p-1"><a href="images/t-34.jpg" data-lightbox="roadtri"><img
                            src="images/t-24.jpg" class="rounded-3 w-100" alt="image"></a></div>
                <div class="col-xs-4 col-sm-4 p-1"><a href="images/t-35.jpg" data-lightbox="roadtri"
                        class="position-relative d-block"><img src="images/t-25.jpg" class="rounded-3 w-100"
                            alt="image"><span class="img-count font-sm text-white ls-3 fw-600"><b>+2</b></span></a>
                </div>
            </div>
        </div> -->



            <!-- {{ --likes and love-- }} -->
            <div class="card-body d-flex p-0 mt-3">
                <a href="#"
                    class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i
                        class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i>
                    <i class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>
                    {{ post.post.number_of_reacts }}
                    Like</a>
                <div class="emoji-wrap">
                    <ul class="emojis list-inline mb-0">
                        <li class="emoji list-inline-item"><i class="em em---1"></i> </li>
                        <li class="emoji list-inline-item"><i class="em em-angry"></i></li>
                        <li class="emoji list-inline-item"><i class="em em-anguished"></i>
                        </li>
                        <li class="emoji list-inline-item"><i class="em em-astonished"></i>
                        </li>
                        <li class="emoji list-inline-item"><i class="em em-blush"></i></li>
                        <li class="emoji list-inline-item"><i class="em em-clap"></i></li>
                        <li class="emoji list-inline-item"><i class="em em-cry"></i></li>
                        <li class="emoji list-inline-item"><i class="em em-full_moon_with_face"></i></li>
                    </ul>
                </div>
                <a href="#" class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                        class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span
                        class="d-none-xss">{{ post.post.number_of_comments }} Comment</span></a>
                <!-- <a href="#" id="dropdownMenu21" data-bs-toggle="dropdown" aria-expanded="false"
                class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                    class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span
                    class="d-none-xs">Share</span></a> -->
                <!-- share ... -->
                <!-- <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                aria-labelledby="dropdownMenu21">
                <h4 class="fw-700 font-xss text-grey-900 d-flex align-items-center">Share
                    <i class="feather-x ms-auto font-xssss btn-round-xs bg-greylight text-grey-900 me-2"></i>
                </h4>
                <div class="card-body p-0 d-flex">
                    <ul class="d-flex align-items-center justify-content-between mt-2">
                        <li class="me-1"><a href="#" class="btn-round-lg bg-facebook"><i
                                    class="font-xs ti-facebook text-white"></i></a></li>
                        <li class="me-1"><a href="#" class="btn-round-lg bg-twiiter"><i
                                    class="font-xs ti-twitter-alt text-white"></i></a></li>
                        <li class="me-1"><a href="#" class="btn-round-lg bg-linkedin"><i
                                    class="font-xs ti-linkedin text-white"></i></a></li>
                        <li class="me-1"><a href="#" class="btn-round-lg bg-instagram"><i
                                    class="font-xs ti-instagram text-white"></i></a></li>
                        <li><a href="#" class="btn-round-lg bg-pinterest"><i
                                    class="font-xs ti-pinterest text-white"></i></a></li>
                    </ul>
                </div>
                <div class="card-body p-0 d-flex">
                    <ul class="d-flex align-items-center justify-content-between mt-2">
                        <li class="me-1"><a href="#" class="btn-round-lg bg-tumblr"><i
                                    class="font-xs ti-tumblr text-white"></i></a></li>
                        <li class="me-1"><a href="#" class="btn-round-lg bg-youtube"><i
                                    class="font-xs ti-youtube text-white"></i></a></li>
                        <li class="me-1"><a href="#" class="btn-round-lg bg-flicker"><i
                                    class="font-xs ti-flickr text-white"></i></a></li>
                        <li class="me-1"><a href="#" class="btn-round-lg bg-black"><i
                                    class="font-xs ti-vimeo-alt text-white"></i></a></li>
                        <li><a href="#" class="btn-round-lg bg-whatsup"><i
                                    class="font-xs feather-phone text-white"></i></a></li>
                    </ul>
                </div>
                <h4 class="fw-700 font-xssss mt-4 text-grey-500 d-flex align-items-center mb-3">
                    Copy Link</h4>
                <i class="feather-copy position-absolute right-35 mt-3 font-xs text-grey-500"></i>
                <input type="text" value="https://socia.be/1rGxjoJKVF0"
                    class="bg-grey text-grey-500 font-xssss border-0 lh-32 p-2 font-xssss fw-600 rounded-3 w-100 theme-dark-bg">
            </div> -->
            </div>
        </div>
    </transition-group>



</template>
<script>
import axios from 'axios';
import moment from 'moment';
export default {
    components: {

    }, data() {
        return {
            isDeleted: false,
        }

    }, methods: {
        timeAgo(time) {
            return moment(time).fromNow();
        },
        detectLanguage(text) {
            if (this.isArabic(text)) {
                return true;
            }
            return false;
        },
        isArabic(text) {
            const arabicRegex = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF]/;
            return arabicRegex.test(text);
        }, editPost(post, index) {
            this.$parent.current_editing_index = index;
            this.$parent.post = post;
            this.$parent.isEditModalVisisble = true;
            $('#editMessageModal').modal('show');  // Close the modal using Bootstrap's method
        }, deletePost(post, index) {
            axios.delete('api/softDelete/post', { params: { "post_id": post.post.id } })
                .then((Response) => {
                    console.log(Response)
                    this.isDeleted = true;
                    this.$root.current_posts.splice(index, 1);
                    setTimeout(() => {
                        this.isDeleted = false;
                    }, 1500);
                }).catch((error) => { });
        }, goToProfile(user_id) {
                window.location.href = `/user/${user_id}/profile`;
        }
    },
}

</script>
<style scoped>
/* Optional: Adjust the number's position and appearance */
.position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
    left: 45%;
    font-size: 20px;
    font-weight: bold;
    width: fit-content;
    height: fit-content;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    margin-left: 30%;
    background-color: rgba(0, 0, 0, 0.5);
    /* Semi-transparent background */
}

.alert {
    position: fixed;
    top: 20px;
    left: 40%;
    margin: 1rem 0;
    font-size: 1.1rem;
    font-weight: 500;
    z-index: 1065;
    ;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 1s;
}

.fade-enter,
.fade-leave-to

/* .fade-leave-active in <2.1.8 */
    {
    opacity: 0;
}
</style>