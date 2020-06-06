@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Bank Account Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('bank_accounts.update', $banks->id) }}" 
            method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" value="{{$banks->userName}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{__('User Name')}}</label>
                    <div class="col-sm-9">
                        <select class="form-control selectpicker" name="seller_id"  data-minimum-results-for-search="Infinity">
                             <option value="{{$banks->seller_id}}">
                                @php
                                    $userszd = DB::table('users')
                                                 ->select('name')
                                                 ->where('id', '=', $banks->seller_id)

                                                 ->get();
                                    $userszd1 = strpos($userszd, ':', 5);
                                    $userszd3 = strpos($userszd, '}', 5);
                                    $userszd2 = substr($userszd, $userszd1+2);

                                    $userszd10 = strlen($userszd2) - 3;
                                    $userszdfinish = substr($userszd, $userszd1+2,$userszd10);
                                                
                                @endphp
                                {{ $userszdfinish }}
                                
                            </option>
                         @foreach($Users as $User)
                         
                         <option value="{{$User->id}}">{{$User->name}}</option>
                         @endforeach                       
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{__('Bank Name')}}</label>
                    <div class="col-sm-9">
                        <select class="form-control selectpicker" name="bank_name" data-minimum-results-for-search="Infinity">
                         @foreach($banksName as $Name)
                         <option value="{{$Name}}">{{$Name}}</option>
                         @endforeach                       
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{__('bankAdresse')}}</label>
                    <div class="col-sm-9">
                        <input type="" placeholder="{{__('Bank Adress')}}" id="password" 
                        name="bankAdresse" class="form-control" value="{{$banks->bankAdresse}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{__('IBAN')}}</label>
                    <div class="col-sm-9">
                        <input type="" placeholder="{{__('International Bank Account Number(IBAN)')}}" id="password" name="iBane" 
                         class="form-control" value="{{$banks->iBane}}">
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
