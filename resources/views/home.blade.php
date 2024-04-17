@extends('layouts.app')

@section('javascript')
    <script>
        function showMedicineDetail(id){
            $.ajax({
                type:'POST',
                url:'{{route("home.getMedicineDetail")}}',
                data:{'_token':'<?php echo csrf_token() ?>',
                    'myid':id
                    },
                success: function(data){
                    // $('#modalDetail').toggleClass('fade');
                    $('#modalContent').html(data.msg);
                }
            });
        }
    </script>

@endsection

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="row justify-content-center">
        @foreach($list_medicines as $data)
            <div class="col-md-4 mb-3">
                <div class="card h-100" data-target="#modalDetail_{{$data->id}}" data-toggle="modal">
                    <div class="card-header pb-0">
                        <h3>{{ $data->name }}</h3>
                        <p class="text-muted small">{{ $data->category->category_name}}</p>
                    </div>

                    <div class="card-body">
                        <img src="{{ asset('assets/images/'.$data->image) }}" class="rounded" width="100%" height="200px">

                        <p class="text-muted">{{ $data->description }}</p>
                      
                    </div>

                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                        <span class="text-primary font-weight-bold">Rp {{ number_format($data->price, 2, ',', '.') }}</span>
                        <span class="font-weight-bold {{ $data->stock == 0 ? 'text-muted':'' }}">Stock: {{ $data->stock }}</span>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalDetail_{{$data->id}}" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id='modalContent'>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Medicine Info</th>
                                    <th></th>
                                    <th><a href="{{ route('add_medicine_to_cart', ['id'=>$data->id]) }}" class="btn btn-sm btn-outline-secondary" style="{{ $data->stock == 0 ? 'pointer-events: none;':'' }}">Add To Cart</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Generic Name </td>
                                    <td id='td_name'>{{$data->name}}</td>
                                </tr>
                                <tr>
                                    <td>Form</td>
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
                                    <td>Price</td>
                                    <td id='td_harga'>Rp {{ number_format($data->price, 2, ',', '.')}}</td>
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
                </div>
            </div>
        @endforeach
        
    </div>
</div>
@endsection
