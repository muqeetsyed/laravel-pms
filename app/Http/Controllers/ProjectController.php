<?php

namespace App\Http\Controllers;

use App\DTO\ProjectDetails;
use App\Enums\ProjectPriority;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
   public function create(): View
   {
    $employees = DB::table('employees')->pluck('name','id');

    $priorities = ProjectPriority::cases();

    return view('Project.form', compact('employees','priorities'));
   }

   public function store(Request $request)
   {
        $request->validate([
            'title' => ['required'],
            'selected_employees' => ['required'],
            'project_priority' => ['required'],
        ]);


        $project = new Project;

        $project->title = $request->title;
        $project->description = $request->input('description');
        $project->priority = ProjectPriority::from($request->project_priority);
        $project->finishing_date = $request->finishing_date;
        $project->starting_date = $request->starting_date;

        $project->save();

        $project->employees()->sync($request->selected_employees);

        return redirect()->route('project.edit',['id' => $project->id])->with("success","changes saved successfully");
   }

   public function edit(string $id): view
   {
        $project = Project::find($id);

        if(!$project instanceof Project) {
           throw new EntityNotFoundException(Project::class, $id);
        }

        $details = new ProjectDetails(
            id: $id,
            title: $project->title,
            description: $project->description,
            employees: $project->employees->toArray(),
            priority: $project->priority,
            startingDate: $project->starting_date,
            finishedDate: $project->finishing_date,
        );

        return view('Project.editForm', [
            'details' => $details,
            'allEmployees' => Employee::all(),
            'priorities' => ProjectPriority::cases(),
        ]);
   }

   public function update(Request $request)
   {

        $request->validate([
            'selected_employees' => ['required'],
            'project_priority' => ['required'],
        ]);

        $project = Project::find($request->projectId);


        $project->description = $request->description;
        $project->priority = ProjectPriority::from($request->project_priority);
        $project->finishing_date = $request->finishing_date;
        $project->starting_date = $request->starting_date;

        $project->save();

        $project->employees()->detach();

        $project->employees()->sync($request->input("selected_employees"));

        return redirect()->route('project.edit',['id' => $project->id])->with("success","changes saved successfully");
   }
}
