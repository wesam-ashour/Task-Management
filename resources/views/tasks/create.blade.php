@extends('layouts.master')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <br>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">{{ __('sentence.Add_new_task') }}</h4>
                                <br>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="input-sizes-preview">
                                        <form action="{{ route('tasks.store') }}" method="POST">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">
                                                            {{ __('sentence.Title') }}
                                                        </label><span
                                                            style="color: red"> ({{ __('sentence.english') }})</span>
                                                        <input type="text" name="title_en"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="title">
                                                        @error('title_en')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal"
                                                               class="form-label">{{ __('sentence.Description') }}</label>
                                                        <span style="color: red"> ({{ __('sentence.english') }})</span>
                                                        <input type="text" name="description_en"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="description">
                                                        @error('description_en')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal"
                                                               class="form-label">{{ __('sentence.deadline') }}</label>
                                                        <input type="date" name="deadline"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="deadline">
                                                        @error('deadline')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">
                                                            {{ __('sentence.Assigned to') }}</label>
                                                        <select class="form-select" name="user_id" id="user_id"
                                                                required>
                                                            @foreach($users as $id => $entry)
                                                                <option
                                                                    value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('user_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">
                                                            {{ __('sentence.Client') }}</label>
                                                        <select class="form-select" name="client_id" id="client_id"
                                                                required>
                                                            @foreach($clients as $id => $entry)
                                                                <option
                                                                    value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('client_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                </div> <!-- end col -->

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">
                                                            {{ __('sentence.Title') }}
                                                        </label><span
                                                            style="color: red"> ({{ __('sentence.arabic') }})</span>
                                                        <input type="text" name="title_ar"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="title">
                                                        @error('title_ar')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal"
                                                               class="form-label">{{ __('sentence.Description') }}</label>
                                                        <span style="color: red"> ({{ __('sentence.arabic') }})</span>
                                                        <input type="text" name="description_ar"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="description">
                                                        @error('description_ar')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">
                                                            {{ __('sentence.Project') }}</label>
                                                        <select class="form-select" name="project_id" id="project_id"
                                                                required>
                                                            @foreach($projects as $id => $entry)
                                                                <option
                                                                    value="{{ $id }}" {{ old('project_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('project_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">

                                                            {{ __('sentence.Status') }}</label>
                                                        <select class="form-select" name="status" required>
                                                            @foreach(\App\Models\Task::STATUS as $status)
                                                                <option
                                                                    value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('status')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> <!-- end col -->

                                                <div>
                                                    <button type="submit"
                                                            class="btn btn-primary">{{ __('sentence.submit') }}</button>
                                                </div>
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
