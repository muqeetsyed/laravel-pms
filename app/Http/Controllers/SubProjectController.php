<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeRole;
use App\Enums\ProjectPriority;
use App\Enums\Status;
use App\Models\Attachment;
use App\Models\Project;
use App\Models\SubProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class SubProjectController extends Controller
{
    public function create(string $projectId)
    {
        $priorities = ProjectPriority::cases();
        $status = Status::cases();


        $project = Project::find($projectId);

        $developer = [];
        $tester = [];
        $qa = [];


        foreach($project->employees as $employee) {
            if($employee->role->name === EmployeeRole::Developer->name) {
                $developer[] = $employee;
                continue;
            }

            if($employee->role->name === EmployeeRole::Tester->name) {
                $tester[] = $employee;
                continue;
            }

            if($employee->role->name === EmployeeRole::QA->name) {
                $qa[] = $employee;
                continue;
            }
        }

        return view('SubProject.createform', [
            'project' => $project->title,
            'projectId' => $projectId,
            'developer' => $developer,
            'tester' => $tester,
            'qa' => $qa,
            'priorities' => $priorities,
            'status' => $status
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'projectPriority' => ['required',],
            'projectStauts' => ['required',],
        ]);

        $validFile = null;
        if(null !== $request->file('file')){
            $validFile = $request->validate([
                'file' => ['file', 'image', 'mimes:jpeg, png, gif, jpg', 'max:2048']
            ]);
        }


        $subProject = new SubProject();

        $subProject->title = $request->title;
        $subProject->description = $request->description;
        $subProject->priority = ProjectPriority::from($request->projectPriority);
        $subProject->status = Status::from($request->projectStauts);

        $subProject->main_project_id = $request->projectId;

        $subProject->save();


        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->file('file');
        $path = Storage::putFileAs('attachmens', $uploadedFile , $subProject->id);

        $attachment = new Attachment;

        $attachment->sub_project_id =  $subProject->id;
        $attachment->filename = $uploadedFile->getClientOriginalName();

        $attachment->save();

        return redirect()->back()->with("success","changes saved successfully!");
    }
}

