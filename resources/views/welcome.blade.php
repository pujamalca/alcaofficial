@extends('layouts.app')

@section('title', 'Home - ' . config('app.name'))
@section('meta_description', 'Jasa Pembuatan Website Professional Terbaik di Indonesia - AlcaOfficial. Website modern, responsive, dan berkualitas tinggi dengan harga terjangkau.')

@section('content')

{{-- Hero Section --}}
@include('sections.hero')

{{-- Why Choose Us Section --}}
@include('sections.why-choose')

{{-- Tech Stack Section --}}
@include('sections.tech-stack')

{{-- FAQ Section --}}
@include('sections.faq')

{{-- Process Section --}}
@include('sections.process')

{{-- CTA Section --}}
@include('sections.cta')

{{-- Other sections (Services, Portfolio, Pricing, Testimonials, Contact, Footer) will be added in Phase 3-4 --}}

@endsection
