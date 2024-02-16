@extends('layouts.app')

@section('javascript')
<script>
  function getdetaildata(id, date)
  {
    
    $.ajax({
      type:'POST',
      url:'{{route("transaction.showAjax")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id,
        'mydate':date
      },
      success: function(data){
       
        $('#msg').html(data.msg)
      }
    });
  }
</script>
@endsection

@section('content')
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <h2>List My Transactions</h2>

      <a href="{{ route('home') }}">
          &leftarrow;
          <span class="text-muted">Back to Dashboard</span>
      </a>
    </div>

  <table class="table">
    <thead>
      <tr>
        <th>Medicine Name</th>
        <th>Date</th>
        <th>Total Price (IDR)</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
      <tr>
        <td>{{$d->name}}</td>
        <td>{{$d->transaction_date}}</td>
        <td>{{$d->sub_total}}</td>
        <td>
            <a class='btn btn-outline-secondary' data-toggle='modal' data-target='#basic'
                onclick="getdetaildata('{{$d->medicine_id}}', '{{$d->transaction_date}}')">More Detail</a>
        </td>
      </tr>
        @endforeach
    </tbody>
  </table>
</div>


<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-wide">
    <div class="modal-content" id="msg">
      

    </div>
  </div>
</div>

@endsection
  