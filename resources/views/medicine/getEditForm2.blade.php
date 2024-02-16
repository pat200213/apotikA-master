
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Medicine</h4>
    </div>
    <div class="modal-body">
      
		<div class="form-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" id='eName' name='name' class="form-control input-lg" placeholder="Enter Text" value="{{$data->name}}">
            </div>
            <div class="form-group">
                <label>Form</label>
                <input type="text" id='eForm' name='form' class="form-control input-lg" placeholder="Enter Text" value="{{$data->form}}">
            </div>
            <div class="form-group">
                <label>Formula</label>
                <input type="text" id='eFormula' name='formula' class="form-control input-lg" placeholder="Enter Text" value="{{$data->restriction_formula}}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" id='eDeskripsi' name='description' class="form-control input-lg" placeholder="Enter Text" value="{{$data->description}}">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" id='eHarga' name='price' class="form-control input-lg" placeholder="Enter number" value="{{$data->price}}">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type='file' id='eFoto' name='image' value="{{$data->image}}">
                <img src="{{asset('assets/images/'.$data->image)}}">
                
            </div>
            <div class="form-group">
                <div class="checkbox-list">
                    <label>
                    <input type="checkbox" id='eFaskes1' name='faskes1' value=true {{$data->faskes1 == 1 ? 'checked':''}}> Faskes 1 </label>
                    <label>
                    <input type="checkbox" id='eFaskes2' name='faskes2' value=true {{$data->faskes2 == 1 ? 'checked':''}}> Faskes 2 </label>
                    <label>
                    <input type="checkbox" id='eFaskes3' name='faskes3' value=true {{$data->faskes3 == 1 ? 'checked':''}}> Faskes 3 </label>
                </div>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select id='eCategory' class="form-control input-small" name="kategori">
                    @foreach($cat as $d)
                        <option value="{{$d->id}}" {{$data->category_id == $d->id ? 'selected':''}}>{{$d->category_name}}</option>
                    
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <select id='eSupplier' class="form-control input-small" name="supplier">
                    @foreach($sup as $d)
                        <option value="{{$d->supplier_id}}" {{$data->idSupplier == $d->supplier_id ? 'selected':''}}>{{$d->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

        <div class="modal-footer">
      
        <button type="button" class="btn btn-info" data-dismiss="modal" onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss='modal'>Cancel</button>
        </div>