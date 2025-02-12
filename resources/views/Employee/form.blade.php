<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('../css/app.css') }}">
</head>
<body class="card">
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

    <header>

        <form action="{{ $url }}" method="POST">

            <div class="form-group">
                <button type="submit">Save</button>
                <button type="button" id="remove">Remove</button>
                <button type="button" id="list">Search</button>
            </div>


            @csrf


            <div class="form-group">
                <label for="employeeName">Name</label>
                <input type="text"
                    id="employeeName"
                    name="employeeName"
                    maxlength="255"
                    value="{{ $employee->name ?? old('employeeName') }}"
                />
            </div>


            {{-- @error('employeeName')
                <p class="alert alert-danger">{{ $message }}</p>
            @enderror --}}

            <div class="form-group">
                <label for="employeeUsername">Username</label>
                <input type="text"
                   id="employeeUsername"
                   name="employeeUsername"
                   maxlength="8"
                   value="{{ $employee->username ?? old('employeeUsername')}}"
                />
            </div>

            <div class="form-group">
                <label for="employeePassword">Password</label>
                <input type="password"
                    id="employeePassword"
                    name="employeePassword"
                    minlength="8"
                    value="{{ $employee->password ?? old('employeePassword')}}"
                />
            </div>

            <div class="form-group">
                <label for="employeeEmail">Email</label>
                <input type="email"
                    id="employeeEmail"
                    name="employeeEmail"
                    value="{{ $employee->email ?? old('employeeEmail')}}"
                />
            </div>


            <div class="form-group">
                <label for="employeeRole">Role</label>
                <select name="employeeRole" id="employeeRole">
                    <option value="" {{ $employee?->role->value == '' ? 'selected' : '' }}></option>
                    <option value="developer" {{ $employee?->role->value == 'developer' ? 'selected' : '' }}>Developer</option>
                    <option value="tester" {{ $employee?->role->value == 'tester' ? 'selected' : '' }}>Tester</option>
                    <option value="qa" {{ $employee?->role->value == 'qa' ? 'selected' : '' }}>Quality Assurance</option>
                </select>
            </div>

        </form>

    </header>

</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Capture the button click event
        document.getElementById("remove").addEventListener("click", function (event) {
            const pathname = window.location.pathname;

            const segments = pathname.split('/');

            // Get the last segment (string) from the URL
            const lastSegment = segments[segments.length - 1];

            window.location.href = "{{ route('employee.remove', '') }}/" + lastSegment;

        });


        document.getElementById("list").addEventListener("click", function (event) {
            window.location.href = "{{ route('list-employees') }}";
        });
    });
</script>
