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
    <button class="dropdown-btn">Account
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="{{ route('admin.index') }}">Account list</a>
        <a href="{{ url('admin/create') }}">Create new</a>
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

        <form action="/search_user" method="get" role="search">
            {{ csrf_field() }}
            <div class="main">
                <div class="input-group">
                    <input type="search" class="form-control" name="search" placeholder="Search users">
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
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th></th>
                </tr>
                @foreach($users as $user)
                    <tr class = "text-center">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->rolename }}</td>

                        <td><a href="{{route('admin.edit',['id'=>$user->id])}}" class = "btn btn-info">Edit</a></td>
                        <td><a href="{{route('admin.destroy',['id'=>$user->id])}}" class = "btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </table>


        </div>

    </div>

@endsection
