@extends('frontend.layouts.customer')
@section('content')
<div class="row">
    <div class="col-12">
        @include('components.customer-data', ['customer' => $customer])
    </div>
    @include('components.customer-addresess', ['addresses' => $addresses])
</div>
@endsection