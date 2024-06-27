<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    body{
        margin: 3%;
    }

    select{
        width: 10%;
    }
</style>
<body>
    <body>
        <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('subproject.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div>
                <h3 style="text-align: centre">Project {{ $project }} </h3>
            </div>

            <input type="hidden" value={{ $projectId }} name="projectId"/>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-primary">Remove</button>
            </div>

            <div class="form-group">
                <label for="title" class="col-sm-1 col-form-label">Title</label>
                <input type="text" id="title" name="title" />
            </div>

            <div class="form-group">
                <label for="description" class="col-sm-1 col-form-label">Description</label>
                <textarea id="description" name="description" rows="5" cols="60">
                </textarea>
            </div>

            <div class="form-group">
                <label for="priority" class="col-sm-1 col-form-label">Priority</label>
                <select id="priority"  name="projectPriority" required>
                    <option></option>
                    @foreach ($priorities as $priority)
                        <option value={{ $priority->name }}>{{ $priority->value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status" class="col-sm-1 col-form-label">Status</label>
                <select id="status"  name="projectStauts" required>
                    <option></option>
                    @foreach ($status as $status)
                        <option value={{ $status->name }} >{{ $status->value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="timeEstimate" class="col-sm-1 col-form-label">Time Estimate</label>
                <input type="text" id="timeEstimate" name="timeEstimate"  />
            </div>

            <div class="form-group">
                <label for="developers" class="col-sm-1 col-form-label">Developer</label>
                <select id="developers" multiple name="selected_developers[]">
                    <option></option>
                    @foreach ($developer as $dev)
                        <option value={{ $dev->id }}>{{ $dev->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="testers" class="col-sm-1 col-form-label">Tester</label>
                <select id="testers" multiple name="selected_testers[]">
                    <option></option>
                    @foreach ($tester as $test)
                        <option value={{ $test->id }}>{{ $test->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="qas" class="col-sm-1 col-form-label">QA</label>
                <select id="qas" multiple name="selected_qas[]">
                    <option></option>
                    @foreach ($qa as $_qa)
                        <option value={{ $_qa->id }}>{{ $_qa->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="file">Attachments</label>
                <input type="file" id="file" name="file" value="{{ old('file') }}" />
            </div>

          </form>

        </div>
    </body>
</body>
</html>
