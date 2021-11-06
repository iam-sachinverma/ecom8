@extends('layouts.front_layout.front_layout')
@section('content')

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
</section>

@endsection