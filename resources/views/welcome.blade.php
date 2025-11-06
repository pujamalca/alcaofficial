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

{{-- Services Section (Phase 3) --}}
@include('sections.services')

{{-- Portfolio Section (Phase 3) --}}
@include('sections.portfolio')

{{-- Pricing Section (Phase 3) --}}
@include('sections.pricing')

{{-- Testimonials Section (Phase 3) --}}
@include('sections.testimonials')

{{-- CTA Section --}}
@include('sections.cta')

{{-- Contact Section (Phase 4) --}}
@include('sections.contact')

{{-- WhatsApp Float Button (Phase 4) --}}
@include('components.whatsapp-float')

@endsection
