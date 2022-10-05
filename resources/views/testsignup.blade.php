<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.gambolthemes.net/html-items/new-micko-html/disable-demo-link/sign_up_steps.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 23:21:06 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>Micko - Sign up Steps</title>

    <link rel="icon" type="image/png" href="images/fav.png">

    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;300;400;500;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/night-mode.css" rel="stylesheet">
    <link href="css/datepicker.min.css" rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="vendor/feather-icons/feather.css" rel="stylesheet">
    <link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
    <link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/signup-wizard/css/style.css" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <div class="sign-up-steps d-flex align-items-center h-vh">
            <div class="container">
                <div class="row justify-content-lg-center">
                    <div class="col-lg-6 col-md-10">
                        <form id="register_form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <div id="wizard">

                                <div></div>
                                <section>
                                    <div class="step-1">
                                        <div class="signup-steps-content text-center">
                                            <h3>Info tell us about you</h3>
                                        </div>
                                        <div class="singup-info-form main-form">
                                            <div class="row justify-content-md-center">
                                                <div class="form_group mt-3">
                                                    <label class="label25">Username*</label>
                                                    <input class="reg_form_input_1 @error('username') border-danger @enderror" name="username" type="text" placeholder="" value="{{ old('username') }}">
                                                    @error('username')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form_group mt-3">
                                                    <label class="label25">Your Email*</label>
                                                    <input class="reg_form_input_1 @error('email') border-danger @enderror" name="email" type="email" placeholder="" value="{{ old('email') }}">
                                                    @error('email')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form_group mt-3">
                                                    <label class="label25">Mobile_No*</label>
                                                    <input class="reg_form_input_1 @error('mobile_no') border-danger @enderror" name="mobile_no" type="number" placeholder="" value="{{ old('mobile_no') }}">
                                                    @error('mobile_no')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label class="label25" for="gender">Gender*</label>
                                                    <select name="gender" id="gender" class="form-control @error('gender') border border-danger @enderror">
                                                        <option selected disabled>Select gender</option>
                                                        <option value="0" {{ (old('gender') == '0') ? 'selected' : ''}}>Male</option>
                                                        <option value="1" {{ (old('gender') == '1') ? 'selected' : ''}}>Female</option>
                                                    </select>
                                                    @error('gender')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <div></div>
                                <section>
                                    <div class="step-2">
                                        <div class="signup-steps-content text-center">
                                            <h3>Add a profile photo</h3>
                                        </div>
                                        <div class="singup-info-form main-form">
                                            <div class="row justify-content-md-center">
                                                <div class="form_group mt-3">
                                                    <label class="label25">Profile_Image*</label>
                                                    <div class="form-control @error('image') border border-danger @enderror">
                                                        <input class="w-100 h-100 custom-register-input-file" name="image" type="file" accept="image/*" placeholder="" value="{{ old('image') }}">
                                                    </div>
                                                    @error('image')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form_group mt-3">
                                                    <label class="label25">Cover_Image*</label>
                                                    <div class="form-control @error('cover_img') border border-danger @enderror">
                                                        <input class="w-100 h-100 custom-register-input-file" name="cover_img" type="file" accept="image/*" placeholder="" value="{{ old('cover_img') }}">
                                                    </div>
                                                    @error('cover_img')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <div></div>
                                <section>
                                    <div class="step-3">
                                        <div class="signup-steps-content text-center">
                                            <h3>Tell us about your Education</h3>
                                        </div>
                                        <div class="singup-info-form main-form">
                                            <div class="row justify-content-md-center">
                                                <div class="form-group mt-3">
                                                    <label class="label25" for="dep">Departmment*</label>
                                                    <select name="department" id="dep" class="form-control @error('department') border border-danger @enderror">
                                                        <option selected disabled>Select dep</option>
                                                        <option value="0" {{ (old('department') == '0') ? 'selected' : ''}}>bba</option>
                                                        <option value="1" {{ (old('department') == '1') ? 'selected' : ''}}>bse</option>
                                                        <option value="2" {{ (old('department') == '2') ? 'selected' : ''}}>bcs</option>
                                                    </select>
                                                    @error('department')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form_group mt-3">
                                                    <label class="label25">University_id*</label>
                                                    <input class="reg_form_input_1 @error('uni_id') border-danger @enderror" name="uni_id" type="text" placeholder="" value="{{ old('uni_id') }}">
                                                    @error('uni_id')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form_group mt-3">
                                                    <label class="label25">University_Name*</label>
                                                    <input class="reg_form_input_1 @error('uni_name') border-danger @enderror" name="uni_name" type="text" placeholder="" value="{{ old('uni_name') }}">
                                                    @error('uni_name')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <div></div>
                                <section>
                                    <div class="step-4">
                                        <div class="signup-steps-content text-center">
                                            <h3>Accept the Terms</h3>
                                        </div>
                                        <div class="singup-info-form main-form">
                                            <div class="row justify-content-md-center">
                                                <div class="form_group mt-3">
                                                    <label class="label25">Create Password*</label>
                                                    <div class="loc_group">
                                                        <input class="reg_form_input_1 @error('password') border-danger @enderror" name="password" type="password" id="pass_log_id" placeholder="">
                                                        <span class="pass_show_dt cursor" toggle="#password-field"><i class="feather-eye toggle-password"></i></span>
                                                        @error('password')
                                                        <div class="text-danger mt-2 text-sm">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form_group mt-3">
                                                    <label class="label25">Confirm Password*</label>
                                                    <div class="loc_group">
                                                        <input class="reg_form_input_1" name="password_confirmation" id="confpass_log_id" type="password" placeholder="">
                                                        <span class="pass_show_dt cursor" toggle="#confpassword-field"><i class="feather-eye toggle-confpassword"></i></span>
                                                    </div>
                                                </div>
                                                <div class="signup_check_checkbox mt-3">
                                                    <input type="checkbox" name="terms" id="google_analytics_check">
                                                    <label for="google_analytics_check">I agree to the <a href="{{ route('privacy.show') }}">Privacy
                                                            Policy</a> and <a href="{{ route('term.show') }}">Terms and
                                                            Conditions</a></label>
                                                    @error('terms')
                                                    <div class="text-danger mt-2 text-sm">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/OwlCarousel/owl.carousel.js"></script>
    <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="vendor/signup-wizard/js/jquery.steps.js"></script>
    <script src="vendor/signup-wizard/js/main.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/i18n/datepicker.en.js"></script>
    <script src="js/night-mode.js"></script>

    <script>
        $(document).ready(function() {
            const form = $('#register_form');
            const finish_button = $('#wizard li:contains("Finish")');
            finish_button.on('click', () => {
                form.trigger('submit');
            });
        });
    </script>
</body>

<!-- Mirrored from www.gambolthemes.net/html-items/new-micko-html/disable-demo-link/sign_up_steps.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 23:21:13 GMT -->

</html>