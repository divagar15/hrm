@extends('layouts.master')
 <?php
 $baseUrl    = Config::get('local.baseUrl');
 ?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Configure Leave</span>
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
                          Hrm
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Configure Leave</li>
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
                        <a class="btn btn-warning btn-xs has-tooltip" data-placement="top" data-original-title="Back" href="{{ URL::to('leave/entitled-leave-list') }}">Back</a>
                        </div>
                        </div>
                        </div>  
                      <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Configure Leave</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('leave/add-leave-entitlement') }}" name="frmholiday" id="frmholiday" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='Job_Title'>Job Title</label>
                             <div class='col-sm-6 controls'>
                                 <select name="fkJobTitleId" id="job_title" class="form-control" data-rule-required='true'>
                                    @if(!empty($job_title))
                                     @foreach($job_title as $kjob)
                                     <option value="{{ $kjob->id }}">{{ $kjob->job_title }}</option>
                                     @endforeach
                                    @else
                                    <option value="">-- all Job allocated --</option>
                                    @endif
                                 </select>
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='total_leave'>Total Leave Per annum</label>
                             <div class='col-sm-6 controls'>
                                 <input class="form-control" data-rule-required='true' data-rule-minlength="2"  id='overall_allocated_leave' name='overall_allocated_leave' placeholder='Total Leave Per Annum' type='text' value="">
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='paid_leave'>Paid Leave</label>
                             <div class='col-sm-6 controls'>
                                 <input class="form-control" data-rule-required='true' data-rule-minlength="1"  id='paid_leave' name='paid_leave' placeholder='Paid Leave' type='text' value="">
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='paid_leave'>Period From</label>
                             <div class='col-sm-6 controls'>
                                 <input class="form-control" data-rule-required='true'  id='period_from' name='period_from' placeholder='Period From' type='text' value="{{ date('Y').'-01-01' }}" readonly="readonly">
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='paid_leave'>Period to</label>
                             <div class='col-sm-6 controls'>
                                 <input class="form-control" data-rule-required='true' id='period_to' name='period_to' placeholder='Period To' type='text' value="{{ date('Y').'-12-31' }}" readonly="readonly">
                             </div>
                          </div>
                       <!--    <div class='form-group'>
                             <label class='control-label col-sm-3' for='holiday_date'>Holiday Date</label>
                             <div class='col-sm-6 controls input-group'>
                               <input class='form-control datepicker-input' data-rule-required='true' id='holiday_date' name='holiday_date' data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' value="">
                               <span class="input-group-addon">
                                       <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                               </span>
                             </div>
                              <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="holiday_date"></span>
                              </div>
                          </div>-->
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar" id="edit-mode">
                                          <button class="btn-primary btn" type="submit" id="add-btn">Save &AMP; Submit</button>
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
@stop