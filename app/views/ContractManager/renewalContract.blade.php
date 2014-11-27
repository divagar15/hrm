@extends('layouts.master')
<?php
$branch     = Config::get('local.branchlist');
$resStatus  = Config::get('local.resultStatus'); 
$leadMode   = Config::get('local.leadMode');
$payMode    = Config::get('local.payMode');
//$feeType    = Config::get('local.feeType');
$baseUrl    = Config::get('local.baseUrl');
$app_approve_status = Config::get('local.app_approve_status');
$customer  = Request::Segment(3);
$step_no   = Request::Segment(2);
$edit_mode = Request::Segment(4);
//echo '<pre>'; print_r(Session::all()); echo '</pre>';
if(!empty($resultStatus)) {
  $contract_id = $resultStatus->contract_id;
  $feeArray = explode(',',$resultStatus->fee_type);
  $ctab1 = $resultStatus->contract_id !='' ? 'complete' : '';
  $ctab2 = $resultStatus->app_id !='' ? 'complete' : '';
  $ctab3 = $resultStatus->date_customer_sign !='' && $resultStatus->app_status == 1 ? 'complete' : '';  
  $ctab4 = $resultStatus->insurance_sub_date !='' ? 'complete' : '';
  $ctab5 = $resultStatus->arrival_date != '' ? 'complete' : '';
  $ctab6 = $resultStatus->handover_date != '' ? 'complete' : '';
  $ctab7 = $resultStatus->e_issue_date != '' ? 'complete' : '';
  $ctab8 = $resultStatus->doc_return_date != '' ? 'complete' : '';
  if($resultStatus->contract_id != '') {
      $cUrl1 =  URL::to('create-contract/step1/'.$contract_id);
      $cUrl2 =  URL::to('create-contract/step2/'.$contract_id); 
      $cUrl3 = $cUrl4 = $cUrl5 = $cUrl6 = $cUrl7 = $cUrl8 = 'javascript::';
  } 
  if($resultStatus->app_id  != '' && $resultStatus->app_approval_date == ''  && $resultStatus->app_status == 0 || $resultStatus->app_status == 2) {
       $cUrl1 =  URL::to('create-contract/step1/'.$contract_id);
       $cUrl2 =  URL::to('create-contract/step2/'.$contract_id); 
       $cUrl3 =  URL::to('create-contract/step3/'.$contract_id);
       $cUrl4 = $cUrl5 = $cUrl6 = $cUrl7 = $cUrl8 = 'javascript::';
  }
  if($resultStatus->app_id  != '' && $resultStatus->app_status == 1) {
       $cUrl1 =  URL::to('create-contract/step1/'.$contract_id);
       $cUrl2 =  URL::to('create-contract/step2/'.$contract_id); 
       $cUrl3 =  URL::to('create-contract/step3/'.$contract_id);
       $cUrl4 =  URL::to('create-contract/step4/'.$contract_id); 
       $cUrl5 =  URL::to('create-contract/step5/'.$contract_id);
       $cUrl6 =  URL::to('create-contract/step6/'.$contract_id); 
       $cUrl7 =  URL::to('create-contract/step7/'.$contract_id);
       $cUrl8 =  URL::to('create-contract/step8/'.$contract_id); 
  }
  //$cUrl2
} else {
    // new contract no result status
    $ctab1= $ctab2 = $ctab3 = $ctab4 = $ctab5 = $ctab6 = $ctab7 = $ctab8 = '';
    $cUrl1 = $cUrl2 = $cUrl3 = $cUrl4 = $cUrl5 = $cUrl6 = $cUrl7 = $cUrl8 = 'javascript::';
}
?>
<style>
    .insub_date{color:#F00;}
</style>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Contract Renewal</span>
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
                          Contract Manager
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Contract Renewal</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
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
                    <div class='box'>
                        <div class="row"><div class="col-sm-12"><div class="pull-right"><button class="btn-primary btn" type="button" onclick="window.location.href='{{ URL::to('contract-list') }}'">Back</button></div></div></div>
                        <div class='row'>
                                    <div class='col-sm-12'>
                                      <div class='box'>
                                        <div class='box-content box-padding'>
                                          <div class='fuelux'>
                                           <div class='wizard' id="mywizard" >
                                              <ul class='steps'>
                                                        <li class='active {{ $ctab1  }}' data-target='#step1' id="t1">
                                                            <a href="{{ $cUrl1 }}"><span class='step'>New Contract</span></a>
                                                        </li>
                                                        <li class=" {{ $ctab2  }}" data-target='#step2' id="t2">
                                                            <a href="{{ $cUrl2 }}"><span class='step'>Application</span></a>
                                                        </li>
                                                        <li class=" {{ $ctab3  }}" data-target='#step3' id="t3">
                                                            <a href="{{ $cUrl3 }}"><span class='step'>Application Approval</span></a>
                                                        </li>
                                                        <li class=" {{ $ctab4  }}" data-target='#step4' id="t4">
                                                            <a href="{{ $cUrl4 }}"><span class='step'>Insurance</span></a>
                                                        </li>
                                                        <li class=" {{ $ctab5  }}" data-target='#step5' id="t5">
                                                            <a href="{{ $cUrl5 }}"><span class='step'>Maid Arrival</span></a>
                                                        </li>
                                                        <li class=" {{ $ctab6  }}" data-target='#step6' id="t6">
                                                            <a href="{{ $cUrl6 }}"><span class='step'>Handover</span></a>
                                                        </li>
                                                         <li class=" {{ $ctab7  }}" data-target='#step7' id="t7">
                                                             <a href="{{ $cUrl7 }}"><span class='step'>E-issue</span></a>
                                                        </li>
                                                         <li class=" {{ $ctab8  }}" data-target='#step8' id="t8">
                                                             <a href="{{ $cUrl8 }}"><span class='step'>Document return</span></a>
                                                        </li>
                                              </ul>
                                            </div> 
                                            <div class='step-content'>
                                              <hr class='hr-normal'>
                                               <!-- <form class="form form-horizontal validate-form" id="frmleadProcess"  name="frmleadProcess" style="margin-bottom: 0;" method="post" action="#" accept-charset="UTF-8"><input name="authenticity_token" type="hidden" /> -->
                                               <div class='step-pane active' id='step1'>
                                                   <div class='box-header blue-background'>
                                                          <div class='title'>New Contract</div>
                                                   </div>
                                                   <div class="box-content">
                                                       <?php if(empty($resultStatus->contract_id) || $edit_mode == "edit") {  ?>
                                                        <form class="form form-horizontal validate-form" name="frmContract" id="frmContract" action="{{ URL::to('contract-process/'.$step_no) }}" method="post">
                                                            <div class='form-group'>
                                                              <label class='control-label col-sm-3' for='validation_name'>Maid Name</label>
                                                              <div class='controls col-sm-6' id="maidname">
                                                                  <input type="hidden" name="inform_from" id="inform_from" value="{{ $info_from }}" />
                                                                  <input type="hidden" name="customerId" id="customerId" value="{{ $customerId }}" />
                                                                   <select class='select2 form-control' name="bio_id" id="bio_id"  data-rule-required="true">
                                                                       <option value=''></option>
                                                                       @if(!empty($maid))
                                                                         @foreach($maid as $maidList)
                                                                         <option value='{{ $maidList->id }}'>{{{ $maidList->maid_name  }}}</option>
                                                                         @endforeach
                                                                       @endif
                                                                      </select>
                                                              </div>
                                                          </div>
                                                          <div class='form-group'>
                                                               <label class='control-label col-sm-3' for='branch_list'>Fees</label>
                                                               <div class='controls col-sm-6' id="feetypes">
                                                                  <!-- <div class='controls col-sm-6'>
                                                                    <input  type="checkbox" id="admin_fee" name="fee[]" value='1'> Admin Fee <input class='form-control' id='admin_fee_val' name='admin_fee_val' placeholder='0' value='0' type='text' readonly="readonly"/>
                                                                    <input  type="checkbox" id="ins_fee" name="fee[]" value='2'> Insurance Fee <input class='form-control' id='ins_fee_val' name='ins_fee_val' placeholder='0' value='0' type='text' readonly="readonly"/>
                                                                    <input  type="checkbox" id="agency_fee" name="fee[]" value='3'> Agency Fee <input class='form-control' id='agency_fee_val' name='agency_fee_val' placeholder='0' value='0' type='text' readonly="readonly"/>
                                                                  </div> -->
                                                                      <!-- <select class='select2 form-control' multiple placeholder='Try typing some fee type' data-rule-required="true"  name="fee_type[]" id="fee_type">
                                                                          @foreach($feeType as $key => $feeList)
                                                                          <option value='{{ $key }}'>{{{ $feeList }}}</option>
                                                                          @endforeach
                                                                      </select> -->
                                                                  <table class="table table-striped table-hover table-bordered">
                                                                    <thead>
                                                                      <tr>                                                                        
                                                                        <th>Fee Type</th>
                                                                        <th>Fee Amount</th>
                                                                        <th>Paid Amount</th>
                                                                        
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                      <tr>                                                                       
                                                                        <td>Admin Fee</td>
                                                                        <td>
                                                                          <div class="col-sm-12">
                                                                            <input class='form-control text-right' id='admin_fee_val' name='admin_fee_val'  value='0' data-rule-required="true" placeholder='' type='text' />
                                                                          </div>
                                                                        </td>
                                                                        <td>
                                                                          <div class="col-sm-12">
                                                                            <input class='form-control text-right' id='paid_admin_fee_val' name='paid_admin_fee_val'  value='0' data-rule-required="true" placeholder='' type='text' />
                                                                          </div>
                                                                        </td>                                                                        
                                                                      </tr>
                                                                      <tr>                                                                       
                                                                        <td>Insurance Fee</td>
                                                                        <td>
                                                                          <div class="col-sm-12">
                                                                            <input class='form-control text-right' id='ins_fee_val' name='ins_fee_val'  value='0' data-rule-required="true" placeholder='' type='text'/>
                                                                          </div>
                                                                        </td>
                                                                        <td>
                                                                          <div class="col-sm-12">
                                                                            <input class='form-control text-right' id='paid_ins_fee_val' name='paid_ins_fee_val'  value='0' data-rule-required="true" placeholder='' type='text' />
                                                                          </div>
                                                                        </td>                                                                        
                                                                      </tr>
                                                                      <tr>                                                                        
                                                                        <td>Agency Fee</td>
                                                                        <td>
                                                                          <div class="col-sm-12">
                                                                            <input class='form-control text-right' id='agency_fee_val' name='agency_fee_val'  value='0' data-rule-required="true" placeholder='' type='text' />
                                                                          </div>
                                                                        </td>
                                                                        <td>
                                                                          <div class="col-sm-12">
                                                                            <input class='form-control text-right' id='paid_agency_fee_val' name='paid_agency_fee_val'  value='0' data-rule-required="true" placeholder='' type='text' />
                                                                          </div>
                                                                        </td>                                                                        
                                                                      </tr>
                                                                      <tr>
                                                                        <td>Total</td>
                                                                        <td>
                                                                          <div class="col-sm-12">
                                                                            <input class='form-control text-right' id='target_fee' name='target_fee' pay-amount="true"  value='0' data-rule-required="true" placeholder='' type='text' readonly />
                                                                          </div>
                                                                        </td>
                                                                        <td>
                                                                          <div class="col-sm-12">
                                                                            <input class='form-control text-right' id='paid_total' name='paid_total'  value='0' data-rule-required="true" placeholder='' type='text' readonly/>
                                                                          </div>
                                                                        </td>
                                                                        
                                                                      </tr>                                                                      
                                                                    </tbody>
                                                                  </table>
                                                               </div>
                                                           </div>
                                                           <div>
                                                                        <!-- <div class="form-group">
                                                                              <label class='control-label col-sm-3' for='target_fee'>Target fee to pay</label>
                                                                              <div class='controls col-sm-6' id="targetfee">
                                                                                  <input class='form-control' id='target_fee' name='target_fee'  value='0' data-rule-required="true" placeholder='Target fee' type='text' readonly="readonly"/> 
                                                                              </div>
                                                                         </div> --> 
                                                                        <div class="form-group">
                                                                             <label class='control-label col-sm-3' for='pay_mode'>Pay Mode</label>
                                                                             <div class='controls col-sm-6' id="paymode">
                                                                                <select class='form-control' id='pay_mode' name='pay_mode'>
                                                                                    @foreach($payMode as $key => $list)
                                                                                    <option value="{{{ $key }}}">{{{ $list }}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                             </div>
                                                                        </div>  
                                                                        <!-- <div class="form-group">
                                                                             <label class='control-label col-sm-3' for='pay_amt'>Pay Amount</label>
                                                                             <div class='controls col-sm-6' id="payamt">
                                                                                  <input class='form-control' id='pay_amt' name='pay_amt' pay-check="true" data-rule-required="true" data-rule-minlength="2" placeholder='Pay Amount' type='text' /> 
                                                                             </div>
                                                                        </div> -->
                                                                        <div class="form-group cheque-info">
                                                                             <label class='control-label col-sm-3' for='bank_name'>Bank Name</label>
                                                                             <div class='controls col-sm-6' id="bankname">
                                                                                  <input class='form-control' id='bank_name' name='bank_name'  data-rule-required="true" data-rule-minlength="2" placeholder='Bank Name' type='text' /> 
                                                                             </div>
                                                                        </div>
                                                                        <div class="form-group cheque-info">
                                                                             <label class='control-label col-sm-3' for='cheque_no'>Cheque no</label>
                                                                             <div class='controls col-sm-6' id="chequeno">
                                                                                  <input class='form-control' id='cheque_no' name='cheque_no'  data-rule-required="true" data-rule-minlength="2" placeholder='Cheque number' type='text' /> 
                                                                             </div>
                                                                        </div>
                                                                        <div class="form-group cheque-info">
                                                                            <label class='control-label col-sm-3' for='cheque_date'>Cheque Date</label>
                                                                             <div class='controls col-sm-6 datepicker-input input-group' id="chequedate">
                                                                                  <input class='form-control' id='cheque_date' name='cheque_date'  data-rule-required="true" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                                  <span class="input-group-addon">
                                                                                   <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                                  </span>
                                                                             </div>
                                                                             <div class='col-sm-9 pull-right'> 
                                                                                  <span class="help-block has-error" for="cheque_date"></span>
                                                                             </div>
                                                                        </div>
                                                                        <!-- <div class="form-group cheque-info">
                                                                             <label class='control-label col-sm-3' for='cheque'>Pay Name</label>
                                                                             <div class='controls col-sm-6' id="payname">
                                                                                  <input class='form-control' id='pay_name' name='pay_name'  data-rule-required="true" data-rule-minlength="2" placeholder='Cheque Name' type='text' /> 
                                                                             </div>
                                                                        </div> -->
<!--                                                                         <div class="form-group">
                                                                             <label class='control-label col-sm-3' for='confirm_fees'>Confirm fees / Collected</label>
                                                                             <div class='controls col-sm-6' id="bankname">
                                                                                 <input  type="checkbox" value="1" id="con_fee_coll" name="con_fee_coll">
                                                                             </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label class='control-label col-sm-3' for='issue_date'>Issue Date</label>
                                                                             <div class='controls col-sm-6  input-group' id="issuedate">
                                                                                  <input class='form-control datepicker-input' id='issue_date' name='issue_date'  data-rule-required="true" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                                  <span class="input-group-addon">
                                                                                   <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                                  </span>
                                                                             </div>
                                                                             <div class='col-sm-9 pull-right'> 
                                                                                  <span class="help-block has-error" for="issue_date"></span>
                                                                             </div>
                                                                        </div>
                                                                <div class="form-group">
                                                                                  <label class='control-label col-sm-3' for='collected'>If Loan</label>
                                                                                  <div class='controls col-sm-6' id="bankname">
                                                                                      <input  type="checkbox" value="1" id="get_loan" name="get_loan">
                                                                                  </div>
                                                                </div>
                                                               <div class='form-group loan-opt'>
                                                                     <label class='control-label col-sm-3' for='loan_amount'>Loan Amount</label>
                                                                     <div class='controls col-sm-6 loan-opt'>
                                                                         <input class='form-control' id='loan_amt' name='loan_amt'  data-rule-required='true' data-rule-minlength='2' placeholder='Loan Amount' type='text' />
                                                                     </div>
                                                               </div>
                                                               <div class='form-group loan-opt'>
                                                                 <label class='control-label col-sm-3' for='loan_amount'>Repayment Date</label>
                                                                     <div class='controls col-sm-6 datepicker-input input-group'>
                                                                         <input class='form-control' id='repay_date' name='repay_date'  data-rule-required='true' data-rule-minlength='2' data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' />
                                                                             <span class='input-group-addon'>
                                                                                 <span class='icon-calendar' data-time-icon='icon-time' data-date-icon='icon-calendar'></span>
                                                                             </span>
                                                                     </div>
                                                                     <div class='col-sm-9 pull-right'>
                                                                         <span class='help-block has-error' for='repay_date'></span>
                                                                         </div>
                                                               </div>
                                                               <div class='form-group loan-opt'>
                                                                     <label class='control-label col-sm-3' for='loan_amount'>Loan tenure(in months)</label>
                                                                         <div class='controls col-sm-6'>
                                                                         <select name='tenure_mths' id='tenure_mths'  class='form-control loan-opt'>
                                                                          <?php for($i = 2; $i <= 15; $i++) { ?>
                                                                          <option value='<?php echo $i; ?>'><?php echo $i; ?> months</option>
                                                                          <?php } ?>
                                                                         </select>
                                                                         </div>
                                                                </div> -->
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='from_date'>Contract Schedule From Date</label>
                                                                <div class='controls col-sm-6  input-group' id="issuedate">
                                                                     <input class='form-control datepicker-input' id='cs_from_date' name='cs_from_date'  data-rule-required="true" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                     <span class="input-group-addon">
                                                                      <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                     </span>
                                                                </div>
                                                                <div class='col-sm-9 pull-right'> 
                                                                     <span class="help-block has-error" for="cs_from_date"></span>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='to_date'>Contract Schedule To Date</label>
                                                                <div class='controls col-sm-6  input-group' id="issuedate">
                                                                     <input class='form-control datepicker-input' id='cs_to_date' name='cs_to_date'  data-rule-required="true" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                     <span class="input-group-addon">
                                                                      <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                     </span>
                                                                </div>
                                                                <div class='col-sm-9 pull-right'> 
                                                                     <span class="help-block has-error" for="cs_to_date"></span>
                                                                </div>
                                                           </div>
                                                           <div class='form-group'>
                                                               <label class='control-label col-sm-3' for='contract_terms'>Contract terms(in months)</label>
                                                               <div class='controls col-sm-6'>
                                                                         <select name='contract_terms' id='contract_terms'  class='form-control contract-terms'>
                                                                          <?php for($i = 2; $i <= 60; $i++) { ?>
                                                                          <option value='<?php echo $i; ?>'><?php echo $i; ?> months</option>
                                                                          <?php } ?>
                                                                         </select>
                                                               </div>
                                                           </div>
                                                           <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                        <button class="btn-primary btn" type="submit" id="save-contract">Save &amp; Submit</button>
                                                                        <button class="btn-default btn resetbtn" type="button">Reset</button>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                           </div>  
                                                       </form>
                                                       <?php } else { ?> 
                                                       <form class="form form-horizontal validate-form">
                                                        <div class='form-group'>
                                                              <label class='control-label col-sm-3' for='validation_name'>Maid Name</label>
                                                              <div class='controls col-sm-6' id="maidname">
                                                                  <label  class="control-label">{{ ucwords($resultStatus->maid_name)  }}</label>
                                                              </div>
                                                          </div>
                                                          <div class='form-group'>
                                                               <label class='control-label col-sm-3' for='branch_list'>Fee Types</label>
                                                               <div class='controls col-sm-6' id="feetypes">
                                                                   <?php $feeList= ''; 
                                                                   foreach($feeArray as $val) {
                                                                       $feeList .= $feeType[$val].','; 
                                                                   }
                                                                   ?>
                                                                   <label  class="control-label">{{  trim($feeList,',') }}</label>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='from_date'>Contract Schedule From Date</label>
                                                                <div class='controls col-sm-6' id="issuedate">
                                                                     <label  class="control-label">{{ $resultStatus->contract_from }}</lable>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='to_date'>Contract Schedule To Date</label>
                                                                <div class='controls col-sm-6' id="issuedate">
                                                                     <label class="control-label">{{ $resultStatus->contract_to }}</lable>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='to_date'>Contract Terms</label>
                                                                <div class='controls col-sm-6' id="issuedate">
                                                                     <label  class="control-label">{{ $resultStatus->contract_terms.'&nbsp;months' }}</lable>
                                                                </div>
                                                           </div>
                                                           
                                                           <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                          <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$contract_id.'/edit') }}'>Edit</a>
                                                                          <a href="#loan-modal" data-toggle="modal" class="btn btn-primary ">Opt Loan</a>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                           </div>  
                                                       </form>
                                                       @if(!empty($invoice_list) && Session::get('role') == 1)
                                                       <div class="row">
                                                            <div class="col-lg-12">
                                                                <h3>Invoice Collection</h3>
                                                                <div class="pull-left" style="margin-bottom:10px;"><a href="#compose-mail" data-toggle="modal" class="btn btn-primary  btn-xs">Pay Balance Amt</a></div>
                                                                <table width="100%" border="1">
                                                                    <tr>
                                                                        <th width="7%">Version no</th>
                                                                        <th width="10%" style="text-align:center;">Invoice no</th>
                                                                        <th width="10%" style="text-align:center;">Invoice Date</th>
                                                                        <th>Fee Collected</th>
                                                                        <th>Target Fee</th>
                                                                        <th>Paid Amt</th>
                                                                        <th>Balance Amt</th>
                                                                        <!-- <th>Action</th> -->
                                                                    </tr>
                                                                    @foreach($invoice_list as $key => $list)
                                                                        <?php $feeList= ''; 
                                                                            $feeArray = explode(',',$list->fee_type);
                                                                            foreach($feeArray as $val) {
                                                                                $feeList .= $feeType[$val].','; 
                                                                            }
                                                                       ?>
                                                                    <tr>
                                                                        <td align="center">{{ '1.0'.$list->version_no }}</td>
                                                                        <td align="center">{{ $list->invoice_no }}</td>
                                                                        <td align="center">{{ date('d-m-Y',strtotime($list->invoice_date)) }}</td>
                                                                        <td>{{ trim($feeList,',') }}</td>
                                                                        <td align="right">{{ '$'.$list->target_fee }}</td>
                                                                        <td align="right">{{ '$'.$list->paid_amt }}</td>
                                                                        <td align="right">{{ '$'.$list->bal_amt }}</td>
                                                                        <!-- <td>edit</td> -->
                                                                    </tr>
                                                                    <tr>
                                                                      <td colspan="4" align="right">Admin Fee</td>
                                                                      <td align="right">{{ '$'.number_format($list->admin_fee,2) }}</td>
                                                                      <td align="right">{{ '$'.number_format($list->paid_admin_fee,2) }}</td>
                                                                      <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td colspan="4" align="right">Insurance Fee</td>
                                                                      <td align="right">{{ '$'.number_format($list->insurance_fee,2) }}</td>
                                                                      <td align="right">{{ '$'.number_format($list->paid_ins_fee,2) }}</td>
                                                                      <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td colspan="4" align="right">Agency Fee</td>
                                                                      <td align="right">{{ '$'.number_format($list->agency_fee,2) }}</td>
                                                                      <td align="right">{{ '$'.number_format($list->paid_agency_fee,2) }}</td>
                                                                      <td></td>
                                                                    </tr>
                                                                    <?php //$totalAmt = $totalAmt+$list->paid_amt; ?>
                                                                    @endforeach
                                                                    <tr>
                                                                        <td colspan="5" align="right">Total Fee Collected</td>
                                                                        <td colspan="2" align="left">{{ '$'.number_format($invoice_list[0]->paid_amt,2) }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                       </div>
                                                       @endif
                                                       <?php if(!empty($invoice_list)) {
                                                             $lastInvoiceInfo = end($invoice_list); ?>
                                                                    <div class='modal fade' id='compose-mail' tabindex='-1'>
                                                                            <div class='modal-dialog'>
                                                                                <div class='modal-content'>
                                                                                  <div class='modal-header'>
                                                                                    <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                                                                    <h4 class='modal-title' id='myModalLabel'>Contract Balance Payment</h4>
                                                                                  </div>
                                                                                  <form class="form validate-form" style="margin-bottom: 0;" method="post" action="{{ URL::to('contract/balance-payment') }}" accept-charset="UTF-8">
                                                                                    <input name="contractId" name="contractId" type="hidden" value="{{ $lastInvoiceInfo->fkContractId }}"/>
                                                                                    <input name="invoice_no" name="invoice_no" type="hidden" value="{{ $lastInvoiceInfo->invoice_no }}"/>
                                                                                    <input name="admin_fee"  type="hidden" value="{{ $lastInvoiceInfo->admin_fee }}"/>
                                                                                    <input name="ins_fee"  type="hidden" value="{{ $lastInvoiceInfo->insurance_fee }}"/>
                                                                                    <input name="agency_fee"  type="hidden" value="{{ $lastInvoiceInfo->agency_fee }}"/>
                                                                                    <div class='modal-body'>
                                                                                        <div class="form-group">
                                                                                            <label for='target_fee'>Target fee to pay</label>
                                                                                            <input class='form-control' id='target_fee' name='target_fee'  data-rule-required="true" placeholder='Target fee' type='text' value="{{ $lastInvoiceInfo->target_fee }}" readonly="readonly"/> 
                                                                                       </div> 
                                                                                       <div class="form-group">
                                                                                            <label for='pay_amt'>Paid Amt</label>
                                                                                            <input class='form-control' id='paid_amt' name='paid_amt'  data-rule-required="true" placeholder='Paid Amt' type='text' value="{{ $lastInvoiceInfo->paid_amt }}" readonly="readonly"/>                                                                                        </div> 
                                                                                       <div class="form-group">
                                                                                            <label for='bal_amt'>Balance Amount</label>
                                                                                            <input class='form-control' id='bal_amt' name='bal_amt'  data-rule-required="true" placeholder='Bal Amt' type='text' value="{{ $lastInvoiceInfo->bal_amt }}" readonly="readonly"/> 
                                                                                       </div> 
                                                                                       <div class="form-group">
                                                                                            <label for='pay_mode'>Pay Mode</label>
                                                                                              <select class='form-control' id='pay_mode' name='pay_mode'>
                                                                                                   @foreach($payMode as $key => $list)
                                                                                                   <option value="{{{ $key }}}">{{{ $list }}}</option>
                                                                                                   @endforeach
                                                                                               </select>
                                                                                       </div>  
                                                                                       <div class="form-group">
                                                                                            <label for='pay_amt'>Pay Amount</label>
                                                                                                 <!-- <input class='form-control' id='pay_amt' name='pay_amt' pay-check="true" data-rule-required="true" data-rule-minlength="2" placeholder='Pay Amount' type='text' /> --> 
                                                                                                 <table class="table table-striped table-hover table-bordered">
                                                                                                    <thead>
                                                                                                      <tr>                                                                        
                                                                                                        <th>Fee Type</th>
                                                                                                        <th>Balance Fee Amount</th>
                                                                                                        <th>Pay Amount</th>
                                                                                                        
                                                                                                      </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                      <tr>                                                                       
                                                                                                        <td>Admin Fee</td>
                                                                                                        <td>
                                                                                                          <div class="col-sm-12">
                                                                                                            <input class='form-control text-right' id='bal_admin_fee_val' name='bal_admin_fee_val'  value="{{ $invoice_list[0]->bal_admin_fee }}" data-rule-required="true" placeholder='' type='text' readonly />
                                                                                                          </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                          <div class="col-sm-12">
                                                                                                            <input class='form-control text-right' id='paid_admin_fee_val' name='paid_admin_fee_val'  value='0' data-rule-required="true" placeholder='' type='text' />
                                                                                                          </div>
                                                                                                        </td>                                                                        
                                                                                                      </tr>
                                                                                                      <tr>                                                                       
                                                                                                        <td>Insurance Fee</td>
                                                                                                        <td>
                                                                                                          <div class="col-sm-12">
                                                                                                            <input class='form-control text-right' id='bal_ins_fee_val' name='bal_ins_fee_val'  value="{{ $invoice_list[0]->bal_ins_fee }}" data-rule-required="true" placeholder='' type='text' readonly/>
                                                                                                          </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                          <div class="col-sm-12">
                                                                                                            <input class='form-control text-right' id='paid_ins_fee_val' name='paid_ins_fee_val'  value='0' data-rule-required="true" placeholder='' type='text' />
                                                                                                          </div>
                                                                                                        </td>                                                                        
                                                                                                      </tr>
                                                                                                      <tr>                                                                        
                                                                                                        <td>Agency Fee</td>
                                                                                                        <td>
                                                                                                          <div class="col-sm-12">
                                                                                                            <input class='form-control text-right' id='bal_agency_fee_val' name='bal_agency_fee_val'  value="{{ $invoice_list[0]->bal_agency_fee }}" data-rule-required="true" placeholder='' type='text' readonly />
                                                                                                          </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                          <div class="col-sm-12">
                                                                                                            <input class='form-control text-right' id='paid_agency_fee_val' name='paid_agency_fee_val'  value='0' data-rule-required="true" placeholder='' type='text' />
                                                                                                          </div>
                                                                                                        </td>                                                                        
                                                                                                      </tr>                                                                                                                                                                        
                                                                                                    </tbody>
                                                                                                  </table>
                                                                                       </div>
                                                                                       <div class="form-group cheque-info">
                                                                                           <label class='control-label' for='bank_name'>Bank Name</label>
                                                                                           <div class='controls' id="bankname">
                                                                                                <input class='form-control' id='bank_name' name='bank_name'  data-rule-required="true" data-rule-minlength="2" placeholder='Bank Name' type='text' /> 
                                                                                           </div>
                                                                                      </div>
                                                                                      <div class="form-group cheque-info">
                                                                                           <label class='control-label' for='cheque_no'>Cheque no</label>
                                                                                           <div class='controls' id="chequeno">
                                                                                                <input class='form-control' id='cheque_no' name='cheque_no'  data-rule-required="true" data-rule-minlength="2" placeholder='Cheque number' type='text' /> 
                                                                                           </div>
                                                                                      </div>
                                                                                      <div class="form-group cheque-info">
                                                                                          <label class='control-label' for='cheque_date'>Cheque Date</label>
                                                                                           <div class='controls datepicker-input input-group' id="chequedate">
                                                                                                <input class='form-control' id='cheque_date' name='cheque_date'  data-rule-required="true" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                                                <span class="input-group-addon">
                                                                                                 <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                                                </span>
                                                                                           </div>
                                                                                           <div class='col-sm-9 pull-right'> 
                                                                                                <span class="help-block has-error" for="cheque_date"></span>
                                                                                           </div>
                                                                                      </div>
                                                                                       <div class="form-group">
                                                                                            <label for='confirm_fees'>Confirm fees / Collected</label>
                                                                                                <input type="checkbox" value="1" id="con_fee_coll" name="con_fee_coll">
                                                                                       </div>
                                                                                       <div class="form-group">
                                                                                           
                                                                                           <label for='issue_date'>Issue Date</label>
                                                                                           <div class="col-sm-9  input-group">
                                                                                                 <input class='form-control datepicker-input' id='issue_date' name='issue_date'  data-rule-required="true" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                                                 <span class="input-group-addon">
                                                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                                                 </span>
                                                                                           </div>
                                                                                       </div>
                                                                                       <hr class='hr-normal'>
                                                                                   </div>
                                                                                   <div class='modal-footer'>
                                                                                      <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                      <button class='btn btn-primary' type='submit'>Pay Fee</button>
                                                                                   </div>
                                                                                  </form>
                                                                                </div>
                                                                              </div>
                                                                            </div><!-- pay balance modal-->      
                                                                            <!--loan form-->
                                                                          <div class='modal fade' id='loan-modal' tabindex='-1'>
                                                                            <div class='modal-dialog'>
                                                                                <div class='modal-content'>
                                                                                  <div class='modal-header'>
                                                                                    <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                                                                    <h4 class='modal-title' id='myModalLabel'>Opt for Loan</h4>
                                                                                  </div>
                                                                                  <form class="form validate-form" style="margin-bottom: 0;" method="post" action="{{ URL::to('contract/opt-loan') }}" accept-charset="UTF-8">
                                                                                    <input name="contractId" name="contractId" type="hidden" value="{{ $lastInvoiceInfo->fkContractId }}"/>                                                                                    
                                                                                    <div class='modal-body'>
                                                                                        <div class='form-group loan-opt'>
                                                                                             <label class='control-label ' for='loan_amount'>Loan Amount</label>
                                                                                             <div class='controls  loan-opt'>
                                                                                                 <input class='form-control' id='loan_amt' name='loan_amt'  data-rule-required='true' data-rule-minlength='2' placeholder='Loan Amount' type='text' />
                                                                                             </div>
                                                                                       </div>
                                                                                       <div class='form-group loan-opt'>
                                                                                         <label class='control-label ' for='loan_amount'>Repayment Date</label>
                                                                                             <div class='controls  datepicker-input input-group'>
                                                                                                 <input class='form-control' id='repay_date' name='repay_date'  data-rule-required='true' data-rule-minlength='2' data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' />
                                                                                                     <span class='input-group-addon'>
                                                                                                         <span class='icon-calendar' data-time-icon='icon-time' data-date-icon='icon-calendar'></span>
                                                                                                     </span>
                                                                                             </div>
                                                                                             <div class=' pull-right'>
                                                                                                 <span class='help-block has-error' for='repay_date'></span>
                                                                                                 </div>
                                                                                       </div>
                                                                                       <div class='form-group loan-opt'>
                                                                                             <label class='control-label ' for='loan_amount'>Loan tenure(in months)</label>
                                                                                                 <div class='controls '>
                                                                                                 <select name='tenure_mths' id='tenure_mths'  class='form-control loan-opt'>
                                                                                                  <?php for($i = 2; $i <= 15; $i++) { ?>
                                                                                                  <option value='<?php echo $i; ?>'><?php echo $i; ?> months</option>
                                                                                                  <?php } ?>
                                                                                                 </select>
                                                                                                 </div>
                                                                                        </div>
                                                                                       <hr class='hr-normal'>
                                                                                   </div>
                                                                                   <div class='modal-footer'>
                                                                                      <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                      <button class='btn btn-primary' type='submit'>Pay Fee</button>
                                                                                   </div>
                                                                                  </form>
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                            <!--loan form-->                                                
                                                           <?php } ?>
                                                         </div><!-- -->
                                                       <?php } ?>
                                                      </div>
                                              </div>

                                              <div class='step-pane' id='step2'>
                                                <div class='box-header blue-background'>
                                                    <div class='title'>Application</div>
                                                </div>
                                                <div class='box-content'>
                                                    <?php if(empty($resultStatus->app_id) || $resultStatus->app_status || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('contract-process/'.$step_no) }}" name="frmApplication" id="frmApplication" method="post">
                                                        <div class="form-group">
                                                            <label class='control-label col-sm-3' for='app_no'>Contract no</label>
                                                            <div class='controls col-sm-6'>
                                                                <label class='control-label'>@if(Session::has('contract_no')) {{ Session::get('contract_no') }} @endif</label>
                                                                <input type="hidden" name="contract_id" id="contract_id" value="{{ isset($contract_id) ? $contract_id : '' }}" />
                                                                <input type="hidden" name="app_status" id="app_status" value="{{ !empty($resultStatus) ? $resultStatus->app_status : '' }}" />
                                                         
                                                            </div>
                                                       </div>
                                                     <div class="form-group">
                                                            <label class='control-label col-sm-3' for='app_no'>Application no</label>
                                                            <div class='controls col-sm-6' id="v_app_no">
                                                                 <input class='form-control' id='app_no' name='app_no'  data-rule-required="true" data-rule-minlength="2" placeholder='Application number' type='text' /> 
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='application date'>Application Date</label>
                                                            <div class='controls col-sm-6 datepicker-input input-group' id="v_aissue_date">
                                                                 <input class='form-control datepicker-input' id='issue_date' name='issue_date'  data-rule-required="true" data-rule-minlength="2" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="issue_date"></span>
                                                            </div>
                                                       </div>
                                                      <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                    <button class="btn-primary btn" type="submit" id="save-app">Save &amp; Submit</button>
                                                                    <!--<button class="btn-default btn resetbtn" type="button">Reset</button>-->
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form>
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                @if(!empty($app_list))   
                                                                <h3>Applications Submitted</h3>                                                                
                                                                <table width="50%" border="1">
                                                                    <tr>
                                                                        <th width="1%" align="center">Sno</th>
                                                                        <th width="20%" style="text-align: center;">Application No</th>
                                                                        <th width="20%" style="text-align: center;">Application Date</th>
                                                                        <!-- <th>Action</th> -->
                                                                    </tr> 
                                                                    @foreach($app_list as $key => $val)                                                       
                                                                    <tr>
                                                                        <td width="" align="center">{{ $key + 1 }}</td>
                                                                        <td width="" align="center">{{ $val->app_no }}</td>
                                                                        <td width="" align="center">{{ $val->date_customer_sign }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                                 @endif
                                                            </div>
                                                       </div>
                                                     <?php } else { ?>
                                                        <form class="form form-horizontal validate-form">
                                                        <div class="form-group">
                                                            <label class='control-label col-sm-3' for='app_no'>Contract no</label>
                                                            <div class='controls col-sm-6'>
                                                                <label class='control-label'>@if(Session::has('contract_no')) {{ Session::get('contract_no') }} @endif</label>
                                                            </div>
                                                       </div>
                                                     <div class="form-group">
                                                            <label class='control-label col-sm-3' for='app_no'>Application no</label>
                                                            <div class='controls col-sm-6' id="v_app_no">
                                                                <label class='control-label'>{{ $resultStatus->app_no }}</label>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='issue_date'>Application Date</label>
                                                            <div class='controls col-sm-6' id="v_aissue_date">
                                                                 <label class='control-label'>{{ $resultStatus->date_customer_sign }}</label>
                                                            </div>
                                                       </div>
                                                      <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                      <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$contract_id.'/edit') }}'>Update</a>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form>
                                                     <div class="row">
                                                            <div class="col-lg-12">
                                                                    @if(!empty($app_list))  
                                                                    <h3>Applications Submitted</h3>                                                                
                                                                    <table width="50%" border="1">
                                                                    <tr>
                                                                        <th width="1%" align="center">Sno</th>
                                                                        <th width="20%" style="text-align: center;">Application No</th>
                                                                        <th width="20%" style="text-align: center;">Application Date</th>
                                                                        <!-- <th>Action</th> -->
                                                                    </tr> 
                                                                    @foreach($app_list as $key => $val)                                                       
                                                                    <tr>
                                                                        <td width="" align="center">{{ $key + 1 }}</td>
                                                                        <td width="" align="center">{{ $val->app_no }}</td>
                                                                        <td width="" align="center">{{ $val->date_customer_sign }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    </table>
                                                                    @endif
                                                            </div>
                                                       </div>
                                                    <?php } ?>
                                                </div>
                                              </div>
                                              <div class='step-pane' id='step3'>
                                                <div class='box-header blue-background'>
                                                    <div class='title'>Application Approval</div>
                                                </div>
                                                <div class='box-content'>
                                                    <?php if(empty($resultStatus->app_approval_date) || $resultStatus->app_status == 0 || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('contract-process/'.$step_no) }}" name="frmAppApproval" id="frmAppApproval" method="post">
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='app_approval'>Application Status</label>
                                                            <div class='controls col-sm-6' id="c_app_approval">
                                                                   <select class='form-control' id='app_status' name='app_status'>
                                                                       @foreach($app_approve_status as $key => $list)
                                                                       @if($key != 3)
                                                                       <option value="{{{ $key }}}">{{{ $list }}}</option>
                                                                       @endif
                                                                       @endforeach
                                                                   </select>
                                                            </div>
                                                       </div>
                                                        <div class="form-group">
                                                           <label class='control-label col-sm-3' for='app_approval'>Application Approval Date</label>
                                                           <input type="hidden" name="prev_app_status" id="prev_app_status" value="{{ !empty($resultStatus) ? $resultStatus->app_status : '' }}" />
                                                           <input type="hidden" name="prev_app_no" id="prev_app_no" value="{{ !empty($resultStatus) ? $resultStatus->app_no : '' }}" />
                                                           <input type="hidden" name="prev_date_customer_sign" id="prev_date_customer_sign" value="{{ !empty($resultStatus) ? $resultStatus->date_customer_sign : '' }}" />
                                                           <div class='controls col-sm-6 datepicker-input input-group' id="c_app_approval">
                                                                 <input class='form-control datepicker-input' id='app_approval' name='app_approval'  data-rule-required="true" data-rule-minlength="2" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="app_approval"></span>
                                                            </div>
                                                       </div>
                                                        <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                    <button class="btn-primary btn" type="submit" id="save-approval">Save &amp; Submit</button>
                                                                    <!-- <button class="btn-default btn resetbtn" type="button">Reset</button> -->
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form>
                                                     <div class="row">
                                                            <div class="col-lg-12">
                                                                    @if(!empty($rViewAll))   
                                                                    <h3>Applications Submitted</h3>                                                                
                                                                    <table width="50%" border="1">
                                                                    <tr>
                                                                        <th width="8%" style="text-align: center;">Application No</th>
                                                                        <th width="20%" style="text-align: center;">Application Approval / Rejected Date</th>
                                                                        <th width="8%" style="text-align: center;">Application Status</th>                                                                       
                                                                        <!-- <th>Action</th> -->
                                                                    </tr> 
                                                                    @foreach($rViewAll as $val)                                                       
                                                                    <tr>
                                                                        <td width="" align="center">{{ $val->app_no }}</td>
                                                                        <td width="" align="center">{{ $val->app_approval_date }}</td>
                                                                        <td width="" align="center">{{ array_key_exists($val->app_status,$app_approve_status) ? $app_approve_status[$val->app_status] : '-' }}</td>                                                                       
                                                                    </tr>
                                                                    @endforeach
                                                                    </table>
                                                                    @endif
                                                            </div>
                                                       </div>
                                                    <?php } else { ?>
                                                            <form class="form form-horizontal validate-form">
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='app_approval'>Application Approval Date</label>
                                                                <div class='controls col-sm-6' id="c_app_approval">
                                                                    <label class='control-label'>{{ $resultStatus->app_approval_date }}</label>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='app_approval'>Application Status</label>
                                                                <div class='controls col-sm-6' id="c_app_approval">
                                                                         <label class='control-label'>{{ array_key_exists($resultStatus->app_status,$app_approve_status) ? $app_approve_status[$resultStatus->app_status] : '-' }}</label>
                                                                </div>
                                                           </div>
                                                          @if(!empty($resultStatus) && $resultStatus->app_status != 1)
                                                          <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                           <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$contract_id.'/edit') }}'>Update</a>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                           </div>
                                                           @endif
                                                        </form>
                                                         <div class="row">
                                                            <div class="col-lg-12">
                                                                @if(!empty($rViewAll)) 
                                                                <h3>Applications Submitted</h3>                                                                
                                                                <table width="50%" border="1">
                                                                    <tr>
                                                                        <th width="8%" style="text-align: center;">Application No</th>
                                                                        <th width="20%" style="text-align: center;">Application Approval / Rejected Date</th>
                                                                        <th width="8%" style="text-align: center;">Application Status</th>                                                                       
                                                                        <!-- <th>Action</th> -->
                                                                    </tr> 
                                                                    @foreach($rViewAll as $val)                                                       
                                                                    <tr>
                                                                        <td width="" align="center">{{ $val->app_no }}</td>
                                                                        <td width="" align="center">{{ $val->app_approval_date }}</td>
                                                                        <td width="" align="center">{{ array_key_exists($val->app_status,$app_approve_status) ? $app_approve_status[$val->app_status] : '-' }}</td>                                                                       
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                                @endif
                                                            </div>
                                                       </div>
                                                     <?php } ?>
                                                </div>
                                              </div>
                                              <div class='step-pane' id='step4'>
                                               <div class='box-header blue-background'>
                                                    <div class='title'>Insurance</div>
                                                </div>
                                                <div class='box-content'>
                                                     <?php if(empty($resultStatus->insurance_sub_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('contract-process/'.$step_no) }}" name="frmInsurance" id="frmInsurance" method="post">
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='ins_submission'>Insurance Submission Date</label>
                                                            <div class='controls col-sm-6 datepicker-input input-group' id="v_ins_sub_date">
                                                                  <input class='form-control datepicker-input' id='ins_sub_date' name='ins_sub_date'  data-rule-required="true" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                <span class="help-block has-error insub_date" for="ins_sub_date" style="color:#cf4a48;"></span>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='ins_completed'>Insurance Complete Date</label>
                                                            <div class='controls col-sm-6 datepicker-input input-group' id="v_ins_complete_date">
                                                                 <input class='form-control datepicker-input' id='ins_complete_date' name='ins_complete_date' data-format="YYYY-MM-DD"  data-rule-required="true"   placeholder='YYYY-MM-DD' type='text' /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="ins_complete_date"></span>
                                                            </div>
                                                       </div>
                                                        <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                    <button class="btn-default btn savebtnSubInsuranceData" type="button" data-id="{{ !empty($resultStatus) ? $resultStatus->app_id : '' }}" data-conid="{{ !empty($resultStatus) ? $resultStatus->contract_id : '' }}">Save</button>
                                                                    <button class="btn-primary btn" type="submit" id="save-insurance">Save &amp; Submit</button>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form>
                                                    <?php } else { ?>
                                                            <form class="form form-horizontal validate-form">
                                                                <div class="form-group">
                                                                    <label class='control-label col-sm-3' for='ins_submission'>Insurance Submission Date</label>
                                                                     <div class='controls col-sm-6' id="v_ins_sub_date">
                                                                          <label class='control-label'>{{ $resultStatus->insurance_sub_date }}</label>
                                                                     </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class='control-label col-sm-3' for='ins_complete'>Insurance Complete Date</label>
                                                                <div class='controls col-sm-6 datepicker-input input-group' id="v_ins_complete_date">
                                                                          <label class='control-label'>{{ $resultStatus->insurance_complete_date }}</label> 
                                                                     </div>
                                                                </div>
                                                                 <div class="panel-footer">
                                                                     <div class="row">
                                                                         <div class="col-sm-6 col-sm-offset-3">
                                                                           <div class="btn-toolbar">
                                                                                <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$contract_id.'/edit') }}'>Edit</a>
                                                                           </div>
                                                                         </div>
                                                                     </div>
                                                                </div> 
                                                            </form>
                                                    <?php } ?>
                                                </div>
                                              </div>
                                              <div class='step-pane' id='step5'>
                                               <div class='box-header blue-background'>
                                                    <div class='title'>Maid Arrival</div>
                                                </div>
                                                <div class='box-content'>
                                                    <?php if(empty($resultStatus->target_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('contract-process/'.$step_no) }}" name="frmMaidArrival" id="frmMaidArrival" method="post">
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='target_date'>Target maid arrival date</label>
                                                            <div class='controls col-sm-6 datepicker-input input-group' id="v_date_maid_arrival">
                                                                 <input class='form-control datepicker-input' id='target_date' name='target_date'  data-rule-required="true" data-rule-minlength="2" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error error_target_date" for="target_date" style="color:#cf4a48;"></span>
                                                            </div>
                                                       </div>
                                                        <div class="form-group">
                                                           <label class='control-label col-sm-3' for='mail_arrive'>Actual maid arrival date</label>
                                                            <div class='controls col-sm-6 datepicker-input input-group' id="v_date_maid_arrival">
                                                                 <input class='form-control datepicker-input' id='date_maid_arrival' name='date_maid_arrival'  data-rule-required="true" data-rule-minlength="2" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="date_maid_arrival"></span>
                                                            </div>
                                                       </div>
                                                       <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                    <button class="btn-default btn savebtn-targetdate" type="button" data-id="{{ !empty($resultStatus) ? $resultStatus->app_id : '' }}" data-conid="{{ !empty($resultStatus) ? $resultStatus->contract_id : '' }}">Save</button>
                                                                     <button class="btn-primary btn" type="submit" id="save-mail-arrival">Save &amp; Submit</button>
                                                                    <!-- <button class="btn-default btn resetbtn" type="button">Reset</button> -->
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form>
                                                     <?php } else { ?>
                                                           <form class="form form-horizontal validate-form">
                                                               <div class="form-group">
                                                                  <label class='control-label col-sm-3' for='target_date'>Target maid arrival date </label>
                                                                   <div class='controls col-sm-6' id="v_date_maid_arrival">
                                                                       <label class='control-label'>{{ $resultStatus->target_date }}</label>
                                                                   </div>
                                                              </div>
                                                              <div class="form-group">
                                                                  <label class='control-label col-sm-3' for='ins_submission'>Actual maid arrival date</label>
                                                                   <div class='controls col-sm-6' id="v_date_maid_arrival">
                                                                       <label class='control-label'>{{ $resultStatus->arrival_date }}</label>
                                                                   </div>
                                                              </div>
                                                              <div class="panel-footer">
                                                                   <div class="row">
                                                                       <div class="col-sm-6 col-sm-offset-3">
                                                                         <div class="btn-toolbar">
                                                                             <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$contract_id.'/edit') }}'>Edit</a>
                                                                          </div>
                                                                       </div>
                                                                   </div>
                                                              </div> 
                                                           </form>
                                                    <?php } ?>
                                                </div>
                                              </div>
                                              <div class='step-pane' id='step6'>
                                               <div class='box-header blue-background'>
                                                    <div class='title'>Handover</div>
                                                </div>
                                                <div class='box-content'>
                                                    <?php if(empty($resultStatus->handover_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('contract-process/'.$step_no) }}" name="frmHandOver" id="frmHandOver" method="post">
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='date_handover'>Date of Handover</label>
                                                            <div class='controls col-sm-6 datepicker-input input-group' id="v_date_handover">
                                                                 <input class='form-control' id='date_handover' name='date_handover'  data-rule-required="true" data-rule-minlength="2" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="date_handover"></span>
                                                            </div>
                                                       </div>
                                                       <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                    <button class="btn-primary btn" type="submit" id="save-handover">Save &amp; Submit</button>
                                                                    <!-- <button class="btn-default btn resetbtn" type="button">Reset</button> -->
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form>
                                                     <?php } else { ?>
                                                        <form class="form form-horizontal validate-form">
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='date_handover'>Date of Handover</label>
                                                                <div class='controls col-sm-6' id="v_date_handover">
                                                                    <label class='control-label'>{{ $resultStatus->handover_date }}</label>
                                                                </div>
                                                           </div>
                                                           <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                          <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$contract_id.'/edit') }}'>Edit</a>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                           </div> 
                                                        </form>
                                                    <?php } ?>
                                                </div>
                                              </div>
                                              <div class='step-pane' id='step7'>
                                               <div class='box-header blue-background'>
                                                    <div class='title'>E-Issue</div>
                                                </div>
                                                <div class='box-content'>
                                                     <?php if(empty($resultStatus->e_issue_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('contract-process/'.$step_no) }}" name="frmEIssue" id="frmEIssue" method="post">
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='date_e_issue'>Date of E-issue</label>
                                                            <div class='controls col-sm-6 datepicker-input input-group' id="v_eissue">
                                                                 <input class='form-control' id='date_e_issue' name='date_e_issue'  data-rule-required="true" data-rule-minlength="2" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="date_e_issue"></span>
                                                            </div>
                                                       </div>
                                                       <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                    <button class="btn-primary btn" type="submit" id="save-eissue">Save &amp; Submit</button>
                                                                    <!-- <button class="btn-default btn resetbtn" type="button">Reset</button> -->
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form>
                                                    <?php } else { ?>
                                                        <form class="form form-horizontal validate-form">
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='date_e_issue'>Date of E-issue</label>
                                                                <div class='controls col-sm-6' id="v_eissue">
                                                                    <label class='control-label'>{{ $resultStatus->e_issue_date }}</label>
                                                                </div>
                                                           </div>
                                                           <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                          <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$contract_id.'/edit') }}'>Edit</a>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                           </div> 
                                                        </form>
                                                    <?php } ?>
                                                </div>
                                              </div>
                                              <div class='step-pane' id='step8'>
                                               <div class='box-header blue-background'>
                                                    <div class='title'>Document Return</div>
                                                </div>
                                                <div class='box-content'>
                                                     <?php if(empty($resultStatus->doc_return_date) || $edit_mode == "edit") {  ?>
                                                      <form class="form form-horizontal validate-form" action="{{ URL::to('contract-process/'.$step_no) }}" name="frmdocreturn" id="frmdocreturn" method="post">
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='date_doc_return'>Date of Document return</label>
                                                            <div class='controls col-sm-6 datepicker-input input-group' id="v_docreturn">
                                                                 <input class='form-control' id='date_doc_return' name='date_doc_return'  data-rule-required="true" data-rule-minlength="2" data-format="YYYY-MM-DD"  placeholder='YYYY-MM-DD' type='text' /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="date_doc_return"></span>
                                                            </div>
                                                       </div>
                                                       <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                    <button class="btn-primary btn" type="submit" id="save-doc-return">Save &amp; Submit</button>
                                                                    <!-- <button class="btn-default btn resetbtn" type="button">Reset</button> -->
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form><?php } else { ?>
                                                      <form class="form form-horizontal validate-form">
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='date_doc_return'>Date of Document return</label>
                                                            <div class='controls col-sm-6' id="v_docreturn">
                                                                <label class='control-label'>{{ $resultStatus->doc_return_date }}</label>
                                                            </div>
                                                       </div>
                                                       <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                       <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$contract_id.'/edit') }}'>Edit</a>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form>
                                                    <?php } ?>
                                                </div>
                                              </div>
                                              <!--  </form> -->

                                            </div>
                                          </div>
                                        </div>
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
        var baseUrl  = <?php echo '"'.$baseUrl.'";' ?>
         $('.resetbtn').click(function(){
            $('#leadId').val('');
            $('#branch_list').val('');
            $('#pay_mode').val('1');
            $('#pay_amt').val('');
            $('#cheque_no').val('');
            $('#pay_name').val('');
            $('#bank_name').val('');
            $('#issue_date').val('');
        });
        $('.savebtnSubInsuranceData').click(function(){
            var sub_date =  $('#ins_sub_date').val();
            var app_id   =  $(this).data('id');
            var contract_id = $(this).data('conid');
            if(sub_date != '') {
                $('.insub_date').html('');
                $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'actionCall=update_insurance_subdate&in_sub_date='+sub_date+'&appId='+app_id+'&contract_id='+contract_id,
                         success:function(response) {
                            if(response == 1) {
                                alert('Insurance Submission Data updated Successfully')
                            } /*else {
                              $('#error-disp').html('Server problem.Try again')
                            }*/
                         }  
                 });
            } else {
                $('.insub_date').html('This field is required.');
            }
        });
        $('.savebtn-targetdate').click(function(){
            var target_date = $('#target_date').val();
            var app_id      = $(this).data('id');
            var contract_id = $(this).data('conid');
            if(target_date !='') {
                $('.error_target_date').html('');
                $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'actionCall=update_maid_target_date&target_date='+target_date+'&appId='+app_id+'&contract_id='+contract_id,
                         success:function(response) {
                            if(response == 1) {
                                alert('Target Date updated Successfully')
                            } 
                         }  
                 });
            } else {
                $('.error_target_date').html('This field is required.');
            }
                
        });
        $.validator.addMethod('pay-check', function(value, element, param) {
                return  parseInt(value) <= parseInt($('#target_fee').val());
        }, 'Pay amount should be less target fee amount');

         $.validator.addMethod('pay-amount', function(value, element, param) {
                return  parseInt(value) > 0;
        }, 'Fees amount should be greater than zero');

        var step_no    =  '<?php echo $step_no ?>';
        var div_id;
        var current = $('#mywizard .steps li').data('target');
        var step_array = [ "step1", "step2","step3","step4","step5","step6","step7","step8"];
        $.each(step_array,function(e,value){
            e = e +1;
            div_id = "#"+value;
            if(step_no != value) {
                $(div_id).css('display','none');
                $("#t"+e).removeClass("active");  
            } else {
                $("#t"+e).addClass("active");  
            }
        });
        
        $("#feetypes").on("change", function(e) {  
                if(!$.isEmptyObject(e.added)) { // if add fee amount
                    if(e.added.id != 4) {
                        $.ajax({
                            type :'POST',
                            url  : baseUrl+'contract/ajax-call',
                            data : 'actionCall=cal_target_fee&getId='+e.added.id,
                            success : function(response) {
                                var obj = $.parseJSON(response);
                                var target_amt;
                                if(!$.isEmptyObject(obj)) {
                                    if($('#target_fee').val() == '') {
                                        target_amt = parseInt(obj.fee_amt);
                                    } else {
                                        target_amt = parseInt($('#target_fee').val())+parseInt(obj.fee_amt);
                                    }
                                    $('#target_fee').val(target_amt);
                                }
                            }
                        });
                    }

                } else if(!$.isEmptyObject(e.removed)) { // if remove fee amount
                   if(e.removed.id != 4) {
                        $.ajax({
                            type :'POST',
                            url  : baseUrl+'contract/ajax-call',
                            data : 'actionCall=cal_target_fee&getId='+e.removed.id,
                            success : function(response) {
                                var obj = $.parseJSON(response);
                                var target_amt;
                                if(!$.isEmptyObject(obj)) {
                                    target_amt = parseInt($('#target_fee').val())-parseInt(obj.fee_amt);
                                    if(target_amt != 0)
                                        $('#target_fee').val(target_amt);
                                    else
                                        $('#target_fee').val('');
                                }
                            }
                        });
                    } 
                }
        });
        
        //fee types checkbox handlers
        function calc_target_fee(){
          admin_fee = parseInt($("#admin_fee_val").val());
          ins_fee = parseInt($("#ins_fee_val").val());
          agency_fee = parseInt($("#agency_fee_val").val());
          tfee = admin_fee+ins_fee+agency_fee;
          console.log(tfee);
          $("#target_fee").val(tfee);
        }

        function calc_paid_fee(){
          paid_admin_fee = parseInt($("#paid_admin_fee_val").val());
          paid_ins_fee = parseInt($("#paid_ins_fee_val").val());
          paid_agency_fee = parseInt($("#paid_agency_fee_val").val());
          paid_tfee = paid_admin_fee+paid_ins_fee+paid_agency_fee;
          console.log(paid_tfee);
          $("#paid_total").val(paid_tfee);
        }

        var tfee = 0;
        $("#admin_fee").click(function(){
          if($(this).is(':checked')){
            $("#admin_fee_val").removeAttr("readonly","readonly");
            $("#admin_fee_val").val('');
          }
          else {
            $("#admin_fee_val").attr("readonly","readonly");
            $("#admin_fee_val").val(0);
            calc_target_fee();
          }
        });

        
        $("#ins_fee").click(function(){
          if($(this).is(':checked')){
            $("#ins_fee_val").removeAttr("readonly","readonly");
            $("#ins_fee_val").val('');
          }
          else {
            $("#ins_fee_val").attr("readonly","readonly");
            $("#ins_fee_val").val(0);
            calc_target_fee();
          }
        });

        $("#agency_fee").click(function(){
          if($(this).is(':checked')){
            $("#agency_fee_val").removeAttr("readonly","readonly");
            $("#agency_fee_val").val('');
          }
          else {
            $("#agency_fee_val").attr("readonly","readonly");
            $("#agency_fee_val").val(0);
            calc_target_fee();
          }
        });

        $("#admin_fee_val").focusout(function(){  
          if($(this).val()!=''){
            calc_target_fee();      
            }
          else{
            $(this).val(0);
            calc_target_fee();
          }    
        });

        $("#ins_fee_val").focusout(function(){   
          if($(this).val()!=''){
            calc_target_fee();      
            }
          else{
            $(this).val(0); 
            calc_target_fee();            
          } 
          
        });

        $("#agency_fee_val").focusout(function(){   
          if($(this).val()!=''){
            calc_target_fee();      
            }
          else{
            $(this).val(0); 
            calc_target_fee();            
          }          
        });

        $("#paid_admin_fee_val").focusout(function(){  
          if($(this).val()!=''){
            calc_paid_fee();      
            }
          else{
            $(this).val(0);
            calc_paid_fee();
          }    
        });

        $("#paid_ins_fee_val").focusout(function(){   
          if($(this).val()!=''){
            calc_paid_fee();      
            }
          else{
            $(this).val(0); 
            calc_paid_fee();            
          } 
          
        });

        $("#paid_agency_fee_val").focusout(function(){   
          if($(this).val()!=''){
            calc_paid_fee();      
            }
          else{
            $(this).val(0); 
            calc_paid_fee();            
          }          
        });


     
        $('.loan-opt').css("display","none");
        if($('#get_loan').is(":checked")) {
            $('.loan-opt').css("display","block");
        }
        $('#get_loan').on('click',function(){
            if($(this).is(":checked")) {
                $('.loan-opt').css("display","block");
            } else {
                 $('.loan-opt').css("display","none");
            }
        });
        $('#pay_mode').change(function(){
            var optVal = $(this).val();
            if(optVal == 2)
                $('.cheque-info').css("display","block");
            else
                $('.cheque-info').css("display","none");
            
        });
        if($('#pay_mode').val() == 2) {
            $('.cheque-info').css("display","block");
        }
        
        //$()
        
        
       // var step = 4;
       // var num  = 2;
        
        //num  += $('#mywizard').wizard('selectedItem');
        //alert(num.step);
        //$('#mywizard').wizard({selectedItem: num});
 				//$('#mywizard').wizard('selectedItem', {step: step=1});
        //var name = value;
        //$('#mywizard').wizard('selectByIndex', 'step3');
        //$('li [data-target=#step2]').trigger("click");
        //$('#mywizard').wizard('selectItem', { step: '4' });
        /* Save Contract form *
        function saveContract(cform) {
             if(!$("#frmContract").valid()) {
                   e.preventDefault();   
                } else {
                   var cform = $('#frmContract').serialize();
                   /* store Contract *
                   $.ajax({
                        type :'POST',
                        url  : baseUrl+'lead/ajax-call',
                        data : 'action=create_contract&'+cform,
                        success:function(response) {
                           if(response == 1) {
                             $('#mywizard').wizard('next');
                           } else {
                             e.preventDefault();  
                             $('#error-disp').html('Server problem.Try again')
                           }
                        }  
                   });
                }
          }
      }*/
        /*var wizard = $('#mywizard');
        /* Store contract for give lead *
        $('#save-contract').click(function() {
           var cform = $('#frmContract').serialize();
           if($("#frmContract").valid() === true && cform !='') {
                /* store Contract *
                   $.ajax({
                        type :'POST',
                        url  : baseUrl+'contract/ajax-call',
                        data : 'action=create_contract&'+cform,
                        success:function(response) {
                           if(response == 1) {
                             $('#mywizard').wizard('next');
                           } else {
                             $('#error-disp').html('Server problem.Try again')
                           }
                        }  
                   });
                //$('#mywizard').wizard('next');
            }   
        });*/
        /* Convert lead to application *
        $('#save-app').click(function(){
             var aform = $('#frmApplication').serialize();
              if($("#frmApplication").valid() === true && aform !='') {
                   $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'action=create_application&'+aform,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
               
                     }); 
                 }
        });
        /* get application approval date application *
        $('#save-approval').click(function(){
               var appform = $('#frmAppApproval').serialize();
               /* store application number *
               if( appform != '' && $("#frmAppApproval").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'action=update_approval_app&'+appform,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                }
        });
        
        /* Insurance Approval date *
        $('#save-insurance').click(function(){
               var inApp = $('#frmInsurance').serialize();
                   /* store insurance submission number *
               if( inApp != '' && $("#frmInsurance").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'action=update_insurance_date&'+inApp,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                }
        });
        /* Maid Arrival date *
        $('#save-mail-arrival').click(function(){
                 var adate = $('#frmMaidArrival').serialize();
                 /* store mail arrival number *
                 if( adate != '' && $("#frmMaidArrival").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'action=update_mail_arrival_date&'+adate,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                }
        });
        /* handover Arrival date *
        $('#save-handover').click(function(){
              var hdate = $('#frmHandOver').serialize();
              /* store handover date *
              if( hdate != '' && $("#frmHandOver").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'action=update_handover_date&'+hdate,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
              }
        });
        
        /* eissue date *
        $('#save-eissue').click(function(){
              var edate = $('#frmEIssue').serialize();
               /* store eissue date *
               if( edate != '' && $("#frmEIssue").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'action=update_eissue_date&'+edate,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                }
        });
        
        
         /* document return date *
        $('#save-doc-return').click(function(){
              var docdate = $('#frmdocreturn').serialize();
              /* store eissue date *
              if( docdate != '' && $("#frmdocreturn").valid() === true) {
                   $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'action=update_document_return&'+docdate,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
              }
        });
            /*if(!$("#frmContract").valid()) {
                   e.preventDefault();   
                } else {
                   var cform = $('#frmContract').serialize();
                   /* store Contract *
                   $.ajax({
                        type :'POST',
                        url  : baseUrl+'lead/ajax-call',
                        data : 'action=create_contract&'+cform,
                        success:function(response) {
                           if(response == 1) {
                             $('#mywizard').wizard('next');
                           } else {
                             e.preventDefault();  
                             $('#error-disp').html('Server problem.Try again')
                           }
                        }  
                   });
                }*/
          //}
            /*var status = saveContract(cform);
            console.log('ttt'+status);
            if(status === 'true') {
                  $('#mywizard').wizard('next');
            } else {
                  $('#error-disp').html('Error.Try again');
            }*/

     
        
     /*   wizard.on('change', function (e, data) {
            //console.log(data.step);
            if(data.step === 0 && data.direction ==='next') {
                if(!$("#frmContract").valid()) {
                   e.preventDefault();   
                } else {
                   var cform = $('#frmContract').serialize();
                   /* store Contract *
                   $.ajax({
                        type :'POST',
                        url  : baseUrl+'lead/ajax-call',
                        data : 'action=create_contract&'+cform,
                        success:function(response) {
                           if(response == 1) {
                             $('#mywizard').wizard('next');
                           } else {
                             e.preventDefault();  
                             $('#error-disp').html('Server problem.Try again')
                           }
                        }  
                   });
                }
            } else if(data.step === 0 && data.direction ==='next') {
                   var cform = $('#frmApplication').serialize();
                   /* store application number *
                   if( cform != '' && $("#frmApplication").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'lead/ajax-call',
                         data : 'action=create_application&'+cform,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              e.preventDefault();  
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                  } else {
                       e.preventDefault();   
                  }
            } else if(data.step === 0 && data.direction ==='next') {
                   var appform = $('#frmAppApproval').serialize();
                   /* store application number *
                   if( appform != '' && $("#frmAppApproval").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'lead/ajax-call',
                         data : 'action=update_approval_app&'+appform,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              e.preventDefault();  
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                  } else {
                       e.preventDefault();   
                  }
            } else if(data.step === 0 && data.direction ==='next') {
                   var inApp = $('#frmInsurance').serialize();
                   /* store insurance submission number *
                   if( inApp != '' && $("#frmInsurance").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'lead/ajax-call',
                         data : 'action=update_insurance_date&'+inApp,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              e.preventDefault();  
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                  } else {
                       e.preventDefault();   
                  }
            } else if(data.step === 0 && data.direction ==='next') {
                   var adate = $('#frmMaidArrival').serialize();
                   /* store mail arrival number *
                   if( adate != '' && $("#frmMaidArrival").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'lead/ajax-call',
                         data : 'action=update_mail_arrival_date&'+adate,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              e.preventDefault();  
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                  } else {
                       e.preventDefault();   
                  }
            } else if(data.step === 0 && data.direction ==='next') {
                   var hdate = $('#frmHandOver').serialize();
                   /* store handover date *
                   if( hdate != '' && $("#frmHandOver").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'lead/ajax-call',
                         data : 'action=update_handover_date&'+hdate,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              e.preventDefault();  
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                  } else {
                       e.preventDefault();   
                  }
            } else if(data.step === 0 && data.direction ==='next') {
                   var edate = $('#frmEIssue').serialize();
                   /* store eissue date *
                   if( edate != '' && $("#frmEIssue").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'lead/ajax-call',
                         data : 'action=update_eissue_date&'+edate,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              e.preventDefault();  
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                  } else {
                       e.preventDefault();   
                  }
            } else if(data.step === 0 && data.direction ==='next') {
                   var docdate = $('#frmdocreturn').serialize();
                   /* store eissue date *
                   if( docdate != '' && $("#frmdocreturn").valid() === true) {
                    $.ajax({
                         type :'POST',
                         url  : baseUrl+'lead/ajax-call',
                         data : 'action=update_document_return&'+docdate,
                         success:function(response) {
                            if(response == 1) {
                              $('#mywizard').wizard('next');
                            } else {
                              e.preventDefault();  
                              $('#error-disp').html('Server problem.Try again')
                            }
                         }  
                    });
                  } else {
                       e.preventDefault();   
                  }
            } 
        });*/
        /* wizard.on('finished', function () {
             window.location.href=baseUrl+'contractSuccess';
         });*/
        /*$('#mywizard .steps li').on('click',function(){
            var dataObj  = $(this).data('target');
            if(dataObj == "#step1") {
                var feeMode;
                var vhtml;

                $.ajax({
                    type : 'POST',
                    url  : baseUrl+'contract/ajax-call',
                    data : 'action=get_contract&check=1',
                    success:function(response) {
                        if(response != 0) {
                          var obj = $.parseJSON(response);
                          if(obj.fee_mode == 1) {
                          $('.cheque-info').css("display","none");
                            feeMode = 'Cash';
                          } else {
                            feeMode = 'Cheque';
                          }
                          $('#maidname').html('<label>'+obj.maid_name+'</label>');
                          $('#feetypes').html('<label>'+obj.fee_type+'</label>');
                          $('#paymode').html('<label>'+feeMode+'</label>');
                          $('#payamt').html('<label>'+obj.pay_amt+'</label>');
                          $('#chequeno').html('<label>'+obj.cheque_no+'</label>');
                          $('#payname').html('<label>'+obj.pay_name+'</label>');
                          $('#bankname').html('<label>'+obj.bank_name+'</label>');
                          $('#issuedate').html('<label>'+obj.issueDate+'</label>');
                          var contractId = obj.id;
                          var link = "'"+baseUrl+'edit-contract-process/'+dataObj.replace('#','')+'/'+contractId+"'";
                          vhtml = '';
                          vhtml += '<div class="row">';
                          vhtml += '<div class="col-sm-6 col-sm-offset-3">';
                          vhtml += '<div class="btn-toolbar">';
                          vhtml += '<button class="btn-primary btn" type="button" onclick="window.location.href='+link+'"><i class="icon-edit"></i>Edit</button>';
                          vhtml += '</div>';
                          vhtml += '</div>';
                          vhtml += '</div>';
                          $('#step1 .panel-footer').html(vhtml);
                        }
                    }
                });
            }
            else if(dataObj == "#step2" || dataObj == "#step3" || dataObj == "#step4" || dataObj == "#step5" || dataObj == "#step6" || dataObj == "#step7" || dataObj == "#step8") {
                var vhtml;
                /*var link = "'"+baseUrl+'edit-contract-process/'+dataObj.replace('#','')+'/'+contractId+"'";
                vhtml = '';
                vhtml += '<div class="row">';
                vhtml += '<div class="col-sm-6 col-sm-offset-3">';
                vhtml += '<div class="btn-toolbar">';
                vhtml += '<button class="btn-primary btn" type="button" onclick="window.location.href='+link+'"><i class="icon-edit"></i>Edit</button>';
                vhtml += '</div>';
                vhtml += '</div>';
                vhtml += '</div>';
                $.ajax({
                    type : 'POST',
                    url  : baseUrl+'contract/ajax-call',
                    data : 'action=get_lead_process&check=1',
                    success:function(response) {
                        if(response != 0) {
                          var obj = $.parseJSON(response);
                          var contractId = obj.fkContractId;
                          var link = "'"+baseUrl+'edit-contract-process/'+dataObj.replace('#','')+'/'+contractId+"'";
                          vhtml = '';
                          vhtml += '<div class="row">';
                          vhtml += '<div class="col-sm-6 col-sm-offset-3">';
                          vhtml += '<div class="btn-toolbar">';
                          vhtml += '<button class="btn-primary btn" type="button" onclick="window.location.href='+link+'"><i class="icon-edit"></i>Edit</button>';
                          vhtml += '</div>';
                          vhtml += '</div>';
                          vhtml += '</div>';
                          if(obj.application_no != null && obj.application_date != null && dataObj == "#step2") { 
                                $('#v_app_no').html('<label>'+obj.application_no+'</label>');
                                $('#v_aissue_date').html('<label>'+obj.application_date+'</label>');
                                $('#step2 .panel-footer').html(vhtml);
                          }
                          if(obj.application_approval_date != null && dataObj == "#step3") { 
                                $('#c_app_approval').html('<label>'+obj.application_approval_date+'</label>');
                                $('#step3 .panel-footer').html(vhtml);
                          }
                          if(obj.insurance_sub_date != null && obj.insurance_complete_date != null && dataObj == "#step4") { 
                                $('#v_ins_sub_date').html('<label>'+obj.insurance_sub_date+'</label>');
                                $('#v_ins_complete_date').html('<label>'+obj.insurance_complete_date+'</label>');
                                $('#step4 .panel-footer').html(vhtml);
                          }
                          if(obj.arrival_date != null && dataObj == "#step5") { 
                                $('#v_date_maid_arrival').html('<label>'+obj.arrival_date+'</label>');
                                $('#step5 .panel-footer').html(vhtml);
                          }
                          if(obj.handover_date != null && dataObj == "#step6") { 
                                $('#v_date_handover').html('<label>'+obj.handover_date+'</label>');
                                $('#step6 .panel-footer').html(vhtml);
                          }
                          if(obj.e_issue_date != null && dataObj == "#step7") { 
                                $('#v_eissue').html('<label>'+obj.e_issue_date+'</label>');
                                $('#step7 .panel-footer').html(vhtml);
                          }
                          if(obj.document_return != null && dataObj == "#step8") { 
                                $('#v_docreturn').html('<label>'+obj.document_return+'</label>');
                                $('#step8 .panel-footer').html(vhtml);
                          }
                      }
                   }
                });
            }
	


            //alert(dataObj);
        });
        var $wizard = $('#mywizard').wizard();
        var wizard = $wizard.data('wizard');
        $wizard.off('click', 'li.complete');
        $wizard.on('click', 'li', $.proxy(wizard.stepclicked, wizard));*/
    });
     
</script>
@stop
