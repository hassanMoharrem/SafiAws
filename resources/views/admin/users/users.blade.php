@extends('admin.layouts.app')
@section('content')
    <div id="app" class="p-3">
        <users
            users_data="{{ route('api.admin.users.DataUsers') }}"
            users_add="{{ route('api.admin.users.AddUser') }}"
            users_edit="{{ route('api.admin.users.UpdateUser','') }}"
            users_delete="{{ route('api.admin.users.DeleteUser','') }}"
            users_show="{{ route('api.admin.users.ShowUser','') }}"
            user_show="{{ route('admin.user.show','' )}}"
            lang="{{ app()->getLocale() }}"
        ></users>
    </div>
@endsection
