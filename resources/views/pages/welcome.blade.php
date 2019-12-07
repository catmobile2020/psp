<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
    <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
    <title>PSP System | Login</title>
    <!-- Site favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='{{asset('assets/images/favicon.ico')}}' />
    <!-- /site favicon -->

    <!-- Entypo font stylesheet -->
    <link href="{{asset('assets/css/entypo.css')}}" rel="stylesheet">
    <!-- /entypo font stylesheet -->

    <!-- Font awesome stylesheet -->
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- /font awesome stylesheet -->

    <!-- Bootstrap stylesheet min version -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- /bootstrap stylesheet min version -->

    <!-- Mouldifi core stylesheet -->
    <link href="{{asset('assets/css/mouldifi-core.css')}}" rel="stylesheet">
    <!-- /mouldifi core stylesheet -->

    <link href="{{asset('assets/css/mouldifi-forms.css')}}" rel="stylesheet">

    <!-- Bootstrap RTL stylesheet min version -->
{{--    <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet">--}}
<!-- /bootstrap rtl stylesheet min version -->

    <!-- Mouldifi RTL core stylesheet -->
{{--    <link href="{{asset('assets/css/mouldifi-rtl-core.css')}}" rel="stylesheet">--}}
<!-- /mouldifi rtl core stylesheet -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{asset('assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('assets/js/respond.min.js')}}"></script>
    <![endif]-->


</head>
<body class="login-page">
<div class="login-container">
    <div class="login-branding">
        <a href="/"><img src="{{asset('assets/images/logo.png')}}" alt="Mouldifi" title="Mouldifi"></a>
    </div>
    <div class="login-content">
        <h2>
            <a href="admin/login">Admin</a>
        </h2>
        <h2>
            <a href="call-centers/login">Call Center</a>
        </h2>
        <h2>
            <a href="users/login">user</a>
        </h2>

        <h2>
            <a href="marketing/login">Novartis Marketing</a>
        </h2>
        {{--        <h2>--}}
        {{--            <a href="/patients">patient</a>--}}
        {{--        </h2>--}}
    </div>
</div>
<!--Load JQuery-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
</body>
</html>
