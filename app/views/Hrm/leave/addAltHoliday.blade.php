@extends('layouts.master')
 <?php
 $baseUrl     = Config::get('local.baseUrl');
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
                      <span>Add Alternate Holiday</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li><i class="icon-folder-open"></i></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                        <li><a href="{{ URL::to('config/configure-panel') }}">Configure Panel</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                        <li><a href="{{ URL::to('calendar/calendar-list') }}">Calendar List</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                        <li><a href="{{ URL::to('leave/alt-holiday-list') }}">Alternate Holiday List</a></li>
                        <li class='separator'><i class='icon-angle-right'></i></li>
                        <li class='active'>Add Alternate Holiday</li>
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
                        <a class="btn btn-warning btn-xs has-tooltip" data-placement="top" data-original-title="Back" href="{{ URL::to('leave/alt-holiday-list') }}">Back</a>
                        </div>
                        </div>
                        </div>  
                      <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Add Alternate Holiday</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('leave/add-alt-holiday') }}" name="frmaltholiday" id="frmaltholiday" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='holiday_type'>Holiday List</label>
                             <div class='col-sm-6 controls'>
                                 <select  id='fkHolyId' name='fkHolyId' class="form-control" >
                                     @if(!empty($holiday_list))
                                       @foreach($holiday_list as $k => $htype)
                                          <option value="{{ $htype->id }}">{{ $htype->holiday_name.' / '.date('d-m-Y',strtotime($htype->holiday_date)).' - '.date('l',strtotime($htype->holiday_date)) }}</option>
                                       @endforeach
                                     @endif
                                 </select>    
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='holiday_name'>Holiday Name</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' data-rule-minlength="2" autocomplete="off"  id='holiday_name'  name='holiday_name' placeholder='Holiday Name' type='text' value="">
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='holiday_date'>Holiday Date</label>
                             <div class='col-sm-6 controls input-group'>
                                 <input class='form-control datepicker-input' data-rule-required='true' autocomplete="off" id='holiday_date' name='holiday_date' data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value="">
                               <span class="input-group-addon">
                                       <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                               </span>
                             </div>
                              <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="holiday_date"></span>
                              </div>
                          </div>
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