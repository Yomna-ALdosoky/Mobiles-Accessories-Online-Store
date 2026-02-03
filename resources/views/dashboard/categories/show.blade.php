@extends('layouts.dashboard')

@section('title', $category->name)

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active"> {{$category->name}} </li>

@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th class="p-3 text-center">#</th>
            <th class="p-3 text-center">Name</th>
            <th class="p-3 text-center">Store</th>
            <th class="p-3 text-center">Status</th>
            <th class="p-3 text-center">Create At</th>
        </tr>
    </thead>
    <tbody>
        @php
        $products = $category->products()->with('store')->latest()->paginate(5);
        @endphp
        @forelse ($products as $product)
        <tr>
            <td class="p-4 text-center">
                <img src="{{asset('storage/' .$product->image)}}" alt="" height="70px">
            </td>
            <td class="p-4 text-center">{{$product->name}}</td>
            <td class="p-4 text-center">{{$product->store->name}}</td>
            <td class="p-4 text-center">{{$product->status}}</td>
            <td class="p-4 text-center">{{$product->created_at->format('d M, Y h:i A')}}</td>
        </tr>
        @empty
        <tr>
            <td class="p-5" colspan="5">No products defind.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links() }}

@endsection