{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<x-backpack::menu-dropdown title="Gestion de Usuarios" icon="la la-puzzle-piece">
    <x-backpack::menu-dropdown-header title="Authentication" />
    <x-backpack::menu-dropdown-item title="Users" icon="la la-user" :link="backpack_url('user')" />
    <x-backpack::menu-dropdown-item title="Roles" icon="la la-group" :link="backpack_url('role')" />
    <x-backpack::menu-dropdown-item title="Permissions" icon="la la-key" :link="backpack_url('permission')" />
</x-backpack::menu-dropdown>
<x-backpack::menu-item title="Productos" icon="la la-question" :link="backpack_url('product')" />
<x-backpack::menu-item title="Categorias" icon="la la-question" :link="backpack_url('category')" />
<x-backpack::menu-item title="Sub categorias" icon="la la-question" :link="backpack_url('sub-category')" />
<x-backpack::menu-item title="Marcas" icon="la la-question" :link="backpack_url('brand')" />
<x-backpack::menu-item title="Pedidos" icon="la la-question" :link="backpack_url('order')" />
<x-backpack::menu-item title="Departmentos" icon="la la-question" :link="backpack_url('department')" />
<x-backpack::menu-item title="Ciudades" icon="la la-question" :link="backpack_url('city')" />
<x-backpack::menu-item title="Barrios" icon="la la-question" :link="backpack_url('neighborhood')" />