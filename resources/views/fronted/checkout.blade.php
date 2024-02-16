@extends('layouts.frontend')

@section('title', 'Cart')

@section('content')

    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        @if(session('cart'))
        <?php 
            $jum=0;
            $tot=0;  
        ?>
            
        @foreach(session('cart') as $id=>$details)
        <?php 
            $jum+=$details['quantity'];
            $tot+=$details['quantity']*$details['price'];  
        ?>
        <tr>

            <td data-th="Product">
                <div class="row">
                    <div class="col-sm-3 hidden-xs"><img height='50px' src="{{asset('assets/images/'.$details['photo'])}}" alt="..." class="img-responsive"/></div>
                    <div class="col-sm-9">
                        <h4 class="nomargin">{{$details['name']}}</h4>
                     </div>
                </div>
            </td>
            <td data-th="Price">{{$details['price']}}</td>
            <td data-th="Quantity">
                    {{$details['quantity']}}
            </td>
            <td data-th="Subtotal" class="text-center">{{$details['price']*$details['quantity']}}</td>
        </tr>
        @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
             
            <td class="hidden-xs"><a href="{{ route('submitcheckout') }}" class="btn btn-danger"><i class="fa fa-angle-right"></i> finish</a></td>
           
            <td colspan='1' style="text-align:right">Total : </td>
          
            <td class="text-center"><strong>{{$tot}}</strong></td>

        </tr>
       
        </tfoot>
    </table>

@endsection