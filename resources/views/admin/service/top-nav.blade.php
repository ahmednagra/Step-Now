<nav class="navbar navbar-expand navbar-light bg-white border-bottom">
    <div class="collapse navbar-collapse">
        {{ ucwords(str_replace('-', ' ', $slug)) }}
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i> Go back to All Pages
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('front.service.detail', $slug) }}" class="nav-link" target="_blank">
                    <i class="fas fa-user-plus"></i> Visit Page
                </a>
            </li>
        </ul>
    </div>
</nav>
