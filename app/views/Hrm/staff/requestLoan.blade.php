@extends('layouts.master')
 <?php
 $baseUrl     = Config::get('local.baseUrl');
 $userRole   = Session::get('role');
 $userId     = Session::get('id');
 $firstName   = Session::get('log_name');
 ?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Request Loan</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                            <i class='icon-folder-open '></i>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li>
                          HRM
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li><a href="{{ URL::to('staff/appliedloans') }}">Applied Loan</a></li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Request Loan</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class='col-sm-12'>
                       <div class="row">
                        <div class="col-sm-12">
                        <div class="pull-right">
                        <a class="btn btn-warning btn-xs has-tooltip" data-placement="top" data-original-title="Back" href="{{ URL::to('staff/appliedloans') }}">Back</a>
                        </div>
                        </div>
                        </div>  
                      <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Request Loan</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('staff/request-loan') }}" name="frmstaffloan" id="frmstaffloan" method="post" style='margin-bottom: 0;'>
                          
                          <div class='form-group'>
                                <label class='control-label col-sm-3' for='emp_name'>Employee Name</label>
                                <div class='col-sm-6 controls'>
                                    <input type="hidden" id="h_count" name="h_count" value='0' />
                                    @if($userRole == 1)
                                        <select id="emp_id" class="form-control select2" name="emp_id" data-rule-required="true">
                                            <option value="">Select Employee Name</option>
                                            @if(!empty($emp_list))
                                              @foreach($emp_list as $clist) 
                                            <option value="{{ $clist->id }}">{{ ucwords($clist->emp_name) }}</option>
                                              @endforeach
                                            @endif
                                        </select>
                                    @else
                                        <input type="hidden" id="emp_id" name="emp_id" value='{{ $userId }}' />
                                        <label class='control-label col-sm-3' for='emp_name'>{{ ucwords($firstName) }}</label>
                                    @endif
                                </div>
                             </div>

                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='request_date'>Request Date</label>
                             <div class='col-sm-6 controls input-group'>
                               <input class='form-control date-pick' autocomplete="off" data-rule-required='true' id='request_date' name='request_date' data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value="{{ date('d-m-Y') }}">
                               <span class="input-group-addon">
                                       <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                               </span>
                             </div>
                              <div class='col-sm-9 pull-right'> 
                                    <span class="help-block has-error" for="request_date"></span>
                              </div>
                          </div>

                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='amount'>Amount Requested</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' data-rule-number='true' data-rule-minlength="2" data-rule-maxlength="9"  id='amount' name='amount' placeholder='Amount Requested' type='text' value="">
                             </div>
                          </div>

                           <div class='form-group'>
                             <label class='control-label col-sm-3' for='installment'>Installment Terms</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' data-rule-number='true' data-rule-minlength="1" data-rule-maxlength="3"  id='installment' name='installment' placeholder='Installment Terms' type='text' value="">
                             </div>
                          </div>
                       
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar" id="edit-mode">
                                          <button class="btn-primary btn" type="submit" id="add-btn">Submit</button>
                                          <button class="btn" type="reset">Reset</button>
                                      </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                      </div>
                    </div>
        </div>
      </div>
    </div>
@include('includes.jscript')
<script type="text/javascript">
      $(document).ready(function(){
        $('.date-pick').datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true,
         });
      });
</script>
@stop