@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Add Your Bank Account')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('seller.products') }}">{{__('Bank Account')}}</a></li>
                                            <li class="active"><a href="{{ route('seller.products.upload') }}">{{__('Add New Bank Account')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="" action="{{route('banks_account.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
                            @csrf
                    		<input type="hidden" name="added_by" value="seller">

                            
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Bank Account')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Full name')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="" min="0" value="" step="0.01" class="form-control mb-3" name="name" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Bank Adresse')}} </label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="" min="0" value="" step="0.01" class="form-control mb-3" name="bankAdresse" placeholder="Bank Adresse">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Bank Name')}}<span class="required-star">*</span></label>
                                        </div>

                                       
                                        <div class="col-10">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" name="bank_name" data-minimum-results-for-search="Infinity">
                                                    @foreach($banksName as $bankName)
                                                    <option value="{{$bankName}}">{{$bankName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="quantity">
                                        <div class="col-md-2">
                                            <label>{{__('International Bank Account Number(IBAN)')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="" max="" value="" step="1" class="form-control mb-3" name="iBane" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="sku_combination">

                                        </div>
                                    </div>
                                </div>
                            </div>

                         
                            
                           
                            <div class="form-box mt-4 text-right">
                                <button type="submit" class="btn btn-styled btn-base-1">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->


@endsection


