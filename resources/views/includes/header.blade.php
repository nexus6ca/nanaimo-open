<div class="header">
    <img class="logo" src="/images/viu_logo.png" alt="Chess Club Logo">
    <div class="header_text"><h1>Vancouver Island University Chess Club</h1></div>
</div>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">VIU Chess Club</a>
        </div>
        <ul class="nav navbar-nav">
            @if (!isset($active)) $active="home" @endif
            <li @if($active=='home')class="active"@endif><a href="/">Home</a></li>
            <li @if($active=='next')class="active"@endif><a href="/next_tournament">Upcoming Tournament</a></li>
            <li @if($active=='previous')class="active"@endif><a href="/previous_tournament">Past Tournaments</a></li>
            <li @if($active=='gallery')class="active"@endif><a href="/gallery">Gallery</a></li>
        </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                    <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                @else
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                @endif
            </ul>
    </div>
</nav>

