@extends('layout.conquer')

@section('content')

<div class="container" style='width: 100%; cellspacing:0;'>
  <h2>List Expensive Medicines</h2>

  <table class="table">
    <thead>
      <tr>
        <th>Information</th>
        <th>Result</th>
      </tr>
    </thead>
    <tbody>
    @foreach($result as $d)
      <tr>
        <td>Medicine Name</td>
        <td>{{$d->name}}</td>
      </tr>
    <tr>
        <td>Category</td>
        <td>{{$d->category_name}}</td>
    </tr>
    <tr>
        <td>Price (IDR)</td>
        <td>{{$d->total}}</td>
    </tr>
    
    @endforeach
 
    </tbody>
  </table>
<br>
  <h2>List Medicine each Category</h2>

  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Category Name</th>
        <th>Total Medicines</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($medicine_per_category as $key=>$mpc)
      <tr>
        <td>{{ ($key+1) }}</td>
        <td>{{$mpc->category_name}}</td>
        <td>{{ $mpc->medicines()->count() }}</td>
        <td><a href="{{ url('report/listmedicine/'.$mpc->id) }}" class="btn btn-sm btn-info">Print</a></td>
    </tr>
    
    @endforeach
 
    </tbody>
  </table>
</div>
@endsection