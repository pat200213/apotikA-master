@extends('layout.conquer')

@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="fa fa-home"></i>
      <a href="/">Home</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      
      <a href="/medicines">Medicine</a>
        
    </li>
  </ul>

  <div class="page-toolbar">
        <!-- tempat action button -->        
    
        <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Add Medicines</a>
  </div>
</div>

<div class="container" style='width: 100%; cellspacing:0;'>
  <h2>List Medicines</h2>
 
  @if(session('status'))
      <div class="alert alert-success">
          {{session('status')}}
      </div>
  @endif
  
  @if(session('error'))
      <div class="alert alert-danger">
          {{session('error')}}
      </div>
  @endif

   <div class="row">
      @foreach($result as $d)
        <div class="col-sm-4">
          <div class="card text-center">
            
            <div class="card-body">
              <img src="{{asset('assets/images/'.$d->image) }}" width="200px" height="200px"><br>

                <a href="/medicines/{{$d->id}}">
                    <b>{{$d->name}}</b> <br>
                    <p>{{$d->form}}</p>
                </a>
            </div>
              
          </div>
        </div>
          
      @endforeach
    </div>
</div>


<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add New Medicine</h4>
      </div>
            
      <div class="modal-body">
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
                <input type="number" name='stock' class="form-control input-lg" min="0" value="0">
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
                    @foreach($cat as $d)
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
          </div>
       
      </div>
            
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>  

      </div>
      </form>
    </div>
  </div>
</div>

@endsection
