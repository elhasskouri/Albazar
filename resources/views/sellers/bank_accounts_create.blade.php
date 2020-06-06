@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Bank Account Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('bank_accounts.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Full Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{__('User Name')}}</label>
                    <div class="col-sm-9">
						<select class="form-control demo-select2-placeholder" name="seller_id" >
                         @foreach($Users as $User)
                         <option value="{{$User->id}}">{{$User->name}}</option>
                         @endforeach                       
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{__('Bank Name')}}</label>
                    <div class="col-sm-9">
						<select class="form-control demo-select2-placeholder" name="bank_name">
                         @foreach($banksName as $Name)
                         <option value="{{$Name}}">{{$Name}}</option>
                         @endforeach                       
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">{{__('Bank Address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Bank Address')}}" id="email"
                         name="bankAdresse" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="password">{{__('IBAN')}}</label>
                    <div class="col-sm-9">
                        <input type="" placeholder="{{__('International Bank Account Number(IBAN)')}}" id="password" name="iBane" class="form-control" required>
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
