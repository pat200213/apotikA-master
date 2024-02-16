<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list_medicines = Medicine::all();
        return view('home', compact('list_medicines'));
    }

    public function dashboard()
    {
        return view('welcome');
    }

    public function medicineDetail(Request $request)
    {
        $id = $request->myid;
        $data = Medicine::find($id);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('medicine.show', compact('data'))->render() 
        ), 200);
    }
}
