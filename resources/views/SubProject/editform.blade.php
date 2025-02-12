<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link rel="stylesheet" href="{{ asset('../css/app.css') }}">
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

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form>
            @csrf



            <div class="form-group">
                <label for="title" class="col-sm-1 col-form-label">Title</label>
                <input type="text" id="title" name="title" value={{ $details->title }} readonly disabled/>
            </div>

            <div class="form-group">
                <label for="description" class="col-sm-1 col-form-label">Description</label>
                <textarea id="description" name="description" rows="5" cols="60">
                    {{ $details->description }}
                </textarea>
            </div>

            <div class="form-group">
                <label for="priority" class="col-sm-1 col-form-label">Priority</label>
                <select id="priority"  name="projectPriority" required>
                    <option></option>
                    @foreach ($priorities as $priority)
                        <option value={{ $priority->name }} {{ $details->priority == $priority->name ? 'selected' : '' }}>
                            {{ $priority->value }}
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <label for="status" class="col-sm-1 col-form-label">Status</label>
                <select id="status"  name="projectStauts" required>
                    <option></option>
                    @foreach ($status as $status)
                        <option value={{ $status->name }} {{ $details->status == $status->name ? 'selected' : '' }}>
                            {{ $status->value }}
                        </option>
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
                    @foreach ($developers as $dev)

                    @php
                        $flag = false;
                    @endphp

                    @foreach ($details->employeesSelected as $selectedEmployee)
                    @if ($selectedEmployee['id'] === $dev->id)
                        @php
                            $flag = true;
                        @endphp

                        @continue

                        @endif
                    @endforeach

                    <option value={{ $dev->id }} {{$flag ?  'selected' : ''}} >{{ $dev->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="develotesterspers" class="col-sm-1 col-form-label">Testers</label>
                <select id="testers" multiple name="selected_testers[]">
                    <option></option>
                    @foreach ($testers as $tester)

                    @php
                        $flag = false;
                    @endphp

                    @foreach ($details->employeesSelected as $selectedEmployee)
                        @if ($selectedEmployee['id'] === $tester->id)
                        @php
                            $flag = true;
                        @endphp

                        @continue

                        @endif
                    @endforeach

                    <option value={{ $tester->id }} {{$flag ?  'selected' : ''}} >{{ $tester->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="qas" class="col-sm-1 col-form-label">Testers</label>
                <select id="qas" multiple name="selected_qas[]">
                    <option></option>
                    @foreach ($qas as $qa)

                    @php
                        $flag = false;
                    @endphp

                    @foreach ($details->employeesSelected as $selectedEmployee)
                        @if ($selectedEmployee['id'] === $qa->id)
                        @php
                            $flag = true;
                        @endphp

                        @continue

                        @endif
                    @endforeach

                    <option value={{ $qa->id }} {{$flag ?  'selected' : ''}} >{{ $qa->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="file">Download</label>
                <p>
                    <a href="{{url('/downloadFile'.$details->id )}}">{{ $details->attachment }}</a>
                </span>
            </div>

            <div class="form-group">
                <iframe height="600" width="1000" src="/assets/{{$details->id}}"></iframe>
            </div>

        </form>
    </div>
</body>
</html>
