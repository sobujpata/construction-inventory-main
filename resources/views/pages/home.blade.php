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
                    <li class="nav-item me-4"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item me-4"><a class="nav-link" href="#">Company</a></li>
                    <li class="nav-item me-4"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Testimonials</a></li>
                </ul>
                <div><a class="btn mt-3 bg-gradient-primary" href="{{url('/userLogin')}}">Login</a></div>
            </div>
        </div>
    </nav>


        <section class="pb-5">
            <div class="container pt-2">
                <div class="row align-items-center mb-5">
                    <div class="col-12 col-md-10 col-lg-5 mb-5 mb-lg-0">
                        <h2 class=" fw-bold mb-3">Someday is now.</h2>
                        <p class="lead text-muted mb-4">
                            Living in a modern home is no longer about someday, it’s accessible now. Connect Homes offers curated design options with the efficiency of modern prefab house manufacturing.
                            If you’re seeking lots of natural light, open-concept floor plans and a stress-free build process, you’ve come to the right place.</p>
                        <div class="d-flex flex-wrap">
                            <a class="btn bg-gradient-primary mb-2 mb-sm-0" href="{{url('/userLogin')}}">Login</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 offset-lg-1">
                        <img class="img-fluid" src="{{asset('/images/constraction-image.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </section>


        <section class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto text-center">
                        <span class="text-muted">Construction Site</span>
                        <p class="lead text-muted">Construction Work plan and gallery image.</p>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3 p-3">
                        <div class="card px-0 text-center">
                            <img class=" card-img-top mb-3 w-100" src="{{asset('/images/1.jpg')}}" alt="">
                            {{-- <h5>Danny Bailey</h5>
                            <p class="text-muted mb-4">CEO &amp; Founder</p> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 p-3">
                        <div class="card px-0 text-center">
                            <img class=" card-img-top mb-3 w-100" src="{{asset('/images/2.jpg')}}" alt="">
                            {{-- <h5>Danny Bailey</h5>
                            <p class="text-muted mb-4">CEO &amp; Founder</p> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 p-3">
                        <div class="card px-0 text-center">
                            <img class=" card-img-top mb-3 w-100" src="{{asset('/images/3.jpg')}}" alt="">
                            {{-- <h5>Danny Bailey</h5>
                            <p class="text-muted mb-4">CEO &amp; Founder</p> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 p-3">
                        <div class="card px-0 text-center">
                            <img class=" card-img-top mb-3 w-100" src="{{asset('/images/4.jpg')}}" alt="">
                            {{-- <h5>Danny Bailey</h5>
                            <p class="text-muted mb-4">CEO &amp; Founder</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <br/>

        <section class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 mb-5 mb-lg-0">
                        <h2 class="fw-bold mb-5">Reach Out to Us: Let's Connect and Explore Opportunities Together</h2>
                        <h4 class="fw-bold">Address</h4>
                        <p class="text-muted mb-5">1206, Dhaka, Bangladesh</p>
                        <h4 class="fw-bold">Contact Us</h4>
                        <p class="text-muted mb-1">mdsalimrezaspi@gmail.com</p>
                        <p class="text-muted mb-0">+880-1739-871705</p>
                    </div>
                    <div class="col-12 col-lg-6 offset-lg-1">
                        <form action="#">
                            <input class="form-control mb-3" type="text" placeholder="Name">
                            <input class="form-control mb-3" type="email" placeholder="E-mail">
                            <textarea class="form-control mb-3" name="message" cols="30" rows="10" placeholder="Your Message..."></textarea>
                            <button class="btn bg-gradient-primary w-100">Action</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

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
                <p class="text-center">All rights reserved © Md Salim Reza 2023-2024</p>
            </div>
        </footer>

@endsection
