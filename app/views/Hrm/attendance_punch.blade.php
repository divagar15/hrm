@extends('layouts.master')
<?php
$UrlData = Request::Segment(2);
?>
 <style>
    .form-horizontal .control-label, .form-horizontal .radio, .form-horizontal .checkbox, .form-horizontal .radio-inline, .form-horizontal .checkbox-inline{padding-top: 0px;}
     .view-label{color:#666 !important;}
    </style>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Attendance Tracking Punch</span>
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
                        <li class='active'>Attendance Tracking Punch</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- alert message display area -->
              @if(Session::has('successalert') && Session::get('successalert'))
              <div class='col-xs-12'>
                    <div class="row">
                       <div class="alert alert-success alert-dismissable">
                          <a class="close" href="#" data-dismiss="alert">× </a>
                          <i class="icon-ok-sign"></i>
                          {{ Session::get('successalert') }}
                       </div>
                    </div>
                </div>
              @elseif(Session::has('erroralert') && Session::get('erroralert'))
              <div class='col-xs-12'>
                    <div class="row">
                       <div class="alert alert-danger alert-dismissable">
                          <a class="close" href="#" data-dismiss="alert">× </a>
                          <i class="icon-remove-sign"></i>
                          {{ Session::get('erroralert') }}
                       </div>
                    </div>
                </div>
              @endif
              <!-- alert Message display area -->
                <div class="row">
                  <div class='col-sm-12'>
                    <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>{{ ucwords(str_replace('-',' ',$UrlData)) }}</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('attendance/punch-in-out-process') }}" name="frmAttendanceTrack" id="frmAttendanceTrack" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='date'>Date</label>
                             <div class='col-sm-6 controls'>
                                  <input type="text" class="form-control" readonly="readonly" name='attend_date' id='attend_date' value="{{ date('Y-m-d',strtotime('now')) }}"/>
                                  <!-- <label class='control-label' for='Time'>{{ date('Y-m-d',strtotime('now')) }}</label> -->
                             </div>
                          </div>
                          <div class='form-group'>
                              <label class='control-label col-sm-3' for='Time'>Time&nbsp;(HH:MM)</label>
                             <div class='col-sm-6 controls'>
                                  <!-- <label class='control-label' for='Time'>{{ date('H:i',strtotime('now')) }}&nbsp;HH:MM</label> -->
                                  <input type="type" class="form-control" readonly="readonly" name="log_time" id="log_time" value="{{ date('H:i',strtotime('now')) }}" />
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='note'>Note</label>
                             <div class='col-sm-6 controls'>
                                 <textarea class='form-control' id='attend_note' name='attend_note' placeholder='Note'></textarea>
                             </div>
                          </div>
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar">
                                          <input type="hidden" id="log_status" name="log_status" value="{{ !empty($logView) ? $logView->punch_out_mode : '0'}}" />
                                          <button class="btn-primary btn" type="submit">{{ !empty($logView) && $logView->punch_out_mode == 1 ? 'Punch Out' : 'Punch In' }}</button>
                                        
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
<script>
    $(document).ready(function(){
        $('.resetbtn').click(function(){
            $('#fee_amt').val('');
            $('#fee_type').val('');
        });
    });
</script>
@stop
