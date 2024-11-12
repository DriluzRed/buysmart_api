{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<x-backpack::menu-dropdown title="Gestion de Usuarios" icon="la la-puzzle-piece">
    <x-backpack::menu-dropdown-header title="Gestion de Usuarios" />
    <x-backpack::menu-dropdown-item title="Usuarios" icon="la la-user" :link="backpack_url('user')" />
    <x-backpack::menu-dropdown-item title="Roles" icon="la la-group" :link="backpack_url('role')" />
    <x-backpack::menu-dropdown-item title="Permisos" icon="la la-key" :link="backpack_url('permission')" />
</x-backpack::menu-dropdown>
<x-backpack::menu-dropdown title="Configuraciones del sistema" icon="la la-cog">
    <x-backpack::menu-dropdown-item title='Configuraciones de Entorno' icon='la la-cog' :link="backpack_url('setting')" />
    <x-backpack::menu-dropdown-item title="Departmentos" icon="la la-question" :link="backpack_url('department')" />
    <x-backpack::menu-dropdown-item title="Ciudades" icon="la la-question" :link="backpack_url('city')" />
    <x-backpack::menu-dropdown-item title="Barrios" icon="la la-question" :link="backpack_url('neighborhood')" />
    {{-- <x-backpack::menu-dropdown-item title='Paginas' icon='la la-file-o' :link="backpack_url('page')"/> --}}
</x-backpack::menu-dropdown>
    <x-backpack::menu-dropdown title="E-Commerce" icon="la la-cog">
    <x-backpack::menu-dropdown-item title="Productos" icon="la la-question" :link="backpack_url('product')" />
    <x-backpack::menu-dropdown-item title="Stocks" icon="la la-question" :link="backpack_url('stock')" />
    <x-backpack::menu-dropdown-item title="Tamaños" icon="la la-question" :link="backpack_url('size')" />
    <x-backpack::menu-dropdown-item title="Categorias" icon="la la-question" :link="backpack_url('category')" />
    <x-backpack::menu-dropdown-item title="Sub categorias" icon="la la-question" :link="backpack_url('sub-category')" />
    <x-backpack::menu-dropdown-item title="Marcas" icon="la la-question" :link="backpack_url('brand')" />
    <x-backpack::menu-dropdown-item title="Pedidos" icon="la la-question" :link="backpack_url('order')" />
    <x-backpack::menu-dropdown-item title="Clientes" icon="la la-question" :link="backpack_url('customer')" />
</x-backpack::menu-dropdown>
