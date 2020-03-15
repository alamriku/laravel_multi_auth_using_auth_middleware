<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
<title>Elite Admin Template -Material</title>
<!-- This page CSS -->
<!-- chartist CSS -->
<link href="{{asset('public')}}/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
<!--Toaster Popup message CSS -->
<link href="{{asset('public')}}/assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">

<!--alerts CSS -->
<link href="{{asset('public')}}/assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{asset('public')}}/dist/css/style.min.css" rel="stylesheet">
<!-- Dashboard 1 Page CSS -->
<link href="{{asset('public')}}/dist/css/pages/dashboard1.css" rel="stylesheet">
<!-- login page css -->
<link href="{{asset('public')}}/dist/css/pages/login-register-lock.css" rel="stylesheet">
<link href="{{asset('public')}}/dist/css/pages/progressbar-page.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('public')}}/assets/node_modules/dropify/dist/css/dropify.min.css">
<link href="{{asset('public')}}/dist/css/pages/icon-page.css" rel="stylesheet">
<style>
    .bounce {
        height: 50px;
        overflow: hidden;
        position: relative;
        background: #fefefe;
        color: #333;

    }

    .bounce p {
        position: absolute;
        width: 100%;
        height: 100%;
        margin: 0;
        line-height: 50px;
        text-align: center;
        -moz-transform: translateX(50%);
        -webkit-transform: translateX(50%);
        transform: translateX(50%);
        -moz-animation: bouncing-text 5s linear infinite alternate;
        -webkit-animation: bouncing-text 5s linear infinite alternate;
        animation: bouncing-text 10s linear infinite alternate;
    }

    @-moz-keyframes bouncing-text {
        0% {
            -moz-transform: translateX(50%);
        }
        100% {
            -moz-transform: translateX(-50%);
        }
    }

    @-webkit-keyframes bouncing-text {
        0% {
            -webkit-transform: translateX(50%);
        }
        100% {
            -webkit-transform: translateX(-50%);
        }
    }

    @keyframes bouncing-text {
        0% {
            -moz-transform: translateX(50%);
            -webkit-transform: translateX(50%);
            transform: translateX(50%);
        }
        100% {
            -moz-transform: translateX(-50%);
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
        }
    }
</style>
<script src="{{asset('public')}}/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
<script src="{{asset('public')}}/dist/js/image.preview.js"></script>

