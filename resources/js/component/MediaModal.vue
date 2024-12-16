<template>
    <div v-if="this.$parent.currentPostMedia.length" class="modal fade" id="mediaModal" tabindex="-1" role="dialog"
        aria-labelledby="mediaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediaModalLabel">PostMedia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        @click.prevent="$parent.closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Dynamic Media Content -->
                    <div v-if="currentMedia.SharedPostMediaType == 'image' || currentMedia.media_type == 'image'">
                        <img :src="'/storage/posts/media/' + (currentMedia.media_path ?? currentMedia.SharedPostMediaPath)"
                            class="img-fluid" alt="Image Preview">
                    </div>
                    <div v-else>
                        <video width="100%" controls>
                            <source
                                :src="'/storage/posts/media/' + (currentMedia.media_path ?? currentMedia.SharedPostMediaPath)"
                                type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="$parent.prevMedia()">Prev</button>
                    <button type="button" class="btn btn-primary" @click.prevent="$parent.nextMedia()">Next</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
    },
    computed: {
        currentMedia() {
            return this.$parent.currentPostMedia[this.$parent.currentPostIndex];
        },
    },
    methods: {

    }
}
</script>
<style scoped>
.modal-body img {
    max-height: 60vh;
    /* Set the max height to 80% of the viewport height */
    width: auto;
    /* Maintain aspect ratio by setting width to auto */
    margin: 0 auto;
    /* Center the image horizontally */
    display: block;
    /* Ensures the image behaves like a block element for centering */
}
</style>