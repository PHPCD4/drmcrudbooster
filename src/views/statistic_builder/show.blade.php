@extends('crudbooster::admin_template')
@section('content')

@if(CRUDBooster::myPrivilegeId()==1)
    @include('admin.dashboard.superadmin')
@elseif(CRUDBooster::myPrivilegeId()==2)
    @include('admin.dashboard.admin')
@elseif(CRUDBooster::myPrivilegeId()==3)

    @include('admin.dashboard.customer')

@endif


@endsection
