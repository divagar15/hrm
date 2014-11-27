@extends('layouts.master')
<?php
$salId  = Request::Segment(3);
?>
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Edit Employee Salary</span>
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
                                <li class="">Payroll</li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">Edit Employee Salary</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                    <div class='col-sm-12'>
                        <div class="row">
                        <div class="col-sm-12">
                        <div class="pull-right">
                        <a class="btn btn-warning btn-xs has-tooltip" data-placement="top" data-original-title="Back" href="{{ URL::to('payroll/processed-employee-salary-list') }}">Back</a>
                        </div>
                        </div>
                        </div>  
                            <div class="box">
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
                                <div class="box-header blue-background">
                                    <div class="title">Edit Employee Salary</div>
                                </div>
                                <div class="box-content">
                                    <form class="form form-horizontal validate-form" style="margin-bottom:0" method="post" name="rclfrm" id="rclfrm" action="{{ URL::to('payroll/recalculate-process') }}">
                                        <input type="hidden" name="sal_id" id="sal_id" value="{{ $salId }}" />
                                        <input type="hidden" name="emp_id" id="emp_id" value="{{ $elist->emp_id }}" />
                                        <input type="hidden" name="hire_date" id="hide_date" value="{{ $elist->hire_date }}" />
                                        <input type="hidden" name="cessation_date" id="cessation_date" value="{{ $elist->cessation_date }}" />
                                         <div class="row">
                                        <div class="col-xs-6 col-sm-4 col-md-4">
                                          <div class='form-group'>
                                             <label class='col-sm-2' for='custom_name'>Name:</label>
                                             <div class='col-sm-10'>
                                                 <input type="hidden" name="sal_id" id="sal_id" value="{{ $salId }}" />
                                                  <label class='col-sm-12' style="font-weight:100;">{{{ ucwords($elist->emp_name) }}}</label>
                                             </div>
                                        </div>
                                        <div class='form-group'>
                                             <label class='col-sm-4' for='email'>Basic:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-8' style="font-weight:100;" id="l_basic">{{ $elist->basic }}</label>
                                                  <input type="hidden" name="basic" id="basic" value="{{ $elist->basic }}" />
                                                  <a href="#modify-info" class="btn btn-primary btn-xs has-popover modify-btn" data-toggle="modal" data-inval="basic" data-field="Basic">Modify</a>
                                             </div>
                                       </div>
                                       <div class='form-group'>
                                              <label class='col-sm-4' for='validation_name'>NPL Deducation:</label>
                                              <div class='col-sm-6'>
                                                    <label class='col-sm-8' style="font-weight:100;" id="l_npl">{{ $elist->npl_amt }}</label>
                                                    <input type="hidden" name="npl_amt" id="npl" value="{{ $elist->npl_amt }}" /> 
                                                    <a href="#modify-info" class="btn btn-primary btn-xs has-popover modify-btn" data-toggle="modal" data-inval="npl" data-field="No pay Leave Amount">Modify</a>
                                              </div>
                                       </div>
                                       <div class='form-group'>
                                              <label class='col-sm-4' for='validation_name'>Basic Paid:</label>
                                              <div class='col-sm-6'>
                                                    <label class='col-sm-6' style="font-weight:100;" id="1_basic_paid">${{ number_format($elist->basic_paid,2) }}</label>
                                              </div>
                                       </div>
                                       <div class='form-group'>
                                              <label class='col-sm-4' for='validation_name'>Commission:</label>
                                              <div class='col-sm-6'>
                                                    <label class='col-sm-8' style="font-weight:100;" id="l_comm">{{ $elist->commission }}</label>
                                                    <input type="hidden" name="comm" id="comm" value="{{ $elist->commission }}" /> 
                                                    <a href="#modify-info" class="btn btn-primary btn-xs has-popover modify-btn" data-toggle="modal" data-inval="comm" data-field="Commission Amount">Modify</a>
                                              </div>
                                       </div>
                                       <div class='form-group'>
                                             <label class='col-sm-4' for='allowance'>Allowances:</label>
                                             <div class='col-sm-8'>
                                                  <label class='col-sm-5' style="font-weight:100;" id="cl_allowance">{{ $elist->allowances_cost != 0 ? $elist->allowances_cost : '0:00' }}</label>
                                                  <input type="hidden" name="c_type" id="c_type" value="" />
                                                  <input type="hidden" name="c_amt" id="c_amt" value="" />
                                                  <input type="hidden" name="ct_amt" id="ct_amt" value="" />
                                                  <input type="hidden" name="etc_type" id="etc_type" value="" />
                                                  <input type="hidden" name="etc_amt" id="etc_amt" value="" />
                                                  <input type="hidden" name="c_allowance" id="c_allowance" value="{{ $elist->allowances_cost != 0 ? $elist->allowances_cost : 0 }}" />
                                                  <a href="#add-allow" class="btn btn-success btn-xs has-popover" id="add-btn" data-toggle="modal">Add / Edit</a>
                                             </div>
                                       </div>
                                            <div class='form-group' style="margin-left: 1px;">
                                           <input type="button"  class="btn btn-warning" name="recal" id="recal" value="Recalculate"/>
                                       </div>     
                                       <div class='form-group'>
                                             <label class='col-sm-4' for='allowance'>Gross:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-9' style="font-weight:100;" id="l_gross">${{ number_format($elist->gross,2) }}</label>
                                             </div>
                                       </div>
                                      
                                       </div><!--col-md-6-->
                                       <div class="col-xs-6 col-sm-4 col-md-4">
                                          <div class='form-group'>
                                             <label class='col-sm-5' for='year_m'>Year:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-8' style="font-weight:100;">{{ date('Y',strtotime($elist->salary_from_date)) }}</label>
                                             </div>
                                          </div>
                                          <div class='form-group'>
                                             <label class='col-sm-5' for='cpf_ee'>CPF EE:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-8' style="font-weight:100;" id="l_cpf_ee">{{ $elist->ee_cpf }}</label>
                                                  <input type="hidden" name="cpf_ee" id="cpf_ee" value="{{ $elist->ee_cpf  }}" /> 
                                                  <a href="#modify-info" class="btn btn-primary btn-xs has-popover modify-btn" data-toggle="modal" data-inval="cpf_ee" data-field="CPF Employee">Modify</a>
                                             </div>
                                        </div>
                                        <div class='form-group'>
                                             <label class='col-sm-5' for='email'>Loan Deducation:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-4' style="font-weight:100;">{{ $elist->mloan_amt }}</label>
                                                  <input type="hidden" name="loan_deducation" id="loan_deducation" value="{{ $elist->mloan_amt }}" /> 
                                             </div>
                                       </div>
                                      <div class='form-group' style="margin-top:54%">
                                              <label class='col-sm-5' for='validation_name'>Total Deducation:</label>
                                              <div class='col-sm-6'>
                                                    <label class='col-sm-6' style="font-weight:100;" id="l_dedu">${{ number_format($elist->total_deducate,2) }}</label>
                                              </div>
                                       </div>
                                      
                                       </div>
                                       <div class="col-xs-6 col-sm-4 col-md-4">
                                        <div class='form-group'>
                                             <label class='col-sm-5' for='year_m'>Month:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-7' style="font-weight:100;">{{ date('M',strtotime($elist->salary_from_date)) }}</label>
                                             </div>
                                        </div>
                                        <div class='form-group'>
                                             <label class='col-sm-4' for='name'>CPF Wage:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-8' style="font-weight:100;" id="l_cpf_wage">{{ $elist->cpf_wages }}</label>
                                                  <input type="hidden" name="cpf_wage" id="cpf_wage" value="{{ $elist->cpf_wages }}" /> 
                                                  <a href="#modify-info" class="btn btn-primary btn-xs has-popover modify-btn" data-toggle="modal" data-inval="cpf_wage" data-field="CPF Wages">Modify</a>
                                            </div>
                                        </div>
                                        <div class='form-group'>
                                             <label class='col-sm-4' for='email'>CPF ER:</label>
                                             <div class='col-sm-6'>
                                                  <label class='col-sm-8' style="font-weight:100;" id="l_cpf_er">{{ $elist->er_cpf }}</label>
                                                  <input type="hidden" name="cpf_er" id="cpf_er" value="{{ $elist->er_cpf  }}" /> 
                                                  <a href="#modify-info" class="btn btn-primary btn-xs has-popover modify-btn" data-toggle="modal" data-inval="cpf_er" data-field="CPF Employer">Modify</a>
                                             </div>
                                       </div>
                                       <div class='form-group'>
                                              <label class='col-sm-4' for='validation_name'>SDL:</label>
                                              <div class='col-sm-6'>
                                                    <label class='col-sm-8' style="font-weight:100;" id="l_sdl">{{ $elist->sdl }}</label>
                                                    <input type="hidden" name="sdl" id="sdl" value="{{ $elist->sdl  }}" /> 
                                                    <a href="#modify-info" class="btn btn-primary btn-xs has-popover modify-btn" data-toggle="modal" data-inval="sdl" data-field="SDL">Modify</a>
                                              </div>
                                       </div>
                                       <div class='form-group' style="margin-top:44%">
                                              <label class='col-sm-4' for='validation_name'>Net Pay:</label>
                                              <div class='col-sm-5'>
                                                    <label class='col-sm-6' style="font-weight:100;" id="l_net_pay">${{ number_format($elist->net_pay,2) }}</label>
                                              </div>
                                       </div>
                                       </div><!--col-md-6-->
                                       <!--col-md-6-->
                                         
                                      </div><!--row-->
                                      <div class="col-md-offset-5">
                                       <input type="submit"  class="btn btn-success" name="save-btn" id="saveb" value="Save"/>
                                       <input type="button"  class="btn btn-primary" name="reset" id="reset" value="Reset" />       
                                      </div>
                                    </form>
                                    </table>
                                       <!--  </ul> -->
                                </div>
                            </div>
                        </div>
            </div>
       </div>
</div>
 <div class='modal fade' id='add-allow' tabindex='-1'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                            <h4 class='modal-title' id='myModalLabel'>Add / Edit Allowances</h4>
                          </div>
                          <div class='modal-body'>
                              <input type="hidden" name="found-neg" id="found-neg" value="0" />
                            <form name="allowfrm" id="allowfrm">
                                <input type="hidden" name="sal_id" id="sal_id" value="{{ $salId }}" />
                                <div id="prev-allowance"></div>       
                                <div id="exist-allowance"></div>
                            </form>    
                              <div class='form-group' style="margin-top:10px;">
                                <label for='inputTextArea1'>Allowance Type</label>
                                <div id="allist"></div>    
                                <label class="error" for="allow_type"></label>
                              </div>
                              <div class='form-group'>
                                <label for='inputTextArea1'>Allowance Amount</label>
                                <input type="text" name="allow_amt" data-rule-required='true' id="allow_amt" class="form-control" placeholder='' />
                                <input type="hidden" name="sal_id" id="sal_id" value="{{ $salId }}" />
                                <label class="error" for="mod_val"></label>
                              </div>
                             
                          </div>
                          <div class='modal-footer'>
                            <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                            <button class='btn btn-primary' type='button' id="save-allow-btn">Save</button>
                          </div>
                        </div>
                      </div>
</div>
 <div class='modal fade' id='modify-info' tabindex='-1'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                            <h4 class='modal-title' id='myModalLabel'>Modify Employee Salary Detail</h4>
                          </div>
                          <div class='modal-body'>
                            <div class='form-group'>
                              <label for='inputTextArea1' id="field_name"></label>
                              <input type="hidden" name="txt_id" id="txt_id" value=""/>
                              <input type="text" name="mod_val" data-rule-required='true' id="mod_val" class="form-control" placeholder='' />
                            </div>
                          </div>
                          <div class='modal-footer'>
                            <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                            <button class='btn btn-primary' type='button' id="save-btn">Save changes</button>
                          </div>
                        </div>
                      </div>
</div>                                 
@include('includes.jscript')
<script>
    $(document).ready(function(){
        var allowanceType  = <?php echo json_encode($allowanceArray); ?>;
        $('#found-neg').val('0');
        $('#c_type').val('');
        $('#c_amt').val('');
        $('#etc_type').val('');
        $('#etc_amt').val('');
        $('#ct_amt').val(0);
        $('#c_allowance').val(<?php echo $elist->allowances_cost != 0 ? $elist->allowances_cost : 0.00 ?>); 
        $('#basic').val(<?php echo $elist->basic; ?>);
        $('#npl').val('<?php echo $elist->npl_amt; ?>');
        $('#comm').val('<?php echo $elist->commission; ?>');
        $('#cpf_ee').val('<?php echo $elist->ee_cpf; ?>');
        $('#loan_deducation').val('<?php echo $elist->mloan_amt; ?>');
        $('#cpf_er').val('<?php echo $elist->er_cpf; ?>');
        $('#sdl').val('<?php echo $elist->sdl; ?>');
        $('#cpf_wage').val('<?php echo $elist->cpf_wages; ?>');
        $('#reset').click(function(){
            $('#c_allowance').val(<?php echo $elist->allowances_cost != 0 ? $elist->allowances_cost : 0.00 ?>); 
            $('#basic').val(<?php echo $elist->basic; ?>);
            $('#npl').val('<?php echo $elist->npl_amt; ?>');
            $('#comm').val('<?php echo $elist->commission; ?>');
            $('#cpf_ee').val('<?php echo $elist->ee_cpf; ?>');
            $('#loan_deducation').val('<?php echo $elist->mloan_amt; ?>');
            $('#cpf_er').val('<?php echo $elist->er_cpf; ?>');
            $('#sdl').val('<?php echo $elist->sdl; ?>');
            $('#cpf_wage').val('<?php echo $elist->cpf_wages; ?>');
           var basic    =  parseFloat($('#basic').val());
           var npl      =  parseFloat($('#npl').val());
           var basicPay =  basic - npl;
           var lcomm     = parseFloat($('#comm').val());
           var allow    =  parseFloat($('#c_allowance').val());
           var gross    =  parseFloat(basicPay + lcomm + allow);
           var cpf_ee   =  parseFloat($('#cpf_ee').val());
           var loan     =  parseFloat($('#loan_deducation').val());
           var deducation  =  parseFloat(cpf_ee - loan);
           var net_pay  = parseFloat(gross - deducation);
           $('#l_basic').html(basic);
           $('#l_npl').html(npl);
           $('#l_comm').html(lcomm);
           $('#cl_allowance').html(allow);
           $('#l_dedu').html('$'+deducation);
           $('#1_basic_paid').html('$'+basicPay);
           $('#l_gross').html('$'+gross);
           $('#l_cpf_ee').html('<?php echo $elist->ee_cpf; ?>');
           $('#l_cpf_wage').html('<?php echo $elist->cpf_wages; ?>');
           $('#l_cpf_er').html('<?php echo $elist->er_cpf; ?>');
           $('#l_sdl').html('<?php echo $elist->sdl; ?>'); 
           $('#l_net_pay').html('$'+net_pay);
           $('#c_type').val('');
           $('#c_amt').val('');
           $('#etc_type').val('');
           $('#etc_amt').val('');
           $('#ct_amt').val(0);
        });
        $('.modify-btn').click(function(){
           var txtId = $(this).data('inval');
           var field = $(this).data('field');
           $('#field_name').html(field);
           $('#txt_id').val(txtId);
           $('#mod_val').val($('#'+txtId).val());
         });
         $('#save-btn').click(function(){
             var mval   = parseFloat($.trim($('#mod_val').val()));
             var ufield = $('#txt_id').val();
             if($.isNumeric(mval) && mval >= 0){
                 $('#'+ufield).val(parseFloat(mval).toFixed(2));
                 $('#l_'+ufield).html(parseFloat(mval).toFixed(2));
                 $('#modify-info').modal('hide');
             } else {
                 $('#modify-info').modal('show'); 
                 alert('Please enter absolute  or postive value');
             }

           var basic    =  parseFloat($('#basic').val());
           var npl      =  parseFloat($('#npl').val());
           var basicPay =  basic - npl;
           var lcomm     = parseFloat($('#comm').val());
           var allow    =  parseFloat($('#c_allowance').val());
           var gross    =  parseFloat(basicPay + lcomm + allow);
           var cpf_ee   =  parseFloat($('#cpf_ee').val());
           var loan     =  parseFloat($('#loan_deducation').val());
           var deducation  =  parseFloat(cpf_ee - loan);
           var net_pay  = parseFloat(gross - deducation);
           $('#l_dedu').html('$'+deducation.toFixed(2));
           $('#1_basic_paid').html('$'+basicPay.toFixed(2));
           $('#l_gross').html('$'+gross.toFixed(2));
           $('#l_net_pay').html('$'+net_pay.toFixed(2));
        });

        
        
        $('.e-allowance').live('blur',function() {
            var totalAllowance = 0;
            var fdata = $('#allowfrm').serializeArray();
            var filterArray  = ["sal_id","allow_total"];
            $.each(fdata,function(i,val){
                if($.inArray(val.name,filterArray) == -1){
                    totalAllowance+=parseFloat(val.value);
                }
            });
            $('#allow_total').val(totalAllowance.toFixed(2));
        });
        
        $('#recal').click(function(){
            var frmData = $('#rclfrm').serialize();
            //console.log(frmData);
            $.ajax({
                type : 'POST',
                url  : actionPath+'payroll/ajax-call',
                data : 'action=recalculate-salary&'+frmData,
                success:function(response){
                    var obj = $.parseJSON(response);
                    $('#cpf_ee').val(obj.cpf_ee);
                    $('#l_cpf_ee').html(obj.cpf_ee.toFixed(2));
                    $('#cpf_er').val(obj.cpf_er);
                    $('#l_cpf_er').html(obj.cpf_er.toFixed(2));
                    $('#cpf_wage').val(obj.cpf_wage);
                    $('#l_cpf_wage').html(obj.cpf_wage.toFixed(2));
                    $('#sdl').val(obj.sdl);
                    $('#l_sdl').html(obj.sdl.toFixed(2));
                    $('#l_dedu').html('$'+obj.t_deducation.toFixed(2));
                    $('#l_net_pay').html('$'+obj.net_pay.toFixed(2));
                    $('#l_gross').html('$'+obj.gross.toFixed(2));
                }
            });
        });
        
        $('#save-allow-btn').click(function(){ 
          // if($("#allowfrm").valid()){
               var gtype='';
               var gamt='';
               var gA = [];
               var aType = $('#allow_type').val();
               var aCost = $.trim($('#allow_amt').val());
               var salId = $('#sal_id').val();
               var foundNeg = $('#found-neg').val();
               /* start form post */
               if($('#allow_total').length > 0){
                 var fdata = $('#allowfrm').serializeArray();
                 var filterArray  = ["sal_id","allow_total"];
                 var  aid
                 var fType ='';
                 var famt = '';
                 var pType ='';
                 var pamt = '';
                 var nval = 0;
                 var cTypeArray = ($('#c_type').val().slice(0,-1)).split(',');
                 $.each(fdata,function(i,val){
                    if($.inArray(val.name,filterArray) == -1){
                        aid = val.name.slice(-1);
                        if(val.value!= '' && $.isNumeric(val.value) && val.value >= 0) {
                            if(($('#prev-allow').length === 1) && ($('#pallow_'+aid).length === 1)){
                              pType +=   aid + ',';
                              pamt  +=   val.value  +',';   
                            }
                            if(($('#saved-allow').length === 1) && ($('#allow_'+aid).length === 1)) {
                             fType +=   aid + ',';
                             famt  +=   val.value  +',';
                            }
                        } else {
                          nval = 1;    
                        }

                    } 
                 });
                 if($('#saved-allow').length > 0) {
                  $('#etc_type').val(fType);
                  $('#etc_amt').val(famt);
                 }
                 if($('#prev-allow').length > 0){
                  var aType = $('#allow_type').val();
                  var aCost = $.trim($('#allow_amt').val());
                  if(aType != '' && aCost != '' && aCost > 0){
                      pType += aType + ',';
                      pamt  += aCost + ',';
                  }
                  $('#c_type').val(pType);
                  $('#c_amt').val(pamt);
                 }
               }
               /* end form post */
               
               
               if(aType != '' && $.isNumeric(aCost) && aCost > 0){
                 if($('#prev-allow').length == 0){  
                    gtype += $('#c_type').val() + aType+',';
                    gamt  += $('#c_amt').val() + aCost+',';
                    $('#c_type').val(gtype);
                    $('#c_amt').val(gamt);
                 }
                 var all_cost;
                 //if(nval == 0){
                  //$('#ct_amt').val(parseFloat($('#ct_amt').val())+parseFloat(aCost));
                 //}
                    if(parseFloat($('#allow_total').val()) == parseFloat($('#c_allowance').val())){
                        all_cost = parseFloat($('#c_allowance').val()) + parseFloat(aCost);
                    } else {
                       if($('#allow_total').length != 0 && $('#allow_total').val() > 0 && nval == 0){
                        all_cost = parseFloat($('#allow_total').val()) + parseFloat(aCost);
                       } else {
                          var all_total = $('#c_allowance').val();  
                          var icmtArray = ($('#c_amt').val().slice(0,-1)).split(',');
                          $.each(icmtArray,function(i,val){
                              if(val > 0){
                               all_total = parseFloat(all_total) + parseFloat(val);
                              }
                          });
                        all_cost = parseFloat(all_total); //parseFloat($('#ct_amt').val());    
                       }
                   }
               if(all_cost > 0){
                 $('#c_allowance').val(all_cost);
                 $('#cl_allowance').html(all_cost.toFixed(2));
                }
               } else {
                  if($('#allow_total').length != 0 && $('#allow_total').val() > 0){
                   $('#c_allowance').val(parseFloat($('#allow_total').val()));
                   $('#cl_allowance').html(parseFloat($('#allow_total').val()).toFixed(2));
                  }
               }
               if(aType!='' && aCost ==''){
                   alert('Please Allowance amount for select allowance type');
               } else if(aType =='' && aCost !=''){
                   alert('Please select allowance type');
               }  else if(aCost < 0 || nval == 1){
                   $('#found-neg').val(1);
                   $('#c_type').val('');
                   $('#c_amt').val('');
                   $('#c_allowance').val(<?php echo $elist->allowances_cost != 0 ? $elist->allowances_cost : 0.00 ?>);
                   alert('Please enter absolute or positive value (negative value not accepted)');
               } else {
                   $('#found-neg').val(0);
                   $('#add-allow').modal('hide');
               }

               
               //$('#add-allow').modal('hide');
               
              
       
               
                /*var fdata = $('#allowfrm').serialize();
                $.ajax({
                  type : 'POST',
                  url  : actionPath+'payroll/ajax-call',
                  data : 'action=update_allowance&'+fdata,
                  success:function(response){
                      console.log(response);
                  }
                });*/
               /*$.ajax({
                  type : 'POST',
                  url  : actionPath+'payroll/ajax-call',
                  data : 'action=add_allowance&aType='+aType+'&aCost='+aCost+'&sal='+salId,
                  success:function(response){
                      if(response == 1){
                         var all_cost = parseInt($('#c_allowance').val()) + parseInt(aCost);
                        console.log(all_cost);
                          $('#c_allowance').val(all_cost);
                          $('#cl_allowance').html(all_cost);
                      }
                  }
               });*/
           //}
        });
        $('#add-btn').click(function(){
            $('#allow_type').val('');
            $('#allow_amt').val('');
            var ajaxFilterArray = [];
            var etc_type = $('#etc_type').val().slice(0,-1).split(',');
            var etc_amt  = $('#etc_amt').val().slice(0,-1).split(',');
            var c_type = [];
            var c_amt  = [];
            if($('#c_type').val() != '' && $('#c_amt').val() != ''){
                c_type   = $('#c_type').val().slice(0,-1).split(',');
                c_amt    = $('#c_amt').val().slice(0,-1).split(',');
            }
            var salId = $('#sal_id').val();
            var ehtml = '';
            var ephtml = '';
            var tcost = 0;
            var tpcost = 0;
            var afval = 0;
            var pval  = 0;
            $.ajax({
                   type : 'POST',
                   url  :  actionPath+'payroll/ajax-call',
                   data : 'action=get_allowance&sal='+salId,
                   success:function(response){
                       if(response != 0){
                           var obj = $.parseJSON(response);
                            ehtml += '<table width="100%" id="saved-allow">';
                            if(etc_amt!='') {
                                $.each(obj,function(i,val){
                                ehtml +='<tr><td width="40%"><label>'+$.ucfirst(val.allow_name)+'</label></td>';
                                afval = parseFloat(etc_amt[i]);
                                ehtml +='<td width="60%"><input type="text" name="allow_'+val.allow_id+'" data-id="'+val.allow_id+'" id="allow_'+val.allow_id+'" class="form-control e-allowance" value="'+afval.toFixed(2)+'" /></td></tr>';
                                tcost = parseFloat(tcost) + parseFloat(etc_amt[i]) ;
                              });
                            } else {
                                $.each(obj,function(i,val){
                                ehtml +='<tr><td width="40%"><label>'+$.ucfirst(val.allow_name)+'</label></td>';
                                ehtml +='<td width="60%"><input type="text" name="allow_'+val.allow_id+'" data-id="'+val.allow_id+'" id="allow_'+val.allow_id+'" class="form-control e-allowance" value="'+val.allow_cost+'" /></td></tr>';
                                tcost = parseFloat(tcost) + parseFloat(val.allow_cost) ;
                               });
                            }
                            if(tpcost != 0){
                               tcost =  parseFloat(tcost) + parseFloat(tpcost);
                            }
                            ehtml +='<tr><td width="40%"><label>Total</label></td><td width="60%"><input type="text" name="allow_total" id="allow_total" class="form-control" readonly="readonly" value='+tcost.toFixed(2)+' /></td></tr>';
                            ehtml += '</table>';
                            $('#exist-allowance').html(ehtml);
                       }
                   }
            });
            
            if(c_type.length != 0 && c_amt.length != 0 && allowanceType.length != 0) {
                 ephtml += '<table width="100%" id="prev-allow">';
                 $.each(c_type,function(i,val){
                     pval = parseFloat(c_amt[i]);
                     ephtml +='<tr><td width="40%"><label>'+$.ucfirst(allowanceType[val])+'</label></td>';
                     ephtml +='<td width="60%"><input type="text" name="pallow_'+val+'" data-id="'+val+'" id="pallow_'+val+'" class="form-control e-allowance" value="'+pval.toFixed(2)+'" /></td></tr>';
                     tpcost = parseFloat(tpcost) + parseFloat(c_amt[i])       ;
                 });
                 if($('#saved-allow').length === 0) {
                  ephtml +='<tr><td width="40%"><label>Total</label></td><td width="60%"><input type="text" name="allow_total" id="allow_total" class="form-control" readonly="readonly" value='+tpcost.toFixed(2)+' /></td></tr>';
                 }
                 ephtml += '</table>';
                 $('#prev-allowance').html(ephtml);
            }
            var selType = $('#c_type').val().split(',');
            var vhtml = '';
            vhtml += '<select name="allow_type" id="allow_type" class="form-control" data-rule-required="true">'
            vhtml += '<option value="">Choose Allowance Type</option>';
            <?php if(!empty($allowance)) {
                    foreach($allowance as $al) { ?>
                       if($.inArray("<?php echo $al->id;?>",selType ) == -1) {
                        vhtml += '<option value="<?php echo $al->id;?>"><?php echo ucwords($al->allowance); ?></option>';
                       }
            <?php   }
                  } else { ?>
                            vhtml += '<option value="">All Allowance in list allocated</option>';
            <?php } ?>
            vhtml += '</select>';
            $('#allist').html(vhtml);
        });
    });
  
</script>
@stop