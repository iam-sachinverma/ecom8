@extends('layouts.front_layout.front_layout')
@section('content')
<!-- 
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                    <h2>Contact Us</h2>
                    <p>
                        There are many variations of passages of Lorem Ipsum
                        available, but the majority have suffered alteration in some
                        form.
                    </p>
                    </div>
                </div>
            </div>
            <div class="contact-info">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="single-info-head">
                            <div class="single-info">
                            <i class="lni lni-map"></i>
                            <h3>Address</h3>
                            <ul>
                                <li>
                                44 Shirley Ave. West Chicago,<br />
                                IL 60185, USA.
                                </li>
                            </ul>
                            </div>

                            <div class="single-info">
                            <i class="lni lni-phone"></i>
                            <h3>Call us on</h3>
                            <ul>
                                <li>
                                <a href="tel:+18005554400"
                                    >+1 800 555 44 00 (Toll free)</a
                                >
                                </li>
                                <li><a href="tel:+321556667890">+321 55 666 7890</a></li>
                            </ul>
                            </div>

                            <div class="single-info">
                            <i class="lni lni-envelope"></i>
                            <h3>Mail at</h3>
                            <ul>
                                <li>
                                <a
                                    href="https://demo.graygrids.com/cdn-cgi/l/email-protection#e2919792928d9096a2918a8d9285908b8691cc818d8f"
                                    ><span
                                    class="__cf_email__"
                                    data-cfemail="cfbcbabfbfa0bdbb8fbca7a0bfa8bda6abbce1aca0a2"
                                    >[email&#160;protected]</span
                                    ></a
                                >
                                </li>
                                <li>
                                <a
                                    href="https://demo.graygrids.com/cdn-cgi/l/email-protection#5734362532322517243f382730253e33247934383a"
                                    ><span
                                    class="__cf_email__"
                                    data-cfemail="5536342730302715263d3a2532273c31267b363a38"
                                    >[email&#160;protected]</span
                                    ></a
                                >
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class="contact-form-head">
                            <div class="form-main">
                            <form
                                class="form"
                                method="post"
                                action="{{ url('/contact') }}"
                            >@csrf
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                    <input
                                        name="name"
                                        type="text"
                                        placeholder="Your Name"
                                        required="required"
                                    />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                    <input
                                        name="subject"
                                        type="text"
                                        placeholder="Your Subject"
                                        required="required"
                                    />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                    <input
                                        name="email"
                                        type="email"
                                        placeholder="Your Email"
                                        required="required"
                                    />
                                    </div>
                                </div>
                            
                                <div class="col-12">
                                    <div class="form-group message">
                                    <textarea
                                        name="comment"
                                        placeholder="Your Message"
                                    ></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group button">
                                    <button type="submit" class="btn">
                                        Submit Message
                                    </button>
                                    </div>
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
</section> -->


    <!-- Page Title (Light)-->
    <div class="bg-secondary py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="ci-home"></i>Home</a></li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">Contacts</li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">Contacts</h1>
          </div>
        </div>
    </div>
    
    <!-- Contact detail cards-->
    <section class="container-fluid pt-grid-gutter">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-grid-gutter"><a class="card h-100" href="#map" data-scroll>
                <div class="card-body text-center"><i class="ci-location h3 mt-2 mb-4 text-primary"></i>
                <h3 class="h6 mb-2">Main store address</h3>
                <p class="fs-sm text-muted">396 Lillian Blvd, Holbrook, NY 11741, USA</p>
                <div class="fs-sm text-primary">Click to see map<i class="ci-arrow-right align-middle ms-1"></i></div>
                </div></a></div>
            <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <div class="card h-100">
                <div class="card-body text-center"><i class="ci-time h3 mt-2 mb-4 text-primary"></i>
                <h3 class="h6 mb-3">Working hours</h3>
                <ul class="list-unstyled fs-sm text-muted mb-0">
                    <li>Mon - Fri: 10AM - 7PM</li>
                    <li class="mb-0">Sta: 11AM - 5PM</li>
                </ul>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <div class="card h-100">
                <div class="card-body text-center"><i class="ci-phone h3 mt-2 mb-4 text-primary"></i>
                <h3 class="h6 mb-3">Phone numbers</h3>
                <ul class="list-unstyled fs-sm mb-0">
                    <li><span class="text-muted me-1">For customers:</span><a class="nav-link-style" href="tel:+108044357260">+1 (080) 44 357 260</a></li>
                    <li class="mb-0"><span class="text-muted me-1">Tech support:</span><a class="nav-link-style" href="tel:+100331697720">+1 00 33 169 7720</a></li>
                </ul>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-grid-gutter">
            <div class="card h-100">
                <div class="card-body text-center"><i class="ci-mail h3 mt-2 mb-4 text-primary"></i>
                <h3 class="h6 mb-3">Email addresses</h3>
                <ul class="list-unstyled fs-sm mb-0">
                    <li><span class="text-muted me-1">For customers:</span><a class="nav-link-style" href="mailto:+108044357260">customer@example.com</a></li>
                    <li class="mb-0"><span class="text-muted me-1">Tech support:</span><a class="nav-link-style" href="mailto:support@example.com">support@example.com</a></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </section>

    <!-- Split section: Map + Contact form-->
    <div class="container-fluid px-0" id="map">
        <div class="row g-0">
          
          <div class="col px-4 px-xl-5 py-5 border-top">
            <h2 class="h4 mb-4">Drop us a line</h2>
            <form class="form mb-3" action="{{ url('/contact') }}" method="post">@csrf
              <div class="row g-3">
                <div class="col-sm-6">
                  <label class="form-label" for="name">Your name:&nbsp;<span class="text-danger">*</span></label>
                  <input class="form-control" type="text" id="name" name="name" placeholder="Your name" required>
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="email">Email address:&nbsp;<span class="text-danger">*</span></label>
                  <input class="form-control" type="email" id="email" name="email" placeholder="Your email address" required>
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="subject">Subject:</label>
                  <input class="form-control" type="text" name="subject" id="subject" placeholder="Provide short title of your request">
                </div>
                <div class="col-12">
                  <label class="form-label" for="comment">Message:&nbsp;<span class="text-danger">*</span></label>
                  <textarea class="form-control" id="comment" name="comment" rows="6" placeholder="Please describe in detail your request" required></textarea>
                  
                  <button class="btn btn-primary mt-4" type="submit">Send message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>

@endsection