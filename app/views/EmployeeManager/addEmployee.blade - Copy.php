@extends('layouts.master')
<?php
$branch     = Config::get('local.branchlist');
$resStatus  = Config::get('local.resultStatus'); 
$leadMode   = Config::get('local.leadMode');
//$systemUser = Config::get('local.systemUser'); 
?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Add Employee</span>
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
                          HR
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add employee</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class='col-sm-12'>
                    <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Add Employee</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{URL::to('employee')}}" name="frmsysuser" id="frmsysuser" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='user_type'>User Type</label>
                               <div class='controls col-sm-6'>
                                  <select class='form-control' data-rule-required="true"  id='user_type' name='user_type'>
                                      @foreach($userType as $key => $list)
                                       <option value="{{{ $key }}}">{{{ $list }}}</option>
                                      @endforeach
                                      <option value="0">Others</option>
                                  </select>
                               </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='name'>Name</label>
                             <div class='col-sm-6 controls'>
                               <input class='form-control' data-rule-minlength="2" data-rule-required="true" id='Name' name='name' placeholder='Name' type='text'>
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='username'>Email Id</label>
                             <div class='col-sm-6 controls'>
                               <input class='form-control' data-rule-minlength="2" data-rule-required="true" id='email_id' name='email_id' placeholder='Email ID' type='text'>
                             </div>
                          </div>
                          <div class='form-group pass-dtls'>
                              <label class='control-label col-sm-3' for='password' id="password">Password</label>
                              <div class='controls col-sm-6'>
                                 <input class='form-control'  data-rule-required="true" data-rule-minlength="2" id='password' name='password' placeholder='Password' type='password'>
                              </div>
                          </div>
                          <div class='form-group pass-dtls'>
                              <label class='control-label col-sm-3' for='confirm_password'>Confirm Password</label>
                              <div class='controls col-sm-6'>
                                 <input class='form-control'  data-rule-required="true" data-rule-equalto="#password" data-rule-minlength="2" id='confirm_password' name='confirm_password' placeholder='Confirm Password' type='password'>
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
        $('#user_type').change(function(){
            var utype = $(this).val();
            console.log(utype);
            if(utype == '0'){
                $('.pass-dtls').css('display','none');
            } else {
                $('.pass-dtls').css('display','block');
            }
        });
    });
</script>
@stop
