@extends('layout.conquer')

@section('javascript')
<script>
  function showProducts(category_id)
  {
    $.ajax({
      type:'POST',
      url:'{{route("category.showProducts")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
        'category_id':category_id
      },
      success: function(data){
        $('#showproducts').html(data.msg)
      }
    });
  }
</script>
@endsection


  <!-- <style type='text/css'>
        .container{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 3rem;
            margin-top: 30px;
        }
        .card{
            background: #ccc;
            min-height: 270px;
            padding: 1rem;
            border-radius: 20px;
            text-decoration: none;
            margin-bottom: 20px;
        }
        .card h4{
            margin-top: 8px;
            margin-bottom: 0;
            letter-spacing: 1.5px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 18px;
        }
        h4, h6{
            font-family: inherit;
            color: #0c0c0c;
            font-weight: 500;
        }
        .card h6{
            font-size: 14px;
            margin-top: 10px;
        }
       p{
           text-align: center;
       }
  </style> -->

@section('content')
<!-- <div class="container">
  @foreach($result as $d)
  <div class="card">
        <h4>{{$d->category_name}}</h4>
        <h6>{{$d->descriptions}}</h6>
        <p>Contoh Obat:</p>
        <div>
       
            @foreach($d->medicines as $m)
                {{$m->name}} 
                <ul>
                    <li>Form : {{$m->form}}</li>
                    <li>Price : {{$m->price}}</li>
                </ul>

            @endforeach
        
        </div>
    </div>
   @endforeach
</div> -->

<div class="container" style='width: 100%; cellspacing:0;'>
  <h2>List Medicine's Categories</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Categories</th>
        <th>List Medicines</th>
     
      </tr>
    </thead>
    <tbody>
    @php($num =1)
    @foreach($result as $d)
      <tr>
        <td>{{$d->category_name}}</td>
        <td>
            <a class='btn btn-xs btn-info' data-toggle='modal' data-target='#myModal'
                  onclick="showProducts({{$d->id}})">
              Detail
            </a>
        </td>
      
        @php($num =1)
              
        </tr>
    @endforeach

    </tbody>
  </table>
@endsection

<div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-wide">
    <div class="modal-content" id="showproducts">
      

    </div>
  </div>
</div>