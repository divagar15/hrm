@extends('layouts.master')
 <?php
 $baseUrl    = Config::get('local.baseUrl');
 $holidayType = Config::get('local.holiday_type');
 ?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Requested Loan Cheque Issue</span>
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
                          Loan
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Requested Loan Cheque Issue</li>
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
                        <a class="btn btn-warning btn-xs has-tooltip confirm-cancel" data-placement="top" data-original-title="Back" href="{{ URL::to('staff/loans/') }}">Back</a>
                        </div>
                        </div>
                        </div>  
                      <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Requested Loan Cheque Issue</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('staff/cheque-issue/'.$id) }}" name="frmstaffloan" id="frmstaffloan" method="post" style='margin-bottom: 0;'>
                            
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='emp_name'>Employee Name With Designation</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" disabled data-rule-required='true' id='emp_name' name='emp_name' type='text' value="{{ ucfirst($view->emp_name)." - ".ucfirst($view->user_type) }}">
                             </div>
                          </div>

                            <div class='form-group'>
                             <label class='control-label col-sm-3' for='request_date'>Request Date</label>
                             <div class='col-sm-6 controls input-group'>
                               <input class='form-control datepicker-input' disabled data-rule-required='true' id='request_date' name='request_date' data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value="{{ date('d-m-Y',strtotime($view->request_date)) }}">
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
                               <input class="form-control" disabled data-rule-required='true' data-rule-number='true' data-rule-minlength="2" data-rule-maxlength="9"  id='amount' name='amount' placeholder='Amount Requested' type='text' value="{{ $view->loan_amount }}">
                             </div>
                          </div>

                           <div class='form-group'>
                             <label class='control-label col-sm-3' for='installment'>Installment Terms</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" disabled data-rule-required='true' data-rule-number='true' data-rule-minlength="1" data-rule-maxlength="3"  id='installment' name='installment' placeholder='Installment Terms' type='text' value="{{ $view->installment_terms }}">
                             </div>
                          </div>

                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='approve_date'>Approved Date</label>
                             <div class='col-sm-6 controls input-group'>
                               <input class='form-control datepicker-input' disabled data-rule-required='true' id='approve_date' name='approve_date' data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value="@if($view->approve_date!=NULL) {{ date('d-m-Y',strtotime($view->approve_date)) }} @endif">
                               <span class="input-group-addon">
                                       <span class="icon-calendar"  data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                               </span>
                             </div>
                              <div class='col-sm-9 pull-right'> 
                                    <span class="help-block has-error" for="approve_date"></span>
                              </div>
                          </div>

                           <?php
                              $deduct_month = '';
                              if($view->deduction_start_month!=0 && $view->deduction_start_year!=0) {
                                $month = date('M', mktime(0, 0, 0, $view->deduction_start_month, 1, 2000));
                                $year  = $view->deduction_start_year;
                                $deduct_month = $month."-".$year;
                              }
                             ?>

                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='deduction'>Loan Deduction Starting Month</label>
                             <div class='col-sm-6 controls input-group'>
                               <input class='form-control datepicker-input' disabled data-rule-required='true' id='deduction' name='deduction' data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value="{{ $deduct_month }}">
                               <span class="input-group-addon">
                                       <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                               </span>
                             </div>
                              <div class='col-sm-9 pull-right'> 
                                    <span class="help-block has-error" for="deduction"></span>
                              </div>
                          </div>

                         <div class='form-group'>
                             <label class='control-label col-sm-3' for='bank'>Bank Name</label>
                             <div class='col-sm-6 controls'>
                              <select class="form-control" data-rule-required='true' id='bank' name='bank' disabled>
                                @if(!empty($account))   
                                  @foreach($account as $acc)
                                    <?php
                                      if($view->bank==$acc->id) {
                                        $selected = 'selected';
                                      } else {
                                        $selected = '';
                                      }
                                    ?>
                                    <option value="{{ $acc->id }}" {{ $selected }}>{{ ucwords($acc->level4_name) }}</option>
                                  @endforeach
                                @endif
                              </select>
                             </div>
                          </div>

                           <div class='form-group'>
                             <label class='control-label col-sm-3' for='cheque'>Cheque No</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" disabled data-rule-required='true' data-rule-minlength="2" id='cheque' name='cheque' placeholder='Cheque No' type='text' value="{{ $view->cheque_no }}" >
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

@stop