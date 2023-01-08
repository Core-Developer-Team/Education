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
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-10">
                            <div class="app-top-items">
                                <div class="app-top-left-logo">
                                    <img src="images/logo.png" alt="">
                                </div>
                                <div class="app-top-right-link">
                                    New to CRAVSOL?<a class="SidebarRegister__link" href="{{ route('register') }}">Sign
                                        up</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-7">
                            <div class="registration">
                                @if (Session::has('status'))
                                <div class="alert alert-success" role="alert">
                                   {{ Session::get('status') }}
                               </div>
                           @endif
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <h2 class="registration_title">Sign in to CRAVSOL</h2>
                                    <div class="text-danger text-center border border-danger error_box p-3 mt-4 d-none"></div>
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
                                    <div class="form_group mt-25">
                                        <div class="field_password">
                                            <label class="label25">Password*</label>
                                        </div>
                                        <div class="loc_group">
                                            <input class="reg_form_input_1" name="password" id="pass_log_id"
                                                type="password" placeholder="">
                                            <span class="pass_show_dt cursor" toggle="#password-field"><i
                                                    class="feather-eye toggle-password"></i></span>
                                            @error('password')
                                                <div class="text-danger text-sm">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="position-relative text-end mt-3 mb-5">
                                        <a class="FieldPassword__link" href="{{route('forgotpassword')}}">Forgot Password?</a>
                                    </div>
                                    <button class="btn-register btn-hover" type="submit">Sign In <i
                                            class="feather-log-in ms-2"></i></button>
                                </form>
                                <div class="registration_line">
                                    <span class="registration_linetext">or</span>
                                </div>
                                <div class="social_buttons">
                                    <div class="social_buttons_list">
                                        <button class="google_login google_provider">
                                            <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                class="google_login__icon" width="20" height="20">
                                                <path
                                                    d="M18.453 8.355h-7.441a.593.593 0 00-.594.594v2.38c0 .327.266.593.594.593h4.191a5.587 5.587 0 01-2.406 2.82l1.785 3.094c2.863-1.656 4.559-4.566 4.559-7.82a6.11 6.11 0 00-.102-1.168.601.601 0 00-.586-.493z"
                                                    fill="#167EE6"></path>
                                                <path
                                                    d="M10.02 15.492a5.55 5.55 0 01-4.801-2.777l-3.094 1.781a9.106 9.106 0 007.895 4.566 9.105 9.105 0 004.562-1.222v-.004l-1.785-3.094a5.5 5.5 0 01-2.777.75z"
                                                    fill="#12B347"></path>
                                                <path
                                                    d="M14.578 17.84v-.004l-1.785-3.094a5.519 5.519 0 01-2.773.75v3.57a9.08 9.08 0 004.558-1.222z"
                                                    fill="#0F993E"></path>
                                                <path
                                                    d="M4.469 9.941c0-1.011.277-1.957.75-2.773L2.125 5.387A9.008 9.008 0 00.898 9.94c0 1.66.446 3.215 1.227 4.555l3.094-1.781a5.479 5.479 0 01-.75-2.774z"
                                                    fill="#FFD500"></path>
                                                <path
                                                    d="M10.02 4.39c1.335 0 2.566.477 3.523 1.266.238.196.582.18.797-.035l1.683-1.684a.598.598 0 00-.035-.874A9.064 9.064 0 0010.02.82a9.106 9.106 0 00-7.895 4.567l3.094 1.781a5.55 5.55 0 014.8-2.777z"
                                                    fill="#FF4B26"></path>
                                                <path
                                                    d="M13.543 5.656c.238.196.582.18.797-.035l1.683-1.684a.598.598 0 00-.035-.874A9.064 9.064 0 0010.02.82v3.57c1.335 0 2.566.473 3.523 1.266z"
                                                    fill="#D93F21"></path>
                                            </svg>
                                            <span class="google_login__text">Sign in with Google</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="app_responsive_signup_link">
                                    New to CRAVSOL?<a class="SidebarRegister__link" href="sign_up.html">Sign up</a>
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
    <script type="module" src="{{ asset('/js/firebase-config.js') }}" crossorigin="anonymous" defer></script>
    <script type="module" defer>
        import {
            getAuth,
            multiFactor,
            signInWithPopup,
            GoogleAuthProvider,
        } from 'https://www.gstatic.com/firebasejs/9.9.4/firebase-auth.js';

        //GOOGLE SIGN IN

        $('.google_provider').on('click', () => {
            const googleAuth = getAuth();
            const Gprovider = new GoogleAuthProvider();
            signInWithPopup(googleAuth, Gprovider)
                .then((result) => {
                    // This gives you a Google Access Token. You can use it to access the Google API.
                    const credential = GoogleAuthProvider.credentialFromResult(result);
                    const token = credential.accessToken;
                    // The signed-in user info.
                    const user = result.user;
                    const username = user.providerData[0].displayName;
                    const email = user.providerData[0].email;
                    // Ajax call to Controller
                    $.ajax({
                        async: false,
                        type: "post",
                        url: "{{ route('googleLogin') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "username": username,
                            "email": email,
                        },
                        success: function(response) {
                            $('.error_box').addClass('d-none');
                            $('.error_box').text('');
                            if(response == 'Registered'){
                                location.href = (new URL(location.href)).origin + '/userinfo';
                            }else if(response == 'SignedIn'){
                                location.href = (new URL(location.href)).origin + '/';
                            }else if(response == 'Error'){
                                $('.error_box').removeClass('d-none');
                                $('.error_box').text('Please Login through Form');
                            }
                        },
                        error: function(error) {
                            const auth_failed = JSON.parse(error.responseText).message;
                            console.log(auth_failed);
                            $('.error_box').removeClass('d-none');
                            $('.error_box').text('' + auth_failed + '');
                        }
                    });
                }).catch((error) => {
                    // Handle Errors here.
                    const errorCode = error.code;
                    const errorMessage = error.message;
                    const credential = GoogleAuthProvider.credentialFromError(error);
                    console.log(errorCode, errorMessage, credential);
                });
        });
    </script>
</body>

<!-- Mirrored from www.gambolthemes.net/html-items/new-micko-html/disable-demo-link/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 23:21:05 GMT -->

</html>

<script>
    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("feather-eye-off");


        if ($("#pass_log_id").attr("type") === "password") {
            $("#pass_log_id").attr("type", "text");
        } else {
            $("#pass_log_id").attr("type", "password");
        }
    });
</script>
