@extends('layouts.master')
<?php
$branch     = Config::get('local.branchlist');
$resStatus  = Config::get('local.resultStatus'); 
$leadMode   = Config::get('local.leadMode');
$systemUser = Config::get('local.systemUser');
?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Edit System User</span>
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
                          System User
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add user</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class='col-sm-12'>
                    <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Edit Employee User</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{URL::to('employee/'.$id)}}" name="frmsysuser" id="frmsysuser" method="post" style='margin-bottom: 0;'>
                            <input name="_method" type="hidden" value="PATCH" />
                            <div class='form-group'>
                             <label class='control-label col-sm-3' for='user_type'>User Type</label>
                               <div class='controls col-sm-6'>
                                  <select class='form-control' data-rule-required="true"  id='user_type' name='user_type'>
                                      @foreach($systemUser as $key => $list)
                                       <option value="{{{ $key }}}">{{{ $list }}}</option>
                                      @endforeach
                                  </select>
                               </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='name'>Name</label>
                             <div class='col-sm-6 controls'>
                               <input class='form-control' data-rule-minlength="2" data-rule-required="true" id='Name' name='name' placeholder='Name' type='text' value="{{ $sysList->emp_name }}">
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='username'>Email Id</label>
                             <div class='col-sm-6 controls'>
                                 <input class='form-control' data-rule-minlength="2" data-rule-required="true" id='email_id' name='email_id' placeholder='Email ID' type='text' value="{{ $sysList->username }}">
                             </div>
                          </div>
                          <div class='form-group'>
                              <label class='control-label col-sm-3' for='password'>Password</label>
                              <div class='controls col-sm-6'>
                                 <input class='form-control' data-rule-minlength="2" id='password' name='password' placeholder='Password' type='password' value="">
                              </div>
                          </div>
                          <div class='form-group'>
                              <label class='control-label col-sm-3' for='confirm_password'>Confirm Password</label>
                              <div class='controls col-sm-6'>
                                 <input class='form-control' data-rule-equalto="#password" data-rule-minlength="2" id='confirm_password' name='confirm_password' placeholder='Confirm Password' type='password' value="">
                              </div>
                          </div>
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar">
                                        <button class="btn-primary btn" type="submit">Save &amp; Submit</button>
                                        <button class="btn-default btn resetbtn" type="button">Reset</button>
                                        <button class="btn-default btn" type="button" onclick="window.location.href='{{ URL::to('system-user')}}'">Cancel</button>
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
            $('#Name').val('');
            $('#username').val('');
            $('#password').val('');
            $('#confirm_password').val('');
            $('#branch_list').val('0');
            $('#user_type').val('1');
        });
    });
</script>
@stop
