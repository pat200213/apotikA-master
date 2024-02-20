<?php

namespace App\Http\Controllers;

use DB;
use App\Medicine;
use App\Category;
use App\Supplier;
use Illuminate\Http\Request;
use App\Transaction;
use Carbon\Carbon;
use Auth;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query raw
        // $result = DB::select(DB::raw('select * from medicines'));
        // dd($result);
//query builder
        $result = DB::table('medicines')->get();
        $sup = Supplier::all();
        $cat = Category::all();
        // dd($result);
//query orm
        // $result = Medicine::all();
        // dd($result);

        return view('medicine.index', compact('result', 'sup', 'cat'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        $sup = Supplier::all();
        
        return view("medicine.create", compact('data','sup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'form' => 'required',
            'formula' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'stock' => 'required'
        ]);

        $data = new Medicine();
        $data->name = $request->get('name');
        $data->form = $request->get('form');
        $data->restriction_formula = $request->get('formula');
        $data->description = $request->get('description');
        $data->price = $request->get('price');
        
        $image= $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move('assets/images',$imageName);

        $data->image = $imageName;

        $data->faskes1 = isset($request->faskes1) ? 1:0;
        $data->faskes2 = isset($request->faskes2) ? 1:0;
        $data->faskes3 = isset($request->faskes3) ? 1:0;
        $data->category_id = $request->kategori;
        $data->supplier_id = $request->supplier;
        $data->stock = $request->stock;

        $data->save();

        return redirect()->route("medicines.index")->with("status", "Medicine is added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        $data = $medicine;
        return view('medicine.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        $cat = Category::all();
        $sup = Supplier::all();

        $data = $medicine;

        return view('medicine.edit', compact('data','sup','cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        $medicine->name = $request->name;
        $medicine->form = $request->form;
        $medicine->restriction_formula = $request->formula;
        $medicine->description = $request->description;

        $medicine->price = $request->price;
       
        $image= $request->file('image');

        if(isset($image)){
            $imageName = $image->getClientOriginalName();
            $image->move('assets/images',$imageName);

            $medicine->image = $imageName;
        }
       
        $medicine->faskes1 = isset($request->faskes1) ? 1:0;
        $medicine->faskes2 = isset($request->faskes2) ? 1:0;
        $medicine->faskes3 = isset($request->faskes3) ? 1:0;
        $medicine->category_id = $request->kategori;
        $medicine->supplier_id = $request->supplier;
        $medicine->stock= $request->stock;

        $medicine->save();

        return redirect()->route("medicines.index")->with("status", "Medicine is changed!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        $this->authorize('delete-permission-medicines', $medicine);

        try{
            $medicine->delete();
            return redirect()->route("medicines.index")->with("status", "Data medicine is deleted!");

        }
        catch(\PDOException $e){
            $msg = "Failed to delete. Make sure data child has been deleted or foreign key not connected";
            return redirect()->route('medicines.index')->with('error', $msg);
        }
    }

    public function coba1()
    {
        //query builder filter
        // $result = DB::table('medicines')
        //                 ->where('name','like','%fen%')
        //                 ->get();

        // $result = DB::table('medicines')
        //             ->select('name, count(distinct(name)) as jumlah')
        //             ->groupBy('name')
        //             ->having('jumlah','>','1')
        //             ->get();

        // $result=DB::table('medicines')->count();

        // $result=DB::table('medicines') 
        //             ->where('price','<',20000)
        //             ->count();

        // $result=DB::table('medicines') 
        //         ->rightJoin('categories','medicines.category_id','=','categories.id')
        //         ->orderBy('price','desc')
        //         ->get();
        


        // $result=Medicine::where('price','>',20000)  
        //         ->orderBy('price','desc')
        //         ->get();
    
        // $result=Medicine::find(3);

        // $result=Medicine::max('price');

        dd($result);
    }

    public function showMaxMedicine()
    {               
        $medicine_per_category = Category::all();

        $result = Medicine::showExpensiveMedicine($medicine_per_category);

        $data = Medicine::join('transactions as t', 'medicines.id', '=', 't.medicine_id')
                            ->where('t.status', 1)
                            ->groupBy('t.medicine_id')
                            ->select('medicines.*',DB::raw('sum(t.amount) as total'))
                            ->orderBy('total', 'DESC')
                            ->take(5)
                            ->get();
        
        return view('report.list_expensive_medicine', compact('result', 'medicine_per_category', 'data'));
    
    }

    public function showInfo()
    {
        $result=Medicine::orderBy('price','desc')->first();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>"<div class='alert alert-danger'>
                     Did you know? <br>
                     The most expensive medicine in our store is ".
                     $result->generic_name . " ".$result->form . 
                     " for around Rp " . $result->price
          ),200); 
    }

    public function getEditForm(Request $request)
    {
        $id = $request->myid;
        $data = Medicine::find($id);
        $cat = Category::all();
        $sup = Supplier::all();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('medicine.getEditForm', compact('data','cat','sup'))->render() 
        ), 200);
    }

    public function getEditForm2(Request $request)
    {
        $id = $request->myid;
        $data = Medicine::find($id);
        $cat = Category::all();
        $sup = Supplier::all();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('medicine.getEditForm2', compact('data','sup','cat'))->render() 
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->myid;
        $data = Medicine::find($id);

        $data->name = $request->myname;
        $data->form = $request->myform;
        $data->restriction_formula = $request->myformula;
        $data->description = $request->mydesk;
        $data->price = $request->myharga;

        $image= $request->myfoto;
      
        if($image != null){
           
            $data->image = $image;
        }

        $data->faskes1 = $request->myfaskes1;
        $data->faskes2 = $request->myfaskes2;
        $data->faskes3 = $request->myfaskes3;
        $data->category_id = $request->mycategory;
        $data->idSupplier = $request->mysup;

        $data->save();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>'Medicine updated',
            'kat'=>$data->category->category_name,
            'img'=>$data->image
            
        ), 200);
    }

    public function deleteData(Request $request)
    {
        try{
            $id = $request->myid;
            $medicine = Medicine::find($id);

            $medicine->delete();

            return response()->json(array(
                'status'=>'oke',
                'msg'=>'Data medicine is deleted!'
            ), 200);

        }
        catch(\PDOException $e){
            $msg = "Failed to delete. Make sure data child has been deleted or foreign key not connected";

            return response()->json(array(
                'status'=>'oke',
                'msg'=>$msg
            ), 200);

        }
    }

    public function cart(){
        $customer = Auth::user()->id;

        $list_of_cart = Transaction::join('medicines as m', 'm.id', '=', 'transactions.medicine_id')
                            ->join('categories as c', 'c.id', '=', 'm.category_id')
                            ->where('customer_id', $customer)
                            ->where('status', 0) 
                            ->select('transactions.medicine_id', 'transactions.customer_id', 'transactions.amount', 'transactions.sub_total', 'm.name', 'c.category_name', 'm.image')
                            ->get();   

        return view('fronted.cart', compact('list_of_cart'));
    }

    public function addToCart(Request $request){
        if(Auth::user()->roles != "customer"){
           
            return redirect()->route('dashboard')->with('error','Sorry, you\'re not supposing to buy this medicine.');
        }        

        $medicine = Medicine::find($request->id);
        $customer = Auth::user()->id;
        $today = Carbon::now()->format('Y-m-d');
      
        $cart = Transaction::where('medicine_id', $medicine->id)
                    ->where('customer_id', $customer)
                    ->where('status', 0) 
                    ->first();   

        if(!$cart){
            $data = [
                "customer_id"=>$customer,
                "medicine_id"=>$medicine->id,
                "amount"=>1,
                "sub_total"=>$medicine->price,
                "transaction_date"=>Carbon::now(),
                "status"=>0
            ];

            Transaction::insert($data);
        }
        else{
            $quantity = $cart->amount + 1;
            $sub_total = $cart->sub_total * $quantity;

            Transaction::where('customer_id', $customer)
                        ->where('medicine_id', $medicine->id)
                        ->where('status', 0)
                        ->update(['amount'=>$quantity, 'sub_total'=>$sub_total]);
        }

        return redirect()->route('medicine_cart');
    }
}
