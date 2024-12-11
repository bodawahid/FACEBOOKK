<template>
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Reacts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-y: auto;">
                    <!-- <p>Do you like this content?</p> -->
                    <p><strong>Users who reacted:</strong></p>
                    <ul class="list-unstyled">
                        <!-- Liked Users -->
                        <span v-if="$parent.reactedUsers.length">
                            <li class="reaction-item" v-for="user in $parent.reactedUsers">
                                <img :src="'/storage/users/image/' + (user.profile_picture ?? 'default121000000.jpg')">
                                <span>{{ user.name }}</span>
                            </li>
                        </span>
                        <span v-else>
                            {{ "No reacts yet" }}
                        </span>
                    </ul>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {

        }
    }
    , methods: {

    }


}



</script>
<style scoped>
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