@extends('layout.conquer')

@section('javascript')
<script>
  function getEditForm(id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("medicines.getEditForm")}}',
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
      url:'{{route("medicines.getEditForm2")}}',
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
   
   var faskes1 = ($("#eFaskes1").is(":checked")? 1:0);
   var faskes2 = ($("#eFaskes2").is(":checked")? 1:0);
   var faskes3 = ($("#eFaskes3").is(":checked")? 1:0);
    var name = $('#eName').val();
    var form = $('#eForm').val(); 
    var formula = $('#eFormula').val();
    var harga = $('#eHarga').val(); 
    var kategori = $('#eCategory').val();
    var deskripsi = $('#eDeskripsi').val();

    var foto = $('#eFoto').val();

    var sup = $('#eSupplier').val();

    var foto_data = foto.split(/(\\|\/)/g).pop();

    var flag = "http://127.0.0.1:8000/assets/images/";
    alert(foto_data);

    $.ajax({
      
      type:'POST',
      url:'{{route("medicines.saveData")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id,
        'myname':name,
        'myform':form,
        'myformula':formula,
        'myharga':harga,
        'mycategory':kategori,
        'myfoto':foto_data,
        'mydesk':deskripsi,
        'mysup':sup,
        'myfaskes1':faskes1,
        'myfaskes2':faskes2,
        'myfaskes3':faskes3,
      },
      success: function(data){
        if(data.status == 'oke'){
            alert(data.msg);
            $('#td_name').html(name);
            $('#td_form').html(form);
            $('#td_formula').html(formula);
            $('#td_harga').html(harga);
            $('#td_category').html(data.kat);         
            $('#td_foto').attr('src',  flag + data.img);
            
        }
       
      }
     
    });

  }

  function deleteDataRemoveTR(id)
  {
   
    $.ajax({
      type:'POST',
      url:'{{route("medicines.deleteData")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id
      },
      success: function(data){
        if(data.status == 'oke'){
            alert(data.msg);
            window.location.href='/medicines';
           
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

  <div class="container" style='width: 100%; cellspacing:0;'>
  <h2>Medicine Detail</h2>

  <div>
    @if(Auth::user()->roles == 'owner')
   
      <a href="#modalEdit" data-toggle='modal' class="btn btn-xs btn-warning" onclick="getEditForm({{$data->id}})">Edit</a>
          
    @endif

    @if(Auth::user()->roles == 'owner')
     
      <a class="btn btn-xs btn-danger" onclick='if(confirm("Are sure want to delete {{$data->name}}?")) deleteDataRemoveTR({{$data->id}})' >Delete</a>
    @endif

  </div><br>

  <table class="table">
    <thead>
      <tr>
        <th>Information</th>
        <th>Result</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Generic Name </td>
        <td id='td_name'>{{$data->name}}</td>
      </tr>
      <tr>
        <td>Medicine Form</td>
        <td id='td_form'>{{$data->form}}</td>
      </tr>
      <tr>
        <td>Formula</td>
        <td id='td_formula'>{{$data->restriction_formula}}</td>
    </tr>
    <tr>
        <td>Category</td>
        <td id='td_category'>{{$data->category->category_name}}</td>
    </tr>
    <tr>
        <td>Price (IDR)</td>
        <td id='td_harga'>{{ number_format($data->price, 2, ',', '.') }}</td>
    </tr>
    <tr>
        <td>Available Stock</td>
        <td id='td_stock'>{{$data->stock}}</td>
    </tr>
    <tr>
        <td>Photo</td>
        <td>
          <a id='td_a' data-target="#detail_{{$data->id}}" data-toggle="modal">
            <img id='td_foto' src="{{asset('assets/images/'.$data->image) }}" class="rounded" width="250px" height="250px"/>
          </a>
        </td>
      </tr>
  
    </tbody>
  </table>
    
</div>


  <div class="modal fade" id="detail_{{$data->id}}" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{$data->name}} {{$data->form}}</h4>
        </div>
        <div class="modal-body">
          <img src="{{asset('assets/images/'.$data->image) }}" height='400px' />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id='modalContent'>
        
      </div>
    </div>
  </div>

@endsection
  