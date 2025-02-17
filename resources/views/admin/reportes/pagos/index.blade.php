@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Payment Report') }}</h2>
                <div class="row">

                    <form action="{{ route('report.pagos') }}" method="GET">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 mb-3">
                                    <label for="fecha_inicio">Rango de Fecha:</label>
                                    <input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control date"
                                        data-toggle="date-picker" value="{{ request('fecha_inicio') }}">
                                </div>

                                <div class="col-lg-6 col-md-12 mb-3">
                                    <label for="tipo_pago">Tipo de pago:</label>
                                    <select name="tipo_pago" id="tipo_pago" class="select2 form-control"
                                        data-toggle="select2">
                                        <option value="">Todos</option>
                                        <option value="Plan" {{ request('tipo_pago') == 'Plan' ? 'selected' : '' }}>Plan
                                        </option>
                                        <option value="Expense" {{ request('tipo_pago') == 'Expense' ? 'selected' : '' }}>
                                            Gasto
                                        </option>
                                        <option value="facturacion"
                                            {{ request('tipo_pago') == 'facturacion' ? 'selected' : '' }}>
                                            Facturación</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-12 mb-3">
                                    <label for="status">Estado:</label>
                                    <select name="status" id="status" class="select2 form-control"
                                        data-toggle="select2">
                                        <option value="">Todos</option>
                                        <option value="pendiente" {{ request('status') == 'pendiente' ? 'selected' : '' }}>
                                            Pendiente
                                        </option>
                                        <option value="aprobado" {{ request('status') == 'aprobado' ? 'selected' : '' }}>
                                            Aprobado
                                        </option>
                                        <option value="rechazado" {{ request('status') == 'rechazado' ? 'selected' : '' }}>
                                            Rechazado
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-3">
                                    <button type="submit" class="btn btn-info mt-2"><i
                                            class="uil-search me-2"></i>Filtrar</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive" id="card_table">
                            <table id="miTabla" class="table dt-responsive nowrap w-100" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Realizado por</th>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Monto</th>
                                        <th>Banco</th>
                                        <th>Producto/Servicio</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagos as $pago)
                                        <tr>
                                            <td>{{ $pago->user->name }}</td>
                                            <td>{{ $pago->transaction_date }}</td>
                                            <td>{{ $pago->transactionable_type }}</td>
                                            <td>{{ $pago->amount }}</td>
                                            <td>{{ $pago->bank->name }}</td>
                                            @if ($pago->transactionable_type === 'App\Models\Plan')
                                                <td> {{ $pago->transactionable->name }} </td> {{-- Accede al nombre del plan --}}
                                            @elseif ($pago->transactionable_type === 'App\Models\Gasto')
                                                <td> {{ $pago->transactionable->description }} </td> {{-- Accede a la descripción del gasto --}}
                                            @elseif ($pago->transactionable_type === 'App\Models\Factura')
                                                <td> {{ $pago->transactionable->invoice_number }} </td>
                                                {{-- Accede al número de factura --}}
                                            @endif
                                            <td>{{ $pago->payment_status }}</td>
                                            <td>
                                                <form action="{{ route('actualizar.status', $pago->id) }}" method="POST">
                                                    {{-- <form action="#" method="POST"> --}}
                                                    @csrf
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <select name="status" id="combo_status"
                                                                    class="form-select">
                                                                    <option value="Pendiente">Pendiente</option>
                                                                    <option value="Aprobado">Aprobado</option>
                                                                    <option value="Rechazado">Rechazado</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="submit"
                                                                    class="btn btn-warning">Actualizar</button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin.reportes.js.js')
@endsection
