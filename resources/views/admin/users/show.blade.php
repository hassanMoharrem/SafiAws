@extends('admin.layouts.app')
@section('content')
    <div id="app" class="p-3">
        <user_show
            user_name = "{{ $user->name }}"
            user_id = "{{ $user->id }}"
            dessarts_data = "{{ route('api.admin.stations.data','') }}"
            dessert_add = "{{ route('api.admin.stations.store') }}"
            dessert_delete = "{{ route('api.admin.stations.delete','') }}"
            stations_show = "{{ route('admin.update.index','') }}"
            lang="{{ app()->getLocale() }}"
        ></user_show>
    </div>
@endsection
