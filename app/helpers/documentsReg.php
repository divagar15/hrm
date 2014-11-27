<?php
class documentsReg
{
	public static function doctest($query)
	{
			$basePublic = Config::get('local.basePublic');
					
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
								<style type="text/css">
									table.tableizer-table {
									font-family: Arial, Helvetica, sans-serif
									font-size: 12px;
									border: 1px solid #ccc;
									border-bottom:none;
								} 
								.tableizer-table td {
									padding: 4px;
									margin: 3px;
									
								}
								.tableizer-table th {
									color: #000;
									font-weight: bold;
								}
								.vertical_line
								{
									border-right:1px solid black;
								}
								.p-text-size p
								{
									font-size:13px;
								}
								.span-text-size span
                                {
                                    font-size:15px;
                                }
                                .text-size span
                                {
                                    font-size:13px;
                                }
								</style>
                                </head>
                                <body>
                      			 
									<!--Form 14-->
										
						          <div class="container p-text-size text-size" style="page-break-after: always;width:78%;margin-left:11%;">
                                  <div>
                                    <p align="center" style="font-size:13px;">
                                        <strong>SERVICE AGREEMENT</strong><br/>
                                        <strong>BETWEEN FOREIGN DOMESTIC WORKER EMPLOYER AND EMPLOYMENT AGENCY</strong>
                                    </p>
                                 
                                    <p>                                        
                                        <table><tr><td><strong>Employment Agency Ref No. :</strong></td><td>';if(isset($query->contract_no)){ $html.=ucwords(strtoupper($query->contract_no));} $html.='<div style="border-bottom:1px solid black;width:100px;"></div></td></table>
                                    </p>

                                    <p>                                      
                                        <br/>Parties to this agreement are to retain a signed copy of this agreement.
                                    </p>
                                    <hr/>
                                    <p>
                                        This Service Agreement is dated ___________ (dd/mm/yyyy) and made between:
                                    </p>                               
                                    <div style="font-size:13px;width:100%"> 
                                        <table width="100%">
                                        <tr><td width="60%">(A) Full Name of Employment Agency (<strong>Agency</strong>):</td><td><div style="border-bottom:1px solid black;width:210px;">ISLAND MAIDS PTE LTD</div></td></tr>
                                        <tr><td style="padding-left:22px;">Employment Agency License Number<span style="margin-left:36px;">:</span></td><td><div style="border-bottom:1px solid black;width:210px;">13C6728</div></td> </tr>
                                        <tr><td style="padding-left:22px;">Registered Business Address<span style="margin-left:85px;">:</span></td><td><div style="border-bottom:1px solid black;width:210px;">BLK 214 BEDOK NORTH STREET 1</div><div style="border-bottom:1px solid black;width:210px;">#01-183 SINGAPORE 460214</div></td></tr>
                                        </table>
                                    </div>
                                </div>
                                <br/>
                                 <div style="font-size:13px;width:100%"> 
                                        <table width="100%">
                                        <tr><td width="60%">(B) Full Name of Employer (<strong>Employer</strong>)<span style="margin-left:45px;">:</span></td><td><div style="border-bottom:1px solid black;width:210px;">';if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td></tr>
                                        <tr><td style="padding-left:22px;">NRIC/Passport Number<span style="margin-left:110px;">:</span></td><td><div style="border-bottom:1px solid black;width:210px;">';if(isset($query->nric_no)){ $html.=ucwords(strtolower($query->nric_no));} $html.='</div></td> </tr>
                                        <tr><td style="padding-left:22px;">Address<span style="margin-left:192px;">:</span></td><td><div style="border-bottom:1px solid black;width:210px;">';if(isset($query->cus_address)){ $html.=ucwords(strtolower($query->cus_address));} $html.='</div></td></tr>
                                        </table>
                                </div>

                                <div>
                                    <p>
                                        It is hereby agreed between the parties that:
                                    </p>
                                    <p>
                                        1. <strong><span style="margin-left:15px;text-align:justify;">Appointment of Services</span></strong>
                                    </p>                                    
                                
                                    <p style="line-height:20px;text-align:justify;">
                                        1.1 <span style="margin-left:10px;">The Employer hereby appoints the Agency to secure the services of a Foreign Domestic Worker</span><span style="margin-left:30px;">(FDW) (set out in the <em>Services &amp; Fees Schedule</em>) for a contract of service on the terms and</span><span style="margin-left:30px;"> conditions that appear below.</span>
                                    </p>
                                    <p style="line-height:20px;text-align:justify;">
                                        1.2 <span style="margin-left:10px;">The period of this Service Agreement shall be from the date of signing this Service Agreement for</span><span style="margin-left:30px;"> a period of <u>6 months</u> or the validity of
                                        the work permit whichever is shorter, and subject to the </span> <span style="margin-left:30px;">clauses 3-5 on Replacement and Refund.</span>
                                    </p>
                                    <p style="line-height:20px;text-align:justify;">
                                        1.3 <span style="margin-left:10px;">The Agency shall handover the FDW to the employer within <strong> <u>90 </u>days </strong>after obtaining the "Letter</span><span style="margin-left:30px;"> of Notification to bring FDW
                                        into Singapore" by Ministry of Manpower, subject to </span> <span style="margin-left:30px;">the conditions under Clause 3.1, Table 1. The Agency and Employer shall check against the 
                                        </span><span style="margin-left:30px;">"Handing and Taking-Over Form" during the handing/taking-over process</span>.
                                    </p>
                                    <p>
                                        2. <strong><span style="margin-left:13px;">Fees Payment</span></strong>
                                    </p>
                                    <p style="line-height:20px;text-align:justify;">
                                        2.1 <span style="margin-left:6px;"> In consideration of the services to be provided by the agency, the Employer shall pay the </span> <span style="margin-left:30px;">following Fees as set out in the <em>S</em><em>ervices &amp; Fees Schedule</em>:</span>
                                    </p>
                               
                                    <p>
                                        i.<u> <span style="margin-left:50px;">Service Fee Charged on Employer</span></u>
                                    </p>
                                  
                                </div>
                               
                                <div>
                                    
                                    <table style="font-size:13px;margin-left:42px;">
                                        <tr><td>Total Service Fee of S$</td><td width="100px"><div style="border-bottom:1px solid black;width:100px;">';if(isset($totalFee)){ $html.=ucwords(strtolower($totalFee));} $html.='</div></td><td>shall be paid to the Agency for the services</td></tr>
                                        <tr><td colspan="3">rendered in the following manner:</td></tr>
                                    </table>
                                    <br/>
                                    <table style="font-size:13px;margin-left:42px;">
                                        <tr><td>a. <span style="margin-left:30px;">A deposit of S$</span></td><td width="100px"><div style="border-bottom:1px solid black;width:100px;">';if(isset($recAmount)){ $html.=ucwords(strtolower($recAmount));} $html.='</div></td><td>(if any)<em>, </em>shall be paid in full before the Agency</td></tr>
                                        <tr><td colspan="3"><span style="margin-left:40px;">submits the Employer\'s application to the Ministry of Manpower (MOM).</span></td></tr>
                                    </table>
                                    <br/>
                                    <table style="font-size:13px;margin-left:42px;">
                                        <tr><td>b. <span style="margin-left:30px;">The balance of S$</span></td><td width="100px"><div style="border-bottom:1px solid black;width:100px;">';if(isset($recAmount) && isset($totalFee)){ $html.=ucwords(strtolower($totalFee-$recAmount));} $html.='</div></td><td>when the FDW reports for work/ duty.</td></tr>
                                    </table>                                  
                                </div>

                               <br/><br/><br/><br/><br/>
                                <div>
                                    <p>
                                        ii. <u>Placement Fee</u>
                                    </p>
                                
                                </div>
                                
                                <div>
                                    <table style="font-size:13px;margin-left:5px;">
                                        <tr><td>a.<span style="margin-left:25px;">The Placement fee of S$</span></td><td width="120px"><div style="border-bottom:1px solid black;width:100px;">';if(isset($placementFee)){ $html.=ucwords(strtolower($placementFee));} $html.='</div></td><td>(if any)<em>,</em>comprises (1) service fee charged</td></tr>
                                        <tr><td colspan="3"><span style="margin-left:40px;">on the FDW by the Agency and (2) personal loan incurred by FDW overseas.</span></td></tr>
                                    </table>

                                    <p style="margin-left:50px;line-height:20px;text-align:justify;">
                                        (1) Service fee charged on the FDW by the Agency<br/>
                                        (2) Personal loan incurred by FDW overseas
                                    </p>
                                   
                                    <p style="text-align:justify;line-height:20px;">
                                        b. <span style="margin-left:25px;">The Employer agrees to pay the placement fee on behalf of the FDW which the Employer may </span><span style="margin-left:40px;">recover from the FDW as determined in the employment contract.</span>
                                    </p>
                                    
                                    <p style="text-align:justify;line-height:20px;">
                                        2.2 <span style="margin-left:20px;">Apart from the Service Fee, the Agency confirms that there are no hidden or other costs or </span><span style="margin-left:40px;">expenses that the Employer shall be liable for except
                                        those, if any, under this Agreement.</span>
                                    </p>
                                    <p style="text-align:justify;line-height:20px;"> 
                                        2.3 <span style="margin-left:20px;">All payments shall</span>
                                        <strong>*<s>include</s>/ exclude</strong>the prevailing Goods and Services Tax (GST).
                                    </p>
                                    <p style="text-align:justify;line-height:20px;">
                                        3. <strong><span style="margin-left:25px;">Replacement of FDW before FDW is placed to employer</span></strong>
                                    </p>
                                    <p style="text-align:justify;line-height:20px;">
                                          3.1<span style="margin-left:25px;">If the FDW is unable to be placed to the Employer, the Agency <strong>shall </strong>provide the Employer</span> <span style="margin-left:37px;"> with a replacement FDW at <u>no additional cost</u> and which shall not count towards the Employer\'s</span><u><span style="margin-left:37px;">entitlement in clause 4.1</span></u>
                                    </p>
                                    <p style="text-align:justify;line-height:20px;">
                                        3.2<span style="margin-left:25px;">The Agency may provide the Employer with a replacement FDW at no additional cost under the</span><span style="margin-left:37px;">following circumstances</span>
                                    </p>

                                   <div style="border:1px solid black;margin-left:15px;">
                                        a)<span style="margin-left:10px;">The FDW is found to have breached any Work Permit Conditions or is blacklisted by the MOM.</span><br/>
                                        b)<span style="margin-left:10px;">The FDW failed her first full medical examination in Singapore</span><br/></span>                                    
                                        c)<span style="margin-left:10px;">The FDW is homesick and/or refuse to work before she commences work.<br/></span>                                    
                                        d)<span style="margin-left:10px;">The FDW is unable to come to Singapore for whatsoever reason(s) to take up the intended </span><span style="margin-left:25px;">employment.</span>
                                   </div>

                                    <p style="text-align:justify;line-height:20px;">
                                        3.3 <span style="margin-left:20px;">In the event that the FDW needs to be repatriated before she is placed to the Employer, the</span><span style="margin-left:37px;">Agency shall be responsible for and bear the cost of
                                        repatriation of the FDW to the international</span><span style="margin-left:37px;">port of entry that affords her reasonable access to her hometown within her home country</span>
                                    </p>
                                    <p style="text-align:justify;line-height:20px;">
                                        3.4 <span style="margin-left:20px;">In the event that the Employer opts not to have a replacement FDW in the circumstances stated</span><span style="margin-left:37px;"> in clause 3.1 when the FDW(s) who matches the
                                        Employer\'s selection criteria is available, the </span><span style="margin-left:37px;">Employer shall be entitled to a refund of 50% of the service fee.</span>
                                    </p>
                                    <p style="text-align:justify;line-height:20px;">
                                        3.5 <span style="margin-left:20px;">After a replacement has been accepted by the Employer, the Employer <strong>shall not </strong>be entitled to</span><span style="margin-left:37px;">any refund of the service fee for the
                                        replacement FDW as set out in the <em>Services and Fees </span><span style="margin-left:37px;">Schedule- Form B </em>(if any) has been paid.</span>
                                    </p>
                                    <p style="text-align:justify;line-height:20px;">
                                        4.<strong><span style="margin-left:25px;">Replacement of FDW after FDW is handed over to employer</span></strong>
                                    </p>
                                    <p style="text-align:justify;line-height:20px;">
                                        4.1 <span style="margin-left:20px;">According to the <em>Services &amp; Fees Schedule</em>, the Employer is entitled to <strong>one </strong>FDW replacement(s)</span><span style="margin-left:37px;">from the Agency within a period of _____ month(s) (\'replacement period\') over and above the</span><span style="margin-left:37px;">Employer\'s entitlement as stated in clause 3.1. A new fees schedule for replacement (Form B)</span><span style="margin-left:37px;">contained within this Agreement shall be signed. However,
                                        the Employer may request for a</span><span style="margin-left:37px;"> replacement only after the FDW has worked for the Employer for a minimum of  <strong>30 days</strong>(which</span><span style="margin-left:37px;">should be
                                        before the expiry of the replacement period). This replacement period shall be</span><span style="margin-left:37px;">applicable to all subsequent replacements, if the Employer is entitled
                                        to more than 1</span><span style="margin-left:37px;">replacement. The grant of replacement is subject to the following:</span>
                                    </p>
                                </div>

                                <br clear="all"/>

                                <div>                                  
                                    <p style="text-align:justify;">
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><!--<span style="margin-left:-50px;margin-right:25px"> 4.1.1</span>-->The Employer must sign the Consent to Transfer Form from the Work Pass Division, Ministry of Manpower (\'MOM\') to allow the FDW to seek employment
                                        with the new Employer.
                                        </div>                                                                            
                                    </p>

                                    <p style="text-align:justify;">
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.1.2</span>The Employer shall agree to transfer the FDW to a new employer specified by the Agency and will not in any way prevent or jeopardize the FDW\'s
                                        transfer or opportunity to seek re-employment with the new employer, unless the FDW is medically unfit to work as a domestic worker or has committed a
                                        criminal offence in Singapore. The Employer must make the FDW available to the Agency for <u>21</u> days for her to be interviewed and successfully
                                        transferred. During this period, the employer shall bear the cost of providing the FDW with food and lodging at a rate of <strong> $20 per day </strong>
                                        in addition to the levy payable. Employer shall not recover these fees from the FDW If the Agency is unable to transfer the FDW within <u>21</u> days,
                                        the Agency shall update the Employer on the FDW\'s transfer status. Beyond this period, the Employer may repatriate the FDW and cancel her Work Permit.
                                        </div>
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.1.3</span>  If the Employer decides to terminate the services of the FDW, the Employer shall inform the Agency for settlement of any outstanding issues
                                        between the FDW and Agency.
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.1.4</span>The replacement FDW shall be of the same selection criteria as the previous FDW unless both parties explicitly agree to the contrary. In the
                                        event that an Employer selects a replacement FDW of a different selection criteria, the Employer shall have to pay the difference in the prescribed
                                        package and replacement fee, if applicable.
                                        </div>                                          
                                    </p>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.1.5</span>The replacement shall take effect within <u>3</u> month(s). After which time, if the Agency fails to provide a replacement, the Employer may
                                        choose to terminate this Agreement, subject to the clauses under Section 5 on Refund Policy.
                                        </div>                                         
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:50px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.2</span> The Employer reserves the right to reject the intended replacement and terminate this Agreement if the replacement does not fulfil Employer\'s
                                        selection criteria (based on the original selection criteria). In such case, the Employer <strong>shall not </strong>be entitled to a refund of the
                                        Service Fee charged on him as stipulated in Clause 2.1(i) except for a pro-rated amount of placement fee paid to the Agency which will be refunded
                                        within 30 days.
                                        </div>                                          
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:10px;"><span style="margin-left:-50px;margin-right:30px">5.</span>
                                            <strong>Refund Policy for Service Fee and Placement Fee</strong>
                                        </div>                                        
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:15px;"><span style="margin-left:-50px;margin-right:25px">5.1</span>
                                           <u>If FDW has not been placed to Employer</u>
                                        </div>      
                                       
                                    </p>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:20px">5.1.1</span>
                                           The Agency agrees to place the FDW to the Employer within <strong>90 days </strong>of the date of this contract, failing which the Employer is
                                        entitled to terminate this Service Agreement and obtain 90% refund of the service fee and a pro-rated refund of placement fee paid to the Agency.
                                        </div>                                            
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:20px">5.1.2</span>
                                           If the Employer terminates the agreement in writing with the Agency, the Employer shall be entitled to a refund of the Service Fee (if any)        <em>less </em>the administrative charge (as stipulated in table below) from the Agency within 1 <strong>month(s) </strong>as listed below [*To delete
                                           accordingly]:
                                        </div>                                           
                                    </p>
                                    <br/>
                                    <table border="1" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                            <tr style="background-color:#ccc;">
                                                <td width="29" valign="top"> 
                                                </td>
                                                <td width="300" valign="top">
                                                    <p>
                                                        <strong>Event</strong>
                                                    </p>
                                                </td>
                                                <td width="104" valign="top">
                                                    <p style="text-align:center;">
                                                        <strong>Administrative</strong>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top">
                                                    <p style="text-align:center;">
                                                        i
                                                    </p>
                                                </td>
                                                <td width="300" valign="top">
                                                    <p>
                                                        <strong><em>Before </em></strong>
                                                        the submission of the Work Permit application to MOM.
                                                    </p>
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">
                                                    <p>
                                                        $200.00
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top">
                                                    <p style="text-align:center;">
                                                        ii
                                                    </p>
                                                </td>
                                                <td width="300" valign="top">
                                                    <p>
                                                        <strong><em>After </em></strong>
                                                        the submission of the Work Permit application to MOM.
                                                    </p>
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">
                                                    <p>
                                                        $400.00
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top">
                                                    <p style="text-align:center;">
                                                        iii
                                                    </p>
                                                </td>
                                                <td width="300" valign="top">
                                                    <p>
                                                        <strong><em>If </em></strong>
                                                        the FDW Work Permit application is rejected by MOM due to no fault of the Agency
                                                
                                                    </p>
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">
                                                    <p>
                                                        $400.00
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br clear="all"/>
                                <br/>
                                <br/>
                                <div>
                                    <table border="1" cellspacing="0" cellpadding="5" style="font-size:13px;">
                                        <tbody>
                                            <tr>
                                                <td width="29" valign="top" style="text-align:center;">
                                                        iv
                                                </td>
                                                <td width="300" valign="top">                                                    
                                                        <strong><em>After </em></strong>                                                      the Letter of Notification by MOM but <strong><em>before </em></strong>FDW arrives Singapore                                                    
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">                                                    
                                                        $1,000.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top"  style="text-align:center;">
                                                        v
                                                </td>
                                                <td width="300" valign="top">                                                
                                                        <strong><em>After </em></strong>
                                                        the Letter of Notification by MOM and <strong><em>after </em></strong>FDW arrives Singapore                                                
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">
                                                        $1300.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top" style="text-align:center;">
                                                        vi
                                                </td>
                                                <td width="300" valign="top">                                                    
                                                        <strong><em>After </em></strong>
                                                        the Letter of Notification, by MOM, relating to FDW on transfer                                                    
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">                                                    
                                                        $500.00
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">5.2</span>
                                           <u>If FDW has been placed with Employer and if FDW can be transferred</u>
                                        </div>                                             
                                    </p>
                                    <p style="margin-right:50px;">
                                         <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">5.2.1</span>
                                            The Agency shall refund the following amounts to the Employer as stated in the table below, should the Employer decide to terminate the FDW
                                            prematurely and the FDW is successfully transferred to another employer. This is subject to the Employer returning the FDW to the Agency and agreeing
                                            to the FDW\'s transfer to a new employer specified by the Agency without in any way preventing or jeopardizing the FDW\'s transfer or opportunity to seek
                                            re-employment with a new employer.
                                        </div>                                    
                                    </p>
                                    <br/>
                                    <table border="1" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr style="background-color:#ccc;">
                                                <td width="38" valign="top">
                                                    <p style="text-align:center;">
                                                        <strong>S/N</strong>
                                                    </p>
                                                </td>
                                                <td width="230" valign="top">
                                                    <p>
                                                        <strong>Description</strong>
                                                    </p>
                                                </td>
                                                <td width="90" valign="top">
                                                    <p align="center">
                                                        <strong>Service Fee </strong>
                                                    </p>
                                                  
                                                </td>
                                                <td width="90" valign="top">
                                                    <p align="center">
                                                        <strong>Placement Fee</strong>
                                                    </p>                                                
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="38" valign="top">
                                                    <p style="text-align:center;">
                                                        i
                                                    </p>
                                                </td>
                                                <td width="230" valign="top">
                                                    <p>
                                                        FDW is successfully transferred to another Employer
                                                    </p>
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;"> 
                                                    <p style="text-align:center;">
                                                        No Refund
                                                    </p>
                                                </td>
                                                <td width="90" valign="top">
                                                    <p style="text-align:center;">
                                                        Pro-rated refund
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:20px;"><span style="margin-left:-50px;margin-right:20px">5.2.2</span>
                                          The refund shall be effected within <u>4</u> week(s) from the date of termination of the FDW or the date the FDW was transferred, whichever is
                                          later.
                                        </div>                                          
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">5.3</span>
                                          <u>If FDW has been placed with Employer and if FDW cannot be transferred</u>
                                        </div>                                         
                                    </p>
                                    
                                     <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:20px;"><span style="margin-left:-50px;margin-right:20px"> 5.3.1</span>
                                            Under the following circumstances, the Agency shall refund the following amounts to the Employer as stated in the table below:
                                        </div>                                         
                                    </p>
                                    <br/>

                                    <table border="1" cellspacing="15" cellpadding="7" style="border-collapse:collapse;font-size:13px;">
                                        <tbody>
                                            <tr style="background-color:#ccc;">
                                                <td width="38" valign="top" style="text-align:center;">                                                    
                                                        <strong>S/N</strong>                                                    
                                                </td>
                                                <td width="230" valign="top">                                                  
                                                        <strong>Description</strong>                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        <strong>Service <br/>Fee</strong>
                                                </td>

                                                <td width="90" valign="top">                                                   
                                                        <strong>Placement Fee</strong>                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="38" valign="top" style="text-align:center;">                                                
                                                        i                                                   
                                                </td>
                                                <td width="230" valign="top">                                                   
                                                        FDW is unwilling and/or unable to continue employment in Singapore due to no fault of the employer. The                                                 
                                                        employer shall bring the FDW to the agency for settlement.                                                   
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                   
                                                        Pro-rated                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="38" valign="top" style="text-align:center;">                                                 
                                                        ii                                                  
                                                </td>
                                                <td width="230" valign="top">
                                                        FDW has been assigned to another                                                     
                                                        Agency by MOM
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">
                                                        No Refund
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;"> 
                                                        No Refund
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="38" valign="top" style="text-align:center;">
                                                        iii
                                                </td>
                                                <td width="230" valign="top">
                                                        FDW goes to another agency (not assigned by MOM)
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">
                                                        No Refund
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="38" valign="top" style="text-align:center;">                                                 
                                                        iv                                                  
                                                </td>
                                                <td width="230" valign="top">
                                                        FDW is repatriated by the employer
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">
                                                        No Refund
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                  
                                                        No Refund                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="38" valign="top" style="text-align:center;">                                              
                                                        v                                                   
                                                </td>
                                                <td width="230" valign="top">                                                    
                                                        FDW suffers from any mishap or accident                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                   
                                                        No Refund                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">
                                                    No Refund                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="38" valign="top" style="text-align:center;">
                                                        vi
                                                </td>
                                                <td width="230" valign="top">                                                    
                                                        Employer is in breach of any provisions of this agreement, any applicable law or regulation (including Work Permit Conditions)                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                            </tr>
                                            <tr height="20px;">
                                                <td width="38" valign="top" style="text-align:center;">                                                   
                                                        vii                                                    
                                                </td>
                                                <td width="230" valign="top">                                                    
                                                        FDW is missing                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                            </tr>
                                            <tr height="20px;">
                                                <td width="38" valign="top" style="text-align:center;">                                                   
                                                        viii                                                   
                                                </td>
                                                <td width="230" valign="top">                                                   
                                                        Employer refuses to sign the consent to transfer form for whatever reasons for the FDW to seek new employment                                                   
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                  
                                                        No Refund                                                   
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="38" valign="top" style="text-align:center;">                                                    
                                                        viii                                                    
                                                </td>
                                                <td width="230" valign="top">                                                   
                                                        FDW develops illness (eg: skin rashes, etc) during her employment and is unable to get a new employer                                                   
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                   
                                                        No Refund                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br clear="all"/>
                                <br clear="all"/>
                                <br clear="all"/>
                                <div>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:20px;"><span style="margin-left:-50px;margin-right:20px">5.3.2</span>
                                            The refund shall be effected within <strong>4 week(s) </strong>from the end of the waiting period stipulated in clause 4.1.2/the date the FDW is
                                        assigned to another agency by MOM/the date the Agency is informed that the FDW selects another agency, whichever is applicable.
                                        </div>                                          
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:20px;"><span style="margin-left:-50px;margin-right:20px">5.3.3</span>
                                            If the FDW has been assigned to another Agency by MOM or other relevant authorities, the Employer shall bear all the costs incurred, including
                                        medical expenses, food and accommodation costs for the duration of the relevant authorities\' investigation in any event and regardless of the outcome.
                                        </div>                                         
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:30px">6.</span>
                                            <strong>Special Provisions</strong>
                                        </div>                                       
                                    </p>

                                      <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">6.1</span>
                                            The Agency should exercise due diligence in ensuring the accuracy of all personal information given in the bio-data of the FDW, within the agency\'s
                                             reasonable control to check and verify.
                                        </div>                                        
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">6.2</span>
                                           The Agency shall ensure that the FDW arrives on time as scheduled, but should there be any delay not caused by the Agency, the Agency will not be
                                           liable for any claims made by the Employer for consequential loss or delay.
                                        </div>                                         
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">6.3</span>
                                           The Employer shall permit the Agency or such authorised persons as the Agency may appoint to visit the work location to determine the welfare of
                                            the FDW and to observe and adjudge the performance of her obligations to the Employer or Agency.
                                        </div>                                        
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">6.4</span>
                                          If the Employer requests for the Agency to provide food and accommodation, and should the Agency agree to do so, the Employer shall pay        <strong>$20 per day </strong>to the Agency for provision of this service. These costs cannot be recovered from the FDW.
                                        </div>                                        
                                    </p>

                                    <p>
                                      <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:30px">6.5</span>
                                          Should the Agency agree to provide food and accommodation for the FDW as stated in clause   6.4, the <strong>Employer shall remain legally responsible for the FDW</strong>. This includes but is not limited to bearing the costs of the FDW\'s
                                          medical expenses. Prior to providing food and accommodation for the FDW, the Agency shall inform the Employer that the Employer is legally                                       
                                         responsible for <br/>the FDW.
                                         
                                      </div>                                           
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">6.6</span>
                                              If the Agency provides counseling services, the Employer shall be liable to pay the Agency a sum of <strong> <u>$0</u></strong>for each counseling
                                            session at the <strong>Agency\'s premises. </strong>The employer shall be liable to pay the agency a sum of <strong> <u>S$50</u> </strong>for each
                                            counselling session at the employer\'s residence, as requested by the employer and conducted by the agency
                                        </div>                                       
                                    </p>

                                    
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">6.7</span>
                                              The Employer shall inform the Agency of the termination of the FDW’s employment with the same period of notice given to the FDW for termination of
                                        employment.
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">6.8</span>
                                          The Agency shall furnish the Employer with the employment history of the FDW. The Agency shall obtain such information from the Ministry of
                                          Manpower and ensure that the most updated information is made available to the Employer during the selection process.
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">6.9</span>
                                          In the event that the FDW absconds, the Agency may but shall not be obligated to assist to contact the NGOs and the Embassy of her home country to
                                        locate her.
                                        </div>                                       
                                    </p>

                                     <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">7.</span>
                                         <strong>Force Majeure</strong>
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                        In the event that any party shall be rendered unable to carry out the whole or any part of its obligations under this Agreement for any reason beyond
                                        the control of that party, including but not limited to acts of God, force majeure, strikes, war, riot and any other causes of such nature, then the
                                        performance of the obligations hereunder of that party or all the parties as the case may be and as they are affected by such cause shall be excused
                                        during the continuance of any inability so caused, but such inability shall as far as possible be remedied with all reasonable dispatch.
                                        </div>                                       
                                    </p>
                                   
                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">8.</span>
                                             <strong>Confidentiality</strong>
                                        </div>                                      

                                      <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                          The Agency shall not, unless with the Employer\'s written consent, directly or indirectly give, divulge or reveal to any persons any information
                                        whatsoever regarding the Employer, which information the Agency acquired or requested the Employer to provide pursuant to this Agreement. This
                                        condition shall not apply in the case where the information is required for the purpose of any investigations under any law, by the police, the
                                        Controller of Work Passes, the Commissioner for Employment Agencies, Commissioner for Labour, Immigration officers or any other public officer.
                                        </div>  
                                     
                                    </p>
                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">9.</span>
                                             <strong>Dispute Resolution</strong>
                                        </div>                                            
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">9.1</span>
                                          If the Agency is unable to resolve any grievance(s) of the Employer or if the parties are unable to resolve any dispute between them with respect
                                        to this Agreement, the parties shall refer the grievance(s) or dispute to Association of Employment Agency Singapore (AEAS).
                                        </div>                                        
                                    </p>
                                    <p>
                                       <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">9.2</span>
                                          If the dispute arising from this Agreement cannot be settled by the above mediation stated in clause 9.1, the parties shall refer the grievance(s)
                                        or dispute to CASE.
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">10.</span>
                                             <strong>Precedence to Other Agreements</strong>
                                        </div>                                         
                                    </p>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                             In the event of there being any inconsistency between the terms of this Agreement and the terms of any other agreement (oral or written) entered into
                                            between the Agency and the Employer, the terms of this Agreement shall prevail and the terms of such other agreement shall be deemed to be amended to
                                            the extent necessary for it to be read as being consistent with this Agreement.
                                        </div>  
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">11.</span>
                                             <strong>Severability of Provisions</strong>
                                        </div>                                             
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                              If any provision of this Agreement or part thereof is rendered void, illegal or unenforceable by any legislation to which it is subject, it shall be
                                            rendered void, illegal or unenforceable to that extent and it shall in no way affect or prejudice the enforceability of the remainder of such provision
                                            or the other provisions of this Agreement.
                                        </div>                                         
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">12.</span>
                                            <strong>Third Party Rights</strong>
                                        </div>                                            
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                            A person who is not a party to this Agreement has no right under the Contracts (Rights of Third Parties) Act, Chapter 53B of Singapore or any other
                                           laws in any jurisdiction to enforce any term of this Agreement.
                                        </div>                                         
                                    </p>

                                    <p>
                                       <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">13.</span>
                                            <strong>Termination of Agreement</strong>
                                        </div>                                           
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                            Any party intending to terminate this agreement shall provide at least <strong> <u>14</u> </strong>day(s) prior notice to the other party.
                                        </div>                                        
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">14.</span>
                                            <strong>Miscellaneous</strong>
                                        </div>                                              
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">14.1</span>
                                             The Employer shall observe and comply with all laws in force in Singapore affecting this Agreement, including but not limited to the Employment of
                                            Foreign Manpower Act, the Employment of Foreign Manpower (Work Passes) Regulations 2007, the Immigration Act, and the Immigration Regulations. The
                                            Employer shall give all notices and pay all fees required to be given or paid under any law in force in Singapore.
                                        </div>   
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:20px">14.2</span>
                                             <strong>
                                                It is the *Employer\'s responsibility to receive or send the FDW from/to the premises of the Agency for reasons pertaining to deployment,
                                                re-deployment (FDW seeking new employer) or counselling.
                                            </strong>
                                        </div>   
                                    </p>                                    
                                     
                                    <p style="margin:23% 0 23% 0"> 
                                        <div style="border:1px solid red;padding:15px 7px 15px 7px;">
                                                <u>IMPORTANT NOTES:</u>
                                           
                                                <p>i ) The FDW is deemed to be the responsibility of the employer at all times from the date of handing over from the agent until such time as the work
                                                permit is cancelled and the FDW is repatriated, or until a transfer is approved by the Ministry of Manpower and the FDW is handed over to the new
                                                employer.</p>
                                           
                                                <p>ii ) The Employer must continue to pay all levies imposed by the relevant authorities until a transfer is approved or the work permit is cancelled.</p>
                                        </div>   
                                    </p>
                                    <p style="margin:150px 0px 150px 0px;">                                      
                                        IN WITNESS whereof this Agreement has been entered into the day and year first above written, the contracting parties having read and understood the
                                        terms and conditions of this contract hereunto set their signatures below.
                                    </p>

                                    <table width="120%" border="0">
                                        <tr><td><div style="border-bottom:1px solid black;width:210px;"></div></td><td></td><td colspan="2"><div style="border-bottom:1px solid black;width:100%;"></div></td></tr>
                                        <tr><td colspan="2">Signature of Employer</td><td colspan="2">Signed for and on behalf of Agency</td></tr>
                                        <tr><td width="15%">Name:</td><td width="35%"><div style="border-bottom:1px solid black;width:215px;">';if(isset($query->customer_name)){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td><td>Name of Manager:</td><td width="50%"><div style="border-bottom:1px solid black;width:225px;color:red;">';if(isset($query->emp_name)){ $html.=ucwords(strtolower($query->emp_name));} $html.='</div></td></tr>
                                        <tr><td>NRIC/PP:</td><td width="35%"><div style="border-bottom:1px solid black;width:215px;">';if(isset($query->nric_no)){ $html.=ucwords(strtolower($query->nric_no));} $html.='</div></td><td width="20%">Registration No:</td><td width="50%"><div style="border-bottom:1px solid black;width:225px;color:red;">';if(isset($query->mom_reg_no)){ $html.=ucwords(strtolower($query->mom_reg_no));} $html.='</div></td></tr>
                                        <tr><td>Date:</td><td><div style="border-bottom:1px solid black;width:215px;">';if(isset($query->contract_date)){ $html.=date('d-m-Y',strtotime($query->contract_date));} $html.='</div></td><td>Date:</td><td width="50%"><div style="border-bottom:1px solid black;width:225px;color:red;">';if(isset($query->contract_date)){ $html.=date('d-m-Y',strtotime($query->contract_date));} $html.='</div></td></tr> 
                                    </table> 
                                </div>                                                                  
                               </div>
                                </body>
                             </html>';
							  //print_r($html);die();
							 //return $html;
							 return PDF::load($html,'A4','portrait')->show('Doc-Pdf');
							 
	} 


    public static function docRegPdf($query,$invoice,$adminFee,$agencyFee,$insuranceFee,$placementFee,$recAmount,$totalFee) {
                                        $addr = $addr1 = $addr2 = '';
         				$basePublic = Config::get('local.basePublic');
						
						$html='<html>
								<head>
								<link href="'.$basePublic.'css/invoice.css" type="text/css" rel="stylesheet"/>
								<style type="text/css">
                                                                body{font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
									table.tableizer-table {
									font-family: Arial, Helvetica, sans-serif;
									font-size: 12px;
									border: 1px solid #ccc;
									border-bottom:none;
								} 
								.tableizer-table td {
									padding: 4px;
									margin: 3px;
									
								}
								.tableizer-table th {
									color: #000;
									font-weight: bold;
								}
								.vertical_line
								{
									border-right:1px solid black;
								}
								.p-text-size p
								{
									font-size:14px;
								}
                                .semi_space
                                {
                                    margin-left:5px;
                                }                                
                                .span-text-size span
                                {
                                    font-size:15px;
                                }
                                .text-size span
                                {
                                    font-size:13px;
                                }
								
								</style>
                                </head>
                                <body>
                                     <div class="container" style="page-break-after: always;">
                                 <div class="header" style="height:120px;">
                                         <div style="margin-left:75%;margin-top:-25px;">
                                               REFERENCE NO:<span style="margin-left:5px;width:100%;border-bottom:1px solid black;font-size:18px;">'; if(isset($query->contract_no)){ $html.=strtoupper($query->contract_no);} $html.='</span>
                                         </div>
                                         <table  width="100%">
                                             <tr>                                                                                    
                                                 <td width="34%">
                                                    <div class="col-sp6">
                                                         <img width="150px" class="logo" src="'.$basePublic.'/assets/images/logo.png">                                                          
                                                    </div>
                                                 </td>
                                                 <td>                                                        
                                                 <div style="text-transform:uppercase;font-size:15px;margin-left:5px;margin-top:48px;"><strong>documents checklist</strong></div>                                                                                                                                                           
                                                 </td>                                             
                                              </tr> 
                                         </table> 
                                        <table style="font-size:11px;" width="100%"> 
                                        <tr>
                      				<td><strong>Name of Employer:</strong> '; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</td>
                      				<td style="text-align:left;"><strong>Name of FDW:</strong> '; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</td>
                      			</tr>           
                                     </table>

                                   </div>
			   	   <div class="content-wrapper" style="height:auto;">
                                      <table border="1" cellpadding="2"; border-collapse="collapse" style="margin-top:20px; text-align:center; font-size:12px; margin-bottom:20px; width:100%;" cellpadding="0" cellspacing="0">
                                 
                                  <tbody>';                                  
                                
                                    $html.='
						<tr><th colspan="2" style="text-align:left; background-color:#ccc;text-transform:uppercase;">Documents Filing</th><th style="text-align:left; background-color:#ccc;">Checked</th><th style="text-align:left; background-color:#ccc;">EA Filed</th><th style="text-align:left; background-color:#ccc;">Employer Filed</th></tr>
                                    		<tr><td style="text-align:center;width:1%">1</td><td style="width:55%; text-align:left;">Application Form</td><td></td><td>YES</td><td style="background-color:#999;"></td></tr>
                                    		<tr><td style="text-align:center;width:1%">2</td><td align="left">Employer Personal & Family Documents</td><td></td><td>YES</td><td style="background-color:#999;"></td></tr>
                                    		<tr><td style="text-align:center;width:1%">3</td><td align="left">Form C</td><td></td><td>YES</td><td style="background-color:#999;"></td></tr>
                                    		<tr><td style="text-align:center;width:1%">4</td><td align="left">Schedule of Salary Payment</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">5</td><td align="left">Weekly Rest Day Agreement</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">6</td><td align="left">IPA</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">7</td><td align="left">FORM 12B</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">8</td><td align="left">Pricing Schedule</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">9</td><td align="left">Prescribe Authorzation Form for EA</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">10</td><td align="left">Handling & Taking Over Form</td><td></td><td>YES</td><td>YES</td></tr>	
                                    		<tr><td style="text-align:center;width:1%">11</td><td align="left">Authorization for Collecting Work Permit</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">12</td><td align="left">Job Scope</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">13</td><td align="left">Maid\'s House Rule</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">14</td><td align="left">Maid\'s Personal Belonging Declaration</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">15</td><td align="left">Service Agreement (Employer & Agency)</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">16</td><td align="left">Employment Contract (Employer & FDW)</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">17</td><td align="left">Window Safety Agreement</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">18</td><td align="left">Bio Data</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">19</td><td align="left">Employment History</td><td></td><td>YES</td><td style="background-color:#999;"></td></tr>
                                    		<tr><td style="text-align:center;width:1%">20</td><td align="left">Medical Report</td><td></td><td style="background-color:#999;"></td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">21</td><td align="left">SIP Certificate</td><td></td><td style="background-color:#999;"></td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">22</td><td align="left">Insurance Policy</td><td></td><td style="background-color:#999;"></td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">23</td><td align="left">Refund Letter (Transfer Cases)</td><td></td><td>YES</td><td>YES</td></tr>
                                    		<tr><td style="text-align:center;width:1%">24</td><td align="left">New Placement Fee (Transfer Cases)</td><td></td><td>YES</td><td style="background-color:#999;"></td></tr>
                                    		<tr><td style="text-align:center;width:1%">25</td><td align="left">Invoice</td><td></td><td>YES</td><td>YES</td></tr>';
                                 			
                                  $html.='</tbody>                                
                                </table>';
										
										
                                  $html .='<div style="font-size:12px;margin-top:70px;margin-left:56%;"><hr width="100%" style="border:0.5px solid #000;"/><strong>Sales Rep: </strong>'; if(isset($query->emp_name) && strlen($query->emp_name) <= 30){ $html.=ucwords($query->emp_name);} $html.='</div>
                                          <div style="font-size:12px;margin-top:5px;margin-left:56%;"><strong>Reg No: </strong>'; if(isset($query->mom_reg_no)){ $html.=ucwords($query->mom_reg_no);} $html.='</div>
                             
                                  			<div style="font-size:12px;margin-top:70px;margin-left:56%;"><hr width="100%" style="border:0.5px solid #000;"/><strong>Checked by: </strong></div>
                                  			<div style="font-size:12px;margin-top:5px;margin-left:56%;"><strong>Reg No: </strong></div>
                                  </div>
                                   
                               </div>
                         <!--2 - Employers application Form-->
							   
            <div class="container" style="page-break-after: always;">
                                 <div class="header" style="height:100px;">
                                         <table width="100%">
                                            <tr>                                                                                    
                                             <td width="27%" rowspan="2" style="vertical-align:top;">
                                                 <img width="150px" class="logo" src="'.$basePublic.'/assets/images/logo.png">                                                                                                         
                                             </td>
                                             <td></td>
                                             <td></td>
                                             <td style="vertical-align:bottom;"><strong> Date:</strong></td>
                                             <td style="vertical-align:bottom;"><div style="width:100%;border-bottom:1px solid black;">'; if(isset($query->contract_date) && $query->contract_date!="" && $query->contract_date!=0){ $html.=date('d-m-Y',strtotime($query->contract_date));} $html.='</div></td>
                                             </tr>
                                             <tr>
                                             <td width="14%" style="vertical-align:bottom;">
                                                     <strong>Handover Date:</strong>
                                             </td>
                                             <td  width="16%" style="vertical-align:bottom;"><div style="width:100%;border-bottom:1px solid black;"></div></td>
                                             <td width="12%" style="vertical-align:bottom;">
                                                <strong style="margin-top:10px;"> Attended By:</strong>                                             
                                              </td>
                                              <td style="vertical-align:bottom;">';$html.='<div style="width:100%;border-bottom:1px solid black;">'; if(isset($query->emp_name) && strlen($query->emp_name) <= 30){ $html.=ucwords(strtolower($query->emp_name));} $html.='</div></div></td>
                                              </tr> 
                                       </table>
                                   </div>
                                           <div class="content-wrapper" style="height:auto;font-size:12px; border:1px solid;">
                                       
                                   <table border-collapse="collapse" border="0" style="font-size:12px;margin-top:5px;margin-bottom:5px; width:100%;" cellspacing="7">
                                  <thead>
                                   <tr><th colspan="5" style="text-align:left;">EMPLOYEE\'S PARTICULARS</th></tr>
                                  
                                  </thead>
                                  <tbody>';
                                          $html.='<tr><td colspan=4><strong>Name :</strong><span style="margin-left:5px;">'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='<div style="width:200px;border-bottom:1px solid black;margin-left:47px;"></div><span></td></tr>
                                            <tr><td colspan="3"><strong>NRIC :</strong><span style="margin-left:5px;">'; if(isset($query->nric_no)){ $html.=strtoupper($query->nric_no);} $html.='<div style="width:205px;border-bottom:1px solid black;margin-left:42px;"></div></span></td><td><strong>Date of Birth:</strong><div style="width:80px;border-bottom:1px solid black;margin-left:82px;"></div></td></tr>
                                            <tr><td colspan="3"><strong>Address :</strong><span style="margin-left:5px;">'; if(isset($query->cus_address)){ $html.=ucwords(strtolower($query->cus_address));} $html.='<div style="width:350px;border-bottom:1px solid black;margin-left:60px;"></div></span></td><td><strong><!--s(--></strong></td><td><strong><!--)--></strong></td></tr>
                                            <tr><td height:"90px;"><br/></td>
                                            <tr><td><strong>Marital Status :</strong></td>
                                            <td>
                                            <table style="font-size:10px;"><tr><td style="width:10%;">Single:</td><td><div style="width:60px;border:1px solid black;height:13px;"></div></td></tr></table>
                                            </td>
                                            <td>
                                            <table style="font-size:10px;"><tr><td style="width:10%;">Married:</td><td><div style="width:60px;border:1px solid black;height:13px;"></div></td></tr></table>
                                            </td>
                                            <td>
                                            <table style="font-size:10px;"><tr><td style="width:10%;">Divorced:</td><td><div style="width:60px;border:1px solid black;height:13px;"></div></td></tr></table>
                                            </td>
                                            <td>
                                            <table style="font-size:10px;"><tr><td style="width:10%;">Windowed:</td><td><div style="width:60px;border:1px solid black;height:13px;"></div></td></tr></table>
                                            </td>
                                            </tr>
                                            <tr><td colspan="5"><strong>Type of Residence : </strong><div style="width:250px;border-bottom:1px solid black;margin-left:117px;"></div></td></tr>
                                            <tr>
                                            <td colspan="5">
                                                <table width="90%" style="font-size:10px;">
                                                    <tr><td width="18%">Singapore Citizen:</td><td width="17%"><div style="width:60px;border:1px solid black;height:13px;"></div></td><td width="19.2%">Employement Pass:</td><td width="12%"><div style="width:60px;border:1px solid black;height:13px;"></div></td><td width="7%">Others:</td><td><div style="width:60px;border:1px solid black;height:13px;"></div></td></tr>
                                                </table>
                                            </td>
                                            </tr>';
                                            if(isset($query->contact_no)){$temp=explode(',',$query->contact_no);}
                                            $html.='<tr><td colspan="2">';
                                            if(isset($temp[0])) 
                                            {                                           
                                                $html.='<strong>Tel No (R)</strong><div style="width:210px;border-bottom:1px solid black;margin-left:60px;margin-top:-15px;">';if(isset($temp[0])){ $html.=ucwords(strtolower($temp[0]));} $html.='</div></td>';
                                            }
                                            else
                                            {
                                                $html.='<strong>Tel No (R)</strong><div style="width:210px;border-bottom:1px solid black;margin-left:60px;"></div></td>';
                                            }
                                            $html.='<td><strong>(H/P)</strong><div style="width:95px;border-bottom:1px solid black;margin-left:31px;height:15px;margin-top:-15px;float:left;">';if(isset($temp[1])){ $html.=ucwords(strtolower($temp[1]));} $html.='</div></td><td><strong>(O)</strong><div style="width:95px;border-bottom:1px solid black;margin-left:19px;"></div></td></tr>
                                            <tr><td><strong>Occupation:</strong><div style="width:190px;border-bottom:1px solid black;margin-left:100px;"></div></td></tr>
                                            <tr><td colspan="1"><strong>Company Name:</strong><div style="width:190px;border-bottom:1px solid black;margin-left:100px;"></div></td><td></td><td></td><td><strong>Employer\'s Signature</strong><div style="width:80px;border-bottom:1px solid black;margin-left:130px;"></div></td></tr>                                         
                                            <tr><td colspan="5"><hr style="width:102%;margin-left:-8px;"/></td></tr>
                                            <tr><td colspan="5"><strong style="text-transform:uppercase;">Spouse / Sponsor\'s Particulars</strong></td></tr>
                                            <tr><td colspan="4"><strong>Name :</strong><div style="width:190px;border-bottom:1px solid black;margin-left:40px;"></div></td></tr>
                                            <tr><td colspan="3"><strong>NRIC :</strong><div style="width:190px;border-bottom:1px solid black;margin-left:40px;"></div></td><td><strong>Date of Birth:</strong><div style="width:100px;border-bottom:1px solid black;margin-left:83px;"></div></td></tr>
                                            <tr><td colspan="1"><strong>Relationship with Employer:</strong></td>
                                            <td>
                                            <table><tr><td style="width:10%;">Husband:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td>
                                            <table><tr><td style="width:10%;">Wife:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td>
                                            <table><tr><td style="width:10%;">Others:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            </tr>
                                            
                                            <tr><td colspan="4"><strong>Type of Residence</strong></td></tr>
                                            <tr>
                                            <td>
                                            <table><tr><td style="width:10%;">Singapoer Citizen:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td>
                                            <table><tr><td style="width:10%;"><span style="margin-left:50px;">PR:</span></td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td>
                                            <table><tr><td style="width:10%;"><span style="margin-left:25px;">EP:</span></td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td>
                                            <table><tr><td style="width:10%;">Others:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            </tr>
                                            <tr><td colspan="2"><strong>Tel No (R)</strong><div style="width:210px;border-bottom:1px solid black;margin-left:60px;"></div></td><td><strong>(H/P)</strong><div style="width:95px;border-bottom:1px solid black;margin-left:30px;"></div></td><td><strong>(O)</strong><div style="width:95px;border-bottom:1px solid black;margin-left:25px;"></div></td></tr>
                                            <tr><td colspan="4"><strong>Occupation:</strong><div style="width:200px;border-bottom:1px solid black;margin-left:100px;"></div></td></tr>
                                            <tr><td  colspan="4"><strong>Company Name:</strong><div style="width:200px;border-bottom:1px solid black;margin-left:100px;"></div></td></tr>                                           
                                            <tr><td colspan="5"><hr style="width:102%;margin-left:-8px;"/></td></tr>
                                            
                                            <tr><td colspan="4"><strong style="text-transform:uppercase;">Combined Income</strong></td></tr>
                                            <tr><td colspan="4">Monthly Combined Income of Employer &amp; Spouse</td></tr>
                                            <tr>
                                            <td style="width:20%;">
                                            <table><tr><td>$2500-$2999:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td style="width:20%;">
                                            <table><tr><td>$3000-$3499:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td style="width:20%;">
                                            <table><tr><td>$3500-$3999:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td style="width:20%;">
                                            <table><tr><td>$4000-$4999</td><td><div style="margin-left:10px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>                                           
                                            </tr>

                                            <tr>
                                            <td style="width:20%;">
                                            <table><tr><td>$5000-$5999:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td style="width:20%;">
                                            <table><tr><td>$6000-$7999:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td style="width:20%;">
                                            <table><tr><td>$8000-$9999:</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>
                                            <td style="width:20%;">
                                            <table><tr><td>Above-$10,000</td><td><div style="margin-left:0px;width:50px;border:1px solid black;height:10px;"></div></td></tr></table>
                                            </td>                                           
                                            </tr>
                                            
                                             <tr><td colspan="5"><hr style="width:102%;margin-left:-8px;"/></td></tr>
                                            <tr><td colspan="5"><strong>Particulars of Family members Residing in the same address</strong></td></tr>
                                            <tr><td calspan="5"><strong>Name</strong><div style="width:347px;border-bottom:1px solid black;margin-left:50px;"></div></td></tr>                                                                                                                          
                                            <tr><td><strong>I/C No:</strong><div style="width:210px;border-bottom:1px solid black;margin-left:50px;"></div></td><td></td><td><strong>DOB:</strong><div style="width:80px;border-bottom:1px solid black;margin-left:40px;"></div></td><td colspan="2"><strong>Relationship:</strong><div style="width:170px;border-bottom:1px solid black;margin-left:85px;"></div></td></tr>
                                            <tr><td calspan="5"><strong>Name</strong><div style="width:347px;border-bottom:1px solid black;margin-left:50px;"></div></td></tr>                                                                                                                          
                                            <tr><td><strong>I/C No:</strong><div style="width:210px;border-bottom:1px solid black;margin-left:50px;"></div></td><td></td><td><strong>DOB:</strong><div style="width:80px;border-bottom:1px solid black;margin-left:40px;"></div></td><td colspan="2"><strong>Relationship:</strong><div style="width:170px;border-bottom:1px solid black;margin-left:85px;"></div></td></tr>
                                            <tr><td calspan="5"><strong>Name</strong><div style="width:347px;border-bottom:1px solid black;margin-left:50px;"></div></td></tr>                                                                                                                          
                                            <tr><td><strong>I/C No:</strong><div style="width:210px;border-bottom:1px solid black;margin-left:50px;"></div></td><td></td><td><strong>DOB:</strong><div style="width:80px;border-bottom:1px solid black;margin-left:40px;"></div></td><td colspan="2"><strong>Relationship:</strong><div style="width:170px;border-bottom:1px solid black;margin-left:85px;"></div></td></tr>
                                            <tr><td calspan="5"><strong>Name</strong><div style="width:347px;border-bottom:1px solid black;margin-left:50px;"></div></td></tr>                                                                                                                          
                                            <tr><td><strong>I/C No:</strong><div style="width:210px;border-bottom:1px solid black;margin-left:50px;"></div></td><td></td><td><strong>DOB:</strong><div style="width:80px;border-bottom:1px solid black;margin-left:40px;"></div></td><td colspan="2"><strong>Relationship:</strong><div style="width:170px;border-bottom:1px solid black;margin-left:85px;"></div></td></tr>';
                                  $html.='</tbody>                                
                                </table>';
                                                                        
                                  $html .='</div>                                   
                               </div>';                               
                                               
 
                               
				$html .=' <!--3 - MOM Form C Page-->
							   
				<div class="container" style="page-break-after: always;">
                                <div class="content-wrapper" style="height:auto;">
                                   <table border-collapse="collapse" style="font-size:12px;margin-top:20px;margin-bottom:20px;width:100%;" cellpadding="0" cellspacing="10">
                                  <thead>
                                  <tr>
                                   <th colspan="3" style="text-align:left;font-size:15px;">ISLAND MAIDS PTE LTD<span style="font-size:8px;">(License No:<span style="margin-left:5px;font-size:8px;">13C6728</span>)</span></th>
                                   <th colspan="2" style="text-align:right;">FORM C</th>
                                   </tr>
                                  </thead>
                                  <tbody>';
                                       
                                  $html.='<tr><td colspan="4"><br/></td></tr><tr><td colspan=4><strong style="font-size:10px;">SERVICE FEES & SCHEDULE<br/>For New FDW</strong></td></tr>
                                    		<tr><td colspan="4"></td></tr>
                                            <tr><td colspan="4"></td></tr>
                                    		<tr><td colspan="4"><strong style="text-decoration:underline;">PART A: Particulars of FDW Selected<br/><br/></strong></td></tr>

                                    		<tr style="border-spacing:0px;"><td colspan="2">Name of FDW Selected:</td><td colspan="2"><div style="width:auto;border:1px solid black;height:20px;text-align:left;padding:5px;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</div></td><td><table><tr><td>Date:</td><td><div style="width:100px;border:1px solid black;height:20px;margin-left:20px;"></div></td></tr></table></td></tr>
                                    		<tr style="border-spacing:0px;"><td colspan="2">Nationality:</td><td colspan="2"><div style="width:auto;border:1px solid black;height:20px;margin-top:-10px;text-align:left;padding:5px;">'; if(isset($query->nationality_name) && strlen($query->nationality_name) <= 30){ $html.=ucwords(strtolower($query->nationality_name));} $html.='</div></td></tr>
                                    		<tr style="border-spacing:0px;"><td colspan="2">Passport No:</td><td colspan="2"><div style="width:auto;border:1px solid black;height:20px;margin-top:-10px;text-align:left;padding:5px;">'; if(isset($query->passport)){ $html.=strtoupper($query->passport);} $html.='</div></td></tr>
                                    		<tr style="border-spacing:0px;"><td colspan="2">Salary	:</td><td colspan="2"><div style="width:auto;border:1px solid black;height:20px;margin-top:-10px;text-align:left;padding:5px;"></div></td></tr>
                                            <tr><td colspan="4"></td></tr>
                                            <tr><td colspan="4"></td></tr>

                                    		<tr><td colspan="4"><strong style="text-decoration:underline;">PART B: Placement Fee</strong><br/><br/></td></tr>
                                    		<tr><td colspan="4">The Service fee shall include the following:</td><td><span style="margin-left:100px;">S$</span></td></tr>
                                    		<tr><td width="5%">1</td><td colspan="3">Registration</td><td><div style="width:90px;border:1px solid black;margin-left:31%;height:25px;"></div></td></tr>
                                    		<tr><td width="5%">2</td><td colspan="3">Biodata / Recruitment Costs (Payable to _______________________________)</td><td><div style="width:90px;border:1px solid black;margin-left:31%;height:25px;margin-top:-12px;"></div></span></td></tr>
  											<tr><td width="5%">3</td><td colspan="3">FDW Service Fee (MAX 2 months) (Payable to Island Maids Pte Ltd)</td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td width="5%">4</td><td colspan="3">Total Placement Fee</td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td width="5%">5</td><td colspan="3">Less Salary Deduction</td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td width="5%">6</td><td colspan="3">Refund of FDW Service Fee</td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td width="5%"></td><td colspan="3">*  No refund of Fee if transfer is at FDW\'s request</td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td width="5%"></td><td colspan="3">*  Refund of one month salary to FDW if transferred by employer within 6 months</td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td width="5%">7</td><td colspan="3">Add Transfer Fee</td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td width="5%">8</td><td colspan="3">Other Charges (where applicable)</td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td>a</td><td colspan="3"><div style="width:460px;border-bottom:1px solid black; margin-top:5px;"></div></td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td>b</td><td colspan="3"><div style="width:460px;border-bottom:1px solid black; margin-top:5px;""></div></td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td>c</td><td colspan="3"><div style="width:460px;border-bottom:1px solid black; margin-top:5px;""></div></td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:25px;margin-top:-12px;"></div></td></tr>
  											<tr><td><br/><br/></td><td colspan="2"></td><td></td></tr>
                                            <tr><td></td><td colspan="2"></td><td><strong>Total Placement Fee :</strong></td><td><div style="width:90px;border:1px solid black;margin-left:60px;height:20px;"></div></td></tr>
  									          <tr><td colspan="4"><br/><br/></td></tr>
  											<tr><td colspan="5">I confirm that I understand and agree to pay various fees and schedule of payments stated in Part B.</td></tr>
  											<tr><td colspan="3"><br/><br/><br/><br/></td></tr>  											
  										<!--	<tr><td colspan="2"><div style="width:250px;border-bottom:1px solid black;"></div></td><td></td><td colspan="2"><div style="margin-left:15%;width:250px;border-bottom:1px solid black;"></div></td></tr>
  										-->	<tr><td colspan="2" style="font-size:10px;"><div style="width:250px;border-bottom:1px solid black;"></div><strong>Signed by FDW</strong></td><td></td><td colspan="2">&nbsp;<div style="margin-top:0px;margin-left:14.8%;width:250px;border-bottom:1px solid black;"></div><strong><span style="margin-left:50px;font-size:10px;margin-top:10px;">Signed for and on behalf</span><br/><span style="margin-left:50px;font-size:10px;">ISLAND MAIDS PTE LTD</span></strong></td></tr>';
  											
                                                      		
                                  $html.='</tbody>                                
                                </table>';										
                                  $html .='</div>
                                   
                               </div>';
						
							   
							   
							  $html.='<!--4 - Weekly rest day arrangement-->
							   
							    <div class="container" style="page-break-after: always;">
                                 <div class="header" style="height:0px;">     
                                                                   
                                   </div>
								     
  									<div class="content-wrapper" style="height:auto;">
  									
                                 
                   					 <div style="font-size:13px;text-align:center;font-weight:bold;text-decoration:underline;width:100%">
                                    	<div style="width:78%;margin-left:11%;">AGREEMENT BETWEEN FOREIGN DOMESTIC WORKER(FDW)AND EMPLOYER ON FDW WEEKLY REST DAY ARRANGEMENT</div>
                                    </div>   
										
									<table border="1" style="font-size:13px;border-collapse:collapse;margin-top:20px;margin-bottom:5px; width:100%;" cellpadding="6">
									
									<thead>
										<tr>
										<td><strong>Parties Involved</strong></td>
										<td><strong>FDW</strong></td>
										<td><strong>Employer</strong></td>
										</tr>
									</thead>
									
									<tbody>
										<tr><td>Name</td><td style="text-align:left;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</td><td style="text-align:left;">'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</td></tr>
										<tr><td>NRIC/Work Permit No.</td><td>'; if(isset($query->work_permit_no)){ $html.=strtoupper($query->work_permit_no);} $html.='</td><td  style="text-align:left;">'; if(isset($query->nric_no)){ $html.=strtoupper($query->nric_no);} $html.='</td></tr>
										
									</tbody>
									
									</table>
									  <br/>
										
									<div style="font-size:14px;">
										<span style="font-size:14px;text-align:justify;">This agreement is made between (a) <span style="text-decoration:underline;">the FDW</span> and (b) <span style="text-decoration:underline;">the Employer</span> in accordance with the Ministry of Manpower\'s regulations on the provision of a weekly rest day for FDWs.Please refer to Annex A on excerpt from the Employment of Foreign Manpower (Work Passes) Regulations.</span>
																		
									<br/>	 
								    <br/>
								   
									<span style="font-size:14px;text-decoration:underline;"><strong>Terms of Agreement</strong></span>
									<br/>	 
								    <br/>
																		
									<span style="font-size:14px;">We, the FDW and the Employer, agree that the employer shall grant the FDW:</span>
									<br/>	 
								    <br/>
									
									<span style="font-size:14px;"><strong>D</strong><span style="margin-left:40px;font-size:14px;">One rest day for every week. The rest day shall be granted on<span style="font-size:14px;"> _________________________</p>(day of <span style="margin-left:50px;font-size:14px;">the week</span>);</span></span>
									<br/>	 
								    <br/>
								    <span style="font-size:14px;"><strong>D</strong><span style="margin-left:40px;font-size:14px;">_______________rest days in a month on ________________________</p></span><span style="font-size:14px;">(day of the week) with<span style="margin-left:50px;font-size:14px;"> compensation</span> in lieu at $</span><span style="margin-left:150px;font-size:14px;"> for each rest day forgone. </span></span>
									
									<br/>	 
								    <br/>
									<br/>	 
								    <br/>
								    <span style="font-size:14px;">_________________________________</span> <span style="margin-left:19.6%;font-size:14px;">_________________________________</span>
									<span style="font-size:14px;">FDW\'s Signature</span> <span style="margin-left:41%;font-size:14px;">Employer\'s Signature</span>
									<br/>
									<span style="font-size:14px;">Date:</span> <span style="margin-left:51%;font-size:14px;">Date:</span>
									</div>
										<hr style="border:1px solid black;margin-top:50px;"/>
									<div style="font-size:14px;margin-top:10px;">
									  <br/>
										[For any subsequent variations that are agreed between the employer and FDW, the following record should be maintained]
																		
									<br/>	 
								    <br/>
																									
									<span style="font-size:14px;">We, the FDW and the Employer, agree that the employer shall grant the FDW:</span>
									<br/>	 
								    <br/>
									
									<span style="font-size:14px;"><strong>D</strong><span style="margin-left:30px;font-size:14px;">Rest day on</span>_________________________(date) in lieu of rest day forgone on_____________(date);</span>
									<br/>	 
								    <br/>
									<br/>
									<span style="font-size:14px;"><strong>D</strong><span style="margin-left:30px;font-size:14px;">Compensation in lieu at$</span>_________________________(minimum of 1 day\'s pay) for working on rest day</span><br/><br/><span style="margin-left:38px;font-size:14px;">on_________________________(date)</span>
									<br/>	 
								    <br/>
									<br/>	 
								    <br/>
								    <span style="font-size:14px;">_________________________________</span> <span style="margin-left:19.6%;font-size:14px;">_________________________________</span>
									<span style="font-size:14px;">FDW\'s Signature</span> <span style="margin-left:41%;font-size:14px;">Employer\'s Signature</span>
								  <br/>
									<span style="font-size:14px;">Date:</span> <span style="margin-left:51%;font-size:14px;">Date:</span>
									</div>';		
								
                                  $html .='</div>
                                   
                               </div>';
							   
							   						   		     
						   		    $html.=' <!--5 - Form 12B-->
							     <div class="container" style="page-break-after: always;">
                                 <div class="header" style="height:0px;">     
                                   </div>	  
  									<div class="content-wrapper" style="height:auto;">
                                    <div style="font-size:13px;text-align:center">
                                    	<span style="text-align:center;font-weight:bold;font-size:14px;">Form 12B For Work Permit Applicants/Holders Only</span>                                    	
                                    	<br/><span style="text-align:center;font-size:14px;">Immigration Act (Chapter 133)</span>
                                    	<br/><span style="text-align:center;font-size:14px;">Immigration Regulations [Regulations 12(2) and 12(5)]</span>                                    	
                                    </div>   
                   					<br/>
                   					
                   					<table>
                   						
                   						<tr><td colspan="2"><strong>Application For A</strong></td><td style="border-spacing:3%;"><strong><div style="width:10px;height:10px;border:1px solid black;"></div></strong></td><td><strong><span style="margin-left:10px;">Visit Pass [Regulations 12(2) and 12(5)]</strong></span></td></tr>
                   						<tr><td colspan="2"></td><td style="border-spacing:3%;"><strong><div style="width:10px;height:10px;border:1px solid black;"></div</strong></td><td><strong><span style="margin-left:10px;">Visa</strong></span></td></tr>
                   					</table>
							
									<table border="1" cellpadding="2" style="font-size:12px;border-collapse:collapse;margin-top:20px;margin-bottom:20px; width:100%;" cellpadding="0" cellspacing="0">
									<thead>
										<tr>
										<td colspan="2"><strong>Part A: Particulars of Applicant</strong></td>								
										</tr>
									</thead>
									
									<tbody>
										<tr><td style="height:20px;width:50%">Full Name in BLOCK LETTERS (Underline Surname)<br/><br/>'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=strtoupper($query->maid_name);} $html.='<br/><br/><br/></td><td style="height:20px;" valign="center">Name in Chinese Character, if applicable<br/><br/><br/><br/></td></tr>
										<tr> <td colspan="2">Alias, if any<br/><br/></td></tr>
										<tr> <td colspan="2">Work Permit Number:</td></tr>
                                                                                <tr><td colspan="2">
                                                                                <table>
										<tr rowspan="4"> <td>Have you ever been refused entry into or deported from any country?</td><td rowspan="4"><div style="border-left: thin solid #000;height:80px;margin-left:20px;">&nbsp;</div></td><td>*Yes / No</td></tr>
										<tr> <td>Have you ever been convicted in court of law in any country?</td><td>*Yes / No</td></tr>
										<tr> <td>Have you ever been prohibited from entering Singapore?</td><td>*Yes / No</td></tr>
										<tr> <td>Have you ever entered Singapore using a different Passport and Name?</td><td>*Yes / No</td></tr>
										</table>
                                                                                </td></tr>
                                                                                <tr> <td colspan="2">If Yes for any or all of the above, give details on a separate sheet of paper.</td></tr>
									</tbody>
									
									</table>
										
									<table border="1" style="font-size:12px;border-collapse:collapse;margin-top:10px;margin-bottom:10px;" width="100%" cellpadding="2" cellspacing="0">
									
									<thead>
										<tr><td colspan="3"><strong>Part B: Particulars of Local Sponsor</strong></td></tr>
									</thead>
									
									<tbody>
										<tr><td colspan="3">Please note that the local sponsor is responsible for the stay, maintenance and repatriation of the applicant.</td></tr>
																		
										<tr style="height:50px;" width="60%"> <td style="text-align:center;"><strong>Identity Card Number<br/>(applicable to Employer of <br/>Foreign Domestic Worker)</strong></td><td style="text-align:center;"><strong">Name and Address of Sponsor <br/>(Companys Stamp - if applicable)</strong></td><td style="text-align:center;width:15%;"><strong>Relationship to Applican</strong>t</td></tr>
										<tr>
										 <td>';if(isset($query->nric_no)){ $html.=strtoupper($query->nric_no);} $html.='<br/><br/><br/></td>
										<td>'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='<br/>'; if(isset($query->cus_address)){ $html.=ucwords(strtolower($query->cus_address));} $html.='<br/><br/><br/></td>
										 <td>EMPLOYER<br/><br/><br/></td>
										
										</tr>
									</tbody>
									
									</table>	
									
								
										<table border="1" style="font-size:12px;border-collapse:collapse;margin-top:20px;margin-bottom:20px; width:100%;" cellpadding="5" cellspacing="0">
									
									<thead>
										<tr><td colspan="2"><strong>Part C: Declaration By Applicant</strong></td></tr>
									</thead>
									
									<tbody>
										<tr><td colspan="2" style="border:none;">I hereby declare that all the particulars furnished by me in this application are true.</td></tr>
										<tr><td colspan="2" style="border:none;"></td></tr>
										<tr><td colspan="2" style="border:none;"></td></tr>
									
										<tr><td colspan="2" style="border:none;">I undertake not to misuse controlled drugs or to take part in any political or other activities during my stay in Singapore which would make me an undesirable or prohibited immigrant under the Immigration Act.</td></tr>
										<tr><td colspan="2" style="border:none;"></td></tr>
										<tr><td colspan="2" style="border:none;"></td></tr>
										
										<tr><td colspan="2" style="border:none;">I understand that if the Controller of Immigration is satisfied that I or any of my family member breaches this undertaking or becomes an undesirable or prohibited immigrant, he will cancel my Immigration Pass and the Passes of my family members, and we may be required to leave Singapore within 24 hours of such cancellation.</td></tr>
										<tr><td style="border:none;"></td><td style="border:none;"></td></tr>
										<tr><td style="border:none;"></td><td style="border:none;"></td></tr>
										<tr><td colspan="2" style="border:none;"></td></tr>
										<tr><td colspan="2" style="border:none;"></td></tr>
										<tr><td colspan="2" style="border:none;"></td></tr>
									
										<tr><td style="border:none;">&nbsp;_________________________________<br/><span style="margin-left:40px;">Signature of Applicant</span></td><td style="border:none;text-align:right;margin-right:25px;">______________________&nbsp;<br/><span style="margin-right:60px;">Date</span></td></tr>										
                                        <tr><td colspan="2" style="border:none;"></td></tr>
									</tbody>									
									</table>
									<div><em>(Delete where inapplicable)</em></div>
									<div style="width:100%;font-size:8px;" align="center">The above form is updated on 15 April 2004</div>
									<table><tr><td><div style="background-color:black;color:#fff;font-size:6px;width:35px;height:10px;padding-left:10px;">WPCM</div>
									</td><td><div style="width:20px;height:8px;background-color:white;font-size:6px;border:1px solid black;padding-left:4px;margin-left:-10px;">017</div></td></tr></table>';
									
                                  $html .='</div>
                                   
                               </div>';
							 
									 
							   
							 $html.='<!--7 - Authorisation Form - For Application of Work Permit (Foreign Domestic Worker)-->
										
								 <div class="container" style="page-break-after: always;">
                                 <div class="header" style="height:0px;">                                                                        
                                   </div>              									  
  									<div class="content-wrapper" style="height:auto;">
								    <div>
										<div>											
											 <img class="logo" src="'.$basePublic.'/assets/images/doc-checklist/manpower.png" style="margin-top:-10px;margin-left:70%;">
										</div>
										
										<div style="margin-top:20px;">
										<div>
											<div style="border:1 solid black;width:300px;height:80px;position:relative;">
												<div>
												<div style="font-size:15px;background-color:#e0e0e0;width:300px;">Authorised EA Name</div>
												<div style="border:1 solid black;"></div><br/>
												<strong><span style="font-size:22px;margin-top:15px;margin-left:20px;">ISLAND MAIDS PTE LTD</strong></span>
												
												</div>																																																												
											</div>			
																						
											<div style="height:100px;width:300px;position:absolute;left:50%;top:6%;font-size:15px;">Instructions:<br/><img src="'.$basePublic.'/assets/images/doc-checklist/instructions.png" style="height:95px;width:300px;"></div>
											</div>
										</div>
										
										<div align="center" style="margin-top:10px;font-size:13px;text-decoration:underline;">PRESCRIBED AUTHORISATION FORM FOR EMPLOYMENT AGENCY (EA) FOR FOREIGN DOMESTIC WORKER</div>
										
										<div align="center" style="margin-top:10px;font-size:13px;text-align:left;margin:10px 10px 0px 10px;">This authorisation letter shall only be <span style="text-decoration:underline;font-size:13px;">valid for 14 days from the date of employer\'s authorisation,</span> and only for the application / renewal / transfer / cancellation of the foreign domestic worker(s) listed below.</div>
										
										<table border="1" cellpadding="4" style="margin-top:10px;width:100%;border-collapse:collapse;">
                                        <tr><td style="background-color:#D9D9D9">Authorisation for :<br/>(choose only one. Separate forms to be used for other options.)</td>
                                        <td>
                                        <table style="margin-left:5px; margin-right:15px;">
                                        <tr>
                                        <td>Application for Foreign Domestic Worker(s)</td>
                                        <td> <div style="width:10px;height:10px;border:1px solid black;"></div> </td>
                                        </tr>
                                        </table> 
                                        </td>
                                        <td>
                                        <table style="margin-left:5px; margin-right:15px;">
                                        <tr>
                                        <td>
                                        Renewal for <br/>Foreign Domestic Worker(s)</td>
                                        <td> <div style="width:10px;height:10px;border:1px solid black;"></div> </td>
                                        </tr>
                                        </table> 
                                        </td>
                                        <td>
                                        <table style="margin-left:5px; margin-right:15px;">
                                        <tr>
                                        <td>
                                        Transfer of a<br/> Foreign Domestic Worker(s)</td>
                                        <td> <div style="width:10px;height:10px;border:1px solid black;"></div> </td>
                                        </tr>
                                        </table> 
                                        <td>
                                        <table style="margin-left:5px; margin-right:15px;">
                                        <tr>
                                        <td>
                                        Cancellation for Foreign Domestic Worker(s)</td>
                                        <td> <div style="width:10px;height:10px;border:1px solid black;"></div> </td>
                                        </tr>
                                        </table> 
                                        </tr>
                                        </table>
										
										<table border="1" width="100%" style="margin-top:10px;width:100%;border-collapse:collapse;" cellpadding="4">
										<tr><td colspan="3" style="background-color:#D9D9D9;text-align:center;">Part A - To be completed by Employer</td></tr>
										<tr><td width="10%">S/No.</td><td>Name of Foreign Domestic Worker(s)</td><td>Passport / FIN / WP No.</td></tr>
										<tr><td height="30px">1)</td><td>';if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</td><td>'; if(isset($query->passport)){ $html.=ucwords($query->passport);} $html.='</td></tr>
                                                                                <tr><td height="30px"></td><td></td><td></td></tr>
									</table>
										
										<table border="1" style="margin-top:10px;width:100%;border-collapse:collapse;" cellpadding="5">
										<tr><td style="width:20%;">Employer Name</td><td>';if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</td></tr>
										<tr><td>NRIC No./ FIN</td><td>';if(isset($query->nric_no)){ $html.=strtoupper($query->nric_no);} $html.='</td></tr>
										<tr><td>Contact No.</td><td>';if(isset($query->contact_no)){ $html.=ucwords(strtolower($query->contact_no));} $html.='</td></tr>
										<tr><td>Signature and Date</td><td style="text-align:right;"><span style="margin-left:80%;"/>';if(isset($query->contract_date)){ $html.=date('d-m-Y',strtotime($query->contract_date));} $html.='</span></td></tr>
										</table>
										
										<div style="width:100%;">Employer is to ensure that Part A is duly completed before the authorisation is signed and dated. Do not pre-sign a form or sign on incomplete form. Employers are to <span style="text-decoration:underline;font-size:12px;">cross out rows in Part A that are not filled.</span></div>
                                        <br/>
										<!-- <div> -->		
											<table width="100%">
											<tr>										
											<td width="51%">
											<table border="1" style="clear:all;margin-top:0px;border-collapse:collapse;width:100%;" cellspacing="10">
											<tr><td colspan="2" style="font-size:12px;background-color:#D9D9D9;text-align:center;"><strong>Part B - To be completed by Person submitting This<br/> form to EA<br/>Not applicable if employer/Rep is submitting form personally<br/></strong></td></tr>
											<tr><td width="30%;" style="font-size:13px;" height="25px;">Name</td><td>';/*if(isset($query->customer_name)){ $html.=ucwords(strtolower($query->customer_name));}*/ $html.='</td></tr>
											<tr><td height="25px;">NRIC No. / FIN*</td><td>';/*if(isset($query->nric_no)){ $html.=ucwords(strtolower($query->nric_no));}*/ $html.='</td></tr>
											<tr><td height="25px;">Contact No.</td><td>';/*if(isset($query->contact_no)){ $html.=ucwords(strtolower($query->contact_no));}*/ $html.='</td></tr>
											<tr><td height="65px;">Signature / Date</td><td></td></tr>											
											</table>
											<span>*EA to verify and enclose copy of identification card</span><br/>
											<div style="background-color:#000;color:#fff;font-size:12px;height:95px;width:100%;padding:5px;text-align: justify;">Note: EAs should contact employer directly to confirm that the person submitting this form to the EA is authorised to do so on behalf of the employer. EAs are advised to inform MOM immediately if the person submitting this form on behalf of the business employer refuses to provide his/her ID card and contact number for verification.</div>
										    </td>											
											
											<td>
											<table border="1" style="clear:all;border-collapse:collapse;clear: both;">
											<tr><td colspan="3" style="background-color:#D9D9D9;height:30px;"><br/><strong style="margin-left:10%;padding:10px;">Part C - To be completed by EA Personnel<br/><span style="margin-left:55%;">Receiving This Form</span></strong></td></tr>
                                            <tr><td colspan="3"><table border="1" style="border-collapse:collapse;" width="100%">
                                            <tr><td width="30%" height="25px;">Name</td><td colspan="2">'; if(isset($query->emp_name) && strlen($query->emp_name) <= 30) { $html.=ucwords($query->emp_name); } $html.='</td></tr>
											<tr><td height="25px;">Registration No.</td><td colspan="2">';if(isset($query->mom_reg_no)) { $html.=ucwords($query->mom_reg_no); } $html.='</td></tr>
											<tr><td height="25px;">Contact No.</td><td colspan="2">'; if(isset($query->mobile) && $query->mobile != 0) {$html.=$query->mobile;} $html.='</td></tr>
											</table>
                                            </td></tr>
                                                                                       
                                            <tr><td colspan="3" style="font-size:12px;"><strong>Checklist for Employment Agencies Personnel</strong></td></tr>
											<tr><td width="65%">I am aware of Para 9 of Employment Agencies Licensing Conditions</td><td colspan="2"><table><tr><td>Yes</td><td><div style="width:10px;height:10px;border:1px solid black;"></div></td></tr></table></td></tr>
											<tr><td>I have spoken to and verified with employer to confirm his / her authorisation</td><td colspan="2"><table><tr><td>Yes</td><td><div style="width:10px;height:10px;border:1px solid black;"></div></td></tr></table></td></tr>
											<tr><td>I have verified and enclosed a copy of identification card of employer or person submitting this form</td><td colspan="2"><table><tr><td>Yes</td><td><div style="width:10px;height:10px;border:1px solid black;"></div></td></tr></table></td></tr>
										        <tr><td colspan="3">
                                                                                          <table border="1" style="border-collapse:collapse;" width="100%">
                                                                                        <tr><td width="30%" height="25px;">Signature and Date</td><td colspan="2" style="text-align:right;">'; if(isset($query->contract_date)) { $html.=date('d-m-Y',strtotime($query->contract_date)); } $html.='</td></tr>
											</table>
                                                                                        </td></tr>
                                                                                        </table>
                                                                        		</td></tr>                 
											</table>
                                        <br/>
											<div style="text-align:right;font-size:10px;">Form - FDW001 (Version:1 May 2012)</div>
										</div> 
										
										</div>';
                                  $html .='</div>
                                   
                               </div> <br clear="all">';  
							
							 
							      $html.=' <!--6 - Pricing Schdule (Island Maids)-->
							   
							     <div class="container" style="border:1px solid black;page-break-after: always;">                                
  									<div class="content-wrapper" style="height:auto;">
                                       
                                   <table border-collapse="collapse" style="margin-bottom:0px; width:100%;font-size:12px;padding:0 5px 0 5px;" cellpadding="0" cellspacing="0">
                                
                                  <tbody>';
                                  
                                 
                                    $html.='<tr><td colspan="4"><strong>ISLAND MAIDS PTE LTD</strong></td><td rowspan="2" style="vertical-align:top;"><img width="150px" src="'.$basePublic.'/assets/images/logo.png" style="margin:20px 0 20px 0"></td></tr>
                                    		<tr><td colspan="4" style="vertical-align:top;">EA Licence No:13C6728</td><td></td></tr>
                                    		<tr><td colspan="4" style="font-size:11px;">PRICING SCHEDULE FOR NEW / REPLACEMENT /TRANSFER / RENEWAL OF FDW</span></td><td style="text-align:right;"><strong>FORM A</strong></td></tr>
                                    		<tr><td colspan="5" style="border:1px solid black;"></td></tr>
											
                                    		<tr><td colspan="5"><strong>PART A</strong></td></tr>
                                    		<tr><td  colspan="2">Name of FDW Selected</td><td colspan="2"><div style="width:auto;border:1px solid black;height:15px;text-align:left;padding:5px;margin-bottom:-10px;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</div></td><td><table><tr><td>Date:</td><td><div style="width:120px;border:1px solid black;height:15px;text-align:left;padding:5px;">'; if(isset($invoice->date)){ $html.=date('d-m-Y',strtotime($invoice->date));} $html.='</div></td></tr></table></td></tr>
                                    		<tr><td colspan="2">Nationality:</td><td colspan="2"><div style="width:auto;border:1px solid black;height:15px;text-align:left;padding:5px;">'; if(isset($query->nationality_name) && strlen($query->nationality_name) <= 30){ $html.=ucwords(strtolower($query->nationality_name));} $html.='</div></td></tr>                                    	
                                    		<tr><td  colspan="2">Passport No:</td><td colspan="2"><div style="width:auto;border:1px solid black;height:15px;text-align:left;padding:5px;">'; if(isset($query->passport)){ $html.=strtoupper($query->passport);} $html.='</div></td></tr>
                                    		<tr><td  colspan="2">Salary	:</td><td colspan="2"><div style="width:auto;border:1px solid black;height:15px;text-align:left;padding:5px;">'; if(isset($query->salary)){ $html.=ucwords($query->salary);} $html.='</div></td></tr>
                                    		<tr><td colspan=5 style="border:1px solid black;"></td></tr>
                                    		<tr><td  colspan="4"><strong><br/>PART B:Service Fees<br/></strong></td></tr>
                                    		<tr><td  colspan="3">The Service fee shall include the following:</td><td></td><td style="text-align:center;">S$</td></tr>
                                    		<tr><td>1.</td><td colspan="3"><span style="margin-left:-21%;font-size:12px;">Registration</span></td><td><div style="width:65%;border:1px solid black;height:10px;text-align:right;padding:5px;margin-left:20%;">'.$agencyFee.'</div></td></tr>
                                    		<tr><td>2.</td><td colspan="3"><span style="margin-left:-21%;">Documentation and Application/Collection of work permit</span></td><td><div style="width:65%;border:1px solid black;height:10px;text-align:right;padding:5px;margin-left:20%;">'.$insuranceFee.'</div></td></tr>
  											<tr><td>3.</td><td colspan="3"><span style="margin-left:-21%;">Medical Examination Fee (for the issuance of work permit</span>)</td><td><div style="width:65%;border:1px solid black;height:10px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>
  											<tr><td>4.</td><td colspan="3"><span style="margin-left:-21%;font-size:11px;width:160px;">Premium for the security bond and the Personal Accident Insurance (Comprehensive Plan)</span></td><td><div style="width:65%;border:1px solid black;height:10px;text-align:right;padding:5px;margin-left:20%;">'.$adminFee.'</div></td></tr>
  											<tr><td>5.</td><td colspan="3"><span style="margin-left:-21%;">One Way Ticket,Transportation and Facilities Fee</span></td><td><div style="width:65%;border:1px solid black;height:10px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>
  											<tr><td>6.</td><td colspan="3"><span style="margin-left:-21%;">Reimbursement of Indemnity Policy</span></td><td><div style="width:65%;border:1px solid black;height:10px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>
  											
  											<tr><td>7.</td><td colspan="3"><span style="margin-left:-21%;">Home Service</span></td><td><div style="width:65%;border:1px solid black;height:10px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>
  											<tr><td>8.</td><td colspan="3"><span style="margin-left:-21%;">Professional Back-Up Services</span></td><td><div style="width:65%;border:1px solid black;height:10px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>
  											<tr><td>9.</td><td colspan="3"><span style="margin-left:-21%;">Replacement Package Top-up</span></td><td><div style="width:65%;border:1px solid black;height:10px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>
  											<tr><td>10.</td><td colspan="3"><span style="margin-left:-21%;font-size:11px;">Cost for Replacement within the Maximum Replacement Period of ______ months / years</span></td><td><div style="width:65%;border:1px solid black;height:10px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>
  											<tr><td></td><td colspan="3"><span style="margin-left:-21%;">	*_____ Replacement within _____ months $ _________ (Admin Fee + Insuance</span>)</td><td><div style="width:65%;border:1px solid black;height:10px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>
  											<tr><td>11.</td><td colspan="3"><span style="margin-left:-21%;"> Other Services Provided (where applicable)</span></td></tr>
  											<tr><td  colspan="5">a<div style="width:300px;border-bottom:1px solid black;margin-left:75px;"></div></td></tr>
  											<tr><td colspan="5">b<div style="width:300px;border-bottom:1px solid black;margin-left:75px;"></div></td></tr>
  											<tr><td  colspan="5">c<div style="width:300px;border-bottom:1px solid black;margin-left:75px;"></div></td></tr>
  											<tr><td  colspan="5">d<div style="width:300px;border-bottom:1px solid black;margin-left:75px;"></div></td></tr>
  											<tr><td  colspan="5">e<div style="width:300px;border-bottom:1px solid black;margin-left:75px;"></div></td></tr>
  											<tr><td  colspan="5">Renewal of Work Permit<br/></td></tr>
  											
  											<tr><td colspan="4"><div style="width:375px;border-bottom:1px solid black;"></div></td><td><div style="width:65%;border:1px solid black;height:15px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>											
  											<tr><td colspan="3"></td><td><strong>Package Fee</strong></td><td><div style="width:65%;border:1px solid black;height:15px;text-align:left;padding:5px;margin-left:20%;"></div></td></tr>
  											<tr><td colspan="4" style="font-size:9px;"><strong>Payment of Service Fee as agreed in this schedule shall be made as  follows:</strong></td></tr>
  											<tr><td colspan="3" style="font-size:12px;">1 Deposit- On Confirmation of FDW through Bio Data</td><td style="text-align:right;">$'; if(isset($recAmount)){ $html.=number_format($recAmount,2,'.','');} $html.='<div style="width:150px;border-bottom:1px solid black;"></div></td></tr>
  											<tr><td colspan="3" style="font-size:12px;">2 Final Payment- On the arrival of FDW</td><td style="text-align:right;">$'; if(isset($recAmount) && isset($totalFee)){$html.=number_format($totalFee-$recAmount,2,'.','');} $html.='<div style="width:150px;border-bottom:1px solid black;"></div><br/></td></tr>
  											<tr><td colspan=5 style="border:1px solid black;"></td></tr>
  											
  											<tr><td  colspan="5"><strong>PART C:Placement Fees</strong></td></tr>
  											<tr><td colspan="5">Payment of Placement Fee as agreed in this schedule shall be made as follows (tick where applicable): </td></tr>
  											<tr><td><div style="width:35%;border:1px solid black;height:8px;text-align:left;padding:5px;margin-left:20%;"></div><td colspan="3">_______ post-dated cheques of S$ ____________ each</td></tr>
  											<tr><td><div style="width:35%;border:1px solid black;height:8px;text-align:left;padding:5px;margin-left:20%;"></div></td><td colspan="3" style="font-size:11px;"> Full sum payable upon *handover / signing of contract / others (please specify):</td><td><div style="width:150px;border-bottom:1px solid black; margin-top:-5px;"> '.$placementFee.'</div></td></tr>
  											<tr><td><div style="width:35%;border:1px solid black;height:8px;text-align:left;padding:5px;margin-left:20%;"></div></td><td colspan="2" style="font-size:12px;">Others (please specify):</td><td colspan="2"><div style="width:100%;border-bottom:1px solid black;margin-left:-30%;"></div></td></tr>
  											<tr><td colspan="4">I confirm that the Foreign Domestic Worker named in Part A of this schedule is selected by me and I agree to pay the various fees and schedule of payment stated in Parts B and C.<br/><br/><br/></td></tr>
											<tr><td colspan="2"><div style="width:80%;border-bottom:1px solid black;text-align:left;padding:5px;"></div></td><td></td><td></td><td><div style="width:80%;border-bottom:1px solid black;text-align:left;padding:5px;"></div></td></tr>
  											<tr><td colspan="2">Signature by Employer</td><td></td><td></td><td>Signed for and on behalf</td></tr>
  											<tr><td colspan="2">Name:&nbsp;'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</td><td></td><td></td><td>Island Maids Pte Ltd</td></tr>
  											<tr><td></td><td></td><td></td><td></td><td></td></tr>';
                                    		
                                  $html.='</tbody>                                
                                </table>';
                                  $html .='</div>
                                   
                               </div>';

                         
					
							        $html.='<!--9 - Authorisation for collection of work permit card-->
							   
							     <div class="container"style="page-break-after: always;">
                                 <div class="header" style="height:0px;">     
                                                                   
                                   </div>
								      
									  
  									<div class="content-wrapper" style="height:auto;">
                                       
                                  
								   <div style="font-size:14px;">
                                                                                Date:<span style="width:100px;border-bottom:1px solid black;margin-left:5px; text-decoration:underline;">';if(isset($query->contract_date) && $query->contract_date != ''){$html.=date('d-m-Y',strtotime($query->contract_date));} else { $html.='______________'; } $html.='</span>
																		
									<br/>	 
								    <br/>
								   
									<span style="font-size:14px;">To: Work Pass Service Centre (WPSC)</span>
									<br/>	 
								    <br/>
																		
									<span style="font-size:14px;">Dear Sir/Madam,</span>
									<br/>	 
								    <br/>
									
									<span style="font-size:14px;font-weight:bold;">RE: AUTHORISATION FOR COLLECTION OF WORK PERMIT CARD</span>
									<br/>	 
								    <br/>
                                                                    <table>
                                                                      <tr><td>Name of Applicant</td><td>:</td><td><div style="height:15px;width:200px;border-bottom:1px solid black;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</div></td></tr>
                                                                       <tr><td height="30px;">Work permit No</td><td>:</td><td><div style="height:15px;width:200px;border-bottom:1px solid black;text-transform:uppercase;">'; if(isset($query->work_permit_no)){ $html.=ucwords(strtoupper($query->work_permit_no)); } $html.='</div></td></tr>
                                                                    </table>
                                                                	<br/>	 
								    <br/>
                                                                        <span style="font-size:14px;">I hereby authorize <span style="margin-left:5px;margin-right:10px;text-decoration:underline;font-size:14px;">'; if(isset($query->emp_name) && strlen($query->emp_name) <= 30){ $html.=ucwords(strtolower($query->emp_name));} else { $html.='______________________________';} $html.='</span>Nric No:<span style="font-size:13px;text-decoration:underline;">'; if(isset($query->nric_fin_no) && $query->nric_fin_no !=''){ $html.=strtoupper($query->nric_fin_no);} else { $html.='__________________'; } $html.='</span></span> 
									<br/>	 
								    <br/>
									<span style="font-size:14px;">from <span style="margin-left:5px;text-decoration:underline;font-size:14px;">Island Maids Pte Ltd</span> to collect the work permit card on my behalf.</span>
									<br/>	 
								    <br/>
                                    <br/>     
                                    <br/>
									<span style="font-size:14px;">Thank You.</span>
									<br/>	 
								    <br/>
								    <br/>	 
								    <br/>
								    <br/>	 
								    <br/>
								    <span style="font-size:14px;">Yours faithfully,</span>
								    <br/>	 
								    <br/>
								    <br/>	 
								    <br/>
                                    <table style="width:100%;" cellpadding="5">
                                        <tr><td style="width:120px;">Employer\'s Name</td><td style="width:2%;">:</td><td width="250"><div style="width:200px;border-bottom:1px solid black;">'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td><td rowspan="2"><span style="margin-top:10px;">______________________</span></br><span style="margin-left:40px;">Company Stamp</span></td></tr>
                                        <tr><td>Nric No</td><td width="2%">:</td><td width="250"><div style="width:200px;border-bottom:1px solid black;">'; if(isset($query->nric_no)){ $html.=strtoupper($query->nric_no);} $html.='</div></td></tr>
                                    </table>
			   	   <!-- <br/><br/>
			            <span style="font-size:14px;">Nric No:<span style="text-decoration:underline;font-size:14px;">'; if(isset($query->nric_no)){ $html.=strtoupper($query->nric_no);} $html.='</span></span>
				    -->
                                     </div>';
										
                                  $html .='</div>
                                   
                               </div>


							   
													   				   							     <!--10 - JOB SCOPE Annex A-->';
							   
							                       $html.='<div class="container" style="page-break-after: always;margin-top:-1%"> 
                                 				  
  									     <div class="content-wrapper" style="height:auto;">
                                        <div style="font-size:15px;">
										<div style="text-align:right;font-size:14px;text-decoration:underline;"><strong><em>Annex A</em></strong></div><br/>
										<span style="font-size:16px;"><strong>Job Scope Sheet for Foreign Domestic Worker</strong></span><br/><br/>										
										<span style="font-size:16px;"><strong>Employment Agency Name: <span style="font-size:17px;">ISLAND MAIDS PTE LTD<span></strong></span><br/>
										<span style="font-size:16px;"><strong>License No<span style="margin-left:17%;font-size:17px;">: 13C6728</span></strong></span><br/>
										<span style="font-size:16px;"><strong>Reference No<span style="margin-left:14.5%;font-size:17px;">: ';if(isset($query->contract_no)){$html.=ucwords(strtoupper($query->contract_no));} $html.='</span></strong></span><br/><br/>
										<span style="font-size:15px;">This job scope sheet pertains to the job offer made by the <i>Employer</i> to the <i>FDW</i>. It shall be translated into the FDW\'s language and given to her before she signs the employment contract.</span><br/><br/>
										
										<hr style="border-color:black;"/>
										<br/>	
										<span style="font-size:15px;text-decoration:underline;">Particulars of Parties</span><br/><br/>
                                                                                <table width="100%">
                                                                                    <tr><td colspan="4"><em>The Employer</em></td></tr>
                                                                                    <tr><td width="13%">Full Name:</td><td><div style="width:95%;border-bottom:1px solid black;font-size:14px;">'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td><td width="20%">NRIC/Passport No.:</td><td><div style="width:90%;border-bottom:1px solid black;">'; if(isset($query->nric_no)){ $html.=strtoupper($query->nric_no);} $html.='</div></td></tr>
                                                                                    <tr><td colsapn="4"></td></tr>
                                                                                    <tr><td colspan="4"><em>The Foreign Domestic Worker (FDW)</em></td></tr>
                                                                                    <tr><td>Full Name:</td><td><div style="width:95%;border-bottom:1px solid black;font-size:14px;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</div></td><td>Passport No.:</td><td><div style="width:90%;border-bottom:1px solid black;">'; if(isset($query->passport)){ $html.=strtoupper($query->passport);} $html.='</div></td></tr>                                                                                   
                                                                                </table>                                                                                       
										<br/>
										<span style="text-decoration:underline;font-size:14px;">Job Scope</span><br/>
										<span style="font-size:14px;">1.Persons in household of Employer\'s family: </span><br/>
										<span style="margin-left:50px;font-size:14px;">_____ adults </span><br/>
										<span style="margin-left:50px;font-size:14px;">_____ young adults aged 13 to 18 </span><br/>
										<span style="margin-left:50px;font-size:14px;">_____ children aged 5 to 12 </span><br/>
										<span style="margin-left:50px;font-size:14px;">_____ children aged between 3 to 5  </span><br/>
										<span style="margin-left:50px;font-size:14px;">_____ infants/babies below 3 </span><br/>
										<span style="margin-left:50px;font-size:14px;">_____ person(s) requiring constant care and attention (excluding babies) </span><br/><br/>
										<span style="font-size:14px;">2.The FDW shall be required to perform domestic duties as follows (to tick where applicable):</span><br/>
										<div style="margin-left:50px;">
											<table>
												<tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td><span style="margin-left:5px;font-size:14px;">Household chores</span></td></tr>
												<tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td><span style="margin-left:5px;font-size:14px;">Cooking</span></td></tr>
												<tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td><span style="margin-left:5px;font-size:14px;">Looking after aged person(s) in the household [constant attention is *required/not required]</span></td></tr>
												<tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td><span style="margin-left:5px;font-size:14px;">Baby-sitting</span></td></tr>
												<tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td><span style="margin-left:5px;font-size:14px;">Child-minding</span></td></tr>
												<tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td><span style="margin-left:5px;font-size:14px;">Others (please specify):</span></td></tr>
											</table>
                                                                                        <br/>
                                                                                <div style="width:70%;border-bottom:1px solid black;margin-left:14px;"></div><br>
                                                                                <div style="width:70%;border-bottom:1px solid black;margin-left:14px;"></div>
										</div>
										<br/>
									
										<span style="font-size:14px;">3.Place of Work (to tick where applicable):</span><br/>
										<div style="margin-left:50px;">
											<span style="margin-left:6px;font-size:14px">a)House Type:</span>
											<ul style="list-style-type:circle;">
												<li>Landed Property</li>
												<li>Condominium/ Private Apartment</li>
												<li>HDB 5-room or larger </li>
												<li>Baby-sitting </li>
												<li>HDB _____-Room Flat <em>(specify no. of rooms)</em></li>
												<li>Others ____________________________ <em>(specify)</em></li>
											</ul>
											<span style="margin-left:6px;font-size:14px">b)	Number of Bedrooms in the house: _______</span>
										</div><br/><br/>
										<span style="font-size:14px;">Employer Signature: _______________________ </span><span style="font-size:14px;">FDW Signature: _______________________ </span>	
									</div>
										
                                 </div>                                   
                               </div>';
							   
							   
					

                                                                        $html.='<!--8 - Handling n taking over form-->
                               
                                 <div class="container" style="page-break-after: always;clear:both;margin-top:15px;">
                                                      
                                    <div class="content-wrapper" style="height:auto;">
                                   <div>
                                        <div>
                                            <span style="font-size:16px;">ISLAND MAIDS PTE LTD<br/> 
                                            <span style="margin-top:-20px;"><strong>License No: 13C6728</strong></span>
                                        </div>
                                        <div style="float:right;">
                                            <img width="170px" class="logo" src="'.$basePublic.'/assets/images/logo.png" style=";margin-left:70%;margin-top:-5%;"></span></br>          
                                        </div>
                                        <br/>
                                        <div style="font-size:15px;margin-top:50px;">FACILITATION AND/OR HANDLING & TAKING OVER OF FOREIGN DOMESTIC WORKER</div>
                                        <br/><br/>
                                        <span style="font-size:13px;"><strong>Information check sheet</strong></span>
                                        
                                        <br/><br/>
                                        <span style="font-size:11px;"><strong>Handling & Taking Over Form</strong></span>
										<br/><br/>
                                    </div>
									
									<table border="1" cellspacing="0" cellpadding="8" width="100%">
										<tr>
										<td>
											<table cellpadding="5" width="100%">
											 <tr><th colspan="2">Information </th></tr>
											
											 <tr><td>Reference No:</td><td width="60%"><div style="width:100%;border-bottom:1px solid black;">';if(isset($query->contract_no)){ $html.=ucwords(strtoupper($query->contract_no));} $html.='</div></td></tr>
											 
											 <tr><td>Employer\'s Name:</td><td><div style="width:100%;border-bottom:1px solid black;">';if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td></tr>
											 
											 <tr><td>Address:</td><td><div style="width:100%;border-bottom:1px solid black;">';if(isset($query->cus_address)){ $addr = explode('#',$query->cus_address); $addr1 = current($addr); $addr2 = '#'.end($addr);  $html.=ucwords(strtolower($addr1));} $html.='</div></td></tr>
											 <tr><td></td><td height="15px;"><div style="width:100%;border-bottom:1px solid black;">'.$addr2.'</div></td></tr>
											 <tr><td></td><td height="15px;"><div style="width:100%;border-bottom:1px solid black;"></div></td></tr>
											 
											 <tr><td>FDW\'s Name:</td><td><div style="width:100%;border-bottom:1px solid black;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</div></td></tr>
											 
											 <tr><td>Passport No:</td><td><div style="width:100%;border-bottom:1px solid black;">'; if(isset($query->passport)){ $html.=strtoupper($query->passport);} $html.='</div></td></tr></table></td>
											 
										<td>
											<table cellpadding="5" width="100%">
											
											 <tr><td width="50%"><strong>Facilitation</strong></td><td><strong>DATE</strong></td></tr>
   											 <tr><td>*Application of WP:</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr> 
											 <tr><td>*Approval of WP:</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>*Submission of BG/Ins:</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>*ETA of FDW:</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>*Medical Check-up:</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>*Thumbprint:</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>*Collection of Documents</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 </table>									
										</td>
										</tr>
										
										<tr><td><strong>Documents to be handed to FDW personally</strong></td><td><strong>Handling over of FDW and Documents To Employer</strong></td></tr>
										
												<tr>
												
											<td>
											<table cellpadding="5" width="100%">
											
											 <tr><td><strong>Description</strong></td><td><strong>SIGNATURE</strong></tr>
   											 <tr><td>* Employment Contract</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr> 
											 <tr><td>* FDW Passport</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>* Work Permit</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>* Medical Report</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>* FDW Handy Guidebook <br/> from MOM</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 </table>									
											</td>
										
										<td>
											<table cellpadding="5" width="100%">
											
											 <tr><td><strong>Description</strong></td><td><strong>SIGNATURE</strong></tr>
   											 <tr><td>* Service Contract:</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr> 
											 <tr><td>* Employment Contract:</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>* B/Guarantee</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>* Insurance:</td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 <tr><td>* Medical Report<br/> </td><td><div style="width:100px;border-bottom:1px solid black;"></div></td></tr>
											 </table>									
										</td>
										</tr>
									</table>   
                                        <br/>
                                         <table style="font-size:11px;" cellpadding="2" width="100%">    
										   
                                            <tr><td>I,</td><td width="25%"><div style="border-bottom:1px solid black;margin-left:-40%;width:100%">'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td><td width="45%">,NRIC/Passport No<span style="margin-left:85px;">:</span><span style="text-decoration:underline;">'; if(isset($query->nric_no) && $query->nric_no!=''){ $html.=strtoupper($query->nric_no).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';} $html.='</span>';if($query->nric_no == '') { $html.='____________'; } $html.='<span> hereby confirm that</span></td><td></td><td width="3%"></td></tr>
                                          <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td></tr>
										   <tr><td></td><td width="25%"><div style="border-bottom:1px solid black;width:100%;margin-left:-45%">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</div></td><td width="60%" style="font-size:11px;">,(Name of FDW) NRIC/Passport No &nbsp;:<span style="text-decoration:underline;">'; if(isset($query->passport)){ $html.=strtoupper($query->passport);} $html.=' </span>';if($query->passport == '') { $html.='____________&nbsp;'; } $html.='<span>is the FDW selected by me</span></td><td></td><td width="4%"><br/></td></tr>
										   <tr><td>&nbsp;</td><td><br/>&nbsp;</td><td>&nbsp;</td><td></td></tr>

                                           <tr><td colspan="4">and I take the custody and responsibility of the FDW with effect from _________________________________</td><td colspan="1"></td></tr>
                                          <tr><td>&nbsp;</td><td><br/>&nbsp;</td><td>&nbsp;</td><td></td></tr>
                                          <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td></tr>
                                          
                                          <tr><td colspan="2"><span> ____________________________ <br/>Signature of employer</span></td><td colspan="2"></td></tr>
                                          <tr><td><span >Name:</span></td><td colspan="4"><div style="border-bottom:0px solid black;width:60%;margin-left:-30px;">'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td></tr>
                                         </table>                                                                          
                                        
                                   </div>';
                                        
                                  $html .='</div>                                   
                               </div>';
                                 
                               

										   							$html.='  <!--11 - Maids Contract-->
							   
							     <div class="container" style="page-break-after: always;">
                                 <div class="header" style="height:0px;">     
                                                                   
                                   </div>
								     								      
									  <!--<div class="row rowbg">
                                        <span class="span-high_dk">ISLAND MAIDS PTE LTD - </span><span class="span-high">Your Choice For Excellent Service!</span>
                                        <div class="blackstrip"></div>
                                      </div>-->                                      
									  
  									<div class="content-wrapper" style="height:auto;">
                                       
                                  
								   <div style="font-size:15px;line-height:24px; text-align:justify;">
										<div align="center"><span style="font-size:14px;"><strong>MAID\'S CONTRACT</strong></span></div>
										<span>1) You are employed as a maid for two years contract. (Anda di ambil sebagai pekerja pembantu rumah selama dua tahun mengikut perjanjian contract.)</span><br/>															
										<span>2) Your monthly salary is S$ __________ per month with no day off.(Gaji anda ialah S$ ___________  sebulan tanpa hari cuti.)</span><br/>
										<span>3) On completion of contract,your employer will pay for your passage back to Indonesia.(Selepas tamat contract anda,majikan anda akan membayar pembelanjaan untuk balik ke Indonesia)</span><br/>
										<span>4) However,should you resign than you must pay your passage back to indonesia.(Tetapi,jikalau anda berhenti kerja,anda hendaklah membayar pembelanjaan untuk balik ke Indonesia sendiri.)</span><br/>
										<span>5) Should you commit theft,fraud or dishonest act you will be repatriated.(Jikalau anda melakukan kesalahan seperti kecurian,penipuan atau pecah amanah anda akan segeradihantar pulang.)</span><br/>
										<span>6) You are not allowed to make calls unless with the permission of your employer.(Anda tidak dibenarkan menggunakan talifon tanpa izin dari majikan anda)</span><br/>
										<span>7) Should you make any oversea calls you must pay for the charges incurred.(Jikalau anda membuat panggilan talifon ke luar negeri,anda mesti membayarnya sendiri)</span><br/>
										<span>8) You must promise not to bring friends or relatives to the house.(Anda dikehendaki berjanji untuk tidak membawa kenalan dan saudara mara anda di rumah majikan anda.)</span><br/>
										<span>9) At all times you are expected to maintain a high standard of personal hygiene.(Pada setiap masa anda dikehendaki untuk menjaga kebersihan diri anda dengan baik.)</span><br/>
										<span>10) You must perform all duties/tasks assigned to you.(anda dikehendaki untuk membuat segala pekerjaan yang diberi kepada anda.)</span><br/>
										<span>11) You are not allowed to pray in the house.(Anda dibenarkan/tidak dibenarkan bersolat di rumah majikan anda.)</span><br/>
										<span>12) Must follow employers instruction and have manners.(Harus ikut arahan majikan dan harus bersopan santun)</span><br/>
										<span>13) Be honest. Any dishonest act, the employer will report to police.(tidak boleh ambil barang majikan,jika ambil majikan boleh melaporkan pada polis.)</span><br/>
										<span>14) Do not take or use things without permission, if require any, please ask.(Tidak boleh gunakan barang tanpa izin,jika ingin pakai,tanya dahulu.)</span><br/>
										<span>15) Anything you do not understand or have doubts concerning children or household matters,you may ask questions. However, do not ask things which does not concern you.(Jika anda tidak mengerti atau ada sesuatu hal tentang anak atau rumah,harus bertanya.)</span><br/>
										<span>16) After bringing children to school, go home straight away, do not loiter around downstairs or corridor.(Sesudah bawa ank pergi sekolah,cepat pulang.)</span><br/>
										<span>17) Must not tell lies.(Tidak boleh bohong.)</span><br/>
										<span>18) Do not sleep or watch tv when employer is not at home.(Tidak boleh tidur atau tonton tv jika majikan tiada di rumah.)</span><br/>
										<br/>
										<span style="font-size:12px;">I,<span style="text-decoration:underline;margin:0 5 0 5px;font-size:12px;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</span>hereby agree and accept the above mentioned terms condition for employment.</span><br/>
										<span style="font-size:12px;">Saya,<span style="text-decoration:underline;margin:0 5 0 5px;font-size:12px;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</span>setuju dan menerima segala perkara yang dijelaskan dan difahamkan yang tertulis di atas.)</span><br/>
										<br/>
										<span style="font-size:14px;"> ____________________________<span style="margin-left:35%;font-size:14px;">____________________________</span></span><br/><span style="margin-left:0px;font-size:14px;">Employer\'s Signature & Date<span style="margin-left:41%;font-size:14px;">Maid\'s Signature & Date<span></span><br/>
										<span style="font-size:14px;">Name:<span style="text-decoration:underline;margin:0 5 0 5px;">'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</span></span>
									</div>';
										
                                  $html .='</div>
                                   
                               </div>
							   
							   
							   
												     <!--12 - Declaration of Maids valuable and belonging-->
							   
							     <div class="container" style="page-break-after: always;">
                                 <div class="header" style="height:0px;">     
                                                                   
                                   </div>
								     
									  <!--<div class="row rowbg">
                                        <span class="span-high_dk">ISLAND MAIDS PTE LTD - </span><span class="span-high">Your Choice For Excellent Service!</span>
                                        <div class="blackstrip"></div>
                                      </div>-->                                      
									  
  									<div class="content-wrapper" style="height:auto;">
                                       
                                  
								   <div style="font-size:15px;margin-top:25px;" cellspacing="10">
										<table width="100%">
											<tr><td width="17%"><strong style="font-size:14px;">  MAID\'S NAME <span style="margin-left:11px;">:</span></strong></td><td><div style="font-size:14px;border-bottom:1px solid black;margin:0 5 0 5px;width:45%;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</div></td></tr>
											<tr style="margin-top:10px;"><td style="font-size:14px;"><strong>PASSPORT NO <span>:</span></strong></td>
                                            <td>';
                                            if(isset($query->passport) && !empty($query->passport))
                                            {
                                                $html.='<div style="font-size:14px;border-bottom:1px solid black;margin:0 5px 0 5px;width:45%;">'; if(isset($query->passport)){ $html.=strtoupper($query->passport);} $html.='</div>';
                                            }
                                            else
                                            {
                                                $html.='<div style="font-size:14px;border-bottom:1px solid black;margin:7px 5px 0 5px;width:45%;"></div>';
                                            }
                                            $html.='</td></tr>
										</table>										
											
										<br/>													
										<span style="font-size:17px;"><strong>DECLARATION OF MAID\'S PERSONAL VALUABLES AND BELONGINGS</strong></span><br/><br/><br/>
										<table border="1" style="border-collapse:collapse;width:80%;" cellpadding="10" cellspacing="10">
										<thead>
										<tr><th>CURRENCY</th><th>AMOUNT</th><th>REMARKS</th></tr>
										</thead>
										<tbody>
										<tr><td>RUPIAH</td><td></td><td></td></tr> 
										<tr><td>S$</td><td></td><td></td></tr>
										<tr><td>OTHERS</td><td></td><td></td></tr>										
										<tr><td><div style="border:2px solid black;margin:30px -8 30px -8;text-align:center;"><strong>VALUABLES</strong></div>RINGS</td><td></td><td></td></tr>
										<tr><td>EARRINGS</td><td></td><td></td></tr>
										<tr><td>NECKLACES</td><td></td><td></td></tr>
										<tr><td>WATCH</td><td></td><td></td></tr>
										<tr><td>HAND PHONE</td><td></td><td></td></tr>
										<tr><td><div style="border:2px solid black;margin:30px -8 30px -8;text-align:center;"><strong>OTHERS</strong></div></td><td></td><td></td></tr>
										</tbody>
										</table>
										
																		
										
										<br/><br/>
										<span style="font-size:15px;">Signed by FDW<span style="margin-left:30px;font-size:16px;">:</span> ____________________________</span>
										<br/><br/>
										
										<table width="100%">
											<tr><td width="21%">Checked by<span style="margin-left:52px;font-size:16px;">:</span></td><td><div style="width:43%;border-bottom:1px solid black;margin:0 5 0 -5px;font-size:12px;">'; if(isset($query->emp_name) && strlen($query->emp_name) <= 30){ $html.=ucwords(strtolower($query->emp_name));} $html.='</div></td></tr>
										</table>
									
										<br/><br/>
										<span style="font-size:15px;">Signed by Employer<span style="font-size:16px;">:</span> ____________________________</span><span style="font-size:15px;margin-left:10%;">Date: __________________</span>
										<br/><br/>
										<br/><br/>
										<span style="font-size:15px;">Remarks<span style="margin-left:75px;font-size:16px;">:</span><div style="width:71%;border-bottom:1px solid black;margin-left:147px;"></div></span>
									</div>';
										
                                  $html .='</div>                                  
                               </div>			
							   
							  				<!--Form-13-->
							   				
						      <div class="container p-text-size span-text-size" style="text-align:justify; page-break-after: always;font-size: 13px;font-family: Arial, Helvetica, sans-serif;width:70%;margin-left:15%;">
                                    <div>
									<br clear="all"/>
									<br clear="all"/>
                                                    <p align="center" style="font-size: 15px;">
                                                        <strong>STANDARD EMPLOYMENT CONTRACT <br/>BETWEEN FOREIGN DOMESTIC WORKER AND EMPLOYER</strong>
                                                    </p>
                                                    
                                                   <table style="font-size: 15px;">
                                                       <tr><td><strong>Employment Agency Name :</strong></td><td> <span style="text-decoration:underline;"><strong>ISLAND MAIDS PTE LTD</strong></span> </td></tr>
                                                   
                                                        <tr><td><strong>License No.<span style="margin-left:112px;">:</span></strong></td><td><span style="text-decoration:underline;"><strong>13C6728</strong></span></td></tr>
                                                 
                                                       <tr><td><strong>Reference No.<span style="margin-left:95px;">:</span></strong></td><td><span style="text-decoration:underline;"><strong>';if(isset($query->contract_no)){ $html.=ucwords(strtoupper($query->contract_no));} $html.='</strong></span></td></tr>
                                                   </table>
                                                   <br/>
                                                    <p>  
                                                        This employment contract is made between (a) The Employer and (b) The Foreign Domestic Worker (FDW) in <em>Se</em><em>c</em><em>t</em><em>ion A</em><em>,</em><em> </em>based on the terms contained in <em>S</em><em>e</em><em>ction B.</em> 
                                                    </p>
                                                 
                                                    <p>
                                                        A copy of the <span style="text-decoration:underline;font-size:13px;">Contract (with all blanks filled in and options selected)</span> and Job Scope Sheet <em>(Annex A)</em>translated into the
                                                        FDW\'s language should be given to the FDW in her home country before she signs the contract.
                                                    </p>
                                                    <p>
                                                        The <span style="text-decoration:underline;font-size:13px;">Schedules of Salary Payment and Loan (including loan for placement fee) Repayment <em>(Annex B)</span></em>
                                                        shall be filled up at the same time the contract is signed.
                                                    </p>
                                              
                                                    <p style="font-size: 15px;"> 
                                                        <strong>Section A: Particulars of Parties in Contract <hr style="margin-top:0px;"/></strong>
                                                    </p>

                                                    <p>
                                                        (a) The Employer
                                                    </p>
                                                                                                   
                                                        <table style="font-size: 13px;margin-left:13px;" width="100%">
                                                           <tr><td width="35%">Full Name <span style="margin-left:85px;">:</span></td><td><div style="height:15px; border-bottom:1px solid; width:200px;">'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td></tr>
                                                       
                                                            <tr><td>NRIC/Passport No.<span style="margin-left:36px;">:</span></td><td><div style="height:15px; border-bottom:1px solid; width:200px;">'; if(isset($query->nric_no)){ $html.=strtoupper($query->nric_no);} $html.='</div></td></tr>
                                                     
                                                           <tr><td>Address<span style="margin-left:100px;">:</span></td><td><div style="height:15px; border-bottom:1px solid; width:300px;">'; if(isset($query->cus_address)){ $html.=ucwords(strtolower($query->cus_address));} $html.='</div></td></tr>
                                                       </table>

                                                       <br/>
                                                    <p>
                                                        (b) The Foreign Domestic Worker (FDW)
                                                    </p>                    
                                                
                                                      <table style="font-size: 13px;margin-left:13px;" width="100%">
                                                           <tr><td width="35%">Full Name <span style="margin-left:85px;">:</span></td><td><div style="height:15px; border-bottom:1px solid; width:200px;">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</div></td></tr>
                                                       
                                                            <tr><td>Work Permit No.<span style="margin-left:52px;">:</span></td><td><div style="height:15px; border-bottom:1px solid; width:200px;">'; if(isset($query->work_permit_no)){ $html.=strtoupper($query->work_permit_no);} $html.='</div></td></tr>
                                                     
                                                           <tr><td>Passport No<span style="margin-left:75px;">:</span></td><td><div style="height:15px; border-bottom:1px solid; width:200px;">'; if(isset($query->passport)){ $html.=strtoupper($query->passport);} $html.='</div></td></tr>
                                                       </table>

                                                <br clear="all"/>

                                                </div>
                                                <br clear="all"/>
                                                <br clear="all"/>
                                                <br clear="all"/>
                                                <div>
                                                    <p style="font-size: 15px;">
                                                        <strong>Section B: Terms of Contract <hr style="margin-top:0px;"/></strong>
                                                    </p>
                                                    <p>
                                                        <span style="text-decoration:underline;font-size:14px;">Part I: Employment Period and Workplace</span>
                                                    </p>
                                                    <p>
                                                         l. The FDW shall be employed by the Employer as a domestic worker for a period specified in the FDW\'s work permit.
                                                    </p>
                                                    <p>
                                                        2. The FDW shall work and reside only in the Employer\'s residence as specified in the FDW\'s work permit.
                                                    </p>
                                                   
                                                </div>
                                                <br clear="all"/>
                                                <br clear="all"/>
                                                <br clear="all"/>
												  <br clear="all"/> 
												   <br clear="all"/>
                                                <div>
                                                    <p  style="line-height:20px;">
                                                        <span style="text-decoration:underline;font-size:14px;">Part II: Responsibilities of the FDW</span>
                                                    </p>
                                                    <p style="line-height:20px;">
                                                        3. The FDW shall undertake to perform her work diligently and honestly at all times.
                                                    </p>
                                                    <p style="line-height:20px;">
                                                        4. The FDW shall not take up, or be required by the Employer to take up, any other employment with any other person(s).
                                                    </p>
                                                    <br clear="all"/>
                                                    <p  style="line-height:20px;">
                                                        <span style="text-decoration:underline;font-size:14px;">Part III : Remuneration and Benefits</span>
                                                    </p>
                                                    
                                                     <p style="line-height:20px;">
                                                      5. The Employer shall pay the FDW wages of SGD ______ per month.
                                                    </p>

                                                    <p style="line-height:20px;">
                                                        6. The salary shall be paid on the ______ day of every month.
                                                    </p>                                             
              
                                                    <p style="line-height:23px;">
                                                        7. The FDW shall acknowledge the amount received under her signature in the attached Schedule of Salary Payment (Annex B) as proof of payment. Where
                                                        applicable, the FDW shall make a monthly loan (including loan for placement fee) repayment with the Employment Agency, through monthly payments to the
                                                        employer in accordance with the Schedule of Loan (including loan for placement fee) Repayment in Annex B.
                                                    </p>

                                                    <p style="line-height:20px;">
                                                        8. The salary will be paid by *cash <em>I </em>crediting into the FDW\'s bank account <em>(delete where applicable).</em>
                                                    </p>

                                                    <p style="line-height:20px;">
                                                        9. The Employer shall provide the FDW with suitable accommodation <span style="text-decoration:underline;font-size:13px;">in accordance with MOM\'s guidelines</span>, with a reasonable amount of privacy. Please tick
                                                        where applicable:
                                                    </p>
                                                    
                                                        <div style="margin-left:10px;line-height:25px;">
                                                            <ul style="list-style-type:circle;">
                                                                <li>Share a room with ______ child/children</li>
                                                                <li>Separate room</li>
                                                                <li>Others (please  specify):</li>
                                                            </ul>
                                                            <div style="border-bottom:1px solid black;width:60%;margin-top:5px;margin-left:40px;"></div><br/>
                                                            <div style="border-bottom:1px solid black;width:60%;margin-top:5px;margin-left:40px;"></div>

                                                        </div>

                                                    <p style="line-height:20px;">
                                                        10. The Employer shall provide at least three adequate meals a day to the FDW, over and above the salary paid.
                                                    </p>
                                                    <p style="line-height:23px;">
                                                        11. The Employer shall provide the FDW with ______ hours<strong> [recommended 8 hours]</strong> of continuous rest daily (except for occasional special-care cases), with
                                                        reasonable rest periods during working hours.
                                                    </p>
                                                    <p style="line-height:23px;">
                                                        12. The FDW shall be entitled to *one <em>I </em>two <em>I </em>three <em>I </em>four rest day(s) a month, on a day mutually agreed        <em>(*delete where applicable). </em>If the rest day was not taken, the FDW shall be compensated in cash as agreed in writing between the employer and
                                                                the FDW. If there is no such existing agreement, the accreditation body\'s prevailing compensation guideline shall apply.
                                                    </p>
                                                
                                                    <p style="line-height:23px;">
                                                        13. Should both parties (Employer and FDW) agree to extend this contract, she (the FDW) shall be entitled to ______ days <strong>[recommended 15 days]</strong> of paid home
                                                        leave (inclusive of a return ticket to her City of origin).
                                                    </p>
                                                    <p style="line-height:25px;">
                                                        14. If the FDW does not wish to utilize her leave as stated in clause 13, the Employer shall pay the FDW *a lump sum equivalent to the return ticket to
                                                        her City of origin <em>I </em>a lump sum of S$ <em>(delete where applicable).</em>
                                                    </p>
                                                    <p style="line-height:25px;">
                                                        15. In the event that the FDW falls ill or suffers personal injury during the period of employment, except for the period the FDW leaves Singapore of
                                                        her own volition and for her own personal purposes, the Employer shall bear all the necessary treatment costs, including medical consultation,
                                                        medicine, hospitalization and others.
                                                    </p>
                                                    <p style="line-height:23px;">
                                                        16. External communications shall be made available for the FDW and the employer must allow the FDW seek the advice/help of the relevant
                                                        bodies/authorities such as the Employment Agency, Ministry of Manpower etc at all times.
                                                    </p>
                                                    <p style="line-height:23px;">
                                                        17. The employer shall provide safe working conditions for the FDW at all times.
                                                    </p>

                                                    <br/>

                                                    <p style="line-height:23px;">
                                                        <span style="text-decoration:underline;font-size:14px;">Part IV : Termination</span>
                                                    </p>
                                                
                                                    <p style="line-height:22px;">
                                                        18. Either party may terminate this Contract by giving ______ notice <strong>[recommended at least one week]</strong>.
                                                    </p>
                                                
                                                    <p style="line-height:23px;">
                                                        19. Either party may terminate the Contract without notice if either party is in breach of the work permit condition(s).
                                                    </p>
                                                    <p style="line-height:23px;">
                                                        20. In cases where the employer decides to terminate the contract under any circumstances, the employer should ensure the FDW\'s proper upkeep until she
                                                        is repatriated or transferred to another employer, whichever is applicable.
                                                    </p>
                                                    <p style="line-height:23px;">
                                                        21. The employer shall be responsible to bear the cost of repatriation of the FDW at all times.
                                                    </p>
                                                    <p style="line-height:23px;">
                                                        22. Upon termination or expiry of the contract, the Employer shall bear the cost of repatriating the FDW back to [her town/city of origin] in ______ [country]
                                                    </p>
                                                   
                                                    <p style="line-height:20px;">
                                                        23. Should both parties agree to renew this employment relationship, a new employment contract shall be signed by both the employer and the FDW.
                                                    </p>
                                                </div>
                                                <br clear="all"/>
                                                <div>
                                                    <p style="line-height:20px;">
                                                        <span style="text-decoration:underline;font-size:14px;">Part V : Others</span>
                                                    </p>
                                                    <p style="line-height:20px;">
                                                        24. Any substantial variation or addition to the terms of this Contract shall be deemed void unless made with the consent of both parties to the
                                                        Contract and a witness through signatories.
                                                    </p>
                                                    <p style="line-height:20px;">
                                                        25. In the event of any conflict or inconsistency between any term of this Contract (including the Annexes) in the English language and any translation
                                                        thereof in any other language, the English language version of this Contract shall prevail.
                                                    </p>
                                                    <p style="line-height:20px;">
                                                        26. Any dispute arising from this Contract shall be referred to the Employment Agency for mediation. [f it cannot be settled, the dispute can be
                                                        referred at the election of either party to an alternative dispute resolution mechanism.
                                                    </p>
                                                    <p style="line-height:20px;">
                                                        27. In the case whereby any term of the contract contradicts the existing Work Permit conditions or any Singapore government regulations, the latter
                                                        two shall supersede.
                                                    </p>
                                                </div>
                                                <br clear="all"/>
                                                <div>
                                                    <p style="line-height:20px;">
                                                        <span><strong>Section C: Employer\'s Declaration <hr style="margin-top:0px;"/></strong></span>
                                                    </p>
                                               
                                                    <p style="line-height:20px;">
                                                        I have read and understood the contents of this Contract, and hereby agree to abide by it.
                                                    </p>
                                                 
                                                     <div>
                                                       <table style="font-size: 13px;margin-left:-5px;" width="100%" border="0" cellpadding="5">
                                                           <tr><td width="60%">The Employer\'s Signature</td><td width="2%">:</td><td><div style="border-bottom:1px solid black;width:90%;margin-top:7px;"></div></td></tr>
                                                           <tr><td>Witnessed by (Name & Signature)</td><td>:</td<td><div style="border-bottom:1px solid black;width:90%;margin-top:7px;">'; if(isset($query->emp_name) && strlen($query->emp_name) <= 30){ $html.=ucwords(strtolower($query->emp_name));} $html.='</div></td></tr>
                                                           <tr><td>Date<span style="margin-left:170px;"></span></td><td>:</td<td><div style="border-bottom:1px solid black;width:90%;margin-top:7px;"></div></td></tr>
                                                       </table>
                                                      </div>

                                                    <p style="line-height:20px;">
                                                        <span><strong>Section D: Foreign Domestic Worker\'s Declaration<hr style="margin-top:0px;"/></strong></span>
                                                    </p>
                                                    <p style="line-height:20px;">
                                                        I have read and understood the contents of this Contract, and hereby agree to abide by it.
                                                    </p>
                                                  <div>
                                                       <table style="font-size: 13px;margin-left:-5px" width="100%" cellpadding="5">
                                                           <tr><td width="60%">The Foreign Domestic  Worker\'s  Signature</td><td width="2%">:</td><td><div style="border-bottom:1px solid black;width:90%;margin-top:7px;"></div></td></tr>
                                                           <tr><td>Witnessed by (Name & Signature)</td><td>:</td><td><div style="border-bottom:1px solid black;width:90%;margin-top:7px;">'; if(isset($query->emp_name) && strlen($query->emp_name) <= 30){ $html.=ucwords(strtolower($query->emp_name));} $html.='</div></td></tr>
                                                           <tr><td>Date</td><td>:</td><td><div style="border-bottom:1px solid black;width:90%;margin-top:7px;"></div></td></tr>
                                                       </table>
                                                   </div>


                                                </div>
                                                <br clear="all"/>
                               </div>
							   				
                               
							            <!--Form 14-->
                                         <div class="container p-text-size text-size" style="page-break-after: always;width:82%;margin-left:9%;">
                                  <div>
                                    <p align="center" style="font-size:13px;">
                                        <strong>SERVICE AGREEMENT</strong><br/>
                                        <strong>BETWEEN FOREIGN DOMESTIC WORKER EMPLOYER AND EMPLOYMENT AGENCY</strong>
                                    </p>
                                 
                                    <p>                                        
                                        <table><tr><td><strong>Employment Agency Ref No. :</strong></td><td>';if(isset($query->contract_no)){ $html.=ucwords(strtoupper($query->contract_no));} $html.='<div style="border-bottom:1px solid black;width:100px;"></div></td></table>
                                    </p>

                                    <p>                                      
                                        <br/>Parties to this agreement are to retain a signed copy of this agreement.
                                    </p>
                                    <hr/>
                                    <p>
                                        <table><tr><td><strong>This Service Agreement is dated</strong></td><td width="80px">';if(isset($query->contract_date)){ $html.=date('d-m-Y',strtotime($query->contract_date));} $html.='<div style="border-bottom:1px solid black;width:80px;"></div></td><td>(dd/mm/yyyy) and made between:</td></table>                                        
                                    </p>     
                                    <br/>';    
                                        if(isset($query->branch_address)){ 
                                            $addr = explode('#',$query->branch_address);
                                            $add1 = current($addr);
                                            $add2 = '#'.end($addr);
                                        }
                                    $html.='<div style="font-size:13px;width:100%"> 
                                        <table width="100%" cellpadding="5">
                                        <tr><td width="60%">(A) Full Name of Employment Agency (<strong>Agency</strong>)</td><td>:</td><td><div style="border-bottom:1px solid black;width:210px;">ISLAND MAIDS PTE LTD</div></td></tr>
                                        <tr><td style="padding-left:22px;">Employment Agency License Number</td><td>:</td><td><div style="border-bottom:1px solid black;width:210px;">13C6728</div></td> </tr>
                                        <tr><td style="padding-left:22px;">Registered Business Address<!--<span style="margin-left:82px;">:</span>--></td><td>:</td><td><div style="border-bottom:1px solid black;width:220px;">'.ucwords($add1).'</div><div style="border-bottom:1px solid black;width:210px;">'.ucwords($add2).'</div></td></tr>
                                        </table>
                                    </div>
                                </div>
                                <br/>
                                 <div style="font-size:13px;width:100%"> 
                                        <table width="100%" cellpadding="5" border="0">
                                        <tr><td width="57%">(B) Full Name of Employer (<strong>Employer</strong>)<!--<span style="margin-left:45px;">:</span>--></td><td>:</td><td><div style="border-bottom:1px solid black;width:210px;">';if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td></tr>
                                        <tr><td style="padding-left:22px;">NRIC/Passport Number<!--<span style="margin-left:113px;">:</span>--></td><td>:</td><td><div style="border-bottom:1px solid black;width:210px;">';if(isset($query->nric_no)){ $html.=strtoupper(strtolower($query->nric_no));} $html.='</div></td> </tr>
                                        <tr><td style="padding-left:22px;">Address<!--<span style="margin-left:200px;">:</span>--></td><td>:</td><td><div style="border-bottom:1px solid black;width:210px;">';if(isset($query->cus_address)){ $html.=ucwords(strtolower($query->cus_address));} $html.='</div></td></tr>
                                        </table>
                                </div>

                                <div>
                                    <p>
                                        It is hereby agreed between the parties that:
                                    </p>
                                    <p>
                                        1. <strong><span style="margin-left:15px;text-align:justify;">Appointment of Services</span></strong>
                                    </p>                                    
                                       
                                         <div style="font-size:13px;text-align:justify;margin-left:38px;line-height:17px;"><span style="margin-left:-38px;margin-right:10px">1.1</span>
                                           The Employer hereby appoints the Agency to secure the services of a Foreign Domestic Worker(FDW) (set out in the <em>Services &amp; Fees Schedule</em>) for a contract of service on the terms and conditions that appear below.
                                        </div>                                        
                                        <br/>
                                         <div style="font-size:13px;text-align:justify;margin-left:38px;line-height:17px;"><span style="margin-left:-38px;margin-right:7px">1.2 </span>
                                           The period of this Service Agreement shall be from the date of signing this Service Agreement for a period of <u>6 months</u> or the validity of
                                            the work permit whichever is shorter, and subject to the clauses 3-5 on Replacement and Refund.</span>
                                        </div>
                                        <br/>
                                          <div style="font-size:13px;text-align:justify;margin-left:38px;line-height:17px;"><span style="margin-left:-38px;margin-right:10px">1.3</span>
                                            The Agency shall handover the FDW to the employer within <strong> <u>90 </u>days </strong>after obtaining the "Letter of Notification to bring FDW
                                            into Singapore" by Ministry of Manpower, subject to the conditions under Clause 3.1, Table 1. The Agency and Employer shall check against the 
                                            "Handing and Taking-Over Form" during the handing/taking-over process</span>.
                                        </div>
                                  
                                    <p>
                                        2. <strong><span style="margin-left:13px;">Fees Payment</span></strong>
                                    </p>
                                    <p style="line-height:20px;text-align:justify;">
                                        2.1 <span style="margin-left:6px;">In consideration of the services to be provided by the agency, the Employer shall pay the </span> <span style="margin-left:30px;">following Fees as set out in the <em>S</em><em>ervices &amp; Fees Schedule</em>:</span>
                                    </p>
                               
                                    <p>
                                        i.<u> <span style="margin-left:50px;">Service Fee Charged on Employer</span></u>
                                    </p>
                                  
                                </div>
                               
                                <div>
                                    
                                    <table style="font-size:13px;margin-left:42px;">
                                        <tr><td>Total Service Fee of S$</td><td width="100px"><div style="border-bottom:1px solid black;width:100px;">';if(isset($totalFee)){ $html.=number_format($totalFee,2,'.','');} $html.='</div></td><td>shall be paid to the Agency for the services</td></tr>
                                        <tr><td colspan="3">rendered in the following manner:</td></tr>
                                    </table>
                                    <br/>
                                    <table style="font-size:13px;margin-left:42px;">
                                        <tr><td>a. <span style="margin-left:30px;">A deposit of S$</span></td><td width="100px"><div style="border-bottom:1px solid black;width:100px;">';if(isset($recAmount)){ $html.=number_format($recAmount,2,'.','');} $html.='</div></td><td>(if any)<em>, </em>shall be paid in full before the Agency</td></tr>
                                        <tr><td colspan="3"><span style="margin-left:40px;">submits the Employer\'s application to the Ministry of Manpower (MOM).</span></td></tr>
                                    </table>
                                    <br/>
                                    <table style="font-size:13px;margin-left:42px;">
                                        <tr><td>b. <span style="margin-left:30px;">The balance of S$</span></td><td width="100px"><div style="border-bottom:1px solid black;width:100px;">';if(isset($recAmount) && isset($totalFee)){ $html.=number_format($totalFee-$recAmount,2,'.','');} $html.='</div></td><td>when the FDW reports for work/ duty.</td></tr>
                                    </table>                                  
                                </div>

                               <br/><br/><br/><br/><br/>
                                <div>
                                    <p>
                                        ii. <u>Placement Fee</u>
                                    </p>
                                
                                </div>
                                
                                <div>
                                    <table style="font-size:13px;margin-left:5px;">
                                        <tr><td>a.<span style="margin-left:25px;">The Placement fee of S$</span></td><td width="120px"><div style="border-bottom:1px solid black;width:100px;">';if(isset($placementFee)){ $html.=ucwords(strtolower($placementFee));} $html.='</div></td><td width="250px;">(if any)<em>,</em>comprises (1) service fee charged</td></tr>
                                        <tr><td colspan="3"><span style="margin-left:40px;">on the FDW by the Agency and (2) personal loan incurred by FDW overseas.</span></td></tr>
                                    </table>

                                    <p style="margin-left:50px;line-height:20px;text-align:justify;">
                                        (1) Service fee charged on the FDW by the Agency<br/>
                                        (2) Personal loan incurred by FDW overseas
                                    </p>
                                    
                                    <div style="font-size:13px;text-align:justify;margin-left:50px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">b.</span>
                                      The Employer agrees to pay the placement fee on behalf of the FDW which the Employer may recover from the FDW as determined in the employment contract.
                                    </div>

                                    <p style="text-align:justify;line-height:20px;">
                                        2.2 <span style="margin-left:20px;">Apart from the Service Fee, the Agency confirms that there are no hidden or other costs or </span><span style="margin-left:40px;">expenses that the Employer shall be liable for except
                                        those, if any, under this Agreement.</span>
                                    </p>
                                    <p style="text-align:justify;line-height:20px;"> 
                                        2.3 <span style="margin-left:20px;">All payments shall</span>
                                        <strong>*include / exclude</strong> the prevailing Goods and Services Tax (GST).
                                    </p>
                                    <p style="text-align:justify;line-height:20px;">
                                        3. <strong><span style="margin-left:25px;">Replacement of FDW before FDW is placed to employer</span></strong>
                                    </p>

                                     <div style="font-size:13px;text-align:justify;margin-left:50px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">3.1</span>
                                        If the FDW is unable to be placed to the Employer, the Agency <strong>shall </strong>provide the Employer with a replacement FDW at <u>no additional cost</u> and which shall not count towards the Employer\'s <u>entitlement in clause 4.1</u>
                                    </div>
                                   <br/>
                                   <div style="font-size:13px;text-align:justify;margin-left:50px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">3.2</span>
                                       The Agency may provide the Employer with a replacement FDW at no additional cost under the following circumstances
                                    </div>
                                   <br/>
                                   <div style="border:1px solid black;margin-left:25px;width:105%;">
                                        a)<span style="margin-left:10px;">The FDW is found to have breached any Work Permit Conditions or is blacklisted by the MOM.</span><br/>
                                        b)<span style="margin-left:10px;">The FDW failed her first full medical examination in Singapore</span><br/></span>                                    
                                        c)<span style="margin-left:10px;">The FDW is homesick and/or refuse to work before she commences work.<br/></span>                                    
                                        d)<span style="margin-left:10px;">The FDW is unable to come to Singapore for whatsoever reason(s) to take up the intended </span><span style="margin-left:25px;">employment.</span>
                                   </div>
                                   <br/>
                                     <div style="font-size:13px;text-align:justify;margin-left:50px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">3.3</span>
                                      In the event that the FDW needs to be repatriated before she is placed to the Employer, the Agency shall be responsible for and bear the cost of
                                        repatriation of the FDW to the international port of entry that affords her reasonable access to her hometown within her home country
                                    </div>
                                   <br/>
                                      <div style="font-size:13px;text-align:justify;margin-left:50px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">3.4</span>
                                        In the event that the Employer opts not to have a replacement FDW in the circumstances stated in clause 3.1 when the FDW(s) who matches the
                                        Employer\'s selection criteria is available, the Employer shall be entitled to a refund of 50% of the service fee.
                                    </div>
                                   <br/>

                                     <div style="font-size:13px;text-align:justify;margin-left:50px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">3.5</span>
                                        After a replacement has been accepted by the Employer, the Employer <strong>shall not </strong>be entitled to any refund of the service fee for the
                                        replacement FDW as set out in the <em>Services and Fees Schedule- Form B </em>(if any) has been paid.
                                    </div>
                                    
                                    <p style="text-align:justify;line-height:20px;">
                                        4.<strong><span style="margin-left:35px;">Replacement of FDW after FDW is handed over to employer</span></strong>
                                    </p>

                                   <div style="font-size:13px;text-align:justify;margin-left:50px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.1</span>
                                        According to the <em>Services &amp; Fees Schedule</em>, the Employer is entitled to <strong>one </strong>FDW replacement(s) from the Agency within a period of _____ month(s) (\'replacement period\') over and above the Employer\'s entitlement as stated in clause 3.1. A new fees schedule for replacement (Form B) contained within this Agreement shall be signed. However,
                                        the Employer may request for a replacement only after the FDW has worked for the Employer for a minimum of  <strong>30 days</strong>(which should be
                                        before the expiry of the replacement period). This replacement period shall be applicable to all subsequent replacements, if the Employer is entitled
                                        to more than 1 replacement. The grant of replacement is subject to the following:</span>
                                    </div>
                                   
                                </div>

                                <br clear="all"/>

                                <div>                                  
                                    <p style="text-align:justify;">
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px"> 4.1.1</span>The Employer must sign the Consent to Transfer Form from the Work Pass Division, Ministry of Manpower (\'MOM\') to allow the FDW to seek employment
                                        with the new Employer.
                                        </div>                                                                            
                                    </p>

                                    <p style="text-align:justify;">
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.1.2</span>The Employer shall agree to transfer the FDW to a new employer specified by the Agency and will not in any way prevent or jeopardize the FDW\'s
                                        transfer or opportunity to seek re-employment with the new employer, unless the FDW is medically unfit to work as a domestic worker or has committed a
                                        criminal offence in Singapore. The Employer must make the FDW available to the Agency for <u>21</u> days for her to be interviewed and successfully
                                        transferred. During this period, the employer shall bear the cost of providing the FDW with food and lodging at a rate of <strong> $20 per day </strong>
                                        in addition to the levy payable. Employer shall not recover these fees from the FDW If the Agency is unable to transfer the FDW within <u>21</u> days,
                                        the Agency shall update the Employer on the FDW\'s transfer status. Beyond this period, the Employer may repatriate the FDW and cancel her Work Permit.
                                        </div>
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.1.3</span>  If the Employer decides to terminate the services of the FDW, the Employer shall inform the Agency for settlement of any outstanding issues
                                        between the FDW and Agency.
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.1.4</span>The replacement FDW shall be of the same selection criteria as the previous FDW unless both parties explicitly agree to the contrary. In the
                                        event that an Employer selects a replacement FDW of a different selection criteria, the Employer shall have to pay the difference in the prescribed
                                        package and replacement fee, if applicable.
                                        </div>                                          
                                    </p>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.1.5</span>The replacement shall take effect within <u>3</u> month(s). After which time, if the Agency fails to provide a replacement, the Employer may
                                        choose to terminate this Agreement, subject to the clauses under Section 5 on Refund Policy.
                                        </div>                                         
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:50px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">4.2</span> The Employer reserves the right to reject the intended replacement and terminate this Agreement if the replacement does not fulfil Employer\'s
                                        selection criteria (based on the original selection criteria). In such case, the Employer <strong>shall not </strong>be entitled to a refund of the
                                        Service Fee charged on him as stipulated in Clause 2.1(i) except for a pro-rated amount of placement fee paid to the Agency which will be refunded
                                        within 30 days.
                                        </div>                                          
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:10px;"><span style="margin-left:-50px;margin-right:30px">5.</span>
                                            <strong>Refund Policy for Service Fee and Placement Fee</strong>
                                        </div>                                        
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:15px;"><span style="margin-left:-50px;margin-right:25px">5.1</span>
                                           <u>If FDW has not been placed to Employer</u>
                                        </div>      
                                       
                                    </p>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:20px">5.1.1</span>
                                        The Agency agrees to place the FDW to the Employer within <strong>90 days </strong>of the date of this contract, failing which the Employer is
                                        entitled to terminate this Service Agreement and obtain 90% refund of the service fee and a pro-rated refund of placement fee paid to the Agency.
                                        </div>                                            
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:20px">5.1.2</span>
                                        If the Employer terminates the agreement in writing with the Agency, the Employer shall be entitled to a refund of the Service Fee (if any)        <em>less </em>the administrative charge (as stipulated in table below) from the Agency within 1 <strong>month(s) </strong>as listed below [*To delete
                                        accordingly]:
                                        </div>                                           
                                    </p>
                                    <br/>
                                    <table border="1" cellspacing="0" cellpadding="10" width="100%">
                                        <tbody>
                                            <tr style="background-color:#ccc;">
                                                <td width="29" valign="top"> 
                                                </td>
                                                <td width="300" valign="top">                                                
                                                        <strong>Event</strong>                                                
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">                                                   
                                                        <strong>Administrative</strong>                                                  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top" style="text-align:center;">                                                    
                                                        i                                                    
                                                </td>
                                                <td width="300" valign="top">                                                   
                                                        <strong><em>Before </em></strong>
                                                        the submission of the Work Permit application to MOM.                                                   
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">                                                    
                                                        $200.00                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top" style="text-align:center;">                                                    
                                                        ii                                                    
                                                </td>
                                                <td width="300" valign="top">                                                    
                                                        <strong><em>After </em></strong>
                                                        the submission of the Work Permit application to MOM.                                                    
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">                                                    
                                                        $400.00                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top" style="text-align:center;">                                                    
                                                        iii                                                    
                                                </td>
                                                <td width="300" valign="top">                                                   
                                                        <strong><em>If </em></strong>
                                                        the FDW Work Permit application is rejected by MOM due to no fault of the Agency
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">                                                    
                                                        $400.00                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br clear="all"/>
                                <br/>
                                <br/>
                                <div>
                                    <table border="1" cellspacing="0" cellpadding="5" style="font-size:13px;">
                                        <tbody>
                                            <tr>
                                                <td width="29" valign="top" style="text-align:center;">
                                                        iv
                                                </td>
                                                <td width="300" valign="top">                                                    
                                                        <strong><em>After </em></strong>                                                      the Letter of Notification by MOM but <strong><em>before </em></strong>FDW arrives Singapore                                                    
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">                                                    
                                                        $1,000.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top"  style="text-align:center;">
                                                        v
                                                </td>
                                                <td width="300" valign="top">                                                
                                                        <strong><em>After </em></strong>
                                                        the Letter of Notification by MOM and <strong><em>after </em></strong>FDW arrives Singapore                                                
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">
                                                        $1300.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="29" valign="top" style="text-align:center;">
                                                        vi
                                                </td>
                                                <td width="300" valign="top">                                                    
                                                        <strong><em>After </em></strong>
                                                        the Letter of Notification, by MOM, relating to FDW on transfer                                                    
                                                </td>
                                                <td width="104" valign="top" style="text-align:center;">                                                    
                                                        $500.00
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">5.2</span>
                                           <u>If FDW has been placed with Employer and if FDW can be transferred</u>
                                        </div>                                             
                                    </p>
                                    <p style="margin-right:50px;">
                                         <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:20px;border:0px solid;"x><span style="margin-left:-50px;margin-right:25px">5.2.1</span>
                                            The Agency shall refund the following amounts to the Employer as stated in the table below, should the Employer decide to terminate the FDW
                                            prematurely and the FDW is successfully transferred to another employer. This is subject to the Employer returning the FDW to the Agency and agreeing
                                            to the FDW\'s transfer to a new employer specified by the Agency without in any way preventing or jeopardizing the FDW\'s transfer or opportunity to seek
                                            re-employment with a new employer.
                                        </div>                                    
                                    </p>
                                    <br/>
                                    <table border="1" cellspacing="8" cellpadding="0" style="border-collapse:collapse;">
                                        <tbody>
                                            <tr style="background-color:#ccc;" style="text-align:center;">
                                                <td width="38" valign="top">                                                    
                                                        <strong>S/N</strong>                                                    
                                                </td>
                                                <td width="230" valign="top">                                                  
                                                        <strong>Description</strong>                                                   
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        <strong>Service Fee </strong>                                                                                                      
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                    
                                                        <strong>Placement Fee</strong>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="38" valign="top" style="text-align:center;">                                                   
                                                        i                                                   
                                                </td>
                                                <td width="230" valign="top">                                                    
                                                        FDW is successfully transferred to another Employer                                                    
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                   
                                                        No Refund                                                  
                                                </td>
                                                <td width="90" valign="top" style="text-align:center;">                                                   
                                                        Pro-rated refund                                                   
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:20px;"><span style="margin-left:-50px;margin-right:20px">5.2.2</span>
                                          The refund shall be effected within <u>4</u> week(s) from the date of termination of the FDW or the date the FDW was transferred, whichever is
                                          later.
                                        </div>                                          
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">5.3</span>
                                          <u>If FDW has been placed with Employer and if FDW cannot be transferred</u>
                                        </div>                                         
                                    </p>
                                    
                                     <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:20px;"><span style="margin-left:-50px;margin-right:20px"> 5.3.1</span>
                                            Under the following circumstances, the Agency shall refund the following amounts to the Employer as stated in the table below:
                                        </div>                                         
                                    </p>
                                    

                                    <table border="1" cellspacing="15" cellpadding="7" style="border-collapse:collapse;font-size:13px;width:70%;">
                                        <tbody>
                                            <tr style="background-color:#ccc;">
                                                <td width="25" valign="top" style="text-align:center;">                                                    
                                                        <strong>S/N</strong>                                                    
                                                </td>
                                                <td width="230" valign="top">                                                  
                                                        <strong>Description</strong>                                                    
                                                </td>
                                                <td width="75" valign="top" style="text-align:center;">                                                    
                                                        <strong>Service Fee</strong>
                                                </td>

                                                <td width="75" valign="top">                                                   
                                                        <strong>Placement Fee</strong>                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align:center;">                                                
                                                        i                                                   
                                                </td>
                                                <td valign="top">                                                   
                                                        FDW is unwilling and/or unable to continue employment in Singapore due to no fault of the employer. The                                                 
                                                        employer shall bring the FDW to the agency for settlement.                                                   
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                   
                                                        Pro-rated                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align:center;">                                                 
                                                        ii                                                  
                                                </td>
                                                <td valign="top">
                                                        FDW has been assigned to another                                                     
                                                        Agency by MOM
                                                </td>
                                                <td valign="top" style="text-align:center;">
                                                        No Refund
                                                </td>
                                                <td valign="top" style="text-align:center;"> 
                                                        No Refund
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align:center;">
                                                        iii
                                                </td>
                                                <td valign="top">
                                                        FDW goes to another agency (not assigned by MOM)
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                                <td valign="top" style="text-align:center;">
                                                        No Refund
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align:center;">                                                 
                                                        iv                                                  
                                                </td>
                                                <td valign="top">
                                                        FDW is repatriated by the employer
                                                </td>
                                                <td valign="top" style="text-align:center;">
                                                        No Refund
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                  
                                                        No Refund                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align:center;">                                              
                                                        v                                                   
                                                </td>
                                                <td valign="top">                                                    
                                                        FDW suffers from any mishap or accident                                                    
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                   
                                                        No Refund                                                    
                                                </td>
                                                <td valign="top" style="text-align:center;">
                                                    No Refund                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align:center;">
                                                        vi
                                                </td>
                                                <td valign="top">                                                    
                                                        Employer is in breach of any provisions of this agreement, any applicable law or regulation (including Work Permit Conditions)                                                    
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                            </tr>
                                            <tr height="20px;">
                                                <td valign="top" style="text-align:center;">                                                   
                                                        vii                                                    
                                                </td>
                                                <td valign="top">                                                    
                                                        FDW is missing                                                    
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                            </tr>
                                            <tr height="20px;">
                                                <td valign="top" style="text-align:center;">                                                   
                                                        viii                                                   
                                                </td>
                                                <td valign="top">                                                   
                                                        Employer refuses to sign the consent to transfer form for whatever reasons for the FDW to seek new employment                                                   
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                  
                                                        No Refund                                                   
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="text-align:center;">                                                    
                                                        viii                                                    
                                                </td>
                                                <td valign="top">                                                   
                                                        FDW develops illness (eg: skin rashes, etc) during her employment and is unable to get a new employer                                                   
                                                </td>
                                                <td  valign="top" style="text-align:center;">                                                   
                                                        No Refund                                                    
                                                </td>
                                                <td valign="top" style="text-align:center;">                                                    
                                                        No Refund                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br clear="all"/>
                               <br clear="all"/>

                                <div>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:20px">5.3.2</span>
                                            The refund shall be effected within <strong>4 week(s) </strong>from the end of the waiting period stipulated in clause 4.1.2/the date the FDW is
                                        assigned to another agency by MOM/the date the Agency is informed that the FDW selects another agency, whichever is applicable.
                                        </div>                                          
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:100px;line-height:17px;"><span style="margin-left:-50px;margin-right:20px">5.3.3</span>
                                            If the FDW has been assigned to another Agency by MOM or other relevant authorities, the Employer shall bear all the costs incurred, including
                                        medical expenses, food and accommodation costs for the duration of the relevant authorities\' investigation in any event and regardless of the outcome.
                                        </div>                                         
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:30px">6.</span>
                                            <strong>Special Provisions</strong>
                                        </div>                                       
                                    </p>

                                      <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">6.1</span>
                                            The Agency should exercise due diligence in ensuring the accuracy of all personal information given in the bio-data of the FDW, within the agency\'s
                                             reasonable control to check and verify.
                                        </div>                                        
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">6.2</span>
                                           The Agency shall ensure that the FDW arrives on time as scheduled, but should there be any delay not caused by the Agency, the Agency will not be
                                           liable for any claims made by the Employer for consequential loss or delay.
                                        </div>                                         
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">6.3</span>
                                           The Employer shall permit the Agency or such authorised persons as the Agency may appoint to visit the work location to determine the welfare of
                                            the FDW and to observe and adjudge the performance of her obligations to the Employer or Agency.
                                        </div>                                        
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">6.4</span>
                                          If the Employer requests for the Agency to provide food and accommodation, and should the Agency agree to do so, the Employer shall pay        <strong>$20 per day </strong>to the Agency for provision of this service. These costs cannot be recovered from the FDW.
                                        </div>                                        
                                    </p>

                                    <p>
                                      <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:30px">6.5</span>
                                          Should the Agency agree to provide food and accommodation for the FDW as stated in clause   6.4, the <strong>Employer shall remain legally responsible for the FDW</strong>. This includes but is not limited to bearing the costs of the FDW\'s
                                          medical expenses. Prior to providing food and accommodation for the FDW, the Agency shall inform the Employer that the Employer is legally                                       
                                         responsible for <br/>the FDW.
                                         
                                      </div>                                           
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">6.6</span>
                                              If the Agency provides counseling services, the Employer shall be liable to pay the Agency a sum of <strong> <u>$0</u></strong>for each counseling
                                            session at the <strong>Agency\'s premises. </strong>The employer shall be liable to pay the agency a sum of <strong> <u>S$50</u> </strong>for each
                                            counselling session at the employer\'s residence, as requested by the employer and conducted by the agency
                                        </div>                                       
                                    </p>

                                    
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">6.7</span>
                                              The Employer shall inform the Agency of the termination of the FDW\'s employment with the same period of notice given to the FDW for termination of
                                        employment.
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">6.8</span>
                                          The Agency shall furnish the Employer with the employment history of the FDW. The Agency shall obtain such information from the Ministry of
                                          Manpower and ensure that the most updated information is made available to the Employer during the selection process.
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">6.9</span>
                                          In the event that the FDW absconds, the Agency may but shall not be obligated to assist to contact the NGOs and the Embassy of her home country to
                                        locate her.
                                        </div>                                       
                                    </p>

                                     <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:17px;"><span style="margin-left:-50px;margin-right:25px">7.</span>
                                         <strong>Force Majeure</strong>
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:17px;">
                                        In the event that any party shall be rendered unable to carry out the whole or any part of its obligations under this Agreement for any reason beyond
                                        the control of that party, including but not limited to acts of God, force majeure, strikes, war, riot and any other causes of such nature, then the
                                        performance of the obligations hereunder of that party or all the parties as the case may be and as they are affected by such cause shall be excused
                                        during the continuance of any inability so caused, but such inability shall as far as possible be remedied with all reasonable dispatch.
                                        </div>                                       
                                    </p>
                                   
                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">8.</span>
                                             <strong>Confidentiality</strong>
                                        </div>                                      

                                      <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                          The Agency shall not, unless with the Employer\'s written consent, directly or indirectly give, divulge or reveal to any persons any information
                                        whatsoever regarding the Employer, which information the Agency acquired or requested the Employer to provide pursuant to this Agreement. This
                                        condition shall not apply in the case where the information is required for the purpose of any investigations under any law, by the police, the
                                        Controller of Work Passes, the Commissioner for Employment Agencies, Commissioner for Labour, Immigration officers or any other public officer.
                                        </div>  
                                     
                                    </p>
                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">9.</span>
                                             <strong>Dispute Resolution</strong>
                                        </div>                                            
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">9.1</span>
                                          If the Agency is unable to resolve any grievance(s) of the Employer or if the parties are unable to resolve any dispute between them with respect
                                        to this Agreement, the parties shall refer the grievance(s) or dispute to Association of Employment Agency Singapore (AEAS).
                                        </div>                                        
                                    </p>
                                    <p>
                                       <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">9.2</span>
                                          If the dispute arising from this Agreement cannot be settled by the above mediation stated in clause 9.1, the parties shall refer the grievance(s)
                                        or dispute to CASE.
                                        </div>                                       
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">10.</span>
                                             <strong>Precedence to Other Agreements</strong>
                                        </div>                                         
                                    </p>
                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                             In the event of there being any inconsistency between the terms of this Agreement and the terms of any other agreement (oral or written) entered into
                                            between the Agency and the Employer, the terms of this Agreement shall prevail and the terms of such other agreement shall be deemed to be amended to
                                            the extent necessary for it to be read as being consistent with this Agreement.
                                        </div>  
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">11.</span>
                                             <strong>Severability of Provisions</strong>
                                        </div>                                             
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                              If any provision of this Agreement or part thereof is rendered void, illegal or unenforceable by any legislation to which it is subject, it shall be
                                            rendered void, illegal or unenforceable to that extent and it shall in no way affect or prejudice the enforceability of the remainder of such provision
                                            or the other provisions of this Agreement.
                                        </div>                                         
                                    </p>

                                    <p>
                                        <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">12.</span>
                                            <strong>Third Party Rights</strong>
                                        </div>                                            
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                            A person who is not a party to this Agreement has no right under the Contracts (Rights of Third Parties) Act, Chapter 53B of Singapore or any other
                                           laws in any jurisdiction to enforce any term of this Agreement.
                                        </div>                                         
                                    </p>

                                    <p>
                                       <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">13.</span>
                                            <strong>Termination of Agreement</strong>
                                        </div>                                           
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:45px;line-height:20px;">
                                            Any party intending to terminate this agreement shall provide at least <strong> <u>14</u> </strong>day(s) prior notice to the other party.
                                        </div>                                        
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">14.</span>
                                            <strong>Miscellaneous</strong>
                                        </div>                                              
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:25px">14.1</span>
                                             The Employer shall observe and comply with all laws in force in Singapore affecting this Agreement, including but not limited to the Employment of
                                            Foreign Manpower Act, the Employment of Foreign Manpower (Work Passes) Regulations 2007, the Immigration Act, and the Immigration Regulations. The
                                            Employer shall give all notices and pay all fees required to be given or paid under any law in force in Singapore.
                                        </div>   
                                    </p>

                                    <p>
                                         <div style="font-size:13px;text-align:justify;margin-left:55px;line-height:20px;"><span style="margin-left:-50px;margin-right:20px">14.2</span>
                                             <strong>
                                                It is the *Employer\'s responsibility to receive or send the FDW from/to the premises of the Agency for reasons pertaining to deployment,
                                                re-deployment (FDW seeking new employer) or counselling.
                                            </strong>
                                        </div>   
                                    </p>                                    
                                     
                                    <p style="margin:20% 0 20% 0"> 
                                        <div style="border:1px solid black;padding:15px 7px 15px 7px;">
                                                <u>IMPORTANT NOTES:</u>
                                           
                                                <p>i ) The FDW is deemed to be the responsibility of the employer at all times from the date of handing over from the agent until such time as the work
                                                permit is cancelled and the FDW is repatriated, or until a transfer is approved by the Ministry of Manpower and the FDW is handed over to the new
                                                employer.</p>
                                           
                                                <p>ii ) The Employer must continue to pay all levies imposed by the relevant authorities until a transfer is approved or the work permit is cancelled.</p>
                                        </div>   
                                    </p>
                                    <p style="margin:150px 0px 150px 0px;text-align: justify;">                                      
                                        IN WITNESS whereof this Agreement has been entered into the day and year first above written, the contracting parties having read and understood the
                                        terms and conditions of this contract hereunto set their signatures below.
                                    </p>

                                    <table width="110%" cellpadding="5">
                                        <tr><td colspan="2"><div style="border-bottom:1px solid black;width:98%;"></div></td><td width="10%"></td><td colspan="2"><div style="border-bottom:1px solid black;width:95%;"></div></td></tr>
                                        <tr><td colspan="2">Signature of Employer</td><td></td><td colspan="2">Signed for and on behalf of Agency<br/></td></tr>
                                        <tr><td width="10%">Name:</td><td width="35%"><div style="border-bottom:1px solid black;width:180px;">';if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</div></td><td></td><td width="25%">Name of Manager:</td><td width="40%"><div style="border-bottom:1px solid black;width:180px;">';if(isset($query->emp_name) && strlen($query->emp_name) <= 30){ $html.=ucwords(strtolower($query->emp_name));} $html.='</div></td></tr>
                                        <tr><td>NRIC/PP:</td><td width="35%"><div style="border-bottom:1px solid black;width:180px;">';if(isset($query->nric_no)){ $html.=strtoupper(strtolower($query->nric_no));} $html.='</div></td><td></td><td width="20%">Registration No:</td><td width="50%"><div style="border-bottom:1px solid black;width:180px;">';if(isset($query->mom_reg_no)){ $html.=ucwords(strtolower($query->mom_reg_no));} $html.='</div></td></tr>
                                        <tr><td>Date:</td><td><div style="border-bottom:1px solid black;width:180px;">';if(isset($query->contract_date)){ $html.=date('d-m-Y',strtotime($query->contract_date));} $html.='</div></td><td></td><td>Date:</td><td width="50%"><div style="border-bottom:1px solid black;width:180px;">';if(isset($query->contract_date)){ $html.=date('d-m-Y',strtotime($query->contract_date));} $html.='</div></td></tr> 
                                    </table> 
                                </div>                                                                  
                               </div> 
							   	 
										<!--15 - Safety Agreement Form between FDW and Employer (Bahasa Indonesia)-->
										
										     <div class="container">
                                								   
											 <table width="100%">
                                              <tr>
                                                <td><img style="margin-top:20px;" src="'.$basePublic.'/assets/images/doc-checklist/logo.png" ></td><td width="70%"><span style="margin-left:55%;">Safety Agreement Form - FDW002</span></td>
                                                  <td><img style="margin-top:20px;" src="'.$basePublic.'/assets/images/doc-checklist/manpower.png" ></td>
                                                </td></tr>  
                                             </table>
										<br/>
										<div style="margin-top:15px;">
											<div>
											<div style="border:1 solid black;width:300px;height:80px;position:relative;">
												<div>
												<div style="font-size:15px;background-color:#e0e0e0;width:300px;">Authorised EA Name</div>
												<div style="border:1 solid black;"></div><br/>
												<strong><span style="font-size:22px;margin-top:15px;margin-left:20px;">ISLAND MAIDS PTE LTD</strong></span>
												
												</div>																																																												
											</div>			
																						
											<div style="height:100px;width:300px;position:absolute;left:50%;top:13%;font-size:15px;">Instructions:<br/><img src="'.$basePublic.'/assets/images/doc-checklist/instructions.png" style="height:95px;width:300px;"></div>
											</div>
										</div>
										</div>
										
										<br/>
										<div align="center" style="margin-top:10px;font-size:14px;font-weight:bold;text-decoration:underline;">SAFETY AGREEMENT BETWEEN FOREIGN DOMESTIC WORKER AND EMPLOYER</div>
										<br/>
										<div style="border:4px solid red;border-radius:15px;padding:2 2 2 2px;margin-top:10px;">
											<div style="border:1px solid red;border-radius:15px;font-size:13px;">
											
												<div style="margin:5 5 5 5px;"">
													This agreement is made between (a) The Employer and (b) The Foreign Domestic Worker (FDW) and facilitated by (c) The Employment Agency (EA) to accord with the Ministry of Manpower\'s regulations on conditions for window cleaning.<br/>
													[Refer to Annex A on excerpt from the Employment of Foreign Manpower (Work Passes) Regulations ("the Condition")]							
													</div>
													<br/>
													
													<div align="center">Employers of FDWs shall not permit their FDWs to clean the window exterior except where two conditions are met: </div><br/>
													<div style="margin-left:20px;"><i><strong>a.<span style="margin-left:20px;">Window grilles have been installed and are locked at all times during the cleaning process; and</span></strong></i></div>
													<div style="margin-left:20px;"><i><strong>b.<span style="margin-left:20px;">The employeroranadultrepresentativeof the employerisphysically presenttosupervisethe FDW.</span></strong></i></div><br/>
													<div align="center">The rules will apply to all homes,except for windows that are at the ground level or along common corridors.</div><br/>
												</div>
										  </div>
										</div>
										
									</div>
										
										<table border="1" style="font-size:13px;border-collapse:collapse;width:100%;margin-top:20px;" cellpadding="2">
											<thead><tr><th colspan="2" style="background-color:#ccc;">Part A-Employer</th></tr></thead>
											<tbody>
											<tr><td>Employer Name</td><td>'; if(isset($query->customer_name) && strlen($query->customer_name) <= 30){ $html.=ucwords(strtolower($query->customer_name));} $html.='</td></tr>
											<tr><td>NRICNo./FIN</td><td>'; if(isset($query->nric_no)){ $html.=strtoupper($query->nric_no);} $html.='</td></tr>
											<tr><td>Contact No.</td><td>'; if(isset($query->contact_no)){ $html.=ucwords(strtolower($query->contact_no));} $html.='</td></tr>
											<tr><td>Residential Address</td><td>'; if(isset($query->cus_address)){ $html.=ucwords(strtolower($query->cus_address));} $html.='</td></tr>
											<tr><td>Residential Dwelling Type</td>
                                               <td><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td><span style="margin-left:5px;">&nbsp;HDB Apartment</span></td><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">Private Apartment/Condominium</span></td><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">Landed Property</span></td></tr></table>
                                              </td></tr>
                        											<tr><td colspan="2" style="color:#fff;background-color:black;text-align:center">Do I require my FDW to clean window exterior?</td></tr>											
                        											</tbody>
                        										</table>
                        										
                        										<table border="1" style="font-size:13px;border-collapse:collapse;width:100%;margin-top:0px;" cellpadding="2">
                        											
                        											<tr><td colspan="2" style="padding-left:50%;"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">Yes</span></td></tr></table>
                                              </td>
                                              <td  width="35%;" style="padding-left:50%;"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">No</span></td></tr></table></td></tr>
                        											<tr>
                                              <td>(i)&nbsp;Location of window exterior</td>
                                              <td width="40%;">
                                              <table width="100%">
                                              <tr><td width="2%"><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">On ground floor</span><br/></td></tr>
                                              <tr><td width="2%"><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">Facing common corridor</span><br/></td></tr>
                                              <tr><td width="2%"><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">Others</span><br/></td></tr>
                                              </table>
                                              <span>If Others is selected,proceed to)&nbsp;(ii)</span></td>
                                              </td>  
                                              <td style="background-color:#000"></td>                    
                                              </tr>

                                              <tr>
                                              <td>(ii)&nbsp;Grilles installed on windows required to be cleaned by FDW</td>
                                              <td>
                                              <table width="100%">
                                              <tr><td width="2%"><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">Yes</span><br/></td></tr>
                                              <tr><td width="2%"><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">No</span><br/></td></tr>                      
                                              </table>
                                              <span>If Yes is selected,proceed to)&nbsp;(iii)</span>
                                              </td>  
                                              <td style="background-color:#000"></td>                    
                                              </tr>

                                              <tr>
                                              <td>(iii)&nbsp;Adult supervision when cleaning window exterior</td>
                                              <td>
                                              <table>
                                              <tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">Yes</span><br/></td></tr>
                                              <tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td>&nbsp;<span style="margin-left:5px;">No</span><br/></td></tr>                                            
                                              </table>
                                              </td>  
                                              <td style="background-color:#000"></td>                    
                                              </tr>
                                              </table>
											  <br/>
                                              <table width="100%">
                                              <tr>
                                                <td><img style="margin-top:20px;" src="'.$basePublic.'/assets/images/doc-checklist/logo.png" ></td><td width="70%"><span style="margin-left:55%;">Safety Agreement Form - FDW002</span></td>
                                                  <td><img style="margin-top:20px;" src="'.$basePublic.'/assets/images/doc-checklist/manpower.png" ></td>
                                                </td></tr>  
                                             </table>
                                             <!--<h4 style="text-align:center; margin-top:-15px;"></h4>-->
                                             <table border="1" style="border-collapse:collapse;" width="100%" cellpadding="8">
                                             <tr style="border:1px solid black"><td colspan="2" style="text-align:center;background-color:#ccc;"><strong>Continuation of Part A - Employer</strong></td></tr>  

											 	<tr><td colspan="2"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:8px;">I have received the advisory letter and trainer\'s assessment checklist from the Settling-In-Programme(for employers of first-time FDWs)</td></tr></table></td></tr>
											<tr><td colspan="2">[The Employer is required to choose only <strong>one</strong> of the following options]</td></tr>
                                            <tr><td colspan="2"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">I understand the Conditions and I will not require my FDW to clean the window exterior of my home.</td></tr></table></td></tr>
                                             <tr><td colspan="2"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">I understand the Conditions and I require my FDW to clean only the window exterior on the ground floor of my home.</td></tr></table></td></tr>
                                              <tr><td colspan="2"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">I understand the Conditions and I require my FDW to clean only the window exterior along the common corridor of my home.</td></tr></table></td></tr>
                                               <tr><td colspan="2"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;"> I require my FDW to clean the window exterior of my home, and I shall ensure that the grilles are locked when cleaning the window exterior and cleaned only when  supervised by myself or my adult representative.</td></tr></table></td></tr>
											   <tr><td height="30px;" width="25%" style="text-align:center;">Signature/ Date</td><td></td></tr>
											</tbody>
										</table>

                                       
										<div style="font-size:12px;"><i>Employer is to ensure that Part-A is duly completed before the agreement is signed and dated.Donot pre-sign the agreement or sign on in complete form.</i></div>
										<br/>	
											<table border="1" style="font-size:13px;border-collapse:collapse;width:100%;margin-top:0px;" cellspacing="20" cellpadding="5">											
											 <tr><td colspan="2" style="text-align:center;background-color:#ccc;"><strong>Part-B Employment Agency</strong></td></tr>
											<tr><td>Name</td><td style="width:60%;">'; if(isset($query->emp_name) && strlen($query->emp_name) <= 30){ $html.=ucwords(strtolower($query->emp_name));} $html.='</td></tr>
											<tr><td>Registration No.</td><td>'; if(isset($query->mom_reg_no)){ $html.=strtoupper($query->mom_reg_no);} $html.='</td></tr>
											<tr><td colspan="2">I have explained the Conditions to the Employer and advised the Employer that he * <strong>can/cannot</strong> require the FDW to clean the window exterior of his home based on the information presented in Part A [* to delete accordingly]</td></tr>
											<tr><td height="30px;" width="20%" style="text-align:center;">Signature/ Date</td><td></td></tr>
											</tbody>
										</table>
											<br/>
											<br/>
									
											<table border="1" style="font-size:13px;border-collapse:collapse;width:100%;margin-top:0px;"  cellpadding="5">											
											<tr><td colspan="5" style="text-align:center;background-color:#ccc;"><strong>Part-C Foreign Domestic Worker</strong></td></tr>
											<tr><td style="width:20%;">Name</td><td colspan="4">'; if(isset($query->maid_name) && strlen($query->maid_name) <= 30){ $html.=ucwords(strtolower($query->maid_name));} $html.='</td></tr>
											<tr><td style="width:20%;">WP No.</td><td colspan="4">'; if(isset($query->work_permit_no)){ $html.=strtoupper($query->work_permit_no);} $html.='</td></tr>
											<tr><td colspan="5"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">I shall abide by my Employers instructions to clean the window exterior safely incompliance with the Condition</td></tr></table>
											</td></tr>
                                                                            <tr>
											<td colspan="5">[The FDW is required to choose only <strong style="text-decoration:underline;">one</strong> of the following options.] 
                                            <tr><td colspan="5">As indicated by the Employer above:-<br/></td></tr>
                                            <tr><td colspan="5"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">I understand that I am not required to clean the window exterior of my employers home.<br/></td></tr></table></td></tr>
                                             <tr><td colspan="5"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">I understand that I am required to clean only the window exterior on the ground floor of my employers home.<br/></td></tr></table></td></tr>
                                              <tr><td colspan="5"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">I understand that I am required to clean only the window exterior along the common corridor of my employers home.<br/></td></tr></table></td></tr>
                                               <tr><td colspan="5"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;"> I understand that I am required to clean the window exterior of my employers home,and I shall ensure that I clean the window exterior only when the grilles are locked and only when supervised by my employer or his adult representative.<br/></td></tr></table></td></tr>
										
											</td></tr>
											
											</tbody>
										</table>										
										


                                        <table width="100%">
                                              <tr>
                                                <td><img style="margin-top:20px;" src="'.$basePublic.'/assets/images/doc-checklist/logo.png" ></td><td width="70%"><span style="margin-left:55%;">Safety Agreement Form - FDW002</span></td>
                                                  <td><img style="margin-top:20px;" src="'.$basePublic.'/assets/images/doc-checklist/manpower.png" ></td>
                                                </td></tr>  
                                             </table>
                                       
                                       
										<table border="1" style="font-size:13px;border-collapse:collapse;width:100%;margin-top:0px;" cellpadding="6">											
											<tr style="border:1px solid black"><td colspan="2" style="text-align:center;background-color:#ccc;"><strong>Continuation of Part-C Foreign Domestic Worker</strong></td></tr>
											<tr style="border-top:none;border-bottom:none;">
											<td colspan="2">[PLRT Asing diharuskan memilih satu saja dari pilihan-pilihan berikut.]                                          
                                            <tr><td colspan="2">Sebagaimana yang diusulkan oleh majikan yang tertera di atas:-</td></tr>
                                            <tr style="border-top:none;border-bottom:none;"><td colspan="2"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">Saya mengerti bahwa saya tidak dikehendaki untuk membersihkan jendela bagian luar di rumah majikan saya.</td></tr></table></td></tr>
                                             <tr><td colspan="2"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;"> Saya mengerti bahwa saya dikehendaki untuk membersihkan jendela bagian luar dilantai dasar saja di rumah majikan saya.</td></tr></table></td></tr>
                                              <tr><td colspan="2"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">Saya mengerti bahwa saya dikehendaki untuk membersihkan jendela bagian luar disepanjang gang umum saja di rumah majikan saya.</td></tr></table></td></tr>
                                               <tr><td colspan="2"><table><tr><td><div style="width:8px;height:8px;border:1px solid black;"></div></td><td style="padding-left:10px;">Saya mengerti bahwa saya dikehendaki untuk membersihkan jendela bagian luar di rumah majikan saya, dan saya akan memastikan bahwa saya membersihkan jendela bagian luar hanya jika teralis-teralis dikunci dan hanya jika diawasi oleh majikan saya atau orang dewasa yang mewakilinya.</td></tr></table></td></tr>											
											</td></tr>
											 <tr><td height="30px;" width="25%" style="text-align:center;"><br/>Signature/ Date / Tanda Tangan / Tanggal<br/><br/></td><td  height="50px;"></td></tr>
											</tbody>
										</table>
											<br/><br/>
											<table border="1" style="font-size:13px;border-collapse:collapse;width:100%;margin-top:0px;" cellpadding="6">											
											<tr><td colspan="2" style="text-align:center;background-color:#ccc;"><strong>Part-D Employment Agency</strong></td></tr>
											<tr>
											<td colspan="2">I have explained the Conditions to the FDW and advised the FDW that she can/cannot clean the window exterior of the residential address based on the employers declaration in Part-A[*to delete accordingly]</td></tr>
											<tr><td height="30px;" width="25%" style="text-align:center;">Signature/ Date</td><td></td></tr>
											</tbody>
										</table>	
										
										
										<div style="margin-top:20px;font-size:14px;">
											<div style="float:right;font-size:14px;text-decoration:underline;text-align:right;"><strong>Annex A</strong></div>
											
											<div><strong>Condition 4A of the Employment of Foreign Manpower Regulations</strong></div><br/>
											<div>
												The employer shall provide safe working conditions and take such measureas are necessary to ensure the safety and health of the foreign employee at work.This includes
											</div>
											
											<div style="margin-left:25px;">
												<span style="margin-right:20px;font-weight:bold;">a)</span> Not permitting the foreign employee to clean the outward facing side of any window not located on the ground level or not facing a common corridor if the window is not fitted with a grille securing against any adult extending any part of this body beyond the window ledge except his arms;and<br/>
												<span style="margin-right:20px;font-weight:bold;">b)</span> In the case of a window referred to in paragraph (a) fitted with a grille of the description specified in that paragraph, not permitting the foreign employee to clean the outward facing side of the window unless at all times during the cleaning process-
												<ol style="list-style-type:lower-roman;">
													<li>The grille is locked or secured in a manner that prevents the grille from being opened;</li>
													<li>The foreign employee remains inside the room</li>
													<li>No part of the foreign employees body extends beyond the window ledge except the arms;and</li>
												</ol>
												<div>The foreign employee is supervised by the employer,or an adult representative of the employer,who is reasonably capable of conducting such supervision and is aware of the requirements in sub-paragraphs(i),(ii)and(iii).</div>
											</div>
											
										</div>';
                                  $html .='</div>
                                   
                               </div>
							   
							   
							   
							   
							   	   	   				   							     <!--16 - Work Pass Conditions-->
							   
							     <div class="container" style="margin-top:0; text-align:justify;"> 
                                 <div class="header" style="height:0px;">
                                   </div> 
									  <!--<div class="row rowbg">
                                        <span class="span-high_dk">ISLAND MAIDS PTE LTD - </span><span class="span-high">Your Choice For Excellent Service!</span>
                                        <div class="blackstrip"></div>
                                      </div>-->                                      
									  
  									<div class="content-wrapper" style="height:auto;">
								   <div style="font-size:15px;margin-top:25px;" class="p-text-size">
								
								<div style="line-height:22px;">
									<div align="center">
									    <p>
									        FIRST SCHEDULE
									    </p>
									    
									        <div style="font-size:11px;text-align:right;font-weight:bold;">Regulation 4(2) and (5)</div>
									    <br/>
									    <p>
									        CONDITIONS AND REGULATORY CONDITIONS OF IN-PRINCIPLE
									    </p>
									    <p>
									        APPROVAL FOR A WORK PERMIT
									    </p>
									    <p>
									        PART I
									    </p>
									    <div style="text-align:center;" width="50%">
									        CONDITIONS TO BE COMPLIED WITH BY EMPLOYER <br/>OF FOREIGN EMPLOYEE WHO IS DOMESTIC WORKER ISSUED WITH <br/>IN-PRINCIPLE APPROVAL FOR WORK PERMIT
									    </div>
								    </div>
								    
								    <div style="margin-left:45px;line-height:22px;">
								    <p style="line-height:23px;">
								        1. The employer shall be responsible for and bear the costs of the upkeep and maintenance of the foreign employee in Singapore. This includes the
								        provision of adequate food as well as medical treatment.
								    </p>
								    <p style="line-height:23px;">
								        2. The employer shall ensure that the foreign employee has acceptable accommodation. Such accommodation must be consistent with any written law,
								        directive, guideline, circular or other similar instrument issued by any competent authority.
								    </p>
								    <p align="right" style="line-height:22px;">
								        [S 563/2013 wef 03/09/2013]
								    </p>
								    <p style="line-height:23px;">
								        3. The employer shall bear any medical expenses incurred by the foreign employee for any medical examination required by the Controller.
								    </p>
								    <p style="line-height:23px;">
								        4. The employer shall not cause or knowingly permit the foreign employee to be engaged in any illegal, immoral or undesirable conduct or activity.
								    </p>
								    <p style="line-height:23px;">
								        5. An employer shall not demand or receive any sum or other benefit from any employment agency or person in connection with the employment or change in
								        employment of the foreign employee.
								    </p>
								    <p style="line-height:23px;">
								        6. If the foreign employee dies while in Singapore, the employer shall ---	
								    </p>
								    
								   
								    <p style="line-height:18px;margin-left:20px;">
								        (a) bear the cost of either ---
								    </p>
								     <div style="margin-left:50px;">
								    <p style="line-height:15px;">
								        (i) burial of the body in Singapore;
								    </p>
								    <p style="line-height:20px;">
								        (ii) cremation of the body in Singapore and return of the ashes to the country of origin; or
								    </p>
								    <p style="line-height:20px;">
								        (iii) return of the body to the country of origin,
								    </p>
								    <p style="line-height:23px;">
								        with the foreign employees family deciding on burial, cremation or return of the body;
								    </p>
								    </div>
								    <p style="margin-left:20px;">
								        (b) bear the cost of returning the foreign employees belongings to the foreign employees family; and
								    </p>
								    <p style="margin-left:20px;line-height:25px;">
								        (c) pay to the administrators of the foreign employees estate any outstanding salaries or moneys due from the employer to the foreign employee.
								    </p>
								    
									 <p style="line-height:25px;">
								        7. Subject to paragraph 8, the employer shall repatriate the foreign employee to the international port of entry that affords reasonable access to the
								        foreign employees hometown within the foreign employees home country if the in-principle approval for the foreign employee expires or is cancelled or
								        revoked and if the employee is not earlier employed by another employer. In the event of any dispute about the international port of entry to which the
								        foreign employee shall be repatriated, the dispute shall be referred to the Controller, whose decision shall be final.<br/>
										
								    </p>									
								    <p style="line-height:25px;">
								        8. The employer may repatriate the foreign employee to a destination other than that specified in paragraph 7 --
								    </p>
								    <p style="line-height:25px;">
								        (a) if the foreign employee so requests, and the Controller is informed by the employer of the employers intention to do so, before the repatriation
								        occurs; or
								    </p>
								    <p style="line-height:25px;">
								        (b) if the Controller so determines.
								    </p>
								    <p style="line-height:25px;">
								        9. The employer shall bear the costs associated with repatriating the foreign employee at any time except where the Controller permits otherwise. The
								        employer shall ensure that all outstanding salaries or moneys due from the employer to the foreign employee have been paid before the foreign
								        employees before repatriation.
								    </p>
								    <p style="text-align:center;line-height:20px;">
								        <strong>PART II</strong>
								    </p>
								    <p align="center" style="line-height:25px;">
								        REGULATORY CONDITIONS TO BE COMPLIED WITH BY EMPLOYER<br/> OF FOREIGN EMPLOYEE WHO IS DOMESTIC WORKER ISSUED WITH <br/>IN-PRINCIPLE APPROVAL FOR WORK PERMIT
								    </p>
								    <p style="line-height:25px;">
								        1. The employer shall take all necessary steps to ensure that the foreign employees copy of the in-principle approval letter, in its entirety as
								        furnished by the Ministry of Manpower, is sent to the foreign employee within a reasonable time prior to the foreign employees departure for
								        Singapore. The employer will be regarded to have taken all necessary steps --
								    </p>
								    <p style="margin-left:20px;line-height:22px;">
								        (a) where the employer does not engage the service of an employment agency, if the employer can provide sufficient evidence that the foreign employees
								        copy of the in-principle approval letter, in its entirety as furnished by the Ministry of Manpower, has been sent to the foreign employee; or
								    </p>
								    <p style="margin-left:20px;line-height:22px;">
								        (b) where the employer engages the services of an employment agent, if the employer can provide sufficient evidence that --
								    </p>
								    <p style="margin-left:50px;line-height:22px;">
								        (i) the employer instructed the employment agency to send the foreign employees copy of the in-principle approval letter, in its
								            entirety as furnished by the Ministry of Manpower, has been sent to the foreign employee; or
								    	<br/><br/><br/><br/><br/><br/>			
								        (ii) the employment agency informed him that the employment agency will send the foreign employees copy of the in-principle approval letter, in its
								        entirety as furnished by the Ministry of Manpower, to the foreign employee.
								    </p>
								    <p style="line-height:30px;">
								        2. The employer shall purchase and maintain medical insurance with coverage of at least $15,000 per 12-month period of the foreign employees
								        employment (or for such shorter period where the foreign employees period of employment is less than 12 months) for the foreign employees in-patient
								        care and day surgery except as the Controller may otherwise provide by notification in writing.
								    </p>
								    <p style="line-height:30px;">
								        3. The employer shall send the foreign employee for a medical examination by a medical practitioner registered under the Medical Registration Act (Cap.
								        174) as and when directed by the Controller.
								    </p>
								    <p style="line-height:30px;">
								        4. If the foreign employee goes missing, the employer shall inform the Controller within 7 days after the employer becomes aware of the foreign
								        employee going missing.
								    </p>
								    <p style="line-height:30px;">
								        5. If the foreign employee dies while in Singapore, the employer shall inform the Controller within 12 hours after the employer becomes aware of the
								        foreign employees death.
								    </p>
								    <p style="text-align:center;line-height:30px;">
								        <strong>PART III</strong>
								    </p>
								    <p align="center" style="line-height:30px;">
								        CONDITIONS TO BE COMPLIED WITH BY EMPLOYER OF FOREIGN <br/> EMPLOYEE WHO IS NOT DOMESTIC WORKER, WHO IS ISSUED WITH IN-<br/>PRINCIPLE APPROVAL FOR WORK PERMIT
								    </p>
								    <p style="line-height:30px;">
								        1. The employer shall be responsible for and bear the costs of the upkeep (including the provision of food and medical treatment) and maintenance of
								        the foreign employee in Singapore.
								    </p>
								    <p style="line-height:30px;">
								        2. The employer shall also bear any medical expenses incurred by the foreign employee for any medical examination required by the Controller.
								    </p>
								    <p style="line-height:30px;">
								        3. The employer shall register or update the foreign employees accommodation address in such form or manner as the Controller may determine prior to
								        issuance of the work permit.
								    </p>
								    <p style="line-height:30px;">
								        4. The employer shall ensure that the foreign employee has acceptable accommodation. Such accommodation must be consistent with any written law,
								        directive, guideline, circular or other similar instrument issued by any competent authority.
								    </p>
									 <p align="right" style="line-height:22px;">
								        [S 563/2013 wef 03/09/2013]
								    </p><br/><br/>
								<p style="line-height:25px;">
								    5. An employer shall not demand or receive any sum or other benefit from an employment agency or any other person in connection with the employment or
								    change in employment of a foreign employee.
								</p>
								<p style="line-height:25px;">
								    6. If the foreign employee dies while in Singapore, the employer shall --
								</p>
								<p style="margin-left:20px;">
								    (a) bear the cost of either --
								</p>
								<p style="margin-left:50px;">
								    (i) burial of the body in Singapore;
								</p>
								<p style="margin-left:50px;">
								    (ii) cremation of the body in Singapore and return of the ashes to the country of origin; or
								</p>
								<p style="margin-left:50px;">
								    (iii) return of the body to the country of origin,
								</p>
								<p style="margin-left:50px;">
								    with the foreign employees family deciding on burial, cremation or return of the body;
								</p>
								<p style="margin-left:20px;">
								    (b) bear the cost of returning the foreign employees belongings to the foreign employees family; and
								</p>
								<p style="margin-left:20px;">
								    (c) pay to the administrators of the foreign employees estate any outstanding salaries or moneys due from the employer to the foreign employee.
								</p>
								<p>
								    7. Subject to paragraph 8, the employer shall repatriate the foreign employee to the international port of entry that affords reasonable access to the
								    foreign employees hometown within the foreign employees home country if the in-principle approval for the foreign employee expires or is cancelled or
								    revoked and if the employee is not earlier employed by another employer. In the event of any dispute about the international port of entry to which the
								    foreign employee shall be repatriated, the dispute shall be referred to the Controller, whose decision shall be final.
								</p>
								<p>
								    8. The employer may repatriate the foreign employee to a destination other than that specified in paragraph 7
								</p>
								<p style="margin-left:30px;">
								    (a) if the foreign employee so requests, and the Controller is informed by the employer of the employers intention to do so, before the repatriation
								    occurs; or
								</p>
								<p style="margin-left:30px;">
								    (b) if the Controller so determines.
								</p>
								<p>
								    9. The employer shall bear the costs associated with repatriating the foreign employee at any time except where the Controller permits otherwise. The
								    employer shall ensure that all outstanding salaries or moneys due from the employer to the foreign employee have been paid before the foreign employees
								    repatriation.
								</p>
								    </div>
								</div>';			
                                  $html .='</div>                                  
                               </div>							   
							   


                              </body>
                             </html>';
							 
							 return $html;
							//return PDF::load($html,'A3','portrait')->download('Doc-Pdf');
                }
}
?>