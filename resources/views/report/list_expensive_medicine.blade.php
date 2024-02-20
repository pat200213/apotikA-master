@extends('layout.conquer')

@section('javascript')
  <script>
    function show(id)
      {
        $.ajax({
          type:'POST',
          url:'{{route("transaction.history")}}',
          data:{'_token':'<?php echo csrf_token() ?>',
            'myid':id
          },
          success: function(data){
            $('#modalContent').html(data.msg)
          }
        });
      }
  </script>
@endsection

@section('content')

<div class="container" style='width: 100%; cellspacing:0;'>
  <h2>List Expensive Medicines</h2>

  <table class="table">
    <thead>
      <tr>
        <th>Medicine Name</th>
        <th>Category</th>
        <th>Price (IDR)</th>
      </tr>
    </thead>
    <tbody>
    @foreach($result as $d)
      <tr>
        <td>{{$d['medicines_name']}}</td>
        <td>{{$d['category_name']}}</td>
        <td>Rp {{$d['price']}}</td>
      </tr>
    
    @endforeach
 
    </tbody>
  </table>
<br>
  <h2>Most Selling Medicine</h2>

  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Category Name</th>
        <th>Medicine Name</th>
        <th>Total Purchase</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$mpc)
      <tr>
        <td>{{ ($key+1) }}</td>
        <td>{{$mpc->category->category_name}}</td>
        <td>{{$mpc->name}}</td>
        <td>{{ $mpc->total }}</td>
        <td><a href="#historyModal" class="btn btn-sm btn-info" data-toggle="modal" onclick="show({{ $mpc->id }})">History Purchase</a></td>
    </tr>
    @endforeach
 
    <div class="modal fade" id="historyModal" tabindex="-1" role="basic" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" id='modalContent'>
          
        </div>
      </div>
    </div>

    </tbody>
  </table>
</div>
@endsection