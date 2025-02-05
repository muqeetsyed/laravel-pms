<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('../css/app.css') }}">
</head>
<body>
    <div class="card">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <p>
            <a href="{{ route('index') }}">|^|Back|^|</a>
        </p>

        <p>
            <strong>---------------Employees-----------------</strong>
            <a href="{{ route('add_employee') }}">|^|Add|^|</a>
        </p>

        <ul>
            @foreach ($records as $record)
                <li>
                    <a href="{{ route('employee.edit', ['slug' => $record->id]) }}">
                        {{ $record->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
