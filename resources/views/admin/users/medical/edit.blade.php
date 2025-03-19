@extends('layouts.base_admin')

@section('content')
    <div class="card p-3">
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Medical') . ': ' . $medical->name }}</h2>
                <div class="col-12" align="right">
                    @can('medicals.index')
                        <a href="{{ route('medicals.index') }}" class="btn btn-info"><i
                                class=" uil-history-alt"></i>&nbsp;{{ __('Back') }}</a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Medical Details') }}</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="bordered-justified-tabs-preview">
                                <ul class="nav nav-tabs nav-justified nav-bordered mb-3">
                                    <li class="nav-item">
                                        <a href="#detail_basic-b2" data-bs-toggle="tab" aria-expanded="false"
                                            class="nav-link active">
                                            <span class="d-none d-md-block">{{ __('Detail Basic') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#file-b2" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                            <span class="d-none d-md-block">{{ __('Schedules') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#settings-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            <span class="d-none d-md-block">{{ __('Appointments') }}</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane show active" id="detail_basic-b2">
                                        @include('admin.users.medical.detail_basic')
                                    </div>
                                    <div class="tab-pane " id="file-b2">
                                        @include('admin.users.medical.schedule')
                                    </div>
                                    <div class="tab-pane" id="settings-b2">
                                        {{-- @include('admin.users.patient.folders.appointments') --}}
                                    </div>
                                </div>
                            </div> <!-- end preview-->
                        </div> <!-- end tab-content-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('modales.eliminar')
    @include('modales.schedule')
    {{-- @include('modales.upload') --}}
@endsection
@section('script')
    @include('admin.users.medical.js')
@endsection
