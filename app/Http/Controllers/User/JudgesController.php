<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Judges;
use Illuminate\Http\Request;
use Auth;
class JudgesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type == "Court")
        {
            return view('court.judge.index');
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
        Judges::create($request->all());
        toastr()->success('Judge Created Successfully');
        return redirect()->route('user.judge.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function show(Judges $judges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $judge = Judges::find($id);
        if(Auth::user()->type == "Police Station")
        {
            return view('court.judge.edit',compact('judge'));
        }
        toastr()->warning('Unauthorized');
        return redirect()->route('user.dashboard.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Judges $judges)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function destroy(Judges $judges)
    {
        //
    }
}
