<div class="col-12">
    <div class="page-header">
        <div class="content-page-header">
            <div class="col-12" align="right">
                @can('schedules.store')
                    <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                        data-bs-action="{{ route('schedules.store') }}" data-bs-target="#modal_schedule"><i
                            class="uil-plus-circle"></i>&nbsp;{{ __('Add Schedule') }}</a>
                @endcan
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="schedule" class="table dt-responsive nowrap w-100" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>@lang('Day')</th>
                                    <th>@lang('Start Time') </th>
                                    <th>@lang('End Time')</th>
                                    <th>@lang('Modalidad')</th>
                                    <th width="30">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $item)
                                    <tr>
                                        <td>{{ $item->day->name }}</td>
                                        <td>{{ $item->start_hour }}</td>
                                        <td>{{ $item->end_hour }}</td>
                                        <td>{{ $item->type_consulting }}</td>
                                        <td>
                                            @can('schedules.edit')
                                                <a href="#" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_schedule" class="btn btn-success me-2"
                                                    data-bs-record-id="{{ $item->id }}"
                                                    data-bs-action="{{ route('schedules.update', $item) }}">
                                                    <i class="uil-edit-alt"></i>
                                                    {{ __('Edit Schedule') }}
                                                </a>
                                            @endcan
                                            @can('schedules.destroy')
                                                <a class="btn btn-danger me-2" data-bs-toggle="modal"
                                                    data-bs-target="#confirm-delete" data-bs-record-id="{{ $item->id }}"
                                                    data-bs-record-title="{{ 'El Horario ' . $item->day->name }}"
                                                    data-bs-action="{{ route('schedules.destroy', $item) }}"
                                                    title="{{ __('Delete Schedule') }}"><i
                                                        class="uil-trash-alt"></i>@lang('Delete')
                                                </a>
                                            @endcan
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
