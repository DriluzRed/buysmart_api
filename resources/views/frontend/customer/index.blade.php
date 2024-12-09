@extends('frontend.layouts.customer')
@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.customer-data', ['customer' => $customer])
    </div>
    @include('components.customer-addresess', ['addresses' => $addresses])
</div>
@endsection