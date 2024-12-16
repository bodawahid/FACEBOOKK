<template>
    <create-post v-if="$root.profileUser.length == 0 || $root.user[0].id == $root.profileUser[0].userID"></create-post>
    <post-content></post-content>
    <MediaModal />
    <LikeModal />
    <Spinner></Spinner>
    <create-post-modal></create-post-modal>
    <edit-post v-if="isEditModalVisisble"></edit-post>
    <share-modal></share-modal>
    <!-- <comment-modal></comment-modal> -->
    <!-- <follow-people></follow-people> -->
    <!-- <Loading ></Loading> -->
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
import axios from "axios";
import LikeModal from "./LikeModal.vue";
import MediaModal from './MediaModal.vue';
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
        LikeModal: LikeModal,
        MediaModal: MediaModal,
        // "CommentModal": CommentModal,
    },
    data() {
        return {
            mediaFiles: [],
            isModalVisible: false,
            spinner: false,
            post: null,
            content: "",
            isEditModalVisisble: false,
            current_editing_index: null,
            sharingPostId: null,
            reactedUsers: [],
            // hasTriggered: true,
            // isLoading: true,
            marginFromBottom: 50, // 50px before the bottom
            currentPostMedia: [],
            currentPostIndex: 0,
            enterModal: false,
        };

    },
    methods: {
        openModal(post, index) {
            this.currentPostMedia = post;
            this.currentPostIndex = index;
            console.log(this.currentPostMedia);
            window.addEventListener('keydown', this.handleKeydown);
            $('#mediaModal').modal('show');

        },
        handleKeydown(event) {
            // Handle the arrow keys (left and right) for navigation
            if (event.key === 'ArrowRight') {
                this.nextMedia();  // Trigger the next media
            } else if (event.key === 'ArrowLeft') {
                this.prevMedia();  // Trigger the previous media
            } else if (event.key == 'Escape') {
                this.closeModal();
            }
        },
        nextMedia() {
            if (this.currentPostIndex < this.currentPostMedia.length - 1) {
                this.currentPostIndex++;
            } else {
                this.closeModal(); // Loop back to the first item
            }
        },
        closeModal() {
            $('#mediaModal').modal('hide');
            setTimeout(() => {
                window.removeEventListener('keydown', this.handleKeydown);
            }, 500);

        }
        , prevMedia() {
            if (this.currentPostIndex > 0) {
                this.currentPostIndex--;
            } else {
                this.closeModal();  // Loop back to the last item
            }
        },
        // checkScrollPosition() {
        //     const scrollPosition = window.scrollY + window.innerHeight; // Current scroll position + window height
        //     const pageHeight = document.body.offsetHeight; // Total height of the document

        //     // Check if we are within 50px of the bottom
        //     if (scrollPosition >= pageHeight - this.marginFromBottom && !this.hasTriggered) {
        //         this.hasTriggered = true;
        //         this.executeFunction();
        //         // this.isLoading = false;
        //     }
        // },

        executeFunction() {
            axios.get('/api/retrieve/data').
                then((response) => {
                    console.log(response.data)
                    this.$root.current_posts = response.data.posts;
                }).catch((error) => { });
        }
    },
    mounted() {
        const currentURL = window.location.pathname;
        const urlPattern = /^\/user\/\d+\/profile$/;
        if (!urlPattern.test(currentURL)) {
            this.executeFunction();
        }
    },
};
</script>
