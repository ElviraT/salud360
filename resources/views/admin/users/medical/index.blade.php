@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Medicals') }}</h2>
                <div class="col-12" align="right">
                    {{-- @can('medicals.store') --}}

                    <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                        data-bs-action="{{ route('medicals.store') }}" data-bs-target="#modal_medical"><i
                            class="uil-plus-circle"></i>&nbsp;{{ __('Add Medical') }}</a>

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
                                        <th>@lang('Speciality') </th>
                                        <th>@lang('Created on')</th>
                                        <th>@lang('Status')</th>
                                        <th Class="no-sort">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($medicals as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}&nbsp;{{ $item->user->last_name }}</td>
                                            <td>{{ $item->user->movil }}</td>
                                            <td>{{ $item->speciality->name }}</td>
                                            <td>{{ $item->created_at->format('j F, Y, g:i A') }}</td>
                                            <td><span class="badge"
                                                    style="background-color: #E1FFED !important;
                                                color: {{ $item->status->color }} !important;">{{ $item->status->name }}</span>
                                            </td>

                                            <td class="d-flex align-items-center">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul>
                                                            @can('medicals.edit')
                                                                <li>
                                                                    <a href="#" type="button" data-bs-toggle="modal"
                                                                        data-bs-target="#add_medical" class="btn btn-greys me-2"
                                                                        data-bs-record-id="{{ $item->id }}"
                                                                        data-bs-action="{{ route('medicals.update', $item) }}">
                                                                        <i class="fa fa-edit me-1"></i>
                                                                        {{ __('Edit Medical') }}
                                                                    </a>
                                                                </li>
                                                            @endcan
                                                            @can('schedules')
                                                                <li>
                                                                    <a href="{{ route('schedules', ['id' => $item->id]) }}"
                                                                        class="btn btn-greys me-2" onclick=" loading_show();"><i
                                                                            class="fa fa-calendar me-2"></i>@lang('Schedule')</a>
                                                                </li>
                                                            @endcan
                                                            @can('medicals.destroy')
                                                                <li>
                                                                    <a class="btn btn-greys me-2" data-bs-toggle="modal"
                                                                        data-bs-target="#confirm-delete"
                                                                        data-bs-record-id="{{ $item->id }}"
                                                                        data-bs-record-title="{{ 'El Medico ' }}{{ $item->user->name }}&nbsp;{{ $item->user->last_name }}"
                                                                        data-bs-action="{{ route('medicals.destroy', $item) }}"
                                                                        title="{{ __('Delete medicals') }}"><i
                                                                            class="far fa-trash-alt me-2"></i>@lang('Delete')</a>
                                                                </li>
                                                            @endcan
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('modal')
        {{-- @include('modales.medicals') --}}
        @include('modales.eliminar')
    @endsection
    @section('script')
        @include('admin.users.medical.js')
    @endsection
