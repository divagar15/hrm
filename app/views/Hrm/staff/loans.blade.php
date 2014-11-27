@extends('layouts.master')
@section('content')

<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Applied Loans for Approval</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>                               
                                <i class='icon-folder-open '></i>                                
                                HRM
                                </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li> PayRoll</li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">Applied Loans for Approval</li>
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
                                {{ Session::get('successalert') }}
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
                     <!-- <div class="col-sm-12">
                         <a href="" class="btn-primary btn">Add Holiday</a>
                     </div>-->
                     <!-- <div class="row box box-transparent">
                        <div class="col-xs-4 col-sm-2">
                        <div class="box-quick-link blue-background">
                        <a href="{{ URL::to('staff/request-loan')}}">
                        <div class="header">
                        <div class="icon-comments"></div>
                        </div>
                        <div class="content">Request Loan</div>
                        </a>
                        </div>
                        </div>
                     </div> -->
                     <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Loan Filter</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{URL::to('staff/loans')}}" name="frmleave" id="frmleave" method="post" style='margin-bottom: 0;'>
                          <div class="form-group">
                                    <label class='control-label col-sm-3' for='from_date'>From</label>
                                     <div class='controls col-sm-6 input-group'>
                                          <input class='form-control datepicker' id='from_date' name='from_date'  data-rule-required="true" placeholder='DD-MM-YYYY' type='text' value="@if($from!=0){{ date('d-m-Y',strtotime($from)) }}@endif" /> 
                                          <span class="input-group-addon">
                                           <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                          </span>
                                     </div>
                                     <div class='col-sm-9 pull-right'> 
                                          <span class="help-block has-error" for="from_date"></span>
                                     </div>
                            </div>
                            <div class="form-group">
                                    <label class='control-label col-sm-3' for='to_date'>To</label>
                                     <div class='controls col-sm-6 input-group'>
                                          <input class='form-control datepicker' id='to_date' name='to_date'  data-rule-required="true" placeholder='DD-MM-YYYY' type='text' value="@if($to!=0){{ date('d-m-Y',strtotime($to)) }}@endif" /> 
                                          <span class="input-group-addon">
                                           <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                          </span>
                                     </div>
                                     <div class='col-sm-9 pull-right'> 
                                          <span class="help-block has-error" for="to_date"></span>
                                     </div>
                            </div>
                                       
                          <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-5">
                                      <div class="btn-toolbar">
                                        <button class="btn-primary btn" type="submit">Submit</button>
                                        <a class="btn-default btn resetbtn" href="{{ URL::to('staff/loans'); }}" type="button">Cancel</a>
                                   </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                      </div>
                    
                    <div class='box-header  blue-background'>
                      <div class='title'>Applied Loans for Approval</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>Employee Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Installments</th>
                                <th>Approved Date</th>
                                <th>Loan Deduction Start Month</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($loans)) 
                             @foreach($loans as $view) 
                             <?php
                              $deduct_month = '';
                              if($view->deduction_start_month!=0 && $view->deduction_start_year!=0) {
                               // echo  date('M', mktime(0, 0, 0, $view->deduction_start_month, 1, 2000));
                                $month = date('M', mktime(0, 0, 0, $view->deduction_start_month, 1, 2000));
                                $year  = $view->deduction_start_year;
                                $deduct_month = $month."-".$year;
                              }
                             ?>
                                <tr>
                                    <td>{{ ucfirst($view->emp_name)." - ".ucfirst($view->user_type) }}</td>
                                    <td>{{ date('d-m-Y',strtotime($view->request_date)) }}</td>
                                    <td>{{ number_format($view->loan_amount,2,'.',',') }}</td>
                                    <td>{{ $view->installment_terms }}</td>
                                    <td>@if($view->approve_date!=NULL) {{ date('d-m-Y',strtotime($view->approve_date)) }} @endif</td>
                                    <td>{{ $deduct_month }}</td>
                                    <td>
                                    @if($view->status==1) {{ "Approved" }} 
                                    @elseif($view->status==2) {{ "Rejected" }}
                                    @elseif($view->status==3) {{ "Pending" }}
                                    @endif
                                    </td>
                                    <td>
                                      @if($view->status==3)
                                      <a class="btn btn-success btn-xs has-tooltip" href="{{ URL::to('staff/process-loan/'.$view->id)}}" data-original-title="Approve" data-placement="top">Approve</a>
                                      <a class="btn btn-danger btn-xs has-tooltip" data-id="{{ $view->id }}" href="{{ URL::to('staff/loan/reject-id/'.$view->id) }}" data-original-title="Reject" data-placement="top">Reject</a>
                                      @elseif($view->status==2)
                                      <a class="btn btn-success btn-xs has-tooltip" href="{{ URL::to('staff/process-loan/'.$view->id)}}" data-original-title="Approve" data-placement="top">Approve</a>
                                      @elseif($view->status==1 && $view->mode==2)
                                      <a class="btn btn-primary btn-xs has-tooltip"  href="{{ URL::to('staff/cheque-issue/'.$view->id)}}" data-original-title="Issue Cheque" data-placement="top">Issue Cheque</a>
                                     @elseif($view->status==1 && $view->mode==1)
                                      <a class="btn btn-primary btn-xs has-tooltip" href="{{ URL::to('staff/view-loan/'.$view->id)}}" data-original-title="View" data-placement="top">View</a>
                                      @endif
                                    </td>
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
<script>
    $(document).ready(function(){
        var url = "<?php echo URL::to('staff/loan/reject-id/'); ?>";
        $('.confirm-reject').click(function(){
        var id = $(this).data('id');
        if(confirm('Are you sure want to reject this loan?')) {
            window.location.href = url+'/'+id;
        }
        });

        $('.datepicker').datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true,
         });

        var dateStart = $('#from_date')
        .datepicker({
            startDate: new Date()
        })
        .on('changeDate', function(ev){
            dateEnd.datepicker('setStartDate', ev.date);
            dateStart.datepicker('hide');
            dateEnd.focus();
        });

        var dateEnd = $('#to_date')
        .datepicker()
        .on('changeDate', function(ev){
            dateStart.datepicker('setEndDate', ev.date);
            dateEnd.datepicker('hide');
        });
    }); 
</script>
@stop