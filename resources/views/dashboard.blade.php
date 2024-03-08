<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('/dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('academy.courses') }}">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('students')}}" class="nav-link">All Students</a>
                    </li>
                </ul>
            </div>
            <div class="nav-item">
                <ul class="navbar-nav mr-auto">
                    <li>
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                    </li>
                    <li>
                        {{-- Authentication --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="text-center ">
        <h3>Student Management </h3>
    </div>
    <div class="container">

        <div class="box">
            <div>
                <label class="label">Label 1</label>
            </div>
            <div>
                <label class="label">Label 2</label>
            </div>
            <a href="{{ route('academy.courses')}}" class="btn btn-success">Add Courses</a>
        </div>
        <div class="box">
            <div>
                <label class="label">Label 1</label>
            </div>
            <div>
                <label class="label">Label 2</label>
            </div>
            <a href="{{ route('students')}}" class="btn btn-success">All Students</a>
        </div>
        <div class="box">
            <div>
                <label class="label">Label 1</label>
            </div>
            <div>
                <label class="label">Label 2</label>
            </div>
            <a href="{{ route('academy.student')}}" class="btn btn-dark">Add student</a>
        </div>
    </div>
    <table>
        <tr>
            <th>Course Name</th>
            <th>Description</th>
            <th>Course Time</th>
            <th>Course Price</th>
            <th style="text-align: center;" colspan="4">Action</th>
        </tr>
        @if ($course->isNotEmpty())
        <!-- Display courses -->
        @foreach ($course as $courses)
        <tr>
            <td>{{$courses->course_name}}</td>
            <td> {!! strip_tags(Str::substr($courses->description, 0,
                80 )) !!}</td>
            <td>{{$courses->course_time}}</td>
            <td>{{$courses->course_price}}</td>
            <td><button class="btn btn-dark">Edit</button>
            <td><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#courseModal">View</button></td>
            <td><a href="{{url( '/course/delete/' . $courses->id)}}" class="btn btn-danger">End Course </a></td>
        </tr>
        @endforeach
        @endif
    </table>

    <!-- Modal -->
    <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courseModalLabel">Course Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Course Details -->
                    @if ($course->isNotEmpty())
                    <h4>Course Name:- {{$courses->course_name}}</h4>
                    <p>Course Description:- {{$courses->description}}</p>
                    <p>Course Time:- {{$courses->course_time}}</p>
                    <p>Course Price:- {{$courses->course_price}}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
<style>
    .text-center {
        display: flex;
        align-items: center;
        justify-content: center;
        color: black;
    }

    .sidebar {
        background-color: #000;
        color: #fff;
        height: 100vh;
    }

    .sidebar a {
        color: #fff;
    }

    .sidebar a:hover {
        color: #fff;
        text-decoration: none;
    }
    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 9ch;
        margin-left: 30ch;
        /* Adjust the gap between boxes */
    }

    /* CSS for individual boxes */
    .box {
        width: 300px;
        /* Set the width of each box */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    /* CSS for button */
    .btn {
        display: block;
        width: 100%;
        margin-bottom: 10px;
        /* Adjust the spacing between button and labels */
    }

    /* CSS for labels */
    .label {
        font-weight: bold;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    table {
        width: 95%;
        border-collapse: collapse;
        margin: 20px auto;
        background-color: #fff;
        box-shadow: 3px 10px 10px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #239625;
        color: white;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .modal-dialog {
        max-width: 70%;
        /* Adjust the maximum width of the modal dialog */
    }

    .modal-content {
        width: 100%;
        /* Ensure the modal content takes up the entire width */
    }

    .modal-body {
        word-wrap: break-word;
        /* Allow long words to break and wrap */
    }

    .btn-primary {
        width: 10%;
        margin-left: 2%;
    }
</style>