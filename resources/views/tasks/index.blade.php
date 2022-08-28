@extends('layouts.master')
@section('content')
    <br>
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                @if (session('success-create'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success-create') }}
                    </div>
                @endif
                @if (session('success-edit'))
                    <div class="alert alert-info">
                        {{ session('success-edit') }}
                    </div>
                @endif
                @if (session('success-delete'))
                    <div class="alert alert-danger">
                        {{ session('success-delete') }}
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif
                @include('sweetalert::alert')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Table Tasks</h4>
                        <div class="content-header">
                            <a href="{{ route(('tasks.create')) }}" class="btn btn-success">Add new task</a>
                        </div>
                        <br>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="table-head-preview">
                                <div class="table-responsive-sm">
                                    <div class="app-search dropdown d-none d-lg-block">
                                        <table class="table table-bordered" id="yajra-datatable">
                                            <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Title</th>
                                                <th>Assigned to</th>
                                                <th>Client</th>
                                                <th>deadline</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end preview-->
                            </div> <!-- end tab-content-->

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
        </div>

@endsection
