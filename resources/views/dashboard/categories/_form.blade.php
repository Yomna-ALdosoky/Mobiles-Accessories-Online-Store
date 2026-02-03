@if ($errors->any())
<div class="alert alert-danger">
    <h3>Error Occured!</h3>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-group">
    {{-- <label for=""> Category Name </label> --}}
    <x-form.input label="Category Name" class="form-control-lg" role="input" name="name" :value="$category->name" />
</div>
<div class="form-group">
    <label for=""> Category Parent </label>
    <select name="parent_id" class="form-control form-select">
        <option value=""> primary category </option>
        @foreach ($parents as $parent)
        <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id))> {{ $parent->name }}
        </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for=""> Description </label>
    <x-form.textarea name="description" :value="$category->description" />
</div>
<div class="form-group">
    <x-form.label for="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />

    @if ($category->image)
    <img src="{{ asset('storage/' . $category->image) }}" alt="" height="60">
    @endif
</div>
<div class="form-group">
    <label for=""> Status </label>
    <x-form.radio name="status" :checked="$category->status"
        :options="['active'=>'Active', 'archived' => 'Archived']" />
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $buttom_lable ?? 'Save' }}</button>
</div>


{{-- <div class="form-group">
    <label for=""> Category Name </label>
    <input type="text" name="name" class="form-control">
</div>
<div class="form-group">
    <label for=""> Category Parent </label>
    <select name="parent_id" class="form-control form-select">
        <option value=""> primary category </option>
        @foreach ($parents as $parent)
        <option value="{{ $parent->id }}"> {{ $parent->name }} </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for=""> Description </label>
    <textarea name="description" class="form-control"></textarea>
</div>
<div class="form-group">
    <label for=""> Image </label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label for=""> Status </label>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="active" checked>
        <label class="form-check-label">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="archived">
        <label class="form-check-label">
            Archived
        </label>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div> --}}