<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project</title>
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

    <form action="{{ route('project.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-1 col-form-label">Title</label>
            <input type="text" id="title" name="title" required>
        </div>


        <div class="form-group">
            <label for="description" class="col-sm-1 col-form-label">Description</label>
            <textarea id="description" name="description" rows="5" cols="60"></textarea>
        </div>

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
        </div>

      </form>

    </div>
</body>
</html>
