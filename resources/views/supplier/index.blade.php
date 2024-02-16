@extends('layout.conquer')

@section('javascript')
<script>
  function getEditForm(id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("supplier.getEditForm")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id
      },
      success: function(data){
       
        $('#modalContent').html(data.msg)
      }
    });
  }

  function getEditForm2(id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("supplier.getEditForm2")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id
      },
      success: function(data){
        $('#modalContent').html(data.msg)
      }
    });
  }

  function saveDataUpdateTD(id)
  {
    var name = $('#eName').val();
    var address = $('#eAddress').val(); 
   
    $.ajax({
      type:'POST',
      url:'{{route("supplier.saveData")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id,
        'myname':name,
        'myaddress':address,
      },
      success: function(data){
        if(data.status == 'oke'){
            alert(data.msg);
            $('#td_name_' + id).html(name);
            $('#td_address_' + id).html(address);
        }
        
      }
    });
  }

  function deleteDataRemoveTR(id)
  {
    var name = $('#eName').val();
    var address = $('#eAddress').val(); 
   
    $.ajax({
      type:'POST',
      url:'{{route("supplier.deleteData")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id
      },
      success: function(data){
        if(data.status == 'oke'){
            alert(data.msg);
            $('#tr_' + id).remove();
        }
        else{
          alert(data.msg);
        }
        
      }
    });
  }

</script>

@endsection


@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="fa fa-home"></i>
      <a href="/">Home</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      
      <a href="/supplier">Supplier</a>
        
    </li>
  </ul>

  <div class="page-toolbar">
        <!-- tempat action button -->        
      
        <a href="#modalCreate" data-toggle='modal' class="btn btn-info" type="button">Add Supplier</a>
  </div>
</div>

<div class="container" style='width: 100%; cellspacing:0;'>
  <h2>List of Our Suppliers</h2>
  
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

  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $d)
        <tr id='tr_{{$d->id}}'>
          <td id='td_name_{{$d->id}}'>{{$d->name}}</td>
          <td id='td_address_{{$d->id}}'>{{$d->address}}</td>
    
          <td><a href="#modalEdit" data-toggle='modal' class="btn btn-xs btn-warning" onclick="getEditForm({{$d->id}})">Edit</a></td>
        
          <td>
            @if(Auth::user()->roles == 'owner')
            <form method="post" action="{{url('supplier/'.$d->id)}}">
              @csrf
              @method("DELETE")
              <input type="submit" value="delete" class="btn btn-xs btn-danger" onclick='if(!confirm("Are sure want to delete {{$d->name}}?")) return false;'>
            </form>
            @endif
          </td>

        
        </tr>
      @endforeach
    
      <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Add New Supplier</h4>
            </div>
            
            <div class="modal-body">
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

      <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" id='modalContent'>
            
          </div>
        </div>
      </div>


    </tbody>
  </table>
@endsection