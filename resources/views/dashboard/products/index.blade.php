@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products</li>
@endsection

@section('content')




{{-- <div class="mb-5"> --}}
    {{-- <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a> --}}
    {{-- <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary">
        + Create Product
    </a> --}}
    {{-- <a href="{{ route('dashboard.products.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a> --}}
    {{-- </div> --}}

<div class="d-flex justify-content-between align-items-center mb-5 ">
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary mx-2">
            + Create Product
        </a>
        <a href="{{ route('dashboard.products.trash') }}" class="btn btn-danger">
            <i class="fas fa-trash-alt me-1"></i> Trash
        </a>
    </div>
    <form action="{{ URL::current() }}" method="get" class="d-flex align-items-center gap-3 mx-2">
        <x-form.input name="name" placeholder="Name" class="form-control form-control-sm" :value="request('name')"
            style="width: 180px" />

        <select name="status" class="form-control form-control-sm mx-2" style="width: 180px">
            <option value="">All</option>
            <option value="active" @selected(request('status')=='active' )>Active</option>
            <option value="archived" @selected(request('status')=='archived' )>Archived</option>
        </select>

        <button class="btn btn-info btn-sm mx-1 d-flex align-items-center">
            <i class="bi bi-funnel-fill me-1"></i> Filter
        </button>
    </form>
</div>

<x-alert type="success" />
<x-alert type="info" />



{{-- <form action="{{ URL::current() }}" method="get" class="d-flex align-items-center gap-3 mb-4 mx-2">
    <x-form.input name="name" placeholder="Name" class="form-control form-control-sm" :value="request('name')"
        style="width: 180px" />

    <select name="status" class="form-control form-control-sm mx-2" style="width: 180px">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active' )>Active</option>
        <option value="archived" @selected(request('status')=='archived' )>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>

</form> --}}


{{-- <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active' )>Active</option>
        <option value="archived" @selected(request('status')=='archived' )>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form> --}}


<table class="table">
    <thead>
        <tr>
            <th class="p-3 text-center">#</th>
            <th class="p-3 text-center">Name</th>
            <th class="p-3 text-center">Category</th>
            <th class="p-3 text-center">Store</th>
            <th class="p-3 text-center">Status</th>
            <th class="p-3 text-center">Created At</th>
            <th class="p-3 text-center" colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i= ($products->currentPage() - 1) * $products->perPage() + 1;
        @endphp
        @forelse ($products as $product)
        <tr>
            {{-- <td class="p-4">{{ $category->id }}</td> --}}
            <td class="p-4 text-center">{{ $i++ }}</td>
            <td class="p-4 text-center">{{ $product->name }}</td>
            <td class="p-4 text-center">{{ $product->category->name }}</td>
            <td class="p-4 text-center">{{ $product->store->name }}</td>
            <td class="p-4 text-center">@if ($product->status === 'active')
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-secondary">Archived</span>
                @endif
            </td>
            <td class="p-4 text-center">{{ $product->created_at->format('d M, Y h:i A') }}</td>
            <td class="p-4 text-center">
                <a href="{{ route('dashboard.products.edit', $product->id) }}"
                    class="btn btn-sm btn-outline-success me-2" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" class="d-inline">
                    @csrf
                    <input type="hidden" name="method" value="delete">
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="9">No categories defind.</td>
        </tr>
        @endforelse
    </tbody>

</table>

{{ $products->withQueryString()->appends(['search' => 1 ])->links() }} {{-- paginate --}}


@endsection