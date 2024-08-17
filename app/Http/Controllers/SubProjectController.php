<?php

namespace App\Http\Controllers;

use App\DTO\SubProjectDetails;
use App\Enums\EmployeeRole;
use App\Enums\ProjectPriority;
use App\Enums\Status;
use App\Models\Attachment;
use App\Models\Project;
use App\Models\SubProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

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

        if($uploadedFile){
            $path = Storage::putFileAs('attachmens', $uploadedFile , $subProject->id);

            $attachment = new Attachment;

            $attachment->sub_project_id =  $subProject->id;
            $attachment->filename = $uploadedFile->getClientOriginalName();


            $request->file->move('assets', $attachment->sub_project_id);


         //  Storage::setVisibility($subProject->id, 'public');

            $attachment->save();
        }

       $qas = $request['selected_qas'] ?? [];
       $testers = $request['selected_testers'] ?? [];
       $devs = $request['selected_developers'] ?? [];

        $subProject->employees()->sync(
            [
                ...$qas,
                ...$testers,
                ...$devs
            ]
        );


        $subProject->save();

        return redirect()->route('subproject.edit',['id' => $subProject->id])->with("success","changes saved successfully");
    }

    public function edit(string $subProjectId) {
        $subProject = SubProject::find($subProjectId);

        $priorities = ProjectPriority::cases();
        $status = Status::cases();

        $project = Project::find($subProject->main_project_id);

        $attachment = DB::table('attachments')
                ->where('sub_project_id', '=', $subProjectId)
                ->get();


        $file = Storage::get('attachmens/'.$subProjectId);

        $filename = $attachment->first()->filename;

        $details = new SubProjectDetails(
            id: $subProjectId,
            title: $subProject->title,
            description: $subProject->description,
            priority: $subProject->priority,
            status: $subProject->status,
            timeEstimate: $subProject->total_time,
            employeesSelected: $subProject->employees->toArray(),
            attachment: $filename
        );

        $developers = [];
        $testers = [];
        $qas = [];

        foreach($project->employees as $employee) {
            if($employee->role->name === EmployeeRole::Developer->name) {
                $developers[] = $employee;
                continue;
            }

            if($employee->role->name === EmployeeRole::Tester->name) {
                $testers[] = $employee;
                continue;
            }

            if($employee->role->name === EmployeeRole::QA->name) {
                $qas[] = $employee;
                continue;
            }
        }

        return view('SubProject.editform', [
            'details' => $details,
            'mainTitle' => $project->title,
            'projectId' => $subProject->main_project_id,
            'developers' => $developers,
            'testers' => $testers,
            'qas' => $qas,
            'priorities' => $priorities,
            'status' => $status
        ]);
    }


    public function downloadFile(Request $request, $file){

        return response()->download(public_path('assets/'.$file));
    }
}
