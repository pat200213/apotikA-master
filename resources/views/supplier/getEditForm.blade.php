<form role='form' method="post" action="{{url('supplier/'.$data->id)}}">
    @csrf
    @method("PUT")
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Supplier</h4>
    </div>

    <div class="modal-body">
      
        <div class="form-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name='nama' class="form-control input-lg" value="{{$data->name}}" placeholder="Enter Your Text">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name='alamat' rows="3">{{$data->address}}</textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>  
    </div>
</form>