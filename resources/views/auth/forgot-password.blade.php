<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.gambolthemes.net/html-items/new-micko-html/disable-demo-link/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 23:21:04 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>CRAVSOL - Sign In</title>

    <link rel="icon" type="image/png" href="images/fav.png">

    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;300;400;500;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/night-mode.css" rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="vendor/feather-icons/feather.css" rel="stylesheet">
    <link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
    <link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
</head>

<body>

    <div class="form-wrapper">
        <div class="app-form">
            <div class="app-form-sidebar">
                <div class="sign-logo">
                    <img src="{{ asset('images/logo.png') }}" class="w-100" alt="">
                </div>
                <div class="sign_sidebar_text">
                    <h1>Best place to buy and sell digital products and LMS Courses with social Networking</h1>
                </div>
            </div>
            <div class="app-form-content">
                <div class="container h-100">
                    <div class="row justify-content-center h-100">
                        <div class="col-lg-10 col-md-10">
                            <div class="app-top-items">
                                <div class="app-top-left-logo">
                                    <img src="images/logo.png" class="w-100" alt="">
                                </div>
                                <div class="app-top-right-link">
                                    Back to sign in.<a class="SidebarRegister__link" href="{{ route('login') }}">Sign in</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-7">
                            <div class="registration">
                                <form method="POST" action="{{ route('forgotpassword') }}">
                                    @csrf
                                    <h2 class="registration_title">Forgot Password?</h2>
                                    <div class="text-danger border border-danger error_box p-3 mt-4 d-none"></div>
                                    <div class="form_group mt-30">
                                        <label class="label25">Your Email*</label>
                                        <input class="reg_form_input_1" name="email" type="email" placeholder=""
                                            value="">
                                        @error('email')
                                            <div class="text-danger text-sm">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button class="btn-register btn-hover" type="submit">Submit</button>
                                </form>
                                <div class="app_responsive_signup_link">
                                    Back to sign in?<a class="SidebarRegister__link" href="{{route('login')}}">Sign In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="register_footer mt-50">
                    © 2021 CRAVSOL owned by Gambolthemes. All rights reserved
                    <nav class="footer__links">
                        <a href="{{route('term.show')}}" class="footer__link" target="_blank">Terms of Use</a>
                        <a href="{{route('privacy.show')}}" class="footer__link" target="_blank">Privacy Policy</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/OwlCarousel/owl.carousel.js"></script>
    <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/night-mode.js"></script>
</body>

<!-- Mirrored from www.gambolthemes.net/html-items/new-micko-html/disable-demo-link/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 23:21:05 GMT -->

</html>
