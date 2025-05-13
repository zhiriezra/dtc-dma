<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DspController extends Controller
{
    public function index()
    {
        return view('dsp.index');
    }

    public function newAssessments()
    {
        return view('dsp.new-assessments');
    }

    public function dspAssessments()
    {
        return view('dsp.assessments');
    }


}
