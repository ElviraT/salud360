@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Specialities') }}</h2>
                <div class="col-12" align="right">
                    @can('specialities.store')
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                            data-bs-action="{{ route('specialities.store') }}" data-bs-target="#speciality_detail"><i
                                class="uil-plus-circle"></i>&nbsp;{{ __('Add Speciality') }}</a>
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
                                        <th>{{ __('Name') }}</th>
                                        <th width="30">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($specialities as $speciality)
                                        <tr>
                                            <td>{{ $speciality->name }}</td>
                                            <td>
                                                @can('specialities.edit')
                                                    <a href="#" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#speciality_detail" class="btn btn-success me-2"
                                                        data-bs-record-id="{{ $speciality->id }}"
                                                        data-bs-action="{{ route('specialities.update', $speciality) }}">
                                                        <i class="uil-edit-alt"></i>&nbsp;
                                                        {{ __('Edit Speciality') }}
                                                    </a>
                                                @endcan

                                                @can('specialities.destroy')
                                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#confirm-delete"
                                                        data-bs-record-id="{{ $speciality->id }}"
                                                        data-bs-record-title="{{ ' la Especialidad ' }}{{ $speciality->name }}"
                                                        data-bs-action="{{ route('specialities.destroy', $speciality) }}"
                                                        title="{{ __('Delete Speciality') }}"><i
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
@endsection
@section('script')
    @include('admin.specialities.js')
@endsection
@section('modal')
    @include('modales.speciality')
    @include('modales.eliminar')
@endsection
