@extends('layouts.master')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">{{ __('sentence.dashboard') }}</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-5 col-lg-6">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-account-multiple widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0"
                                            title="Number of Customers">{{ __('sentence.users') }}</h5>
                                        <h3 class="mt-3 mb-3">{{ $user::whereHas("roles", function($q){ $q->where("name", "user"); })->count() }}</h3>
                                        <p class="mb-0 text-muted">
                                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                                            <span class="text-nowrap">{{ __('sentence.since-last-month') }}</span>
                                        </p>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-lg-6">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-cart-plus widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0"
                                            title="Number of Orders">{{ __('sentence.clients') }}</h5>
                                        <h3 class="mt-3 mb-3">{{$clients}}</h3>
                                        <p class="mb-0 text-muted">
                                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                                            <span class="text-nowrap">{{ __('sentence.since-last-month') }}</span>
                                        </p>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-currency-usd widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0"
                                            title="Average Revenue">{{ __('sentence.projects') }}</h5>
                                        <h3 class="mt-3 mb-3">{{$projects}}</h3>
                                        <p class="mb-0 text-muted">
                                            <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                                            <span class="text-nowrap">{{ __('sentence.since-last-month') }}</span>
                                        </p>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-lg-6">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-pulse widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted fw-normal mt-0"
                                            title="Growth">{{ __('sentence.tasks') }}</h5>
                                        <h3 class="mt-3 mb-3">{{$tasks}}</h3>
                                        <p class="mb-0 text-muted">
                                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                                            <span class="text-nowrap">{{ __('sentence.since-last-month') }}</span>
                                        </p>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div> <!-- end row -->
                    </div> <!-- end col -->

                    <div class="col-xl-7">

                        <!--Tasks-->
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                                <h4 class="header-title mb-2">{{ __('sentence.tasks-list') }}</h4>

                                <div class="todoapp">
                                    <div data-simplebar="" style="max-height: 312px">

                                        @forelse($tasksList as $list)
                                            <p class="notify-details">
                                            <ul class="list-group " id="todo-list">{{$list->title}}</ul>
                                            <form action="{{ url('taskComplete/'. $list->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button name="status" type="submit" class="btn btn-sm btn-info"
                                                        value="closed"> {{ __('sentence.complete_task') }}
                                                </button>
                                                <input name="title" type="hidden" class="btn btn-sm btn-info"
                                                       value="{{$list->title}}">
                                            </form>
                                            </p>
                                        @empty
                                            {{ __('sentence.no_tasks') }}
                                        @endforelse
                                    </div>
                                </div> <!-- end .todoapp-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
@endsection
