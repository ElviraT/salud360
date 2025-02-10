@extends('layouts.base_admin')
@section('content')
    <div class="max-w-2xl">
        <div class="grid md:grid-cols-8 grid-cols-1 mt-4">
            <div class="md:col-span-5">
                <div class="md:col-span-2">
                    <form method="post" action="{{ route('createMeeting') }}">
                        {{ csrf_field() }}
                        <button type="submit" class="mt-1 btn btn-primary">{{ __('Create New Meeting') }}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
