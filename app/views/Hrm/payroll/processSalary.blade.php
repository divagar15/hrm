@extends('layouts.master')
 <?php
 $baseUrl     = Config::get('local.baseUrl');
 ?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Payroll Salary Process</span>
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
                        </li> PayRoll</li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Payroll Salary Process</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class='col-sm-12'>
                      <!-- alert box section -->
                        @if(Session::has('successalert'))
                        <div class="alert alert-success alert-dismissable">
                               <a class="close" href="#" data-dismiss="alert">× </a>
                                   <h4>
                                   <i class="icon-ok-sign"></i>
                                   Success
                                   </h4>
                                {{Session::get('successalert')}}
                        </div>
                        @endif
                        @if(Session::has('warningalert'))
                        <div class="alert alert-warning alert-dismissablee">
                               <a class="close" href="#" data-dismiss="alert">× </a>
                                   <h4>
                                   <i class="icon-exclamation-sign"></i>
                                   Warning
                                   </h4>
                                {{Session::get('warningalert')}}
                        </div>
                        @endif
                        @if(Session::has('erroralert'))
                        <div class="alert alert-danger alert-dismissablee">
                               <a class="close" href="#" data-dismiss="alert">× </a>
                                   <h4>
                                   <i class="icon-remove-sign"></i>
                                   Error
                                   </h4>
                                {{Session::get('erroralert')}}
                        </div>
                        @endif
                     <!-- alert box section end -->
                       <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                </div>
                            </div>
                        </div>  
                      <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Payroll Salary Process</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('payroll/calculate-salary-process') }}" name="frmSalaryProcess" id="frmaltholiday" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='process_month'>Process Period</label>
                             <div class='col-sm-6 controls'>
                                 <input class="form-control" data-rule-required='true' readonly="readonly"  id='process_month' name='process_month' placeholder='Process Peroid' type='text' value="{{ date('F, Y',strtotime($process_month)) }}">
                                 <input id='p_start_date' name='p_start_date' type='hidden' value="{{ date('Y-m-',strtotime($process_month)).'01' }}">
                                 <input id='p_end_date' name='p_end_date' type='hidden' value="{{ date('Y-m-t',strtotime($process_month)) }}">
                             </div>
                          </div>
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar" id="edit-mode">
                                          <button class="btn-primary btn" type="submit" id="add-btn">Process</button>
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