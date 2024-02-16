@extends('layout.conquer')

@section('javascript')
<script>
  function getdetaildata(id, date, customer)
  {
    
    $.ajax({
      type:'POST',
      url:'{{route("transaction.showAjax")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'myid':id,
        'mydate':date,
        'mycustomer':customer
      },
      success: function(data){
       
        $('#msg').html(data.msg)
      }
    });
  }
</script>
@endsection

@section('content')
<div class="container" style='width: 100%; cellspacing:0;'>
    <div class="row align-items-center justify-content-between">
        <h2>List My Transactions</h2>

    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Buyer Name</th>
                <th>Date</th>
                <th>Total Price (IDR)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $d)
                <tr>
                    <td>{{$d->name}}</td>
                    <td>{{$d->buyer->name}}</td>
                    <td>{{$d->transaction_date}}</td>
                    <td>{{$d->sub_total}}</td>
                    <td>
                        <a class='btn btn-sm btn-info' data-toggle='modal' data-target='#basic'
                            onclick="getdetaildata('{{$d->medicine_id}}', '{{$d->transaction_date}}', '{{$d->customer_id}}')">More Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="msg">
      

    </div>
  </div>
</div>

@endsection
  