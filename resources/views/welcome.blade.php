@extends('layouts.app')

@section('title', 'Home - ' . config('app.name'))
@section('meta_description', 'Jasa Pembuatan Website Professional Terbaik di Indonesia - AlcaOfficial. Website modern, responsive, dan berkualitas tinggi dengan harga terjangkau.')

@section('content')

{{-- Hero Section --}}
@include('sections.hero')

{{-- Services Section --}}
@include('sections.services')

{{-- Why Choose Us Section --}}
@include('sections.why-choose')

{{-- Portfolio Section --}}
@include('sections.portfolio')

{{-- Pricing Section --}}
@include('sections.pricing')

{{-- Tech Stack Section --}}
@include('sections.tech-stack')

{{-- Testimonials Section --}}
@include('sections.testimonials')

{{-- FAQ Section --}}
@include('sections.faq')

{{-- Process Section --}}
@include('sections.process')

{{-- CTA Section --}}
@include('sections.cta')

{{-- Contact Section --}}
@include('sections.contact')

{{-- WhatsApp Float Button (Phase 4) --}}
@include('components.whatsapp-float')

@endsection
