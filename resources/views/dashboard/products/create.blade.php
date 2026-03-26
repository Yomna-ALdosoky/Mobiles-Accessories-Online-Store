@extends('layouts.dashboard')

@section('title', 'Create Product')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products</li>
<li class="breadcrumb-item active">Create product</li>

@endsection

@section('content')

<form action="{{ route('dashboard.products.create', $product->id)}}" method="post" enctype="multipart/form-data">
    @csrf

    @include('dashboard.products._form', [
    'button_label' => 'Create'
    ])

</form>
@endsection