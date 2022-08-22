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
                                <a href=" #security-setting" data-bs-toggle="collapse" role="button"
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
                        <span class="color_bb"><i class="feather-edit"></i></span>
                        <h4>Basic</h4>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <form action="{{ route('profile.update', ['id'=>$user->id]) }}" method="post"
                        enctype="multipart/form-data">
                        <div class="item-setting">
                            <div class="item-padding30 main-form">

                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="container">
                                            <div class="picture-container">
                                                <div class="picture">
                                                    <img src="/storage/{{$user->image}}" class="picture-src"
                                                        id="wizardPicturePreview" title="">
                                                    <input type="file" id="wizard-picture" name="image" class=""
                                                        value="{{$user->image}}">
                                                </div>
                                                <h6 class="">Choose Picture</h6>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form_group mt-30">
                                            <label class="label25">User Name*</label>
                                            <input class="form_input_1" name="username" type="text" placeholder=""
                                                value="{{$user->username}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form_group mt-30">
                                            <label class="label25">Email*</label>
                                            <input class="form_input_1" name="email" type="text" placeholder=""
                                                value="{{$user->email}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form_group mt-30">
                                            <label class="label25">Phone*</label>
                                            <input class="form_input_1" type="text" name="mobile_no" placeholder=""
                                                value="{{$user->mobile_no}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form_group mt-30">
                                            <label class="label25">uni_id*</label>
                                            <input class="form_input_1" type="text" name="uni_id" placeholder=""
                                                value="{{$user->uni_id}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group mt-25">
                                            <label class="label25" for="gender">Gender*</label>
                                            <select name="gender" id="gender" value="{{ old('gender') }}"
                                                class="form-control">
                                                <option selected disabled>Select gender</option>
                                                @if ($user->gender == 0)
                                                <option value="0" selected>Male</option>
                                                <option value="1">Female</option>
                                                @elseif($user->gender==1)
                                                <option value="0">Male</option>
                                                <option value="1" selected>Female</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form_group mt-30">
                                            <label class="label25">uni_name*</label>
                                            <input class="form_input_1" type="text" name="uni_name" placeholder=""
                                                value="{{Auth()->user()->uni_name}}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="save-change-btns">
                                <button class="main-save-btn color btn-hover" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
<script>
    $(document).ready(function(){
// Prepare the preview for profile picture
$("#wizard-picture").change(function(){
readURL(this);
});
});
function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
$('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
}
reader.readAsDataURL(input.files[0]);
}
}
</script>