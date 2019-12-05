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
            width: 120px;
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
            margin-left: 160px; /* Same as the width of the sidenav */
            font-size: 28px; /* Increased text to enable scrolling */
            padding: 0px 10px;
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

        .active {
            background-color: green;
            color: white;
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
        <a href="{{ route('trainer.index') }}">Trainer list</a>
        <a href="{{ url('trainer/create') }}">Create trainer</a>
    </div>

    <button class="dropdown-btn">Trainee
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="{{ route('trainee.index') }}">Trainee list</a>
        <a href="{{ url('trainee/create') }}">Create trainee</a>
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
        <h2>Create new account</h2>
    </div>
    <div class="row mt-5">
        <div class="col-sm-8 offset-sm-2">

            <form action="{{route('trainee.store')}}" method = "post">
                @csrf
                <div class="form-group">
                    <label for="role">System Email:</label>
                    <select name="user" id="user" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->email}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Trainee Name:</label>
                    <input type="text" name = "name" id = "name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">Trainee Date of Birth:</label>
                    <input type="date" name = "dob" id = "dob" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Trainee Email:</label>
                    <input type="email" name = "email" id = "email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">Trainee Education:</label>
                    <input type="text" name = "education" id = "education" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">Trainer Phone:</label>
                    <input type="text" name = "phone" id = "phone" class="form-control" required>
                </div>
                <button type = "submit" class = "btn btn-success">Submit</button>
            </form>
        </div>
    </div>

@endsection
