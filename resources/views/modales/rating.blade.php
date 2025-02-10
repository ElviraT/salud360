<div class="modal fade" id="actionModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="{{ route('ratings.store') }}" id="form-enviar" method="post">

                <input type="hidden" id="method" name="_method" value="" />
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_student" name="id_student" value=""
                        class="modal_registro_student_id" />
                    <div class="row">
                        <div class="col-12 mb-2">
                            <p><strong>@lang('Teacher'):&nbsp;</strong><span id="teacher"></span></p>
                            <p> <strong>@lang('Grade'){{ ' / ' }}@lang('Group'):&nbsp;</strong><span
                                    id="gg"></span></p>
                            <p><strong>@lang('Matter'):&nbsp;</strong><span id="matter"></span></p>
                            <input type="hidden" id="id_matter" name="id_matter">
                            <input type="hidden" id="id_grade" name="id_grade">
                            <input type="hidden" id="id_group" name="id_group">
                            <input type="hidden" id="id_teacher" name="id_teacher">
                        </div>
                        <hr>
                        <div class="col-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Rating')</label>
                                <input type="number" step="0.01" name="rating" id="rating" class="form-control"
                                    placeholder="@lang('Enter Rating')">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Absence')</label>
                                <input type="number" step="1" name="absence" id="absence" class="form-control"
                                    placeholder="@lang('Enter Absence')">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="input-block mb-0">
                                <label>@lang('Comment')</label>
                                <input type="text" name="comment" id="comment" class="form-control"
                                    placeholder="@lang('Enter Comment')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-back cancel-btn me-2">@lang('Close')</button>

                    <button type="submit" data-bs-dismiss="modal"
                        class="btn btn-primary paid-continue-btn">@lang('Submit')</button>

                </div>
            </form>
        </div>
    </div>
</div>
