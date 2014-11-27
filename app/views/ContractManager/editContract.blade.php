@extends('layouts.master')
<?php
$bal_amt = 0;
$branch     = Config::get('local.branchlist');
$resStatus  = Config::get('local.resultStatus'); 
$leadMode   = Config::get('local.leadMode');
$payMode    = Config::get('local.payMode');
$feeType    = Config::get('local.feeType');
$baseUrl    = Config::get('local.baseUrl');
$app_approve_status = Config::get('local.app_approve_status');
$customer  = Request::Segment(3);
$step_no   = Request::Segment(2);
$edit_mode = Request::Segment(4);
$totalAmt  = $overall_paid_amt =  '';
$payVendorAmt = 0;
if(!empty($rView)) {
  $contract_id = $rView->contract_id;
  $contract_no = $rView->contract_no;
  $ctab1 = $rView->contract_id !='' ? 'complete' : '';
  $ctab2 = $rView->app_id !='' ? 'complete' : '';
  $ctab3 = $rView->date_customer_sign !='' && $rView->app_status == 1 ? 'complete' : '';  
  $ctab4 = $rView->insurance_sub_date !='' ? 'complete' : '';
  $ctab5 = $rView->target_date != '' ? 'complete' : '';
  $ctab6 = $rView->handover_date != '' ? 'complete' : '';
  $ctab7 = $rView->e_issue_date != '' ? 'complete' : '';
  $ctab8 = $rView->doc_return_date != '' ? 'complete' : '';
  //echo '<pre>'; print_r($rView); echo '</pre>';
  if($rView->contract_id != '') {
      $cUrl1 =  URL::to('edit-contract/step1/'.$contract_id);
      $cUrl2 =  URL::to('edit-contract/step2/'.$contract_id); 
      $cUrl3 = $cUrl4 = $cUrl5 = $cUrl6 = $cUrl7 = $cUrl8 = 'javascript:';
      //$feeArray = explode(',',$rView->fee_type);
  } 
  if($rView->app_id  != '' && $rView->app_approval_date == ''  && $rView->app_status == 0 || $rView->app_status == 2) {
       $cUrl1 =  URL::to('edit-contract/step1/'.$contract_id);
       $cUrl2 =  URL::to('edit-contract/step2/'.$contract_id); 
       $cUrl3 =  URL::to('edit-contract/step3/'.$contract_id);
       $cUrl4 = $cUrl5 = $cUrl6 = $cUrl7 = $cUrl8 = 'javascript::';
  }
  if($rView->app_id  != '' && $rView->app_status == 1) {
       $cUrl1 =  URL::to('edit-contract/step1/'.$contract_id);
       $cUrl2 =  URL::to('edit-contract/step2/'.$contract_id); 
       $cUrl3 =  URL::to('edit-contract/step3/'.$contract_id);
       $cUrl4 =  URL::to('edit-contract/step4/'.$contract_id); 
       $cUrl5 =  URL::to('edit-contract/step5/'.$contract_id);
       $cUrl6 =  URL::to('edit-contract/step6/'.$contract_id); 
       $cUrl7 =  URL::to('edit-contract/step7/'.$contract_id);
       $cUrl8 =  URL::to('edit-contract/step8/'.$contract_id); 
  }
} else {
    // new contract no result status
    $ctab1= $ctab2 = $ctab3 = $ctab4 = $ctab5 = $ctab6 = $ctab7 = $ctab8 = '';
    $cUrl1 = $cUrl2 = $cUrl3 = $cUrl4 = $cUrl5 = $cUrl6 = $cUrl7 = $cUrl8 = 'javascript:';
}
$collected_fee = '';
?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Edit Contract Process</span>
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
                        <li class='active'>Edit Contract Process</li>
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
                    <div class='box'>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right">
                                    @if($rView->contract_cases == 1 && !empty($invoice_list))
                                    <a class="btn btn-danger btn-xs has-tooltip" href="javascript:void(0)" data-original-title="Full Termination" data-placement="top" onclick="return terminate('{{ $contract_id }}',2,{{ $invoice_list->status }},{{ $receipt_status }});">Full Termination</a>
                                    <a class="btn btn-success btn-xs has-tooltip" href="javascript:void(0)" data-original-title="Partial Termination" data-placement="top" onclick="return terminate('{{ $contract_id }}',3,{{ $invoice_list->status }},{{ $receipt_status }});">Partial Termination</a>
                                        @if($recontract_status == 0)
                                          <a class="btn btn-inverse btn-xs has-tooltip" href="javascript:void(0)" data-original-title="Replacement" data-placement="top" onclick="return terminate('{{ $contract_id }}',4,{{ $invoice_list->status }},{{ $receipt_status }});">Replacement</a>
                                        @endif
                                    @endif    
                                    <a class="btn btn-warning btn-xs has-tooltip" href="{{ URL::to('contract-list') }}" data-original-title="Back" data-placement="top">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                                    <div class='col-sm-12'>
                                      <div class='box'>
                                        <div class='box-content box-padding'>
                                          <div class='fuelux'>
                                           <div class='wizard' id="mywizard" >
                                              <ul class='steps'>
                                                        <li class='active {{ $ctab1  }}' data-target='#step1' id="t1">
                                                            <a href="{{ $cUrl1 }}"><span class='step'>Contract</span></a>
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
                                               <div class='step-pane active' id='step1'>
                                                   <div class='box-header blue-background'>
                                                          <div class='title'>Contract</div>
                                                   </div>
                                                   <div class="box-content"> 
                                                       <?php if(empty($rView->contract_id) || $edit_mode == "edit") {  ?>
                                                                          <?php 
                                                                            $disabled = '';
                                                                            if(isset($invoice_list) && $invoice_list->status!=3) {
                                                                              $disabled = 'disabled';
                                                                            } 
                                                                          ?>
                                                        <?php //$lastInvoiceInfo = end($invoice_list);
                                                        //echo '<pre>'; print_r($lastInvoiceInfo); echo '</pre>';?>
                                                       <form class="form form-horizontal validate-form" name="frmContract" id="frmContract" action="{{ URL::to('edit-contract-process/'.$step_no) }}" method="post">
                                                          <div class="form-group">
                                                               <label class='control-label col-sm-3' for='cus_name'>Customer Name</label>
                                                                <div class='controls col-sm-6  input-group'>
                                                                     <input class='form-control' id='cus_name' name='cus_name' {{ $disabled }} data-rule-required="true"  placeholder='Customer Name' type='text' value="{{ $rView->customer_name }}" /> 
                                                                </div>
                                                                <div class='col-sm-9 pull-right'> 
                                                                     <span class="help-block has-error" for="cus_name"></span>
                                                                </div>
                                                          </div>
                                                          <div class="form-group">
                                                               <label class='control-label col-sm-3' for='address'>Customer Address</label>
                                                                <div class='controls col-sm-6  input-group'>
                                                                    <textarea class='form-control' id='cus_addr' name='cus_addr' {{ $disabled }} data-rule-required="true"  placeholder='Customer Address'>{{ $rView->address }}</textarea>
                                                                </div>
                                                                <div class='col-sm-9 pull-right'> 
                                                                     <span class="help-block has-error" for="cus_addr"></span>
                                                                </div>
                                                          </div>
                                                          <div class="form-group">
                                                               <label class='control-label col-sm-3' for='cus_nric'>Customer Nric No</label>
                                                                <div class='controls col-sm-6  input-group'>
                                                                     <input class='form-control' id='cus_nric' name='cus_nric' {{ $disabled }} data-rule-required="true"  placeholder='Customer Nric No' type='text' value="{{ $rView->nric_no }}" /> 
                                                                </div>
                                                                <div class='col-sm-9 pull-right'> 
                                                                     <span class="help-block has-error" for="cus_nric"></span>
                                                                </div>
                                                          </div>
                                                           <div class='form-group'>
                                                              <label class='control-label col-sm-3' for='validation_name'>Maid Name</label>
                                                              <div class='controls col-sm-6' id="maidname">
                                                                  <input type="hidden" name="ter_maid" id="ter_maid" value="0" />
                                                                  <input class='form-control' id='maid_receivable' name='maid_receivable'  type='hidden' value='0.00' /> 
                                                                  <input type="hidden" name="contract_id" id="contract_id" value="{{ $contract_id }} " />
                                                                  <input type="hidden" name="customerId" id="customerId" value="{{ $customerId }}" />
                                                                  <input type="hidden" name="invoice_id" id="invoice_id"  value="{{ !empty($invoice_list) ? $invoice_list->invoice_id : ''}}" />
                                                                  <select class='select2 form-control' name="bio_id" id="bio_id" {{ $disabled }}>
                                                                       <option value=''></option>
                                                                       @if(!empty($maid))
                                                                         @foreach($maid as $maidList)
                                                                         <option value='{{ $maidList->id }}' {{ $maidList->id == $rView->fkBioId ? 'selected' : '' }}>{{{ $maidList->maid_name  }}}</option>
                                                                         @endforeach
                                                                       @endif
                                                                      </select>
                                                              </div>
                                                          </div>
                                                             <div class="form-group">
                                                               <label class='control-label col-sm-3' for='from_date'>Contract Schedule From Date</label>
                                                                <div class='controls col-sm-6 input-group' id="issuedate">
                                                                     <input class='form-control' id='cs_from_date' name='cs_from_date' {{ $disabled }}  data-rule-required="true" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value='{{ $rView->contract_from != '' && $rView->contract_from != 0 ? date('d-m-Y',strtotime($rView->contract_from)) : '' }}' /> 
                                                                     <span class="input-group-addon">
                                                                      <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                     </span>
                                                                </div>
                                                                <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="from_date"></span>
                                                                </div>
                                                           </div>
                                                           <div class='form-group'>
                                                               <label class='control-label col-sm-3' for='contract_terms'>Contract terms(in months)</label>
                                                               <div class='controls col-sm-6'>
                                                                         <select name='contract_terms' id='contract_terms'  {{ $disabled }} class='form-control contract-terms'>
                                                                          <?php for($i = 2; $i <= 60; $i++) { ?>
                                                                          <option value='<?php echo $i; ?>' <?php  if($rView->contract_terms === $i) { echo 'selected="selected"'; } ?>><?php echo $i; ?> months</option>
                                                                          <?php } ?>
                                                                         </select>
                                                               </div>
                                                           </div> 
                     
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='to_date'>Contract Schedule To Date</label>
                                                                <div class='controls col-sm-6 input-group' id="issuedate">
                                                                     <input class='form-control datepicker' id='cs_to_date'  {{ $disabled }} name='cs_to_date'  data-rule-required="true" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value='{{ $rView->contract_to != '' && $rView->contract_to != 0 ? date('d-m-Y',strtotime($rView->contract_to)) : '' }}' /> 
                                                                     <span class="input-group-addon">
                                                                      <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                     </span>
                                                                </div>
                                                               <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="cs_to_date"></span>
                                                               </div>
                                                           </div>
                                                           <div class='form-group'>
                                                               <label class='control-label col-sm-3' for='branch_list'>Fee Types</label>
                                                               <div class='controls col-sm-6' id="feetypes">
                                                                      <table class="table table-striped table-hover table-bordered">
                                                                        <thead>
                                                                          <tr>                                                                        
                                                                            <th>Description</th>
                                                                            <th>Amount</th>
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                          @if(!empty($field_list))
                                                                           <?php $total_placement = 0; $total_val =   $overAmt = 0; 
                                                                                 $placeFee = array_key_exists(22,$fee_info) ? $fee_info[22]['amount'] : '0.00';
                                                                                 $payable  = array_key_exists(8,$fee_info) ? $fee_info[8]['amount'] : '0.00';
                                                                                 if($payable == 0){
                                                                                  $payable  = array_key_exists(96,$fee_info) ? $fee_info[96]['amount'] : '0.00';
                                                                                 }
                                                                                 $total_placement = $placeFee + $payable;
                                                                           ?>
                                                                            @foreach($field_list as $key => $list)
                                                                            <?php 
                                                                                  $total_val += array_key_exists($key ,$fee_info) ? $fee_info[$key ]['amount'] : '0.00';
                                                                                  //$total_val 
                                                                                  ?>
                                                                              <tr>                                                                       
                                                                              <td>{{ $list }}</td>
                                                                              <td>
                                                                               
                                                                               @if($key == 22)
                                                                               <div class="col-sm-12">
                                                                                   <input class='form-control text-right' {{ $disabled }} id='{{ $feel_label[$key] }}' name='{{ $feel_label[$key] }}'  onchange="return numberWithOutCommasInputField(this.value,this.id);" value="{{ number_format($total_placement,2,'.','') }}" data-rule-required="true" placeholder=''  type='text' />
                                                                                  <!-- <input class='form-control text-right' id='placement_fee_val' name='placement_fee_val'  value='{{ array_key_exists($key,$fee_info) ? $fee_info[$key]['amount'] : '0.00'}}' data-rule-required="true" placeholder='' type='hidden' />
                                                                                  <input class='form-control text-right' id='payable_vendor' name='payable_vendor'  value='{{ array_key_exists(8,$fee_info) ? $fee_info[8]['amount'] : '0.00'}}' data-rule-required="true" placeholder='' type='hidden' /> -->
                                                                               </div>
                                                                                @else
                                                                                <div class="col-sm-12">
                                                                                  <input class='form-control text-right' {{ $disabled }} id='{{ $feel_label[$key] }}' name='{{ $feel_label[$key] }}' onchange="return numberWithOutCommasInputField(this.value,this.id);"  value="{{ array_key_exists($key,$fee_info) ? $fee_info[$key]['amount'] : '0.00' }}" data-rule-required="true" placeholder='' type='text' />
                                                                                </div>
                                                                                @endif
                                                                            </td>
                                                                            <!-- if($key == 22)
                                                                            <td>     
                                                                                <a href="#add_placement_fee" data-toggle="modal" class="btn btn-primary" {{ $disabled }}>Add / Edit</a>
                                                                           </td> 
                                                                           else
                                                                           <td></td>
                                                                           endif -->
                                                                          </tr>
                                                                            @endforeach
                                                                          @endif
                                                                          <tr>
                                                                            <?php  $overAmt = $payable + $total_val; ?>
                                                                            <td>Total</td>
                                                                            <td>
                                                                              <div class="col-sm-12">
                                                                                <input class='form-control text-right' {{ $disabled }} id='target_fee' name='target_fee' pay-amount="true"   value="{{ number_format($overAmt ,2,'.','') }}" data-rule-required="true" placeholder='' type='text' readonly />
                                                                              </div>
                                                                            </td>
                                                                          </tr>                                                                      
                                                                        </tbody>
                                                                      </table>
                                                               </div>
                                                           </div>
                                                           <!-- if($invoice_list->status != 1)  -->
                                                           <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                      <?php 
                                                                            if(!Request::has('e')) {
                                                                          ?>
                                                                             <a class="btn-primary btn" id="edit-contract" href="{{ URL::to('edit-contracts/step1/status/'.$invoice_list->invoice_id.'/'.$contract_id) }}?e=1">Edit</a1>
                                                                           <?php 
                                                                            } else {
                                                                           ?>
                                                                            <button class="btn-primary btn" type="submit">Submit</button>
                                                                          <?php
                                                                            }
                                                                          ?>
                                                                        <!-- <button class="btn-primary btn" type="submit" id="save-contract">Save &amp; Submit</button> -->
                                                                        <a class="btn-default btn resetbtn" href="{{ URL::to('edit-contract/step1/'.$contract_id.'/edit') }}">Reset</a>
                                                                      
                                                                
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                           </div> 
                                                           <!-- endif -->
                                                       </form>
                                                       <!-- <div class='modal fade' id='add_placement_fee' tabindex='-1'>
                                                                            <div class='modal-dialog'>
                                                                                <div class='modal-content'>
                                                                                  <div class='modal-header'>
                                                                                    <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                                                                    <h4 class='modal-title' id='myModalLabel'>Add Placement Feet</h4>
                                                                                   </div>
                                                                                  <form class="form validate-form" style="margin-bottom: 0;" method="post" action="" accept-charset="UTF-8">
                                                                                    <div class='modal-body'>
                                                                                       <div class="form-group">
                                                                                            <label for='island_fee'>Island's Fee</label>
                                                                                                 <input class='form-control' id='island_fee' name='island_fee'  data-rule-required="true" data-rule-minlength="2" placeholder='Island Fee' type='text' onchange="return numberWithOutCommasInputField(this.value,this.id);" value='{{ $placeFee }}'/> 
                                                                                       </div>  
                                                                                       <div class="form-group">
                                                                                            <label for='vendor_payable'>Payable to Vendor</label>
                                                                                                 <input class='form-control' id='vendor_payable' name='vendor_payable'  data-rule-required="true" data-rule-minlength="2" placeholder='Vendor payable' type='text' onchange="return numberWithOutCommasInputField(this.value,this.id);" value='{{ $payable }}' /> 
                                                                                       </div>
                                                                                   </div>
                                                                                   <div class='modal-footer'>
                                                                                      <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                      <input class='btn btn-primary' data-dismiss='modal' type='buttom' id='pay_fee_post' value='{{ 'Add Placement Fee' }}'/>
                                                                                   </div>
                                                                                  </form>
                                                                                </div>
                                                                              </div>
                                                            </div>--><!-- pay balance modal-->  
                                                       <?php } else { ?> 
                                                       <form class="form form-horizontal validate-form">
                                                        <div class="form-group">
                                                               <label class='control-label col-sm-3' for='customer_name'>Customer Name</label>
                                                                <div class='controls col-sm-6' id="cus_name">
                                                                     <label  class="control-label">{{ $rView->customer_name != '' ? ucwords($rView->customer_name) : '-' }}</label>
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                               <label class='control-label col-sm-3' for='nric_no'>Customer Nric Number</label>
                                                                <div class='controls col-sm-6' id="nric_no">
                                                                     <label  class="control-label">{{ $rView->nric_no != '' ? $rView->nric_no : '-' }}</label>
                                                                </div>
                                                        </div>
                                                        <div class='form-group'>
                                                              <label class='control-label col-sm-3' for='validation_name'>Maid Name</label>
                                                              <div class='controls col-sm-6' id="maidname">
                                                                  <label  class="control-label">{{ ucwords($rView->maid_name)  }}</label>
                                                              </div>
                                                          </div>
                                                          <div class='form-group'>
                                                               <label class='control-label col-sm-3' for='branch_list'>Collected Fee</label>
                                                               <div class='controls col-sm-6' id="feetypes">
                                                                   <?php 
                                                                   $feeCollectList = ''; 
                                                                   if($fee_info) {
                                                                    
                                                                    foreach($fee_info as $key => $val) {
                                                                        if($key != 8){
                                                                           $feeCollectList .= $fee_info[$key]['level4_name'].',';
                                                                        }
                                                                    }
                                                                   }
                                                                   ?>
                                                                   <label  class="control-label">{{ trim($feeCollectList,',') }}</label>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='from_date'>Contract Schedule From Date</label>
                                                                <div class='controls col-sm-6' id="issuedate">
                                                                     <label  class="control-label">{{ $rView->contract_from != '' && $rView->contract_from != 0 ? date('d-m-Y',strtotime($rView->contract_from)) : '' }}</label>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='to_date'>Contract Schedule To Date</label>
                                                                <div class='controls col-sm-6' id="issuedate">
                                                                     <label  class="control-label">{{ $rView->contract_to != '' && $rView->contract_to != 0 ? date('d-m-Y',strtotime($rView->contract_to)) : '' }}</label>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='to_date'>Contract Terms</label>
                                                                <div class='controls col-sm-6' id="issuedate">
                                                                     <label  class="control-label">{{ $rView->contract_terms.'&nbsp;months' }}</label>
                                                                </div>
                                                           </div>
                                                           <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                          <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$customer.'/edit') }}'>View</a>
                                                                          @if(!empty($invoice_list))
                                                                             <a href="{{ URL::to('account/invoice/print/'.$invoice_list->invoice_id)}}" class="btn btn-primary ">Print Invoice</a>
                                                                             <a href="{{ URL::to('contract/pay-salary-schedule/'.$contract_id) }}" class="btn btn-success ">Maid Payment Schedule</a>
                                                                             <a href="{{ URL::to('contract/generate-forms/'.$contract_id) }}" class="btn btn-success ">Generate Forms</a>
                                                                          @endif
                                                                          <!-- <a href="#loan-modal" data-toggle="modal" class="btn btn-primary ">Opt Loan</a> -->
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                           </div>  
                                                       </form>
                                                        @if(!empty($invoice_list))
                                                       <div class="row">
                                                            <div class="col-lg-12">
                                                                <h3>Invoice Collection</h3>
                                                                @if(!empty($fee_list))
                                                                 <?php $bal_amt =  $total_amt  = 0; ?>
                                                                 @foreach($fee_list as $key => $li)
                                                                    <?php $total_amt += $li->amount; ?>
                                                                 @endforeach
                                                                <?php  $paid_amt = $invoice_list->receipt_amt!= '' ? number_format($invoice_list->receipt_amt,2,'.','') : '0.00';
                                                                 $bal_amt = $total_amt - $paid_amt;
                                                                 if(!empty($receivable_customer) && $rView->contract_cases != 1){
                                                                            $dbal =  number_format($bal_amt,2,'.','');
                                                                            $bal_amt  = (double)$dbal - (double)$receivable_customer->credit;
                                                                 }?>
                                                                @endif
                                                                @if($bal_amt != 0)
                                                                <div class="pull-left" style="margin-bottom:10px;"><a href="#payment_balance" data-toggle="modal" data-balamt="{{ $bal_amt }}" class="btn btn-primary  btn-xs">Add Receipt</a></div>
                                                                @endif
                                                                <table width="100%" border="1">
                                                                   <tr>
                                                                        <th width="20%" style="text-align:center;">Invoice No</th>
                                                                        <th width="20%" style="text-align:center;">Invoice Date</th>
                                                                        <th width="35%" style="text-align:left;">Customer Name</th>
                                                                        <th width="10%" style="text-align:center;">Status</th>
                                                                   </tr>
                                                                   <tr>
                                                                        <td style="text-align:center;">{{ $invoice_list->invoice_no }}</td>
                                                                        <td width="10%" style="text-align:center;">{{ date('d-m-Y',strtotime($invoice_list->invoice_date)) }}</td>
                                                                        <td>{{ ucwords($invoice_list->customer_name) }}</td>
                                                                        <td> @if($invoice_list->status == 1) {{ 'Approved' }} @elseif($invoice_list->status == 2) {{ 'For Approval' }} @elseif($invoice_list->status == 3) {{ 'Save Draft' }} @endif</td>
                                                                   </tr>
                                                                   @if(!empty($fee_list))
                                                                   <?php $total_amt = 0; $bal_amt = 0; $placeTotal = 0;?>
                                                                   <tr>
                                                                       <table width="100%" border="1">
                                                                        <tr>
                                                                            <th width="2%" style="text-align:center;">Sno</th>
                                                                            <th width="54%">Description</th>
                                                                            <th width="10%" style="text-align:right;">Amount</th>
                                                                        </tr>
                                                                        @foreach($fee_list as $key => $li)
                                                                        <tr>
                                                                             @if($li->l4_id == 22 || $li->l4_id == 8 || $li->l4_id == 96)
                                                                                <?php $placeTotal = (double)$placeTotal + (double)$li->amount; ?>
                                                                             @else
                                                                                <td style="text-align:center;">{{ ++$key }}</td>
                                                                                <td>{{ $li->level4_name }}</td>
                                                                                <td align="right">{{ number_format($li->amount,2) }}</td>
                                                                                
                                                                             @endif
                                                                        </tr>
                                                                        <?php $total_amt += $li->amount;?>
                                                                        @endforeach
                                                                        @if($placeTotal != 0)
                                                                            <td style="text-align:center;">{{ ++$key }}</td>
                                                                            <td>{{ 'Placement Fees' }}</td>   
                                                                            <td align="right">{{ number_format($placeTotal,2) }}</td>
                                                                        @endif
                                                                        <?php 
                                                                        $paid_amt = $invoice_list->receipt_amt!= '' ? number_format($invoice_list->receipt_amt,2,'.','') : '0.00';
                                                                        $bal_amt = $total_amt - $paid_amt; 
                                                                        if(!empty($receivable_customer) && $rView->contract_cases != 1){
                                                                            $dbal =  number_format($bal_amt,2,'.','');
                                                                            $bal_amt  = (double)$dbal - (double)$receivable_customer->credit;
                                                                            $paid_amt = $paid_amt  + $receivable_customer->credit;
                                                                        }
                                                                        ?>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td align="right"><strong>Total Amount</strong></td>
                                                                            <td align="right">{{  $total_amt != '' ? number_format($total_amt,2) : '0.00'  }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td align="right"><strong>Amount Paid</strong></td>
                                                                            <td align="right">{{  number_format($paid_amt,2)  }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td align="right"><strong>Amount Balance</strong></td>
                                                                            <td align="right">{{  number_format($bal_amt,2) }}</td>
                                                                        </tr>
                                                                       </table>
                                                                       </td>
                                                                   </tr>
                                                                   @endif 
                                                                </table>
                                                            </div>
                                                       </div>
                                                       @endif
                                                       @if($step_no == 'step1' && !empty($invoice_list))
                                                      <!-- <div class='modal fade' id='payment_balance' tabindex='-1'>
                                                                            <div class='modal-dialog'>
                                                                                <div class='modal-content'>
                                                                                  <div class='modal-header'>
                                                                                    <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                                                                    <h4 class='modal-title' id='myModalLabel'>Contract Balance Payment</h4>
                                                                                   </div>
                                                                                  <form class="form validate-form" style="margin-bottom: 0;" method="post" action="{{ URL::to('contract/balance-payment') }}" accept-charset="UTF-8">
                                                                                    <input name="contractId" name="contractId" type="hidden" value="{{ isset($contract_id) ? $contract_id  : '' }}"/>                                                                                    
                                                                                    <input id="hinvoice_no" name="hinvoice_no" type="hidden" value="{{ $invoice_list->invoice_id }}"/>
                                                                                    <input id="hcustomer_id" name="hcustomer" type="hidden" value="{{ $invoice_list->customer_id }}"/>
                                                                                    <div class='modal-body'>
                                                                                       <div class="form-group">
                                                                                            <label for='target_fee'>Total Amount</label>
                                                                                            <input class='form-control' id='target_fee' name='target_fee'  data-rule-required="true" placeholder='Target fee' type='text' value="{{ number_format($total_amt,2,'.','') }}" readonly="readonly"/> 
                                                                                       </div> 
                                                                                        <div class="form-group">
                                                                                            <label for='paid_amt'>Paid Amount</label>
                                                                                            <input class='form-control' id='paid_amt' name='paid_mat'  data-rule-required="true" placeholder="Amount Paid" type='text' value="{{ number_format($paid_amt,2) }}" readonly="readonly"/> 
                                                                                       </div> 
                                                                                       <div class="form-group">
                                                                                            <label for='bal_amt'>Balance Amount</label>
                                                                                            <input class='form-control' id='bal_amt' name='bal_amt'  data-rule-required="true" placeholder="Amount Balane" type='text' value="{{ number_format($bal_amt,2,'.','') }}" readonly="readonly"/> 
                                                                                       </div>
                                                                                       <div class="form-group">
                                                                                            <label>Amount</label>
                                                                                            <input class="form-control rec_mat" id="epay_amt" name="epay_amt"  pay-amount="true" pay-check="true" data-rule-required="true" placeholder="Amount" type="text" value="" /> 
                                                                                            <label class="error" for="epay_amt"></label>
                                                                                       </div> 
                                                                                        <div class="form-group">
                                                                                            <label>Cash / Bank Account</label>
                                                                                               <select class='form-control select2 rec_mat' id='epayment_account' name='epayment_account'>
                                                                                                  @if(!empty($payment_coa))
                                                                                                   @foreach($payment_coa as $key => $list)
                                                                                                   <option value="{{{ $list->id }}}">{{{ $list->level4_name }}}</option>
                                                                                                   @endforeach
                                                                                                  @endif
                                                                                               </select>
                                                                                       </div> 
                                                                                       <div class="form-group">
                                                                                            <label for='cheque_no'>Cheque No</label>
                                                                                                 <input class='form-control rec_mat' id='echeque_no' name='echeque_no'  data-rule-required="true" data-rule-minlength="2" placeholder='Cheque / Reference No' type='text' /> 
                                                                                        </div>  
                                                                                       <div class="form-group">
                                                                                            <label for='Remarks'>Description / Remarks</label>
                                                                                                <textarea class='form-control rec_mat' id='eremarks' name='eremarks' data-rule-required="true" data-rule-minlength="2" placeholder='Description / Remarks'></textarea> 
                                                                                        </div>
                                                                                   </div>
                                                                                   <div class='modal-footer'>
                                                                                      <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                      <button class='btn btn-primary' type='submit'>Pay Fee</button>
                                                                                   </div>
                                                                                  </form>
                                                                                </div>
                                                                              </div>
                                                            </div><!-- pay balance modal-->  
                                                            @endif
                                                                   <div class='modal fade' id='loan-modal' tabindex='-1'>
                                                                       <?php 
                                                                                $loan_amt = 0.00;
                                                                                if(!empty($fee_info)) {
                                                                                    $placeFee = array_key_exists(22,$fee_info) ? $fee_info[22]['amount'] : '0.00';
                                                                                    $payable  = array_key_exists(8,$fee_info) ? $fee_info[8]['amount'] : '0.00';
                                                                                    $loan_amt = $placeFee + $payable; 
                                                                                }?>
                                                                            <div class='modal-dialog'>
                                                                                <div class='modal-content'>
                                                                                  <div class='modal-header'>
                                                                                    <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                                                                    <h4 class='modal-title' id='myModalLabel'>Opt for Loan</h4>
                                                                                  </div>
                                                                                  <form class="form validate-form" style="margin-bottom: 0;" method="post" action="{{ URL::to('contract/opt-loan') }}" accept-charset="UTF-8">
                                                                                    <input name="contractId" name="contractId" type="hidden" value="{{ $rView->contract_id }}"/>                                                                                    
                                                                                    <div class='modal-body'>
                                                                                         <div class="form-group">
                                                                                           
                                                                                           <label class='control-label ' for='issue_date'>Issue Date</label>
                                                                                           <div class="controls   input-group">
                                                                                                 <input class='form-control datepicker' id='issue_date' name='issue_date'  data-rule-required="true" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' /> 
                                                                                                 <span class="input-group-addon">
                                                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                                                 </span>
                                                                                           </div>
                                                                                           <div class=' pull-right'>
                                                                                                 <span class='help-block has-error' for='issue_date'></span>
                                                                                                 </div>
                                                                                       </div> 
                                                                                        <div class='form-group loan-opt'>
                                                                                             <label class='control-label ' for='loan_amount'>Loan Amount</label>
                                                                                             <div class='controls  loan-opt'>
                                                                                                 <input class='form-control' id='loan_amt' name='loan_amt' readonly="readonly" data-rule-required='true' data-rule-minlength='2' placeholder='Loan Amount' type='text' value="{{  $loan_amt != '' ? number_format($loan_amt,2,'.','') : '0.00'  }}"/>
                                                                                             </div>
                                                                                       </div>
                                                                                       <div class='form-group loan-opt'>
                                                                                         <label class='control-label ' for='loan_amount'>Repayment Date</label>
                                                                                             <div class='controls   input-group'>
                                                                                                 <input class='form-control datepicker' id='repay_date' name='repay_date'  data-rule-required='true' data-rule-minlength='2' data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' />
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
                                                         </div>
                                                       <?php } ?>
                                                   </div>
                                              </div>
                                              <div class='step-pane' id='step2'>
                                                <div class='box-header blue-background'>
                                                    <div class='title'>Application</div>
                                                </div>
                                                <div class='box-content'>
                                                    <?php if(empty($rView->app_id) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('edit-contract-process/'.$step_no) }}" name="frmApplication" id="frmApplication" method="post">
                                                        <div class="form-group">
                                                            <label class='control-label col-sm-3' for='app_no'>Contract no</label>
                                                            <div class='controls col-sm-6'>
                                                                <label class='control-label'>{{ isset($contract_no) ? $contract_no : '' }}</label>
                                                                <input type="hidden" name="contract_id" id="contract_id" value="{{ isset($contract_id) ? $contract_id : '' }}" />
                                                                <input type="hidden" name="prev_app_status" id="prev_app_status" value="{{ !empty($rView) ? $rView->app_status : '' }}" />
                                                                <input type="hidden" name="prev_app_no" id="prev_app_no" value="{{ !empty($rView) ? $rView->app_no : '' }}" />
                                                                <input type="hidden" name="prev_date_customer_sign" id="prev_date_customer_sign" value="{{ !empty($rView) ? $rView->date_customer_sign : '' }}" />
                                                            </div>
                                                       </div>
                                                    <!-- <div class="form-group">
                                                            <label class='control-label col-sm-3' for='app_no'>Application no</label>
                                                            <div class='controls col-sm-6' id="v_app_no">
                                                                 <input class='form-control' id='app_no' name='app_no'  data-rule-required="true" data-rule-minlength="2" placeholder='Application number' type='text' value="{{ $rView->app_no }}"/> 
                                                            </div>
                                                       </div>-->
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='issue_date'>Application Date</label>
                                                            <div class='controls col-sm-6  input-group' id="v_aissue_date">
                                                                 <input class='form-control datepicker' id='issue_date' name='issue_date'  data-rule-required="true" data-rule-minlength="2" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value="{{ $rView->date_customer_sign != '' && $rView->date_customer_sign != 0 ? date('d-m-Y',strtotime($rView->date_customer_sign)) : '' }}" /> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error" for="issue_dat"></span>
                                                            </div>
                                                       </div>
                                                      <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                    <button class="btn-primary btn" type="submit" id="save-app">Save &amp; Submit</button>
                                                                    <!-- <button class="btn-default btn resetbtn" type="button">Reset</button> -->
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
                                                                        <th width="20%" style="text-align: center;">Work Permit Number</th>
                                                                        <th width="20%" style="text-align: center;">Application Date</th>
                                                                        <!-- <th>Action</th> -->
                                                                    </tr> 
                                                                    @foreach($app_list as $key => $val)                                                       
                                                                    <tr>
                                                                        <td width="" align="center">{{ $key + 1 }}</td>
                                                                        <td width="" align="center">{{ $val->app_no }}</td>
                                                                        <td width="" align="center">{{ $val->date_customer_sign != '' && $val->date_customer_sign != 0 ? date('d-m-Y',strtotime($val->date_customer_sign)) : '' }}</td>
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
                                                     <!--<div class="form-group">
                                                            <label class='control-label col-sm-3' for='app_no'>Application no</label>
                                                            <div class='controls col-sm-6' id="v_app_no">
                                                                <label class='control-label'>{{ $rView->app_no }}</label>
                                                            </div>
                                                       </div>-->
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='issue_date'>Application Date</label>
                                                            <div class='controls col-sm-6' id="v_aissue_date">
                                                                 <label class='control-label'>{{ $rView->date_customer_sign != '' && $rView->date_customer_sign != 0 ? date('d-m-Y',strtotime($rView->date_customer_sign)) : '-' }}</label>
                                                            </div>
                                                       </div>
                                                      <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                      <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$customer.'/edit') }}'>Update</a>
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
                                                                        <th width="20%" style="text-align: center;">Work Permit Number</th>
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
                                                    <?php if(empty($rView->app_approval_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('edit-contract-process/'.$step_no) }}" name="frmAppApproval" id="frmAppApproval" method="post">
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='app_approval'>Application Status</label>
                                                           <input type="hidden" name="contract_id" id="contract_id" value="{{ isset($contract_id) ? $contract_id : '' }}" />
                                                           <input type="hidden" name="app_no" id="app_no" value="{{ $rView->app_no }}" />
                                                           <input type="hidden" name="date_customer_sign" id="date_customer_sign" value="{{ $rView->date_customer_sign }}" />
                                                           <input type="hidden" name="prev_app_status" id="prev_app_status" value="{{ !empty($rView) ? $rView->app_status : '' }}" />
                                                           <input type="hidden" name="prev_app_no" id="prev_app_no" value="{{ !empty($rView) ? $rView->app_no : '' }}" />
                                                           <input type="hidden" name="prev_date_customer_sign" id="prev_date_customer_sign" value="{{ !empty($rView) ? $rView->date_customer_sign : '' }}" />
                                                           <input type="hidden" name="prev_eissue_date" id="prev_eissue_date" value="{{ $rView->e_issue_date }}" />
                                                         
                                                                
                                                           <?php if(empty($rView->app_approval_date)&&(Session::get('app_count')==0)){
                                                            ?>
                                                            <div class='controls col-sm-6' id="c_app_approval">
                                                                   <select class='form-control' id='app_status' name='app_status'>
                                                                        <option>Select application status</option>
                                                                       @foreach($app_approve_status as $key => $list)
                                                                        @if($key != 3)
                                                                       <option value="{{ $key }}" {{ $rView->app_status == $key ? 'selected' : '' }}>{{{ $list }}}</option>
                                                                       @endif
                                                                       @endforeach
                                                                   </select>
                                                            </div>
                                                            <?php } 
                                                            else { ?>
                                                            <div class='controls col-sm-6' id="c_app_approval">
                                                                   <select class='form-control' id='app_status2' name='app_status'>
                                                                        <option>Select application status</option>                                                                       
                                                                        @foreach($app_approve_status as $key => $list)
                                                                        @if($key != 2)
                                                                        <option value="{{{ $key }}}">{{{ $list }}}</option>
                                                                        @endif
                                                                        @endforeach
                                                                   </select>
                                                            </div>
                                                            <?php } ?>
                                                           
                                                       </div>
                                                        <div class="form-group">
                                                           <label class='control-label col-sm-3' for='app_no'>Work Permit Number</label>
                                                            <div class='controls col-sm-6' id="v_app_no">
                                                                 <input class='form-control' id='app_no' name='app_no'  data-rule-required="true" data-rule-minlength="2" placeholder='Work Permit Number' type='text' value="{{ $rView->app_no }}"/> 
                                                            </div>
                                                        </div>
                                                            
                                                       
                                                       <div class="form-group approval_date" style="display:none;">
                                                           <label class='control-label col-sm-3' for='app_approval' id='status_lbl'>Application Date</label>
                                                            <div class='controls col-sm-6  input-group' id="c_app_approval">
                                                                  <input class='form-control datepicker' id='app_approval' name='app_approval'  data-rule-required="true" data-rule-minlength="2" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text'  value="{{ $rView->app_approval_date ? date('d-m-Y',strtotime($rView->app_approval_date)) : '' }}"/> 
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
                                                                        <th width="8%" style="text-align: center;">Work Permit Number</th>
                                                                        <th width="20%" style="text-align: center;">Application Approval / Rejected Date</th>
                                                                        <th width="8%" style="text-align: center;">Application Status</th>                                                                       
                                                                        <!-- <th>Action</th> -->
                                                                    </tr> 
                                                                    @foreach($rViewAll as $val)                                                       
                                                                    <tr>
                                                                        <td width="" align="center">{{ $val->app_no }}</td>
                                                                        <td width="" align="center">{{ $val->app_approval_date!='' && $val->app_approval_date != 0 ? $val->app_approval_date : '-' }}</td>
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
                                                            <label class='control-label col-sm-3' for='app_no'>Work Permit Number</label>
                                                            <div class='controls col-sm-6' id="v_app_no">
                                                                <label class='control-label'>{{ $rView->app_no }}</label>
                                                            </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='app_approval'>Application Date</label>
                                                                <div class='controls col-sm-6' id="c_app_approval">
                                                                    <label class='control-label'>{{ $rView->app_approval_date != '' && $rView->app_approval_date != 0 ? date('d-m-Y',strtotime($rView->app_approval_date)) : '' }}</label>
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class='control-label col-sm-3' for='app_approval'>Application Status</label>
                                                                <div class='controls col-sm-6' id="c_app_approval">
                                                                         <label class='control-label'>{{ array_key_exists($rView->app_status,$app_approve_status) ? $app_approve_status[$rView->app_status] : '-' }}</label>
                                                                </div>
                                                           </div>
                                                           @if(!empty($rView) && $rView->app_status != 1)
                                                           <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                           <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$customer.'/edit') }}'>Update</a>
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
                                                                        <th width="8%" style="text-align: center;">Work Permit Number</th>
                                                                        <th width="20%" style="text-align: center;">Application Approval / Rejected Date</th>
                                                                        <th width="8%" style="text-align: center;">Application Status</th>                                                                       
                                                                        <!-- <th>Action</th> -->
                                                                    </tr> 
                                                                    @foreach($rViewAll as $val)                                                       
                                                                    <tr>
                                                                        <td width="" align="center">{{ $val->app_no }}</td>
                                                                        <td width="" align="center">{{ $val->app_approval_date!= '' && $val->app_approval_date != 0 ? date('d-m-Y',strtotime($val->app_approval_date)) : '-' }}</td>
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
                                                     <?php if(empty($rView->insurance_sub_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('edit-contract-process/'.$step_no) }}" name="frmInsurance" id="frmInsurance" method="post">
                                                        <input type="hidden" name="contract_id" id="contract_id" value="{{ isset($contract_id) ? $contract_id : '' }}" />
                                                        <input type="hidden" name="prev_insurance_cdata" id="prev_insurance_cdata" value="{{ $rView->insurance_sub_date }}" />
                                                        <input type="hidden" name="prev_target_date" id="prev_target_date" value="{{ $rView->target_date}}" />
                                                        <input type="hidden" name="prev_actual_date" id="prev_actual_date" value="{{ $rView->arrival_date }}" />
                                                        <input type="hidden" name="prev_handover_date" id="prev_handover_date" value="{{ $rView->handover_date }}" />
                                                        <input type="hidden" name="prev_eissue_date" id="prev_eissue_date" value="{{ $rView->e_issue_date }}" />
                                                        <input type="hidden" name="prev_doc_return_date" id="prev_doc_return_date" value="{{ $rView->doc_return_date  }}" />
                                                                
                                                        <div class="form-group">
                                                           <label class='control-label col-sm-3' for='ins_submission'>Insurance Submission Date</label>
                                                            <div class='controls col-sm-6  input-group' id="v_ins_sub_date">
                                                                 <input class='form-control datepicker' id='ins_sub_date' name='ins_sub_date'  data-rule-required="true" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value='{{ $rView->insurance_sub_date != '' &&  $rView->insurance_sub_date != 0 ? date('d-m-Y',strtotime($rView->insurance_sub_date)) : '' }}'/> 
                                                                 <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                 <span class="help-block has-error insub_date" for="ins_sub_date" style="color:#cf4a48;"></span>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                             <label class='control-label col-sm-3' for='ins_complete'>Insurance Complete Date</label>
                                                            <div class='controls col-sm-6  input-group' id="v_ins_complete_date">
                                                                 <input class='form-control datepicker' id='ins_complete_date' name='ins_complete_date' data-rule-required="true" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value='{{ $rView->insurance_complete_date != '' && $rView->insurance_complete_date != 0 ? date('d-m-Y',strtotime($rView->insurance_complete_date)) : '' }}' /> 
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
                                                                    <button class="btn-default btn savebtnSubInsuranceData" type="button" data-id="{{ !empty($rView) ? $rView->app_id : '' }}" data-conid="{{ !empty($rView) ? $rView->contract_id : '' }}">Save</button>
                                                                    <button class="btn-primary btn" type="submit" id="save-insurance">Save &amp; Submit</button>
                                                                    <!-- <button class="btn-default btn resetbtn" type="button">Reset</button> -->
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
                                                                          <label class='control-label'>{{ $rView->insurance_sub_date != '' && $rView->insurance_sub_date != 0 ? date('d-m-Y',strtotime($rView->insurance_sub_date)) : '-'}}</label>
                                                                     </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class='control-label col-sm-3' for='ins_complete'>Insurance Complete Date</label>
                                                                <div class='controls col-sm-6 input-group' id="v_ins_complete_date">
                                                                          <label class='control-label'>{{ $rView->insurance_complete_date != '' && $rView->insurance_complete_date != 0 ? date('d-m-Y',strtotime($rView->insurance_complete_date)) : '-' }}</label> 
                                                                     </div>
                                                                </div>
                                                                 <div class="panel-footer">
                                                                     <div class="row">
                                                                         <div class="col-sm-6 col-sm-offset-3">
                                                                           <div class="btn-toolbar">
                                                                                <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$customer.'/edit') }}'>Edit</a>
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
                                                    <?php if(empty($rView->target_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('edit-contract-process/'.$step_no) }}" name="frmMaidArrival" id="frmMaidArrival" method="post">
                                                        <div class="form-group">
                                                            <input type="hidden" name="contract_id" id="contract_id" value="{{ isset($contract_id) ? $contract_id : '' }}" />
                                                            <input type="hidden" name="prev_target_date" id="prev_target_date" value="{{ $rView->target_date}}" />
                                                            <input type="hidden" name="prev_actual_date" id="prev_actual_date" value="{{ $rView->arrival_date }}" />
                                                            <input type="hidden" name="prev_handover_date" id="prev_handover_date" value="{{ $rView->handover_date }}" />
                                                            <input type="hidden" name="prev_eissue_date" id="prev_eissue_date" value="{{ $rView->e_issue_date }}" />
                                                            <input type="hidden" name="prev_doc_return_date" id="prev_doc_return_date" value="{{ $rView->doc_return_date  }}" />
                                                            <label class='control-label col-sm-3' for='target_date'>Target maid arrival date</label>
                                                            <div class='controls col-sm-6 input-group' id="v_date_maid_arrival">
                                                                 <input class='form-control datepicker' id='target_date' name='target_date'  data-rule-required="true" data-rule-minlength="2" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value='{{ $rView->target_date != '' && $rView->target_date != 0 ? date('d-m-Y',strtotime($rView->target_date)) :'' }}'/> 
                                                                  <span class="input-group-addon">
                                                                  <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                                                  </span>
                                                            </div>
                                                            <div class='col-sm-9 pull-right'> 
                                                                    <span class="help-block has-error error_target_date" for="target_date" style="color:#cf4a48;"></span>
                                                            </div>
                                                       </div>
                                                        <div class="form-group">
                                                           <label class='control-label col-sm-3' for='maid_arrival'>Actual maid arrival date</label>
                                                            <div class='controls col-sm-6  input-group' id="v_date_maid_arrival">
                                                                 <input class='form-control datepicker' id='date_maid_arrival' name='date_maid_arrival'  data-rule-required="true" data-rule-minlength="2" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value='{{ $rView->arrival_date != '' && $rView->arrival_date != 0 ? date('d-m-Y',strtotime($rView->arrival_date)) : '' }}' /> 
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
                                                                    <button class="btn-default btn savebtn-targetdate" type="button" data-id="{{ !empty($rView) ? $rView->app_id : '' }}" data-conid="{{ !empty($rView) ? $rView->contract_id : '' }}">Save</button>
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
                                                                       <label class='control-label'>{{ $rView->target_date != '' && $rView->target_date != 0 ? date("d-m-Y",strtotime($rView->target_date)) : '-' }}</label>
                                                                   </div>
                                                              </div>
                                                              <div class="form-group">
                                                                  <label class='control-label col-sm-3' for='ins_submission'>Actual maid arrival date</label>
                                                                   <div class='controls col-sm-6' id="v_date_maid_arrival">
                                                                       <label class='control-label'>{{ $rView->arrival_date != '' && $rView->arrival_date != 0 ? date("d-m-Y",strtotime($rView->arrival_date)) : '-' }}</label>
                                                                   </div>
                                                              </div>
                                                              <div class="panel-footer">
                                                                   <div class="row">
                                                                       <div class="col-sm-6 col-sm-offset-3">
                                                                         <div class="btn-toolbar">
                                                                             <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$customer.'/edit') }}'>Edit</a>
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
                                                    <?php if(empty($rView->handover_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('edit-contract-process/'.$step_no) }}" name="frmHandOver" id="frmHandOver" method="post">
                                                       <div class="form-group">
                                                           <input type="hidden" name="contract_id" id="contract_id" value="{{ isset($contract_id) ? $contract_id : '' }}" />
                                                           <input type="hidden" name="prev_handover_date" id="prev_handover_date" value="{{ $rView->handover_date }}" />
                                                           <input type="hidden" name="prev_eissue_date" id="prev_eissue_date" value="{{ $rView->e_issue_date }}" />
                                                           <input type="hidden" name="prev_doc_return_date" id="prev_doc_return_date" value="{{ $rView->doc_return_date  }}" />
                                                           <label class='control-label col-sm-3' for='date_handover'>Date of Handover</label>
                                                            <div class='controls col-sm-6  input-group' id="v_date_handover">
                                                                 <input class='form-control datepicker' id='date_handover' name='date_handover'  data-rule-required="true" data-rule-minlength="2" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value='{{ $rView->handover_date != '' && $rView->handover_date !=0 ? date('d-m-Y',strtotime($rView->handover_date)) : '' }}' /> 
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
                                                                    <label class='control-label'>{{ $rView->handover_date != '' && $rView->handover_date !=0 ? date('d-m-Y',strtotime($rView->handover_date)) : '-' }}</label>
                                                                </div>
                                                           </div>
                                                           <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                          <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$customer.'/edit') }}'>Edit</a>
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
                                                    <?php if(empty($rView->e_issue_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('edit-contract-process/'.$step_no) }}" name="frmEIssue" id="frmEIssue" method="post">
                                                       <div class="form-group">
                                                          <input type="hidden" name="contract_id" id="contract_id" value="{{ isset($contract_id) ? $contract_id : '' }}" />
                                                          <input type="hidden" name="prev_eissue_date" id="prev_eissue_date" value="{{ $rView->e_issue_date }}" />
                                                          <input type="hidden" name="prev_doc_return_date" id="prev_doc_return_date" value="{{ $rView->doc_return_date  }}" />
                                                          <label class='control-label col-sm-3' for='date_e_issue'>Date of E-issue</label>
                                                            <div class='controls col-sm-6 input-group' id="v_eissue">
                                                                 <input class='form-control datepicker' id='date_e_issue' name='date_e_issue'  data-rule-required="true" data-rule-minlength="2" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value='{{ $rView->e_issue_date != '' && $rView->e_issue_date != 0 ? date('d-m-Y',strtotime($rView->e_issue_date)) : '' }}'/> 
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
                                                                    <label class='control-label'>{{ $rView->e_issue_date != '' && $rView->e_issue_date != 0 ? date('d-m-Y',strtotime($rView->e_issue_date)) : '' }}</label>
                                                                </div>
                                                           </div>
                                                           <div class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                      <div class="btn-toolbar">
                                                                          <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$customer.'/edit') }}'>Edit</a>
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
                                                    <?php if(empty($rView->doc_return_date) || $edit_mode == "edit") {  ?>
                                                    <form class="form form-horizontal validate-form" action="{{ URL::to('edit-contract-process/'.$step_no) }}" name="frmdocreturn" id="frmdocreturn" method="post">
                                                       <div class="form-group">
                                                           <input type="hidden" name="contract_id" id="contract_id" value="{{ isset($contract_id) ? $contract_id : '' }}" />
                                                           <input type="hidden" name="prev_doc_return_date" id="prev_doc_return_date" value="{{ $rView->doc_return_date  }}" />
                                                           <input type="hidden" name="bio_id" id="bio_id" value="{{ $rView->fkBioId  }}" />
                                                          
                                                           <label class='control-label col-sm-3' for='date_doc_return'>Date of Document return</label>
                                                            <div class='controls col-sm-6  input-group' id="v_docreturn">
                                                                 <input class='form-control datepicker' id='date_doc_return' name='date_doc_return'  data-rule-required="true" data-rule-minlength="2" data-format="DD-MM-YYYY"  placeholder='DD-MM-YYYY' type='text' value='{{ $rView->doc_return_date != '' && $rView->doc_return_date != 0 ? date('d-m-Y',strtotime($rView->doc_return_date)) : '' }}'/> 
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
																	<div class="col-sm-9 pull-right">
																	
																	@if(!empty($invoice_list))
																	 	@if(!empty($fee_list))
																			 <?php $bal_amt =  $total_amt  =  $payVendorAmt = $vbal = 0; ?>
																			 @foreach($fee_list as $key => $li)
																			     @if($li->l4_id == 8)
																					<?php $payVendorAmt = $li->amount; ?>
																				 @endif
																				<?php $total_amt += $li->amount; ?>
																			 @endforeach
																			<?php  
																				$paid_amt = $invoice_list->receipt_amt!= '' ? number_format($invoice_list->receipt_amt,2,'.','') : '0.00';
																			    $bal_amt = $total_amt - $paid_amt; 
																			    if(!empty($receivable_customer) && $resultStatus->contract_cases != 1){
																				  $dbal =  number_format($bal_amt,2,'.','');
																				  $bal_amt = (double)$dbal - (double)$receivable_customer->credit;
																			    }
																				 $vbal = $payVendorAmt - $vpaid;
																			 ?>
																			 
																		@endif
																		 @if($bal_amt != 0)
																			<div class="pull-left" style="margin-bottom:10px;"><a href="#payment_balance" data-toggle="modal" class="btn btn-primary">Add Receipt</a></div>
																		@endif
																		@if($user_role == 1 && $vbal != 0)
																			<div class="pull-left" style="margin-bottom:10px;margin-left:10px;"><a href="#vendor_payment_balance" data-toggle="modal" class="btn btn-primary">Add Payment</a></div>
                                                                        @endif
																	@endif
																	<div class="pull-left" style="margin-bottom:10px;margin-left:10px;"><a href="#add_admin_rebate" data-toggle="modal" class="btn btn-primary">Add Admin Rebate</a></div>
                                                                        								</div>
																	
                                                                  </div>
                                                                </div>
                                                            </div>
                                                       </div> 
                                                    </form>
                                                    <?php } else { ?>
                                                      <form class="form form-horizontal validate-form">
                                                       <div class="form-group">
                                                           <label class='control-label col-sm-3' for='date_doc_return'>Date of Document return</label>
                                                            <div class='controls col-sm-6' id="v_docreturn">
                                                                <label class='control-label'>{{ $rView->doc_return_date != '' && $rView->doc_return_date != 0 ? date('d-m-Y',strtotime($rView->doc_return_date)) : '' }}</label>
                                                            </div>
                                                       </div>
                                                       <div class="panel-footer">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-sm-offset-3">
                                                                  <div class="btn-toolbar">
                                                                       <a class="btn-primary btn" href='{{ URL::to('edit-contract/'.$step_no.'/'.$customer.'/edit') }}'>Edit</a>
                                                                  
                                                                  <div class="col-sm-6 pull-right">
																	
																	@if(!empty($invoice_list))
																	 	@if(!empty($fee_list))
																			 <?php $bal_amt =  $total_amt  =  $payVendorAmt = $vbal = 0; ?>
																			 @foreach($fee_list as $key => $li)
																			     @if($li->l4_id == 8)
																					<?php $payVendorAmt = $li->amount; ?>
																				 @endif
																				<?php $total_amt += $li->amount; ?>
																			 @endforeach
																			<?php  
																				$paid_amt = $invoice_list->receipt_amt!= '' ? number_format($invoice_list->receipt_amt,2,'.','') : '0.00';
																			    $bal_amt = $total_amt - $paid_amt; 
																			    if(!empty($receivable_customer) && $resultStatus->contract_cases != 1){
																				  $dbal =  number_format($bal_amt,2,'.','');
																				  $bal_amt = (double)$dbal - (double)$receivable_customer->credit;
																			    }
																				 $vbal = $payVendorAmt - $vpaid;
																			 ?>
																			 
																		@endif
																		 @if($bal_amt != 0)
																			<div class="pull-left" style="margin-bottom:10px;"><a href="#payment_balance" data-toggle="modal" class="btn btn-primary">Add Receipt</a></div>
																		@endif
																		@if($user_role == 1 && $vbal != 0)
																			<div class="pull-left" style="margin-bottom:10px;margin-left:10px;"><a href="#vendor_payment_balance" data-toggle="modal" class="btn btn-primary">Add Payment</a></div>
                                                                        @endif
																	@endif
																	<div class="pull-left" style="margin-bottom:10px;margin-left:10px;"><a href="#add_admin_rebate" data-toggle="modal" class="btn btn-primary">Add Admin Rebate</a></div>
                                                                        								
																	</div>
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

                                    @if($step_no == 'step8')
                                            <div class='modal fade' id='add_admin_rebate' tabindex='-1'>
                                                                            <div class='modal-dialog'>
                                                                                <div class='modal-content'>
                                                                                  <div class='modal-header'>
                                                                                    <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                                                                    <h4 class='modal-title' id='myModalLabel'>Pay Admin Rebate</h4>
                                                                                   </div>
                                                                                  <form class="form validate-form" style="margin-bottom: 0;" method="post" action="{{ URL::to('contract/add-admin-rebate') }}" accept-charset="UTF-8">
                                                                                    <input name="contractId" type="hidden" value="{{ isset($contract_id) ? $contract_id  : '' }}"/>
									            <input name="file_url" type="hidden" value="{{ Request::Segment(1) }}" />
                                                                                    <div class='modal-body'>
                                                                                        <div class="form-group">
                                                                                            <label for='admin_rebate_amt'>Admin Rebate Fee</label>
                                                                                            <input class='form-control' id='admin_rebate' name='admin_rebate'  data-rule-required="true" placeholder="Amount Paid" type='text' value="{{ $rView->admin_rebate }}"/> 
                                                                                       </div> 
                                                                                    </div>
                                                                                    <div class='modal-footer'>
                                                                                      <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                      <button class='btn btn-primary' type='submit'>Pay Fee</button>
                                                                                    </div>
                                                                                  </form>
                                                                                </div>
                                                                              </div>
                                                            </div><!-- pay balance modal-->  
                                 @endif
				 @if(($step_no == 'step1' || $step_no == 'step8') && !empty($invoice_list))
                                                       <div class='modal fade' id='payment_balance' tabindex='-1'>
                                                                            <div class='modal-dialog'>
                                                                                <div class='modal-content'>
                                                                                  <div class='modal-header'>
                                                                                    <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                                                                    <h4 class='modal-title' id='myModalLabel'>Contract Balance Payment</h4>
                                                                                   </div>
                                                                                  <form class="form validate-form" style="margin-bottom: 0;" method="post" action="{{ URL::to('contract/balance-payment') }}" accept-charset="UTF-8">
                                                                                    <input name="contractId" type="hidden" value="{{ isset($contract_id) ? $contract_id  : '' }}"/>                                                                                    
                                                                                    <input id="hinvoice_no" name="hinvoice_no" type="hidden" value="{{ !empty($invoice_list) ? $invoice_list->invoice_id :'' }}"/>
                                                                                    <input id="hcustomer_id" name="hcustomer" type="hidden" value="{{ !empty($invoice_list) ? $invoice_list->customer_id : '' }}"/>
                                                                                    <div class='modal-body'>
                                                                                       <div class="form-group">
                                                                                            <label for='target_fee'>Total Amount</label>
                                                                                            <input class='form-control' id='target_fee' name='target_fee'  data-rule-required="true" placeholder='Target fee' type='text' value="{{ number_format($total_amt,2,'.','') }}" readonly="readonly"/> 
                                                                                       </div> 
                                                                                        <div class="form-group">
                                                                                            <label for='paid_amt'>Paid Amount</label>
                                                                                            <input class='form-control' id='paid_amt' name='paid_mat'  data-rule-required="true" placeholder="Amount Paid" type='text' value="{{ number_format($paid_amt,2) }}" readonly="readonly"/> 
                                                                                       </div> 
                                                                                       <div class="form-group">
                                                                                            <label for='bal_amt'>Balance Amount</label>
                                                                                            <input class='form-control' id='bal_amt' name='bal_amt'  data-rule-required="true" placeholder="Amount Balane" type='text' value="{{ number_format($bal_amt,2,'.','') }}" readonly="readonly"/> 
                                                                                       </div>
                                                                                       <div class="form-group">
                                                                                            <label>Amount</label>
                                                                                            <input class="form-control rec_mat" id="epay_amt" name="epay_amt"  pay-amount="true" pay-check="true" data-rule-required="true" placeholder="Amount" type="text" value="" /> 
                                                                                            <label class="error" for="epay_amt"></label>
                                                                                       </div> 
                                                                                        <div class="form-group">
                                                                                            <label>Cash / Bank Account</label>
                                                                                               <select class='form-control rec_mat select2' id='epayment_account' name='epayment_account'>
                                                                                                  @if(!empty($payment_coa))
                                                                                                   @foreach($payment_coa as $key => $list)
                                                                                                   <option value="{{{ $list->id }}}">{{{ $list->level4_name }}}</option>
                                                                                                   @endforeach
                                                                                                  @endif
                                                                                               </select>
                                                                                       </div> 
                                                                                       <div class="form-group">
                                                                                            <label for='cheque_no'>Cheque No</label>
                                                                                                 <input class='form-control rec_mat' id='echeque_no' name='echeque_no'  data-rule-required="true" data-rule-minlength="2" placeholder='Cheque / Reference No' type='text' /> 
                                                                                        </div>  
                                                                                       <div class="form-group">
                                                                                            <label for='Remarks'>Description / Remarks</label>
                                                                                                <textarea class='form-control rec_mat' id='eremarks' name='eremarks' data-rule-required="true" data-rule-minlength="2" placeholder='Description / Remarks'></textarea> 
                                                                                        </div>
                                                                                   </div>
                                                                                   
                                                                                   <div class='modal-footer'>
                                                                                      <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                      <button class='btn btn-primary' type='submit'>Pay Fee</button>
                                                                                   </div>
                                                                                  </form>
                                                                                </div>
                                                                              </div>
                                                            </div><!-- pay balance modal-->  
                                                            @endif
													 @if($step_no == 'step8' && !empty($invoice_list))
													 <?php 
													 $vbal = $payVendorAmt - $vpaid;
													 ?>
													 
                                                       <div class='modal fade' id='vendor_payment_balance' tabindex='-1'>
                                                                            <div class='modal-dialog'>
                                                                                <div class='modal-content'>
                                                                                  <div class='modal-header'>
                                                                                    <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                                                                    <h4 class='modal-title' id='myModalLabel'>Pay to Vendor</h4>
                                                                                   </div>
                                                                                  <form class="form validate-form" style="margin-bottom: 0;" method="post" action="{{ URL::to('contract/vendor-balance-payment') }}" accept-charset="UTF-8">
                                                                                    <input name="contractId" type="hidden" value="{{ isset($contract_id) ? $contract_id  : '' }}"/>
																				    <input name="file_url" type="hidden" value="{{ Request::Segment(1) }}" />
																					<input id="receipt_amt" name="receipt_amt" type="hidden" value="{{ $bal_amt }}"/>
																					<input id="hinvoice_no" name="hinvoice_no" type="hidden" value="{{ !empty($invoice_list) ? $invoice_list->invoice_no :'' }}"/>
																					<input id="vendor_id" name="vendor_id" type="hidden" value="{{ !empty($rView) ? $rView->vendor_id :'' }}"/>
																					<input id="vendor_name" name="vendor_name" type="hidden" value="{{ !empty($rView) ? $rView->vendor_name :'' }}"/>
																					<input id="vbranch" name="vbranch" type="hidden" value="{{ !empty($rView) ? $rView->branch :'' }}"/>
																					<div class='modal-body'>
                                                                                       <div class="form-group">
                                                                                            <label for='target_fee'>Total Vendor Amount</label>
                                                                                            <input class='form-control' id='tvendor_amt' name='tvendor_amt'  data-rule-required="true" placeholder='Target fee' type='text' value="{{ number_format($payVendorAmt,2,'.','') }}" readonly="readonly"/> 
                                                                                       </div> 
                                                                                        <div class="form-group">
                                                                                            <label for='paid_amt'>Paid Amount</label>
                                                                                            <input class='form-control' id='vpaid_amt' name='vpaid_mat'  data-rule-required="true" placeholder="Amount Paid" type='text' value="{{ number_format($vpaid,2) }}" readonly="readonly"/> 
                                                                                       </div> 
                                                                                       <div class="form-group">
                                                                                            <label for='bal_amt'>Balance Amount</label>
                                                                                            <input class='form-control' id='vbal_amt' name='vbal_amt'  data-rule-required="true" placeholder="Amount Balane" type='text' value="{{ number_format($vbal,2,'.','') }}" readonly="readonly"/> 
                                                                                       </div>
                                                                                       <div class="form-group">
                                                                                            <label>Amount</label>
                                                                                            <input class="form-control rec_mat" id="vpay_amt" name="vpay_amt"  pay-amount="true" vpay-check="true" data-rule-required="true" placeholder="Amount" type="text" value="" /> 
                                                                                            <span class="help-block has-error" for="vpay_amt"></span>
                                                                                       </div> 
                                                                                        <div class="form-group">
                                                                                            <label>Cash / Bank Account</label>
                                                                                               <select class='form-control rec_mat select2' id='vpayment_account' name='vpayment_account'>
                                                                                                  @if(!empty($payment_coa))
                                                                                                   @foreach($payment_coa as $key => $list)
                                                                                                   <option value="{{{ $list->id }}}">{{{ $list->level4_name }}}</option>
                                                                                                   @endforeach
                                                                                                  @endif
                                                                                               </select>
                                                                                       </div> 
                                                                                       <div class="form-group">
                                                                                            <label for='cheque_no'>Cheque No</label>
                                                                                                 <input class='form-control rec_mat' id='vcheque_no' name='vcheque_no'  data-rule-required="true" data-rule-minlength="2" placeholder='Cheque / Reference No' type='text' />
																								 <span class="help-block has-error" for="vcheque_no"></span>
                                                                                        </div>  
                                                                                       <div class="form-group">
                                                                                            <label for='Remarks'>Description / Remarks</label>
                                                                                                <textarea class='form-control rec_mat' id='vremarks' name='vremarks' data-rule-required="true" data-rule-minlength="2" placeholder='Description / Remarks'></textarea> 
																							    <span class="help-block has-error" for="vremarks"></span>
																					   </div>
                                                                                   </div>
                                                                                   
                                                                                   <div class='modal-footer'>
                                                                                      <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                                                      <button class='btn btn-primary' type='submit'>Pay Fee</button>
                                                                                   </div>
                                                                                  </form>
                                                                                </div>
                                                                              </div>
                                                            </div><!-- pay balance modal-->  
                                                            @endif

@include('includes.jscript')
<script>
   function terminate(id,value,invoice_status,receipt_status) {
      if(invoice_status == 1 && receipt_status == 1){ 
        var confirmMsg;
        if(value == 4)  
           confirmMsg = confirm("Are your sure want to Terminate the Contract and proceed with Replacement");
        else
           confirmMsg = confirm("Are you sure want to terminate this contract?"); 
        if(confirmMsg) {
          window.location = '{{ URL::to('contract/terminate/') }}/'+id+'/'+value;
        }
      } else {
          alert('Approve contract invoice and corresponding receipts for terminate process');
      }
    }
    $(document).ready(function(){
        /*$('#placement_fee_val').val(0);
        $('#payable_vendor').val(0);
        $('#total_placement').val(0);
        $('#island_fee').val(0);
        $('#vendor_payable').val(0);*/
        $("#collected_fee").html('<?php echo $collected_fee; ?>');
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
        
       /* $('#payment_balance').on('hidden.bs.modal', function (e) {
           
            alert($(this).data('bal-amt'));
            //$('.form-control').attr('disabled',false);
            // do something...
        })*/
        <?php if(!empty($rView)) { ?>
        var contract_status = <?php echo $rView->contract_cases;?>;
        if(contract_status != 1){
            $('.form-control').attr('disabled',true);
            $('.panel-footer').hide();
            $(".select2").select2("enable", false); 
        }
        <?php } ?>
           var rct_amt = <?php echo $bal_amt; ?>;
           if(rct_amt != 0){
               $('.rec_mat').attr('disabled',false);
           }
         /*var total_place_fee = $('#total_placement').val();
         alert('test');
         if(total_place_fee != ''){
             $('#loan_amt').val(total_place_fee.toFixed());
         }*/
         $('#pay_fee_post').click(function(){
            var island_fee     = parseFloat($('#island_fee').val());
            var vendor_payable = parseFloat($('#vendor_payable').val());
            $('#placement_fee_val').val(island_fee);
            $('#payable_vendor').val(vendor_payable);
            var total_val      = parseFloat(island_fee) + parseFloat(vendor_payable);
            $('#total_placement').val(numberWithOutCommasInput(total_val));
            calc_target_fee();
            //var total_fee      =  parseFloat($("#target_fee").val()) + parseFloat($('#total_placement').val());
            //$("#target_fee").val(total_fee.toFixed());;
            
            
        });
        $('.savebtnSubInsuranceData').click(function(){
            var pInsubDate     = $('#prev_insurance_cdata').val();
            var pHandover      = $('#prev_handover_date').val();
            var pEissueDate    = $('#prev_eissue_date').val();
            var pDocReturnDate = $('#prev_doc_return_date').val();
            var ptargetDate    = $('#prev_target_date').val();
            var sub_date =  $('#ins_sub_date').val();
            var app_id   =  $(this).data('id');
            var contract_id = $(this).data('conid');
            
            if(sub_date != '') {
                $('.insub_date').html('');
                $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'actionCall=update_insurance_subdate&in_sub_date='+sub_date+'&pInsub='+pInsubDate+'&pHandover='+pHandover+'&pEissueDate='+pEissueDate+'&pDocReturnDate='+pDocReturnDate+'&ptargetDate='+ptargetDate+'&appId='+app_id+'&contract_id='+contract_id,
                         success:function(response) {
                            if(response == 1) {
                                alert('Insurance Submission Data updated Successfully')
                            } 
                         }  
                 });
            } else {
                $('.insub_date').html('This field is required.');
            }
        });
        
        $('.savebtn-targetdate').click(function(){
            var target_date       = $('#target_date').val();
            var pHandover      = $('#prev_handover_date').val();
            var pEissueDate    = $('#prev_eissue_date').val();
            var pDocReturnDate = $('#prev_doc_return_date').val();
            var ptargetDate    = $('#prev_target_date').val();
            
            var app_id      = $(this).data('id');
            var contract_id = $(this).data('conid');
            if(target_date !='') {
                $('.error_target_date').html('');
                $.ajax({
                         type :'POST',
                         url  : baseUrl+'contract/ajax-call',
                         data : 'actionCall=update_maid_target_date&target_date='+target_date+'&pHandover='+pHandover+'&pEissueDate='+pEissueDate+'&pDocReturnDate='+pDocReturnDate+'&ptargetDate='+ptargetDate+'&appId='+app_id+'&contract_id='+contract_id,
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
         
                 $('#bio_id').change(function(){
            var bio_id = $(this).val();
            if(bio_id != ''){
                $.ajax({
                    type : 'POST',
                    url  : actionPath+'contract/ajax-call',
                    data : 'actionCall=getTransferMaid&bio_id='+bio_id,
                    success : function(response){
                        var bal = response;
                        $('#maid_receivable').val($.trim(bal));
                        $('#total_placement').val($.trim(bal));
                        calc_target_fee();
                        if(bal != 0)
                            $('#ter_maid').val(1);
                        else
                            $('#ter_maid').val(0);
                    }
                });
            }
        });
        
        $('#total_placement').change(function(){
            var ref_amt  = $.trim($('#maid_receivable').val());
            var tot_pamt = $(this).val();
            if(ref_amt!= 0 && tot_pamt < ref_amt){
                alert('Refund amount '+ref_amt+' Placement fee should be greater or equal to refund amount');
                $(this).val(ref_amt);
                $(this).focus();
            }
        });
         $('#contract_terms').change(function(){
            var from_date = $('#cs_from_date').val();
            if(from_date != ''){
              var fdate = from_date.split("-");
              var d = new Date(fdate[2]+'-'+fdate[1]+'-'+fdate[0]);
              var toDate = new Date(d.setMonth(d.getMonth() + parseInt($(this).val()) + 1));
              var to_date   = toDate.getDate()+'-'+toDate.getMonth()+'-'+toDate.getFullYear();
              $("#cs_to_date").datepicker("update", to_date);
            }
        });
        
        $('#cs_from_date').datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true,
            }).on('changeDate',function(ev) {
              var addYear;
              var terms = $('#contract_terms').val();
              var fromDate = new Date(ev.date);
              fromDate.setMonth(ev.date.getMonth() + parseInt(terms)  + 1);
              var toDate = fromDate.getDate()+'-'+fromDate.getMonth()+'-'+fromDate.getFullYear();
             $("#cs_to_date").datepicker("update", toDate);
         });
        $.validator.addMethod('pay-check', function(value, element, param) {
                return  parseInt(value) <= parseInt($('#bal_amt').val());
        }, 'Pay amount should be less target fee amount');

        $.validator.addMethod('pay-amount', function(value, element, param) {
                return  parseInt(value) > 0;
        }, 'Fees amount should be greater than zero');
        //$()

        //fee types checkbox handlers
        function calc_target_fee(){
          admin_fee = parseFloat($("#admin_fee_val").val());
          ins_fee = parseFloat($("#ins_fee_val").val());
          agency_fee = parseFloat($("#agency_fee_val").val());
          placement_fee = parseFloat($("#total_placement").val());
          tfee =  parseFloat(admin_fee+ins_fee+agency_fee+placement_fee);
          $("#target_fee").val(numberWithDecimal(tfee));
        }

        var admin_fee_present_val = $("#paid_admin_fee_val").val();
        var ins_fee_present_val = $("#paid_ins_fee_val").val();
        var agency_fee_present_val = $("#paid_agency_fee_val").val();

        var bal_admin_fee_present_val = $("#bal_admin_fee_val").val();
        var bal_ins_fee_present_val = $("#bal_ins_fee_val").val();
        var bal_agency_fee_present_val = $("#bal_agency_fee_val").val();


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
        
        $("#total_placement").focusout(function(){   
          if($(this).val()!=''){            
            calc_target_fee();      
            }
          else{
            $(this).val(0); 
            calc_target_fee();            
          }          
        });
        
        

        $("#paid_admin_fee_val").focusout(function(){      
            //console.log($.isNumeric($(this).val()));
          if($(this).val()!='' && $.isNumeric($(this).val())){
                if(parseInt($(this).val()) <= parseInt($('#bal_admin_fee_val').val())){
                  calc_paid_fee(); 
                }//if val lesser
                else {
                  alert('Value greater than target fee');
                  $(this).val(bal_admin_fee_present_val);
                 }//else                 
            }//if not empty
          else{
            $(this).val(0);
            calc_paid_fee();
          }    
        });

        $("#paid_ins_fee_val").focusout(function(){   
          if($(this).val()!='' && $.isNumeric($(this).val())){
            if(parseInt($(this).val()) <= parseInt($('#bal_ins_fee_val').val())){
              calc_paid_fee(); 
              }//if val lesser
            else {
              alert('Value greater than target fee');
              $(this).val(bal_ins_fee_present_val);
              }//else                 
            }//if not empty
          else{
            $(this).val(0);
            calc_paid_fee();
          }
          
        });

        $("#paid_agency_fee_val").focusout(function(){   
          if($(this).val()!=''){
            if(parseInt($(this).val()) <= parseInt($('#bal_agency_fee_val').val())){
              calc_paid_fee(); 
              }//if val lesser
            else {
              alert('Value greater than target fee');
              $(this).val(bal_agency_fee_present_val);
              }//else                 
            }//if not empty
          else{
            $(this).val(0);
            calc_paid_fee();
          }        
        });
        
        /* main fee */
        function f_calc_paid_fee(){
          paid_admin_fee = parseInt($("#f_paid_admin_fee_val").val());
          paid_ins_fee = parseInt($("#f_paid_ins_fee_val").val());
          paid_agency_fee = parseInt($("#f_paid_agency_fee_val").val());
          paid_tfee = paid_admin_fee+paid_ins_fee+paid_agency_fee;
          //console.log(paid_tfee);
          $("#f_paid_total").val(paid_tfee);
        }
        $("#f_paid_admin_fee_val").focusout(function(){      
            //console.log($.isNumeric($(this).val()));
          if($(this).val()!='' && $.isNumeric($(this).val())){
                if(parseInt($(this).val()) <= parseInt($('#admin_fee_val').val())){
                  f_calc_paid_fee(); 
                }//if val lesser
                else {
                  alert('Value greater than target fee');
                  $(this).val($("#admin_fee_val").val());
                 }//else                 
            }//if not empty
          else{
            $(this).val(0);
            f_calc_paid_fee();
          }    
        });
        $("#f_paid_ins_fee_val").focusout(function(){   
          if($(this).val()!='' && $.isNumeric($(this).val())){
            if(parseInt($(this).val()) <= parseInt($('#ins_fee_val').val())){
              f_calc_paid_fee(); 
              }//if val lesser
            else {
              alert('Value greater than target fee');
              $(this).val($("#ins_fee_val").val());
              }//else                 
            }//if not empty
          else{
            $(this).val(0);
            f_calc_paid_fee();
          }
          
        });
        $("#f_paid_agency_fee_val").focusout(function(){   
          if($(this).val()!=''){
            if(parseInt($(this).val()) <= parseInt($('#agency_fee_val').val())){
              f_calc_paid_fee(); 
              }//if val lesser
            else {
              alert('Value greater than target fee');
              $(this).val($("#agency_fee_val").val());
              }//else                 
            }//if not empty
          else{
            $(this).val(0);
            f_calc_paid_fee();
          }        
        });

        /*$("#paid_bal_admin_fee_val").focusout(function(){                  
          if($(this).val()!=''){
            if($(this).val()<=$('#bal_admin_fee_val').val()){
              calc_paid_fee(); 
              }//if val lesser
            else {
              alert('Value greater than target fee');
              $(this).val(bal_admin_fee_present_val);
              }//else                 
            }//if not empty
          else{
            $(this).val(0);
            calc_paid_fee();
          }    
        });

        $("#paid_bal_ins_fee_val").focusout(function(){   
          if($(this).val()!=''){
            if($(this).val()<=$('#bal_ins_fee_val').val()){
              calc_paid_fee(); 
              }//if val lesser
            else {
              alert('Value greater than target fee');
              $(this).val(bal_ins_fee_present_val);
              }//else                 
            }//if not empty
          else{
            $(this).val(0);
            calc_paid_fee();
          }
          
        });

        $("#paid_bal_agency_fee_val").focusout(function(){   
          if($(this).val()!=''){
            if($(this).val()<=$('#bal_agency_fee_val').val()){
              calc_paid_fee(); 
              }//if val lesser
            else {
              alert('Value greater than target fee');
              $(this).val(bal_agency_fee_present_val);
              }//else                 
            }//if not empty
          else{
            $(this).val(0);
            calc_paid_fee();
          }        
        });*/
        
        $("#app_status").change(function(){
          $(".approval_date").show();
          if($(this).val()==4) {$("#status_lbl").text('Application Pending date')}
          else if($(this).val()==1) {$("#status_lbl").text('Application approval date')}
          else if($(this).val()==2) {$("#status_lbl").text('Application appeal date')}
          else {$(".approval_date").hide();}
        });

        $("#app_status2").change(function(){
          $(".approval_date").show();
          if($(this).val()==4) {$("#status_lbl").text('Application Pending date')}
          else if($(this).val()==1) {$("#status_lbl").text('Application approval date')}
          else if($(this).val()==3) {$("#status_lbl").text('Application reject date')}
          else {$(".approval_date").hide();}
        });
        var baseUrl  = <?php echo '"'.$baseUrl.'";' ?>
         $('.resetbtn').click(function(){
            $('#leadId').val('');
            $('#branch_list').val('');
            $('#pay_mode').val('');
            $('#pay_amt').val('1');
            $('#cheque_no').val('');
            $('#pay_name').val('');
            $('#bank_name').val('');
            $('#issue_date').val('4');
        });
    });
     
</script>
@stop
