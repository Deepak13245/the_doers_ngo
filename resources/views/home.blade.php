<!DOCTYPE html>
<html lang="en">

<head>
    <title>The Doers NGO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<body>

@include('nav',compact(['user']))

<div class="container margin-top">
    <div class="row">
        <!-- Filters -->
        <div class="col-md-3">
            <form action="{{ route('home.filter') }}" method="post">
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

            @foreach($users as $u)
            <!-- Card -->
                @if($u->id != $user->id)
                    <div class="card padding-top padding-bottom col col-lg-12 margin-bottom">
                        <h3>{{ $u->name }}</h3>
                        <div class="row">
                            <div class="col col-md-6">
                                <p><b>Email</b></p>
                            </div>
                            <div class="col col-md-6">
                                <p>{{ $u->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <p><b>Phone Number</b></p>
                            </div>
                            <div class="col col-md-6">
                                <p>{{ $u->phone or '' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <p><b>Category</b> : {{ $u->category->name }}</p>
                            </div>
                            <div class="col col-md-6">
                                <p><b>Interest</b> : {{ $u->interest->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <p>Address : </p>
                            </div>
                            <div class="col col-md-6">
                                <p>{{ $u->address }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            <!-- Card End -->
            @endforeach
            @if($paginate)
                <div class='row'>
                    <div class="col-md-3">
                        @if($users->previousPageUrl())
                            <a href="{{ $users->previousPageUrl() }}" class="btn btn-primary">
                                <i class="fa fa-btn fa-arrow-left"></i> Prev
                            </a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="center text-center" style="margin-top:-20px;">
                            <ul class="pagination">
                                @for($i=1;$i<=$users->lastPage();$i++)
                                    <li class="{{$users->currentPage()==$i?'active':''}}">
                                        <a href='{{$users->url($i)}}'>{{$i}}</a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        @if($users->nextPageUrl())
                            <a href="{{ $users->nextPageUrl() }}" class="btn btn-primary pull-right">
                                Next
                                <i class="fa fa-btn fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div id="newPost" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="{{ route('post.save') }}" method="POST">
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