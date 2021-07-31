<nav class="navbar fixed-top nav-before navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home.index') }}"><img class="nav-logo" src="assets/images/navlogo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-3 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link nav-font" href="{{ route('home.index') }}">হোম </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-font" href="{{ route('course.index') }}">কোর্স সমুহ </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-font" href="{{ route('project.index') }}">প্রোজেক্ট </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-font" href="{{ route(('contact.index')) }}">যোগাযোগ</a>
            </li>
        </ul>
        {{-- <form class="form-inline my-2 my-lg-0">
            <button class="normal-btn btn" >সাইন ইন</button>
        </form> --}}
    </div>
</nav>