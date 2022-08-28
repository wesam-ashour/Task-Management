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
                        <h4 class="header-title">Table Users</h4>
                        <div class="content-header">
                            <a href="{{ route(('users.create')) }}" class="btn btn-primary">Add new user</a>
                        </div>
                        <br>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="table-head-preview">
                                <div class="table-responsive-sm">
                                    <form method="GET">

                                        <div class="input-group mb-3">

                                            <input

                                                type="text"

                                                name="search"

                                                value="{{ request()->get('search') }}"

                                                class="form-control"

                                                placeholder="Search..."

                                                aria-label="Search"

                                                aria-describedby="button-addon2">

                                            <button class="btn btn-success" type="submit" id="button-addon2">Search
                                            </button>

                                        </div>

                                    </form>
                                    <table class="table table-centered mb-0">
                                        <thead class="table-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @forelse($data as $key => $user)
                                                <?php $i++; ?>
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if(!empty($user->getRoleNames()))
                                                        @foreach($user->getRoleNames() as $v)
                                                            <label class="badge badge-primary-lighten"
                                                                   style="font-size: 14px">{{ $v }}</label>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.edit',$user->id) }}"
                                                       class="btn btn-sm btn-info">
                                                        Edit
                                                    </a>
                                                    @if($user->hasRole('user'))
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                              method="post" onsubmit="return confirm('Are your sure?');"
                                                              style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <h4 class="header-title">No users</h4>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
                                </div> <!-- end table-responsive-->
                            </div> <!-- end preview-->
                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>

@endsection
