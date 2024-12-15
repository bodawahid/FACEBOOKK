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
                <!-- edit profile  -->
                <template v-else>
                    <div>
                        <!-- Button to Open Modal -->

                        <div
                            class="d-flex align-items-center justify-content-center position-absolute-md right-15 top-0 me-2">
                            <a style="cursor: pointer" @click.prevent="openEdit()"
                                class="d-none d-lg-block bg-success p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">Edit
                                Profile</a>
                            <a class="d-none d-lg-block bg-greylight btn-round-lg ms-2 rounded-3 text-grey-700"><i
                                    class="feather-mail font-md"></i></a>
                        </div>

                        <!-- Modal -->
                        <div v-if="showModal" class="modal-backdrop">
                            <div class="modal-container">
                                <h2>Edit Profile</h2>
                                <form @submit.prevent="saveChanges">
                                    <!-- User Name -->
                                    <div class="form-group">
                                        <label for="username">Name:</label>
                                        <input class="form-control post-textarea" id="username" type="text"
                                            v-model="userData.name" />
                                    </div>

                                    <!-- User Image -->
                                    <div class="form-group">
                                        <label for="userImage">Profile Image:</label>
                                        <input id="userImage" type="file" @change="
                                            handleImageChange('profile')
                                            " v-on="userData.profileImage" />
                                        <img width="400px" height="400px" :src="preview.profile" alt="Profile Preview"
                                            v-if="preview.profile" class="preview-image" />
                                    </div>

                                    <!-- User Cover Image -->
                                    <div class="form-group">
                                        <label for="coverImage">Cover Image:</label>
                                        <input id="coverImage" type="file" @change="handleImageChange('cover')"
                                            v-on="userData.coverImage" />
                                        <img width="400px" height="400px" :src="preview.cover" alt="Cover Preview"
                                            v-if="preview.cover" class="preview-image" />
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="form-actions">
                                        <button type="submit" :disabled="userData.name ===
                                            $root.user[0].name &&
                                            userData.profileImage ===
                                            null &&
                                            userData.coverImage === null
                                            ">
                                            Save Changes
                                        </button>
                                        <button type="button" @click="showModal = false">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>
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
                            @click="fetchFollowing($root.profileUser[0].userID)" data-bs-toggle="modal"
                            data-bs-target="#followingModal">
                            Following
                        </button>
                    </li>
                    <li class="list-inline-item me-5">
                        <button type="button" class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                            style="border: none; background-color: white;"
                            @click="fetchFollowers($root.profileUser[0].userID)" data-bs-toggle="modal"
                            data-bs-target="#followersModal">
                            Followers
                        </button>
                    </li>

                    <!-- followers modal -->
                    <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="followersModalLabel">Followers</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
                    <div class="modal fade" id="followingModal" tabindex="-1" aria-labelledby="followingModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="followingModalLabel">Following</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
            following: [],      // list of following
            showModal: false,
            userData: {
                name: "", // Default user name
                profileImage: null, // Will hold the profile image file
                coverImage: null, // Will hold the cover image file
            },
            preview: {
                profile: "", // Profile image preview URL
                cover: "", // Cover image preview URL
            },
            oldName: "", // Store the old name
        };
    },
    mounted() {
        this.initializeUserData();
    },
    created() {
        this.checkFollowing();  // updates the 'isFollowing' on page load
    }, methods: {
        openEdit() {
            this.userData.name = this.$root.profileUser[0].name;
            this.showModal = true;
        },
        async checkFollowing(userId) {
            try {
                const response = await axios.get(`/api/is-following/${userId}`);
                this.isFollowing = response.data.is_following;
            } catch (error) {
                console.error('Error checking follow status:', error);
            }
        },
        async toggleFollow(userId) {
            try {
                if (this.isFollowing) {     // unfollow
                    await axios.post('/api/unfollow/people', { user_id: userId });
                    this.isFollowing = false;
                }
                else {      // follow
                    await axios.post('/api/follow/people', { user_id: userId });
                    this.isFollowing = true;
                }
            } catch (error) {
                console.error('Error toggling follow status:', error);
            }
        },

        fetchFollowers(userId) {
            axios
                .post('/api/followers', { user_id: userId })
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
        },
        initializeUserData() {
            if (!this.userData.name)
                this.userData.name = this.$root.user[0].name;
            this.saveChanges();
        },
        handleImageChange(type) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.preview[type] = e.target.result; // Update preview
                    this.userData[`${type}Image`] = file; // Update the file object
                };
                reader.readAsDataURL(file);
            }
        },
        saveChanges() {
            console.log("Saving changes... edited");
            this.updateProfile(); // Call updateProfile on save
            this.showModal = false; // Close the modal after saving
        },
        updateProfile() {
            // const profileData = {};

            // // Only include 'name' if it's provided
            // profileData.name = this.userData.name;

            // // Only include profile_image if provided
            // if (this.userData.profileImage) {
            //     profileData.profile_image = this.getBase64Image(
            //         this.userData.profileImage
            //     );
            // }

            // // Only include cover_image if provided
            // if (this.userData.coverImage) {
            //     profileData.cover_image = this.getBase64Image(
            //         this.userData.coverImage
            //     );
            // }

            const formData = new FormData();
            if (this.userData.name != this.$root.profileUser[0].name)
                formData.append('name', this.userData.name);
            // if (!this.userData.profileImage) {
            formData.append('profile_image', this.userData.profileImage ?? '');
            // }
            // if (!this.userData.coverImage) {
            formData.append('cover_image', this.userData.coverImage ?? '');
            // }
            // Make the API call to update the profile
            axios
                .post("/api/update/profile", formData)
                .then((response) => {
                    console.log(
                        "Profile updated successfully:",
                        response.data.message
                    );
                    if (this.userData.name != this.$root.profileUser[0].name)
                        this.$root.profileUser[0].name = this.userData.name;
                    this.showModal = false; // Close the modal on success
                })
                .catch((error) => {
                    console.error(
                        "Error updating profile:",
                        error.response.data
                    );
                });
            // location.reload(true);
        },
        getBase64Image(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onloadend = () => resolve(reader.result.split(",")[1]); // Remove the 'data:image/...;base64,' prefix
                reader.onerror = reject;
                reader.readAsDataURL(file);
            });
        },
    },
    props: {
        profileUserId: { type: Number, required: true }
    },
    mounted() {     //check follow status when the component is mounted
        this.checkFollowing(this.$root.profileUser[0].userID);
    },
};



</script>

<!-- style -->

<style scoped>
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}

.preview-image {
    max-width: 100%;
    margin-top: 10px;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.form-actions button {
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.form-actions button:first-child {
    background-color: #007bff;
    color: white;
}

.form-actions button:last-child {
    background-color: #dc3545;
    color: white;
}
</style>