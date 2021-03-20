@if(Auth::guard('web')->check())
    <p class="text-success">
    You are logged in as <strong>User</strong>
    </p>
@else
    <p class="text-danger">
    You are logged out as a <strong>User</strong>
    </p>
@endif

@if(Auth::guard('council')->check())
    <p class="text-success">
    You are logged in as <strong>Council</strong>
    </p>
@else
    <p class="text-danger">
    You are logged out as a <strong>Council</strong>
    </p>
@endif
@if(Auth::guard('franchise')->check())
    <p class="text-success">
    You are logged in as <strong>Franchise</strong>
    </p>
@else
    <p class="text-danger">
    You are logged out as a <strong>Franchise</strong>
    </p>
@endif