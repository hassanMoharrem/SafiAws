@extends('admin.layouts.app')
@section('content')
    <div id="app" class="p-3">
        <update_phase
            station_name = "{{ $parameters['station']->name }}"
            station_id = "{{ $parameters['station']->id }}"
            phases_data = "{{ route('api.admin.phases.data','') }}"
            phase_add = "{{ route('api.admin.phases.store','') }}"
            phase_delete = "{{ route('api.admin.phases.delete','') }}"
            lang="{{ app()->getLocale() }}"
        ></update_phase>
    </div>
@endsection
