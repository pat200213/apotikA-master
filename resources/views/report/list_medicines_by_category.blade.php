<h2>List Medicines by Category</h2>
  <p>ID Category : {{$id_category}} with name : {{$nameCategory}}</p>
  <hr>
  <p>Total Rows : {{$getTotalData}}</p>

<table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Medicine Form</th>
        <th>Formula</th>
        <th>Photo</th>
        <th>Price (IDR)</th>
      </tr>
    </thead>
    <tbody>
      @foreach($result as $d)
      <tr>
        <td>{{$d->name}}</td>
        <td>{{$d->form}}</td>
        <td>{{$d->restriction_formula}}</td>
        <td>
          <img src="{{asset('assets/images/'.$d->image) }}"
           height="100px" />
        </td>
        <td>{{$d->price}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
