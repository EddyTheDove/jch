<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="brand">
            <a  href="/admin">
                JCH Admin
            </a>
        </li>

        <li class="{{ Request::is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin') }}">
                <i class="ion-speedometer"></i>
                Dashboard
            </a>
        </li>

        <li class="{{ Request::is('admin/reports*') ? 'active' : '' }}">
            <a href="{{ route('reports.index' )}}">
                <i class="ion-clipboard"></i>
                Reports
            </a>
        </li>

        <li class="{{ Request::is('admin/orders*') ? 'active' : '' }}">
            <a href="{{ route('orders.index' )}}">
                <i class="ion-android-cart"></i>
                Orders
            </a>
        </li>

        <li class="{{ Request::is('admin/pages*') ? 'active' : '' }}">
            <a href="{{ route('pages.index' )}}">
                <i class="ion-document-text"></i>
                Pages
            </a>
        </li>

        <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
            <a href="/admin/users">
                <i class="ion-android-people"></i>
                Users
            </a>
        </li>


        <li class="{{ Request::is('admin/files*') ? 'active' : '' }}">
            <a href="/admin/files">
                <i class="ion-folder"></i>
                Files
            </a>
        </li>

        {{-- <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
            <a href="/admin/settings">
                <i class="ion-android-options"></i>
                Settings
            </a>
        </li> --}}

        <li class="separer"></li>

        <li>
            <a href="/" target="_blank">
                <i class="ion-ios-world-outline"></i>
                Main Website
            </a>
        </li>

        <li>
            <a href="{{ route('admin.logout') }}">
                <i class="ion-power"></i>
                Sign Out
            </a>
        </li>
    </ul>
</div>
