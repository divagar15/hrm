<?php
class PrintPdfReport {
          
		    public static function MonthlySalaryPrintPdf($salary,$date,$branches,$br,$allow_collect,$allow_list) {
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>
                                   <tr>
                                      <th colspan="13">Monthly salary Report</th>
                                   </tr>
                                    <tr width="100%">                                     
                                      <th>Name</th>
                                      <th>Branch</th>
                                      <th>Basic Paid</th>
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
                                  
                                    $basic_paid = 0.00;
                                    $commission = 0.00;
                                    $allowances = 0.00;
                                    $gross = 0.00;
                                    $ee_cpf = 0.00;
                                    $mloan_amt = 0.00;
                                    $total_deducate = 0.00;
                                    $net_pay = 0.00;
                                    $er_cpf = 0.00;
                                    $sdl = 0.00;
                                    $cpf_broad = 0.00;
                                 
                                    if(!empty($salary))
									{   
                                   	foreach($salary as $view)
                                 	{
                                    $basic_paid += $view->basic_paid;
                                    $commission += $view->commission;
                                    $allowances += $view->allowances;
                                    $gross += $view->gross;
                                    $ee_cpf += $view->ee_cpf;
                                    $mloan_amt += $view->mloan_amt;
                                    $total_deducate += $view->total_deducate;
                                    $net_pay += $view->net_pay;
                                    $er_cpf += $view->er_cpf;
                                    $sdl += $view->sdl;
                                    $cpf_broad += $view->cpf_broad;
                                
                                    $html.='<tr>                                     
                                      <td>'. ucwords($view->emp_name).'</td>
                                      <td>'.$view->branch_name.'</td>
                                      <td>'.number_format($view->basic_paid,2,'.',',').'</td>
                                      <td>'.number_format($view->commission,2,'.',',').'</td>
                                      <td>'.number_format($view->allowances,2,'.',',') .'</td>
                                      <td>'.number_format($view->gross,2,'.',',') .'</td>
                                      <td>'. number_format($view->ee_cpf,2,'.',',') .'</td>
                                      <td>'. number_format($view->mloan_amt,2,'.',',') .'</td>
                                      <td>'. number_format($view->total_deducate,2,'.',',') .'</td>     
                                      <td>'. number_format($view->net_pay,2,'.',',') .'</td>
                                      <td>'. number_format($view->er_cpf,2,'.',',') .'</td>
                                      <td>'. number_format($view->sdl,2,'.',',') .'</td>
                                      <td>'. number_format($view->cpf_broad,2,'.',',') .'</td>                                   
                                    </tr>';
                                    }
                                    }
                                  $html.='</tbody>
                                  <tfoot>
                                    <tr>
                                      <th>Total</th>
                                      <th></th>
                                      <th>'. number_format($basic_paid,2,'.',',') .'</th>
                                      <th>'. number_format($commission,2,'.',',') .'</th>
                                      <th>'. number_format($allowances,2,'.',',') .'</th>
                                      <th>'. number_format($gross,2,'.',',') .'</th>
                                      <th>'. number_format($ee_cpf,2,'.',',') .'</th>
                                      <th>'. number_format($mloan_amt,2,'.',',') .'</th>
                                      <th>'. number_format($total_deducate,2,'.',',') .'</th>
                                      <th>'. number_format($net_pay,2,'.',',') .'</th>
                                      <th>'. number_format($er_cpf,2,'.',',') .'</th>
                                      <th>'. number_format(floor($sdl),2,'.',',') .'</th>
                                      <th>'. number_format($cpf_broad,2,'.',',') .'</th>
                                    </tr>
                                  </tfoot>
                                </table>';

                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }
	
		  public static function YearlySalaryPrintPdf($salary,$from_date,$to_date,$br,$branches) {
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>
                                   <tr>
                                      <th colspan="13">Yearly Summary Report</th>
                                   </tr>
                                    <tr width="100%">
                                     
                                     <th>Year</th>
                                      <th>Month</th>
                                      <th>Basic Paid</th>
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
                                  
                                     $basic_paid = 0.00;
                                    $commission = 0.00;
                                    $allowances = 0.00;
                                    $gross = 0.00;
                                    $ee_cpf = 0.00;
                                    $mloan_amt = 0.00;
                                    $total_deducate = 0.00;
                                    $net_pay = 0.00;
                                    $er_cpf = 0.00;
                                    $sdl = 0.00;
                                    $cpf_broad = 0.00;
                                 
                                    if(!empty($salary))
									{   
                                   	foreach($salary as $view)
                                 	{
                                    $basic_paid += $view->basic_paid;
                                    $commission += $view->commission;
                                    $allowances += $view->allowances;
                                    $gross += $view->gross;
                                    $ee_cpf += $view->ee_cpf;
                                    $mloan_amt += $view->mloan_amt;
                                    $total_deducate += $view->total_deducate;
                                    $net_pay += $view->net_pay;
                                    $er_cpf += $view->er_cpf;
                                    $sdl += $view->sdl;
                                    $cpf_broad += $view->cpf_broad;
                                
                                    $html.='<tr>                                     
                                      <td>'. date('Y',strtotime($view->salary_from_date)).'</td>
                                      <td>'.date('M',strtotime($view->salary_from_date)).'</td>
                                      <td>'.number_format($view->basic_paid,2,'.',',').'</td>
                                      <td>'.number_format($view->commission,2,'.',',').'</td>
                                      <td>'.number_format($view->allowances,2,'.',',').'</td>
                                      <td>'.number_format($view->gross,2,'.',',') .'</td>
                                      <td>'. number_format($view->ee_cpf,2,'.',',') .'</td>
                                      <td>'. number_format($view->mloan_amt,2,'.',',') .'</td>
                                      <td>'. number_format($view->total_deducate,2,'.',',') .'</td>     
                                      <td>'. number_format($view->net_pay,2,'.',',') .'</td>
                                      <td>'.  number_format($view->er_cpf,2,'.',',') .'</td>
                                      <td>'. number_format($view->sdl,2,'.',',') .'</td>
                                      <td>'.number_format($view->cpf_broad,2,'.',',') .'</td>                                   
                                    </tr>';
                                    }
                                    }
                                  $html.='</tbody>
                                  <tfoot>
                                    <tr>
                                      <th>Total</th>
                                      <th></th>
                                      <th>'. number_format($basic_paid,2,'.',',') .'</th>
                                      <th>'.  number_format($commission,2,'.',',') .'</th>
                                      <th>'. number_format($allowances,2,'.',',') .'</th>
                                      <th>'. number_format($gross,2,'.',',') .'</th>
                                      <th>'. number_format($ee_cpf,2,'.',',') .'</th>
                                      <th>'.  number_format($mloan_amt,2,'.',',') .'</th>
                                      <th>'. number_format($total_deducate,2,'.',',') .'</th>
                                      <th>'.number_format($net_pay,2,'.',',') .'</th>
                                      <th>'. number_format($er_cpf,2,'.',',').'</th>
                                      <th>'.number_format(floor($sdl),2,'.',',') .'</th>
                                      <th>'. number_format($cpf_broad,2,'.',',') .'</th>
                                    </tr>
                                  </tfoot>
                                </table>';

                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }	
	
	 public static function PaySlipPrintPdf($salary,$report_date,$br,$branches) {
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>
                                   <tr>
                                      <th colspan="13">Payslip Report</th>
                                   </tr>
                                    <tr width="100%">
                                     
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
                                                                   
                                    if(!empty($salary))
									{   
                                   	foreach($salary as $view)
                                 	{
                                   
                                    $html.='<tr>                                     
                                      <td>'. ucwords($view->emp_name).'</td>
                                      <td>'.$view->branch_name.'</td>
                                      <td>'.number_format($view->basic_paid,2,'.',',').'</td>
                                      <td>'.number_format($view->commission,2,'.',',').'</td>
                                      <td>'.number_format($view->allowances,2,'.',',').'</td>
                                      <td>'.number_format($view->gross,2,'.',',') .'</td>
                                      <td>'.number_format($view->ee_cpf,2,'.',',') .'</td>
                                      <td>'.number_format($view->mloan_amt,2,'.',',') .'</td>
                                      <td>'.number_format($view->total_deducate,2,'.',',') .'</td>     
                                      <td>'.number_format($view->net_pay,2,'.',',')  .'</td>
                                      <td>'.number_format($view->er_cpf,2,'.',',') .'</td>
                                      <td>'.number_format($view->sdl,2,'.',',') .'</td>
                                      <td>'.number_format($view->cpf_broad,2,'.',',').'</td>                                   
                                    </tr>';
                                    }
                                    }
                                  $html.='</tbody>                                  
                                </table>';

                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }

					 public static function BankPrintPdf($salary,$date,$company) {
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>
                                   <tr>
                                      <th colspan="4">Bank/Cheque Report</th>
                                   </tr>
                                    <tr width="100%">
                                     
                                       <th>EID</th>
                                      <th>Employee Name</th>
                                      <th>Bank / Cheque No</th>
                                      <th style="width:15%;">Amount</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>';
                                           
									 $total = 0.00;
                                   	 $i = 0;
                                  
                                  if(!empty($salary))
                                  {   
	                                   foreach($salary as $view)
	                                   { 	                                  
	                                      $total += $view->net_pay;
	                                      $i++;									  		                   
	                                   
	                                    $html.='<tr>                                     
	                                      <td>'.ucwords($view->employee_id).'</td>
	                                      <td>'.ucwords($view->emp_name).'</td>
	                                      <td></td>
	                                      <td>'.number_format($view->net_pay,2).'</td>                                                                   
	                                    </tr>';  
										 
	                                    }            
                                    }
								  
                                  $html.='</tbody>    
                                   
                                     <tfoot>
                                    <tr>
                                     <td colspan="3" style="text-align:right;"><strong>Total of('.$i.')</strong></td>
                                     <td style="text-align:right;">'.number_format($total,2).'</td>
                                    </tr>
                                  </tfoot>                             
                                </table>';

                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }
	
					 public static function CpfPrintPdf($salary,$previousCpf,$date) {
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>
                                   <tr>
                                      <th colspan="7">CPF Report</th>
                                   </tr>
                                    <tr width="100%">
                                     
                                        <th>EID</th>
                                      <th>Employee Name</th>
                                      <th>NRIC No</th>
                                      <th>Employee Status</th>
                                      <th>Last CPF CPF Wage</th>
                                      <th>CPF Wage</th>
                                      <th>Total CPF</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>';
                                           
									  $last_cpf  = 0.00;
                                    $total_cpf = 0.00;
                                    $total_sdl = 0.00;
                                    $total_levy = 0.00;
                                    $cpf_wages = 0.00;
                                    $total_prev_cpf = 0.00;
                                    $i = 0;
                                    $current_month = date('m-Y',strtotime($date));
                                  
                                  if(!empty($salary))
                                  {   
	                                   foreach($salary as $view)
	                                   { 	                                  
	                                      $prev_cpf = 0.00;

	                                      if(array_key_exists($view->fkEmpId, $previousCpf)) {
	                                        $prev_cpf = $previousCpf[$view->fkEmpId];
	                                        $total_prev_cpf += $prev_cpf;
	                                      }
	
	                                      $status = '';
	                                      $cessation_month = '';
	                                      $hire_month      = date('m-Y',strtotime($view->hire_date));
	                                      if($view->cessation_date!=0) {
	                                        $cessation_month = date('m-Y',strtotime($view->cessation_date));
	                                      }
	                                      if($hire_month==$current_month && $hire_month!=$cessation_month) {
	                                        $status = 'New';
	                                      } else if($hire_month==$current_month && $hire_month==$cessation_month) {
	                                        $status = 'New & Resigned';
	                                      } else if($hire_month!=$current_month && $current_month==$cessation_month) {
	                                        $status = 'Resigned';
	                                      } else if($hire_month!=$current_month && empty($cessation_month)) {
	                                        $status = 'Existing';
	                                      }
	                                      $cpf_wages += $view->cpf_wages;
	                                      $cpfs       = ($view->ee_cpf + $view->er_cpf);
	                                      $total_cpf += $cpfs;
	                                      $total_sdl += $view->sdl;
	                                      $total_levy+= $view->levy;
	                                      $i++;
									  
	                                    $html.='<tr>                                     
	                                      <td>'.ucwords($view->employee_id).'</td>
	                                      <td>'.ucwords($view->emp_name).'</td>
	                                      <td>'.ucwords($view->nric_fin_no).'</td>
	                                      <td>'.$status.'</td>     
	                                      <td style="text-align:right;">'.number_format($prev_cpf,2).'</td>
                                   		  <td style="text-align:right;">'.number_format($view->cpf_wages,2).'</td>
                                     	  <td style="text-align:right;">'.number_format($cpfs,2).'</td>                                                              
	                                    </tr>';  
										 
	                                    }            
                                    }
								  
                                  $html.='</tbody>    
                                   
                                      <tfoot>
                                    <tr>
                                     <td colspan="4" style="text-align:right;"><strong>Total of ('.$i.')</strong></td>
                                     <td style="text-align:right;">'.number_format($total_prev_cpf,2).'</td>
                                     <td style="text-align:right;">'.number_format($cpf_wages,2).'</td>
                                     <td style="text-align:right;">'.number_format($total_cpf,2).'</td>
                                    </tr>
                                  </tfoot>                          
                                </table>';
								
								$html.='<div class="row" style="margin-top:10px;">
									      <div class="col-sm-4">
									                  <table  border="1" border-collapse="collapse" style="margin-bottom:0; width:30%;">
									                    <thead>
									                      <tr>
									                        <th colspan="2">CPF Summary</th>
									                      </tr>
									                    </thead>';
									                    $total_cpf_board = 0.00;
									                    $total_cpf_board += $total_cpf+floor($total_sdl)+$total_levy;
														
									                   $html.='<tr>
									                        <td><strong>CPF</strong></td>
									                        <td style="text-align:right;">'.number_format($total_cpf,2).'</td>
									                      </tr>
									                      <tr>
									                        <td><strong>SDL</strong></td>
									                        <td style="text-align:right;">'.number_format(floor($total_sdl),2).'</td>
									                      </tr>
									                      <tr>
									                        <td><strong>LEVY</strong></td>
									                        <td style="text-align:right;">'.number_format($total_levy,2).'</td>
									                      </tr>
									                      <tr>
									                        <td><strong>Total CPF Board</strong></td>
									                        <td style="text-align:right;">'.number_format($total_cpf_board,2).'</td>
									                      </tr>									
									                  </table>								                                          
									      </div>
									      </div>';							
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }

					public static function IncomeTaxPrintPdf($salary,$date,$cProcessMonth,$employees,$emp) {
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>
                                   <tr>
                                      <th colspan="7">Bank/Cheque Report</th>
                                   </tr>
                                    <tr width="100%">
                                     
                                       <th>EID</th>
                                      <th>Employee Name</th>
                                      <th>Nric</th>
                                      <th>Salary & Wages Paid</th>
                                      <th>Commission Paid</th>
                                      <th>Commission Period</th>
                                      <th>CPF EE</th>
                                    </tr>
                                  </thead>
                                  <tbody>';
                                           
									$total_wage = 0.00;
                                    $total_comm = 0.00;
                                    $total_cpf  = 0.00;
                                    $i = 0;
                                    $from_date  = '01-01-'.date('Y');
                                    $from_date  = date('d-m-Y',strtotime($from_date. '-1 month'));
                                  
                                  if(!empty($salary))
                                  {   
	                                   foreach($salary as $view)
	                                   { 	                                  
	                                      $salary_wage = 0.00;
	                                      $salary_wage = $view->gross_pay - $view->commission_pay;
	                                      $total_wage += $salary_wage;
	                                      $total_comm += $view->commission_pay;
	                                      $total_cpf  += $view->cpf;
	                                      $i++;
	                                      $commission_period = $from_date." to ".date('t-m-Y',strtotime($view->salary_from_date.'-1 month'));							  		                   
	                                   
	                                    $html.='<tr>                                     
	                                      <td>'.ucwords($view->employee_id).'</td>
	                                      <td>'.ucwords($view->emp_name).'</td>
	                                      <td>'.ucwords($view->nric_fin_no).'</td>
	                                      <td style="text-align:right;">'.number_format($salary_wage,2).'</td>
	                                     <td style="text-align:right;">'.number_format($view->commission_pay,2).'</td>
	                                     <td>.'.$commission_period.'</td>
	                                     <td style="text-align:right;">'.number_format($view->cpf,2).'</td>                                                                   
	                                    </tr>';  
										 
	                                    }            
                                    }
								  
                                  $html.='</tbody>    
                                   
                                     <tfoot>
                                    <tr>
                                     <td colspan="3" style="text-align:right;"><strong>Total</strong></td>
                                     <td style="text-align:right;">'.number_format($total_wage,2).'</td>
                                     <td style="text-align:right;">'.number_format($total_comm,2).'</td>
                                     <td style="text-align:right;"></td>
                                     <td style="text-align:right;">'.number_format($total_cpf,2).'</td>
                                    </tr>
                                  </tfoot>                            
                                </table>';

                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }
                
	
				public static function LeavePrintPdf($branches,$branchArray,$leaveList,$employees,$allEmp,$leaveSummaryList,$emp_array,$br,$emp,$to_month,$to_date){
         				                                  
                                    $basePublic = Config::get('local.basePublic');
					$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
                                      
  									<div class="content-wrapper" style="height:auto;">                                       
									  <div class="col-sm-6">
                                          <span><strong>Lv/Yr: </strong>Leave per Year</span>&nbsp;&nbsp;|&nbsp;&nbsp;<span><strong>Lv/Tk: </strong>Leave Taken</span>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>Bal: </strong>Balance Leave</span>
                                      </div>   
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                   
                                     <thead>
                                    <tr>
                                      <th width="5%">Employee Id</th>
                                      <th>Employee Name</th>
                                      <th width="5%">Branch Name</th>';
                                      
                                      if($leaveList)
									  {
	                                       foreach($leaveList as $lv)
										   {
	                                        	list($leave_type,$leave_count) = $lv;
	                                       $html.='<th width="12%" colspan="3">'.ucwords($leave_type).'</th>';
	                                       }	   
                                      }
                                      $html.='<th width="5%">Total Leave Taken</th>
                                    </tr>
                                  </thead>
                                  <tbody>';
								  
                                  if(!empty($allEmp))
								  {    
                                      $html.='<tr>
                                          <td colspan="3" align="center">Employee Details</td>';
										  
                                          if($leaveList)
										  {
                                            foreach($leaveList as $lv)
											{
                                              list($leave_type,$leave_count) = $lv;
                                              $html.='<td align="center">Lv/Yr</td>
                                              <td align="center">Lv/Tk</td>
                                              <td align="center">Bal</td>';											  
                                            }
										  }	
                                          $html.='<td align="center">Total</td>
                                      </tr>';
									  
                                   foreach($allEmp as $empInfo)
								   {
                                         //list($empId,$branch) = explode('-',$empKey); $lrCount = 0;
                                         /* if(array_key_exists($empId,$emp_array))
                                             list($eid,$empName) = $emp_array[$empId]; */  
                                          $lrCount = 0;
                                   
                                   $html.='<tr> 
                                      <td>'.$empInfo->employee_id.'</td>
                                      <td>'.ucwords($empInfo->emp_name).'</td>
                                      <td>';
                                      if(array_key_exists($empInfo->branchId,$branchArray))
									  {
                                      	$html.=$branchArray[$empInfo->branchId];
                                      }
									  else
									  {
									  	 $html.='</td>';
									  }
                                      if($leaveList)
									  {
                                            foreach($leaveList as $leaveId => $lv)
											{
                                             	list($leave_type,$leave_count) = $lv;
                                             
                                             
                                             if(array_key_exists($empInfo->id,$leaveSummaryList) && array_key_exists($leaveId,$leaveSummaryList[$empInfo->id]))
											 {
                                               if($leaveId == 7 || $leaveId == 14)
											   {
                                               $html.='<td align="center">N/A</td>
                                               <td align="center"><strong>'.$leaveSummaryList[$empInfo->id][$leaveId].'</strong></td>
                                               <td align="center">N/A</td>';
											   }
                                               else
											   { 
                                               $takenLeave = (int)round(($leave_count / 12) * $to_month) - (int)$leaveSummaryList[$empInfo->id][$leaveId];
                                               $html.='<td align="center">'.$leave_count.'</td>
                                               <td align="center"><strong>'.$leaveSummaryList[$empInfo->id][$leaveId].'</strong></td>
                                               <td align="center">'.$takenLeave.'</td>';
                                               }
                                              $lrCount = $lrCount + $leaveSummaryList[$empInfo->id][$leaveId];
                                             } 
                                             else
											 {
                                                if($leaveId == 7 || $leaveId == 14)
												{
                                                  $html.='<td align="center">N/A</td>
                                                  <td align="center">0</td>
                                                  <td align="center">N/A</td>';
												}  
                                                else
												{
                                                 $html.='<td align="center">'.$leave_count.'</td>
                                                 <td align="center">0</td>
                                                 <td align="center">'.round(($leave_count / 12) * $to_month).'</td>';   
												}
                                             }
                                            } 
                                      	 }
                                     $html.='<td align="center">'.$lrCount.'</td>
                                    </tr>';
                                      }
                                    }
                                    else
									{                                    
                                    $col = (4+(int)(sizeof($leaveList)*3));
                                  
                                    $html.='<tr>
                                        <td colspan='.$col.' align="center">No Record found</td>
                                    </tr>';
                                    }
                                  $html.='</tbody>
                                </table>';

                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							
							 return $html;
                }

				public static function BalanceSheetPrintPdf($coa,$glAccount,$glRoll,$from,$to) {
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>
                                   <tr>
                                      <th colspan="2">Balance Sheet Report</th>
                                   </tr>
                                    <tr width="100%">                                     
                                        <th width="80%">Particulars</th>
                               			 <th width="20%" style="text-align:center;">Amount</th>
                                    </tr>
                                  </thead>
                                  <tbody>';
                                           
									$level1 = array();
	                              $level2 = array();
	                              $level3 = array();
	                              $total_debit       = 0.00;
	                              $total_credit      = 0.00;
	                              $total_assets      = 0.00;
	                              $total_liabilities = 0.00;
								  
                                  if(!empty($coa))
                                  {   
	                                   foreach($coa as $view)
	                                   {
	                                   	 if($view->l1id==1 || $view->l1id==2) 
										 {
										 	  if(!array_key_exists($view->l1id, $level1))
											  {
	                              				  if($view->l1id==2) 
	                              				  {
	                              				  	
														$html.='<tr>
						                                <td class="amount-align"><strong style="font-size:15px;">Total Assets</strong></td>
						                                <td class="amount-align">';
						                                  if($total_assets<0)
														  {
						                                    $html.='('.number_format(abs($total_assets),2).')';
														  }
						                                  else
														  {	
						                                    $html.=number_format($total_assets,2);
														  }
						                                $html.='</td>
						                              </tr>';
												  
											 	 	 }
                                 			 	$level1[$view->l1id] = $view->level1_name;                             
	                                       		
												$html.='<tr> <td colspan="2"><strong style="font-size:15px;">'.ucfirst($view->level1_name).'</strong></td></tr>';				
												}	

		                                        if(!array_key_exists($view->l2id, $level2)) 
		                                        {
                                				  $level2[$view->l2id] = $view->level2_name;
												  
												  $html.='<tr><td colspan="2"><strong style="font-size:14px; margin-left:20px;">'.ucfirst($view->level2_name).'</strong></td></tr>';
												}
												
												
												  if(!array_key_exists($view->l3id, $level3))
												  {
                                  					$level3[$view->l3id] = $view->level3_name;
													
													$html.='<tr><td colspan="2"><strong style="font-size:14px; margin-left:40px;">'.ucfirst($view->level3_name).'</strong></td></tr>';
												  }	
												  
												  
												   $roll                = 0.00;
					                                $opening_balance     = 0.00;
					                                $symbol              = '';
					                                $transaction_debit   = 0.00;
					                                $transaction_credit  = 0.00;
					                                $transaction_balance = 0.00;
					                                if($view->debit_opening_balance!=0.00) {
					                                  $opening_balance += $view->debit_opening_balance;
					                                  $symbol = 'Dr';
					                                } else if($view->credit_opening_balance!=0.00) {
					                                  $opening_balance += $view->credit_opening_balance;
					                                  $symbol = 'Cr';
					                                }
					
					                                if(array_key_exists($view->id, $glRoll)) {
					                                  $roll += ($glRoll[$view->id][1] - $glRoll[$view->id][2]);
					                                }
					
					                                if(array_key_exists($view->id,$glAccount)) {
					                                  $total_debit         += $glAccount[$view->id][1];
					                                  $total_credit        += $glAccount[$view->id][2];
					                                  $transaction_debit   += $glAccount[$view->id][1];
					                                  $transaction_credit  += $glAccount[$view->id][2];
					                                  if($view->l1id==1) {
					                                    $transaction_balance += $transaction_debit-$transaction_credit; 
					                                  } else if($view->l1id==2) {
					                                    /*if($view->account_type=1) {
					                                      $transaction_balance += $transaction_debit-$transaction_credit;
					                                    } else {*/
					                                      $transaction_balance += $transaction_credit-$transaction_debit; 
					                                      //}
					                                  }
					                                }
					
					                                if($symbol=='Dr') {
					                                  if($view->l1id==1) {
					                                    $closing_balance = $transaction_balance+$opening_balance;
					                                  } else if($view->l1id==2) {
					                                    $closing_balance = $transaction_balance-$opening_balance;
					                                  }
					                                } else if($symbol=='Cr') {
					                                  if($view->l1id==1) {
					                                    $closing_balance = $transaction_balance-$opening_balance;
					                                  } else if($view->l1id==2) {
					                                    $closing_balance = $transaction_balance+$opening_balance;
					                                  }
					                                } else {
					                                  $closing_balance = $transaction_balance;
					                                }
					
					                                $closing_balance += $roll;
					
					                                if($view->l1id==1) {
					                                  $total_assets      += $closing_balance;
					                                } else if($view->l1id==2) {
					                                  $total_liabilities += $closing_balance;
					                                }
												  
												  	
												   $html.='<tr>
					                                <td><span style="margin-left:60px;">'.ucfirst($view->level4_name).'</span></td>
					                                <td class="amount-align">';
													
					                                  if($closing_balance<0)
													  {
					                                    $html.='('.number_format(abs($closing_balance),2).')';
													  }
					                                  else
													  {
					                                      $html.=number_format($closing_balance,2); 
													  }
					                                $html.='</td>
					                              </tr>';
												  
												}
										    }
												
											$html.='<tr>
				                                <td class="amount-align"><strong style="font-size:15px;">Total Liabilities</strong></td>
				                                <td class="amount-align">';
				                                  if($total_liabilities<0)
												  {
				                                      $html.='('.number_format(abs($total_liabilities),2).')';												  }
				                                  else
				                                  {
				                                      $html.=number_format($total_liabilities,2);
												  }
				                                  
				                                $html.='</td>
				                              </tr>';	
												
										  }	
								  
                                  $html.='</tbody>                                                                                        
                                </table>';
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }
			
			public static function TrialBalancePrintPdf($coa,$glAccount,$glRoll,$from,$to,$filterBy) {
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
                                      
									   <div class="box-header  blue-background"">
						                      <div class="title" style="font-size:20px;">Trial Balance</div>
						              </div>
									  
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:0;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>                                  
                                    <tr width="100%">                                     
	                                         <th width="40%">Accounts</th>';
											 
			                                if($filterBy == 1)
			                                {
			                                $html.='<th width="15%" colspan="4" style="text-align:center;">Opening Balance</th>';
											}
			                                elseif($filterBy == 2)
											{
			                                $html.='<th width="15%" colspan="3" style="text-align:center;">Debit</th>
			                                <th width="15%" style="text-align:center;">Credit</th>';
											}
			                                elseif($filterBy == 3)
											{
			                                $html.='<th width="15%" colspan="4" style="text-align:center;">Closing Balance</th>';
											}
			                                else
											{
			                                $html.='<th width="15%" style="text-align:center;">Opening Balance</th>
			                                <th width="15%" style="text-align:center;">Debit</th>
			                                <th width="15%" style="text-align:center;">Credit</th>
			                                <th width="15%" style="text-align:center;">Closing Balance</th>';
											}
			                                
                                    $html.='</tr>
                                  </thead><tbody>';
								  
                            
                              $level1 = array();
                              $level2 = array();
                              $level3 = array();
                              $total_debit = 0.00;
                              $total_credit = 0.00;
                          
                            if(!empty($coa))
							{
                            foreach($coa as $view)  
							{
                            
                                if(!array_key_exists($view->l1id, $level1))
								 {
	                                  $level1[$view->l1id] = $view->level1_name;
	                           
	                              $html.='<tr>
	                                <td colspan="5"><strong style="font-size:15px;">'.ucfirst($view->level1_name).'</strong></td>
	                              </tr>';
                            
                                }
                            

                          
                                if(!array_key_exists($view->l2id, $level2))
								 {
                                  $level2[$view->l2id] = $view->level2_name;
                            
	                              $html.='<tr>
	                                <td colspan="5"><strong style="font-size:14px; margin-left:20px;">'.ucfirst($view->level2_name).'</strong></td>
	                              </tr>';                            
                                }
                         

                            
                                if(!array_key_exists($view->l3id, $level3)) 
                                {
                                  $level3[$view->l3id] = $view->level3_name;
                              
	                              $html.='<tr>
	                                <td colspan="5"><strong style="font-size:14px; margin-left:40px;">'.ucfirst($view->level3_name).'</strong></td>
	                              </tr>';
                            
                                }
                           


                          
                              if($view->l3id==8 && $view->account_type==1 && $view->tax_status==1) {
                                if($view->tax_type==1) {
                                  $type = 'Purchase';
                                } else if($view->tax_type==2) {
                                  $type = 'Supply';
                                }
                                $account_name = $type." ".$view->level4_name." - ".$view->tax_percentage."%";
                                $opening_balance     = 0.00;
                               //$roll                = 0.00;
                                $symbol              = '';
                                $transaction_debit   = 0.00;
                                $transaction_credit  = 0.00;
                                $transaction_balance = 0.00;
                                if($view->debit_opening_balance!=0.00) {
                                  $opening_balance += $view->debit_opening_balance;
                                  $symbol = 'Dr';
                                } else if($view->credit_opening_balance!=0.00) {
                                  $opening_balance += $view->credit_opening_balance;
                                  $symbol = 'Cr';
                                }
                                if(array_key_exists($view->id, $glRoll)) {
                                  $opening_balance += ($glRoll[$view->id][1] - $glRoll[$view->id][2]);
                                  $symbol          = '3';
                                }
                                /*if(array_key_exists($view->id,$glAccount)) {
                                  $total_debit         += $glAccount[$view->id][1];
                                  $total_credit        += $glAccount[$view->id][2];
                                  $transaction_debit   += $glAccount[$view->id][1];
                                  $transaction_credit  += $glAccount[$view->id][2];
                                  $transaction_balance += $transaction_debit-$transaction_credit; 
                                }*/

                                if(array_key_exists($view->id,$glAccount)) {
                                  $total_debit         += $glAccount[$view->id][1];
                                  $total_credit        += $glAccount[$view->id][2];
                                  $transaction_debit   += $glAccount[$view->id][1];
                                  $transaction_credit  += $glAccount[$view->id][2];
                                  $transaction_balance += $transaction_debit-$transaction_credit; 
                                }

                                if($opening_balance>0) {
                                  $closing_balance = $transaction_balance+$opening_balance;
                                } else if($opening_balance<0) {
                                  $closing_balance = $transaction_balance+$opening_balance;
                                } else {
                                  $closing_balance = $transaction_balance;
                                }

                                

                               // $closing_balance += $roll;
                         
                            $html.='<tr>
                                <td><span style="margin-left:60px;">'.ucfirst($account_name).'</span></td>';
								
                                if($filterBy == 1)
								{
                                	$html.='<td colspan="4" class="amount-align">';
                                      if($opening_balance<0)
									  {
                                         $html.=number_format(abs($opening_balance),2)." Cr";
									  }
                                      else
                                      {                                      	
                                        $html.=number_format($opening_balance,2)." Dr";
									  }
                                $html.='</td>';
								}
                                elseif($filterBy == 2)
								{
                                $html.='<td colspan="3" class="amount-align">'.number_format($transaction_debit,2).'</td>
                                <td class="amount-align">'.number_format($transaction_credit,2).'</td>';
                                }
                                elseif($filterBy == 3)
                                {
                                	$html.='<td colspan="4" class="amount-align">';
									
                                    if($closing_balance<0)
									{
                                      $html.=number_format(abs($closing_balance),2)." Cr";
									}
                                    else
									{
                                      $html.=number_format($closing_balance,2)." Dr";
									}
                                $html.='</td>';
								}								
                                else
								{	
                                    $html.='<td class="amount-align">';
									
                                      if($opening_balance<0)
									  {
                                        $html.=number_format(abs($opening_balance),2)." Cr";
									  }
                                      else
									  {	
                                        $html.=number_format($opening_balance,2)." Dr";
									  }
                                      
	                                    $html.='</td>
	                                    <td class="amount-align">'.number_format($transaction_debit,2).'</td>
	                                    <td class="amount-align">'.number_format($transaction_credit,2).'</td>
	                                    <td class="amount-align">';
										
	                                    if($closing_balance<0)
										{
	                                      $html.=number_format(abs($closing_balance),2)." Cr";
										}
	                                    else
										{
	                                      $html.=number_format($closing_balance,2)." Dr";
										}
	                                    $html.='</td>';
	                              }
                            $html.='</tr>';
                          
                              } else if($view->l3id==8 && $view->account_type==1 && $view->tax_status==2) {
                                
                              }  else {
                                $opening_balance     = 0.00;
                                $symbol              = '';
                                $transaction_debit   = 0.00;
                                $transaction_credit  = 0.00;
                                $transaction_balance = 0.00;
                                if($view->debit_opening_balance!=0.00) {
                                  $opening_balance += $view->debit_opening_balance;
                                  $symbol = 'Dr';
                                } else if($view->credit_opening_balance!=0.00) {
                                  $opening_balance += $view->credit_opening_balance;
                                  $symbol = 'Cr';
                                }
                                if(array_key_exists($view->id, $glRoll)) {
                                  $opening_balance += ($glRoll[$view->id][1] - $glRoll[$view->id][2]);
                                  $symbol          = '3';
                                }
                                if(array_key_exists($view->id,$glAccount)) {
                                  $total_debit         += $glAccount[$view->id][1];
                                  $total_credit        += $glAccount[$view->id][2];
                                  $transaction_debit   += $glAccount[$view->id][1];
                                  $transaction_credit  += $glAccount[$view->id][2];
                                  $transaction_balance += $transaction_debit-$transaction_credit; 
                                }

                                if($opening_balance>0) {
                                  $closing_balance = $transaction_balance+$opening_balance;
                                } else if($opening_balance<0) {
                                  $closing_balance = $transaction_balance+$opening_balance;
                                } else {
                                  $closing_balance = $transaction_balance;
                                }

                               // echo $opening_balance.'<br/>';
                               
                              $html.='<tr>
                                <td><span style="margin-left:60px;">'.ucfirst($view->level4_name).'</span></td>';
								
                                if($filterBy == 1)
								{
                                	$html.='<td colspan="4" class="amount-align">';
									
                                  if($opening_balance<0)
								  {
                                  $html.=number_format(abs($opening_balance),2)." Cr";
								  }
                                  else
								  {
                                    $html.=number_format($opening_balance,2)." Dr";
								  }
								  $html.='</td>';
								}                     
								
                                else if($filterBy == 2)
								{
                                $html.='<td colspan="3" class="amount-align">'.number_format($transaction_debit,2).'</td>
                                <td class="amount-align">'.number_format($transaction_credit,2).'</td>';
								}
                                else if($filterBy == 3)
								{
	                                $html.='<td colspan="4" class="amount-align">';
									
	                                if($closing_balance<0)
									{
	                                  $html.=number_format(abs($closing_balance),2)." Cr" ;
									}
	                                else
									{
	                                  $html.=number_format($closing_balance,2)." Dr";
									}
	
	                                $html.='</td>';
								}								
                                else
								{
	                                $html.='<td class="amount-align">';
	                                
	                                  if($opening_balance<0)
									  {
	                                   $html.=number_format(abs($opening_balance),2)." Cr";
									  }
	                                  else
									  {	
	                                    $html.=number_format($opening_balance,2)." Dr";
									  }
	                                  
	                                $html.='</td>
	                                <td class="amount-align">'.number_format($transaction_debit,2).'</td>
	                                <td class="amount-align">'.number_format($transaction_credit,2).'</td>
	                                <td class="amount-align">';
									
	                                if($closing_balance<0)
	                                {
	                                  $html.=number_format(abs($closing_balance),2)." Cr";
									}
	                                else
									{
	                                  $html.=number_format($closing_balance,2)." Dr";
									}
	                                
	                                $html.='</td>';
                                }
	                              $html.='</tr>';
	                              	}
                              	}                            
                              }
                            $html.='</tbody>
                            <tfoot>
                              <tr>';
                                if($filterBy == 2)
								{
                                $html.='<td colspan="3" class="amount-align"><strong>Total</strong></td>
                                <td class="amount-align">'.number_format($total_debit,2).'</td>
                                <td class="amount-align">'.number_format($total_credit,2).'</td>';
								}
                                elseif($filterBy == 0 || $filterBy == '')
								{
                                $html.='<td class="amount-align"><strong>Total</strong></td>
                                <td></td>
                                <td class="amount-align">'.number_format($total_debit,2).'</td>
                                <td class="amount-align">'.number_format($total_credit,2).'</td>
                                <td></td>';
								}
                              $html.='</tr>
                            </tfoot>                                                                   
                                </table>';
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }
			
				public static function AccountTransPrintPdf($coa,$glAccount,$glRoll,$from,$to,$account,$accId) {
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>
                                   <tr>
                                      <th colspan="8">Account Transaction</th>
                                   </tr>
                                  
                                  </thead>
                         <tbody>';
						 
                            if(!empty($coa) && !empty($accId))
							{
								
                            foreach($coa as $gl) 
							{
                              if($gl->id==$accId)
							  {
                              $html.='<tr>
                                <th colspan="8" style="text-align:center;">
                                  <strong style="font-size:16px;">'.ucwords($gl->level4_name).'</strong>
                                </th>
                              </tr>

                              <tr>

                                <th width="10%">Date</th>
                                <th width="15%">Description</th>
                                <th width="15%">Counterparties</th>
                                <th width="15%">Type</th>
                                <th width="15%">Vch No.</th>
                                <th width="10%" style="text-align:center;">Debit</th>
                                <th width="10%" style="text-align:center;">Credit</th>
                                <th width="10%" style="text-align:center;">Balance</th>

                              </tr>';

                             
                                $opening_balance = 0.00;
                                $balance = 0.00;
                                $symbol  = '';
                                if($gl->debit_opening_balance!=0.00) {
                                  $opening_balance = $gl->debit_opening_balance;
                                  $balance        += $gl->debit_opening_balance;
                                  $symbol          = '1';
                                } else if($gl->credit_opening_balance!=0.00) {
                                  $opening_balance = $gl->credit_opening_balance;
                                  $balance        -= $gl->credit_opening_balance;
                                  $symbol          = '2';
                                }
                                if(array_key_exists($gl->id, $glRoll)) {
                                  $opening_balance += ($glRoll[$gl->id][1] - $glRoll[$gl->id][2]);
                                  $balance         += ($glRoll[$gl->id][1] - $glRoll[$gl->id][2]);
                                  $symbol          = '3';
                                }
                             

                             
                                if($symbol!='')
								 {
                             

                              $html.='<tr>
                                <td></td>
                                <td>Opening Balance</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="amount-align">';
								
                                  if($opening_balance>0)
								  { 
                                    $html.=number_format($opening_balance,2);
                                  }
                                $html.='</td>
                                <td class="amount-align">';
								
                                  if($opening_balance<0)
								  { 
                                    $html.=number_format(abs($opening_balance),2);
                                  }
                                $html.='</td>
                                <td class="amount-align">';
								
                                  if($balance<0)
								  {
                                    $html.=number_format(abs($balance),2)." Cr ";
								  }
                                  else
								  {
                                    $html.=number_format($balance,2)." Dr ";
                                  }
                                $html.='</td>
                              </tr>';
							  
                              }
                      

  	                          if(array_key_exists($gl->id,$glAccount))
							  {
                              foreach($glAccount as $key => $account)
							  {
                              if($key==$gl->id)
							  {
                               //if($key==28) { echo '<pre>'; print_r($account); echo '</pre>'; die(); }
                              foreach($account as $view)
							  {
                          
                                
                                if($view['1']!=0.00)
								 {
                                  $balance += $view['1'];
                                }
                                if($view['2']!=0.00)
								 {
                                  $balance -= $view['2'];
                                }
                         

                              $html.='<tr>
                                <td>'.$view["date"].'</td>
                                <td>'.$view["description"].'</td>
                                <td>'.$view["parties"].'</td>
                                <td>'.$view["type"].'</td>
                                <td>'.$view['no'].'</td>
                                <td class="amount-align">'
                                    .number_format($view['1'],2).
                                '</td>
                                <td class="amount-align">'
                                     .number_format($view['2'],2).
                                '</td>
                                <td class="amount-align">';
                                  if($balance<0)
								  {
                                    $html.=number_format(abs($balance),2)." Cr ";
								  }
                                  else
                                  {
                                    $html.=number_format($balance,2)." Dr ";
								  }
                                $html.='</td>
                              </tr>';



									}	 
                              	}
                           	 } 
                           }

                         }
                       }
                       }
                            else
							{
                              $html.='<tr>
                                <td align="center">No Record Found</td>
                              </tr>';
                            }   
								  
                                  $html.='</tbody>                                                                                        
                                </table>';
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }
			
					public static function PayablePrintPdf($payables,$from,$to_date){
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:20;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                  <thead>
                                   <tr>
                                      <th colspan="2">Account Transaction</th>
                                   </tr>
                                  
                                  </thead>
                         
						 
                         		<tr>

                                <th width="50%">Vendor Name</th>
                                <th width="50%" style="text-align:center;">Total Payables</th>

                              </tr>
                            <tbody>';
                           
                              $total_payable = 0.00;
                         
                            if(!empty($payables))
                            {
                            foreach($payables as $payable)
							{ 

                           
                              $total_payable += $payable['amount'];
                           

                              $html.='<tr>
                                <td>'.ucwords($payable["name"]).'</a></td>
                                <td style="text-align:right;">';
                                
                                  if($payable['amount']<0)
								  {
                                    $html.=number_format(abs($payable['amount']),2);
                                  }
                                  else
								  { 
                                    $html.=number_format($payable['amount'],2);
                                    }
                                $html.='</td>
                              </tr>';
                              
                            }
							}   
                            $html.='<tr>
                              <td style="text-align:right;"><strong>Overall Total</strong></td>
                              <td style="text-align:right;">';
							  
                                 if($total_payable<0)
								 {
                                    $html.=number_format(abs($total_payable),2);
								 }
                                  else
                                  { 
                                    $html.=number_format($total_payable,2);
								  }
								  
                              $html.='</td>
                            </tr>';                     
                            
                                  $html.='</tbody>                                                                                        
                                </table>';
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }
			
			public static function IncomePdf($coa,$glAccount,$from,$to,$branch,$brId,$hqTotal){
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
                                       <div class="box-header  blue-background">
				                      <div class="title" style="font-size:20px;">Income Statement</div>
				                    
				                    </div>
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:0;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                
						   		<thead>
                                                    <tr>

                                <th width="80%">Particulars</th>
                                <th width="20%" style="text-align:center;">Amount</th>

                              </tr>
                            </thead>
                            <tbody>';
							
                            
                              $level1 = array();
                              $level2 = array();
                              $level3 = array();
                              $total_debit   = 0.00;
                              $total_credit  = 0.00;
                              $total_income  = 0.00;
                              $total_expense = 0.00;
                              $total_hq      = 0.00;
                           
                            if(!empty($coa))
							{
                            foreach($coa as $view)  
							{
                            if($view->l1id==3 || $view->l1id==4) 
							{
                            
                                if(!array_key_exists($view->l1id, $level1))
								 {
                                if($view->l1id==4)
                                 {
                          
                             $html.='<tr>
                                <td class="amount-align"><strong style="font-size:15px;">Total Income</strong></td>
                                <td class="amount-align">';
								
                                  if($total_income<0)
								  {
                                     $html.='('.number_format(abs($total_income),2).')';
								  }
                                  else
								  {
                                    $html.=number_format($total_income,2);
								  }
                               $html.='</td>
                              </tr>';
                           
                                  }
                                  $level1[$view->l1id] = $view->level1_name;
                         
                              $html.='<tr>
                                <td colspan="2"><strong style="font-size:15px;">'.ucfirst($view->level1_name).'</strong></td>
                              </tr>';
                           
                                }

                                if(!array_key_exists($view->l2id, $level2))
								 {
                                  $level2[$view->l2id] = $view->level2_name;
                              
                              $html.='<tr>
                                <td colspan="2"><strong style="font-size:14px; margin-left:20px;">'.ucfirst($view->level2_name).'</strong></td>
                              </tr>';
                            
                                }
                            

                            
                                if(!array_key_exists($view->l3id, $level3)) {
                                  $level3[$view->l3id] = $view->level3_name;
                              
                              $html.='<tr>
                                <td colspan="2"><strong style="font-size:14px; margin-left:40px;">'.ucfirst($view->level3_name).'</strong></td>
                              </tr>';
                            
                                }
                           

                           
                             /* $total_debit  += $view->debit_opening_balance;
                              $total_credit += $view->credit_opening_balance;*/
                           

                                $opening_balance     = 0.00;
                                $symbol              = '';
                                $transaction_debit   = 0.00;
                                $transaction_credit  = 0.00;
                                $transaction_balance = 0.00;
                                if($view->debit_opening_balance!=0.00) {
                                  $opening_balance += $view->debit_opening_balance;
                                  $symbol = 'Dr';
                                } else if($view->credit_opening_balance!=0.00) {
                                  $opening_balance += $view->credit_opening_balance;
                                  $symbol = 'Cr';
                                }
                                if(array_key_exists($view->id,$glAccount)) {
                                  $total_debit         += $glAccount[$view->id][1];
                                  $total_credit        += $glAccount[$view->id][2];
                                  $transaction_debit   += $glAccount[$view->id][1];
                                  $transaction_credit  += $glAccount[$view->id][2];
                                  if($view->l1id==3) {
                                    $transaction_balance += $transaction_credit-$transaction_debit; 
                                  } else if($view->l1id==4) {
                                    $transaction_balance += $transaction_debit-$transaction_credit; 
                                  }
                                }

                                if($symbol=='Dr') {
                                  $closing_balance = $transaction_balance+$opening_balance;
                                } else if($symbol=='Cr') {
                                  $closing_balance = $transaction_balance-$opening_balance;
                                } else {
                                  $closing_balance = $transaction_balance;
                                }
                                if($view->l1id==3) {
                                  $total_income  += $closing_balance;
                                } else if($view->l1id==4) {
                                  $total_expense += $closing_balance;
                                }
                         
                              $html.='<tr>
                                <td><span style="margin-left:60px;">'.ucfirst($view->level4_name).'</span></td>
                                <td class="amount-align">';
								
                                  if($closing_balance<0)
								  {
                                    $html.='('.number_format(abs($closing_balance),2).')';
								  }
                                  else
								  {
                                    $html.=number_format($closing_balance,2);
                                  }
                                $html.='</td>
                              </tr>';

                              }
                              }
                              $html.='<tr>
                                <td class="amount-align"><strong style="font-size:15px;">Total Expense</strong></td>
                                <td class="amount-align">';
								
                                  if($total_expense<0)
								  {
                                    $html.='('.number_format(abs($total_expense),2).')';
								  }
                                  else
								  {
                                    $html.=number_format($total_expense,2);
                                  }
								  
                                $html.='</td>
                              </tr>';
							  
                              if($brId!=4 && $brId!='')
							  {
                              $html.='<tr>
                                <td class="amount-align"><strong style="font-size:15px;">Total HQ</strong></td>
                                <td class="amount-align">';
								
                                
                                  $total_hq = $hqTotal;
                                
                                  if($total_hq<0)
								  {
                                    $html.='('.number_format(abs($total_hq),2).')';
								  }	
                                  else
								  {
                                    $html.=number_format($total_hq,2);
                                  }
                                $html.='</td>
                              </tr>';

                              }
							  
                              $html.='<tr>
                                <td><strong style="font-size:15px;">Total Profit</strong></td>
                                <td class="amount-align">';
								
                                
                                  $total = $total_income-($total_expense+$total_hq);
                                
                                  if($total<0)
								  {
                                    $html.='('.number_format(abs($total),2).')';
								  }
                                  else
								  {
                                    $html.=number_format($total,2);
                                  }
                                $html.='</td>
                              </tr>';
                            }
                                  $html.='</tbody>                                                                                        
                                </table>';
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }
			
			public static function GeneralLedgerPrintPdf($coa,$glAccount,$from,$to,$glRoll){
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
                                       <div class="box-header  blue-background">
				                      <div class="title" style="font-size:20px;">General Ledger</div>
				                    
				                    </div>
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:0;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                						   		
                            <tbody>';
							
                            if(!empty($coa))
                            {
                            foreach($coa as $gl) 
							{

                              $html.='<tr>
                                <th colspan="8" style="text-align:center;">
                                  <strong style="font-size:16px;">'.ucwords($gl->level4_name).'</strong>
                                </th>
                              </tr>

                              <tr>

                                <th width="10%">Date</th>
                                <th width="15%">Description</th>
                                <th width="15%">Counterparties</th>
                                <th width="15%">Type</th>
                                <th width="15%">Vch No.</th>
                                <th width="10%" style="text-align:center;">Debit</th>
                                <th width="10%" style="text-align:center;">Credit</th>
                                <th width="10%" style="text-align:center;">Balance</th>

                              </tr>';

                             
                                $opening_balance = 0.00;
                                $balance = 0.00;
                                $symbol  = '';
                                if($gl->debit_opening_balance!=0.00) {
                                  $opening_balance = $gl->debit_opening_balance;
                                  $balance        += $gl->debit_opening_balance;
                                  $symbol          = '1';
                                } else if($gl->credit_opening_balance!=0.00) {
                                  $opening_balance = $gl->credit_opening_balance;
                                  $balance        -= $gl->credit_opening_balance;
                                  $symbol          = '2';
                                }
                                if(array_key_exists($gl->id, $glRoll)) {
                                  $opening_balance += ($glRoll[$gl->id][1] - $glRoll[$gl->id][2]);
                                  $balance         += ($glRoll[$gl->id][1] - $glRoll[$gl->id][2]);
                                  $symbol          = '3';
                                }
                             

                             
                                if($symbol!='') {
                            
                              $html.='<tr>
                                <td></td>
                                <td>Opening Balance</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="amount-align">';
								
                                  if($opening_balance>0)
								  { 
                                    $html.=number_format($opening_balance,2);
                                  }
                                $html.='</td>
                                <td class="amount-align">';
								
                                  if($opening_balance<0)
								  { 
                                    $html.=number_format(abs($opening_balance),2);
                                  }
                                $html.='</td>
                                <td class="amount-align">';
                                  if($balance<0)
								  {
                                    $html.=number_format(abs($balance),2)." Cr ";
								  }
                                  else
								  {
                                    $html.=number_format($balance,2)." Dr "; 
                                  }
                                $html.='</td>
                              </tr>';

                            
                              }
                         

                            if(array_key_exists($gl->id,$glAccount))
							{
                              foreach($glAccount as $key => $account)
							 {
   	                           if($key==$gl->id)
							   {
                              //if($key==28) { echo '<pre>'; print_r($account); echo '</pre>'; die(); }
                              foreach($account as $view)
							  {
                              
                                
                                if($view['1']!=0.00) {
                                  $balance += $view['1'];
                                }
                                if($view['2']!=0.00) {
                                  $balance -= $view['2'];
                                }
                            
                              $html.='<tr>
                                <td>'.$view["date"].'</td>
                                <td>'.$view["description"].'</td>
                                <td>'.$view["parties"].'</td>
                                <td>'.$view["type"].'</td>
                                <td>'.$view["no"].'</td>
                                <td class="amount-align">'.number_format($view["1"],2).'</td>
                                <td class="amount-align">'.number_format($view["2"],2).'</td><td class="amount-align">';
								
                                  if($balance<0)
								  {
                                    $html.=number_format(abs($balance),2).'Cr';
								  }
                                  else
								  {
                                    $html.=number_format($balance,2).'Dr';
								  }
                                 
                                $html.='</td>
                              </tr>';

								}
								}
								}
								}
								}
								}
								
                                  $html.='</tbody>                                                                                        
                                </table>';
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }
			
			public static function ReceivablesPrintPdf($invoice_info,$invoice_date){
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
                                       <div class="box-header  blue-background">
				                      <div class="title" style="font-size:20px;">Receivables</div>
				                    
				                    </div>
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:0;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                                		
									 <thead>
                                    <tr width="30%">
                                      <th>Customer Name</th>
                                     
                                      <th style="text-align:right;">0 - 30</th>
                                      <th style="text-align:right;">30 - 60</th>
                                      <th style="text-align:right;">60 - 90</th>
                                      <th style="text-align:right;">90 - 120</th>
                                      <th style="text-align:right;">> 120</th>
                                       <th style="text-align:right;">Total</th>
                                    </tr>
                                  </thead>	
														   		
                            <tbody>';
							
                             
                                
                                    $amount_due = 0.00;
                                    $r_0      = 0.00;
                                    $r_30     = 0.00;
                                    $r_60     = 0.00;
                                    $r_90     = 0.00;
                                    $r_120    = 0.00;
                                    $p_total  = 0.00;
                                 
                                  if(!empty($invoice_info))
                                  {   
                                   foreach($invoice_info as $cl)
								   {
                                    $totatl_amount = $receipt_amt = $total = 0.00;
									
                                    $html.='<tr>';
                                        foreach($cl as $view)
										{
                                       
                                         $range1 = $range30 = $range60 = $range90  = $range120 = 0.00 ;
                                         if($view['pdays'] <= 30){
                                             $totatl_amount += $view['total_amount'];
                                             $receipt_amt   += $view['receipt_amt'];
                                             $range1 =  $totatl_amount - $receipt_amt;
                                         } elseif($view['pdays'] > 30 && $view['pdays'] <= 60){
                                             $totatl_amount += $view['total_amount'];
                                             $receipt_amt   += $view['receipt_amt'];
                                             $range30 = $totatl_amount  - $receipt_amt;
                                         } elseif($view['pdays'] > 60 && $view['pdays'] <= 90){
                                             $totatl_amount += $view['total_amount'];
                                             $receipt_amt   += $view['receipt_amt'];
                                             $range60        = $totatl_amount - $receipt_amt;
                                         } elseif($view['pdays'] > 90 && $view['pdays'] <= 90){
                                             $totatl_amount += $view['total_amount'];
                                             $receipt_amt   += $view['receipt_amt'];
                                             $range90        = $totatl_amount - $receipt_amt;
                                         } elseif($view['pdays'] > 120){
                                             $totatl_amount += $view['total_amount'];
                                             $receipt_amt   += $view['receipt_amt'];
                                             $range120 = $totatl_amount - $receipt_amt;
                                         } 
                                      
                                      }
                                      $html.='<td>';
									  
                                      if($view["fkcustomer_id"] != 0)
									  {
                                       $html.=ucwords($view["customer_name"]);
									  }
									  else{
									  	
									  $html.=ucwords($view["cus_name"]);
									  }
									  $html.='</td>
                                    
                                      <td align="right">'.number_format($range1,2,".",",").'</td>
                                      <td align="right">'.number_format($range30,2,".",",").'</td>
                                      <td align="right">'.number_format($range60,2,".",",").'</td>
                                      <td align="right">'.number_format($range90,2,".",",").'</td>
                                      <td align="right">'.number_format($range120,2,".",",").'</td>';
                                      $total = $range1 + $range30 + $range60 + $range90 + $range120; 
                                       $html.='<td align="right">'.number_format($total,2,".",",").'</td>
                                      
                                     </tr>';
                                     
                                       $amount_due += $totatl_amount;
                                       $r_0  += $range1;
                                       $r_30 += $range30;
                                       $r_60 += $range60;
                                       $r_90 += $range90;
                                       $r_120 += $range120;
                                       $p_total += $total;
                                    
                                 }
								}
                                  $html.='</tbody>
                                  <tfoot>
                                    <tr>
                                      <th>Total</th>
                                      
                                      <th style="text-align:right;">'.number_format($r_0,2,".",",").'</th>
                                      <th style="text-align:right;">'.number_format($r_30,2,".",",").'</th>
                                      <th style="text-align:right;">'.number_format($r_60,2,".",",").'</th>
                                      <th style="text-align:right;">'.number_format($r_90,2,".",",").'</th>
                                      <th style="text-align:right;">'.number_format($r_120,2,".",",").'</th>
                                      <th style="text-align:right;">'.number_format($p_total,2,".",",").'</th>
                                    </tr>
                                  </tfoot>';	                      
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }

					public static function SalesTaxPrintPdf($coa,$glSupply,$glPurchase,$from,$to){
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
                                       <div class="box-header  blue-background">
				                      <div class="title" style="font-size:20px;">SalesTax</div>
				                    
				                    </div>
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border="1" border-collapse="collapse" style="margin-top:0;margin-bottom:20; width:100%;" cellpadding="0" cellspacing="0">
                               
							   <thead>
                              <tr>

                                <th width="60%">Particulars</th>
                                <th width="20%" style="text-align:center;">Base Amount</th>
                                <th width="20%" style="text-align:center;">Tax Amount</th>

                              </tr>
                            </thead>
                            <tbody>';
							
                          
                                $supply_balance   = 0.00;
                                $purchase_balance = 0.00;
                         
                              $html.='<tr>
                                <td><strong>Sales Tax Supply</strong></td>
                                <td></td>
                                <td></td>
                              </tr>';							  
                              
                            if(!empty($coa))
							{
                            foreach($coa as $view) 
							{
                              foreach($glSupply as $key => $supply)
							  {
                                if($key==$view->id)
                                {    
                               
                                    $balance = 0.00;
                                    if($view->debit_opening_balance!=0.00) {
                                      $balance += $view->debit_opening_balance;
                                    } else if($view->credit_opening_balance!=0.00) {
                                      $balance -= $view->credit_opening_balance;
                                    }

                                    $balance -= $supply[1];
                                    $balance += $supply[2];

                                    $supply_balance += $balance;

                                  $html.='<tr>
                                    <td>'.ucwords($view->level4_name).'</td>
                                    <td class="amount-align">'.number_format($supply['total'],2).'</td>
                                    <td class="amount-align">';
									
                                      if($balance<0)
									  {
                                        $html.='('.number_format(abs($balance),2).')';
									  }
                                      else
									  {
                                        $html.=number_format($balance,2);
									  }	
                                      
                                    $html.='</td>
                                  </tr>';
                                  }
                                 }
                                 }
                                 }
                              $html.='<tr>
                                <td><strong style="margin-left:15px;">Total Supply Tax</strong></td>
                                <td></td>
                                <td class="amount-align">';
								
                                      if($supply_balance<0)
									  {
                                        $html.='('.number_format(abs($supply_balance),2).')';
									  }
                                      else
									  {
                                        $html.=number_format($supply_balance,2);
                                      }
                                $html.='</td>
                              </tr>
                              <tr>
                                <td><strong>Sales Tax Purchase</strong></td>
                                <td></td>
                                <td></td>
                              </tr>';

                            if(!empty($coa))
							{
                             foreach($coa as $view) 
							 {
                               foreach($glPurchase as $key => $purchase)
							   {
                                if($key==$view->id)
                                {    
                                
                                    $balance = 0.00;
                                    if($view->debit_opening_balance!=0.00) {
                                      $balance += $view->debit_opening_balance;
                                    } else if($view->credit_opening_balance!=0.00) {
                                      $balance -= $view->credit_opening_balance;
                                    }

                                    $balance += $purchase[1];
                                    $balance -= $purchase[2];

                                    $purchase_balance += $balance;

                                  $html.='<tr>
                                    <td>'.ucwords($view->level4_name).'</td>
                                    <td class="amount-align">'.number_format($purchase['total'],2).'</td>
                                    <td class="amount-align">';
									
                                      if($balance<0)
									  {
                                        $html.='('.number_format(abs($balance),2).')';
									  }
                                      else
									  {
                                        $html.=number_format($balance,2);
                                      }
                                    $html.='</td>
                                  </tr>';
                                  }
                                  }
                                  }
                                  }
                              $html.='<tr>
                                <td><strong style="margin-left:15px;">Total Purchase Tax</strong></td>
                                <td></td>
                                <td class="amount-align">';
								
                                      if($purchase_balance<0)
									  {
                                        $html.='('.number_format(abs($purchase_balance),2).')';
									  }
                                      else
                                      {
                                        $html.=number_format($purchase_balance,2);
									  }
                                $html.='</td>
                              </tr>
                              <tr>';
                            
                                $total = $supply_balance-$purchase_balance;
                             
                                $html.='<td><strong style="margin-left:15px;">Net Tax</strong></td>
                                <td></td>
                                <td class="amount-align">';
                                
                                      if($total<0)
									  {
                                        $html.='('.number_format(abs($total),2).')';
									  }
                                      else
									  {
                                        $html.=number_format($total,2);
                                      }
                                $html.='</td>
                              </tr>
                                          </tbody>
                                          </table>';
                            	                      
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
                                     <div class="foottext"><span>www.islandmaids.com.sg</span></div>
                                    <div class="blackrow"></div>
                                  </div>
                               </div>
                              </body>
                             </html>';
							 
							 return $html;
                }


									public static function BankReconcilationPrintPdf($compBalance,$glAccount,$from,$to,$accId,$account){
         				$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
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
                                       <div class="box-header  blue-background">
				                      <div class="title" style="font-size:20px;">BankReconcilation</div>
				       </div>
  									<div class="content-wrapper" style="height:auto;">
                                       
                                      <table class="table table-bordered table-striped" border="1" style="width:100%;border-collapse:collapse;margin-bottom:0;">
                            
                            <tbody>

                              <tr>

                                <th>Date</th>
                                <th>Description</th>
                                <th>Counterparties</th>
                                <th>Type</th>
                                <th>Vch No.</th>
                                <th>Cheque</th>
                                <th style="text-align:center;">Debit</th>
                                <th style="text-align:center;">Credit</th>
                                <th style="text-align:center;">Balance</th>

                              </tr>';

                                $balance = 0.00;
                                $bank_not_debit_amount = 0.00;
                                $bank_not_credit_amount = 0.00;
                              
                              if(!empty($glAccount))
							  {
							  	
                              foreach($glAccount as $key => $account)
							  {
                              //if($key==28) { echo '<pre>'; print_r($account); echo '</pre>'; die(); }

                              foreach($account as $view)
							  {
                                                              
                                if($view['1']!=0.00) {
                                  $balance += $view['1'];
                                }
                                if($view['2']!=0.00) {
                                  $balance -= $view['2'];
                                }

                                if(!empty($view['bank'])) {
                                  if(strtotime($view['bank']) > strtotime($to)) {
                                    $bank_not_debit_amount  += $view['1'];
                                    $bank_not_credit_amount += $view['2'];
                                  } 
                                } else {
                                  $bank_not_debit_amount  += $view['1'];
                                  $bank_not_credit_amount += $view['2'];
                                }
                              

                              $html.='<tr>
                                <td>'.$view["date"].'</td>
                                <td>'.$view["description"].'</td>
                                <td>'.$view["parties"].'</td>
                                <td>'.$view["type"].'</td>
                                <td>'.$view["no"].'</td>
                                <td>'.$view["cheque"].'</td>
                                <td class="amount-align">'.number_format($view["1"],2).
                                '</td>
                                <td class="amount-align">'.number_format($view["2"],2).
                                '</td>
                                <td>
                                  <input value="'.$view["bank"].'" name="bank_date['.$view["id"].'."_".'.$view["type"].']" id="bank_date_'.$view["id"].'."_".'.$view["type"].'" class="form-control datepicker">
                                </td>
                              </tr>';

							}
						}

                        $runningBalance = abs($compBalance);
                        $bankNot     = $bank_not_debit_amount-$bank_not_credit_amount;
                        $bankBalance = $runningBalance-$bankNot;
                
                    $html.='<tr>
                      <td colspan="6" style="text-align:right;"><strong>Company Balance</strong></td>';
                      
                          if($compBalance<0) {
                        
                          $html.='<td style="text-align:right;">-</td>
                          <td style="text-align:right;">'.number_format(abs($compBalance),2,'.',',').'</td>';
                       
                          } 
                          else 
                          {
                        
                          $html.='<td style="text-align:right;">'.number_format($compBalance,2,'.',',').'</td>
                          <td  style="text-align:right;">-</td>';
                        
                          }
                        
                      $html.='<td></td>
                    </tr>

                     <tr>
                      <td colspan="6" style="text-align:right;"><strong>Amounts not Reflected in Bank</strong></td>
                         <td  style="text-align:right;">'.number_format($bank_not_debit_amount,2,'.',',').'</td>
                          <td style="text-align:right;">'.number_format($bank_not_credit_amount,2,'.',',').'</td>

                      <td></td>
                    </tr>

                    <tr>
                      <td colspan="6" style="text-align:right;"><strong>Bank Balance</strong></td>';
                    
                          if($bankBalance<0) {
                        
                          $html.='<td style="text-align:right;">-</td>
                          <td style="text-align:right;">'.number_format(abs($bankBalance),2,'.',',').'</td>';

                          } 
                          else 
                          {
                        
                          $hml.='<td style="text-align:right;">'.number_format($bankBalance,2,'.',',').'</td>
                          <td style="text-align:right;">-</td>';
                        
                          }
                        
                      
                      $html.='<td></td>
                    </tr>';
		                    
		                    }
                              else
							  {
                                $html.='<tr>
                                  <td colspan="9" align="center">No Records Found</td>
                                </tr>';

							  }

                                                        
                            $html.='</tbody>
                          </table>';                           	                      
								
                                  $html .='</div>
                                    <div id="footer" style="margin-top:20px;">
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
