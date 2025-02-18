<div class="modal custom-modal modal-lg fade" id="modal_user" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="#" id="form-enviar" method="post" enctype="multipart/form-data" autocomplete="off">

                <input type="hidden" id="method" name="_method" value="" />
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="" class="modal_registro_user_id" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-groups-item">
                                    <h5 class="form-title">@lang('Profile Picture')</h5>
                                    <div class="col-12">
                                        <div class="profile-picture row mb-3">
                                            <div class="upload-profile col-3">
                                                <div class="profile-img">
                                                    <img id="blah" class="avatar" src alt="profile-img"
                                                        width="60%">
                                                </div>
                                                <div class="add-profile">
                                                    <h5>@lang('Upload a New Photo')</h5>
                                                </div>
                                            </div>
                                            <div class="img-upload col-9 mt-4">
                                                <input type="file" name="avatar" id="avatar"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <div class="input-block mb-3">
                                                <label>@lang('Name')</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <div class="input-block mb-3">
                                                <label>@lang('Email')</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="Enter Email Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <div class="input-block mb-3">
                                                <label>@lang('Role')</label>
                                                <select name="roles" id="role_id" class="select2 form-control"
                                                    data-toggle="select2">
                                                    <option>Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"> {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                            <div class="pass-group" id="3">
                                                <div class="input-block">
                                                    <label>@lang('Password')</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control pass-input" autocomplete="new-password">
                                                    <span class="toggle-password feather-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if (Auth::user()->hasRole('SuperAdmin'))
                                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                                <div class="input-block ">
                                                    <label>@lang('Cliente')</label>
                                                    <select class="select2 form-control" data-toggle="select2"
                                                        name="created_by" id="created_by">
                                                        <option>Select</option>
                                                        @foreach ($users as $st)
                                                            <option value="{{ $st->id }}">{{ $st->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="created_by" id="created_by"
                                                value="{{ auth()->user()->id }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-secondary cancel-btn me-2">{{ __('Close') }}</button>
                    <button type="submit" data-bs-dismiss="modal"
                        class="btn btn-primary paid-continue-btn">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
