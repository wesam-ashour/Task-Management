@extends('layouts.master')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <br>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">{{ __('sentence.Editـclientـinfo') }}</h4>
                                <br>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="input-sizes-preview">
                                        <form action="{{ route('clients.update',$client->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="example-input-normal" class="form-label">
                                                            {{ __('sentence.Name_Client') }}
                                                        </label><span
                                                            style="color: red"> ({{ __('sentence.english') }})</span>
                                                        <input type="text" name="company_en"
                                                               id="example-input-normal" class="form-control"
                                                               placeholder="Name" value="{{ $client->getTranslation('company','en') }}">
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
                                                               placeholder="Name" value="{{ $client->getTranslation('vat','en') }}">
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
                                                               placeholder="Name" value="{{ $client->getTranslation('address','en')}}">
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
                                                               placeholder="Name" value="{{ $client->getTranslation('company','ar')}}">
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
                                                               placeholder="Name" value="{{ $client->getTranslation('vat','ar')}}">
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
                                                               placeholder="Name" value="{{ $client->getTranslation('address','ar') }}">
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
