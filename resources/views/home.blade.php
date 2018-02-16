<!DOCTYPE html>
<html lang="en">

<head>
    <title>The Doers NGO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<body>
<!-- Nav Bar -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col col-md-3">
                <div class="form-group select-N-V-group margin-top margin-bottom">
                    <a href="{{ url('/') }}">Home</a>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="search-N-V-group margin-top margin-bottom">
                    <input type="text" name="search" placeholder="Search..">
                </div>
            </div>
            <div class="col col-md-3">
                <div class="profile-header-container">
                    <div class="profile-header-img">
                        <img class="img-circle"
                             src="https://www.allamericanspa.co.uk/wp-content/uploads/2017/02/profile-pictures.png"/>
                        <div class="dropdown pull-right">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                {{ $user->name }}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('user-logout') }}">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <ul class="nav navbar-nav">
                    <li>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newPost">New
                            Post
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Nav Bar Ends -->

<div class="container margin-top">
    <div class="row">
        <!-- Filters -->
        <div class="col-md-3">
            <form action="{{ url('home') }}" method="post">
                {{ csrf_field() }}
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    Category</a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <!-- Checkbox -->
                                @foreach($categories as $category)
                                    <div class="checkbox">
                                        <label>
                                            <input {{ in_array($category->id,$category_ids)?"checked='checked'":"" }} name="category[]"
                                                   type="checkbox"
                                                   value="{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                    <!-- Checkbox ends -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                    Interests</a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                            @foreach($interests as $interest)
                                <!-- Checkbox -->
                                    <div class="checkbox">
                                        <label>
                                            <input {{ in_array($interest->id,$interest_ids)?"checked='checked'":"" }} type="checkbox"
                                                   name="interest[]"
                                                   value="{{ $interest->id }}">{{ $interest->name }}</label>
                                    </div>
                                    <!-- Checkbox ends -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Filter">
            </form>
        </div>
        <!-- Filters Ends -->

        <div class="col-md-9">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-{{ session()->get('type') }}">
                    {{ session()->get('message') }}
                </div>
            @endif

            @foreach($posts as $post)
            <!-- Card -->
                <div class="card padding-top padding-bottom col col-lg-12 margin-bottom">
                    <h3>{{ $post->title }}</h3>
                    <img class="margin-bottom" style="height: 20px;"
                         src="http://goldwallpapers.com/uploads/posts/blank-blue-wallpaper/blank_blue_wallpaper_030.jpg"
                         alt=""/>
                    <div class="col col-md-6">
                        <p><b>Name :</b> {{ $post->user->name }}</p>
                    </div>
                    <div class="col col-md-6">
                        <p><b>Email :</b> {{ $post->user->email }}</p>
                    </div>
                    <div class="col col-md-6">
                        <p><b>Category :</b> {{ $post->category->name }}</p>
                    </div>
                    <div class="col col-md-6">
                        <p><b>Interest :</b> {{ $post->interest->name }}</p>
                    </div>
                    <div class="col col-md-12">
                        <p><b>Description:</b>
                            {{ $post->description }}
                        </p>
                    </div>
                    @if(Auth::check()&&$user->id==$post->user->id)
                        <div class="col col-md-3 col-md-offset-9">
                            <form action="post/delete/{{$post->id}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </div>
                    @endif
                </div>
                <!-- Card End -->
            @endforeach
        </div>
    </div>
</div>
<div id="newPost" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="{{ url('post') }}" method="POST">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Post</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title" tabindex="1">
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" placeholder="Description"
                                  tabindex="1"></textarea>
                    </div>
                    <div class="form-group">
                        <select name="category_id" id="category" tabindex="2" class="form-control">
                            <option value="category">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="interest_id" id="areaofinterest" tabindex="2" class="form-control">
                            <option value="-1">Select Area Of Interest</option>
                            @foreach($interests as $interest)
                                <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="POST" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>

</html>