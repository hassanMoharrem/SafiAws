@extends('user.layouts.guest')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center all-login min-vh-100">
            <div class="col-md-5 text-center">
                <div class="rounded-30 shadow-login p-3 mt-0 bg-main">
                    <img src="{{ asset('assets/images/logo.jpeg') }}" class="bg-main mn-t-5 mb-3 contain rounded-circle p-2 shadow-login" alt="Manea" width="75px" height="75px">
                    <div class="text-center">
                        <form method="post" action="{{ route('user.login.store') }}" novalidate>
                            @error("Error")
                            <div class="text-danger font-12 mt-2 text-start">{{ $message }}</div>
                            @enderror
                            @csrf
                            <div class="mb-4 text-start">
                                <label for="email" class="form-label font-14">Email</label>
                                <input class="form-control shadow-input padding-input mt-2 border-transparent bg-sub text-white font-14" id="email" value="{{ old('email') }}" name="email" type="email" placeholder="Email" aria-label="default input example">
                                @error('email')
                                <div class="text-danger font-12 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 text-start">
                                <label for="password" class="form-label font-14">Password</label>
                                <input class="form-control shadow-input padding-input mt-2 border-transparent bg-sub text-white font-14" id="password" name="password" type="password" placeholder="Password" aria-label="default input example">
                                @error('password')
                                <div class="text-danger font-12 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 text-start api">
                                <label class="font-14 checkbox-wrap checkbox-info">
                                    <input class="align-middle" type="checkbox">
                                    <span class="checkmark shadow-sm"></span>
                                    Remember me
                                </label>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn font-14 ms-1 mb-0 text-center bg-button py-2 rounded-pill ps-3 pe-2 text-white"><span class="font-14 mb-0 text-white align-middle">login</span><i class="fa-solid fa-arrow-right align-middle text-white ms-2 mb-0 font-14"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

