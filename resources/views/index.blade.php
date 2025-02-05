@extends('base')


<style>
    nav > div{
        padding: 0 13%;
        text-decoration: none;
        margin-top: 4%
    }

    div > span > a {
        background-color: #78a0ea;
        font-family: Mallanna, sans-serif;
        font-weight: bold;
        font-size: 30px;
        border-radius: 2%;
        color: #1a202c;
    }

    a:link {
        padding: 1% 7%;
        text-decoration: none;
    }
</style>

<body>
    <nav>
        <div>
            <span class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Active</a>
            </span>
            <span class="nav-item">
                <a class="nav-link" href="/employees">List Employees</a>
            </span>
            <span class="nav-item">
                <a class="nav-link" href="/projects">List Projects</a>
            </span>
            <span class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </span>
        </div>
    </nav>
</body>
</html>
