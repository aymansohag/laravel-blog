@extends('layouts.app')
    @section('title', Contact us)
    @section('main-content')
        <div class="container-fluid jumbotron mt-5 ">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6  text-center">
                        <img class=" page-top-img fadeIn" src="assets/images/knowledge.svg">
                        <h1 class="page-top-title mt-3">- যোগাযোগ করুন  -</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1827.6162721514547!2d90.6870631009102!3d23.63184166667386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1618567697025!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-md-6" style="padding-left: 100px">
                    <div>
                        <h3 class="service-card-title">ঠিকানা</h3>
                        <hr>
                        <p class="footer-text"><i class="fas fa-map-marker-alt"></i> শেখেরটেক ৮ মোহাম্মদপুর, ঢাকা </p>
                        <p class="footer-text"><i class="fas fa-phone"></i> ০১৭৮৫৩৮৮৯১৯ </p>
                        <p class="footer-text"><i class="fas fa-envelope"></i> Rabbil@Yahoo.com</p>
                        <hr>
                    </div>

                    <h5 class="service-card-title">যোগাযোগ করুন</h5>
                    <div class="form-group ">
                        <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
                    </div>
                    <div class="form-group">
                        <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                    </div>
                    <div class="form-group">
                        <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                    </div>
                    <div class="form-group">
                        <input id="contactMessageId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                    </div>
                    <button id="contactSaveBtn" type="submit" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন</button>
                </div>
            </div>
        </div>
@endsection
