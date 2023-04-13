@extends('layouts.master-layout')

@section('content')
<!-- 404 Error Text -->
<div class="text-center">
    <p class="lead text-gray-800">Your transaction successfully, this your order ID</p>
    <div class="h1 mx-auto">{{ $orderId }}</div>
    <a href="{{ route('sales.index') }}">&larr; Back to Sales</a>
    <a href="{{ route('report.index') }}" class="ml-5">Go to Report &rarr; </a>
</div>

@endsection
