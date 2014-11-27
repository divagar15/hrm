<?php
class PrintTranscaton{
    
    public static function printReceipt($receipt_info,$paymentCoa) {
       $basePublic = Config::get('local.basePublic');
      
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
                                       
                   </td>
                                 </tr>
                           </table>
                           </div>
                          <div class="row rowbg">
                            <span class="span-high_dk">RECEIPT</span>
                            <div class="blackstrip"></div>
                          </div>
                        <div class="content-wrapper">
                            <div class="row" style="margin-top:10px;">
                                <table width="90%" class="sm-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td dwidth="10%">RECEIPT</td>
                                        <td width="50%"></td>
                                        <td>Date</th>
                                        <td>'.date('d-m-Y',strtotime($receipt_info->receipt_date)).'</th>
                                    </tr>
                                    <tr>
                                        <td width="25%">Received From</td>
                                        <td width="20%">'.ucwords($receipt_info->received_from).'</td>
                                        <td width="25%">Receipt No</td>
                                        <td width="25%">'.ucwords($receipt_info->receipt_no).'</td>
                                    </tr>
                                     <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="25%">Cheque No</td>
                                        <td width="25%">'.$receipt_info->cheque_no.'</td>
                                    </tr>
                                </table>
                                 <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <th>Branch</th>
                                        <th>Description</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                    </tr>
                                    <tr>
                                        <td>'.ucwords($receipt_info->branch_name).'</td>
                                        <td>'.$paymentCoa[$receipt_info->bank_cash_account].'</td>
                                        <td>'.number_format($receipt_info->receipt_amount,2,'.',',').'</td>
                                        <td>--</td>
                                    </tr>';
                                    if($receipt_info->customer != 0) {
                                        $html.='<tr>
                                            <td>&nbsp;</td>
                                            <td>Receivables – Customers ('.$receipt_info->customer_name.')</td>
                                            <td>--</td>
                                            <td>'.number_format($receipt_info->receipt_amount,2,'.',',').'</td>
                                            
                                        </tr>';
                                    } else {
                                         $html.='<tr>
                                            <td></td>
                                            <td>Receivables Others</td>
                                            <td>--</td>    
                                            <td>'.number_format($receipt_info->receipt_amount,2,'.',',').'</td>
                                        </tr>';
                                    }
                                    $html.='<tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>';
                                    $html.='<tr>
                                            <td>&nbsp;</td>
                                            <td colspan="3">Remarks:'.$receipt_info->remarks.'</td>
                                        </tr>';
                                     $html.='<tr>
                                            <td>&nbsp;</td>
                                            <td colspan="3">Cheqye No:'.$receipt_info->cheque_no.'</td>
                                        </tr>';
                                     $html.='<tr>
                                            <td colspan="2" align="right">Total</td>
                                            <td>'.number_format($receipt_info->receipt_amount,2,'.',',').'</td>
                                            <td>'.number_format($receipt_info->receipt_amount,2,'.',',').'</td>
                                        </tr>';
                                $html.='</table>';
                                $html.=' <table width="70%" style="margin-top:30px;" class="sm-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr><td align="right">Authorised by</td><tr>
                                         </table>
                            </div>
                            </div>
                        <div id="footer">
                         <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                        <div class="blackrow"></div>
                      </div>
                   </div>
                  </body>
                 </html>';
        return $html;

    }

    
    public static function printPayment($pay_info,$gl_info,$pay_lines) {
       $basePublic = Config::get('local.basePublic');
       $debit  = $credit = 0;
      
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
                                       
                   </td>
                                 </tr>
                           </table>
                           </div>
                          <div class="row rowbg">
                            <span class="span-high_dk">PAYMENTS</span>
                            <div class="blackstrip"></div>
                          </div>
                        <div class="content-wrapper">
                            <div class="row" style="margin-top:10px;">
                                <table width="90%" class="sm-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="10%">PAYMENTS</td>
                                        <td width="50%"></td>
                                        <td>Date</th>
                                        <td width="25%">'.date('d-m-Y',strtotime($pay_info->payment_date)).'</th>
                                    </tr>
                                    <tr>
                                        <td width="25%">Paid To</td>
                                        <td width="20%" align="left">'.ucwords($pay_info->paid_to).'</td>
                                        <td width="25%">Payment No</td>
                                        <td width="25%">'.ucwords($pay_info->payment_no).'</td>
                                    </tr>
                                     <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="20%">Cheque No</td>
                                        <td width="25%">'.$pay_info->cheque_no.'</td>
                                    </tr>
                                </table>
                                 <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <th>Branch</th>
                                        <th>Description</th>
                                        <th>Debit S$</th>
                                        <th>Credit S$</th>
                                    </tr>';
                                    if(!empty($pay_lines)) {
                                        foreach($pay_lines as $payl){
                                        $debit += $payl->amount;
                                        $html.='<tr>
                                            <td>'.ucwords($pay_info->branch_name).'</td>
                                            <td>'.$payl->level4_name.'</td>
                                            <td>'.number_format($payl->amount,2,'.',',').'</td>
                                            <td>--</td>
                                        </tr>';
                                        }
                                    }
                                    if(!empty($gl_info)) {
                                        foreach($gl_info as $gl) {
                                         if($gl->amount_type == 1) { // debit
                                            $debit += $gl->amount; 
                                            $html.='<tr>
                                                <td>&nbsp;</td>
                                                <td>'.$gl->level4_name.'</td>
                                                <td>'.number_format($gl->amount,2,'.',',').'</td>
                                                <td>--</td>
                                            </tr>';
                                         } elseif($gl->amount_type == 2) { // credit
                                             $credit += $gl->amount;
                                             $html.='<tr>
                                                <td>&nbsp;</td>
                                                <td>'.$gl->level4_name.'</td>
                                                <td>--</td>
                                                <td>'.number_format($gl->amount,2,'.',',').'</td>
                                            </tr>';
                                         }
                                        }
                                    }
                                     $html.='<tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>';
                                    $html.='<tr>
                                            <td>&nbsp;</td>
                                            <td colspan="3">Remarks:'.$pay_info->remarks.'</td>
                                        </tr>';
                                     $html.='<tr>
                                            <td>&nbsp;</td>
                                            <td colspan="3">Cheqye No:'.$pay_info->cheque_no.'</td>
                                        </tr>';
                                     $html.='<tr>
                                            <td colspan="2" align="right">Total</td>
                                            <td>'.number_format($debit,2,'.',',').'</td>
                                            <td>'.number_format($credit,2,'.',',').'</td>
                                        </tr>';
                                $html.='</table>';
                                $html.=' <table width="70%" style="margin-top:30px;" class="sm-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr><td align="right">Authorised by</td><tr>
                                         </table>
                            </div>
                            </div>
                        <div id="footer">
                         <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                        <div class="blackrow"></div>
                      </div>
                   </div>
                  </body>
                 </html>';
        return $html;

    }
    
    public static function printJournal($journal_info,$j_lines) {
       $basePublic = Config::get('local.basePublic');
       $debit  = $credit = 0;
      
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
                                       
                   </td>
                                 </tr>
                           </table>
                           </div>
                          <div class="row rowbg">
                            <span class="span-high_dk">JOURNAL VOUCHER</span>
                            <div class="blackstrip"></div>
                          </div>
                        <div class="content-wrapper">
                            <div class="row" style="margin-top:10px;">
                                <table width="90%" class="sm-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="10%">JOURNAL VOUCHER</td>
                                        <td width="50%"></td>
                                        <td>Date</th>
                                        <td width="25%">'.date('d-m-Y',strtotime($journal_info->journal_date)).'</th>
                                    </tr>
                                    <tr>
                                        <td width="25%"></td>
                                        <td width="20%" align="left"></td>
                                        <td width="25%">Receipt No</td>
                                        <td width="25%">'.ucwords($journal_info->journal_no).'</td>
                                    </tr>
                                     <tr>
                                        <td></td>
                                        <td></td>
                                        <td width="20%"></td>
                                        <td width="25%"></td>
                                    </tr>
                                </table>
                                 <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <th>Branch</th>
                                        <th>Description</th>
                                        <th>Debit S$</th>
                                        <th>Credit S$</th>
                                    </tr>';
                                    if(!empty($j_lines)) {
                                        $i = 1;
                                        foreach($j_lines as $payl){
                                            if($payl->debit != 0) {    
                                                $debit += $payl->debit;
                                                $html.='<tr>';
                                                if($i == 1){   
                                                    $html.='<td>'.ucwords($journal_info->branch_name).$i.'</td>';
                                                } else {
                                                    $html.='<td>&nbsp;</td>';
                                                }
                                                $html.='<td>'.$payl->level4_name.'</td>
                                                    <td>'.number_format($payl->debit,2,'.',',').'</td>
                                                    <td>--</td>
                                                </tr>';
                                            }
                                         if($payl->credit != 0) {    
                                                $credit += $payl->credit;
                                                 $html.='<tr>';
                                                if($i == 1){   
                                                    $html.='<td>'.ucwords($journal_info->branch_name).$i.'</td>';
                                                } else {
                                                    $html.='<td>&nbsp;</td>';
                                                }
                                                $html.='<td>'.$payl->level4_name.'</td>
                                                    <td>--</td>
                                                    <td>'.number_format($payl->credit,2,'.',',').'</td>
                                                    
                                                </tr>';
                                            }
                                            $i++;
                                        }
                                    }
                                    $html.='<tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>';
                                    $html.='<tr>
                                            <td>&nbsp;</td>
                                            <td colspan="3">Remarks:'.$journal_info->description.'</td>
                                        </tr>';
                                     $html.='<tr>
                                            <td colspan="2" align="right">Total</td>
                                            <td>'.number_format($debit,2,'.',',').'</td>
                                            <td>'.number_format($credit,2,'.',',').'</td>
                                        </tr>';
                                $html.='</table>';
                                $html.=' <table width="70%" style="margin-top:30px;" class="sm-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr><td align="right">Authorised by</td><tr>
                                         </table>
                            </div>
                            </div>
                        <div id="footer">
                         <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                        <div class="blackrow"></div>
                      </div>
                   </div>
                  </body>
                 </html>';
        return $html;

    }
    
    public static function printReimburseItem($ritem){
        $total      = 0;
        $basePublic = Config::get('local.basePublic');
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
                                                   </td>
                                             </tr>
                                             </table>
                                             </div>
                                            <div class="row rowbg">
                                              <span class="span-high_dk">REIMBURSEMENT ITEMS</span>
                                              <div class="blackstrip"></div>
                                            </div>
                                          <div class="content-wrapper">
                                              <div class="row" style="margin-top:10px;">
                                                  <table width="90%" class="sm-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                      <th width="5%">Sno</th>
                                                      <th width="10%" style="text-align: center;">Date</th>
                                                      <th width="20%">Reimbursement</th>
                                                      <th width="15%">Inv/Rcpt No</th>
                                                      <th width="30%">Description</th>
                                                      <th width="10%" style="text-align: right;">Amount</th>
                                                    </tr>';
                                                    foreach($ritem as $key => $view) {
                                                     $html .='<tr>
                                                       <td style="text-align: center;">'.++$key.'</td>
                                                       <td style="text-align: center;">'.date('d-m-Y',strtotime($view->inv_date)).'</td>
                                                       <td>'.htmlspecialchars($view->reimburse).'</td>
                                                       <td>'.$view->invoice_no.'</td>
                                                       <td>'.str_limit($view->description,200).'</td>
                                                       <td style="text-align: right;">$'.number_format($view->amount,2).'</td>
                                                     </tr>';
                                                     $total = $total + $view->amount;
                                                     } 
                                                     $html .='<tr>
                                                       <td style="text-align: right;" colspan="5">Total</td>
                                                       <td style="text-align: right;">$'.number_format($total,2).'</td>
                                                     </tr>';
                            $html.='</table>
                              </div>
                            </div>
                        <div id="footer">
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