@extends('layouts.main-layout')

@section('title', 'Home Page')

@section('content')
    <form id="createUserForm" action="{{ route('users.store') }}" method="POST">
        @csrf
        <h1>Create User</h1>
        <hr>
        <x-text-input id="email" name="email" title="Email" placeholder="Enter your email" :isObscure="false" />
        <br>
        <x-text-input id="username" name="username" title="Username" placeholder="Enter your username" :isObscure="false" />
        <br>
        <x-text-input id="password" name="password" title="Password" placeholder="Enter your password" :isObscure="true" />
        <br>
        <input type="submit" name="" id="">
    </form>

    <script>
        $("#createUserForm").on('submit', function(e) {
            e.preventDefault();
            $('.error').text('');
            $('.form-group').removeClass('border--red');
            var action = $(this).attr('action');
            var formData = $(this).serialize();
            var method = $(this).attr('method');

            //Can keep this null if you dont want to redirect after form submission
            var redirectRoute = "{{ route('users.index') }}";
            storeData(action, method, formData, null, null, redirectRoute);
        });
    </script>

@endsection
