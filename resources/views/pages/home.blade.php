@extends('layout.app')

@section('content')

    <nav class="navbar sticky-top shadow-sm navbar-expand-lg navbar-light py-2">
        <div class="container">
            <a class="navbar-brand" href="#">
                {{-- <img class="img-fluid" src="{{asset('/images/logo.png')}}" alt="" width="96px"> --}}
                <h3>House Building</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header01" aria-controls="header01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="header01">
                <ul class="navbar-nav ms-auto mt-3 mt-lg-0 mb-3 mb-lg-0 me-4">
                    <li class="nav-item me-4"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item me-4"><a class="nav-link" href="#gellaryThambnail">Gallery</a></li>
                    <li class="nav-item me-4"><a class="nav-link" href="#Contact">Contact</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#">Testimonials</a></li> --}}
                </ul>
                <div><a class="btn mt-3 bg-gradient-primary" href="{{url('/userLogin')}}">Login</a></div>
            </div>
        </div>
    </nav>


        <section class="pb-5" id="about">
            <div class="container pt-2">
                <div class="row align-items-center mb-5">
                    <div class="col-12 col-md-10 col-lg-5 mb-5 mb-lg-0">
                        <h2 class=" fw-bold mb-3" id="buildingName"></h2>
                        <p class="lead text-muted mb-4 text-justify" id="buildingDescription"></p>
                        <div class="d-flex flex-wrap">
                            <a class="btn bg-gradient-primary mb-2 mb-sm-0" href="{{url('/userLogin')}}">Login</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 offset-lg-1">
                        <img class="img-fluid rounded" src="" alt="" id="buildingImage">
                    </div>
                </div>
            </div>
        </section>


        <section class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto text-center">
                        <h2 class="fw-bold">Construction Site</h2>
                        <p class="lead text-muted">Construction Work plan and gallery image.</p>
                    </div>
                </div>
                <br/>

                <div class="row" id="gellaryThambnail">


                </div>



            </div>
        </section>

        <br/>

        <section class="py-5" id="Contact">
            <div class="container">
                <div class="row align-items-center text-center">
                    <h2 class="fw-bold">Reach Out to Us: </h2>
                    <p class="text-muted mb-5">Let's Connect and Explore Opportunities Together</p>
                    <div class="col-md-6">
                        <h4 class="fw-bold">Address</h4>
                        <p class="text-muted mb-5">1206, Dhaka, Bangladesh</p>
                    </div>
                    <div class="col-md-6">
                        <h4 class="fw-bold">Contact Us</h4>
                        <p class="text-muted mb-1">mdsalimrezaspi@gmail.com</p>
                        <p class="text-muted mb-0">+880-1739-871705</p>
                    </div>


                </div>
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 mb-5 mb-lg-0">
                        <form action="#">
                            <input class="form-control mb-3" type="text" placeholder="Name" id="name">
                            <input class="form-control mb-3" type="tele" placeholder="Mobile No" id="mobile">
                            <input class="form-control mb-3" type="email" placeholder="E-mail" id="email">
                            <textarea class="form-control mb-3" name="message" cols="30" rows="10" placeholder="Your Message..." id="message"></textarea>
                            <button onclick="Save()" id="save-btn" class="btn bg-gradient-primary w-100">Action</button>
                        </form>
                    </div>
                    <div class="col-12 col-lg-6 offset-lg-1 shadow">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29206.206632300746!2d90.37002661390784!3d23.790995752061402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c74896fa54c1%3A0x2a74ca97f24852ff!2sKafrul%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1731994865655!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="py-5" id="testimonial">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="card">
                        <img src="{{asset('owners/1-1731313073-ocro.jpg')}}" alt="Owner Photo" class="w-20 img-circle">
                    </div>
                </div>
            </div>
        </section> --}}

        <footer class="py-5 bg-light">
            <div class="container text-center pb-5 border-bottom">
                <a class="d-inline-block mx-auto mb-4" href="#">
                    <h3>House Building</h3>
                </a>
                <ul class="d-flex flex-wrap justify-content-center align-items-center list-unstyled mb-4">
                    <li><a class="link-secondary me-4" href="#">About</a></li>
                    <li><a class="link-secondary me-4" href="#">Company</a></li>
                    <li><a class="link-secondary me-4" href="#">Services</a></li>
                    <li><a class="link-secondary" href="#">Testimonials</a></li>
                </ul>
                <div>
                    <a class="d-inline-block me-4" href="#">
                        <img src="{{asset('/images/facebook.svg')}}">
                    </a>
                    <a class="d-inline-block me-4" href="#">
                        <img src="{{asset('/images/twitter.svg')}}">
                    </a>
                    <a class="d-inline-block me-4" href="#">
                        <img src="{{asset('/images/github.svg')}}">
                    </a>
                    <a class="d-inline-block me-4" href="#">
                        <img src="{{asset('/images/instagram.svg')}}">
                    </a>
                    <a class="d-inline-block" href="#">
                        <img src="{{asset('/images/linkedin.svg')}}">
                    </a>
                </div>
            </div>
            <div class="mb-5"></div>
            <div class="container">
                <p class="text-center">All rights reserved © Md Salim Reza 2024-2025</p>
            </div>
        </footer>

        <script>
            getlist()

            async function getlist(){
                showLoader();
                let res=await axios.get("building-details");
                let resGellary=await axios.get("gellary-image");
                hideLoader();
                // console.log(resGellary);
                document.getElementById('buildingName').innerText=res.data['title']
                document.getElementById('buildingDescription').innerText=res.data['discription']
                document.getElementById('buildingImage').src=res.data['image']

                document.getElementById('gellaryThambnail').innerHTML=""
                // Loop through the first batch of new arrivals and append to #gellaryThambnail
                resGellary.data.forEach(function(item) {
                    let div = `
                        <div class="col-md-4">
                            <div class="thumbnail shadow rounded move-on-hover">
                                <a href="${item['image']}" target="_blank">
                                <img src="${item['image']}" alt="Lights" class="rounded w-100" >
                                <div class="caption p-1">
                                    <p>${item['short_discription']}</p>
                                </div>
                                </a>
                            </div>
                        </div>
                    `;

                    // Append the constructed HTML to the #gellaryThambnail element
                    document.getElementById("gellaryThambnail").innerHTML += div;
                });

            }

            async function Save() {
                // Collect form input values
                let name = document.getElementById('name').value.trim();
                let mobile = document.getElementById('mobile').value.trim();
                let email = document.getElementById('email').value.trim();
                let message = document.getElementById('message').value.trim();

                const mobileRegex = /^0\d{10}$/; // Matches 11 digits starting with 0
                    if (!mobileRegex.test(mobile)) {
                        errorToast("Enter a valid 11-digit mobile number starting with 0!");
                        return;
                    }
                // Input validation
                if (name.length === 0) {
                    errorToast("Name is required!");
                    return;
                } else if (mobile.length === 0) {
                    errorToast("Mobile number is required!");
                    return;
                } else if (isNaN(mobile) || mobile.length < 11) { // Example validation for mobile numbers
                    errorToast("Enter a valid mobile number!");
                    return;
                } else if (email.length === 0) {
                    errorToast("Email is required!");
                    return;
                } else if (!/\S+@\S+\.\S+/.test(email)) { // Basic email validation regex
                    errorToast("Enter a valid email address!");
                    return;
                } else if (message.length === 0) {
                    errorToast("Message text is required!");
                    return;
                }

                // Prepare form data
                let formData = new FormData();
                formData.append('name', name);
                formData.append('mobile', mobile);
                formData.append('email', email);
                formData.append('message', message);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                };

                showLoader();
                try {
                    let res = await axios.post("/contact-message", formData, config);
                    hideLoader(); // Ensure loader is hidden after success

                    if (res.status === 200) {
                        successToast('Message sent successfully!');
                        document.getElementById("save-form").reset();
                        await getlist();
                    }
                } catch (error) {
                    hideLoader(); // Ensure loader is hidden after failure
                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;
                        console.log(errors)
                        for (let field in errors) {
                            errorToast(errors[field][0]); // Show the first error for each field
                        }
                    } else {
                        errorToast("An error occurred! Please try again.");
                        console.error(error);
                    }
                }
            }


        </script>
@endsection

