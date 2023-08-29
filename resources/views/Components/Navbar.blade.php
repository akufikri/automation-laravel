<nav class="main-header navbar navbar-expand navbar-dark navbar-light bg-success border-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="nav-link">
                <select id="timezone" class="bg-transparent border-0 text-white">
                    <option value="Asia/Jakarta">Asia/Jakarta (WIB)</option>
                    <option value="Asia/Bangkok">Asia/Bangkok (ICT)</option>
                    <option value="Asia/Tokyo">Asia/Tokyo (JST)</option>
                </select>
            </div>
        </li>
        <li class="nav-item">
            <span class="nav-link">
                <p id="clock"></p>
            </span>


        </li>
        <li class="nav-item">
            <span class="nav-link">|</span>
        </li>
        <li class="nav-item">
            <span class="nav-link">
                @auth
                    {{ Auth::user()->email }}
                @endauth
            </span>
        </li>
        <li class="nav-item">
            <span class="nav-link">|</span>
        </li>
        <li class="nav-item">
            <a href="/signout" class="nav-link">SignOut</a>
        </li>
    </ul>
</nav>
