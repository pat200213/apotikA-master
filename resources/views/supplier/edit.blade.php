@extends('layout.conquer')

@section('content')
<div class="portlet-body form">
	<form method="post" action="{{url('supplier/'.$data->supplier_id)}}">
        @csrf
        @method("PUT")
		<div class="form-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name='nama' class="form-control input-lg" value="{{$data->name}}" placeholder="Enter Your Text">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name='alamat' rows="3">{{$data->address}}</textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </form>
</div>
@endsection