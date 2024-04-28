<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('admin.home.show') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.attributes.index') }}" class="nav-link {{ Request::is('admin/attributes*') ? 'active' : '' }}">
        <p>Attributes</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.attributeValues.index') }}" class="nav-link {{ Request::is('admin/attributeValues*') ? 'active' : '' }}">
        <p>Attribute Values</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.banners.index') }}" class="nav-link {{ Request::is('admin/banners*') ? 'active' : '' }}">
        <p>Banners</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
        <p>Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.products.index') }}" class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
        <p>Products</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.productVariants.index') }}" class="nav-link {{ Request::is('admin.productVariants*') ? 'active' : '' }}">
        <p>Product Variants</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.locations.index') }}" class="nav-link {{ Request::is('admin.locations*') ? 'active' : '' }}">
        <p>Locations</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.users.index') }}" class="nav-link {{ Request::is('admin.locations*') ? 'active' : '' }}">
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.productInventories.index') }}" class="nav-link {{ Request::is('admin.productInventories*') ? 'active' : '' }}">
        <p>Warehouse <i class="right fas fa-angle-left"></i></p>
    </a>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.productInventories.index') }}" class="nav-link">
                <i class="left fas fa-angle-right"></i>
                <p>Xem tồn kho</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.warehouseReceipts.index') }}" class="nav-link {{ Request::is('admin.warehouseReceipts*') ? 'active' : '' }}">
                <i class="left fas fa-angle-right"></i>
                <p>Phiếu nhập kho</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.warehouseExports.index') }}" class="nav-link {{ Request::is('admin.warehouseExports*') ? 'active' : '' }}">
                <i class="left fas fa-angle-right"></i>
                <p>Phiếu xuất kho</p>
            </a>
        </li>
    </ul>
</li>
