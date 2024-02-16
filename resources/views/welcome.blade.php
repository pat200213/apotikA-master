@extends('layout.conquer')

@section('javascript')
    <script>
        function showInfo()
        {
            $.ajax({
                type:'POST',
                url:'{{route("medicines.showInfo")}}',
                data:'_token=<?php echo csrf_token() ?>',
                success: function(data){
                    $('#showinfo').html(data.msg)
                }
            });
        }


    </script>
@endsection


@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
  
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
             
                <a href="#">Dashboard</a>
               
            </li>
            <li>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" onclick="showInfo()">
                <i class="icon-bulb"></a></i>
            </li>
        </ul>

        <div class="page-toolbar">
			<!-- tempat action button -->
            <button class="btn btn-warning" data-toggle="modal" href='#disclaimer'>Discalimer</button>

            <a href="{{url('supplier/create')}}" class="btn btn-info" type="button">+ Supplier</a>
            
            <a href="{{url('medicines/create')}}" class="btn btn-info" type="button">+ Medicine</a>

            <a data-toggle="modal" href='#category' class="btn btn-info" type="button">+ Category</a>

		</div>
    </div>
    
    <div id='showinfo'></div>

    <div class="content">

        <div class="title m-b-md">
            <h3 class="page-title">Welcome To Drugstore System</h3>
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">Docs</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://blog.laravel.com">Blog</a>
            <a href="https://nova.laravel.com">Nova</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://vapor.laravel.com">Vapor</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>

    
    <div class="modal fade" id="disclaimer" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">DISCLAIMER</h4>
                    </div>
                    <div class="modal-body">
                    Pictures shown are for illustration purpose only. Actual product may vary due to product enhancement. 
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="category" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{url('categories')}}">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Add New Categories</h4>
                        </div>
                    
                        <div class="modal-body">
                                
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name='name' class="form-control input-lg" placeholder="Enter Text">
                            </div>
            
                        </div>
                    
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

@endsection