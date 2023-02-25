<?php

namespace App\Http\Controllers;


use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;
use DataTables;
use PDF;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::all();
       
        if ($request->ajax()) {
            $data = Mark::with('student')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                       return $row->student->name;
                     })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('student.edit',$row->id).'" class="edit btn btn-primary btn-sm m-1">Edit</a>';
                           $btn .= '<a href=""  class="delete btn btn-danger btn-sm m-1" id="'.$row->id.'">Delete</a>';
                           $btn .= '<a href="'.route('student_pdf',$row->id).'" target="_blank" class="btn btn-warning btn-sm">PDF</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
       return  view('home',compact('students'));
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
        $mark = New Mark();
        $mark->student_id=$request->student_id;
        $mark->english=$request->english;
        $mark->hindi=$request->hindi;
        $mark->gujarati=$request->gujarati;
        $mark->save();
        return redirect()->route('student.index');
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

    public function delete(Request $request)
    {
        $mark = Mark::where('id',$request->id);
        $mark->delete();
        return response()->json([
            "status"=>"true",
        ]);

    }

    public function studentpdf($id)
    {
      
        $marks = Mark::where('id',$id)->get();
        $pdf = PDF::loadView('student',compact('marks'));
        return $pdf->stream('student.pdf');       
    }
}
