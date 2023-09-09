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

        <form action="{{ route('project.update',['id' => $details->id ]) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-primary">Remove</button>
                <button type="button" class="btn btn-primary">Email</button>
            </div>


            <input type="hidden" id="projectId" name="projectId" value={{ $details->id }} />


            <div class="form-group">
                <label for="title" class="col-sm-1 col-form-label">Title</label>
                <input type="text" id="title" name="title" value={{ $details->title }} readonly disabled />
            </div>

            <div class="form-group">
                <label for="description" class="col-sm-1 col-form-label">Description</label>
                <textarea id="description" name="description" rows="5" cols="60">
                    {{ $details->description }}
                </textarea>
            </div>

            <div class="form-group">
                <label for="employees" class="col-sm-1 col-form-label">Employees</label>

                <select id="employees" multiple name="selected_employees[]">
                    @foreach ($allEmployees as $employee)

                        @php
                            $flag = false;
                        @endphp

                        @foreach ($details->employees as $selectedEmployee)
                           @if ($selectedEmployee['id'] === $employee->id)
                             @php
                                $flag = true;
                             @endphp

                             @continue

                            @endif
                        @endforeach

                        <option value={{$employee->id}} {{$flag ?  'selected' : ''}} > {{ $employee->name }} </option>

                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="priority" class="col-sm-1 col-form-label">Priority</label>
                <select id="priority"  name="project_priority" required>

                    <option></option>
                    @foreach ($priorities as $priority)
                        <option value={{ $priority->name }} {{ $details->priority == $priority->name ? 'selected' : '' }}>{{ $priority->value }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="starting_date" class="col-sm-1 col-form-label">Starting Date</label>
                <input type="date" id="starting_date" name="starting_date" value={{ $details->startingDate }} />
            </div>


            <div class="form-group">
                <label for="finishing_date" class="col-sm-1 col-form-label">Finishing Date</label>
                <input type="date" id="finishing_date" name="finishing_date"  value={{ $details->finishedDate }} />
            </div>

{{--


            <div class="form-group">
                <label for="employees" class="col-sm-1 col-form-label">Employees</label>
                <select id="employees" multiple name="selected_employees[]">
                    <option></option>
                    @foreach ($employees as $id => $name)
                        <option value={{ $id }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="priority" class="col-sm-1 col-form-label">Priority</label>
                <select id="priority"  name="project_priority" required>
                    <option></option>
                    @foreach ($priorities as $priority)
                        <option value={{ $priority->name }}>{{ $priority->value }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="starting_date" class="col-sm-1 col-form-label">Starting Date</label>
                <input type="date" id="starting_date" name="starting_date">
            </div>


            <div class="form-group">
                <label for="finishing_date" class="col-sm-1 col-form-label">Finishing Date</label>
                <input type="date" id="finishing_date" name="finishing_date">
            </div> --}}

          </form>

        </div>
    </body>
</body>
</html>
