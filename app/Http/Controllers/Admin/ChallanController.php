<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Challan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChallanController extends Controller
{
    private $months;
    private $timeFormat;
    private $DateFormat;

    public function __construct() {
        $this->months = [
                "January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"
        ];

        $this->timeFormat = 'Y-m-d H:i:s';
        $this->DateFormat = 'Y-m-d';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::whereYear('dated',$request->dated)
                        ->where('fir',$request->fir)
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }else{
            $challans = Challan::all();
        }
        return view('admin.challan.index',compact('challans','data','years'));
    }
    public function pendingChallan(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::where('challan_prepare_within_14_days',1)
                        ->whereYear('dated',$request->dated)
                        ->orWhere('fir',$request->fir)
                        ->where('challan_receive_in_branch',0)
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }
        else{
            $challans = Challan::where('challan_prepare_within_14_days',1)
            ->where('challan_receive_in_branch',0)->get();
        }
        return view('admin.challan.pending',compact('challans','data','years'));
    }
    public function pendingChallanByCourt(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::whereNull('date_of_receiving_challan_in_court')
                        ->whereYear('dated',$request->dated)
                        ->orWhere('fir',$request->fir)
                        ->whereNotNull('challan_passed_date')
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }else{
            $challans = Challan::whereNull('date_of_receiving_challan_in_court')
            ->whereNotNull('challan_passed_date')->get();
        }
        return view('admin.challan.pending_by_court',compact('challans','data','years'));
    }
    public function pendingChallanByProsecution(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::where('file_send_after_3_days',1)
                        ->whereYear('dated',$request->dated)
                        ->orWhere('fir',$request->fir)
                        ->whereNull('challan_passed_date')->whereNull('objection_date')
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }else{
            $challans = Challan::where('file_send_after_3_days',1)
            ->whereNull('challan_passed_date')->whereNull('objection_date')->get();
        }
        return view('admin.challan.pending_by_prosecution',compact('challans','data','years'));
    }
    public function ChallanPassed(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::whereNotNull('challan_passed_date')
                        ->orWhere('fir',$request->fir)
                        ->whereYear('dated',$request->dated)
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }else{
            $challans = Challan::whereNotNull('challan_passed_date')->get();
        }
        return view('admin.challan.passed',compact('challans','data','years'));
    }
    public function pendingChallanByPs(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::where('challan_prepare_within_14_days',0)
                        ->orWhere('fir',$request->fir)
                        ->whereYear('dated',$request->dated)
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }else{
            $challans = Challan::where('challan_prepare_within_14_days',0)->get();
        }
        return view('admin.challan.pending_by_ps',compact('challans','data','years'));
    }
    public function pendingbypsincontacts(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::where('i_o_contacted_to_complainant',0)
                        ->orWhere('fir',$request->fir)
                        ->whereYear('dated',$request->dated)
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }else{
            $challans = Challan::where('i_o_contacted_to_complainant',0)->get();
        }
        return view('admin.challan.pending_by_ps',compact('challans','data','years'));
    }
    public function pendingByPsInInterimReport(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::where('challan_interim_report_within_14_days',0)
                        ->orWhere('fir',$request->fir)
                        ->whereYear('dated',$request->dated)
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }else{
            $challans = Challan::where('challan_interim_report_within_14_days',0)->get();
        }
        return view('admin.challan.pending_by_ps',compact('challans','data','years'));
    }
    public function ChallanObjection(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::whereNotNull('objection_date')->whereNull('challan_passed_date')
                        ->orWhere('fir',$request->fir)
                        ->whereYear('dated',$request->dated)
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }else{
            $challans = Challan::whereNotNull('objection_date')->whereNull('challan_passed_date')->get();
        }
        return view('admin.challan.objection',compact('challans','data','years'));
    }

    public function Challancourt(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir || $request->dated || $request->under_section || $request->police_station)
        {
            $challans = Challan::whereNotNull('date_of_receiving_challan_in_court')
                        ->whereYear('dated',$request->dated)
                        ->orWhere('fir',$request->fir)
                        ->orWhere('under_section',$request->under_section)
                        ->orWhere('police_station',$request->police_station)->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }else{
            $challans = Challan::whereNotNull('date_of_receiving_challan_in_court')->get();
        }
        return view('admin.challan.court',compact('challans','data','years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.challan.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Challan::create($request->all());
        toastr()->success('Challan is Created Successfully');
        return redirect()->route('admin.challan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $challan = Challan::find($id);
        return view('admin.challan.show',compact('challan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $challan = Challan::find($id);
        return view('admin.challan.edit',compact('challan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challan $challan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challan $challan)
    {
        //
    }
    
    public function file_send_after_3_days_pending($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'file_send_after_3_days' => false
        ]);
        toastr()->success('File Send After 3 days Status Updated To No Successfully');
        return back();
    }
    public function file_send_after_3_days_active($id)
    {
        $challan = Challan::find($id);
        
        $challan->update([
            'file_send_after_3_days' => true
        ]);
        toastr()->success('File Send After 3 days Status Updated To Yes Successfully');
        return back();
    }
    public function challan_receive_in_branch_pending($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'challan_receive_in_branch' => false
        ]);
        toastr()->success('Challan Is Received in Branch Status Updated To No Successfully');
        return back();
    }
    public function challan_receive_in_branch_active($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'challan_receive_in_branch' => true
        ]);
        toastr()->success('Challan Received in Branch Status Updated To Yes Successfully');
        return back();
    }
}
