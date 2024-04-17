@extends('layouts.app')

@section('title', 'Cart')

@section('javascript')
    <script>
        var i = setInterval(function() {
            
            $("main").load(location.href + " main");
         
        }, 5000);

        function updateCounter(set,id){
          
            $.ajax({
                type:'POST',
                url:'{{route("transaction.changeAmount")}}',
                data:{'_token':'<?php echo csrf_token() ?>',
                    'myid':id,
                    'trigger':set
                },
                success: function(data){
                    $('#counter_'+id).html(data.value);
                    
                    // $("#sub_total_"+id).html('Rp '+data.price);

                    if($('#counter_'+id).html() > 0){
                        $("#btn_decrease_"+id).attr('disabled', false);
                    }
                    else{
                        $("#btn_decrease_"+id).attr('disabled', true);
                    }

                   
                }
            });
        }

        function deleteItems(id){
          
          $.ajax({
              type:'POST',
              url:'{{route("transaction.deleteItems")}}',
              data:{'_token':'<?php echo csrf_token() ?>',
                  'myid':id,
        
              },
              success: function(data){
                  $('#box_'+id).css('display','none');

                 
              }
          });
      }
    </script>
@endsection

@section('content')
<div class="container">
    <div class="card p-3">
        <div class="row">
            <div class="col-md-8">
                
                <div class="d-flex justify-content-between align-items-center">
                    <h4><b>Medicine Cart</b></h4>
                    <div class="text-muted">{{ count($list_of_cart) }} items</div>
                </div>
                    
                <div class="row p-3">
                    @php
                        $total = 0;
                    @endphp

                    @if($list_of_cart->isNotEmpty())
                        @foreach($list_of_cart as $cart)
                            <div class="row border-top align-items-center" id="box_{{$cart->medicine_id}}">
                                <div class="col-sm-3">
                                    <img class="img-fluid" src="{{ asset('assets/images/'.$cart->image) }}">
                                </div>
                                <div class="col-sm-3">
                                    <div class="row small text-muted">{{$cart->category_name}}</div>
                                    <div class="row">{{ $cart->name }}</div>
                                </div>
                                <div class="col-sm-3">
                                    <button id="btn_decrease_{{$cart->medicine_id}}" class="btn btn-default" onclick="updateCounter('decrease', '{{$cart->medicine_id}}')" {{$cart->amount == 0 ? 'disabled':''}}>-</button>
                                    <span class="border p-2" id="counter_{{$cart->medicine_id}}">{{ $cart->amount }}</span>
                                    <button class="btn btn-default" onclick="updateCounter('increase','{{$cart->medicine_id}}')">+</button>
                                </div>
                                <div id="sub_total_{{$cart->medicine_id}}" class="col-sm-3">
                                    Rp {{ number_format($cart->sub_total, 0, ',', '.') }} 
                                    <button class="btn btn-danger btn-sm ml-2" onclick="deleteItems({{$cart->medicine_id}})">&times;</button>
                                </div>
                            </div>
        
                            @php
                                $total += $cart->sub_total;
                            @endphp
                        @endforeach
                    
                    @else
                        <p class="text-muted">No Medicine Added!</p>
                    @endif
                </div>
            
            </div>

            <div class="col-md-4">
                <h5><b>Summary</b></h5>
                <hr>
                <div class="row px-3 py-2 mb-0">
                    <div class="col" style="padding-left:0;">Sub Total</div>
                    <div class="col text-right">Rp {{ number_format($total, 0, ',', '.')}}</div>
                </div>

                <div class="row px-3 py-2 small text-muted mb-0">
                    <div class="col" style="padding-left:0;">Delivery Cost</div>
                    <div class="col text-right">Rp {{number_format(0, 0, ',', '.')}}</div>
                </div>

                <div class="row px-3 py-2 small text-muted">
                    <div class="col" style="padding-left:0;">TAX</div>
                    <div class="col text-right">Rp {{number_format(0, 0, ',', '.')}}</div>
                </div>
                <hr>
                <div class="row mb-3 px-3" >
                    <div class="col pl-0">TOTAL PRICE</div>
                    <div class="col text-right">Rp {{ number_format($total, 0, ',', '.')}}</div>
                </div>

            </div>

            <div class="d-flex col-md-12 align-items-center justify-content-between">
                <div class="col-md-8">
                    <a href="{{ route('home') }}">
                        &leftarrow;
                        <span class="text-muted">Back to Dashboard</span>
                    </a>

                </div>
              
                <div class="col-md-4 mx-auto">
                    <a class="btn btn-dark btn-block" href="{{ route('submitcheckout') }}">CHECK OUT</a>
                </div>
              
            </div>
        </div>
        
    </div>
</div>
    
@endsection