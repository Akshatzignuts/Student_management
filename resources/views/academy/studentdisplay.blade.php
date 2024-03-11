<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('students')}}" class="nav-link">All Students</a>
                    </li>
                       <li class="nav-item">
                        <a href="{{ route('teacherdisplay')}}" class="nav-link">Teacher details</a>
                    </li>

                </ul>
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
        </div>
    </nav>
    <div>
        <h1>Student Details </h1>
        <a href="{{url('/dashboard')}}" class="btn btn-primary">Back
        </a>
    </div>
    <table>
        <tr>
            <th>Student Name</th>
            <th>Address</th>
            <th>Mobile no.</th>
            <th>Course name</th>
            <th>Teacher Assign</th>
        </tr>
        @if ($student->isNotEmpty())
        @foreach ($student as $students)
        <tr>
            <td>{{$students->name}}</td>
            <td>{{$students->address}}</td>
            <td>{{$students->mobile_no}}</td>
            @php $count = 0; $totalcourse = count($students->courses); @endphp
            <td>
                @foreach ($students->courses as $course)
                {{$course->course_name}}
                @php $count++; @endphp
                @if($count % 3 == 0 && $count!= $totalcourse)
                , <br>
                @elseif($count != $totalcourse)
                ,
                @endif
                @endforeach
            </td>
            <td>{{$students->teacher->teacher_name}}</td>
        </tr>
        @endforeach
        @else

        @endif
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
<style>
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

    h1 {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn {
        margin-left: 20px;
    }

</style>
