<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Challan;
use App\Models\FIR;
use App\Models\Officer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()->type == "Police Station")
        {
            if($request->fir)
            {
                $challans = Challan::where('fir',$request->fir)
                            ->whereYear('dated',$request->dated)
                            // ->where('user_id',Auth::user()->id)
                            ->where('police_station',$request->police_station)
                            ->orWhere('under_section',$request->under_section)
                            ->orderBy('fir', 'asc')->get();
                $data['fir'] = $request->fir;
                $data['dated'] = $request->dated;
                $data['under_section'] = $request->under_section;
                $data['police_station'] = $request->police_station;
            }
            else
            {
                $challans = Challan::where('user_id',Auth::user()->id)->orderBy('fir','asc')->get();
            }
            return view('user.challan.index',compact('challans','data','years'));
        }elseif(Auth::user()->type == "Prosecution Branch")
        {
            if($request->fir || $request->dated || $request->under_section || $request->police_station)
            {
                $challans = Challan::where('file_send_after_3_days',1)
                            ->orWhere('fir',$request->fir)
                            ->whereYear('dated',$request->dated)
                            ->orWhere('under_section',$request->under_section)
                            ->orWhere('police_station',$request->police_station)
                            ->orderBy('fir', 'asc')->get();
                $data['fir'] = $request->fir;
                $data['dated'] = $request->dated;
                $data['under_section'] = $request->under_section;
                $data['police_station'] = $request->police_station;
            }
            else
            {
                $challans = Challan::where('file_send_after_3_days',1)->orderBy('fir', 'asc')->get();
            }
            return view('prosecution.challan.index',compact('challans','data','years'));
        }else{
            if($request->fir || $request->dated || $request->under_section || $request->police_station)
            {
                $challans = Challan::whereNotNull('challan_passed_date')
                            ->whereYear('dated',$request->dated)
                            ->orWhere('fir',$request->fir)
                            ->orWhere('under_section',$request->under_section)
                            ->orWhere('police_station',$request->police_station)
                            ->orderBy('fir', 'asc')->get();
                $data['fir'] = $request->fir;
                $data['dated'] = $request->dated;
                $data['under_section'] = $request->under_section;
                $data['police_station'] = $request->police_station;
            }
            else
            {
                $challans = Challan::whereNotNull('challan_passed_date')->orderBy('fir', 'asc')->get();
            }
            return view('court.challan.index',compact('challans','data','years'));
        }

    }
    public function pendingChallan(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        
        if(Auth::user()->type == "Police Station")
        {
            if($request->fir)
            {
                $challans = Challan::where('fir',$request->fir)
                            ->whereYear('dated',$request->dated)
                            ->where('challan_prepare_within_14_days',0)
                            ->orWhere('under_section',$request->under_section)
                            ->where('police_station',$request->police_station)
                            ->orderBy('fir', 'asc')->get();
                $data['fir'] = $request->fir;
                $data['dated'] = $request->dated;
                $data['under_section'] = $request->under_section;
                $data['police_station'] = $request->police_station;
            }else{
                $challans = Challan::where('user_id',Auth::user()->id)->where('challan_prepare_within_14_days',0)->orderBy('fir','asc')->get();

            }
            return view('user.challan.pending',compact('challans','data','years'));
        }elseif(Auth::user()->type == "Prosecution Branch")
        {
            if($request->fir || $request->dated || $request->under_section || $request->police_station)
            {
                $challans = Challan::whereNull('objection_date')
                            ->whereYear('dated',$request->dated)
                            ->where('file_send_after_3_days',1)
                            ->whereNull('challan_passed_date')
                            ->orWhere('fir',$request->fir)
                            ->orWhere('under_section',$request->under_section)
                            ->orWhere('police_station',$request->police_station)
                            ->orderBy('fir', 'asc')->get();
                $data['fir'] = $request->fir;
                $data['dated'] = $request->dated;
                $data['under_section'] = $request->under_section;
                $data['police_station'] = $request->police_station;
            }else{
                $challans = Challan::where('file_send_after_3_days',1)
                ->whereNull('challan_passed_date')
                ->whereNull('objection_date')
                ->orderBy('fir', 'asc')->get();
            }
            return view('prosecution.challan.pending',compact('challans','data','years'));
        }else{
            if($request->fir || $request->dated || $request->under_section || $request->police_station)
            {
                $challans = Challan::whereNotNull('challan_passed_date')
                            ->whereYear('dated',$request->dated)
                            ->orWhere('fir',$request->fir)
                            ->whereNull('date_of_receiving_challan_in_court')
                            ->orWhere('under_section',$request->under_section)
                            ->orWhere('police_station',$request->police_station)
                            ->orderBy('fir', 'asc')->get();
                $data['fir'] = $request->fir;
                $data['dated'] = $request->dated;
                $data['under_section'] = $request->under_section;
                $data['police_station'] = $request->police_station;
            }
            else
            {
                $challans = Challan::whereNotNull('challan_passed_date')
                            ->whereNull('date_of_receiving_challan_in_court')
                            ->orderBy('fir', 'asc')->get();
            }
            return view('court.challan.pending',compact('challans','data','years'));
        }

    }
    public function inProcessChallan(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir)
        {
            $challans = Challan::where('fir',$request->fir)
                        ->whereYear('dated',$request->dated)
                        ->where('challan_prepare_within_14_days',1)
                        ->where('challan_receive_in_branch',0)
                        ->orWhere('under_section',$request->under_section)
                        ->where('police_station',$request->police_station)
                        ->orderBy('fir', 'asc')->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }
        if(Auth::user()->type == "Police Station")
        {
            if(!$request->fir)
            {
                $challans = Challan::where('user_id',Auth::user()->id)
                    ->where('challan_prepare_within_14_days',1)
                    ->where('challan_receive_in_branch',0)->orderBy('fir','asc')->get();
            }
            return view('user.challan.in_process',compact('challans','data','years'));
        }elseif(Auth::user()->type == "Prosecution Branch")
        {
            return view('prosecution.challan.in_process',compact('challans','data','years'));
        }else{
            return view('court.challan.in_process',compact('challans','data','years'));
        }

    }
    public function passedChallan(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if(Auth::user()->type == "Police Station")
        {
            if($request->fir)
            {
                $challans = Challan::where('fir',$request->fir)
                            ->whereYear('dated',$request->dated)
                            ->whereNotNull('challan_passed_date')
                            ->orWhere('under_section',$request->under_section)
                            ->where('police_station',$request->police_station)
                            ->orderBy('fir', 'asc')->get();
                $data['fir'] = $request->fir;
                $data['dated'] = $request->dated;
                $data['under_section'] = $request->under_section;
                $data['police_station'] = $request->police_station;
            }
            else
            {
                $challans = Challan::where('user_id',Auth::user()->id)
                    ->whereNotNull('challan_passed_date')->orderBy('fir','asc')->get();
            }
            return view('user.challan.passed',compact('challans','data','years'));
        }elseif(Auth::user()->type == "Prosecution Branch")
        {
            if($request->fir || $request->dated || $request->under_section || $request->police_station)
            {
                $challans = Challan::whereNotNull('challan_passed_date')
                            ->whereYear('dated',$request->dated)
                            ->orWhere('fir',$request->fir)
                            ->orWhere('under_section',$request->under_section)
                            ->orWhere('police_station',$request->police_station)
                            ->orderBy('fir', 'asc')->get();
                $data['fir'] = $request->fir;
                $data['dated'] = $request->dated;
                $data['under_section'] = $request->under_section;
                $data['police_station'] = $request->police_station;
            }else{
                $challans =  Challan::whereNotNull('challan_passed_date')
                                ->orderBy('fir', 'asc')->get();
            }
            return view('prosecution.challan.passed',compact('challans','data','years'));
        }else{
            return view('court.challan.passed',compact('challans','data','years'));
        }

    }
    public function objectionChallan(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir)
        {
            $challans = Challan::where('fir',$request->fir)
                        ->whereYear('dated',$request->dated)
                        ->whereNotNull('objection_date')
                        ->whereNull('challan_passed_date')
                        ->where('police_station',$request->police_station)
                        ->orWhere('under_section',$request->under_section)
                        ->orderBy('fir', 'asc')->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }
        if(Auth::user()->type == "Police Station")
        {
            if(!$request->fir)
            {
                $challans = Challan::where('user_id',Auth::user()->id)
                        ->whereNotNull('objection_date')->whereNull('challan_passed_date')
                        ->orderBy('fir','asc')->get();
                
            }
            return view('user.challan.objection',compact('challans','data','years'));
        }elseif(Auth::user()->type == "Prosecution Branch")
        {
            if(!$request->fir)
            {
                $challans = Challan::whereNotNull('objection_date')
                                    ->whereNull('challan_passed_date')
                                    ->orderBy('fir', 'asc')->get();
            }
            return view('prosecution.challan.objection',compact('challans','data','years'));
        }else{
            return view('court.challan.objection',compact('challans','data','years'));
        }

    }
    public function court(Request $request)
    {
        $data = [];
        $years = Helpers::years();
        if($request->fir)
        {
            $challans = Challan::where('fir',$request->fir)
                        ->whereYear('dated',$request->dated)
                        ->whereNotNull('date_of_receiving_challan_in_court')
                        ->orWhere('under_section',$request->under_section)
                        ->where('police_station',$request->police_station)
                        ->orderBy('fir', 'asc')->get();
            $data['fir'] = $request->fir;
            $data['dated'] = $request->dated;
            $data['under_section'] = $request->under_section;
            $data['police_station'] = $request->police_station;
        }
        if(Auth::user()->type == "Police Station")
        {
            if(!$request->fir)
            {
                $challans = Challan::where('user_id',Auth::user()->id)
                        ->whereNotNull('date_of_receiving_challan_in_court')
                        ->orderBy('fir','asc')->get();
            }
            return view('user.challan.court',compact('challans','data','years'));
        }elseif(Auth::user()->type == "Prosecution Branch")
        {
            return view('prosecution.challan.court',compact('challans','data','years'));
        }else{
            return view('court.challan.court',compact('challans','data','years'));
        }

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
            return view('user.challan.create');
        }
        toastr()->warning('Unauthorized');
        return redirect()->route('user.challan.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fir = FIR::find($request->fir_id);
        $request->merge([
            'fir' => $fir->fir,
            'dated' => $fir->dated,
            'under_section' => $fir->under_section,
            'offence' => $fir->offence,
            'police_station' => $fir->police_station,
        ]);
        $challan = Challan::create($request->all());
        Officer::create([
         'name' => $request->i_o_name,
         'challan_id' => $challan->id,
        ]);
        toastr()->success('Challan is Created Successfully');
        return redirect()->route('user.challan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function show(Challan $challan)
    {
        //
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
        if(Auth::user()->type == "Police Station")
        {
            return view('user.challan.edit',compact('challan'));
        }elseif(Auth::user()->type == "Prosecution Branch"){
            return view('prosecution.challan.edit',compact('challan'));
        }else{
            return view('court.challan.edit',compact('challan'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $challan = Challan::find($id);
        if(Auth::user()->type == "Police Station")
        {
            if($request->image)
                {
                    $challan->update([
                    'image' => $request->image 
                    ]);
                }
                $challan->update($request->only('fir','dated','under_section','i_o_name','road_no','nature_of_challan'));
        }
        else{
            $challan->update($request->only('judge_id','date_of_decision','decision'));   
        }
            toastr()->success('Challan Informations Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Challan  $challan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $challan = Challan::find($id);
        $challan->delete();
        toastr()->success('Challan is Deleted Successfully');
        return redirect()->back();
    }
    public function i_o_contacted_to_complainant_pending($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'i_o_contacted_to_complainant' => false
        ]);
        toastr()->success('I/o Contact To Complainant Status Updated To No Successfully');
        return back();
    }
    public function i_o_contacted_to_complainant_active($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'i_o_contacted_to_complainant' => true
        ]);
        toastr()->success('I/o Contact To Complainant Status Updated To Yes Successfully');
        return back();
    }
    public function challan_prepare_within_14_days_pending($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'challan_prepare_within_14_days' => false
        ]);
        toastr()->success('Challan Prepare Within 14 Days Status Updated To No Successfully');
        return back();
    }
    public function challan_prepare_within_14_days_active($id)
    {
        $challan = Challan::find($id);
        if($challan->i_o_contacted_to_complainant)
        {
            $challan->update([
                'challan_prepare_within_14_days' => true
            ]);
            toastr()->success('Challan Prepare Within 14 Days Status Updated To Yes Successfully');
            return back();
        }else{
            toastr()->warning('I/O not Contacted To Complainant Yet');
            return back();
        }
    
    }
    public function challan_interim_report_within_14_days_pending($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'challan_interim_report_within_14_days' => false
        ]);
        toastr()->success('Challan Prepare Within 14 Days Status Updated To No Successfully');
        return back();
    }
    public function challan_interim_report_within_14_days_active($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'challan_interim_report_within_14_days' => true
        ]);
        toastr()->success('Challan Interim Report Within 14 Days Status Updated To Yes Successfully');
        return back();
    }
    public function challan_resubmitted_after_defect_removals_pending($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'challan_resubmitted_after_defect_removals' => false
        ]);
        toastr()->success('Challan Resubmitted After Defect Removals Status Updated To No Successfully');
        return back();
    }
    public function challan_resubmitted_after_defect_removals_active($id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'challan_resubmitted_after_defect_removals' => true
        ]);
        toastr()->success('Challan Resubmitted After Defect Removals Status Updated To Yes Successfully');
        return back();
    }
    public function challan_sent_to_prosecution_date_store(Request $request,$id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'interim_sent_to_prosecution_department_date' => $request->interim_sent_to_prosecution_department_date
        ]);
        toastr()->success('Challan Sent to Prosecution Date Updated Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Challan Sent to Prosecution Date Updated Successfully!!'
        ]);    
    }
    public function date_of_receiving_challan_in_court(Request $request,$id)
    {
        $challan = Challan::find($id);
        $challan->update([
            'date_of_receiving_challan_in_court' => $request->date_of_receiving_challan_in_court
        ]);
        toastr()->success('Challan Receiving in Court Date Updated Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Challan Receiving in Court Date Updated Successfully!!'
        ]);    
       
    }
    public function challan_passed_date_store(Request $request,$id)
    {
        $challan = Challan::find($id);
        if($request->objection)
        {
            $challan->update([
                'objection_date' => $request->objection_date,
                'prosecutor_name' => $request->prosecutor_name,
                'objection' => $request->objection_text,
            ]);
            toastr()->success('Challan Objection Raised Date Updated Successfully');
            return response()->json([
                'status' => true,
                'message' => 'Challan Objection Raised Date Updated Successfully!!'
            ]);  
        }else{
            $challan->update([
                'challan_passed_date' => $request->challan_passed_date,
                'prosecutor_name' => $request->prosecutor_name,
            ]);
            toastr()->success('Challan Passed Date Updated Successfully');
            return response()->json([
                'status' => true,
                'message' => 'Challan Passed Date Updated Successfully!!'
            ]);  
        }
         
    }
}
