<!-- Nav Bar -->
<div class="container-fluid">
    <div class="container">
        <div class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li>
                    <a class="active" href="{{ url('/') }}">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('map') }}">Map view</a>
                </li>
                <li>
                    <a href="{{ route('post') }}">Postings</a>
                </li>
                <li>
                    <a href="{{ route('event') }}">Events</a>
                </li>
<!--                 <li>
                    <div class="search-N-V-group">
                        <input type="text" name="search" placeholder="Search..">
                    </div>
                </li> -->
            </ul>
            <div class="pull-right profile-header-container">
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
                                <a href="{{ route('logout') }}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <a href="{{ route('map') }}" class="btn btn-primary">People Near you</a>
                <a href="{{ route('event.map') }}" class="btn btn-primary">Events Near you</a>
            </div>
            <div class="col col-md-6">
                @if(request()->url()==route('post'))
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#newPost">New
                        Post
                    </button>
                @endif
                @if(request()->url()==route('event'))
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#newEvent">New
                        Event
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Nav Bar Ends -->
