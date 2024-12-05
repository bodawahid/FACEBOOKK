<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sociala - Social Network App HTML Template </title>

    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
    {{--  Favicon icon  --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    {{-- Custom Stylesheet  --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/emoji.css') }}">

    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">
    @vite(['resources/js/facebookApp.js'])
</head>

<body class="color-theme-blue mont-font">
    <div id="app">
        <div class="preloader"></div>


        <div class="main-wrapper">
            {{-- header of the page --}}
            <!-- navigation top-->
            <headers></headers>
            <!-- navigation top -->

            <!-- navigation left -->

            <!-- navigation left -->
            <!-- main content -->
            <div class="main-content right-chat-active">

                <div class="middle-sidebar-bottom">
                    <div class="middle-sidebar-left">
                        {{-- load wrapper --}}
                        <main-content></main-content>
                        <!-- loader wrapper -->
                        <div class="row feed-body">
                            <div class="col-xl-8 col-xxl-9 col-lg-8">
                                {{-- create post --}}

                                {{-- post content it self --}}

                                <posts></posts>

                                {{-- live section --}}
                                {{-- <div
                                    class="card w-100 shadow-none bg-transparent bg-transparent-card border-0 p-0 mb-0">
                                    <div class="owl-carousel category-card owl-theme overflow-hidden nav-none">
                                        <div class="item">
                                            <div
                                                class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                                <div class="card-body position-relative h100 bg-image-cover bg-image-center"
                                                    style="background-image: url(images/u-bg.jpg);"></div>
                                                <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                                    <figure
                                                        class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1">
                                                        <img src="images/user-11.png" alt="image"
                                                            class="float-right p-1 bg-white rounded-circle w-100">
                                                    </figure>
                                                    <div class="clearfix"></div>
                                                    <h4 class="fw-700 font-xsss mt-2 mb-1">Aliqa Macale </h4>
                                                    <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">
                                                        support@gmail.com
                                                    </p>
                                                    <span
                                                        class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                                    <div class="clearfix mb-2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item">
                                            <div
                                                class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                                <div class="card-body position-relative h100 bg-image-cover bg-image-center"
                                                    style="background-image: url(images/s-2.jpg);"></div>
                                                <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                                    <figure
                                                        class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1">
                                                        <img src="images/user-2.png" alt="image"
                                                            class="float-right p-1 bg-white rounded-circle w-100">
                                                    </figure>
                                                    <div class="clearfix"></div>
                                                    <h4 class="fw-700 font-xsss mt-2 mb-1">Seary Victor </h4>
                                                    <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">
                                                        support@gmail.com
                                                    </p>
                                                    <span
                                                        class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                                    <div class="clearfix mb-2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item">
                                            <div
                                                class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                                <div class="card-body position-relative h100 bg-image-cover bg-image-center"
                                                    style="background-image: url(images/s-6.jpg);"></div>
                                                <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                                    <figure
                                                        class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1">
                                                        <img src="images/user-3.png" alt="image"
                                                            class="float-right p-1 bg-white rounded-circle w-100">
                                                    </figure>
                                                    <div class="clearfix"></div>
                                                    <h4 class="fw-700 font-xsss mt-2 mb-1">John Steere </h4>
                                                    <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">
                                                        support@gmail.com
                                                    </p>
                                                    <span
                                                        class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                                    <div class="clearfix mb-2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item">
                                            <div
                                                class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                                <div class="card-body position-relative h100 bg-image-cover bg-image-center"
                                                    style="background-image: url(images/bb-16.png);"></div>
                                                <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                                    <figure
                                                        class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1">
                                                        <img src="images/user-4.png" alt="image"
                                                            class="float-right p-1 bg-white rounded-circle w-100">
                                                    </figure>
                                                    <div class="clearfix"></div>
                                                    <h4 class="fw-700 font-xsss mt-2 mb-1">Mohannad Zitoun </h4>
                                                    <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">
                                                        support@gmail.com
                                                    </p>
                                                    <span
                                                        class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                                    <div class="clearfix mb-2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item">
                                            <div
                                                class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                                <div class="card-body position-relative h100 bg-image-cover bg-image-center"
                                                    style="background-image: url(images/e-4.jpg);"></div>
                                                <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                                    <figure
                                                        class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1">
                                                        <img src="images/user-7.png" alt="image"
                                                            class="float-right p-1 bg-white rounded-circle w-100">
                                                    </figure>
                                                    <div class="clearfix"></div>
                                                    <h4 class="fw-700 font-xsss mt-2 mb-1">Studio Express </h4>
                                                    <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">
                                                        support@gmail.com
                                                    </p>
                                                    <span
                                                        class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                                    <div class="clearfix mb-2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item">
                                            <div
                                                class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                                <div class="card-body position-relative h100 bg-image-cover bg-image-center"
                                                    style="background-image: url(images/coming-soon.png);"></div>
                                                <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                                    <figure
                                                        class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1">
                                                        <img src="images/user-5.png" alt="image"
                                                            class="float-right p-1 bg-white rounded-circle w-100">
                                                    </figure>
                                                    <div class="clearfix"></div>
                                                    <h4 class="fw-700 font-xsss mt-2 mb-1">Hendrix Stamp </h4>
                                                    <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">
                                                        support@gmail.com
                                                    </p>
                                                    <span
                                                        class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                                    <div class="clearfix mb-2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item">
                                            <div
                                                class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                                <div class="card-body position-relative h100 bg-image-cover bg-image-center"
                                                    style="background-image: url(images/bb-9.jpg);"></div>
                                                <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                                    <figure
                                                        class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1">
                                                        <img src="images/user-6.png" alt="image"
                                                            class="float-right p-1 bg-white rounded-circle w-100">
                                                    </figure>
                                                    <div class="clearfix"></div>
                                                    <h4 class="fw-700 font-xsss mt-2 mb-1">Mohannad Zitoun </h4>
                                                    <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">
                                                        support@gmail.com
                                                    </p>
                                                    <span
                                                        class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                                    <div class="clearfix mb-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- follow --}}

                                {{-- image and text --}}

                                {{-- text and image --}}

                            </div>
                            {{-- friend request part --}}
                            {{-- <div class="col-xl-4 col-xxl-3 col-lg-4 ps-lg-0">
                                <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                                    <div class="card-body d-flex align-items-center p-4">
                                        <h4 class="fw-700 mb-0 font-xssss text-grey-900">Friend Request</h4>
                                        <a href="default-member.html" class="fw-600 ms-auto font-xssss text-primary">See
                                            all</a>
                                    </div>
                                    <div class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0">
                                        <figure class="avatar me-3"><img src="images/user-7.png" alt="image"
                                                class="shadow-sm rounded-circle w45"></figure>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-1">Anthony Daugloi <span
                                                class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">12 mutual
                                                friends</span></h4>
                                    </div>
                                    <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">
                                        <a href="#"
                                            class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl">Confirm</a>
                                        <a href="#"
                                            class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl">Delete</a>
                                    </div>

                                    <div class="card-body d-flex pt-0 ps-4 pe-4 pb-0">
                                        <figure class="avatar me-3"><img src="images/user-8.png" alt="image"
                                                class="shadow-sm rounded-circle w45"></figure>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-1">Mohannad Zitoun <span
                                                class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">12 mutual
                                                friends</span></h4>
                                    </div>
                                    <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">
                                        <a href="#"
                                            class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl">Confirm</a>
                                        <a href="#"
                                            class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl">Delete</a>
                                    </div>

                                    <div class="card-body d-flex pt-0 ps-4 pe-4 pb-0">
                                        <figure class="avatar me-3"><img src="images/user-12.png" alt="image"
                                                class="shadow-sm rounded-circle w45"></figure>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-1">Mohannad Zitoun <span
                                                class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">12 mutual
                                                friends</span></h4>
                                    </div>
                                    <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">
                                        <a href="#"
                                            class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl">Confirm</a>
                                        <a href="#"
                                            class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl">Delete</a>
                                    </div>
                                </div>

                                <div class="card w-100 shadow-xss rounded-xxl border-0 p-0 ">
                                    <div class="card-body d-flex align-items-center p-4 mb-0">
                                        <h4 class="fw-700 mb-0 font-xssss text-grey-900">Confirm Friend</h4>
                                        <a href="default-member.html"
                                            class="fw-600 ms-auto font-xssss text-primary">See
                                            all</a>
                                    </div>
                                    <div
                                        class="card-body bg-transparent-card d-flex p-3 bg-greylight ms-3 me-3 rounded-3">
                                        <figure class="avatar me-2 mb-0"><img src="images/user-7.png" alt="image"
                                                class="shadow-sm rounded-circle w45"></figure>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-2">Anthony Daugloi <span
                                                class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">12 mutual
                                                friends</span></h4>
                                        <a href="#"
                                            class="btn-round-sm bg-white text-grey-900 feather-chevron-right font-xss ms-auto mt-2"></a>
                                    </div>
                                    <div class="card-body bg-transparent-card d-flex p-3 bg-greylight m-3 rounded-3"
                                        style="margin-bottom: 0 !important;">
                                        <figure class="avatar me-2 mb-0"><img src="images/user-8.png" alt="image"
                                                class="shadow-sm rounded-circle w45"></figure>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-2"> David Agfree <span
                                                class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">12 mutual
                                                friends</span></h4>
                                        <a href="#"
                                            class="btn-round-sm bg-white text-grey-900 feather-plus font-xss ms-auto mt-2"></a>
                                    </div>
                                    <div class="card-body bg-transparent-card d-flex p-3 bg-greylight m-3 rounded-3">
                                        <figure class="avatar me-2 mb-0"><img src="images/user-12.png" alt="image"
                                                class="shadow-sm rounded-circle w45"></figure>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-2">Hugury Daugloi <span
                                                class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">12 mutual
                                                friends</span></h4>
                                        <a href="#"
                                            class="btn-round-sm bg-white text-grey-900 feather-plus font-xss ms-auto mt-2"></a>
                                    </div>

                                </div>

                                <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3 mt-3">
                                    <div class="card-body d-flex align-items-center p-4">
                                        <h4 class="fw-700 mb-0 font-xssss text-grey-900">Suggest Group</h4>
                                        <a href="default-group.html"
                                            class="fw-600 ms-auto font-xssss text-primary">See
                                            all</a>
                                    </div>
                                    <div
                                        class="card-body d-flex pt-4 ps-4 pe-4 pb-0 overflow-hidden border-top-xs bor-0">
                                        <img src="images/e-2.jpg" alt="img" class="img-fluid rounded-xxl mb-2">
                                    </div>
                                    <div class="card-body dd-block pt-0 ps-4 pe-4 pb-4">
                                        <ul class="memberlist mt-1 mb-2 ms-0 d-block">
                                            <li class="w20"><a href="#"><img src="images/user-6.png"
                                                        alt="user" class="w35 d-inline-block"
                                                        style="opacity: 1;"></a></li>
                                            <li class="w20"><a href="#"><img src="images/user-7.png"
                                                        alt="user" class="w35 d-inline-block"
                                                        style="opacity: 1;"></a></li>
                                            <li class="w20"><a href="#"><img src="images/user-8.png"
                                                        alt="user" class="w35 d-inline-block"
                                                        style="opacity: 1;"></a></li>
                                            <li class="w20"><a href="#"><img src="images/user-3.png"
                                                        alt="user" class="w35 d-inline-block"
                                                        style="opacity: 1;"></a></li>
                                            <li class="last-member"><a href="#"
                                                    class="bg-greylight fw-600 text-grey-500 font-xssss w35 ls-3 text-center"
                                                    style="height: 35px; line-height: 35px;">+2</a></li>
                                            <li class="ps-3 w-auto ms-1"><a href="#"
                                                    class="fw-600 text-grey-500 font-xssss">Member apply</a></li>
                                        </ul>
                                    </div>



                                </div>

                                <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                                    <div class="card-body d-flex align-items-center p-4">
                                        <h4 class="fw-700 mb-0 font-xssss text-grey-900">Suggest Pages</h4>
                                        <a href="default-group.html"
                                            class="fw-600 ms-auto font-xssss text-primary">See
                                            all</a>
                                    </div>
                                    <div
                                        class="card-body d-flex pt-4 ps-4 pe-4 pb-0 overflow-hidden border-top-xs bor-0">
                                        <img src="images/g-2.jpg" alt="img" class="img-fluid rounded-xxl mb-2">
                                    </div>
                                    <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">
                                        <a href="#"
                                            class="p-2 lh-28 w-100 bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i
                                                class="feather-external-link font-xss me-2"></i> Like Page</a>
                                    </div>

                                    <div class="card-body d-flex pt-0 ps-4 pe-4 pb-0 overflow-hidden">
                                        <img src="images/g-3.jpg" alt="img"
                                            class="img-fluid rounded-xxl mb-2 bg-lightblue">
                                    </div>
                                    <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">
                                        <a href="#"
                                            class="p-2 lh-28 w-100 bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i
                                                class="feather-external-link font-xss me-2"></i> Like Page</a>
                                    </div>


                                </div>


                                <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                                    <div class="card-body d-flex align-items-center  p-4">
                                        <h4 class="fw-700 mb-0 font-xssss text-grey-900">Event</h4>
                                        <a href="default-event.html"
                                            class="fw-600 ms-auto font-xssss text-primary">See
                                            all</a>
                                    </div>
                                    <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                                        <div class="bg-success me-2 p-3 rounded-xxl">
                                            <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span
                                                    class="ls-1 d-block font-xsss text-white fw-600">FEB</span>22</h4>
                                        </div>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-2">Meeting with clients <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison
                                                ave,
                                                floor 24 new work, NY 10010</span> </h4>
                                    </div>

                                    <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                                        <div class="bg-warning me-2 p-3 rounded-xxl">
                                            <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span
                                                    class="ls-1 d-block font-xsss text-white fw-600">APR</span>30</h4>
                                        </div>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-2">Developer Programe <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison
                                                ave,
                                                floor 24 new work, NY 10010</span> </h4>
                                    </div>

                                    <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                                        <div class="bg-primary me-2 p-3 rounded-xxl">
                                            <h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span
                                                    class="ls-1 d-block font-xsss text-white fw-600">APR</span>23</h4>
                                        </div>
                                        <h4 class="fw-700 text-grey-900 font-xssss mt-2">Aniversary Event <span
                                                class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison
                                                ave,
                                                floor 24 new work, NY 10010</span> </h4>
                                    </div>

                                </div>
                            </div> --}}

                        </div>
                    </div>

                </div>
            </div>
            <!-- main content -->

            <!-- right chat -->
            <div class="right-chat nav-wrap mt-2 right-scroll-bar">
                <div class="middle-sidebar-right-content bg-white shadow-xss rounded-xxl">

                    <!-- loader wrapper -->
                    <div class="preloader-wrap p-3">
                        <div class="box shimmer">
                            <div class="lines">
                                <div class="line s_shimmer"></div>
                                <div class="line s_shimmer"></div>
                                <div class="line s_shimmer"></div>
                                <div class="line s_shimmer"></div>
                            </div>
                        </div>
                        <div class="box shimmer mb-3">
                            <div class="lines">
                                <div class="line s_shimmer"></div>
                                <div class="line s_shimmer"></div>
                                <div class="line s_shimmer"></div>
                                <div class="line s_shimmer"></div>
                            </div>
                        </div>
                        <div class="box shimmer">
                            <div class="lines">
                                <div class="line s_shimmer"></div>
                                <div class="line s_shimmer"></div>
                                <div class="line s_shimmer"></div>
                                <div class="line s_shimmer"></div>
                            </div>
                        </div>
                    </div>
                    <!-- loader wrapper -->

                    <div class="section full pe-3 ps-4 pt-4 position-relative feed-body">
                        <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">CONTACTS</h4>
                        <ul class="list-group list-group-flush">
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                                <figure class="avatar float-left mb-0 me-2">
                                    <img src="images/user-8.png" alt="image" class="w35">
                                </figure>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Hurin Seary</a>
                                </h3>
                                <span class="badge badge-primary text-white badge-pill fw-500 mt-0">2</span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                                <figure class="avatar float-left mb-0 me-2">
                                    <img src="images/user-7.png" alt="image" class="w35">
                                </figure>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Victor Exrixon</a>
                                </h3>
                                <span class="bg-success ms-auto btn-round-xss"></span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                                <figure class="avatar float-left mb-0 me-2">
                                    <img src="images/user-6.png" alt="image" class="w35">
                                </figure>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Surfiya Zakir</a>
                                </h3>
                                <span class="bg-warning ms-auto btn-round-xss"></span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                                <figure class="avatar float-left mb-0 me-2">
                                    <img src="images/user-5.png" alt="image" class="w35">
                                </figure>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Goria Coast</a>
                                </h3>
                                <span class="bg-success ms-auto btn-round-xss"></span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                                <figure class="avatar float-left mb-0 me-2">
                                    <img src="images/user-4.png" alt="image" class="w35">
                                </figure>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Hurin Seary</a>
                                </h3>
                                <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">4:09 pm</span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                                <figure class="avatar float-left mb-0 me-2">
                                    <img src="images/user-3.png" alt="image" class="w35">
                                </figure>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">David Goria</a>
                                </h3>
                                <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 days</span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                                <figure class="avatar float-left mb-0 me-2">
                                    <img src="images/user-2.png" alt="image" class="w35">
                                </figure>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Seary Victor</a>
                                </h3>
                                <span class="bg-success ms-auto btn-round-xss"></span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                                <figure class="avatar float-left mb-0 me-2">
                                    <img src="images/user-12.png" alt="image" class="w35">
                                </figure>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Ana Seary</a>
                                </h3>
                                <span class="bg-success ms-auto btn-round-xss"></span>
                            </li>

                        </ul>
                    </div>
                    <div class="section full pe-3 ps-4 pt-4 pb-4 position-relative feed-body">
                        <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">GROUPS</h4>
                        <ul class="list-group list-group-flush">
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                                <span
                                    class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Studio Express</a>
                                </h3>
                                <span class="badge mt-0 text-grey-500 badge-pill pe-0 font-xsssss">2 min</span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                                <span
                                    class="btn-round-sm bg-gold-gradiant me-3 ls-3 text-white font-xssss fw-700">AR</span>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Armany Design</a>
                                </h3>
                                <span class="bg-warning ms-auto btn-round-xss"></span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                                <span
                                    class="btn-round-sm bg-mini-gradiant me-3 ls-3 text-white font-xssss fw-700">UD</span>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">De fabous</a>
                                </h3>
                                <span class="bg-success ms-auto btn-round-xss"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="section full pe-3 ps-4 pt-0 pb-4 position-relative feed-body">
                        <h4 class="font-xsssss text-grey-500 text-uppercase fw-700 ls-3">Pages</h4>
                        <ul class="list-group list-group-flush">
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                                <span
                                    class="btn-round-sm bg-primary-gradiant me-3 ls-3 text-white font-xssss fw-700">AB</span>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Armany Seary</a>
                                </h3>
                                <span class="bg-success ms-auto btn-round-xss"></span>
                            </li>
                            <li
                                class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">

                                <span
                                    class="btn-round-sm bg-gold-gradiant me-3 ls-3 text-white font-xssss fw-700">SD</span>
                                <h3 class="fw-700 mb-0 mt-0">
                                    <a class="font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                        href="#">Entropio Inc</a>
                                </h3>
                                <span class="bg-success ms-auto btn-round-xss"></span>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>


            <!-- right chat -->

            <div class="app-footer border-0 shadow-lg bg-primary-gradiant">
                <a href="default.html" class="nav-content-bttn nav-center"><i class="feather-home"></i></a>
                <a href="default-video.html" class="nav-content-bttn"><i class="feather-package"></i></a>
                <a href="default-live-stream.html" class="nav-content-bttn" data-tab="chats"><i
                        class="feather-layout"></i></a>
                <a href="shop-2.html" class="nav-content-bttn"><i class="feather-layers"></i></a>
                <a href="default-settings.html" class="nav-content-bttn"><img src="images/female-profile.png"
                        alt="user" class="w30 shadow-xss"></a>
            </div>

            <div class="app-header-search">
                <form class="search-form">
                    <div class="form-group searchbox mb-0 border-0 p-1">
                        <input type="text" class="form-control border-0" placeholder="Search...">
                        <i class="input-icon">
                            <ion-icon name="search-outline" role="img" class="md hydrated"
                                aria-label="search outline"></ion-icon>
                        </i>
                        <a href="#" class="ms-1 mt-1 d-inline-block close searchbox-close">
                            <i class="ti-close font-xs"></i>
                        </a>
                    </div>
                </form>
            </div>

        </div>

        <div class="modal bottom side fade" id="Modalstory" tabindex="-1" role="dialog"
            style=" overflow-y: auto;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0 bg-transparent">
                    <button type="button" class="close mt-0 position-absolute top--30 right--10"
                        data-dismiss="modal" aria-label="Close"><i
                            class="ti-close text-grey-900 font-xssss"></i></button>
                    <div class="modal-body p-0">
                        <div class="card w-100 border-0 rounded-3 overflow-hidden bg-gradiant-bottom bg-gradiant-top">
                            <div class="owl-carousel owl-theme dot-style3 story-slider owl-dot-nav nav-none">
                                <div class="item"><img src="images/story-5.jpg" alt="image"></div>
                                <div class="item"><img src="images/story-6.jpg" alt="image"></div>
                                <div class="item"><img src="images/story-7.jpg" alt="image"></div>
                                <div class="item"><img src="images/story-8.jpg" alt="image"></div>

                            </div>
                        </div>
                        <div class="form-group mt-3 mb-0 p-3 position-absolute bottom-0 z-index-1 w-100">
                            <input type="text"
                                class="style2-input w-100 bg-transparent border-light-md p-3 pe-5 font-xssss fw-500 text-white"
                                value="Write Comments">
                            <span class="feather-send text-white font-md text-white position-absolute"
                                style="bottom: 35px;right:30px;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-popup-chat">
            <div class="modal-popup-wrap bg-white p-0 shadow-lg rounded-3">
                <div class="modal-popup-header w-100 border-bottom">
                    <div class="card p-3 d-block border-0 d-block">
                        <figure class="avatar mb-0 float-left me-2">
                            <img src="images/user-12.png" alt="image" class="w35 me-1">
                        </figure>
                        <h5 class="fw-700 text-primary font-xssss mt-1 mb-1">Hendrix Stamp</h5>
                        <h4 class="text-grey-500 font-xsssss mt-0 mb-0"><span
                                class="d-inline-block bg-success btn-round-xss m-0"></span> Available</h4>
                        <a href="#" class="font-xssss position-absolute right-0 top-0 mt-3 me-4"><i
                                class="ti-close text-grey-900 mt-2 d-inline-block"></i></a>
                    </div>
                </div>
                <div class="modal-popup-body w-100 p-3 h-auto">
                    <div class="message">
                        <div class="message-content font-xssss lh-24 fw-500">Hi, how can I help you?</div>
                    </div>
                    <div class="date-break font-xsssss lh-24 fw-500 text-grey-500 mt-2 mb-2">Mon 10:20am</div>
                    <div class="message self text-right mt-2">
                        <div class="message-content font-xssss lh-24 fw-500">I want those files for you. I want you to
                            send 1 PDF and 1 image file.</div>
                    </div>
                    <div class="snippet pt-3 ps-4 pb-2 pe-3 mt-2 bg-grey rounded-xl float-right"
                        data-title=".dot-typing">
                        <div class="stage">
                            <div class="dot-typing"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-popup-footer w-100 border-top">
                    <div class="card p-3 d-block border-0 d-block">
                        <div class="form-group icon-right-input style1-input mb-0"><input type="text"
                                placeholder="Start typing.."
                                class="form-control rounded-xl bg-greylight border-0 font-xssss fw-500 ps-3"><i
                                class="feather-send text-grey-500 font-md"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/plugin.js') }}"></script>

    <script src="{{ asset('js/lightbox.js') }} "></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
