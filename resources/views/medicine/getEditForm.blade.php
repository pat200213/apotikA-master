<form method="post" action="{{url('medicines/'.$data->id)}}" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Medicine</h4>
    </div>
    <div class="modal-body">
        @csrf
        @method("PUT")
		<div class="form-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name='name' class="form-control input-lg" placeholder="Enter Text" value="{{$data->name}}">
            </div>
            <div class="form-group">
                <label>Form</label>
                <input type="text" name='form' class="form-control input-lg" placeholder="Enter Text" value="{{$data->form}}">
            </div>
            <div class="form-group">
                <label>Formula</label>
                <input type="text" name='formula' class="form-control input-lg" placeholder="Enter Text" value="{{$data->restriction_formula}}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name='description' class="form-control input-lg" placeholder="Enter Text" value="{{$data->description}}">
            </div>
            <div class="form-group">
                <label>Price (IDR)</label>
                <input type="number" name='price' class="form-control input-lg" placeholder="Enter number" value="{{$data->price}}">
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="number" name='stock' class="form-control input-lg" placeholder="Enter number" min=0 value="{{$data->stock}}">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type='file' name='image' value="{{$data->image}}">
                <img src="{{asset('assets/images/'.$data->image)}}" class="img-responsive">
            </div>
            <div class="form-group">
                <div class="checkbox-list">
                    <label>
                    <input type="checkbox" name='faskes1' value=true {{$data->faskes1 == 1 ? 'checked':''}}> Faskes 1 </label>
                    <label>
                    <input type="checkbox" name='faskes2' value=true {{$data->faskes2 == 1 ? 'checked':''}}> Faskes 2 </label>
                    <label>
                    <input type="checkbox" name='faskes3' value=true {{$data->faskes3 == 1 ? 'checked':''}}> Faskes 3 </label>
                </div>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control input-small" name="kategori">
                    @foreach($cat as $d)
                        <option value="{{$d->id}}" {{$data->category_id == $d->id ? 'selected':''}}>{{$d->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <select class="form-control input-small" name="supplier">
                    @foreach($sup as $d)
                        <option value="{{$d->id}}" {{$data->supplier_id == $d->id ? 'selected':''}}>{{$d->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

        <div class="modal-footer">
      
                <button type="submit" class="btn btn-info">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss='modal'>Cancel</button>
        </div>
</form>