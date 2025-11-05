@extends('layouts.app')

@section('title', 'Home - ' . config('app.name'))
@section('meta_description', 'Jasa Pembuatan Website Professional Terbaik di Indonesia - AlcaOfficial. Website modern, responsive, dan berkualitas tinggi dengan harga terjangkau.')

@section('content')

{{-- Hero Section --}}
@include('sections.hero')

{{-- Other sections will be added in Phase 2-4 --}}

@endsection
