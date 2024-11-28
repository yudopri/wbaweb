@extends('adminlte::page')

@section('title', 'Add New Employee')

@section('content_header')
    <h1>Add New Employee</h1>
@stop

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.employee.form', ['employee' => null])

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@stop
