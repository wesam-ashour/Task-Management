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

                                <h4 class="header-title">{{ __('sentence.Add_new_client') }}</h4>
                                <br>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="input-sizes-preview">
                                        <form action="{{ route('clients.store') }}" method="POST">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">
                                                            {{ __('sentence.Name_Client') }}
                                                        </label><span
                                                            style="color: red"> ({{ __('sentence.english') }})</span>
                                                        <input type="text" name="company_en"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="Name">
                                                        @error('company_en')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal"
                                                               class="form-label">{{ __('sentence.Vat_Client') }}</label>
                                                        <span style="color: red"> ({{ __('sentence.english') }})</span>
                                                        <input type="text" name="vat_en"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="Name">
                                                        @error('vat_en')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal"
                                                               class="form-label">{{ __('sentence.Address_Client') }}</label><span
                                                            style="color: red"> ({{ __('sentence.english') }})</span>
                                                        <input type="text" name="address_en"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="Name">
                                                        @error('address_en')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                </div> <!-- end col -->

                                                <div class="col-lg-6">


                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">
                                                            {{ __('sentence.Name_Client') }}
                                                        </label><span
                                                            style="color: red"> ({{ __('sentence.arabic') }})</span>
                                                        <input type="text" name="company_ar"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="Name">
                                                        @error('company_ar')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal"
                                                               class="form-label">{{ __('sentence.Vat_Client') }}</label>
                                                        <span style="color: red"> ({{ __('sentence.arabic') }})</span>
                                                        <input type="text" name="vat_ar"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="Name">
                                                        @error('vat_ar')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="example-input-normal"
                                                               class="form-label">{{ __('sentence.Address_Client') }}</label><span
                                                            style="color: red"> ({{ __('sentence.arabic') }})</span>
                                                        <input type="text" name="address_ar"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="Name">
                                                        @error('address_ar')
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
                                    </div>
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
