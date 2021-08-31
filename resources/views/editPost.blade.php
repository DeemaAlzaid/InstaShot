<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ URL::to('css/main.css') }}">

<!-- Navbar -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand">Edit post</a>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('timeline') }}">Timeline</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
    </div>
</nav>

<!-- Checking for errors -->
@if((Session::has('message')) > 0)
    <div class="row justify-content-center align-items-center">
        <div class="col-10 col-lg-4">
            {{Session::get('message')}}
        </div>
    </div>
@endif

<!-- Content -->
<div class="container">
    <div class="row h-50 justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-4">


            <form action="{{route('post.update', ['id'=>$post->id])}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Choose Photo:</label>
                    <input class="form-control-file" type="file" name="image_path" id="image_path">
                </div><br></br>

                <div class="form-group">
                    <label for="name">Add Caption:</label>
                    <textarea class="form-control" name="description">
                        {{$post->description}}
                    </textarea>
                </div><br></br>

                <button type="submit" class="btn btn-sm btn-outline-primary" value="upload">Update</button>

            </form>
        </div>
    </div>
</div>
