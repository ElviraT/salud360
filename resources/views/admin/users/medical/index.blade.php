@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Medicals') }}</h2>
                <div class="col-12" align="right">
                    @can('medicals.store')
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                            data-bs-action="{{ route('medicals.store') }}" data-bs-target="#modal_medical"><i
                                class="uil-plus-circle"></i>&nbsp;{{ __('Add Medical') }}</a>
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
                                        <th>@lang('See')</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Speciality') </th>
                                        <th>@lang('Created on')</th>
                                        <th>@lang('Status')</th>
                                        <th Class="no-sort">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicals as $item)
                                        <tr>
                                            <td align="center">
                                                <a href="#"data-bs-toggle="modal"
                                                    data-bs-record-id="{{ $item->id }}"
                                                    data-bs-action="{{ route('medicals.show', $item) }}"
                                                    data-bs-target="#modal_show"><i class="uil-eye"></i>
                                                </a>
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->speciality->name }}</td>
                                            <td>{{ $item->created_at->format('j F, Y, g:i A') }}</td>
                                            <td>
                                                @if ($item->active == 1)
                                                    {{ __('Active') }}
                                                @else
                                                    {{ __('Inactive') }}
                                                @endif
                                            </td>
                                            <td>
                                                @can('medicals.edit')
                                                    <a href="{{ route('medicals.edit', $item) }}" type="button"
                                                        class="btn btn-success btn-sm me-2">
                                                        <i class="uil-edit-alt"></i>
                                                        {{ __('Edit Medical') }}
                                                    </a>
                                                @endcan
                                                {{-- @can('schedules') --}}
                                                <a href="{{ route('schedules', ['id' => $item->id]) }}"
                                                    class="btn btn-info me-2"><i
                                                        class="uil-schedule"></i>{{ __('Schedule') }}</a>
                                                {{-- @endcan --}}
                                                @can('medicals.destroy')
                                                    <a class="btn btn-danger me-2" data-bs-toggle="modal"
                                                        data-bs-target="#confirm-delete"
                                                        data-bs-record-id="{{ $item->id }}"
                                                        data-bs-record-title="{{ 'El Medico ' }}{{ $item->user->name }}&nbsp;{{ $item->user->last_name }}"
                                                        data-bs-action="{{ route('medicals.destroy', $item) }}"
                                                        title="{{ __('Delete Medical') }}"><i
                                                            class="uil-trash-alt"></i>{{ __('Delete') }}</a>
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
    @endsection
    @section('modal')
        @include('modales.medicals')
        @include('modales.show_medical')
        @include('modales.eliminar')
    @endsection
    @section('script')
        @include('admin.users.medical.js')
    @endsection
