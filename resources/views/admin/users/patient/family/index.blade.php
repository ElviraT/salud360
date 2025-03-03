@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Patients Family') }}</h2>
                <div class="col-12" align="right">
                    {{-- @can('patients.family.store') --}}
                    <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                        data-bs-action="{{ route('patients.family.store') }}" data-bs-target="#modal_family"><i
                            class="uil-plus-circle"></i>&nbsp;{{ __('Add Patient Family') }}</a>
                    <a href="{{ route('patients') }}" class="btn btn-info"><i
                            class=" uil-history-alt"></i>&nbsp;{{ __('Back') }}</a>
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
                                        <th>@lang('Name')</th>
                                        <th>@lang('Mobile Number')</th>
                                        <th>@lang('Relationship') </th>
                                        <th>@lang('Created on')</th>
                                        <th Class="no-sort">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($families as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->phone_number }}</td>
                                            <td>{{ $item->relation->name }}</td>
                                            <td>{{ $item->created_at->format('j F, Y, g:i A') }}</td>
                                            <td>
                                                {{-- @can('patients.edit') --}}
                                                <a href="#" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_family" class="btn btn-success me-2"
                                                    data-bs-record-id="{{ $item->id }}"
                                                    data-bs-action="{{ route('patients.family.update', $item) }}">
                                                    <i class="uil-edit-alt"></i>
                                                    {{ __('Edit Patient') }}
                                                </a>
                                                {{-- @endcan --}}
                                                {{-- @can('patients.destroy') --}}
                                                <a class="btn btn-danger me-2" data-bs-toggle="modal"
                                                    data-bs-target="#confirm-delete"
                                                    data-bs-record-id="{{ $item->id }}"
                                                    data-bs-record-title="{{ 'El paciente ' }}{{ $item->name }}"
                                                    data-bs-action="{{ route('patients.family.destroy', $item) }}"
                                                    title="{{ __('Delete patients') }}"><i
                                                        class="uil-trash-alt"></i>@lang('Delete')</a>
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
@section('modal')
    @include('modales.eliminar')
    @include('modales.family')
@endsection
@section('script')
    @include('admin.users.patient.js')
@endsection
