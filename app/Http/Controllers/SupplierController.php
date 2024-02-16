<?php

namespace App\Http\Controllers;

use DB;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::all();

        return view("supplier.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("supplier.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Supplier();
        $data->name = $request->nama;
        $data->address = $request->alamat;
        // $data->name = $request->get('nama');
        // $data->address = $request->get('alamat');
        $data->save();

        return redirect()->route("supplier.index")->with("status", "Supplier is added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //dd($supplier);
        $data = $supplier;
        return view('supplier.edit', compact('data'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->name = $request->nama;
        $supplier->address = $request->alamat;
        $supplier->save();

        return redirect()->route("supplier.index")->with("status", "Supplier is changed!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $this->authorize('delete-permission', $supplier);

        try{
            $supplier->delete();
            return redirect()->route("supplier.index")->with("status", "Data supplier is deleted!");

        }
        catch(\PDOException $e){
            $msg = "Failed to delete. Make sure data child has been deleted or foreign key not connected";
            return redirect()->route('supplier.index')->with('error', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->myid;
        $data = Supplier::find($id);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('supplier.getEditForm', compact('data'))->render() 
        ), 200);
    }

    public function getEditForm2(Request $request)
    {
        $id = $request->myid;
        $data = Supplier::find($id);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('supplier.getEditForm2', compact('data'))->render() 
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->myid;
        $data = Supplier::find($id);

        $data->name = $request->myname;
        $data->address = $request->myaddress;

        $data->save();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>'Supplier updated'
        ), 200);
    }

    public function deleteData(Request $request)
    {
        try{
            $id = $request->myid;
            $supplier = Supplier::find($id);

            $supplier->delete();

            return response()->json(array(
                'status'=>'oke',
                'msg'=>'Data supplier is deleted!'
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
}
