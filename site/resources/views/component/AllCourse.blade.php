<div class="container mt-5">
    <div class="row">
        @foreach ($course_data as $data)
            <div class="col-md-4 p-1 text-center">
                <div class="card">
                    <div class="text-center">
                        <img class="w-100" src="{{ $data -> course_img }}" alt="Card image cap">
                        <h5 class="service-card-title mt-4">{{ $data -> course_name }}</h5>
                        <h6 class="service-card-subTitle p-0 ">{{ $data -> course_des }}</h6>
                        <h6 class="service-card-subTitle p-0 ">{{ $data -> course_fee }} {{ $data -> course_enroll }} </h6>
                        <button class="normal-btn-outline mt-2 mb-4 btn">শুরু করুন </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
