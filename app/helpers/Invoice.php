<?php
class Invoice {
    
    public static function printInvoice($invoice_info, $invoice_line) {
        $payMode    = Config::get('local.payMode');
        $basePublic = Config::get('local.basePublic');
        $total      = 0.00;
        $tax        = 0.00;
        $grand      = 0.00;
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
                                <td>
                                   <div class="col-sp6-rx">
                                           <p style="margin-left:25px;"><strong>TO:'.ucwords($invoice_info->invoice_to).'</strong></p>
                                   </div>
                               </td>
                               <td>
                                   <div class="col-sp6-rx">
                                    <p class="invoice"><strong>Invoice no: '.$invoice_info->invoice_no.'</strong></p>
                                    <p class="invoice"><strong>Invoice date:'.date('d/m/Y',strtotime($invoice_info->date)).'</strong></p>';
                                    
                                    if(!empty($invoice_info->level4_name)) {
                                      $tax_code = $invoice_info->level4_name." - ".$invoice_info->tax_percentage." %";
                                    } else {
                                      $tax_code = 'NA';
                                    }

                                    $html .='<p class="invoice"><strong>Tax Code:'.$tax_code.'</strong></p>
                                   </div>
                               </td>
                            </tr>
                           </table>
                            <div class="row" style="margin-top:10px;">
                                            <table width="90%" class="grid-table" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <th>Income Account</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>';
                                    foreach ($invoice_line as $line) {
                                      $total += $line->amount;
                                    $html .='<tr>
                                        <td>'.ucwords($line->level4_name).'</td>
                                        <td>'.$line->description.'</td>
                                        <td align="right">'.number_format($line->amount,2).'</td>
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
                                                <td align="right"><strong style="font-size:12px;">Total GST</strong></th>
                                                <td align="right"><strong style="font-size:12px;">'.number_format($tax,2).'</strong></td>
                                              </tr>
                                              <tr>
                                                <td></td>
                                                <td align="right"><strong style="font-size:12px;">Grand Total</strong></th>
                                                <td align="right"><strong style="font-size:12px;">'.number_format($grand,2).'</strong></td>
                                              </tr>';

                                $html .='</table>
                            </div></div>
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