<div class="header">
    <div class="header_text"><h1 style="font-size:3vw">The Nanaimo Open Chess Tournament</h1></div>
</div>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/nanaimo_chessclub">Nanaimo Chess Club</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if ($active == null) {
                $active="home";
            } ?>
            <li @if($active=='home')class="active"@endif><a href="/">Home</a></li>
            <li @if($active=='next_tournament')class="active"@endif><a href="/next_tournament">Current Tournament</a></li>
            <li @if($active=='previous_tournament')class="active"@endif><a href="/previous_tournament">Past Tournaments</a></li>
            <li @if($active=='gallery')class="active"@endif><a href="/gallery">Gallery</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if(Auth::guest())
                <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            @else
                <li><a href="/profile/display"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            @endif
        </ul>
    </div>
</nav>
@if((Auth::check()) && Auth::user()->isAdmin)
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/backend/home">Site Controls</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/backend/pages/browse">Manage Pages</a></li>
            <li><a href="/backend/tournament/browse">Manage Tournaments</a></li>
            <li><a href="/backend/users/browse">Manage Users</a></li>
        </ul>
    </div>
</nav>
@endif

