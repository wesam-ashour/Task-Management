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
                        <h4 class="header-title">{{ __('sentence.List_Roles') }}</h4>
                        <br>
                        <div class="content-header">
                            <a href="{{ route(('roles.create')) }}" class="btn btn-primary">{{ __('sentence.Add_new_role') }}</a>
                        </div>
                        <br>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="table-head-preview">
                                <div class="table-responsive-sm">
                                    <table class="table table-centered mb-0">
                                        <thead class="table-dark">
                                        <tr>
                                            <th>{{ __('sentence.Name') }}</th>
                                            <th>{{ __('sentence.Actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @forelse($roles as $key => $role)
                                                <?php $i++; ?>
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-dark"
                                                       href="{{ route('roles.show',$role->id) }}">{{ __('sentence.Show') }}</a>
                                                    @can('role-edit')
                                                        <a class="btn btn-sm btn-info"
                                                           href="{{ route('roles.edit',$role->id) }}">{{ __('sentence.Edit') }}</a>
                                                    @endcan
                                                    @can('role-delete')
                                                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit( __('sentence.Delete') , ['class' => 'btn btn-sm btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <h4 class="header-title">{{ __('sentence.Addـnewـuser') }}No users</h4>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {{ $roles->links() }}
                                </div> <!-- end table-responsive-->
                            </div> <!-- end preview-->
                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>

@endsection
