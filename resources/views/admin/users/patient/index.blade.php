@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Patients') }}</h2>
                <div class="col-12" align="right">
                    @can('patients.store')
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                            data-bs-action="{{ route('patients.store') }}" data-bs-target="#modal_patient"><i
                                class="uil-plus-circle"></i>&nbsp;{{ __('Add Patient') }}</a>
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
                                        <th>@lang('Mobile Number')</th>
                                        <th>@lang('Marital Status') </th>

                                        <th>@lang('Created on')</th>
                                        <th>@lang('Status')</th>
                                        <th Class="no-sort">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->marital->name }}</td>
                                            <td>{{ $item->created_at->format('j F, Y, g:i A') }}</td>
                                            <td>
                                                @if ($item->active === 1)
                                                    {{ __('Active') }}
                                                @else
                                                    {{ __('Inactive') }}
                                                @endif
                                            </td>

                                            <td>
                                                @can('patients.edit')
                                                    <a href="{{ route('patients.edit', $item) }}" type="button"
                                                        class="btn btn-success btn-sm me-2">
                                                        <i class="uil-edit-alt"></i>
                                                        {{ __('Edit Patient') }}
                                                    </a>
                                                @endcan
                                                @can('patients.family')
                                                    <a href="{{ route('patients.family', ['id' => $item->id]) }}"
                                                        class="btn btn-info btn-sm me-2"><i
                                                            class="uil-user-plus"></i>@lang('Family')</a>
                                                @endcan
                                                {{-- @can('patients.family') --}}
                                                {{-- <a href="#" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_history" class="btn btn-warning btn-sm me-2"
                                                    data-bs-record-id="{{ $item->id }}"
                                                    data-bs-record-idtype='App\Models\Patient'
                                                    data-bs-action="{{ route('patients.history', ['id' => $item->id]) }}"><i
                                                        class=" uil-file-medical-alt"></i>@lang('Medical History')</a> --}}
                                                {{-- @endcan --}}
                                                @can('patients.destroy')
                                                    <a class="btn btn-danger btn-sm me-2" data-bs-toggle="modal"
                                                        data-bs-target="#confirm-delete"
                                                        data-bs-record-id="{{ $item->id }}"
                                                        data-bs-record-title="{{ 'El paciente ' }}{{ $item->user->name }}&nbsp;{{ $item->user->last_name }}"
                                                        data-bs-action="{{ route('patients.destroy', $item) }}"
                                                        title="{{ __('Delete patients') }}"><i
                                                            class="uil-trash-alt"></i>@lang('Delete')</a>
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
@section('modal')
    @include('modales.patient')
    @include('modales.eliminar')
    {{-- @include('modales.history') --}}
@endsection
@section('script')
    @include('admin.users.patient.js')
@endsection
