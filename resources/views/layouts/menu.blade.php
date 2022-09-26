<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Home</span>
    </a>
    @can('ver-productos')
        <a class="nav-link" href="/products">
            <i class=" fas fa-hotdog"></i><span>Productos</span>
        </a>
    @endcan
    @can('ver-usuarios')
        <a class="nav-link" href="/users">
            <i class=" fas fa-users"></i><span>Operadores</span>
        </a>
    @endcan
    @can('ver-puestos')
        <a class="nav-link" href="/roles">
            <i class=" fas fa-user-lock"></i><span>Puestos</span>
        </a>
    @endcan
</li>
