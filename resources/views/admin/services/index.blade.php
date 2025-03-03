@extends('layouts.base_admin')

@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Services') }}</h2>
                <div class="col-12" align="right">
                    @can('services.store')
                        <div class="list-btn">
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                data-bs-action="{{ route('services.store') }}" data-bs-target="#service_details"><i
                                    class="uil-plus-circle me-2" aria-hidden="true"></i>@lang('Add Service')</a>

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
                                        <th>@lang('Clinic')</th>
                                        <th>@lang('Price')</th>
                                        <th width="20" class="no-sort">@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->clinic->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>

                                                @can('services.edit')
                                                    <a href="#" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#service_details" class="btn btn-success me-2"
                                                        data-bs-record-id="{{ $item->id }}"
                                                        data-bs-action="{{ route('services.update', $item) }}">
                                                        <i class="uil-edit-alt"></i>&nbsp;
                                                        {{ __('Edit Service') }}
                                                    </a>
                                                @endcan
                                                @can('services.destroy')
                                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#confirm-delete" data-bs-record-id="{{ $item->id }}"
                                                        data-bs-record-title="{{ 'El Servicio ' }}{{ $item->name }}"
                                                        data-bs-action="{{ route('services.destroy', $item) }}"
                                                        title="{{ __('Delete Service') }}"><i
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
    @include('admin.services.js')
@endsection
@section('modal')
    @include('modales.service')
    @include('modales.eliminar')
@endsection
