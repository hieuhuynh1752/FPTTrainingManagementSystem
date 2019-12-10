@extends('layouts.app')

@section('left-navbar')

    <!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 180px;
            position: fixed;
            z-index: 1;
            top: 60px;
            left: 0;
            background-color: #343a40;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }
        .sidenav a, .dropdown-btn {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 15px;
            color: #818181;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
        }

        .sidenav a:hover, .dropdown-btn:hover {
            color: #f1f1f1;
        }

        .main {
            margin-left: 660px; /* Same as the width of the sidenav */
            font-size: 28px; /* Increased text to enable scrolling */
            padding-left: 30px;
        }

        .fa-caret-down {
            float: right;
            padding-right: 13px;
            padding-top: 5px;
        }

        .dropdown-container {
            display: none;
            background-color: #262626;
            padding-left: 8px;
        }

        .table{
            width: 110%;
            padding-right:30px;
        }

        .active {
            background-color: lightsteelblue;
            color: darkslategray;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>
</head>
<body>
<br>
<div class="sidenav">

    <button class="dropdown-btn">Course
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="{{ route('course.index') }}">Course list</a>
        <a href="{{ url('course/create') }}">Create course</a>
    </div>

    <button class="dropdown-btn">Course Category
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="{{ route('coursecategory.index') }}">Course category list</a>
        <a href="{{ url('coursecategory/create') }}">Create Course category</a>
    </div>

    <button class="dropdown-btn">Topic
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="{{ route('topic.index') }}">Topic list</a>
        <a href="{{ url('topic/create') }}">Create topic</a>
    </div>

    <button class="dropdown-btn">Trainer
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="{{ route('trainers.index') }}">Trainer list</a>
        <a href="{{ url('trainers/create') }}">Create trainer</a>
    </div>

    <button class="dropdown-btn">Trainee
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="{{ route('trainees.index') }}">Trainee list</a>
        <a href="{{ url('trainees/create') }}">Create trainee</a>
    </div>
</div>
<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
</body>
</html>
@endsection


@section('content')

    <div class="container">

        <form action="/search_course" method="get" role="search">
            {{ csrf_field() }}
            <div class="main">
                <div class="input-group">
                    <input type="search" class="form-control" name="search" placeholder="Search courses">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="table">
            <table class="table table-hover table-striped table-fixed text-center">
                <tr>
                    <th>CourseID</th>
                    <th>Course Name</th>
                    <th>Course Category</th>
                    <th></th>
                    <th>Action</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($courses as $course)
                    <tr class = "text-center">
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->CourseName }}</td>
                        <td>{{ $course->CourseCategoryName }}</td>
                        <td><a href="{{route('course.detail',['id'=>$course->id])}}" class = "btn btn-dark">Details</a></td>
                        <td><a href="{{route('course.assign',['id'=>$course->id])}}" class = "btn btn-secondary">Add topics</a></td>
                        <td><a href="{{route('course.edit',['id'=>$course->id])}}" class = "btn btn-info">Edit</a></td>
                        <td><a href="{{route('course.destroy',['id'=>$course->id])}}" class = "btn btn-danger">Delete</a></td>
                        </tr>
                @endforeach
            </table>


        </div>

    </div>

@endsection
