<template>
    <div class="loader-overlay" id="loaderOverlay">
        <div class="loader"></div>
    </div>
    <div class="modal fade" id="sharePostModal" tabindex="-1" aria-labelledby="sharePostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sharePostModalLabel">Share</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Shared Post Content -->
                    <div class="d-flex mb-3">
                        <figure class="avatar me-3">
                            <img :src="'storage/users/image/' + (this.$root.user[0].profile_picture ?? 'default121000000.jpg')"
                                alt="image" class="rounded-circle w45">
                        </figure>
                        <div style="margin-top: 1.5%;">
                            <h5 class="fw-700 text-dark">{{ this.$root.user[0].name }}</h5>
                        </div>
                    </div>

                    <!-- Custom Share Message -->
                    <div class="mb-3">
                        <label for="shareText" class="form-label">Say SomeThing About This</label>
                        <textarea class="form-control" style="height: auto; line-height: 20px;" id="shareText" rows="5"
                            placeholder="Write something about this post..." v-model="content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div v-if="isLoading" class="d-flex justify-content-center my-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        :disabled="!isLoading">Cancel</button>
                    <button type="button" class="btn btn-primary" @click.prevent="sharePost"
                        :disabled="isLoading">Share</button>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            content: '',
            isLoading: false
        }
    },
    methods: {
        sharePost() {
            this.isLoading = true;
            axios.post('api/share/post', { 'content': this.content, 'post_id': this.$parent.sharingPostId }).then((response) => {
                // this.$parent.spinner = true;
                document.getElementById("loaderOverlay").style.visibility = "visible";
                this.isLoading = false;
                this.$root.current_posts = [];
                this.content = '';
                setTimeout(() => {
                    this.$root.current_posts = response.data.posts;
                    // this.$parent.spinner = false;
                    document.getElementById("loaderOverlay").style.visibility = "hidden";
                }, 1500);
                $('#sharePostModal').modal('hide');  // Close the modal using Bootstrap's method
            }).catch((error) => { });

        },


    }
}
</script>