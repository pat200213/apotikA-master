<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">History Purchase {{$medicine->name}}</h4>
    <span class="small">{{$medicine->category->category_name}}</span>
</div>

<div class="modal-body">
<table class="table">
    <thead>
      <tr>
        <th>Amount</th>
        <th>Total Price (IDR)</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
            <tr>
                <td id='td_name'>{{$d->amount}}</td>
                <td id='td_name'>{{$d->sub_total}}</td>
                <td id='td_name'>{{ date('d-M-y H:i', strtotime($d->transaction_date)) }}</td>
            </tr>
        @endforeach
  
    </tbody>
  </table>
</div>

<div class="modal-footer">
     
    <button type="button" class="btn btn-default" data-dismiss='modal'>Cancel</button>
</div>