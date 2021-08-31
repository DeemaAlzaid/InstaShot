<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
<script src="{{ URL::to('src/js/jsApp')}}"></script>


<!-- Navbar -->
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">Timeline</a>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('post') }}">Add post</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
    </li>
  </div>
</nav>


<!-- Content -->
<div class="container h-50">
<div class="row posts">
<div class="col-md-6 col-md-offset-3">
    @if(isset($posts))
    @foreach($posts as $post)
        <article class="post" data-postid="{{ $post->id }}">
            <div class= "text-center">

              <img src="/images/{{Session::get('path')}}" >

              <p>{{$post -> description}}</p>

              <div class="info">
                    Posted by {{$post->user->name}}
               </div>

                <div class="interaction">

                  <a href="{{ route('comments.show', $post->id) }}">comments</a>

                  @if(Auth::User() == $post->user)
                  |
                  <a href="{{ route('post.edit', $post->id) }}">edit</a> |

                  <a href="{{route('post.delete', $post->id)}}" >delete</a>

                  @endif
                </div>
            </div>
        </article>
    @endforeach
    @endif


</div>
</div>
</div>

