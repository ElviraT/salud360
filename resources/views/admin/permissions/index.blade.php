@extends('layouts.base_admin')
@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Roles & Permission') }}</h2>
                <div class="col-12" align="right">
                    {{-- @can('roles.store') --}}

                    <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-action="{{ route('roles.store') }}"
                        data-bs-target="#modal_role"><i class="uil-plus-circle"></i>&nbsp;{{ __('Add Roles') }}</a>

                    {{-- @endcan --}}

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="scroll-vertical-datatable" class="table dt-responsive nowrap w-100">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>@lang('Role Name')</th>
                                        <th>@lang('Created at')</th>
                                        <th width="20" Class="no-sort">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                            <td class="d-flex align-items-center">
                                                {{-- @can('roles.edit') --}}
                                                <a href="#" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_role" class="btn btn-success me-2"
                                                    data-bs-record-id="{{ $item->id }}"
                                                    data-bs-action="{{ route('roles.update', $item) }}">
                                                    <i class="uil-edit-alt"></i>&nbsp;
                                                    {{ __('Edit Role') }}
                                                </a>
                                                {{-- @endcan --}}
                                                {{-- @can('permissions.create') --}}
                                                <a href="{{ route('permissions.create', ['rol' => $item]) }}"
                                                    class="btn btn-info me-2" onclick=" loading_show();"><i
                                                        class="uil-shield"></i>&nbsp;
                                                    {{ __('Permissions') }}</a>
                                            </td>
                                            {{-- @endcan --}}
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.permissions.js.js')
@endsection
@section('modal')
    @include('modales.roles')
@endsection
