<template>
    <div
        class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3"
    >
        <div class="card-body p-0">
            <div class="loader-overlay" id="loaderOverlay">
                <div class="loader"></div>
            </div>
            <a
                href="#"
                @click.prevent="createPost()"
                class="font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"
                :disabled="content == ''"
                ><i
                    class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"
                ></i
                >Create Post</a
            >
        </div>
        <!-- user image ... -->
        <div class="card-body p-0 mt-3 position-relative">
            <figure class="avatar position-absolute ms-2 mt-1 top-5 menu-icon">
                <img
                    :src="
                        '/storage/users/image/' +
                        ($root.user[0].profile_picture ??
                            'default121000000.jpg')
                    "
                    alt="image"
                    class="shadow-sm rounded-circle w30"
                />
            </figure>
            <textarea
                name="message"
                class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                cols="30"
                rows="10"
                placeholder="What's on your mind?"
                v-model="content"
            ></textarea>
        </div>
        <div class="card-body d-flex p-0 mt-0">
            <!-- live video (out) -->
            <!-- <a href="#" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i
                    class="font-md text-danger feather-video me-2"></i><span class="d-none-xs">Live Video</span></a> -->
            <a
                href="#"
                class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"
                @click.prevent="uploadMedia()"
                ><i class="font-md text-success feather-image me-2"></i
                ><span class="d-none-xs">Photo/Video</span></a
            >
            <!-- feeling activity... -->
            <!-- <a href="#" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i
                    class="font-md text-warning feather-camera me-2"></i><span
                    class="d-none-xs">Feeling/Activity</span></a> -->
            <!-- drop down menu -->
            <!-- <a href="#" class="ms-auto" id="dropdownMenu4" data-bs-toggle="dropdown" aria-expanded="false"><i
                    class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a> -->
            <!-- <div class="dropdown-menu dropdown-menu-start p-4 rounded-xxl border-0 shadow-lg"
                aria-labelledby="dropdownMenu4">
                <div class="card-body p-0 d-flex">
                    <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add
                            this
                            to your saved items</span></h4>
                </div>
                <div class="card-body p-0 d-flex mt-2">
                    <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide Post <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                            to
                            your saved items</span></h4>
                </div>
                <div class="card-body p-0 d-flex mt-2">
                    <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from
                        Group
                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                            to your saved items</span>
                    </h4>
                </div>
                <div class="card-body p-0 d-flex mt-2">
                    <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                    <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow
                        Group
                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save
                            to your saved items</span>
                    </h4>
                </div>
            </div> -->
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    components: {},
    data() {
        return {
            content: "",
            attachment: [],
        };
    },
    methods: {
        createPost() {
            if (!this.content) {
                return;
            }
            axios
                .post("api/create/post", { content: this.content, media: [] })
                .then((response) => {
                    // console.log(response.data.posts);
                    // this.$parent.spinner = true;
                    document.getElementById("loaderOverlay").style.visibility =
                        "visible";
                    this.$root.current_posts = [];
                    setTimeout(() => {
                        this.content = "";
                        this.$root.current_posts = response.data.posts;
                        // this.$parent.spinner = false;
                        document.getElementById(
                            "loaderOverlay"
                        ).style.visibility = "hidden";
                    }, 1500);
                })
                .catch((error) => {});
        },
        uploadMedia() {
            // alert('hello from uploading ');
            let file = document.createElement("input");
            file.setAttribute("type", "file");
            file.setAttribute("accept", "image/*,video/*");
            file.setAttribute("multiple", "multiple");
            file.addEventListener("change", () => {
                if (file.files.length) {
                    //this.$parent.mediaFiles = [];
                    this.attachment = file.files;
                    //this.$parent.currentIndex = 0;
                    Array.from(file.files).forEach((file) => {
                        let url = URL.createObjectURL(file);
                        if (file.type.includes("video/")) {
                            let myVideo = document.createElement("video"); // preferred and widely supported method
                            myVideo.src = url;
                            myVideo.addEventListener("loadedmetadata", () => {
                                this.$parent.mediaFiles.push({
                                    file,
                                    url,
                                    caption: "",
                                });
                            });
                        } else
                            this.$parent.mediaFiles.push({
                                file,
                                url,
                                caption: "",
                            });
                    });
                    this.$parent.isModalVisible = true;
                } else return;
            });
            file.click();
        },
    },
};
</script>
<style scoped>
.loader-overlay {
    position: fixed;
    top: 15%;
    left: 50%;
    transform: translateX(-50%);
    width: 50%;
    height: 100%;
    border-radius: 10px;
    background-color: rgba(0, 0, 0, 0.5);
    visibility: hidden;
    /* Hidden by default */
    justify-content: center;
    align-items: center;
    display: flex;
    z-index: 1055;
}

.loader {
    border: 16px solid #f3f3f3;
    border-top: 16px solid #3498db;
    border-radius: 50%;
    width: 80px;
    height: 80px;
    animation: spin 2s linear infinite;
}
.menu-icon {
    height: 45px;
    width: 25px;
    border-radius: 50%;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
