<nav class="page-navigation navbar navbar-expand-lg navbar-dark px-lg-5 bg-dark">
    <ul class="navbar-nav nav-pills mr-auto">
        <li class="nav-item">
            <a href="{{'/'}}" class="nav-link {{(Request::is('/'))? 'active' : ''}}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{'/investments'}}" class="nav-link {{(Request::is('investments'))? 'active' : ''}}">Befektetések</a>
        </li>
    </ul>
</nav>
