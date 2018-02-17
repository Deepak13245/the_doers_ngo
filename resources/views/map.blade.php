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
@include('nav',compact(['user']))
<div class="container margin-top">
    <div class="row">
        <!-- Filters -->
        <div class="col-md-3">
            <form action="{{ route('map.filter') }}" method="post">
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
            @if(!count($list))
                <div class="alert alert-warning">
                    No results found.
                </div>
            @else
                <div id="googleMap" style="width:100%;height:600px;"></div>
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
<script>

    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng({{ $user->lat }},{{ $user->lng }}),
            zoom: 12,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        var marker = new google.maps.Marker({
            position: mapProp.center,
            title: '{{ $user->name }}',
        });
        marker.setMap(map);
        var icon = {
            url: "{{ asset('img/map_blue.png') }}", // url
            scaledSize: new google.maps.Size(40, 40), // scaled size
            labelOrigin: new google.maps.Point(25, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(11, 40),
        };
        @foreach($list as $u)
            marker = new google.maps.Marker({
            position: new google.maps.LatLng({{ $u->lat }},{{ $u->lng }}),
            title: '{{ $u->name }}',
            icon: icon,
            label: {
                color: 'green',
                fontWeight: 'bold',
                text: '{{ $u->name  }} - {{ $u->category->name }}',
            }
        });
        marker.setMap(map);
        marker.addListener('click', function () {
            alert("{{ $u->name }}\nEmail : {{ $u->email }}\nPhone : {{ $u->phone }}\nDistance: {{  round($u->distance($user),2) }} KM\nCategory : {{ $u->category->name }}\nInterest : {{ $u->interest->name }}");
        });
        @endforeach
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.map_key_js') }}&callback=myMap"></script>
</body>

</html>