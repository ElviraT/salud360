@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Currencies') }}</h2>
                <div class="col-12" align="right">
                    {{-- @can('currencies.store') --}}

                    <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                        data-bs-action="{{ route('currencies.store') }}" data-bs-target="#modal_currency"><i
                            class="uil-plus-circle"></i>&nbsp;{{ __('Add Currency') }}</a>

                    {{-- @endcan --}}

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
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Simbol') }}</th>
                                        <th>{{ __('Is Principal') }}</th>
                                        <th width="30">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currencies as $currency)
                                        <tr>
                                            <td>{{ $currency->name }}</td>
                                            <td>{{ $currency->simbol }}</td>
                                            @if ($currency->is_principal == 1)
                                                <td>{{ __('Yes') }}</td>
                                            @else
                                                <td>{{ __('No') }}</td>
                                            @endif
                                            <td>
                                                {{-- @can('currencies.edit') --}}
                                                <a href="#" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_currency" class="btn btn-success me-2"
                                                    data-bs-record-id="{{ $currency->id }}"
                                                    data-bs-action="{{ route('currencies.update', $currency) }}">
                                                    <i class="uil-edit-alt"></i>&nbsp;
                                                    {{ __('Edit Currency') }}
                                                </a>
                                                {{-- @endcan --}}

                                                {{-- @can('currencies.destroy') --}}
                                                <a class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirm-delete"
                                                    data-bs-record-id="{{ $currency->id }}"
                                                    data-bs-record-title="{{ ' la Moneda ' }}{{ $currency->name }}"
                                                    data-bs-action="{{ route('currencies.destroy', $currency) }}"
                                                    title="{{ __('Delete Currency') }}"><i
                                                        class="uil-trash-alt me-2"></i>@lang('Delete')</a>
                                                {{-- @endcan --}}
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
    @include('admin.currency.js')
@endsection
@section('modal')
    @include('modales.currency')
    @include('modales.eliminar')
@endsection
