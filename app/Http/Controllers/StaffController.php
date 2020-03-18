<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use App\User;

class StaffController extends Controller
{
    private $star;

    public function __construct(){
        $this->star='staff';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs=User::where('type','staff')->get();
        $star=$this->star;
        return view('back.staff', compact('staffs', 'star'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $star=$this->star;
        return view('back.staff-manage', compact('star'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $staff=new User($request->all());
        $staff->type='staff';
        $staff->password=Hash::make($request->password);
        $staff->save();
        return redirect()->route('staff.index')->with('status','Successfully created.');
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
        $staff=User::FindOrFail($id);
        $star=$this->star;
        return view('back.staff-manage', compact('staff', 'star'));
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
        $staff=User::FindOrFail($id);
        $staff->name=$request->name;
        $staff->email=$request->email;
        $staff->password=Hash::make($request->password);
        $staff->save();
        return redirect()->route('staff.index')->with('status','Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('status','Successfully deleted.');
    }
}
