<ul class="nav nav-tabs">
    <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            User <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <div class="col-md-12">
                <a href="{{route('users.show.index')}}" role="button">
                    Show table
                </a>
            </div>
            @auth
                <div class="col-md-12">
                    <a href="{{route('users.tree.index')}}" role="button">
                        Show Tree
                    </a>
                </div>
            @endauth
        </ul>
    </li>
    @auth
    <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            Department <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <div class="col-md-12">
                <a href="{{route('departments.index')}}" role="button">
                    Show table
                </a>
            </div>
        </ul>
    </li>
    @endauth
</ul>
<br>
