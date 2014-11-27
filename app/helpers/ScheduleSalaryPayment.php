<?php
class ScheduleSalaryPayment {
    
    public static function printPaymentSchedule($basic_info,$placementFee) {
        $salPerMonth        = 580;
        $fixedSalPerMonth   = 580;
        $pay_per_month      = 540;
        $bal_amt            = 0;
        $tmpStatus          = 0;
        $pay_count          = 0;
        $payMode            = Config::get('local.payMode');
        $basePublic         = Config::get('local.basePublic');
        if(!empty($placementFee) && $placementFee->placement_amt != '') {
            if($placementFee->placement_amt > $pay_per_month)  {
                $pay_tenure       = $placementFee->placement_amt / $pay_per_month;
                $pay_count        = floor($pay_tenure);
                $tmp_total        = $pay_per_month * $pay_count;
                if($placementFee->placement_amt > $tmp_total){
                    $bal_amt      = (double)$placementFee->placement_amt - (double)$tmp_total;
                }
           } else {
                $pay_count     = 1;
                $pay_per_month = $placementFee->placement_amt;
           }
        }
        $placement_amt = $placementFee->placement_amt != '' ? number_format($placementFee->placement_amt,2) : 'NIL';
        $html = '<html><head><link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
                    </head>
                    <body>
                     <div id="container">
                     <div id="header">
                             <table width="100%">
                                <tr>
                                 <td width="40%">
                                    <div class="col-sp6">
                                         <img width="170px" class="logo" src="'.$basePublic.'/assets/images/logo.png">
                                         <span style="line-height:108px;font-size:9px;">Licence No: 13C6728</span>
                                    </div>
                                 </td>
                                 <td style="font-size:9px">
                                        <div class="col-sp6">
                                            <div class="address">
                                                    <span>Ang Mo Kio Central Branch</span>
                                                <p>710 Ang Mo Kio Avenue 8 #01-2611 Singapore 560710</p>
                                                <p>O: 6553 7703 | F: 6456 3007 | E: amk@islandmaids.com.sg</p>
                                            </div>
                                            <div class="address">
                                                    <span>Bedok Central Branch</span>                 
                                                            <p>214 Bedok North Street 1 #01-183 Singapore 460214</p>
                                                <p>O: 6448 7703 | F: 6448 9131 | E: bedok@islandmaids.com.sg</p>
                                        </div>
                                        </div>
                                      </td>
                                 </tr>
                           </table>
                            </div>
                          <div class="row rowbg">
                            <span class="span-high_dk">ISLAND MAIDS PTE LTD - </span><span class="span-high">Your Choice For Excellent Service!</span>
                            <div class="blackstrip"></div>
                          </div>
                         <p style="text-align:center; font-weight:600px;">Schedules of Salary Payment and Loan (including loan for placement fee) Repayment.</p>
                        <div class="content-wrapper" style="height:auto;">
                           <table width="100%">
                            <tr>
                                <td>
                                     <p style="margin-left:25px;"><strong>Date : </strong>'.date('d/m/Y',strtotime('now')).'</p>
                                     <p style="margin-left:25px;"><strong>Name of Employee :</strong>'.ucwords($basic_info->customer_name).'</p>
                                     <p style="margin-left:25px;"><strong>Name of FDW : </strong>'.ucwords($basic_info->maid_name).'</p>
                                     <p style="margin-left:25px;"><strong>Monthly Salary of FDW : </strong>$500.00 + $80.00 = $580(with no days off)</p>
                                     <p style="margin-left:25px;"><strong>Plus $20.00  </strong>compensation for each off day x 4 = $80.00</p>
                                     <p style="margin-left:25px;"><strong>Total amount of loan(including loan for placement fee) : </strong>'.$placement_amt.'</p>
                                </td>
                               <td>
                                   <div class="col-sp6-rx">
                                   </div>
                               </td>
                            </tr>
                           </table>
                           <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                     <table width="100%" class="grid-table" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <th colspan="5">Schedule of Salary Payment</th>
                                        </tr>
                                         <tr>
                                            <td width="2%">Sno.</td>
                                            <td width="14%">Monthly Year</td>
                                            <td colspan="2">Date of Salary Payment</td>
                                            <td>FDW Acknowlegement(signature)</td>
                                        </tr>';
        
                                            $total_pay = 0;
                                            if(!empty($basic_info)) {
                                               for($i = 1; $i <= $basic_info->contract_terms; $i++) { 
                                                   $salary_date = date('d-m-Y',strtotime($basic_info->contract_from.'+'.$i.'months'));
                                                   if($i <= $pay_count)
                                                      $salPerMonth = (double)$fixedSalPerMonth - (double)$pay_per_month;
                                                   else if($bal_amt != 0 && $tmpStatus == 0) {
                                                      $tmpStatus     = 1; 
                                                      $salPerMonth = (double)$fixedSalPerMonth - (double)$bal_amt;
                                                   } else
                                                      $salPerMonth = $fixedSalPerMonth;
                                                   $html .='<tr>
                                                               <td>'.$i.'</td>
                                                               <td>'.date('Y',strtotime($salary_date)).'</td>
                                                               <td>'.date('d-m-Y',strtotime($salary_date)).'</td>
                                                               <td style="text-align:right;">$'.number_format($salPerMonth,2).'</td>
                                                               <td>X</td>
                                                           </tr>';
                                                   $total_pay = (double)$total_pay + (double)$salPerMonth;
                                               }
                                                    $html .='<tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>Total Salary</td>
                                                                <td style="text-align:right;">$'.number_format($total_pay,2).'</td>
                                                                <td>Total Loan Amount</td>
                                                              </tr>';
                                                    
                                            }       
                      
        
                      $html .='</table>
                               </td>
                                 <td style="vertical-align:top;">
                                 <table width="100%" class="grid-table" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <th colspan="5">Schedule of Loan(including loan for placement fee)Repayment</th>
                                        </tr>
                                         <tr>
                                            <td width="2%">Sno.</td>
                                            <td width="14%">Monthly Loan Repayment</td>
                                            <td>Date Repayment</td>
                                            <td>Employers Acknowlegement(signature)</td>
                                            <td>FDW Acknowlegement(signature)</td>
                                        </tr>';
                          if(!empty($placementFee) && $placementFee->placement_amt != '') {
                                for($j = 1; $j <= $pay_count; $j++) { 
                                    $pay_date = date('d-m-Y',strtotime($basic_info->contract_from.'+'.$j.'month'));
                                    $html .='<tr>
                                                <td>'.$j.'</td>
                                                <td style="text-align:right;">$'.number_format($pay_per_month,2).'</td>
                                                <td>'.$pay_date.'</td>
                                                <td>X</td>
                                                <td>X</td>
                                            </tr>';
                                  
                                }
                                if($bal_amt != 0) {
                                    $pay_count = $pay_count +1;
                                    $pay_date  = date('d-m-Y',strtotime($basic_info->contract_from.'+'.$j.'month'));
                                    $html .='<tr>
                                                <td>'.$j.'</td>
                                                <td style="text-align:right;">$'.number_format($bal_amt,2).'</td>
                                                <td>'.$pay_date.'</td>
                                                <td>X</td>
                                                <td>X</td>
                                            </tr>';
                                }
                           }
                           $cal_row_length = $basic_info->contract_terms - $pay_count;
                            for($j = 0;$j < $cal_row_length; $j++) {
                                $html .='<tr>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>X</td>
                                                    <td>X</td>
                                         </tr>';
                            }
                        $html .='<tr>
                                                <td>-</td>
                                                <td style="text-align:right;">$'.number_format($placementFee->placement_amt,2).'</td>
                                                <td>-</td>
                                                <td>X</td>
                                                <td>X</td>
                                     </tr>
                                </table>';
                       $html .='</td>
                            </tr>
                           </table>';
                        $html .='<table width="100%">';
                        $html .='<tr><td>
                                    <p>Delete rows where necessary</p>
                                    <p>Id be filled in at the point of acknowledging this schedule,</p>
                                    <p>the sum total of the monthly loan repayments</p>
                                    <p>I and agree with the monthly salary and total amount loan indicated above</p>
                                 </td></tr>';
                        $html .='</table>';
                        
                        $html .='<table width="100%" style="margin-top:15px;"><tr>';
                        $html .='<td>
                                    <p>Name/Signature of FDW</p>
                                    <p>'.ucwords($basic_info->maid_name).'</p>
                                 </td>
                                 <td>
                                    <p>Name/Signature of Employee</p>
                                    <p>'.ucwords($basic_info->emp_name).'</p>
                                 </td></tr>';
                        $html .='<tr><td colspan="2">
                                    <p style="margin-top:10px;">Witnessed by EA Representative:</p>
                                 </td></tr>';
                        $html .='<tr><td colspan="2" style="margin-top:30px;">
                                    <p style="margin-top:10px;">Name/Signature:</p>
                                    <p style="margin-top:10px; margin-left:160px;">EE BING DE GABRIEL</p>
                                 </td></tr>';
                        $html .='</table>';
                            
                            
                      $html .='</div>
                        <div id="footer" style="margin-top:10px;">
                         <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                        <div class="blackrow"></div>
                      </div>
                   </div>
                  </body>
                 </html>';
        return $html;
    }
}
?>