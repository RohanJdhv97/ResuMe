<?php

namespace App\Http\Controllers;

use App\Models\CandidateSkill;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCandidateSkillRequest;
use App\Http\Requests\UpdateCandidateSkillRequest;

class CandidateSkillController extends Controller
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
    public function store(StoreCandidateSkillRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CandidateSkill $candidateSkill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CandidateSkill $candidateSkill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidateSkillRequest $request, CandidateSkill $candidateSkill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CandidateSkill $candidateSkill)
    {
        //
    }
}
