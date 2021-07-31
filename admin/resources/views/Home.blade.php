@extends('layouts.app')
@section('title', 'Home')

@section('main-content')
    <div class="container mt-5">
        <h2 class="px-2 mx-2">Overview</h2>
        <div class="row mx-2">
            <div class="col-md-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{ $visitor }}</h3>
                        <h3 class="count-card-text">Total Visitor</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{ $service }}</h3>
                        <h3 class="count-card-text">Total Service</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{ $project }}</h3>
                        <h3 class="count-card-text">Total Project</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{ $contact }}</h3>
                        <h3 class="count-card-text">Total Contact</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{ $testimonial }}</h3>
                        <h3 class="count-card-text">Total Review</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="count-card-title">{{ $course }}</h3>
                        <h3 class="count-card-text">Total Course</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
