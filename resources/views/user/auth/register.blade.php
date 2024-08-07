@extends('user.layouts.guest')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center all-login min-vh-100">
            <div class="col-md-5 text-center">
                <div class="rounded-30 shadow-login p-3 mt-0 bg-main">
                    <img src="{{ asset('assets/images/logo.jpeg') }}" class="bg-main mn-t-5 mb-3 contain rounded-circle p-2 shadow-login" alt="Manea" width="75px" height="75px">
                    <div class="text-center">
                        <form  method="post" action="{{ route('user.register.store') }}" enctype="multipart/form-data"
                              class="mx-2">
                            @csrf
                            @error("Error")
                            <div class="text-danger font-12 mt-2 text-start">{{ $errors }}</div>
                            @enderror
                            <div class="form-group mb-0 text-center">
                                <div id="file-upload-filename"
                                     class="text-right text-truncate w-75 name-file-upload position-absolute"></div>
                                <label for="file-upload-communication-comments-create"
                                       class="btn text-muted text-center p-1 mb-0 mx-auto position-relative bg-image-border p-0 bg-sub shadow-sm">
                                    <img id="selected-image" class="w-100 h-100 object-fit-cover" style="display:none;" src="" alt="">
                                </label>
                                <small class="text-label d-block py-2 font-12 fw-light">Click to Add Your Image</small>

                                <input type="file" onchange="selectedFile(event)" name="image" value="{{ old('image') }}" class="input-file start-0 file-upload-communication-comments-create"
                                       id="file-upload-communication-comments-create"/>
                                <div class="file-upload-filename-communication-comments-create mx-auto w-100 text-truncate"></div>
                               @error('image')
                                <span class="text-danger font-12 fw-light">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group mb-3 text-start">
                                <label class="fw-400 text-label font-14">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control shadow-input mt-2 border-transparent bg-sub font-12 text-white">
                                @error('name')
                                <span class="text-danger font-12 fw-light">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 text-start">
                                <label class="fw-400 text-label font-14">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="form-control shadow-input mt-2 border-transparent bg-sub font-12 text-white">
                                @error('email')
                                <span class="text-danger font-12 fw-light">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 text-start">
                                <label class="fw-400 text-label font-14">Password</label>
                                <input type="password" name="password" value="{{ old('password') }}"
                                       class="form-control shadow-input mt-2 border-transparent bg-sub font-12 text-white">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>

                                @enderror
                            </div>
                            <div class="text-center my-2">
                                <button type="submit"
                                        class="btn px-4 bg-button font-14 text-label rounded-10 border-0">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_code')

    <script>

{{--        @if($errors->has('image') || old('image'))--}}
{{--            alert(123)--}}
{{--        document.getElementById("selected-image").src= URL.createObjectURL(<?php old('image') ?>)--}}
{{--            document.getElementById('selected-image').style.display = 'block';--}}

{{--        @endif--}}

        function selectedFile(e) {
            let image = e.target.files[0];
            document.getElementById("selected-image").src= URL.createObjectURL(image);
            // Show the image
            document.getElementById('selected-image').style.display = 'block';
        }
    </script>
@endsection

