@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('flash_deals.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Flash Deal Products')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Product attribut')}}</h3>
    </div>
    <div class="panel-body">
   
        <form class="form-horizontal" action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Field Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Required')}}</label>

                    <div class="col-sm-10">
                          <label class="switch" style="margin-top: 7px !important; ">
                            <input onchange="update_published(this)"  type="checkbox" name="checkbox"> 
                            <span class="slider round"></span>
                          </label>

                    </div>

                </div>

                 <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Status')}}</label>

                    <div class="col-sm-10">
                          <label class="switch " style="margin-top: 7px !important;">
                            <input onchange="update_published(this)"  type="checkbox" name=""> 
                            <span class="slider round"></span>
                          </label>

                    </div>

                </div>
        
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Order')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="meta_title" placeholder="{{__('Meta Title')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">{{__('Type')}}</label>
                    <div class="col-sm-10 ">
                     	<select class="form-control selectpicker" name="bank_name" data-minimum-results-for-search="Infinity">
                                                    
                         <option value="fgdtg">textBox</option>
                         <option value="fgdtg">chechobx</option>
                         <option value="fgdtg">textarea</option>
                         <option value="fgdtg">radionbutton</option>
                                                    
                        </select>
                    </div>
                </div>

            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>

    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">
        function update_flash_deal_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('flash_deals.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
