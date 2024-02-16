@extends('layout.conquer')

@section('content')
<div class="portlet-body form">
    <h4 class="">Add New Medicine</h4>
    
    <br>

	<form method="post" action="{{url('medicines')}}" enctype="multipart/form-data">
        @csrf
		<div class="form-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name='name' class="form-control input-lg" placeholder="Enter Text">
            </div>
            <div class="form-group">
                <label>Form</label>
                <input type="text" name='form' class="form-control input-lg" placeholder="Enter Text">
            </div>
            <div class="form-group">
                <label>Formula</label>
                <input type="text" name='formula' class="form-control input-lg" placeholder="Enter Text">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name='description' class="form-control input-lg" placeholder="Enter Text">
            </div>
            <div class="form-group">
                <label>Price (IDR)</label>
                <input type="number" name='price' class="form-control input-lg" placeholder="Enter number">
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="number" name='stock' class="form-control input-lg" min=0 value="0">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type='file' name='image'>
            </div>
            <div class="form-group">
                <div class="checkbox-list">
                    <label>
                    <input type="checkbox" name='faskes1' value=true> Faskes 1 </label>
                    <label>
                    <input type="checkbox" name='faskes2' value=true> Faskes 2 </label>
                    <label>
                    <input type="checkbox" name='faskes3' value=true> Faskes 3 </label>
                </div>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control input-small" name="kategori">
                    @foreach($data as $d)
                        <option value="{{$d->id}}">{{$d->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <select class="form-control input-small" name="supplier">
                    @foreach($sup as $d)
                        <option value="{{$d->supplier_id}}">{{$d->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </form>
</div>
@endsection