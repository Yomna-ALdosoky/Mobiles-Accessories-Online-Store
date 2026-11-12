@if (session()->has($type))
<div class="alert alert-{{ $type }} alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
    <div>
        {{ session($type) }}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif