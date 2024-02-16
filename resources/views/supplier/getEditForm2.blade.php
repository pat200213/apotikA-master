<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Edit Supplier</h4>
</div>

<div class="modal-body">

    <div class="form-body">
        <div class="form-group">
            <label>Name</label>
            <input type="text" id='eName' name='nama' class="form-control input-lg" value="{{$data->name}}" placeholder="Enter Your Text">
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea id='eAddress' class="form-control" name='alamat' rows="3">{{$data->address}}</textarea>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-info" data-dismiss="modal" onclick="saveDataUpdateTD({{$data->supplier_id}})">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>  
</div>
