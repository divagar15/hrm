<?php
class Reports {
    public static function printLeave($leaves) {
     $basePublic = Config::get('local.basePublic');
     $html = '';
     $html .= '<html><head><link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>';
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
               // echo '<pre>'; print_r($leaves); echo '</pre>';
  $html .= '</head>';
  $html .= '<body>
        <div class="container">
                       <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                  <thead>
                                    <tr width="30%">
                                      <th>Employee Name</th>
                                      <th>From Date</th>
                                      <th>To Date</th>
                                      <th>Include Off</th>
                                      <th>Public Holidays</th>
                                      <th>Type</th>
                                      <th>Days</th>
                                      <th>Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>';
                                  if(!empty($leaves))  {
                                   foreach($leaves as $view) {
                                    if($view->off_day==1) {
                                      $off = 'No';
                                    } else {
                                      $off = 'Yes';
                                    }
                                    if($view->ph_day==1) {
                                      $ph = 'No';
                                    } else {
                                      $ph = 'Yes';
                                    }
                                    $html .= '<tr>
                                      <td>'.ucwords($view->emp_name).'</td>
                                      <td>'.date('d-m-Y',strtotime($view->from_date)).'</td>
                                      <td>'.date('d-m-Y',strtotime($view->to_date)).'</td>
                                      <td>'.$off.'</td>
                                      <td>'.$ph.'</td>
                                      <td>'.ucwords($view->leave_type).'</td>
                                      <td>'.$view->count.'</td>
                                      <td>';
                                      if($view->status == 1) { 
                                         $html .= 'Approved';
                                      } elseif($view->status == 2) { 
                                        $html .=  'Rejected'; 
                                      } elseif($view->status == 3) { 
                                        $html .=  'Pending';
                                      } elseif($view->status == 4) { 
                                        $html .=  'Cancelled';
                                      }
                                       
                                      $html .='</td>
                                      
                                    </tr>';
                                    }
                                    }
                                  $html .='</tbody>
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



  public static function printPayslip($salary) {
     $basePublic = Config::get('local.basePublic');
     $html = '';
     $html .= '<html><head><link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>';
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
               // echo '<pre>'; print_r($leaves); echo '</pre>';
  $html .= '</head>';
  $html .= '<body>
        <div class="container">
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
      </div>                     </td>
                                 </tr>
                           </table>
                           </div>
                           <br/>
                       <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                  <thead>
                                    <tr width="30%">
                                      <th>Name</th>
                                      <th>Branch</th>
                                      <th>Basic</th>
                                      <th>Comm</th>
                                      <th>Allowance</th>
                                      <th>Gross</th>
                                      <th>EE CPF</th>
                                      <th>Loan</th>
                                      <th>Tot Ded</th>
                                      <th>Net</th>
                                      <th>ER CPF</th>
                                      <th>SDF</th>
                                      <th>CPF Board</th>
                                    </tr>
                                  </thead>
                                  <tbody>';
                                  if(!empty($salary))  {
                                   foreach($salary as $view) {
                                    
                                    $html .= '<tr>
                                      <td>'.ucwords($view->emp_name).'</td>
                                      <td>'.$view->branch_name.'</td>
                                      <td>'.number_format($view->basic_paid,2,'.',',').'</td>
                                      <td>'.number_format($view->commission,2,'.',',').'</td>
                                      <td>'.number_format($view->allowances,2,'.',',').'</td>
                                      <td>'.number_format($view->gross,2,'.',',').'</td>
                                      <td>'.number_format($view->ee_cpf,2,'.',',').'</td>
                                      <td>'.number_format($view->mloan_amt,2,'.',',').'</td>
                                      <td>'.number_format($view->total_deducate,2,'.',',').'</td>
                                      <td>'.number_format($view->net_pay,2,'.',',').'</td>
                                      <td>'.number_format($view->er_cpf,2,'.',',').'</td>
                                      <td>'.number_format($view->sdl,2,'.',',').'</td>
                                      <td>'.number_format($view->cpf_broad,2,'.',',').'</td>
                                      
                                    </tr>';
                                    }
                                    }
                                  $html .='</tbody>
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




  public static function printPay($salary,$mode,$date) {
     $basePublic = Config::get('local.basePublic');
     $html = '';
     $html .= '<html><head><link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>';
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
                .view-div{margin-top:0px;}
                .greybg{ background-color:#CCC; font-weight:700;}
            </style>';
               // echo '<pre>'; print_r($leaves); echo '</pre>';
  $html .= '</head>';
  $html .= '<body>
        <div class="container">
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
                                 </td>
                                 </tr>
                           </table>
                           </div>';
                                  if(!empty($salary))  {
                                   foreach($salary as $view) {

                                    $month = date('m',strtotime($view->salary_from_date));
                                    $year  = date('Y',strtotime($view->salary_from_date));

                                    $first = date('d-m-Y', mktime(0, 0, 0, $month-1, 1, $year));
                                    $last = date('t-m-Y', mktime(0, 0, 0, $month-1, 1, $year));

                                    $html .= '<div style="margin-top:10px;">
                                    <h6 align="right" style="padding:0; margin-top:0px; margin-bottom:5px; margin-right:40px;">Period : '.date("d-m-Y",strtotime($view->salary_from_date)).'-'.date("d-m-Y",strtotime($view->salary_to_date)).'</h6>
                       
                       <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                  <thead>
                                    <tr width="30%">
                                      <th>EID</th>
                                      <th>EMPLOYEE NAME</th>
                                      <th>DESIGNATION</th>
                                    </tr>
                                  </thead>
                                  <tbody><tr>
                                      <td>'.ucwords($view->employee_id).'</td>
                                      <td>'.ucwords($view->emp_name).'</td>
                                      <td>'.ucwords($view->job_title).'</td>
                                      
                                    </tr></tbody>
                                </table></div>

                                <div style="margin-top:10px; margin-left:35px; width:100%;">
                                <div style="float:left;">
                                <table width="50%" class="grid-table" border="0" cellpadding="0" cellspacing="0" style="float:left;">
                                  <thead>
                                    <tr width="30%">
                                      <th>EARNINGS</th>
                                      <th align="right">AMOUNT</th>
                                    </tr>
                                  </thead><tbody>

                                  <tr>
                                    <td>Basic Wage</td>
                                    <td align="right">'.number_format($view->basic,2,'.',',').'</td>
                                  </tr>';
                                  if($view->t_npl != 0){
                                    $html .= '<tr>
                                        <td>NPL Deduction '.$view->t_npl.' Days</td>
                                        <td align="right">'.number_format($view->npl_amt,2,'.',',').'</td>
                                      </tr>';
                                  } else {
                                     $html .= '<tr>
                                        <td>NPL Deduction</td>
                                        <td align="right">'.number_format($view->npl_amt,2,'.',',').'</td>
                                      </tr>'; 
                                  }

                             $html .='<tr>
                                    <td>Commission</td>
                                    <td align="right">'.number_format($view->commission,2,'.',',').'</td>
                                  </tr>

                                  <tr>
                                    <td>Allowances</td>
                                    <td align="right">'.number_format($view->allowances,2,'.',',').'</td>
                                  </tr>



                                  </tbody></table>
                                  </div>
                                  <div style="float:left; margin-left:40px;">
                                  <table width="82%" class="grid-table" border="0" cellpadding="0" cellspacing="0" style="float:left; margin-left:240px;">
                                  <thead>
                                    <tr width="30%">
                                      <th>DEDUCTION</th>
                                      <th align="right">AMOUNT</th>
                                    </tr>
                                  </thead><tbody>

                                  <tr>
                                    <td>Employee CPF</td>
                                    <td align="right">'.number_format($view->ee_cpf,2,'.',',').'</td>
                                  </tr>

                                  <tr>
                                    <td>Staff Loan</td>
                                    <td align="right">'.number_format($view->mloan_amt,2,'.',',').'</td>
                                  </tr>

                                  </tbody></table>
                                  </div>
                                  </div>

                                   
                                      <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0" style="margin-top:130px; clear:both;">
                                        <tr>
                                         <td>Commission Period</td>
                                         <td>'.$first.' - '.$last.'</td>
                                         <td>Gross Wage</td>
                                         <td align="right">'.number_format($view->gross,2,'.',',').'</td>
                                        </tr>
                                        <tr>
                                         <td>Bank A/C</td>
                                         <td>'.$view->account_no.'</td>
                                         <td>Net Wage</td>
                                         <td align="right">'.number_format($view->net_pay,2,'.',',').'</td>
                                        </tr>
                                        <tr>
                                         <td>Payment Mode</td>
                                         <td>'.ucwords($mode).'</td>
                                         <td>CPF Wage</td>
                                         <td align="right">'.number_format($view->cpf_wages,2,'.',',').'</td>
                                        </tr>
                                        <tr>
                                         <td>Payment Date</td>
                                         <td>'.$date.'</td>
                                         <td>Employer CPF</td>
                                         <td align="right">'.number_format($view->er_cpf,2,'.',',').'</td>
                                        </tr>
                                        <tr>
                                         <td></td>
                                         <td></td>
                                         <td>Total CPF</td>
                                         <td align="right">'.number_format(($view->er_cpf+$view->ee_cpf),2,'.',',').'</td>
                                        </tr>
                                      </table>
                                   ';
                                    }
                                    }
                                  $html .='
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


    /* Purpose : Print all pay slip */
    
  public static function printPayAll($salary,$mode,$date) {
     $basePublic = Config::get('local.basePublic');
     $html = '';
     $html .= '<html><head><link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>';
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
                .view-div{margin-top:0px;}
                .greybg{ background-color:#CCC; font-weight:700;}
            </style>';
               // echo '<pre>'; print_r($leaves); echo '</pre>';
  $html .= '</head>';
  $html .= '<body>';
   if(!empty($salary))  {
        foreach($salary as $view) {   
  $html .= '<div class="container">
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
                                 </td>
                                 </tr>
                           </table>
                           </div>';
                                
                                    $month = date('m',strtotime($view->salary_from_date));
                                    $year  = date('Y',strtotime($view->salary_from_date));

                                    $first = date('d-m-Y', mktime(0, 0, 0, $month-1, 1, $year));
                                    $last = date('t-m-Y', mktime(0, 0, 0, $month-1, 1, $year));

                                    $html .= '<div style="margin-top:10px;">
                                    <h6 align="right" style="padding:0; margin-top:0px; margin-bottom:5px; margin-right:40px;">Period : '.date("d-m-Y",strtotime($view->salary_from_date)).'-'.date("d-m-Y",strtotime($view->salary_to_date)).'</h6>
                       
                       <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                  <thead>
                                    <tr width="30%">
                                      <th>EID</th>
                                      <th>EMPLOYEE NAME</th>
                                      <th>DESIGNATION</th>
                                    </tr>
                                  </thead>
                                  <tbody><tr>
                                      <td>'.ucwords($view->employee_id).'</td>
                                      <td>'.ucwords($view->emp_name).'</td>
                                      <td>'.ucwords($view->job_title).'</td>
                                      
                                    </tr></tbody>
                                </table></div>

                                <div style="margin-top:10px; margin-left:35px; width:100%;">
                                <div style="float:left;">
                                <table width="50%" class="grid-table" border="0" cellpadding="0" cellspacing="0" style="float:left;">
                                  <thead>
                                    <tr width="30%">
                                      <th>EARNINGS</th>
                                      <th align="right">AMOUNT</th>
                                    </tr>
                                  </thead><tbody>

                                  <tr>
                                    <td>Basic Wage</td>
                                    <td align="right">'.number_format($view->basic,2,'.',',').'</td>
                                  </tr>';
                                  if($view->t_npl != 0){
                                    $html .= '<tr>
                                        <td>NPL Deduction '.$view->t_npl.' Days</td>
                                        <td align="right">'.number_format($view->npl_amt,2,'.',',').'</td>
                                      </tr>';
                                  } else {
                                     $html .= '<tr>
                                        <td>NPL Deduction</td>
                                        <td align="right">'.number_format($view->npl_amt,2,'.',',').'</td>
                                      </tr>'; 
                                  }

                             $html .='<tr>
                                    <td>Commission</td>
                                    <td align="right">'.number_format($view->commission,2,'.',',').'</td>
                                  </tr>

                                  <tr>
                                    <td>Allowances</td>
                                    <td align="right">'.number_format($view->allowances,2,'.',',').'</td>
                                  </tr>



                                  </tbody></table>
                                  </div>
                                  <div style="float:left; margin-left:40px;">
                                  <table width="82%" class="grid-table" border="0" cellpadding="0" cellspacing="0" style="float:left; margin-left:240px;">
                                  <thead>
                                    <tr width="30%">
                                      <th>DEDUCTION</th>
                                      <th align="right">AMOUNT</th>
                                    </tr>
                                  </thead><tbody>

                                  <tr>
                                    <td>Employee CPF</td>
                                    <td align="right">'.number_format($view->ee_cpf,2,'.',',').'</td>
                                  </tr>

                                  <tr>
                                    <td>Staff Loan</td>
                                    <td align="right">'.number_format($view->mloan_amt,2,'.',',').'</td>
                                  </tr>

                                  </tbody></table>
                                  </div>
                                  </div>

                                   
                                      <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0" style="margin-top:130px; clear:both;">
                                        <tr>
                                         <td>Commission Period</td>
                                         <td>'.$first.' - '.$last.'</td>
                                         <td>Gross Wage</td>
                                         <td align="right">'.number_format($view->gross,2,'.',',').'</td>
                                        </tr>
                                        <tr>
                                         <td>Bank A/C</td>
                                         <td>'.$view->account_no.'</td>
                                         <td>Net Wage</td>
                                         <td align="right">'.number_format($view->net_pay,2,'.',',').'</td>
                                        </tr>
                                        <tr>
                                         <td>Payment Mode</td>
                                         <td>'.ucwords($mode).'</td>
                                         <td>CPF Wage</td>
                                         <td align="right">'.number_format($view->cpf_wages,2,'.',',').'</td>
                                        </tr>
                                        <tr>
                                         <td>Payment Date</td>
                                         <td>'.$date.'</td>
                                         <td>Employer CPF</td>
                                         <td align="right">'.number_format($view->er_cpf,2,'.',',').'</td>
                                        </tr>
                                        <tr>
                                         <td></td>
                                         <td></td>
                                         <td>Total CPF</td>
                                         <td align="right">'.number_format(($view->er_cpf+$view->ee_cpf),2,'.',',').'</td>
                                        </tr>
                                      </table>
                                   ';
                                  $html .='
     </div>
  </div>
 </div>
 </td>
 </tr></table>
</div>';
                                    }
                                    }
$html.='</body>';
$html.='</html>';
  return $html;
    }

    
    
}
?>