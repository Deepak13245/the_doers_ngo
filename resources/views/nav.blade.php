<!-- Nav Bar -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col col-md-3">
                <div class="form-group select-N-V-group margin-top margin-bottom">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="active" href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('post') }}">Posts</a>
                        </li>
                    </ul>
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
                                    <a href="{{ route('logout') }}">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-6">
                <a href="{{ route('map') }}" class="btn btn-primary">People Nearby</a>
            </div>
            <div class="col col-md-6">
                <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal"
                        data-target="#newPost">New
                    Post
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Nav Bar Ends -->
