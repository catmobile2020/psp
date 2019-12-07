<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function index(Request $request)
    {
        $rows = Program::latest()->paginate(20);
        return view('pages.program.index',compact('rows'));
    }

    public function create()
    {
        $program = new Program;
        return view('pages.program.form',compact('program'));
    }


    public function store(ProgramRequest $request)
    {
        Program::create($request->all());
        return redirect()->route('programs.index')->with('message','Done Successfully');
    }

    public function edit(Program $program)
    {
        return view('pages.program.form',compact('program'));
    }


    public function update(ProgramRequest $request, Program $program)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $program->update($request->all());
        return redirect()->route('programs.index')->with('message','Done Successfully');
    }


    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('message','Done Successfully');
    }
}
