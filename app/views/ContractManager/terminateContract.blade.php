@extends('layouts.master')
 <?php
 $baseUrl    = Config::get('local.baseUrl');
 $fee        = array();
 $total_fee  = 0.00;
 $fee[19]    = 0.00;
 $fee[20]    = 0.00;
 $fee[21]    = 0.00;
 if(isset($view) && !empty($view)) {
  foreach ($view as $result) {
    if($result->fkincomecoa_id==19) {
      $fee[19] += $result->amount;
    } else if($result->fkincomecoa_id==20) {
      $fee[20] += $result->amount;
    } else if($result->fkincomecoa_id==21) {
      $fee[21] += $result->amount;
    }
  }
 }
 $terminate = '';
 if($value==2) {
  $terminate = 'Full Termination';
 } else if($value==3) {
  $terminate = 'Partial Termination';
 } else if($value==4) {
  $terminate = 'Replacement';
 }
 ?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Contract {{ $terminate }}</span>
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
                          Contract
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Contract {{ $terminate }}</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class='col-sm-12'>
                       <div class="row">
                        <div class="col-sm-12">
                        <div class="pull-right">
                        <a class="btn btn-warning btn-xs has-tooltip" data-placement="top" data-original-title="Back" href="{{ URL::to('edit-contract/step1/'.$id) }}">Back</a>
                        </div>
                        </div>
                        </div>  
                      <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Contract {{ $terminate }}</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal' action="{{ URL::to('contract/terminate/'.$id.'/'.$value) }}" name="frmcontract" id="frmcontract" method="post" style='margin-bottom: 0;'>
                            
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='admin_fee'>Admin Fee</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' onkeyup="calculateTotal();" onchange="return numberWithCommas(this.value,this.id);" data-rule-number='true' id='admin_fee' name='admin_fee' type='text' value="{{ number_format($fee[19],2,'.',','); }}">
                               <input class="form-control" id='hidden_admin_fee' name='hidden_admin_fee' type='hidden' value="{{ number_format($fee[19],2,'.',''); }}">
                             </div>
                          </div>

                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='insurance_fee'>Insurance Fee</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' onkeyup="calculateTotal();" onchange="return numberWithCommas(this.value,this.id);" data-rule-number='true' id='insurance_fee' name='insurance_fee' type='text' value="{{ number_format($fee[20],2,'.',','); }}">
                               <input class="form-control" id='hidden_insurance_fee' name='hidden_insurance_fee' type='hidden' value="{{ number_format($fee[20],2,'.',''); }}">
                             </div>
                          </div>


                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='agency_fee'>Agency Fee</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' onkeyup="calculateTotal();" onchange="return numberWithCommas(this.value,this.id);" data-rule-number='true' id='agency_fee' name='agency_fee' type='text' value="{{ number_format($fee[21],2,'.',','); }}">
                               <input class="form-control" id='hidden_agency_fee' name='hidden_agency_fee' type='hidden' value="{{ number_format($fee[21],2,'.',''); }}">
                             </div>
                          </div>


                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='loan_balance'>Maid Loan Balance</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" value="0.00" data-rule-number='true' onkeyup="calculateTotal();" onchange="return numberWithCommas(this.value,this.id);" id='loan_balance' name='loan_balance' type='text' >
                             </div>
                          </div>

                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='tots'>Total</label>
                             <div class='col-sm-6 controls'>
                             <?php 
                               $total_fee += ($fee[19]+$fee[20]+$fee[21]);
                             ?>
                               <span><strong id="total">{{ number_format($total_fee,2) }}</strong></span>
                             </div>
                          </div>

                          <!--<div class='form-group'>
                             <label class='control-label col-sm-3' for='fee_charged'>Additional Fee Charged to Maid</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" value="0.00" onchange="return numberWithCommas(this.value,this.id);" data-rule-number='true' id='fee_charged' name='fee_charged' type='text' >
                             </div>
                          </div>-->
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar" id="edit-mode">
                                          <button class="btn-primary btn" type="submit" id="approve">Submit</button>
                                          <button class="btn confirm-reject" data-id="" type="button" >Cancel</button>
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
<script>
    $(document).ready(function(){

  $('#approve').on('click',function (){

    $("#frmcontract").validate({
         rules: {
          
        },
        submitHandler: function (form) {
          var admin            = $("#admin_fee").val();
          var hide_admin       = $("#hidden_admin_fee").val();
          var insurance        = $("#insurance_fee").val();
          var hide_insurance   = $("#hidden_insurance_fee").val();
          var agency           = $("#agency_fee").val();
          var hide_agency      = $("#hidden_agency_fee").val();
          if(numberWithOutCommasInput(admin)>Number(hide_admin)) {
            alert('Admin Fee must be less than or equal to '+hide_admin);
            return false;
          } else if(numberWithOutCommasInput(insurance)>Number(hide_insurance)) {
            alert('Insurance Fee must be less than or equal to '+hide_insurance);
            return false;
          } else if(numberWithOutCommasInput(agency)>Number(hide_agency)) {
            alert('Agency Fee must be less than or equal to '+hide_agency);
            return false;
          } else {
            form.submit();
            return true;
          }
        }
      });
  });

     /*   var url = "<?php echo URL::to('edit-contract/step1/'.$id); ?>";
        $('.confirm-reject').click(function(){
        if(confirm('Are you sure want to reject this termination?')) {
            window.location.href = url;
        }
        });
        */
    }); 

   /* $(document).on('click', '#approve', function() {
        $("#frmcontract").validate({
            submitHandler: function (form) {
              return false;
            }
        });
    });*/

    <?php 
        //if(session::has('cheque') && session::get('cheque')==1) {
         // session::forget('cheque');
      ?>
        /*var answer = confirm ("Approved Successfully. Can You Issue Cheque Now?")
        if (answer)
          window.location.href = "<?php //echo URL::to('contract/cheque-issue/'.$id); ?>";
        else
          window.location.href = "<?php //echo URL::to('contract-list/'); ?>";
*/
      <?php
       // }
      ?>

    function calculateTotal() {
      var admin_fee     = $("#admin_fee").val();
      var insurance_fee = $("#insurance_fee").val();
      var agency_fee    = $("#agency_fee").val();
      /*var h_admin_fee   = $("#hidden_admin_fee").val();
      var h_insurance_fee = $("#hidden_insurance_fee").val();
      var h_agency_fee    = $("#hidden_agency_fee").val();*/
      var loan_balance  = $("#loan_balance").val();

      var total_fee     = parseFloat(numberWithOutCommasInput(admin_fee))+parseFloat(numberWithOutCommasInput(insurance_fee))+parseFloat(numberWithOutCommasInput(agency_fee))+parseFloat(numberWithOutCommasInput(loan_balance));      
      $("#total").text(numberWithCommasInput(parseFloat(total_fee).toFixed(2)));
    }
</script>
@stop