<template>
    <div v-if="successMessage" class="alert alert-success" role="alert">
        Post updated successfully!
    </div>
    <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Your Post</h5>
                    <button type="button" class="btn-close" @click.prevent="closeModal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form>
                        <!-- Post Text Area -->
                        <div class="mb-3">
                            <label for="postText" class="form-label">Update Your Post</label>
                            <textarea class="form-control post-textarea" id="postText"
                                placeholder="What's on your mind?" rows="2" v-model="content">
                            </textarea>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3" v-if="post.postMedia.length > 0">
                            <span v-for="media in post.postMedia" :key="media.id">
                                <img v-if="media.media_type === 'image'"
                                    :src="'storage/posts/media/' + media.media_path" class="post-image-preview">
                                <video v-else :src="'storage/posts/media/' + media.media_path" controls
                                    class="post-video-preview"></video>
                            </span>
                        </div>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div v-if="isLoading" class="d-flex justify-content-center my-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-close" @click.prevent="closeModal"></button>
                    <button type="button" class="btn btn-save" id="saveChangesBtn" @click="editPost"
                        :disabled="content === post.post.content || isLoading">Save Changes</button>
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
            isModalVisible: false,  // Manage modal visibility
            isLoading: false,       // Loading state for API request
            post: this.$parent.post || {},  // Get post data from parent
            content: this.$parent.post.post.content,            // Content of the post
            successMessage: false,
        }
    },
    methods: {
        closeModal() {
            $('#editMessageModal').modal('hide');  // Close the modal using Bootstrap's method
        },
        editPost() {
            this.isLoading = true;
            axios.post('api/edit/post', {'content': this.content, 'post_id': this.$parent.post.post.id })
                .then((response) => {
                    this.successMessage = true;
                    this.$root.current_posts[this.$parent.current_editing_index].post.content = this.content;
                    this.isLoading = false;
                    setTimeout(() => {
                        this.successMessage = false;
                    }, 1500);
                })
                .catch((error) => {
                    this.isLoading = false;
                    console.error("Error updating post:", error);
                });
        }

    },
}
</script>

<style scoped>
.modal-content {
    border-radius: 12px;
    overflow: hidden;
    border: none;
}

.modal-header {
    border-bottom: none;
    background-color: #f4f4f4;
    color: #333;
    font-weight: 500;
    padding: 1rem;
}

.modal-body {
    overflow-y: auto;
    background-color: #ffffff;
    padding: 1rem;
    max-height: 480px;
}

.modal-footer {
    border-top: none;
    background-color: #f4f4f4;
    padding: 1rem;
    display: flex;
    justify-content: flex-end;
}

.post-textarea {
    min-height: 150px;
    resize: none;
}

.post-image-preview {
    max-width: 100%;
    max-height: 200px;
    object-fit: cover;
    margin-top: 10px;
}

.form-label {
    font-size: 1rem;
    color: #555;
}

.modal-dialog {
    max-width: 600px;
}

/* Button Styling */
.btn-save {
    background-color: #4267b2;
    /* Facebook Blue */
    color: white;
    border-radius: 5px;
}

.btn-close {
    background-color: #e4e6eb;
    /* Light gray */
    color: #333;
}

.post-video-preview {
    max-width: 100%;
    height: auto;
    object-fit: contain;
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
</style>