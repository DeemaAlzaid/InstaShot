<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<!-- Style -->
<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 120;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 60px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

<!-- Content -->
<div class="content">
  <div class="title m-b-md">
       Sign up
</div>

<!-- Checking for errors -->
@if(count($errors) > 0)
    <div class="row justify-content-center align-items-center">
        <div class="col-10 col-lg-4">
            <ul>
                @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif    

<!-- Register form -->
<div class="container h-50">
<div class="row h-50 justify-content-center align-items-center">
<div class="col-10 col-md-8 col-lg-4">


<form action="{{route('postSignUp')}}" method="POST">
<!-- <form action="{{ URL('/signup') }}" method="POST"> -->
@csrf

<div class="form-group {{ $errors -> has('name') ? 'has-error' : '' }}">
    <label for="name">Name:</label>
    <input class="form-control" type="text" name="name" id="name" value="{{Request::old('name')}}">
</div><br></br>

<div class="form-group {{ $errors -> has('email') ? 'has-error' : '' }}">
    <label for="email">Email address:</label>
    <input class="form-control" type="text" name="email" id="email" value="{{Request::old('email')}}">
</div><br></br>

<div class="form-group {{ $errors -> has('password') ? 'has-error' : '' }}">
    <label for="password">Password:</label>
    <input class="form-control" type="password" name="password"  id="password">
</div><br></br>

  <button type="submit" class="btn btn-sm btn-outline-primary">Sign Up</button>

  <input type="hidden" name="_token" value="{{ Session::token() }}">

</form>
</div>
</div>
</div>