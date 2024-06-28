@extends('base')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Management System</title>


    <style>
        .primary-container {
            background-color: var(--md-sys-color-primary-container);
            color: black; /* Contrast text color */
            padding: 16px;
            border-radius: 8px;
        }
    </style>

</head>


<body>
    <div class="primary-container">

        <h1 class="md-typescale-display-medium">Hello Material!</h1>
        <h1>Hello Material!</h1>

        <span>Welcome!</span>
        <p>
            <a href='/employees'>List Employees</a>
        </p>
        <p>
            <a href='/projects'>List Projects</a>
        </p>
    </div>
</body>
</html>
