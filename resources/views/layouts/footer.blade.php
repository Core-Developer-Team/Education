<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="footer-items">
                    <ul class="footer-links">
                        <li><a href="about_us.html">About Us</a></li>
                        <li><a href="our_blog.html">Blog</a></li>
                        <li><a href="contact_us.html">Contact Us</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Request Refund</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-items">
        <div class="container">
            <div class="col-md-12">
                <div class="footer-bottom-links">
                    <div class="footer-logo">
                        <a href="index.html"><img src="images/dark-logo.png" alt=""></a>
                    </div>
                    <div class="micko-copyright">
                        <p><i class="fas fa-copyright"></i>Copyright 2022 Micko by <a href="#">Gambolthemes</a>.
                            All
                            Right Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--login redirect model-->

<div class="modal fade" id="loginlink" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="container bg-white rounded">
                    Sorry you don't have access to this page register yourself to get Access
                    <a href="{{ route('register') }}">Register</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/OwlCarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/night-mode.js') }}"></script>
<script src="{{ asset('js/offset_overlay.js') }}"></script>
<script src="{{ asset('js/video.js') }}"></script>
<script src="{{ asset('js/imagehover.js') }}"></script>

<!--req model script-->
<script>
    const requestForm = $('form#req');
    requestForm.on('submit', (e) => {
        e.preventDefault();
        const form = document.getElementById('req');
        const formData = new FormData(form);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.form-prevent').on('submit', function() {
                    $('.btn-prevent').attr('disabled', 'true');
                    $('.spinner').show();
                })
                location.href = location.href;

            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.requestname) {
                    $('.requestnameError').text(errorResponse.requestname[0]);
                }
                if (errorResponse.price) {
                    $('.priceError').text(errorResponse.price[0]);
                }
                if (errorResponse.days) {
                    $('.dayError').text(errorResponse.days[0]);
                }
                if (errorResponse.coursename) {
                    $('.coursenameError').text(errorResponse.coursename[0]);
                }
                if (errorResponse.description) {
                    $('.descriptionError').text(errorResponse.description[0]);
                }
                if (errorResponse.file) {
                    $('.fileError').text(errorResponse.file[0]);
                }
                if (errorResponse.tag) {
                    $('.tagError').text(errorResponse.tag[0]);
                }
            }
        })
    })
</script>
<!--book model script-->
<script>
    const bookForm = $('form#bok');
    bookForm.on('submit', (e) => {
        e.preventDefault();
        const formbook = document.getElementById('bok');
        const formData = new FormData(formbook);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.price) {
                    $('.priceerror').text(errorResponse.price[0]);
                }
                if (errorResponse.cover_pic) {
                    $('.cover_picError').text(errorResponse.cover_pic[0]);
                }
                if (errorResponse.Category) {
                    $('.categoryerror').text(errorResponse.Category[0]);
                }
                if (errorResponse.book) {
                    $('.bookError').text(errorResponse.book[0]);
                }
                if (errorResponse.description) {
                    $('.description').text(errorResponse.description[0]);
                }
            }
        })
    })
</script>
<!--product model script-->
<script>
    const productForm = $('form#product');
    productForm.on('submit', (e) => {
        e.preventDefault();
        const formproduct = document.getElementById('product');
        const formData = new FormData(formproduct);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.name) {
                    $('.nameerror').text(errorResponse.name[0]);
                }
                if (errorResponse.price) {
                    $('.priceerror').text(errorResponse.price[0]);
                }
                if (errorResponse.Category) {
                    $('.categoryerror').text(errorResponse.Category[0]);
                }
                if (errorResponse.cover_pic) {
                    $('.cover_picError').text(errorResponse.cover_pic[0]);
                }
                if (errorResponse.description) {
                    $('.description').text(errorResponse.description[0]);
                }
            }
        });
    });
</script>
<!--course model script-->
<script>
    const courseForm = $('form#corse');
    courseForm.on('submit', (e) => {
        e.preventDefault();
        const formcourse = document.getElementById('corse');
        const formData = new FormData(formcourse);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.playlists_id) {
                    $('.playlistserror').text(errorResponse.playlists_id[0]);
                }
                if (errorResponse.Category) {
                    $('.categoryerror').text(errorResponse.Category[0]);
                }
                if (errorResponse.file) {
                    $('.fileError').text(errorResponse.file[0]);
                }
                if (errorResponse.type) {
                    $('.typeError').text(errorResponse.type[0]);
                }
                if (errorResponse.price) {
                    $('.priceError').text(errorResponse.price[0]);
                }

            }
        })
    })
</script>
<!--proposal model script-->
<script>
    const proposalForm = $('form#proposal');
    proposalForm.on('submit', (e) => {
        e.preventDefault();
        const formprop = document.getElementById('proposal');
        const formData = new FormData(formprop);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.proposalname) {
                    $('.proposalname').text(errorResponse.proposalname[0]);
                }
                if (errorResponse.price) {
                    $('.price').text(errorResponse.price[0]);
                }
                if (errorResponse.file) {
                    $('.file').text(errorResponse.file[0]);
                }
                if (errorResponse.description) {
                    $('.description').text(errorResponse.description[0]);
                }
            }
        })
    })
</script>
<!--Resoure model script-->
<script>
    const resForm = $('form#res');
    resForm.on('submit', (e) => {
        e.preventDefault();
        const formres = document.getElementById('res');
        const formData = new FormData(formres);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.name) {
                    $('.name').text(errorResponse.name[0]);
                }
                if (errorResponse.file) {
                    $('.file').text(errorResponse.file[0]);
                }
                if (errorResponse.description) {
                    $('.description').text(errorResponse.description[0]);
                }
            }
        })
    })
</script>
<!--tutorial model script-->
<script>
    const tutoForm = $('form#tuto');
    tutoForm.on('submit', (e) => {
        e.preventDefault();
        const formtuto = document.getElementById('tuto');
        const formData = new FormData(formtuto);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.playlists_id) {
                    $('.playlistserror').text(errorResponse.playlists_id[0]);
                }
                if (errorResponse.Category) {
                    $('.categoryerror').text(errorResponse.Category[0]);
                }
                if (errorResponse.type) {
                    $('.typeError').text(errorResponse.type[0]);
                }
                if (errorResponse.file) {
                    $('.fileError').text(errorResponse.file[0]);
                }
                if (errorResponse.price) {
                    $('.price').text(errorResponse.price[0]);
                }
            }
        })
    })
</script>
<!--Event model script-->
<script>
    const eventForm = $('form#event');
    eventForm.on('submit', (e) => {
        e.preventDefault();
        const formevent = document.getElementById('event');
        const formData = new FormData(formevent);
        const action = $(e.currentTarget).attr('action');
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: action,
            method: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.href = location.href;
            },
            error: function(error) {
                const errorResponse = error.responseJSON.errors;
                if (errorResponse.name) {
                    $('.name').text(errorResponse.name[0]);
                }
                if (errorResponse.location) {
                    $('.location').text(errorResponse.location[0]);
                }
                if (errorResponse.event_date) {
                    $('.event_date').text(errorResponse.event_date[0]);
                }
                if (errorResponse.start_time) {
                    $('.start_time').text(errorResponse.start_time[0]);
                }
                if (errorResponse.end_time) {
                    $('.end_time').text(errorResponse.end_time[0]);
                }
                if (errorResponse.image) {
                    $('.image').text(errorResponse.image[0]);
                }
                if (errorResponse.description) {
                    $('.description').text(errorResponse.description[0]);
                }
            }
        })
    })
</script>
</body>

<!-- Mirrored from www.gambolthemes.net/html-items/new-micko-html/disable-demo-link/all_jobs.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 23:19:34 GMT -->

</html>
