@extends('layouts.master')
@section('content')
<?php
$oStatus = Config::get('local.approval');
$pStatus = Config::get('local.punch_out_mode');
$emp_id  = Request::Segment(3);
?>
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Employee Monthly Worksheet</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>
                                <a href="javascript::">
                                <i class="icon-bar-chart"></i>
                                </a>HRM
                                </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">Overall WorkSheet</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
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
                        @if(Session::has('erroralert'))
                        <div class="alert alert-danger alert-dismissablee">
                               <a class="close" href="#" data-dismiss="alert">× </a>
                                   <h4>
                                   <i class="icon-warning-sign"></i>
                                   Error
                                   </h4>
                                {{Session::get('erroralert')}}
                        </div>
                        @endif
                     <!-- alert box section end -->
                       <!-- filter box -->
                       <div class="row">
                           <div class="col-sm-12">
                               <a class="btn btn-warning pull-right" href="{{ URL::to('payroll/calculate-net-pay/'.$emp_id) }}"style="margin-bottom:5px">
                             <i class="icon-credit-card"></i>
                             Generate Salary Voucher
                             </a>
                           </div>
                       </div>
                       
                            <div class='box-header  blue-background'>
                                      <div class='title'>Search</div>
                            </div>
                            <div class='box-content box-no-padding'>Edit working process
                            </div>
                       <!-- filter box end -->
                             <div class="box-content">
                                    <form class="form form-horizontal validate-form" style="margin-bottom:0">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class='form-group'>
                                             <label class='col-sm-4' for='custom_name'>Employee Name:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-4' style="font-weight:100;">{{{ ucwords($emp_info->emp_name) }}}</label>
                                             </div>
                                        </div>
                                        <div class='form-group'>
                                             <label class='col-sm-4' for='email'>E-mail:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-4' style="font-weight:100;">{{{ $emp_info->email_id }}}</label>
                                             </div>
                                       </div>
                                      </div><!--col-md-6-->
                                        <div class="col-md-6">
                                        <div class=  "form-group">
                                              <label class='col-sm-3' for='job_title'>Job Title:</label>
                                               <div class='col-sm-6'> 
                                                   <label class='col-sm-6' style="font-weight:100;">{{{ $emp_info->job_title != '' ? $emp_info->job_title : '-'  }}}</label>
                                               </div> 
                                        </div>
                                        <div class=  "form-group">
                                              <label class='col-sm-3' for='start_date'>Lead Start Date:</label>
                                               <div class='col-sm-6'> 
                                                   <label class='col-sm-6' style="font-weight:100;">{{{ $emp_info->branch_name != '' ? $emp_info->branch_name : '-'  }}}</label>
                                               </div> 
                                        </div>
                                        </div>
                                      </div>
                             </div>
                    <div class='box-header  blue-background'>
                      <div class='title'>Overall WorkSheet from {{ date('d/m/Y',strtotime($month_start_date)) }} to {{ date('d/m/Y',strtotime($month_end_date)) }}</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th width="8%">Attandance Date</th>
                                <th width="5%">Punch In</th>
                                <th width="5%">Punch Out</th>
                                <th width="10%">Worked Duration</th>
                                <th width="10%">If any Overtime</th>
                                <th width="10%">OverTime Approval</th>
                                <th width="7%">Punch Status</th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($emp_timesheet)) 
                             @foreach($emp_timesheet as $view) 
                               <?php  ?>
                                <tr>
                                    <td><a href="{{-- URL::to(attendance/editWorkSheet) --}}">{{ $view->attend_date }}</a></td>
                                <td>{{ $view->punch_in }}</td>
                                <td>{{ $view->punch_out }}</td>
                                <td>{{ $view->duration }}</td>
                                <td>{{ CommonFunction::calculate_overtime($view->duration,8) }}</td>
                                 <td>{{ $view->overtime_approval != 0 ? $oStatus[$view->overtime_approval] : '-' }}</td>
                                  <td>{{ $pStatus[$view->punch_out_mode] }}</td>
                              </tr> 
                             @endforeach
                             @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
       </div>
</div>
@include('includes.jscript')
@stop