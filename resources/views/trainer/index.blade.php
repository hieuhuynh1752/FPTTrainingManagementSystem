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

    <button class="btn"><a href="{{ route('trainer.index') }}">Dashboard</a>

    </button>
    <button class="btn"><a href="{{ route('trainer.edit') }}">Update Profile</a>

    </button>

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
        <h2>Welcome {{$name}}</h2>
        <h4>Your assigned topics:</h4>

        <div class="table">
            <table class="table table-hover table-striped table-fixed text-center">
                <tr>
                    <th>Topic ID</th>
                    <th>Topic Name</th>
                    <th>Topic description</th>

                    <th>Action</th>
                    </tr>
                @foreach($topics as $topic)
                    <tr class = "text-center">
                        <td>{{ $topic->id }}</td>
                        <td>{{ $topic->TopicName }}</td>
                        <td>{{ $topic->TopicDescription }}</td>
                        <td><a href="{{route('trainer.detail',['id'=>$topic->id])}}" class = "btn btn-dark">Details</a></td>
                    </tr>
                @endforeach
            </table>
            <h6>Press Details button to see courses include the topic</h6>

        </div>
    </div>
@endsection
