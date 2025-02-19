@extends('layouts.base_admin')

@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Banks') }}</h2>
                <div class="col-12" align="right">
                    @can('banks.store')
                        <div class="list-btn">
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                data-bs-action="{{ route('banks.store') }}" data-bs-target="#bank_details"><i
                                    class="uil-plus-circle me-2" aria-hidden="true"></i>@lang('Add Bank')</a>

                        </div>
                    @endcan
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="scroll-vertical-datatable" class="table dt-responsive nowrap w-100" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Titular')</th>
                                        <th>@lang('Account')</th>
                                        <th>@lang('Currency')</th>
                                        <th>@lang('Saldo Inicial')</th>
                                        <th>@lang('Extra Information')</th>
                                        <th class="no-sort">@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banks as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->titular }}</td>
                                            <td>{{ $item->Account }}</td>
                                            <td>{{ $item->currency->name }}</td>
                                            <td>{{ number_format($item->amount, 2) }}</td>
                                            <td>{{ $item->extra }}</td>
                                            <td>

                                                @can('banks.edit')
                                                    <a href="#" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#bank_details" class="btn btn-success me-2"
                                                        data-bs-record-id="{{ $item->id }}"
                                                        data-bs-action="{{ route('banks.update', $item) }}">
                                                        <i class="uil-edit-alt"></i>&nbsp;
                                                        {{ __('Edit Bank') }}
                                                    </a>
                                                @endcan
                                                @can('banks.destroy')
                                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#confirm-delete"
                                                        data-bs-record-id="{{ $item->id }}"
                                                        data-bs-record-title="{{ 'El banco ' }}{{ $item->name }}"
                                                        data-bs-action="{{ route('banks.destroy', $item) }}"
                                                        title="{{ __('Delete Bank') }}"><i
                                                            class="uil-trash-alt me-2"></i>@lang('Delete')</a>
                                                @endcan
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
    </div>
    </div>
    </div>
@endsection
@section('script')
    @include('admin.banks.js')
@endsection
@section('modal')
    @include('modales.bank')
    @include('modales.eliminar')
@endsection
