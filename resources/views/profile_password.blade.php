@include('layouts.header')
<header class="header clearfix">
    <div class="header-inner">
        <!--Top Menu-->
        @include('layouts.menu')
        <!--/Top Menu-->
        <div class="overlay"></div>
    </div>
</header>

<div class="wrapper">
    <div class="main-setting">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="item-setting-tabs mb-0">
                        <ul class="setting-list">

                            <li>
                                <a href="{{ route('profile.index') }}" role="button"><i
                                        class="feather-edit me-3"></i>Edit Profile</a>

                            </li>
                            <li>
                                <a href="#security-setting" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false"><i class="feather-shield me-3"></i>Security</a>
                                <div class="collapse" id="security-setting">
                                    <ul>
                                        <li><a href="{{ route('profile.password') }}">Password</a></li>
                            </li>
                        </ul>
                    </div>
                    </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="event-card rrmt-30">
                    <div class="headtte14m item-setting-top">
                        <span class="color_bb"><i class="feather-settings"></i></span>
                        <h4>Password</h4>
                    </div>
                    <div class="item-setting">
                        <div class="item-padding30 main-form">
                            <div class="row justify-content-center">

                                <form method="POST" action="{{ route('profile.password') }}">
                                    @csrf

                                    @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                    @endif

                                    @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                    @endforeach

                                    <div class="form-group row mt-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Current
                                            Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control"
                                                name="current_password" autocomplete="current-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">New
                                            Password</label>

                                        <div class="col-md-6">
                                            <input id="new_password" type="password" class="form-control"
                                                name="new_password" autocomplete="current-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">New
                                            Confirm
                                            Password</label>

                                        <div class="col-md-6">
                                            <input id="new_confirm_password" type="password" class="form-control"
                                                name="new_confirm_password" autocomplete="current-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0 mt-3">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="main-save-btn color btn-hover">
                                                Update Password
                                            </button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->