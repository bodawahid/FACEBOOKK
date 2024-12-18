<template>
    <!-- Modal Structure -->
    <div
        v-if="$parent.isModalVisible"
        class="modal fade show"
        id="createPostModal"
        tabindex="-1"
        aria-labelledby="createPostModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModalLabel">
                        Create Post
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        @click="closeModal"
                    ></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitPost">
                        <!-- File input for photos/videos -->
                        <div class="mb-3">
                            <label for="media" class="form-label"
                                >Create Post</label
                            >
                        </div>

                        <!-- Caption input -->
                        <div class="mb-3">
                            <!-- <label for="caption" class="form-label">Caption</label> -->
                            <textarea
                                id="caption"
                                v-model="caption"
                                class="form-control"
                                rows="3"
                                placeholder="Enter a caption..."
                                style="scrollbar-width: none"
                            ></textarea>
                        </div>

                        <!-- Preview Section -->
                        <div v-if="$parent.mediaFiles.length" class="mb-3">
                            <div
                                class="media-grid"
                                :class="{
                                    'media-one':
                                        $parent.mediaFiles.length === 1,
                                    'media-two':
                                        $parent.mediaFiles.length === 2,
                                    'media-three':
                                        $parent.mediaFiles.length === 3,
                                    'media-four':
                                        $parent.mediaFiles.length >= 4,
                                }"
                            >
                                <div
                                    v-for="(file, index) in $parent.mediaFiles"
                                    :key="index"
                                >
                                    <div
                                        v-if="
                                            file.file.type.includes('image/') &&
                                            index < 4
                                        "
                                        class="media-item"
                                    >
                                        <img
                                            :src="file.url"
                                            alt="Image Preview"
                                            class="img-thumbnail"
                                            style="width: 100%; height: 100%"
                                        />
                                        <div
                                            class="overlay"
                                            v-if="
                                                index == 3 &&
                                                $parent.mediaFiles.length > 4
                                            "
                                        >
                                            <span class="remaining-text">{{
                                                "+ " + remainingCount()
                                            }}</span>
                                        </div>
                                    </div>
                                    <div
                                        v-else-if="
                                            file.file.type.includes('video/') &&
                                            index < 4
                                        "
                                        class="media-item"
                                    >
                                        <video
                                            :src="file.url"
                                            controls
                                            class="img-thumbnail"
                                            style="width: 100%; height: 100%"
                                        ></video>
                                        <div
                                            class="overlay"
                                            v-if="
                                                index == 3 &&
                                                $parent.mediaFiles.length > 4
                                            "
                                        >
                                            <span class="remaining-text">{{
                                                "+ " + remainingCount()
                                            }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            v-if="isLoading"
                            class="d-flex justify-content-center my-3"
                        >
                            <div
                                class="spinner-border text-primary"
                                role="status"
                            >
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                @click="closeModal"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="isLoading == true"
                            >
                                Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            isModalVisible: false, // Control modal visibility
            caption: "", // The caption text
            selectedFiles: [], // Array to store selected files (images or videos)
            isLoading: false,
        };
    },
    methods: {
        remainingCount() {
            return this.$parent.mediaFiles.length - 4;
        },

        // Closing modal
        closeModal() {
            this.$parent.isModalVisible = false;
            this.caption = ""; // Reset the caption
            this.$parent.mediaFiles = []; // Clear the selected files
        },
        // submitting post
        submitPost() {
            this.isLoading = true;
            const formData = new FormData();

            if (this.caption) formData.append("content", this.caption);

            this.$parent.mediaFiles.forEach((file, index) => {
                formData.append(`media[${index}]`, file.file);
            });
            formData.append("content_type", "attachement");
            // Send form data to backend (use Axios or fetch)
            axios
                .post("/api/create/post", formData)
                .then((response) => {
                    this.isLoading = false;
                    this.closeModal(); // Close the modal after successful submission
                    document.getElementById("loaderOverlay").style.visibility =
                        "visible";
                    this.$root.current_posts = [];
                    setTimeout(() => {
                        this.caption = "";
                        this.$root.current_posts = response.data.posts;
                        // this.$parent.spinner = false;
                        document.getElementById(
                            "loaderOverlay"
                        ).style.visibility = "hidden";
                    }, 1500);
                })
                .catch((error) => {
                    console.error("Error creating post", error);
                });
        },
    },
};
</script>

<style scoped>
/* Optional: Customize modal and other elements as needed */
.modal {
    display: block;
    /* Make the modal visible when active */
}

.media-grid {
    display: grid;
    gap: 5px;
}

.media-one {
    grid-template-columns: 1fr;
}

.media-two {
    grid-template-columns: 1fr 1fr;
}

.media-three {
    grid-template-columns: 1fr 1fr 1fr;
}

.media-four {
    grid-template-columns: 1fr 1fr 1fr 1fr;
}

.media-item {
    position: relative;
}

.media-item img,
.media-item video {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
}

.overlay {
    position: absolute;
    top: 45%;
    left: 45%;
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
    padding: 5px;
    font-size: 14px;
    border-radius: 5px;
}

.remaining-text {
    font-weight: bold;
}
</style>
