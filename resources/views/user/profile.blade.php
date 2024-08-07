@extends('user.layouts.app')
@section('content')

    <div id="app" class="p-3">
        <profile
            user_data="{{ route('user.profile.show', auth()->guard('web')->id()) }}"
            user_data_update="{{ route('user.profile.update') }}"
        >
        </profile>
    </div>
@endsection
