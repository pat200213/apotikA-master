<?php

namespace App\Http\Controllers;

use DB;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$result = DB::table('categories')->get();
       
         $result = Category::all();

        return view('category.index',compact('result'));
        
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
        $data = [
            'category_name'=>$request->name,
        ];

        Category::insert($data);

        return redirect()->route('dashboard')->with('success','Category has successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showlist($id_category)
    {
        $data = Category::find($id_category);
        $nameCategory = $data->category_name;
        $result = $data->medicines;
        
        if($result) $getTotalData = $result->count();
        else $getTotalData = 0;
        
        return view('report.list_medicines_by_category', compact('id_category', 'nameCategory', 'result', 'getTotalData'));
    
    }
    
    public function showProducts()
    {
        $cat=Category::find($_POST['category_id']);
        $nama=$cat->category_name;
        $data=$cat->medicines;
        return response()->json(array(
            'status'=>'oke',
            
            'msg'=>view('category.showProducts',compact('nama','data'))->render()
        ),200);

    }

}

