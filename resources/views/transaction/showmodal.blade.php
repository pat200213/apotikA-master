<div class="modal-header">
  
    <h4 class="modal-title">Transaction of {{$data->name}} - {{$data->transaction_date}}</h4>
</div>
    <div class="modal-body">
      
            <table class="table">
               <thead>
                    <tr>
                        <th>Info</th>
                        <th>Detail</th>
                    </tr>
                  
               </thead>
                <tbody>
                    
                    <tr>
                        <td>Medicine</td>
                        <td>
                            <!-- <div class='col-md-4' style='width:100%;border:1px solid #eee;text-align:center'> -->
                                <img src="{{asset('assets/images/'.$data->image)}}" width="150px" height="150px"/></a><br>
                                <p class="font-weight-bold">{{$data->name}}</p>   
                                <span class="text-muted small">{{$data->category_name}}</span>
                            <!-- </div> -->
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>

                            <span>{{$data->amount}} pcs</span>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Sub Total</td>
                        <td>
                            
                            <span>Rp {{$data->sub_total}}</span>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
       

    </div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>