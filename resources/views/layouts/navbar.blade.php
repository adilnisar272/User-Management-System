<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 px-4 py-2 shadow-sm">
    <div class="container-fluid">
        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">Roles</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
