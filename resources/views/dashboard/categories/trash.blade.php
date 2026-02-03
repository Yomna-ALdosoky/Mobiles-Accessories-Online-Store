@extends('layouts.dashboard')

@section('title', 'Trashed Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Trash</li>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-5 ">
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard.categories.index') }}"
            class="btn btn-info btn-md d-flex align-items-center mx-1 px-3 py-2">
            <i class="fas fa-arrow-left"></i>
            <span class="ms-2">Back</span>
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

{{-- <div class="mb-5">
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
</div> --}}

<x-alert type="success" />
<x-alert type="info" />

{{-- <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-5">
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
            <th class="p-3 text-center">Image</th>
            <th class="p-3 text-center">Name</th>
            <th class="p-3 text-center">Status</th>
            <th class="p-3 text-center">Deleted At</th>
            <th class="p-3 text-center" colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i= ($categories->currentPage() - 1) * $categories->perPage() + 1;
        @endphp
        @forelse ($categories as $category)
        <tr>
            {{-- <td>
                <img src="{{asset('storage/' .$category->image)}}" alt="" height="70px">
            </td> --}}
            <td class="p-4 text-center">{{$i++}}</td>
            <td class="p-4 text-center">
                @if($category->image !== null)
                <img src="{{ asset('storage/' . $category->image) }}" alt="" class="rounded-circle object-fit-cover"
                    width="70" height="70">
                @endif

            </td>
            <td class="p-4 text-center">{{$category->name}}</td>
            <td class="p-4 text-center">{{$category->status}}</td>
            <td class="p-4 text-center">{{$category->deleted_at->format('d M, Y h:i A')}}</td>

            <td class="p-4 text-center">
                <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="post"
                    class="d-inline">
                    @csrf
                    <input type="hidden" name="method" value="delete">
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-outline-success" title="Restore">
                        <i class="fas fa-redo-alt"></i>
                    </button>
                </form>

                <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="post"
                    class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                {{-- <form action="{{ route('dashboard.categories.force-delete', $category->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form> --}}
            </td>

            {{-- <td>
                <form action="{{ route('dashboard.categories.restore', $category->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                </form>
            </td>
            <td>

                <form action="{{ route('dashboard.categories.force-delete', $category->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>

            </td> --}}

        </tr>
        @empty
        <tr>
            <td colspan="7">No categories defind.</td>
        </tr>
        @endforelse
    </tbody>

</table>
{{ $categories->withQueryString()->appends(['search' => 1 ])->links() }} {{-- paginate --}}


@endsection