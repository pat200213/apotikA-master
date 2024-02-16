@extends('layout.conquer')

@section('content')
<div class="portlet-body form">
    <h4 class="">Add New Supplier</h4>
    
    <br>

	<form method="post" action="{{url('supplier')}}">
        @csrf
		<div class="form-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name='nama' class="form-control input-lg" placeholder="Enter Text">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name='alamat' rows="3"></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </form>
</div>
@endsection