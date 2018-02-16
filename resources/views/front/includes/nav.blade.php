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
                <li><a href="/basic"> Basic Report</a></li>
                <li><a href="/intermediate"> Intermediate Report</a></li>
                <li><a href="/Full"> Full Report</a></li>
                <li><a href="/ppsr">Australian PPSR</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
