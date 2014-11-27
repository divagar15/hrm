@extends('layouts.master')
<?php
$FilterBy = Request::get('report_date');
?>
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Salary Processed List</span>
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
                                <li class="active">Salary Processed List</li>
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
                                   <i class="icon-warning-sign"></i>
                                   Error
                                   </h4>
                                {{Session::get('erroralert')}}
                        </div>
                        @endif
                     <!-- alert box section end -->
                     @if(!empty($p_emp)) 
                     <div class='box-header  blue-background'>
                      <div class='title'>Salary Processed List for {{  date('M-Y',strtotime($p_emp[0]->salary_from_date)) }}</div>
                    </div>
                            
                     <!-- <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('payroll/processed-employee-salary-list')}}" name="frmleave" id="frmleave" method="get" style='margin-bottom: 0;'>
                          <div class="form-group">
                                    <label class='control-label col-sm-3' for='report_date'>Month / Year</label>
                                     <div class='controls col-sm-6 input-group'>
                                          <label class='control-label col-sm-3' for='report_date'>{{  date('M-Y',strtotime($p_emp[0]->salary_from_date)) }}</label>
                                     </div>
                            </div>
                          </form>
                        </div> -->
                      @endif
                      </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                  <th width="10%">Employee ID</th>
                                <th width="20%">Employee Name</th>
                                <th width="10%">Branch</th> 
                                <th width="8%">Basic</th>
                                <th width="10%">Gross</th>
                                <th width="10%">Deducation</th>
                                <th width="10%">Net Pay</th>
                                <th width="1%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($p_emp)) 
                             @foreach($p_emp as $view) 
                              <tr>
                                    <td>{{ $view->employee_id }}</td>
                                    <td><a href="{{ URL::to('payroll/edit-processed-salary/'.$view->sal_id) }}">{{ ucwords($view->emp_name) }}</a></td>
                                    <td>{{ $view->branch_name }}</td>
                                    <td>${{ number_format($view->basic_paid,2) }}</td>
                                    <td>${{ number_format($view->gross,2) }}</td>
                                    <td>${{ number_format($view->total_deducate,2) }}</td>
                                    <td>${{ number_format($view->net_pay,2) }}</td>
                                    <td>
                                    <a class="btn btn-primary btn-xs has-tooltip" href="{{ URL::to('payroll/edit-processed-salary/'.$view->sal_id) }}" data-original-title="Edit" data-placement="top">Edit</a>
                                    <a class="btn btn-warning btn-xs has-tooltip confirm-process" data-id="{{ $view->sal_id }}" data-emp="{{ $view->emp_id }}" data-date="{{ $view->salary_from_date }}" href="javascript:void(0);" data-original-title="Reprocess" data-placement="top">Reprocess</a>
                                    <a class="btn btn-danger btn-xs has-tooltip confirm-delete" data-id="{{ $view->sal_id }}" data-loanid="{{  $view->loan_id}}"data-eloan="{{ $view->mloan_amt }}" href="javascript:void(0);" data-original-title="Delete" data-placement="top">Delete</a></td>
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
        var url = "<?php echo URL::to('payroll/reprocess-salary'); ?>";
        $('.datepicker').datepicker({
              format: 'M-yyyy',
              autoclose: true,
        });
        $('.confirm-delete').click(function(){
            var id         = $(this).data('id');
            var eloan_amt  = $(this).data('eloan');
            var loan_id    = $(this).data('loanid');
            if(confirm('Are you sure delete this processed salary details?')) {
                window.location.href = '<?php echo URL::to('payroll/delete-salary'); ?>'+'/'+id+'/'+eloan_amt+'/'+loan_id;
            }
        });
        $('.confirm-process').click(function(){
            var sid   = $(this).data('id');
            var empid = $(this).data('emp');
            var startdate = $(this).data('date');
            if(confirm('Are you sure reproces this processed salary')) {
                window.location.href = url+'?id='+sid+'&emp_id='+empid+'&sdate='+startdate;
            }
        });
    }); 
</script>
@stop