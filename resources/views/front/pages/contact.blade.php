@extends('front.templates.default')

@section('head')
    <title>Contact</title>
@endsection

@section('body')
    <div class="full-page page-white">
        <section class="checkout-page">
            <div class="container mb-40">
                @include('errors.list')
                <h3>Contact Us</h3>

                <form class="_form" action="" method="post">
                    {{ csrf_field() }}

                    <div class="row mt-40">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name*</label>
                                        <input type="text" name="firstname" class="form-control input-lg" required placeholder="Enter your first name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name*</label>
                                        <input type="text" name="lastname" class="form-control input-lg" required placeholder="Enter your last name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" name="email" class="form-control input-lg" required placeholder="email@domain.com">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" class="form-control input-lg" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea name="comment" rows="6" class="form-control" placeholder="Enter your message"></textarea>
                            </div>

                            <div class="mt-40 text-right pb-20">
                                <button type="submit" class="btn btn-lg btn-primary w-200"> SUBMIT </button>
                            </div>
                        </div>
                    </div>
                </form>


                <hr>




                <div class="address">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>SALES</h4>
                            <div class="details">
                                <i class="ion-ios-location"></i> Address
                                <br> <span>5/6 Cary Grove, Minto, NSW 2566</span>
                            </div>

                            <div class="details">
                                <i class="ion-android-call"></i> Sales Phone
                                <br> <span>(1300) 963-668</span>
                            </div>

                            <div class="details">
                                <i class="ion-android-time"></i> Sales Hours
                                <ul class="list-unstyled">
                                    <li>Mon – Fri: 09:00AM – 05:00PM</li>
                                    <li>Saturday: 09:00AM – 02:00PM</li>
                                    <li>Sunday: Closed</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div id="map" style="width:100%;height:400px;">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

@endsection



@section('js')
<script>
function initMap() {
    var uluru = {lat: -33.868148, lng: 151.100239};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 18,
        center: uluru
    });
    var marker = new google.maps.Marker({
        position: uluru,
        // icon: '/assets/img/map-marker.png',
        map: map
    });
}
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRlVespe1t8sflUwQBR_eK7ZhibqNu6XA&callback=initMap">
</script>
@endsection
