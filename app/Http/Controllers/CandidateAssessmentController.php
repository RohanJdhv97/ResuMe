<?php

namespace App\Http\Controllers;

use App\Models\CandidateAssessment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCandidateAssessmentRequest;
use App\Http\Requests\UpdateCandidateAssessmentRequest;

class CandidateAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandidateAssessmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CandidateAssessment $candidateAssessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CandidateAssessment $candidateAssessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidateAssessmentRequest $request, CandidateAssessment $candidateAssessment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CandidateAssessment $candidateAssessment)
    {
        //
    }
}
