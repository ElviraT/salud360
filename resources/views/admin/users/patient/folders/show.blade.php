@extends('layouts.admin.base')
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
        .dropdown-toggle {
            background: white;
            border: 0px;
        }

        .dropdown-toggle::after {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body w-100">
                    <div class="content-page-header p-0">
                        <h5>{{ $folders->name }}</h5>
                        <div class="list-btn">
                            <a href="{{ route('folders') }}" class="btn btn-secondary"><i
                                    class="fa fa fa-arrow-circle-left me-2" aria-hidden="true"></i> @lang('Back')</a>
                            @can('files.upload')
                                <a class="btn btn-info" href="#" data-bs-toggle="modal"
                                    data-bs-record-id="{{ $folders->id }}" data-bs-target="#folder_file"><i
                                        class="fa fa-upload me-2" aria-hidden="true"></i>@lang('Upload File')</a>
                            @endcan
                            @can('folders.store.subfolder')
                                <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                    data-bs-action="{{ route('folders.store.subfolder') }}"
                                    data-bs-record-id="{{ $folders->id }}" data-bs-target="#folder_add"><i
                                        class="fa fa-plus-circle me-2" aria-hidden="true"></i>@lang('Add Folder')</a>
                            @endcan
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-table">
                                <div class="card-body">
                                    <div class="row">
                                        <h5>@lang('Folders and File')</h5>
                                        <hr>
                                        @foreach ($subfolders as $item)
                                            <div class="col-xl-3 col-sm-6 col-12" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" data-bs-original-title="{{ $item->name }}">
                                                <div class="card sombra">
                                                    <div class="card-body">
                                                        <div class="dash-widget-header">
                                                            <div class="col-4">
                                                                <span class="dash-widget-icon bg-2">
                                                                    <i class="fas fa-folder"></i>
                                                                </span>
                                                            </div>
                                                            <div class="col-6">
                                                                <a href="{{ route('folders.show', $item->id) }}"
                                                                    onclick=" loading_show();">
                                                                    <div class="dash-count">
                                                                        <div class="dash-title"><b>{{ $item->name }}</b>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="btn-group" role="group"
                                                                    style="margin-top: 5px; text-align:right;">
                                                                    <button id="btnGroupDrop1" type="button"
                                                                        class="dropdown-toggle" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu sombra"
                                                                        aria-labelledby="btnGroupDrop1">
                                                                        @can('folders.edit')
                                                                            <a class="dropdown-item" href="#"
                                                                                id="btnEditar"
                                                                                onclick="return editar({{ $item->id }})"><i
                                                                                    class="fa fa-edit me-1"></i>@lang('Edit Folder')</a>
                                                                        @endcan
                                                                        @can('folders.destroy')
                                                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                                                data-bs-target="#confirm-delete"
                                                                                data-bs-record-id="{{ $item->id }}"
                                                                                data-bs-record-title="{{ 'la Carpeta ' }}{{ $item->name }}"
                                                                                data-bs-action="{{ route('folders.destroy', $item) }}"
                                                                                title="{{ __('Delete Folder') }}"><i
                                                                                    class="far fa-trash-alt me-2"></i>@lang('Delete')</a>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead align="center">
                                                <tr>
                                                    <th>{{ 'Nro' }}</th>
                                                    <th colspan="2">@lang('Name')</th>
                                                    <th>@lang('Created on')</th>
                                                    <th>@lang('Actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($files as $key => $file)
                                                    @php
                                                        $extension = pathinfo($file->name);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            @if ($extension['extension'] == 'jpg' || $extension['extension'] == 'png' || $extension['extension'] == 'jpeg')
                                                                <img src="{{ asset('assets/img/icons/icono_imagen.png') }}"
                                                                    alt="" width="20px">
                                                            @elseif($extension['extension'] == 'pdf')
                                                                <img src="{{ asset('assets/img/icons/icono_pdf.jpg') }}"
                                                                    alt="" width="20px">
                                                            @elseif($extension['extension'] == 'docx')
                                                                <img src="{{ asset('assets/img/icons/icono_word.png') }}"
                                                                    alt="" width="20px">
                                                            @elseif($extension['extension'] == 'pptx')
                                                                <img src="{{ asset('assets/img/icons/icono_pp.png') }}"
                                                                    alt="" width="20px">
                                                            @elseif($extension['extension'] == 'xlsx')
                                                                <img src="{{ asset('assets/img/icons/icono_xls.png') }}"
                                                                    alt="" width="20px">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#visor_imagen"
                                                                data-bs-record-title="{{ $file->name }}"
                                                                data-bs-record-extension="{{ $extension['extension'] }}"
                                                                data-bs-record-img="{{ asset('storage/' . $folders->name . '/' . $file->name) }}"
                                                                style="color: black">
                                                                {{ $file->name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $file->created_at->format('j F, Y, g:i A') }}</td>
                                                        <td>
                                                            @can('files.destroy')
                                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#confirm-delete"
                                                                    data-bs-record-id="{{ $file->id }}"
                                                                    data-bs-record-title="{{ 'el archivo ' }}{{ $file->name }}"
                                                                    data-bs-action="{{ route('files.destroy', $file) }}"
                                                                    title="{{ __('Delete File') }}"><i
                                                                        class="far fa-trash-alt me-2"></i>@lang('Delete')</a>
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
@section('modal')
    @include('modales.folder')
    @include('modales.edit_folder')
    @include('modales.upload')
    @include('modales.visor_img')
    @include('modales.eliminar')
@endsection
@section('js')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    @include('my_unit.folders.js')
@endsection
