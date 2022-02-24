<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FIR;
use Illuminate\Http\Request;
use Auth;

class FIRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type == "Police Station")
        {
            return view('user.fir.index');
        }
        toastr()->warning('Unauthorized');
        return redirect()->route('user.dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type == "Police Station")
        {
            return view('user.fir.create');
        }
        toastr()->warning('Unauthorized');
        return redirect()->route('user.dashboard.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FIR::create($request->all());
        toastr()->success('FIR is Created Successfully');
        return redirect()->route('user.fir.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FIR  $fIR
     * @return \Illuminate\Http\Response
     */
    public function show(FIR $fIR)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FIR  $fIR
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fir = FIR::find($id);
        if(Auth::user()->type == "Police Station")
        {
            return view('user.fir.edit',compact('fir'));
        }
        toastr()->warning('Unauthorized');
        return redirect()->route('user.dashboard.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FIR  $fIR
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FIR $fIR)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FIR  $fIR
     * @return \Illuminate\Http\Response
     */
    public function destroy(FIR $fIR)
    {
        //
    }
}
