@extends('layouts.master')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">Create new role</h4>
                                <br>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="input-sizes-preview">
                                        <form action="{{ route('roles.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Name Role</label>
                                                <input type="text" name="name"
                                                       id="example-input-normal" class="form-control"
                                                       placeholder="Name">
                                                @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Permission</label>
                                                <br/>
                                                @foreach($permission as $value)
                                                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                                        {{ $value->name }}</label>
                                                    <br/>
                                                @endforeach
                                                @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- /.card-body -->
                                            <div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div> <!-- end preview-->

                                </div> <!-- end tab-content-->

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
@endsection
