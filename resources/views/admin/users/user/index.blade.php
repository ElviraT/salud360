@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Users') }}</h2>
                <div class="col-12" align="right">
                    {{-- @can('users.store') --}}

                    <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-action="{{ route('users.store') }}"
                        data-bs-target="#modal_user"><i class="uil-plus-circle"></i>&nbsp;{{ __('Add User') }}</a>

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
                                        <th>@lang('Email')</th>
                                        <th>@lang('Created by') </th>
                                        <th>@lang('Role') </th>
                                        <th>@lang('Created on')</th>
                                        <th>@lang('Status')</th>
                                        <th Class="no-sort">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            @if (isset($item->cliente->name))
                                                <td>{{ $item->cliente->name }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{ $item->rol->role->name }}</td>
                                            <td>{{ $item->created_at->format('j F, Y, g:i A') }}</td>
                                            <td>
                                                @if ($item->active == 1)
                                                    {{ __('Active') }}
                                                @else
                                                    {{ __('Inactive') }}
                                                @endif
                                            </td>

                                            <td>
                                                {{-- @can('users.edit') --}}
                                                <a href="#" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_user" class="btn btn-success me-2"
                                                    data-bs-record-id="{{ $item->id }}"
                                                    data-bs-action="{{ route('users.update', $item) }}">
                                                    <i class="uil-edit-alt"></i>&nbsp;
                                                    {{ __('Edit User') }}
                                                </a>
                                                {{-- @endcan --}}

                                                {{-- @can('users.destroy') --}}
                                                <a class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirm-delete"
                                                    data-bs-record-id="{{ $item->id }}"
                                                    data-bs-record-title="{{ ' El Usuario ' }}{{ $item->name }}"
                                                    data-bs-action="{{ route('users.destroy', $item) }}"
                                                    title="{{ __('Delete User') }}"><i
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
    @endsection
    @section('modal')
        @include('modales.user')
        @include('modales.eliminar')
    @endsection
    @section('script')
        @include('admin.users.user.js')
    @endsection
