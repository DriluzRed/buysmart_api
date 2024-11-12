<div class="col-12 mb-4">
    <div class="card">
        <div class="card-header bg-white text-orange">
            <div class="row">
                <div class="col-11">
                    <h5>Mis datos personales</h5>
                </div>
                <div class="col text-right">
                    <btn class="btn btn-warning" id="edit-customer-data" onclick="openModal('{{$customer->id}}')"><i class="fas fa-pencil"></i></btn>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-unstyled">
                <li><strong>Nombres y Apellidos:</strong> {{$customer->name}}</li>
                <li><strong>Documento de identidad:</strong> {{$customer->ci}}</li>
                <li><strong>RUC:</strong> {{$customer->ruc ? $customer->ruc : 'No cuenta con un nro de RUC registrado'}}</li>
                <li><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($customer->birthdate)->format('d-m-Y') }}</li>
                <li><strong>Número de teléfono:</strong> {{$customer->phone}}</li>
                <li><strong>Correo electrónico:</strong> {{$customer->email}}</li>
            </ul>
        </div>
    </div>
</div>

{{-- modal --}}

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="editMydataModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMydataModal">Editar datos personales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="" id="editDataForm">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" id="editDataId" name="id" value="{{$customer->id}}">
                    <div class="mb-3">
                        <label for="customer-name" class="form-label">Nombre y Apellido</label>
                        <input type="text" class="form-control" id="customer-name" name="name" value="{{$customer->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="customer-ci" class="form-label
                        ">Documento de identidad</label>
                        <input type="text" class="form-control" id="customer-ci" name="ci" value="{{$customer->ci}}">
                    </div>
                    <div class="mb-3">
                        <label for="customer-ruc" class="form-label
                        ">RUC</label>
                        <input type="text" class="form-control" id="customer-ruc" name="ruc" value="{{$customer->ruc}}">
                    </div>
                    <div class="mb-3">
                        <label for="customer-birthdate" class="form-label
                        ">Fecha de nacimiento</label>
                       <input type="date" class="form-control datepicker" id="customer-birthdate" name="birthdate" value="{{ $customer->birthdate ? \Carbon\Carbon::parse($customer->birthdate)->format('Y-m-d') : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="customer-phone" class="form-label
                        ">Número de teléfono</label>
                        <input type="text" class="form-control" id="customer-phone" name="phone" value="{{$customer->phone}}">
                    </div>
                    <div class="mb-3">
                        <label for="customer-email" class="form-label
                        ">Correo electrónico</label>
                        <input type="email" class="form-control" id="customer-email" name="email" value="{{$customer->email}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="update-data">Guardar cambios</button>
                    </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        flatpickr("#customer-birthdate", {
            dateFormat: "Y-m-d",    
            defaultDate: "{{ $customer->birthdate ? \Carbon\Carbon::parse($customer->birthdate)->format('Y-m-d') : '' }}"
        });
    });

    function openModal(id) {
        $('#modal').modal('show');
    }

    $('#update-data').click(function() {
        
        var id = $('#editDataId').val();
        var name = $('#customer-name').val();
        var ci = $('#customer-ci').val();
        var ruc = $('#customer-ruc').val();
        var birthdate = $('#customer-birthdate').val();
        var phone = $('#customer-phone').val();
        var email = $('#customer-email').val();

        $.ajax({
            url: '/customer/' + id,
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                _method: 'PUT',
                name: name,
                ci: ci,
                ruc: ruc,
                birthdate: birthdate,
                phone: phone,
                email: email
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Datos actualizados',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#modal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al actualizar los datos',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
</script>