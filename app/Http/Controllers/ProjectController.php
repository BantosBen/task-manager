<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    //
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $task = Auth::user()->projects()->create($validated);
        return new ProjectResource($task);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validate = $request->validated();
        $project->update($validate);
        return new ProjectResource($project);
    }
}