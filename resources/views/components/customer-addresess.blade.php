<div class="col-12">
    <div class="card">
        <div class="card-header bg-white text-orange">
            <h5>Mis direcciones</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                                    <a href="#" class="btn edit-address btn-primary-custom" data-id="{{ $address->id }}"
                                        data-customer-id="{{ $address->customer_id }}"
                                        data-neighborhood-id="{{ $address->neighborhood_id }}"
                                        data-city-id="{{ $address->city_id }}"
                                        data-department-id="{{ $address->department_id }}"
                                        data-address-line-1="{{ $address->address_line_1 }}"
                                        data-address-line-2="{{ $address->address_line_2 }}"
                                        data-type="{{ $address->type }}" data-is-main="{{ $address->is_main }}"
                                        data-for-billing="{{ $address->for_billing }}"><i
                                            class="fas fa-pencil"></i></a>
                                    <button class="btn btn-danger delete-address" data-id="{{ $address->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <a href="#" class="btn btn-primary-custom mt-3" data-bs-toggle="modal"
                data-bs-target="#addAddressModal">Añadir nueva dirección</a>

        </div>
    </div>
</div>

<!-- Modal para añadir dirección -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAddressModalLabel">Añadir nueva dirección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->id }}">
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Departamento</label>
                        <select name="department_id" id="department_id" class="form-select select2" required
                            onchange="getCities(this.value)">
                            <option value="">Selecciona un departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="city_id" class="form-label">Ciudad</label>
                        <select name="city_id" id="city_id" class="form-select select2" required
                            onchange="getNeighborhoods(this.value)">
                            <option value="">Selecciona una ciudad</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="neighborhood_id" class="form-label">Barrio</label>
                        <select name="neighborhood_id" id="neighborhood_id" class="form-select select2" required>
                            <option value="">Selecciona un barrio</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="address_line_1" class="form-label">Dirección Línea 1 (Agregar nro de Casa)</label>
                        <input type="text" class="form-control" id="address_line_1" name="address_line_1" required>
                    </div>
                    <div class="mb-3">
                        <label for="address_line_2" class="form-label">Dirección Línea 2</label>
                        <input type="text" class="form-control" id="address_line_2" name="address_line_2">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select name="type" id="type" class="form-select select2">
                            <option value="work">Trabajo</option>
                            <option value="home">Casa</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="is_main" class="form-label">Principal</label>
                        <input type="checkbox" id="is_main" name="is_main">
                    </div>
                    <div class="mb-3">
                        <label for="for_billing" class="form-label">Para Facturación</label>
                        <input type="checkbox" id="for_billing" name="for_billing">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary-custom" id="save-address">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para editar dirección -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">Editar dirección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="" id="editAddressForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="editAddressId" name="id">
                    <div class="mb-3">
                        <label for="editDepartmentId" class="form-label">Departamento</label>
                        <select name="department_id" id="editDepartmentId" class="form-select select2" required onchange="loadCities(this.value, '', '#editCityId')">
                            <option value="">Seleccione un departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editCityId" class="form-label">Ciudad</label>
                        <select name="city_id" id="editCityId" class="form-select select2" required onchange="loadNeighborhoods(this.value, '', '#editNeighborhoodId')">
                            <option value="">Seleccione una ciudad</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editNeighborhoodId" class="form-label">Barrio</label>
                        <select name="neighborhood_id" id="editNeighborhoodId" class="form-select select2">
                            <option value="">Seleccione un barrio</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editAddressLine1" class="form-label">Dirección Línea 1</label>
                        <input type="text" class="form-control" id="editAddressLine1" name="address_line_1"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="editAddressLine2" class="form-label">Dirección Línea 2</label>
                        <input type="text" class="form-control" id="editAddressLine2" name="address_line_2">
                    </div>
                    <div class="mb-3">
                        <label for="editType" class="form-label">Tipo</label>
                        <select name="type" id="editType" class="form-select select2">
                            <option value="work">Trabajo</option>
                            <option value="home">Casa</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editIsMain" class="form-label">Principal</label>
                        <input type="checkbox" id="editIsMain" name="is_main">
                    </div>
                    <div class="mb-3">
                        <label for="editForBilling" class="form-label">Para Facturación</label>
                        <input type="checkbox" id="editForBilling" name="for_billing">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary-custom" id="update-address">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#save-address').on('click', function() {
                var data = {
                    _token: $('input[name="_token"]').val(),
                    customer_id: $('#addAddressModal input[name="customer_id"]').val(),
                    neighborhood_id: $('#addAddressModal select[name="neighborhood_id"]').val(),
                    city_id: $('#addAddressModal select[name="city_id"]').val(),
                    department_id: $('#addAddressModal select[name="department_id"]').val(),
                    address_line_1: $('#addAddressModal input[name="address_line_1"]').val(),
                    address_line_2: $('#addAddressModal input[name="address_line_2"]').val(),
                    type: $('#addAddressModal select[name="type"]').val(),
                    is_main: $('#addAddressModal input[name="is_main"]').prop('checked'),
                    for_billing: $('#addAddressModal input[name="for_billing"]').prop('checked')
                };

                $.ajax({
                    url: '{{ route('addresses.store') }}',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Dirección guardada',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al guardar la dirección',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Actualizar dirección

            $('#update-address').on('click', function() {
                var data = {
                    _token: $('input[name="_token"]').val(),
                    _method: 'PUT',
                    id: $('#editAddressModal input[name="id"]').val(),
                    customer_id: $('#editAddressModal input[name="customer_id"]').val(),
                    neighborhood_id: $('#editAddressModal select[name="neighborhood_id"]').val(),
                    city_id: $('#editAddressModal select[name="city_id"]').val(),
                    department_id: $('#editAddressModal select[name="department_id"]').val(),
                    address_line_1: $('#editAddressModal input[name="address_line_1"]').val(),
                    address_line_2: $('#editAddressModal input[name="address_line_2"]').val(),
                    type: $('#editAddressModal select[name="type"]').val(),
                    is_main: $('#editAddressModal input[name="is_main"]').prop('checked'),
                    for_billing: $('#editAddressModal input[name="for_billing"]').prop('checked')
                };

                $.ajax({
                    url: $('#editAddressForm').attr('action'),
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Dirección actualizada',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al actualizar la dirección',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Manejar datos para el modal de edición
            $('.edit-address').on('click', function() {
                var id = $(this).data('id');
                var customerId = $(this).data('customer-id');
                var departmentId = $(this).data('department-id');
                var cityId = $(this).data('city-id');
                var neighborhoodId = $(this).data('neighborhood-id');
                var addressLine1 = $(this).data('address-line-1');
                var addressLine2 = $(this).data('address-line-2');
                var type = $(this).data('type');
                var isMain = $(this).data('is-main');
                var forBilling = $(this).data('for-billing');

                $('#editAddressId').val(id);
                $('#editCustomerId').val(customerId);
                $('#editDepartmentId').val(departmentId);
                $('#editAddressLine1').val(addressLine1);
                $('#editAddressLine2').val(addressLine2);
                $('#editType').val(type);
                $('#editIsMain').prop('checked', isMain);
                $('#editForBilling').prop('checked', forBilling);

                // Cargar ciudades y barrios
                loadCities(departmentId, cityId, '#editCityId');
                loadNeighborhoods(cityId, neighborhoodId, '#editNeighborhoodId');

                $('#editAddressForm').attr('action', '{{ route('addresses.update', '') }}/' + id);
                $('#editAddressModal').modal('show');

                // Cargar ciudades y barrios
                loadCities(departmentId, cityId, '#editCityId');
                loadNeighborhoods(cityId, neighborhoodId, '#editNeighborhoodId');
            });

            // Manejar datos para el modal de eliminación
            $('.delete-address').on('click', function() {
                var id = $(this).data('id');
                var url = '{{ route('addresses.destroy', '') }}/' + id;

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response[0] === 200) {
                                    Swal.fire(
                                        'Eliminado!',
                                        'La dirección ha sido eliminada.',
                                        'success'
                                    );
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Hubo un problema al eliminar la dirección.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'Hubo un problema al eliminar la dirección.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

        });

        function loadCities(departmentId, selectedCityId, citySelectSelector) {
            if (departmentId) {
                $.ajax({
                    url: '{{ route('get-cities') }}',
                    type: 'GET',
                    data: {
                        department_id: departmentId
                    },
                    success: function(data) {
                        $(citySelectSelector).empty();
                        $(citySelectSelector).append('<option value="">Seleccionar Ciudad</option>');
                        $.each(data, function(key, value) {
                            $(citySelectSelector).append('<option value="' + key + '"' + (key ==
                                selectedCityId ? ' selected' : '') + '>' + value + '</option>');
                        });
                    }
                });
            } else {
                $(citySelectSelector).empty();
                $(citySelectSelector).append('<option value="">Seleccionar Ciudad</option>');
            }
        }

        function loadNeighborhoods(cityId, selectedNeighborhoodId, neighborhoodSelectSelector) {
            if (cityId) {
                $.ajax({
                    url: '{{ route('get-neighborhoods') }}',
                    type: 'GET',
                    data: {
                        city_id: cityId
                    },
                    success: function(data) {
                        $(neighborhoodSelectSelector).empty();
                        $(neighborhoodSelectSelector).append('<option value="">Seleccionar Barrio</option>');
                        $(neighborhoodSelectSelector).append('<option value="">Sin barrio</option>');
                        $.each(data, function(key, value) {
                            $(neighborhoodSelectSelector).append('<option value="' + key + '"' + (key ==
                                    selectedNeighborhoodId ? ' selected' : '') + '>' + value +
                                '</option>');
                        });
                    }
                });
            } else {
                $(neighborhoodSelectSelector).empty();
                $(neighborhoodSelectSelector).append('<option value="">Seleccionar Barrio</option>');
                $(neighborhoodSelectSelector).append('<option value="">Sin barrio</option>');
            }
        }

        function getCities(departmentId) {
            if (departmentId) {
                $.ajax({
                    url: '{{ route('get-cities') }}',
                    type: 'GET',
                    data: {
                        department_id: departmentId
                    },
                    success: function(data) {
                        $('#city_id').empty();
                        $('#city_id').append('<option value="">Seleccionar Ciudad</option>');
                        $.each(data, function(key, value) {
                            $('#city_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="">Seleccionar Ciudad</option>');
            }
        }

        function getNeighborhoods(cityId) {
            if (cityId) {
                $.ajax({
                    url: '{{ route('get-neighborhoods') }}',
                    type: 'GET',
                    data: {
                        city_id: cityId
                    },
                    success: function(data) {
                        $('#neighborhood_id').empty();
                        $('#neighborhood_id').append('<option value="">Seleccionar Barrio</option>');
                        $('#neighborhood_id').append('<option value="">Sin barrio</option>');
                        $.each(data, function(key, value) {
                            $('#neighborhood_id').append('<option value="' + key + '">' + value +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#neighborhood_id').empty();
                $('#neighborhood_id').append('<option value="">Seleccionar Barrio</option>');
                $('#neighborhood_id').append('<option value="">Sin barrio</option>');
            }
        }
    </script>
@endsection
