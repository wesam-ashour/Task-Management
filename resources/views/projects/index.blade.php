@extends('layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script>
        function filterText() {
            var rex = new RegExp($('#filterText').val());
            if (rex == "/all/") {
                clearFilter()
            } else {
                $('.content').hide();
                $('.content').filter(function () {
                    return rex.test($(this).text());
                }).show();
            }
        }

        function clearFilter() {
            $('.filterText').val('');
            $('.content').show();
        }
    </script>
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
                        <h4 class="header-title">Table Roles</h4>
                        <div class="content-header">
                            <a href="{{ route(('projects.create')) }}" class="btn btn-primary">Add new project</a>
                        </div>
                        <br>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="table-head-preview">
                                <div class="table-responsive-sm">
                                    <div class="app-search dropdown d-none d-lg-block">
                                        <form>
                                            <label for="example-select" class="form-label">Search</label>
                                            <div class="input-group">

                                                <input type="text" class="form-control dropdown-toggle"
                                                       placeholder="Search..." id="myInput">
                                                <span class="mdi mdi-magnify search-icon"></span>
                                                <button class="input-group-text btn-primary" type="submit">Search
                                                </button>
                                            </div>
                                            <br>
                                            <div>
                                                <label for="example-select" class="form-label">Search With Date</label>
                                                <form action="{{url('search')}}" method="POST">
                                                    @csrf
                                                    <div>
                                                        From <input type="date" class="form-control" id="from"
                                                                    name="from">
                                                        To <input type="date" class="form-control" id="to" name="to">
                                                    </div>
                                                    <br>
                                                    <button class="btn btn-sm btn-success" type="submit" name="search"
                                                            title="search">Search
                                                    </button>
                                                </form>
                                            </div>
                                            <br>
                                        </form>
                                        <table id="table_format" class="table table-centered mb-0">
                                            <label for="example-select" class="form-label">Filter Select</label>
                                            <select id="filterText" class="form-select" onchange="filterText()">
                                                <option selected value="0">No value</option>
                                                <option value="open">open</option>
                                                <option value="in progress">in progress</option>
                                                <option value="blocked">blocked</option>
                                                <option value="cancelled">cancelled</option>
                                                <option value="completed">completed</option>
                                            </select>
                                            <br>
                                            <thead class="table-dark">
                                            <tr>
                                                <th>title</th>
                                                <th>description</th>
                                                <th>deadline</th>
                                                <th>status
                                                </th>
                                                <th>action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="myTable">
                                            <?php $i = 0; ?>
                                            @forelse($projects as $project)
                                                <tr class="content">
                                                    <td>{{ $project->title }}</td>
                                                    <td>{{ $project->description }}</td>
                                                    <td>{{ $project->deadline }}</td>
                                                    <td>{{ $project->status }}</td>
                                                    <td>
                                                        @if($user->id == '1')
                                                            @can('project-edit')
                                                                <a href="{{ route('projects.edit',$project->id) }}"
                                                                   class="btn btn-sm btn-info">
                                                                    Edit
                                                                </a>
                                                            @endcan
                                                            @can('project-delete')
                                                                <form
                                                                    action="{{ route('projects.destroy', $project->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are your sure?');"
                                                                    style="display: inline-block;">
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="_token"
                                                                           value="{{ csrf_token() }}">
                                                                    <input type="submit" class="btn btn-sm btn-danger"
                                                                           value="Delete">
                                                                </form>
                                                            @endcan
                                                        @else
                                                            No actions for this account
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                No Projects Found
                                            @endforelse
                                            </tbody>
                                        </table>
                                        {{--                                    {{ $projects->links() }}--}}
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end preview-->
                            </div> <!-- end tab-content-->

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

@endsection
