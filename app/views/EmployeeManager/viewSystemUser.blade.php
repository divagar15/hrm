@extends('layouts.master')
<?php
$branch      =   Config::get('local.branchlist');
$resStatus   =   Config::get('local.resultStatus'); 
$leadMode    =   Config::get('local.leadMode');
$systemUser  =   Config::get('local.systemUser');
?>
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>View System User</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>
                                <a href="javascript::">
                                <i class="icon-bar-chart"></i>
                                </a>
                                </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="">System  User</li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">View User</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                    <div class='col-sm-12'>
                            <div class="row">
                                <div class="pull-right">
                                    <button class="btn" type="button" onclick="window.location.href='{{ URL::to('system-user')}}'" style="margin:0px 0px 5px 0px;">Back</button>
                                    <button class="btn" type="button" onclick="window.location.href='{{ URL::to('system-user/'.base64_encode($id).'/edit')}}'" style="margin:0px 15px 5px 0px;">Edit</button>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header blue-background">
                                    <div class="title">View Lead</div>
                                </div>
                                <div class="box-content">
                                    <form class="form form-horizontal validate-form" style="margin-bottom:0">
                                       <div class='form-group'>
                                             <label class='col-sm-3' for='custom_name'>Customer Name:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-4' style="font-weight:100;">{{{ $showuser->emp_name }}}</label>
                                             </div>
                                        </div>
                                        <div class='form-group'>
                                             <label class='col-sm-3' for='email'>UserName:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-4' style="font-weight:100;">{{{ $showuser->username }}}</label>
                                             </div>
                                       </div>
                                       <div class='form-group'>
                                              <label class='col-sm-3' for='validation_name'>User Role</label>
                                              <div class='col-sm-6'>
                                                    <label class='col-sm-3' style="font-weight:100;">{{{ $showuser->user_role != 0 && array_key_exists($showuser->user_role,$systemUser) ? $systemUser [$showuser->user_role] : '-' }}}</label>
                                              </div>
                                       </div>
                                       
                                       <div class="form-group">
                                              <label class='col-sm-3' for='start_date'>Date Created:</label>
                                               <div class='col-sm-6'> 
                                                   <label class='col-sm-3' style="font-weight:100;">{{{ date('d-m-Y',strtotime($showuser->dateCreated)) }}}</label>
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
        $('.confirm_delete').click(function(){
            if(confirm('Are sure to delete this lead?')) {
                $(this).parent('form').submit();
            } else {
                return false;
            }
         });
    });
  
</script>
@stop