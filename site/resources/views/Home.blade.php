@extends('layouts.app')
@section('title', 'Home')
@section('main-content')

{{-- Hompage Banner view --}}
@include('component.HomeBanner')

{{-- Hompage Service view --}}
@include('component.HomeService')

{{-- Homepage Course view --}}
@include('component.HomeCourse')

{{-- Homepage project view --}}
@include('component.HomeProject')

{{-- Homepage contact view --}}
@include('component.HomeContact')

{{-- Homepage contact view --}}
@include('component.HomeTestimonial')


@endsection
