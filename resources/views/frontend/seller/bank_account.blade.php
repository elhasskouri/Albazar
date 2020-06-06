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
                                        {{__('Bank Accounts')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li><a href="{{ route('seller.bank_account') }}">{{__('Bank Account')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <a class="dashboard-widget text-center plus-widget mt-4 d-block" href="{{ route('seller.bank_accounts.upload')}}">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{ __('Add New Account') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="card no-border mt-4">
                            <div>
                                <table class="table table-sm table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Bank Name')}}</th>
                                            <th>{{__('Bank Adresse')}}</th>
                                            <th>{{__('IBAN')}}</th>
                                            <th>{{__('Published')}}</th>
                                            <th>{{__('Options')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($banks as $key => $bank)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td><a href="{{ route('product', $bank->userName) }}" target="_blank">{{ __($bank->userName) }}</a></td>
                                               
                                                <td>{{ $bank->bankName }}</td>
                                                <td>{{ $bank->bankAdresse }}</td>
                                                <td>{{ $bank->iBane }}</td>

                                                <td><label class="switch">
                                                    <input onchange="update_published(this)" value="{{ $bank->id }}" type="radio" name="radio" <?php if($bank->statut == 1) echo "checked";?> >
                                                    <span class="slider round"></span></label>
                                                </td>
                                                <td> 
                                                    <div class="dropdown">
                                                        <button class="btn" type="button" id="dropdownMenuButton-{{ $key }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton-{{ $key }}">
                                                            <a href="{{route('seller.bank_accounts.edit', encrypt($bank->id))}}" class="dropdown-item">{{__('Edit')}}</a>
                                                            <button onclick="confirm_modal('{{route('bank_accounts.destroy', $bank->id)}}')" class="dropdown-item">{{__('Delete')}}</button>
                                                            <!--
                                                            <a href="{{route('products.duplicate', $bank->id)}}" class="dropdown-item">{{__('Duplicate')}}</a>
                                                            -->
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">

        function update_published(el){
            if(el.checked){
                var statut = "1";
            }
            else{
                var statut = "0";
            }
            $.post('{{ route('bank_accounts.published') }}', {_token:'{{ csrf_token() }}', id:el.value, statut:statut}, function(data){
                if(data == 1){
                    showFrontendAlert('success', 'Published products updated successfully');
                }
                else{
                    showFrontendAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>

@endsection


