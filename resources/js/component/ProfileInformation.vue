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
                        class="d-none d-lg-block bg-success p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">Add
                        Friend</a>
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
                        <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs1"
                            data-toggle="tab">Following</a>
                    </li>
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
export default {};
</script>
