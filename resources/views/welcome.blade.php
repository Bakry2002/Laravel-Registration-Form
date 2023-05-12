@extends('layouts.master')

@section('title', 'Welcome')

@section('content')
    <div class="hero">
        <div class="hero-text">
            <h1 class="text-center">{{ __('welcome.welcome') }}</h1>
            <p>{{ __('welcome.slogan') }}</p>
        </div>
        <div class="cta-btn">
            <a class="cta-register" href="{{ route('students.create') }}">{{ __('welcome.register') }}</a>
        </div>
    </div>

@endsection
