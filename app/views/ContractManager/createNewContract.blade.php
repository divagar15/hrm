@extends('layouts.master')
<?php
$branch = Config::get('local.branchlist');
$resStatus = Config::get('local.resultStatus'); 
$leadMode = Config::get('local.leadMode')
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
                      <span>Create New Contract</span>
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
                          CRM  Manager
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Create New Contract</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class='col-sm-12'>
                    <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Create New Contract</div>
                      </div>
                      <div class='box-content'>
                        <!-- <form action="#" class="form-horizontal row-border" data-validate="parsley" id="validate-form" /> -->
                        <form class='form form-horizontal validate-form' action="{{URL::to('createcustomer')}}" name="frmcustomer" id="frmcustomer" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='custom_name'>Customer Name</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' data-rule-minlength="2"  id='custom_name' name='custom_name' placeholder='Name' type='text'>
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='email'>E-mail</label>
                             <div class='col-sm-6 controls'>
                               <input class='form-control' data-type="email"  data-rule-email="true" data-rule-required='true' data-rule-minlength="2"  id='email' name='email' placeholder='E-mail' type='text'>
                             </div>
                          </div>
                          <div class='form-group'>
                              <label class='control-label col-sm-3' for='validation_name'>Contact no.</label>
                              <div class='controls col-sm-6'>
                                 <input class='form-control'  data-rule-required="true" data-rule-minlength="8" id='contact_no' name='contact_no' placeholder='Phone / Mobile no' type='text'>
                              </div>
                          </div>
                          <div class="form-group">
                                <label class='control-label col-sm-3' for='address'>Address</label>
                                 <div class='controls col-sm-6'>
                                   <textarea id="address" name="address" class="form-control"  data-rule-required="true" data-rule-minlength="2" rows="5" placeholder="Address"></textarea>
                                 </div>
                          </div>
                          <div class='form-group'>
                               <label class='control-label col-sm-3' for='branch_list'>Branch</label>
                               <div class='controls col-sm-6'>
                                  <select class='form-control' data-rule-required="true"  id='branch_list' name='branch_list'>
                                      <!-- <option value=""><span style="color:#ccc;">-- Select branch --</span></option> -->
                                      @foreach($branch as $key => $list)
                                       <option value="{{{ $key }}}">{{{ $list }}}</option>
                                      @endforeach
                                  </select>
                               </div>
                           </div>
                            <div class="form-group">
                                <label class='control-label col-sm-3' for='requirement'>Requirement</label>
                                 <div class='controls col-sm-6'>
                                   <textarea id="requirement" name="requirement" class="form-control"  data-rule-required="true" data-rule-minlength="2" rows="5" placeholder="Requirement"></textarea>
                                 </div>
                           </div>
                           <div class='form-group'>
                              <label class='control-label col-sm-3' for='validation_name'>Service Officer</label>
                              <div class='controls col-sm-6' id="maidname">
                                  <?php if(Session::get('role') == 3) { ?>
                                         <label>{{ ucwords(Session::get('log_name')) }}</label>
                                         <input type="hidden" name="service_officer" id="service_officer" value="{{ Session::get('id') }}" />
                                  <?php } else { ?>
                                   <select class='select2 form-control' name="service_officer" id="service_officer" data-rule-required="true">
                                       <option value=''></option>
                                       @if(!empty($service_office))
                                         @foreach($service_office as $office)
                                         <option value='{{ $office->id }}'>{{{ ucwords($office->emp_name).'&nbsp; / &nbsp;'.ucwords($office->branch_name)  }}}</option>
                                         @endforeach
                                       @endif
                                      </select>
                                  <?php } ?>
                              </div>
                           </div>
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar">
                                        <button class="btn-primary btn" type="submit">Save &amp; Submit</button>
                                        <button class="btn-default btn resetbtn" type="button">Reset</button>
                                        <button class="btn-default btn" type="button" onclick="window.location.href='{{ URL::to('lead')}}'">Cancel</button>
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
            $('#custom_name').val('');
            $('#email').val('');
            $('#contact_no').val('');
            $('#branch_list').val('1');
            $('#start_date').val('');
            $('#requirement').val('');
            $('#end_date').val('');
            $('#result_list').val('4');
            $('#lead_type').val('1');
            
        });
    });
</script>
@stop
