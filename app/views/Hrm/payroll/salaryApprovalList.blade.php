@extends('layouts.master')
<?php
$FilterBy = Request::get('report_date');
$br       = Request::get('branch');
$commission = $allowances = $gross = $ee_cpf = $er_cpf = $mloan =  $deducate = $net_pay = $sdl = $cpfboard = $tbasic = 0;
?>
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Salary Processed Approval List</span>
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
                                <li class="active">Salary Processed Approval List</li>
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
                     @if(!empty($p_emp))
                      <div class="row">
                        <div class="col-sm-12">
                            <a href="javascript::" class="btn btn-success pull-right confirm-approve"><i class="icon-ok-sign"></i>&nbsp;&nbsp;Approve</a>
                        </div>
                    </div>
                     @endif
                     <div class='box-header  blue-background'>
                      <div class='title'>Salary Processed List</div>
                    </div>
                           
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('payroll/salary-process-for-approval-list') }}" name="frmleave" id="frmleave" method="get" style='margin-bottom: 0;'>
                          <div class="form-group">
                                    <label class='control-label col-sm-3' for='report_date'>Month / Year</label>
                                     <div class='controls col-sm-6 input-group'>
                                         <input class='form-control' id='report_date' name='report_date'  data-rule-required="true" placeholder='MMM-YYYY' type='text' readonly="readonly" value="{{  date('M-Y',strtotime($process_date)) }}" /> 
                                     </div>
                                     <div class='col-sm-9 pull-right'> 
                                          <span class="help-block has-error" for="report_date"></span>
                                     </div>
                            </div>
                            <div class="form-group">
                                    <label class='control-label col-sm-3' for='branch'>Branch</label>
                                     <div class='controls col-sm-6'>
                                     <select class="form-control" id="branch" name="branch">
                                        <option value="0" selected>All</option>
                                        @foreach($branches as $branch)
                                        <?php 
                                           if(isset($br) && $branch->id==$br)
                                            $selected = 'selected';
                                           else
                                            $selected = '';
                                        ?>
                                          <option value="{{ $branch->id }}" {{ $selected }}>{{ $branch->branch_name }}</option>
                                        @endforeach
                                     </select>
                                     </div>
                            </div>
                                                    
                          <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-5">
                                      <div class="btn-toolbar">
                                        <button class="btn-primary btn" type="submit">Submit</button>
                                      </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                    
                      </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='table table-bordered table-striped' style='margin-bottom:0;width: 100%;'>
                            <thead>
                              <tr>
                                <th width="40%">Employee Id</th>  
                                <th width="40%">Emp Name</th>
                                <th width="10%">Branch</th> 
                                <th width="8%">Basic</th>
                                <th width="8%">Commission</th>
                                <th width="8%">Allowances</th>
                                <th width="10%">Gross</th>
                                <th width="8%">EE CPF</th>
                                <th width="8%">Loan</th>
                                <th width="10%">Deducation</th>
                                <th width="10%">Net Pay</th>
                                <th width="10%">ER CPF</th>
                                <th width="10%">SDL</th>
                                <th width="10%">CPF Board</th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($p_emp)) 
                             @foreach($p_emp as $view) 
                                <tr>
                                    <td>{{ ucwords($view->employee_id) }}</td>
                                    <td>{{ ucwords($view->emp_name) }}</td>
                                    <td>{{ $view->branch_name }}</td>
                                    <td>${{ number_format($view->basic_paid,2) }}</td>
                                    <td>${{ number_format($view->commission,2) }}</td>
                                    <td>${{ number_format($view->allowances,2) }}</td>
                                    <td>${{ number_format($view->gross,2) }}</td>
                                    <td>${{ number_format($view->ee_cpf,2) }}</td>
                                    <td>${{ number_format($view->mloan_amt,2) }}</td>
                                    <td>${{ number_format($view->total_deducate,2) }}</td>
                                    <td>${{ number_format($view->net_pay,2) }}</td>
                                    <td>${{ number_format($view->er_cpf,2) }}</td>
                                    <td>${{ number_format($view->sdl,2) }}</td>
                                    <td>${{ number_format($view->cpf_broad,2) }}</td>
                               </tr> 
                               <?php 
                                     $tbasic     += $view->basic_paid;
                                     $commission += $view->commission;
                                     $allowances += $view->allowances;
                                     $gross      += $view->gross;
                                     $ee_cpf     += $view->ee_cpf;
                                     $er_cpf     += $view->er_cpf;
                                     $mloan      += $view->mloan_amt;
                                     $deducate   += $view->total_deducate;
                                     $net_pay    += $view->net_pay;
                                     $sdl        += $view->sdl;
                                     $cpfboard   += $view->cpf_broad;
                               ?>
                             @endforeach
                             @endif
                             @if(!empty($p_emp))
                             <tr>
                                    <th colspan="3">Total</th>
                                    <th>${{ number_format($tbasic,2) }}</th>
                                    <th>${{ number_format($commission,2) }}</th>
                                    <th>${{ number_format($allowances ,2) }}</th>
                                    <th>${{ number_format($gross,2) }}</th>
                                    <th>${{ number_format($ee_cpf,2) }}</th>
                                    <th>${{ number_format($mloan,2) }}</th>
                                    <th>${{ number_format($deducate,2) }}</th>
                                    <th>${{ number_format($net_pay,2) }}</th>
                                    <th>${{ number_format($er_cpf,2) }}</th>
                                    <th>${{ number_format(floor($sdl),2) }}</th>
                                    <th>${{ number_format($cpfboard,2) }}</th>
                               </tr> 
                              @else
                              <tr>
                                    <td colspan="13">Salary Approval not found</td>
                               </tr> 
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
        var url = "<?php echo URL::to('payroll/salary-process-for-approval-list').'?approve=1'; ?>";
        $('.datepicker').datepicker({
              format: 'M-yyyy',
              autoclose: true,
        });
        $('.confirm-approve').click(function(){
            if(confirm('If approved, salary details can\'t able to edit. Are you sure want to approve these list')) {
                window.location.href = url;
            }
        });
    }); 
</script>
@stop