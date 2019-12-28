@extends('layouts.main')

@section('content')
    <div class="row mx-auto justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $user->id }}"> 

                        <div class="row">
                            
                            <div class="form-group col-12">
                                <label for="profile" class="col-form-label">Profile</label>
                                <input type="file" class="form-control form-control-file @error('profile') is-invalid @enderror" id="profile" name="profile" accept="image/*" >
                                @error('profile') 
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                                @error('name') 
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
                                @error('email') 
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div class="form-group col-md-6">
                                <label for="address" class="col-form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $user->address }}">
                                @error('address') 
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="born" class="col-form-label">Born</label>
                                <input type="date" class="form-control @error('born') is-invalid @enderror" id="born" name="born" value="{{ $user->born }}">
                                @error('born') 
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hobby" class="col-form-label">Hobby</label>
                                <input type="text" class="form-control @error('hobby') is-invalid @enderror" id="hobby" name="hobby" value="{{ $user->hobby }}">
                                @error('hobby') 
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="col-form-label">Phone</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $user->phone }}">
                                @error('phone') 
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password') 
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation" class="col-form-label">Password Confirmation</label>
                                <input type="password" class="form-control" id="password" name="password_confirmation">
                            </div>
                        </div>
                        <div class="w-100 clearfix mt-3 mb-3">
                            <button class="float-right btn btn-info px-4 text-white" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection