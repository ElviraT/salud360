@extends('layouts.base_admin')
@section('content')
    @if (Auth::user()->hasRole('SuperAdmin'))
        <div class="card p-3">
            <div class="page-header">
                <div class="content-page-header">
                    <h2>{{ __('Plans') }}</h2>
                    <div class="col-12" align="right">
                        {{-- @can('plans.store') --}}

                        <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                            data-bs-action="{{ route('plans.store') }}" data-bs-target="#modal_plan"><i
                                class="uil-plus-circle"></i>&nbsp;{{ __('Add Plan') }}</a>

                        {{-- @endcan --}}

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="scroll-vertical-datatable" class="table dt-responsive nowrap w-100"
                                    width="100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Duration') }}</th>
                                            <th width="30">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($plans as $plan)
                                            <tr>
                                                <td>{{ $plan->name }}</td>
                                                <td>{{ $plan->price }}</td>
                                                <td>{{ $plan->duration }}</td>
                                                <td>
                                                    {{-- @can('plans.edit') --}}
                                                    <a href="#" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modal_plan" class="btn btn-success me-2"
                                                        data-bs-record-id="{{ $plan->id }}"
                                                        data-bs-action="{{ route('plans.update', $plan) }}">
                                                        <i class="uil-edit-alt"></i>&nbsp;
                                                        {{ __('Edit Plan') }}
                                                    </a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('plans.destroy') --}}
                                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#confirm-delete"
                                                        data-bs-record-id="{{ $plan->id }}"
                                                        data-bs-record-title="{{ ' El plan ' }}{{ $plan->name }}"
                                                        data-bs-action="{{ route('plans.destroy', $plan) }}"
                                                        title="{{ __('Delete Plan') }}"><i
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
        </div>
    @else
        <div class="page-header">
            <div class="content-page-header">
                <h2>{{ __('Registered Plan') }}</h2>
                <div class="col-12" align="right">
                    {{-- @can('plans.store') --}}

                    <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                        data-bs-action="{{ route('payment.store') }}" data-bs-target="#payment_details"><i
                            class="uil-plus-circle"></i>&nbsp;{{ __('Change Plan') }}</a>

                    {{-- @endcan --}}

                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-4">
                <div class="card card-pricing {{ auth()->user()->plan->name == 'Medio' ? 'card-pricing-recommended' : '' }}"
                    style="max-height: 400px; overflow-y: auto !important;">
                    <div class="card-body text-center">
                        @if (auth()->user()->plan->name == 'Medio')
                            <div class='card-pricing-plan-tag'>{{ __('Recommended') }}</div>
                        @endif

                        <p class="card-pricing-plan-name fw-bold text-uppercase">{{ auth()->user()->plan->name }} </p>
                        <i class="card-pricing-icon ri-user-line text-primary"></i>
                        <h2 class="card-pricing-price">{{ auth()->user()->plan->price }} <span>/
                                {{ auth()->user()->plan->duration }}{{ '/Días' }}</span></h2>
                        <ul class="card-pricing-features">
                            @foreach (auth()->user()->plan->benefits as $item)
                                <li>{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- end Pricing_card -->
            </div>

        </div>
    @endif
@endsection
@section('script')
    @include('admin.plans.js.js')
@endsection
@section('modal')
    @if (Auth::user()->hasRole('SuperAdmin'))
        @include('modales.plans')
        @include('modales.eliminar')
    @else
        @include('modales.payment')
    @endif
@endsection
