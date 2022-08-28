@extends('layouts.master')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <br>
                <div class="mb-3">
                    <label for="example-input-normal" class="form-label">Name Role</label>
                    <input type="text" name="name" value=" {{ $role->name }}" disabled
                           id="example-input-normal" class="form-control">
                </div>

                <div class="mb-3">
                    <div class="card">
                        <div class="card-body">
                            <label for="example-input-normal" class="form-label">Permissions</label>

                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <ul class="list-group">
                                        <li class="list-group-item" disabled="">{{$v->name}}</li>
                                    </ul>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
    </div>
@endsection



