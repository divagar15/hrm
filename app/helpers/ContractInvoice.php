<?php
class ContractInvoice {
    
    public static function printContractInvoice($invoice_info,$invoice_lines,$con_invoice,$loanInfo) {
        $payMode    = Config::get('local.payMode');
        $basePublic = Config::get('local.basePublic');
        $total   = $tax = $grand   = 0;
        $handover_date = !empty($con_invoice) && $con_invoice->handover_date !='' ? date('d/m/Y',strtotime($con_invoice->handover_date)) : '-';
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
      </div>                     </td>
                                 </tr>
                           </table>
                           </div>
                          <div class="row rowbg">
                            <span class="span-high_dk">ISLAND MAIDS PTE LTD - </span><span class="span-high">Your Choice For Excellent Service!</span>
                            <div class="blackstrip"></div>
                          </div>
                        <div class="content-wrapper">
                           <table width="100%">
                            <tr>
                                <td width="60%">
                                   <div class="col-sp6-rx">
                                           <p style="margin-left:25px;"><strong>TO:'.ucwords($invoice_info->invoice_to).'</strong></p>
                                   </div>
                               </td>
                               <td width="40%">
                                   <div class="col-sp6-rx">
                                    <p class="invoice"><strong>Invoice no: '.$invoice_info->invoice_no.'</strong></p>
                                    <p class="invoice"><strong>Invoice date:'.date('d/m/Y',strtotime($invoice_info->date)).'</strong></p>';
                                    if(!empty($invoice_info->level4_name)) {
                                      $tax_code = $invoice_info->level4_name." - ".$invoice_info->tax_percentage." %";
                                    } else {
                                      $tax_code = 'NA';
                                    }
                                    $html .= '<p class="invoice"><strong>Tax Code:'.$tax_code.'</strong></p>
                                          </div>
                               </td>
                            </tr>
                           </table>';
                            if(!empty($con_invoice)) {        
                            $html.='<div class="row" style="margin-top:10px;">
                                            <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <th>SALESPERSON</th>
                                        <th>FDW SELECTED</th>
                                        <th>HANDOVER DATE</th>
                                    </tr>
                                    <tr>
                                        <td>'.ucwords($con_invoice->emp_name).'</td>
                                        <td>'.ucwords($con_invoice->maid_name).'</td>
                                        <td>'.$handover_date.'</td>
                                    </tr>
                                </table>
                            </div>';
                            }
                           $html.='<div class="row" style="margin-top:10px;">
                                    <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                    <th align="center" width="5%">SNo.</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                  </tr>';
                                   $totalPlacementFee = 0;
                                   foreach ($invoice_lines as $key => $line) {
                                       $total += $line->amount;
                                       if($line->fkincomecoa_id == 22 || $line->fkincomecoa_id == 8 || $line->fkincomecoa_id == 96) {
                                           $totalPlacementFee = (double)$totalPlacementFee + (double)$line->amount;
                                       } else {
                                            $html .='<tr>
                                                <td align="center">'.++$key.'</td>
                                                <td>'.ucwords($line->level4_name).'</td>
                                                <td align="right">'.number_format($line->amount,2).'</td>
                                            </tr>';
                                        }
                                    }
                                    if($totalPlacementFee != 0){
                                        $html .='<tr>
                                                <td align="center">'.$key.'</td>
                                                <td>Placement Fee (Receivable from Maid)</td>
                                                <td align="right">'.number_format($totalPlacementFee,2).'</td>
                                            </tr>';
                                    }
                                    $tax   += ($total*$invoice_info->tax_percentage)/100;
                                    $grand += $total+$tax;
                                    $html .= '<tr>
                                                <td></td>
                                                <td align="right"><strong style="font-size:12px;">Sub Total</strong></th>
                                                <td align="right"><strong style="font-size:12px;">'.number_format($total,2).'</strong></td>
                                              </tr>
                                              <tr>
                                                <td></td>
                                                <td align="right"><strong style="font-size:12px;"> GST</strong></th>
                                                <td align="right"><strong style="font-size:12px;">'.number_format($tax,2).'</strong></td>
                                              </tr>
                                              <tr>
                                                <td></td>
                                                <td align="right"><strong style="font-size:12px;">Grand Total</strong></th>
                                                <td align="right"><strong style="font-size:12px;">'.number_format($grand,2).'</strong></td>
                                              </tr>';

                                $html .='</table>
                            </div>';
                           if(!empty($loanInfo)) {
                            $html.='<div class="row" style="margin-top:10px;">
                                            <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                            <th>No</th>
                                        <th>Balance payments</th>
                                        <th colspan="2" style="text-align:left">Total</th>
                                    </tr>
                                    <tr>
                                            <td>1</td>
                                        <td>Placement Fee</td>
                                        <td style="text-align:right"></td>
                                        <td style="text-align:right">'.'$'.number_format($invoice_info->loan_amount,2).'</td>
                                    </tr>';
                            $i = 2;
                            foreach($loanInfo as $key => $loanVal){ 
                                if( $i == 2) 
                                    $install = $invoice_info->loan_tenure.' mths installement'. date('d/m/Y',strtotime($loanVal->collect_date));
                                else
                                    $install = date('d/m/Y',strtotime($loanVal->collect_date));
                                $html.='<tr>
                                          <td>'.$i.'</td>
                                          <td>'.$install.'</td>
                                          <td  style="text-align:left">'.number_format($loanVal->emi_amt,2).'</td>
                                          <td style="text-align:right"></td>
                                      </tr>';
                                $i++;
                            }
                                $html.='</table>';
                                $html.='</div>';
                           }
                           $html.='<div class="row para">
                                    <p>Please make all cheques payable to <strong>ISLAND MAIDS PTE LTD.</strong></p>
                                <p><strong>Thank you for making Island Maids your preferred choice.</strong></p>
                                <p><strong>Help us improve by dropping us a feedback on our services: gabriel@islandmaids.com.sg. We would love to hear from you soon.</strong></p>
                                <p><strong>Lastly, we wish that you have a good experience with your domestic helper and hope that you have found yourself a good helping hand.</strong></p>
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