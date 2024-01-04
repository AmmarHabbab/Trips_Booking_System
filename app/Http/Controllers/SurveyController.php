<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SurveyData;
use Auth;
use Yajra\DataTables\Facades\DataTables;
class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $survies = Survey::where('status','opened')->get();
        return view('pages.survies',compact('survies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.survies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);

        $survey = new Survey();
        $survey->name = $request->name;
        $survey->desc = $request->desc;
        $survey->save();
        return response()->json(['message','survey created successfully']);
    }

    public function surveyentry(Survey $survey)
    {
        $surveydata = SurveyData::where('survey_id',$survey->id)->get();
        foreach($surveydata as $surveydat)
        {
            if($surveydat->user_id == Auth::id())
            {
                return response()->json(['message','You Already Participated in the survey You can only participate once!']);
            }
        }
        return view('pages.survey',compact('survey'));
    }
    
    public function surveystore(Request $request, Survey $survey)
    {
        $request->validate([
            'opinion' => 'required'
        ]);

        $surveyData = new SurveyData();
        $surveyData->opinion = $request->opinion;
        $surveyData->user_id = Auth::id();
        $surveyData->survey_id = $survey->id;
        $surveyData->save();

        return response()->json(['message','Thanks For Your Entry!']);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        $surveydata = SurveyData::where('survey_id',$survey->id)->get();
        return view('dashboard.survies.surveydata',compact('survey','surveydata'));
    }

    public function close(Survey $survey)
    {
        $survey->status = 'closed';
        $survey->save();
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function allsurviesdatatables()
    {
        return view('dashboard.survies.all'); 
    }
    public function getsurviesdatatables()
    {
        $survies = Survey::all();
        return Datatables::of($survies)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            return $btn = '
            <form action="'.Route('dashboard.survey.close',$row->id).'" method="POST">
            <button><a href="'.Route('dashboard.survey.show',$row->id).'">Show Entries</a></.button>
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit">Close</button>
            </form>';
        })
        ->rawColumns(['name','desc','status','created_at','updated_at','action']) //,'action'
        ->make(true);
    }
}
