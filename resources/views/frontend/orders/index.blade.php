@extends('frontend.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h2 class="display-4 text-success">Mis Pedidos</h2>
            <h4 class="">Aquí puedes revisar el historial de tus compras y su estado.</h4>
        </div>

        @if($orders->isEmpty())
            <div class="alert alert-warning text-center">
                No tienes pedidos realizados.
            </div>
        @else
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-borderless">
                    <thead class="bg-success text-white">
                        <tr>
                            <th># Pedido</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-bottom">
                                <td><strong>{{ $order->id }}</strong></td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $order->status_translated === 'completado' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ ucfirst($order->status_translated) }}
                                    </span>
                                </td>
                                <td class="text-success">Gs. {{ \App\Helpers\Helper::formatPrice($order->total) }}</td>
                                <td>
                                    <a href="{{ route('customer.order.show', $order->id) }}" class="btn btn-warning btn-sm text-dark">
                                        Ver Detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
