@extends('layouts.master')
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Employees Overall Worksheet</span>
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
                     <!-- filtet option --
                      <div class='box-header  blue-background'>
                      <div class='title'>Filter By Month</div>
                    </div>
                     <div class='box-content box-no-padding'>dd</div>
                     -->
                    <div class='box-header  blue-background'>
                      <div class='title'>Overall WorkSheet from {{ date('d/m/Y',strtotime($month_start_date)) }} to {{ date('d/m/Y',strtotime($month_end_date)) }}</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th width="20%">Employee Name</th>
                                <th width="5%">Total Hrs</th>
                                <th width="10%">No of Working Days</th>
                                <th width="10%">Total Month Working Hrs</th>
                                <!-- <th width="7%">OverTime</th> -->
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($emptotalHrsList)) 
                             @foreach($emptotalHrsList as $view) 
                               <?php  ?>
                                <tr>
                                    <td><a href="{{ URL::to('attendance/view-employee-month-time-sheet/'.$view->emp_id) }}">{{ ucwords($view->emp_name) }}</a></td>
                                <td>{{ rtrim($view->emp_total_hrs,':00') }} Hrs</td>
                                <td>{{  $total_work_days.' Days' }}</td>
                                <td>{{ $total_work_hrs.' Hrs' }}</td>
                                <!-- <td>{{-- rtrim(CommonFunction::calculate_overtime($view->emp_total_hrs,$total_work_hrs),':00') --}}</td> -->
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