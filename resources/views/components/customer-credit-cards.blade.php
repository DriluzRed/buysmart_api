<div class="col-12">
    <div class="card">
        <div class="card-header bg-white text-orange">
            <h5>Mis Tarjetas de Credito</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Dirección Línea 1</th>
                        <th>Dirección Línea 2</th>
                        <th>Ciudad</th>
                        <th>Departamento</th>
                        <th>Barrio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $address)
                        <tr>
                            <td>{{ $address->address_line_1 }}</td>
                            <td>{{ $address->address_line_2 }}</td>
                            <td>{{ $address->city->name }}</td>
                            <td>{{ $address->department->name }}</td>
                            <td>{{ $address->neighborhood?->name ?? 'Sin barrio' }}</td>
                            <td>
                                <a href="#" class="btn edit-address btn-warning" data-id="{{ $address->id }}" data-customer-id="{{ $address->customer_id }}" data-neighborhood-id="{{ $address->neighborhood_id }}" data-city-id="{{ $address->city_id }}" data-department-id="{{ $address->department_id }}" data-address-line-1="{{ $address->address_line_1 }}" data-address-line-2="{{ $address->address_line_2 }}" data-type="{{ $address->type }}" data-is-main="{{ $address->is_main }}" data-for-billing="{{ $address->for_billing }}"><i class="fas fa-pencil"></i></a>
                                <button class="btn btn-danger delete-address" data-id="{{ $address->id }}"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#addAddressModal">Añadir nueva dirección</a>
        </div>
    </div>
</div>