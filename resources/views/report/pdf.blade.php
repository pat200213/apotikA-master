<!DOCTYPE html>
<html>
<head>
    <title>Sales Report Drugstore</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style type="text/css">
    h2{
        text-align: center;
        font-size:22px;
        margin-bottom:50px;
    }
    body{
        background:#f2f2f2;
    }
    .section{
        margin-top:30px;
        padding:50px;
        background:#fff;
    }
    .pdf-btn{
        margin-top:30px;
    }
</style>
<body>
    <div class="container">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">Customer</th>
                    <th style="width:22%" class="text-center">Date</th>
                    <th style="width:50%">Medicine</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                </tr>
            </thead>

            <tbody>

                @foreach($data as $d)
                
                    <tr>
                        <td>{{ $d->customer }}</td>
                        <td>{{ $d->transaction_date }}</td>
                        <td>{{ $d->product }}</td>
                        <td>{{ $d->amount }}</td>
                        <td>Rp {{ number_format($d->sub_total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                
            </tbody>

            <tfoot>
                <tr class="visible-xs">
                
                    <td class="text-center" colspan="5"><strong>Total Data: {{ count($data) }}</strong></td>

                </tr>
        
            </tfoot>
        </table>
    </div>
  
</body>
</html>