<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="flaticon-menu-mobile"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                <li class="{{ Request::is('reports/basic') ? 'active' : '' }}"><a href="/reports/basic"> Basic Report</a></li>
                <li class="{{ Request::is('reports/intermediate') ? 'active' : '' }}"><a href="/reports/intermediate"> Intermediate Report</a></li>
                <li class="{{ Request::is('reports/full') ? 'active' : '' }}"><a href="/reports/full"> Full Report</a></li>
                <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact</a></li>
            </ul>

            <nav-right></nav-right>
        </div>
    </div>
</nav>
