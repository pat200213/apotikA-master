<?php

namespace App\Http\Controllers;

use DB;
use App\Transaction;
use Illuminate\Http\Request;
use Auth;
use App\Medicine;
use PDF;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Transaction::join('medicines as m', 'm.id', '=', 'transactions.medicine_id')
                            ->where('transactions.customer_id', Auth::user()->id)
                            ->get();

        return view('transaction.index', ['data'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
    
    public function previewTransaction(){
        $result = Transaction::join('medicines as m', 'm.id', '=', 'transactions.medicine_id')->get();

        return view('transaction.admin', compact('result'));
    }

    public function updateAmount(Request $request)
    {
        $id = $request->myid;

        $price = Medicine::where('id', $id)->first()->price;

        $amount = Transaction::where('medicine_id', $id)
                    ->where('status', 0)
                    ->where('customer_id', Auth::user()->id)
                    ->first()->amount;

        if($request->trigger == 'increase'){
            $amount = (int)$amount + 1;
        }
        else{
            $amount = (int)$amount - 1;
        }

        $total = $price * $amount;

        Transaction::where('medicine_id', $id)
                        ->where('status', 0)
                        ->where('customer_id', Auth::user()->id)
                        ->update(['amount'=>$amount, 'sub_total'=>$total]);
       
        return response()->json(array(
            'status'=>'oke',
            'price'=>$total,
            'value'=>$amount
        ),200);

    }

    public function deleteMedicine(Request $request)
    {
        $id = $request->myid;
        Transaction::where('medicine_id', $id)
                    ->where('status', 0)
                    ->where('customer_id', Auth::user()->id)
                    ->delete();
        
        return response()->json(array(
            'status'=>'oke',
        ),200);

    }

    public function submit_cart(){
        $customer = Auth::user()->id;
        
        $data = Transaction::where('customer_id', $customer)
                    ->where('status', 0)
                    ->get();

        foreach($data as $d){
            
            $old_stock = Medicine::find($d->medicine_id)->first()->stock;
            $decrease_stock = $d->amount;
            $new_stock = (int)$old_stock - $decrease_stock;
           
            Medicine::where('id',$d->medicine_id)->update(['stock'=> $new_stock]);
        }
      
        Transaction::where('customer_id', $customer)
                    ->update(['status'=>1]);

        return redirect()->route('home')->with('success','Medicines have successfully ordered!');
    }

    public function showAjax(Request $request){
        $id = $request->myid;
        $date = date('Y-m-d', strtotime($request->mydate));

        if(!$request->mycustomer){
            $customer = Auth::user()->id;
        }
        else{
            $customer = $request->mycustomer;
        }

        $data = Transaction::join('medicines as m','m.id','=','transactions.medicine_id')
                ->join('categories as c', 'c.id', '=', 'm.category_id')
                ->where('transactions.medicine_id', $id)
                ->whereDate('transactions.transaction_date', $date)
                ->where('transactions.customer_id', $customer)
                // ->select('transactions.*', 'm.*')
                ->first();
        
        return response()->json(array(
            'status'=>'oke',
            
            'msg'=>view('transaction.showmodal',compact('data'))->render()
        ),200);
    }

    public function showHistoryMedicine(Request $request){
        $medicine = Medicine::find($request->myid);

        $data = Transaction::where('medicine_id', $request->myid)
                                ->where('status', 1)
                                ->get();
        
        return response()->json(array(
            'status'=>'oke',
            
            'msg'=>view('report.history_purchase',compact('data', 'medicine'))->render()
        ),200);
    }

    public function exportToPdf()
    {
        $result = Transaction::join('medicines as m', 'm.id', '=', 'transactions.medicine_id')
                    ->join('users as u', 'customer_id', '=', 'u.id')
                    ->select("u.name as customer", "transactions.*", "m.name as product")
                    ->get();
 
        $pdf = PDF::loadView('report.pdf', ['data'=>$result] );
        
        return $pdf->download('sales_report_drugstore.pdf');
    }
}
