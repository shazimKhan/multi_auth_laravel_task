@extends('layouts.auth')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              @include('layouts.flash-message');
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-2 offset-md-10">
                      <a href="{{route('admin.customers.create')}}" class="btn btn-success text-right">Add Customer</a>
                    </div>
                </div>
                    @include('include/customer-list');
                </div>
            </div>
        </div>
    </div>
</div>
 @endsection
 @section('js')
    <script>
       const customerUrl = "{{route('admin.customer.list')}}";

       const customerEditUrl = "customers/";
    </script>
   <script src="{{ asset('js/custom/admin/customer.js') }}" defer></script>
@stop