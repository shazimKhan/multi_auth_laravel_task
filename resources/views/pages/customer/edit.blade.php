@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @include('layouts.flash-message');
                <div class="card-header"> Edit Customer</div>

                <div class="card-body">
                    
                    <form method="post" action='{{ route('admin.customers.update',$customer->id) }}'>
                       @method('put')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $customer->name }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" readonly value="{{$customer->user_name}}"  autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : $customer->email }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Change Status') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                  <option value="">Select Status</option>
                                  <option value="active" @if($customer->is_active === 1)  selected @endif>Active</option>
                                  <option value="inactive"  @if($customer->is_active === 0)  selected @endif>In Active</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                            <div class="col-md-4 ">
                                <button type="button" class="btn btn-danger btn-delete">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                    </form>
                     <form id="deleteCustomeForm" method="post" action='{{ route('admin.customers.destroy',$customer->id) }}'>
                        @method('delete')
                        @csrf
                    </form>
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