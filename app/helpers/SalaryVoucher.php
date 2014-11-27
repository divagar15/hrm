<?php
class SalaryVoucher {
    public static function printSalaryPaymentVoucher($getSalaryInfo) {
     $basePublic = Config::get('local.basePublic');
     $gross_pay  = $getSalaryInfo->basic_salary + $getSalaryInfo->overtime_amt + $getSalaryInfo->commission + $getSalaryInfo->bonus + $getSalaryInfo->allowances;
     $total_deducation = $getSalaryInfo->cpf + $getSalaryInfo->mbf + $getSalaryInfo->advance_loan + $getSalaryInfo->income_tax + $getSalaryInfo->lop_amt;
     $html = '';
     $html .= '<html><head>';
     $html .= '<style type="text/css">
                .container{width:100%;float:left; font-family:Arial, Helvetica, sans-serif;}
                .col-span2{width:29%;float:left;}
                .underline_view{border-bottom:1px solid #000; width:100%;}
                .tabStyleRight{ font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left:20px;}
                .tabStyleRight td{ padding:2px;}
                .tabStyle{ font-family:Arial, Helvetica, sans-serif; font-size:12px;}
                .tabStyle td{padding:2px;}
                .vertical-text {
                    text-align:center;
                    white-space:nowrap;
                    g-origin:50% 50%;
                    -webkit-transform: rotate(90deg);
                    -moz-transform: rotate(90deg);
                    -ms-transform: rotate(90deg);
                    -o-transform: rotate(90deg);
                    transform: rotate(90deg);
                }
                .vertical-text p { ;
                    display:inline-block;
                }
                .row{width:100%;}
                .view-div{margin-top:20px;}
                .greybg{ background-color:#CCC; font-weight:700;}
            </style>';
                
  $html .= '</head>';
  $html .= '<body>
        <div class="container">
        <table width="100%">
                                <tr>
                                 <td width="40%">
                                    <div class="col-sp6">
                                         <img width="170px" class="logo" src="'.$basePublic.'/assets/images/logo.png">
                                    </div> 
                                 </td>
                                 </tr>
         </table>
         <div class="row"><h3>SALARY VOUCHER</h3></div>
           <table width="100%" border="0">
           <tr><td width="50%">
         <div class="col-span2">
          <div class="top-div">
            <table width="100%">
              <tr><td style="width:70px;">PAY TO</td><td width="2%">:</td><td width="250px"><div class="underline_view">'.ucwords($getSalaryInfo->emp_name).'</div></td></tr>
            </table>
             <table width="100%" style="margin-left:20px;">
                  <tr><td style="width:20px;">FROM</td><td width="2%">:</td><td width="240px"><div class="underline_view">'.date('d-m-Y',strtotime($getSalaryInfo->salary_from_date)).'</div></td></tr>
                </table>
          </div>
          <div class="view-div">
                <table border="1" class="tabStyle" cellpadding="0" cellspacing="0">
                    <tr>
                        <td rowspan="7" width="80px"  class=""><p>EARNINGS</p></td>
                        <td width="65px">BASIC PAY</td>
                        <td width="120px" align="right">$'.number_format($getSalaryInfo->basic_salary,2).'</td>
                    </tr>
                     <tr>
                        <td>OVERTIME</td>
                        <td align="right">$'.number_format($getSalaryInfo->overtime_amt,2).'</td>
                    </tr>

                    <tr>
                        <td>COMMISSION</td>
                        <td align="right">$'.number_format($getSalaryInfo->commission,2).'</td>
                    </tr>
                    <tr>
                        <td>BONUS</td>
                        <td align="right">$'.number_format($getSalaryInfo->bonus,2).'</td>
                    </tr>
                    <tr>
                        <td>ALLOWANCES</td>
                        <td align="right">$'.number_format($getSalaryInfo->allowances,2).'</td>
                    </tr>
                    <tr>
                        <td height="20px">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                     <tr class="greybg">
                        <td style="width:120px;">(A) GROSS PAY</td>
                        <td align="right">$'.number_format($gross_pay,2).'</td>
                    </tr>
                </table>
                <table width="100%" border="1" class="tabStyle" cellpadding="0" cellspacing="0">
                    <tr>
                        <td rowspan="7" width="4%" class=""><p>DEDUCTIONS</p></td>
                        <td style="width:120px;">CPF - EMPLOYEE</td>
                        <td width="120px" align="right">$'.number_format($getSalaryInfo->cpf,2).'</td>
                    </tr>
                    <tr>
                        <td>LOP</td>
                        <td align="right">$'.number_format($getSalaryInfo->lop_amt,2).'</td>
                    </tr>
                    <tr>
                        <td>MBF</td>
                        <td align="right">$'.number_format($getSalaryInfo->mbf,2).'</td>
                    </tr>
                    <tr>
                        <td>ADVANCE / LOAN</td>
                        <td align="right">$'.number_format($getSalaryInfo->advance_loan,2).'</td>
                    </tr>
                    <tr>
                        <td>INCOME TAX</td>
                        <td align="right">$'.number_format($getSalaryInfo->income_tax,2).'</td>
                    </tr>
                    <tr>
                        <td height="20px">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                     <tr class="greybg">
                        <td style="width:80px;">(B) TOTAL DEDUCTIONS</td>
                        <td align="right">$'.number_format($total_deducation,2).'</td>
                    </tr>
                </table><table width="100%" border="1" class="tabStyle" cellpadding="0" cellspacing="0">
                    <tr>
                        <td rowspan="3"  width="80px"  class=""><p>ADDITIONS</p></td>
                        <td style="width:120px;">REIMBURSEMENT</td>
                        <td width="120px" align="right">$'.number_format($getSalaryInfo->reimbursement,2).'</td>
                    </tr>
                    <tr>
                        <td height="20px">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                     <tr class="greybg">
                        <td>(C) TOTAL ADDITIONS</td>
                        <td align="right">$'.number_format($getSalaryInfo->reimbursement,2).'</td>
                    </tr>
                    <tr class="greybg">
                        <td colspan="2" style="padding-left:90px;">NETT PAY(A-B+C)</td>
                        <td align="right">$'.number_format($getSalaryInfo->net_pay_amt,2).'</td>
                    </tr>
                </table>
          </div>
         </div>
         </td>
         <td width="50%">
         <div class="col-span2">
          <div class="top-div">
                 <div class="top-div">
                <table width="100%" style="margin-left:20px;">
                  <tr><td style="width:50px;">I/C No</td><td width="2%">:</td><td width="240px"><div class="underline_view">'.$getSalaryInfo->ic_no.'</div></td></tr>
                </table>
                 <table width="100%" style="margin-left:20px;">
                  <tr><td style="width:50px;">TO</td><td width="2%">:</td><td width="240px"><div class="underline_view">'.date('d-m-Y',strtotime($getSalaryInfo->salary_to_date)).'</div></td></tr>
                </table>
                 </div>
             <div class="view-div">
                <table width="100%" border="1" class="tabStyleRight" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width:120px;">PAY DAY:</td>
                        <td width="180px">'.date('d-m-Y',strtotime($getSalaryInfo->pay_date)).'</td>
                    </tr>
                    <tr>
                        <td style="width:120px;">OVERTIME HOURS:</td>
                        <td width="180px">'.substr($getSalaryInfo->over_time,0,-3).'&nbsp;Hrs</td>
                    </tr>
                    <tr>
                        <td style="width:120px;">RATE PER HOUR:</td>
                        <td width="180px">$'.$getSalaryInfo->rate_per_hrs.'</td>
                    </tr>
                </table>';
  
       $html .='<table width="100%" border="1" class="tabStyleRight"  cellpadding="0" cellspacing="0" style="margin-top:20px;">
            <tr>
            	<td style="width:120px;">EMPLOYEES CPF:</td>
                <td width="180px">$'.number_format($getSalaryInfo->cpf,2).'</td>
            </tr>
            <tr>
            	<td style="width:120px;">EMPLOYER CPF:</td>
                <td width="180px">0.00</td>
            </tr>
            <tr>
            	<td style="width:120px;"">TOTAL CONTRIBUTION:</td>
                <td width="180px">0.00</td>
            </tr>
        </table>
        <table width="100%" border="1" class="tabStyleRight" cellpadding="0" cellspacing="0"  style="margin-top:20px;">
            <tr>
            	<td style="width:120px;">PREPARED BY:</td>
                <td height="45px" width="180px">&nbsp;</td>
            </tr>
            <tr>
            	<td style="width:120px;">APPROVED BY:</td>
                <td height="45px" width="180px">&nbsp;</td>
            </tr>
            <tr>
            	<td style="width:120px;">EMPLOYEES SIGNATURE:</td>
                <td height="130px" width="180px">&nbsp;</td>
            </tr>
        </table>
     </div>
  </div>
 </div>
 </td>
 </tr></table>
</div>
</body>';
$html.='</html>';
  return $html;
    }

}
?>