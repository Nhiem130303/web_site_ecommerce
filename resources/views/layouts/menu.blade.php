
<li class="nav-item">
    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Request::is('admin.categories*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.banners.index') }}" class="nav-link {{ Request::is('admin.banners*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Banners</p>
    </a>
</li>
