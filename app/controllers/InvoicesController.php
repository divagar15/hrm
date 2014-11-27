<?php
class InvoicesController extends BaseController {

		     /*
         * Get array value from query result
         */
        protected $result = array();
        
        /*
         * log user id as integer
        */
        protected $id;


        public function __construct() {
            if(Session::has('id')) {
                $this->id = Session::get('id');
                $segment = Request::segment(1);
            } else {
                $this->beforeFilter(function(){
                    return Redirect::to('login');
                });
            }
            $this->rec_maid = 96; // 96 live
        }

        public function index() {
            $invoices  = DB::table('il_accounting_invoice as t1')->leftJoin('il_accounting_invoice_lines as t2','t1.id','=','t2.fkinvoice_id')
                        ->leftJoin('il_customer_details as t3','t1.fkcustomer_id','=','t3.id')->select('t1.id','t1.date','t1.invoice_no','t1.fkbranch_id',
                        't1.customer_status','t1.fkcustomer_id','t1.invoice_to','t1.customer_name','t1.tax_percentage',
                        't1.status','t1.contract_id','t3.customer_name as customer',DB::raw('SUM(t2.amount) as sub_total'))->where('t1.delete_status',1);
            $branchId  = Request::get('branch');
            $status    = Request::get('status');
            if($branchId!='' || $status !=''){
                if($branchId != 0){
                      $invoices  = $invoices->where('t1.fkbranch_id',$branchId)->where('t1.status',$status); 
                } else {
                      $invoices  = $invoices->where('t1.status',$status); 
                }
            }
            $invoices  = $invoices->groupBy('t1.id')->get();
            return View::make('Accounting.Invoice.index')->with('invoices',$invoices);
        }

        public function add() {
            $customers = DB::table('il_customer_details')->select('id','customer_name')->where('delete_status',0)->orderBy('customer_name','ASC')->get();
            
            $taxcodes  = DB::table('il_accounting_coa_level4')->select('id','level4_name','tax_percentage')->where('account_type',1)->where('tax_status',1)->where('tax_type',2)->get();
        	
            $incomeCoa = DB::table('il_accounting_coa_level1 as l1')->join('il_accounting_coa_level2 as l2','l1.id','=','l2.fklevel1_id')
                  ->join('il_accounting_coa_level3 as l3','l2.id','=','l3.fklevel2_id')->join('il_accounting_coa_level4 as l4','l3.id','=','l4.fklevel3_id')
                  ->select('l4.level4_name','l4.id')->where('l1.id',3)->where('l4.account_type',0)->orderBy('l4.level4_name','ASC')->get();
            
            $paymentCoa = DB::table('il_accounting_coa_level1 as l1')->join('il_accounting_coa_level2 as l2','l1.id','=','l2.fklevel1_id')
                  ->join('il_accounting_coa_level3 as l3','l2.id','=','l3.fklevel2_id')->join('il_accounting_coa_level4 as l4','l3.id','=','l4.fklevel3_id')
                  ->select('l4.level4_name','l4.id')->where('l1.id',1)->where('l2.id',1)->whereIn('l3.id',array(1,2))->where('l4.account_type',0)->orderBy('l4.level4_name','ASC')->get();
           
            $approvers = DB::table('il_emp_details')->select('id','emp_name')->where('is_active',1)->where('user_role',1)->orderBy('emp_name','ASC')->get();

            $branches = DB::table('il_branch')->select('id','branch_name','branch_code')->orderBy('branch_name','ASC')->get();

            return View::make('Accounting.Invoice.add')->with(array('customers' => $customers,'branches' => $branches,'approvers' => $approvers,'taxcodes' => $taxcodes,'incomeCoa' => $incomeCoa,'paymentCoa' => $paymentCoa));
        }

        public function edit($id) {

            $customers = DB::table('il_customer_details')->select('id','customer_name')->where('delete_status',0)->orderBy('customer_name','ASC')->get();
            
            $taxcodes  = DB::table('il_accounting_coa_level4')->select('id','level4_name','tax_percentage')->where('account_type',1)->where('tax_status',1)->where('tax_type',2)->get();
            
            $incomeCoa = DB::table('il_accounting_coa_level1 as l1')->join('il_accounting_coa_level2 as l2','l1.id','=','l2.fklevel1_id')
                  ->join('il_accounting_coa_level3 as l3','l2.id','=','l3.fklevel2_id')->join('il_accounting_coa_level4 as l4','l3.id','=','l4.fklevel3_id')
                  ->select('l4.level4_name','l4.id')->whereIn('l1.id',array(3))->orwhere('l4.id',$this->rec_maid)->where('l4.account_type',0)->orderBy('l4.level4_name','ASC')->get();
            
            $paymentCoa = DB::table('il_accounting_coa_level1 as l1')->join('il_accounting_coa_level2 as l2','l1.id','=','l2.fklevel1_id')
                  ->join('il_accounting_coa_level3 as l3','l2.id','=','l3.fklevel2_id')->join('il_accounting_coa_level4 as l4','l3.id','=','l4.fklevel3_id')
                  ->select('l4.level4_name','l4.id')->where('l1.id',1)->where('l2.id',1)->whereIn('l3.id',array(1,2))->where('l4.account_type',0)->orderBy('l4.level4_name','ASC')->get();
           
            $approvers = DB::table('il_emp_details')->select('id','emp_name')->where('is_active',1)->where('user_role',1)->orderBy('emp_name','ASC')->get();

            $branches = DB::table('il_branch')->select('id','branch_name','branch_code')->orderBy('branch_name','ASC')->get();

            $invoice  = DB::table('il_accounting_invoice')->where('id',$id)->first();

            if($invoice) {
                $invoiceLines  = DB::table('il_accounting_invoice_lines')->where('fkinvoice_id',$id)->get();
                $paymentLines  = DB::table('il_accounting_payments')->where('fktransaction_id',$id)->where('transaction_type',1)->get();
            } else {
                return Redirect::to('account/invoice');
            }
             return View::make('Accounting.Invoice.edit')->with(array('invoice' => $invoice,'invoiceLines' => $invoiceLines,'paymentLines' => $paymentLines,'customers' => $customers,'branches' => $branches,'approvers' => $approvers,'taxcodes' => $taxcodes,'incomeCoa' => $incomeCoa,'paymentCoa' => $paymentCoa));
        }

        /*
         * 
         *
        
        public function contractInvoicePrint(){
            $invoiceId = Request::Segment(3);
            //$companyInfo = DB::table('il_company_info')->select('organization_name','phone_no','address1','email_id','city','country')->where('id',1)->first();
            $invoice_info = DB::table('il_contract_invoice_details')->join('il_contract_details','il_contract_details.id','=','il_contract_invoice_details.fkContractId')->join('il_customer_details','il_customer_details.id','=','il_contract_details.fkCustomerId')->join('il_emp_details','il_emp_details.id','=','il_customer_details.service_officer_id')->select('il_contract_invoice_details.id','il_contract_invoice_details.fkContractId','il_contract_invoice_details.invoice_no','il_contract_invoice_details.invoice_date','il_contract_invoice_details.version_no','il_contract_invoice_details.pay_mode','il_contract_invoice_details.admin_fee','il_contract_invoice_details.insurance_fee','il_contract_invoice_details.agency_fee','il_contract_invoice_details.paid_admin_fee','il_contract_invoice_details.paid_ins_fee','il_contract_invoice_details.paid_agency_fee','il_contract_invoice_details.bal_admin_fee','il_contract_invoice_details.bal_ins_fee','il_contract_invoice_details.bal_agency_fee','il_contract_invoice_details.target_fee',
                    'il_contract_invoice_details.paid_amt','il_contract_invoice_details.bal_amt','il_contract_details.fee_type','il_contract_details.loan_opt','il_contract_details.loan_amount','il_contract_details.loan_collect_date','il_contract_details.loan_tenure','il_customer_details.customer_name','il_emp_details.emp_name')->where('il_contract_invoice_details.id',$invoiceId)->first();
            $applicationInfo = DB::table('il_application_details')->select('handover_date')->where('fkContractId',$invoice_info->fkContractId)->orderBy('id','desc')->first();
            if(!empty($invoice_info)) {
                $feeId = explode(',',$invoice_info->fee_type);
                $getFeeValue = DB::table('il_target_fee')->select('fee_type','fee_amt')->whereIn('id',$feeId)->get();
                if($invoice_info->loan_opt == 1) {
                    $loanInfo = DB::table('il_contract_loan')->select('emi_amt','collect_date','paid_amt')->where('fkContractId',$invoice_info->fkContractId)->get();
                } else
                    $loanInfo = '';
            }
            $invoice_temp = ContractInvoice::printContractInvoice($invoice_info, $getFeeValue, $applicationInfo,$loanInfo);
            return PDF::load($invoice_temp, 'A4', 'portrait')->download('contract_invoice_'.$invoice_info->id);
            
        }
       
         */
        
        
        public function payToMaidVendor(){
            $postData = Input::all();
            if(!empty($postData) && $postData['placement_total'] != 0 && $postData['vendor_payable'] != 0) {
                $placement_fee        = $postData['placement_total'];
                $vendor_payable_fee   = $postData['vendor_payable'];
                $invoice_id           = $postData['p_invoice_id'];
                $pay_for              = $postData['pay_for'];
                $customerId           = $postData['p_customer'];
                $curDate              = date('Y-m-d H:i:s');
                $island_fee           = (double)$placement_fee - (double)$vendor_payable_fee; 
                $vendor_fee           = (double)$vendor_payable_fee;
                $checkRecontract  = DB::table('il_customer_details')->select('re_contract')->where('id',$customerId)->first();
                if($island_fee != 0){
                             $updatePlacementFee  = array('amount' => $island_fee,'date_modified' => $curDate);
                             $updatedFee          = DB::table('il_accounting_invoice_lines')->where('fkinvoice_id',$invoice_id)->where('fkincomecoa_id',22)->update($updatePlacementFee);
                }
                $checkRecontract  = DB::table('il_customer_details')->select('re_contract')->where('id',$customerId)->first();
                if($checkRecontract->re_contract == 1){ 
                               $insertInvoiceline = array('fkinvoice_id' => $invoice_id,
                                                              'fkincomecoa_id' => 96, // live 96
                                                              'description' => $pay_for,
                                                              'amount' => $vendor_fee);
                } else {
                                $insertInvoiceline = array('fkinvoice_id' => $invoice_id,
                                                              'fkincomecoa_id' => 8,
                                                              'description' => $pay_for,
                                                              'amount' => $vendor_fee);
                }
                $insertFee          = DB::table('il_accounting_invoice_lines')->insert($insertInvoiceline);
                if($updatedFee &&  $insertFee)
                    return Redirect::to('account/invoice/edit/'.$invoice_id)->with('successalert','Vendor Payment done ready for approve now');
                else
                    return Redirect::to('account/invoice/edit/'.$invoice_id)->with('erroralert','Sorry Invalid detail try again');
            } else {
                return Redirect::to('account/invoice/edit/'.$invoice_id)->with('erroralert','Sorry Invalid detail try again');
            }
        }
        
        
        public function editToMaidVendor(){
            
                        $postData = Input::all();
                        //echo '<pre>'; print_r($postData); echo '</pre>'; die();
            if(!empty($postData) && $postData['placement_total'] != 0 && $postData['vendor_payable'] != 0) {
                $vendorcoa_id         = $postData['vendorcoa_id'];
                $placement_fee        = $postData['placement_total'];
                $vendor_payable_fee   = $postData['vendor_payable'];
                $invoice_id           = $postData['p_invoice_id'];
                $pay_for              = $postData['pay_for'];
                $customerId           = $postData['p_customer'];
                $curDate              = date('Y-m-d H:i:s');
                $island_fee           = (double)$placement_fee - (double)$vendor_payable_fee; 
                $vendor_fee           = (double)$vendor_payable_fee;
                $checkRecontract  = DB::table('il_customer_details')->select('re_contract')->where('id',$customerId)->first();
                if($island_fee != 0){
                             $updatePlacementFee  = array('amount' => $island_fee,'date_modified' => $curDate);
                             $updatedFee          = DB::table('il_accounting_invoice_lines')->where('fkinvoice_id',$invoice_id)->where('fkincomecoa_id',22)->update($updatePlacementFee);
                }
               
                if($vendor_fee!=0){
                               $updatePlacementFee1 = array('amount' => $vendor_fee,'date_modified' => $curDate);
                                                             
               
                                $updatedFee1          = DB::table('il_accounting_invoice_lines')->where('fkinvoice_id',$invoice_id)->where('fkincomecoa_id',$vendorcoa_id)->update($updatePlacementFee1);
                }
                if($updatedFee &&  $updatedFee1)
                    return Redirect::to('account/invoice/edit/'.$invoice_id)->with('successalert','Vendor Payment done ready for approve now');
                else
                    return Redirect::to('account/invoice/edit/'.$invoice_id)->with('erroralert','Sorry Invalid detail try again');
            } else {
                return Redirect::to('account/invoice/edit/'.$invoice_id)->with('erroralert','Sorry Invalid detail try again');
            }
            
        }

                public function printInvoice($id) {
            $loanInfo = $applicationInfo = '';
            $invoice  = DB::table('il_accounting_invoice as t1')->leftJoin('il_accounting_coa_level4 as t2','t1.fktax_id','=','t2.id')->where('t1.id',$id)->where('t1.status','!=',3)->first();
            $invoiceLines  = DB::table('il_accounting_invoice_lines as t1')->join('il_accounting_coa_level4 as t2','t1.fkincomecoa_id','=','t2.id')
                            ->select('t1.fkincomecoa_id','t1.amount','t2.level4_name','t1.description')->where('fkinvoice_id',$id)->get();
            if(!empty($invoice)) {
                if($invoice->contract_id != 0){
                    $applicationInfo = DB::table('il_contract_details as cd')->join('il_customer_details as cus','cus.id','=','cd.fkCustomerId')->join('il_emp_details as emp','emp.id','=','cus.service_officer_id')->join('il_bio_data as bio','bio.id','=','cd.fkBioId')->leftJoin('il_application_details as app','cd.id','=','app.fkContractId')->select('emp.emp_name','bio.maid_name','app.handover_date')->where('cd.id',$invoice->contract_id)->orderBy('app.id','desc')->first();
                }
            $loanInfo = DB::table('il_contract_loan')->select('emi_amt','collect_date','paid_amt')->where('fkContractId',$invoice->contract_id)->get();
            $invoice_temp = ContractInvoice::printContractInvoice($invoice, $invoiceLines, $applicationInfo,$loanInfo);
            return PDF::load($invoice_temp, 'A4', 'portrait')->download('Invoice_INC02'.$id);
            //$printInvoice = Invoice::printInvoice($invoice,$invoiceLines);
            //return PDF::load($printInvoice, 'A4', 'portrait')->download('Invoice_'.$id);
            } else {
                return Redirect::to('account/invoice')->with('successalert','Sorry invalid details,try again');
            }
        }


        public function copy($id) {

            $customers = DB::table('il_customer_details')->select('id','customer_name')->where('delete_status',0)->orderBy('customer_name','ASC')->get();
            
            $taxcodes  = DB::table('il_accounting_coa_level4')->select('id','level4_name','tax_percentage')->where('account_type',1)->where('tax_status',1)->where('tax_type',2)->get();
            
            $incomeCoa = DB::table('il_accounting_coa_level1 as l1')->join('il_accounting_coa_level2 as l2','l1.id','=','l2.fklevel1_id')
                  ->join('il_accounting_coa_level3 as l3','l2.id','=','l3.fklevel2_id')->join('il_accounting_coa_level4 as l4','l3.id','=','l4.fklevel3_id')
                  ->select('l4.level4_name','l4.id')->where('l1.id',3)->where('l4.account_type',0)->orderBy('l4.level4_name','ASC')->get();
            
            $paymentCoa = DB::table('il_accounting_coa_level1 as l1')->join('il_accounting_coa_level2 as l2','l1.id','=','l2.fklevel1_id')
                  ->join('il_accounting_coa_level3 as l3','l2.id','=','l3.fklevel2_id')->join('il_accounting_coa_level4 as l4','l3.id','=','l4.fklevel3_id')
                  ->select('l4.level4_name','l4.id')->where('l1.id',1)->where('l2.id',1)->whereIn('l3.id',array(1,2))->where('l4.account_type',0)->orderBy('l4.level4_name','ASC')->get();
           
            $approvers = DB::table('il_emp_details')->select('id','emp_name')->where('is_active',1)->where('user_role',1)->orderBy('emp_name','ASC')->get();

            $branches = DB::table('il_branch')->select('id','branch_name','branch_code')->orderBy('branch_name','ASC')->get();

            $invoice  = DB::table('il_accounting_invoice')->where('id',$id)->first();

            if($invoice) {
                $invoiceLines  = DB::table('il_accounting_invoice_lines')->where('fkinvoice_id',$id)->get();
            } else {
                return Redirect::to('account/invoice');
            }

            return View::make('Accounting.Invoice.copy')->with(array('invoice' => $invoice,'invoiceLines' => $invoiceLines,'customers' => $customers,'branches' => $branches,'approvers' => $approvers,'taxcodes' => $taxcodes,'incomeCoa' => $incomeCoa,'paymentCoa' => $paymentCoa));
        }

        public function saveDraft() {
            if(Request::ajax()){
                 $postData   = Input::all();
                 $actionCall = Input::get('action');
                 if($actionCall == 'save_draft') {
                    $postData = Input::get('postData');
                    parse_str($postData,$data);
            
                    $checkStatus = DB::select(DB::raw('select count(id) as invoice_count from il_accounting_invoice'));
                    $branch      = DB::table('il_branch')->select('branch_code')->where('id',$data['branch'])->first();

                    if($checkStatus[0]->invoice_count==0) {
                        $invoice_no = "INV-".date('Ym').str_pad('1', 3, "0", STR_PAD_LEFT)."/".$branch->branch_code;
                    } else {
                        $count_number = ++$checkStatus[0]->invoice_count;
                        $invoice_no   = "INV-".date('Ym').str_pad($count_number, 3, "0", STR_PAD_LEFT)."/".$branch->branch_code;
                    }

                    $data['date'] = date('Y-m-d',strtotime(trim($data['date'])));
                    $data['customerId']   = '';
                    $data['customerName'] = '';
                    $data['invoiceTo']    = '';
                    if($data['customer']==1) {
                        $data['customerId']   = $data['customer_id'];
                        $data['customerName'] = '';
                        $data['invoiceTo']    = $data['invoice_to'];
                    } else if($data['customer']==2) { 
                        $data['customerId']   = '';
                        $data['customerName'] = $data['customer_name'];
                        $data['invoiceTo']    = $data['invoice_to'];
                    }

                    $data['fktax_id']  = '';
                    $data['tax_value'] = '';
                    $taxCode  = $data['tax_code'];
                    $splitTax = explode("_", $taxCode);
                    if(isset($splitTax[0])) {
                        $data['fktax_id'] = $splitTax[0]; 
                    }
                    if(isset($splitTax[1])) {
                        $data['tax_value'] = $splitTax[1];
                    }
                    //print_r($data);
                    $invoiceInsert = DB::table('il_accounting_invoice')->insertGetId(array('invoice_no' => $invoice_no,'fkbranch_id' => $data['branch'],
                                     'customer_status' => $data['customer'],'fkcustomer_id' => $data['customerId'],'customer_name' => trim($data['customerName']),
                                     'invoice_to' => trim($data['invoiceTo']), 'credit_terms' => $data['credit_term'],'date' => $data['date'] ,
                                     'fktax_id' => $data['fktax_id'], 'tax_percentage' => $data['tax_value'],'transaction_description' => trim($data['memo']),
                                     'approval_for' => $data['approval_by'], 'status' => 3));
                    $counter = $data['counter'];
                    for($i=1;$i<=$counter;$i++) {
                        $income_account = $data['income_account_'.$i];
                        $description    = trim($data['description_'.$i]);
                        $amount         = str_replace(",","", trim($data['amount_'.$i]));

                        $insert = DB::table('il_accounting_invoice_lines')->insert(array('fkinvoice_id' => $invoiceInsert,
                                         'fkincomecoa_id' => $income_account, 'description' => $description, 'amount' => $amount));

                    }

                    if(isset($data['payment_trigger']) && $data['payment_trigger']==1) {

                        $data['pay_amount'] = str_replace(",","", trim($data['payment_amount']));

                        $PayInsert = DB::table('il_accounting_payments')->insert(array('fktransaction_id' => $invoiceInsert,
                                         'account_coa' => $data['payment_account'], 'payment_description' => trim($data['payment_description']),
                                         'payment_amount' => $data['pay_amount'], 'cheque_no' => trim($data['cheque_no']), 'transaction_type' => 1));


                    }

                    if($invoiceInsert) {
                        Session::put('successalert','Invoice Created Successfully');
                        return 1;
                    } else {
                        return 2;
                    }

                   // print_r($data);
                 } else if($actionCall == 'save_edit_draft') {

                    $postData = Input::get('postData');
                    parse_str($postData,$data);

                    $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                    $data['date'] = date('Y-m-d',strtotime(trim($data['date'])));
                    $data['customerId']   = '';
                    $data['customerName'] = '';
                    $data['invoiceTo']    = '';
                    if($data['customer']==1) {
                        $data['customerId']   = $data['customer_id'];
                        $data['customerName'] = '';
                        $data['invoiceTo']    = $data['invoice_to'];
                    } else if($data['customer']==2) { 
                        $data['customerId']   = '';
                        $data['customerName'] = $data['customer_name'];
                        $data['invoiceTo']    = $data['invoice_to'];
                    }

                    $data['fktax_id']  = '';
                    $data['tax_value'] = '';
                    $taxCode  = $data['tax_code'];
                    $splitTax = explode("_", $taxCode);
                    if(isset($splitTax[0])) {
                        $data['fktax_id'] = $splitTax[0]; 
                    }
                    if(isset($splitTax[1])) {
                        $data['tax_value'] = $splitTax[1];
                    }

                    //print_r($data);
                    $invoiceUpdate = DB::table('il_accounting_invoice')->where('id',$data['invoice_id'])->update(array('customer_status' => $data['customer'],'fkcustomer_id' => $data['customerId'],'customer_name' => trim($data['customerName']),
                                     'invoice_to' => trim($data['invoiceTo']), 'credit_terms' => $data['credit_term'],'date' => $data['date'] ,
                                     'fktax_id' => $data['fktax_id'], 'tax_percentage' => $data['tax_value'],'transaction_description' => trim($data['memo']),
                                     'approval_for' => $data['approval_by'], 'status' => 3, 'date_modified' => $currentDate));

                    $update_counter = $data['update_counter'];
                    $counter        = $data['counter'];

                    for($i=1;$i<=$update_counter;$i++) {

                        $lid            = $data['invoiceline_id_'.$i];
                        $income_account = $data['income_account_'.$i];
                        $description    = trim($data['description_'.$i]);
                        $amount         = str_replace(",","", trim($data['amount_'.$i]));

                        $update = DB::table('il_accounting_invoice_lines')->where('id',$lid)->update(array('fkincomecoa_id' => $income_account, 'description' => $description, 'amount' => $amount, 'date_modified' => $currentDate));

                    }


                    for($i=++$update_counter;$i<=$counter;$i++) {

                        $income_account = $data['income_account_'.$i];
                        $description    = trim($data['description_'.$i]);
                        $amount         = str_replace(",","", trim($data['amount_'.$i]));

                        $update = DB::table('il_accounting_invoice_lines')->insert(array('fkinvoice_id' => $data['invoice_id'],'fkincomecoa_id' => $income_account, 'description' => $description, 'amount' => $amount));

                    }

                    if(isset($data['payment_trigger']) && $data['payment_trigger']==1 && isset($data['pay_payid']) && $data['credit_term']==1) {

                        $data['pay_amount'] = str_replace(",","", trim($data['payment_amount']));

                        $PayUpdate = DB::table('il_accounting_payments')->where('id',$data['pay_payid'])->update(array('account_coa' => $data['payment_account'], 'payment_description' => trim($data['payment_description']),
                                         'payment_amount' => $data['pay_amount'], 'cheque_no' => trim($data['cheque_no']), 'transaction_type' => 1, 'date_modified' => $currentDate));

                    } else if(isset($data['payment_trigger']) && $data['payment_trigger']==1 && !isset($data['pay_payid']) && $data['credit_term']==1) {

                        $data['pay_amount'] = str_replace(",","", trim($data['payment_amount']));

                        $PayInsert = DB::table('il_accounting_payments')->insert(array('fktransaction_id' => $data['invoice_id'],
                                         'account_coa' => $data['payment_account'], 'payment_description' => trim($data['payment_description']),
                                         'payment_amount' => $data['pay_amount'], 'cheque_no' => trim($data['cheque_no']), 'transaction_type' => 1));

                    } else if(isset($data['payment_trigger']) && $data['payment_trigger']==0 && isset($data['pay_payid']) && $data['credit_term']!=1) {

                      $payDelete  = DB::table('il_accounting_payments')->where('id',$data['pay_payid'])->delete();
                        
                    }

                    if($invoiceUpdate) {
                        Session::put('successalert','Invoice Updated Successfully');
                        return 1;
                    } else {
                        return 2;
                    }



                 }
            }
        }

        public function approveInvoice() {
            if(Request::ajax()){
                 $postData   = Input::all();
                 $actionCall = Input::get('action');
                 if($actionCall == 'changeStatus') {
                     $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                     if($postData['status']==1) {

                        $grand_total = 0.00;
                        $tax_total   = 0.00;
                        $result  =  DB::table('il_accounting_invoice as t1')->leftJoin('il_accounting_invoice_lines as t2','t1.id','=','t2.fkinvoice_id')
                                    ->select('t1.id','t1.customer_status','t1.credit_terms','t1.fktax_id','t1.tax_percentage',DB::raw('SUM(t2.amount) as sub_total'))
                                    ->where('t1.id',$postData['id'])->groupBy('t1.id')->first();

                        $sub_total    = $result->sub_total;
                        $tax_total    = ($result->sub_total * $result->tax_percentage / 100);
                        $grand_total  = $sub_total+$tax_total;

                        if($result->customer_status==1) {
                            $receivable  = 2;
                        } else if($result->customer_status==2) { 
                            $receivable  = 3;
                        }

                        if($result->credit_terms!=1) {
                        $glReceivableInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $postData['id'],
                                           'gl_account' => $receivable, 'amount_type' => 1, 'amount' => $grand_total,
                                           'transaction_type' => 1,'account_type' => 1, 'active_status' => $postData['status']));
                        }

                        if(isset($result->fktax_id) && !empty($result->fktax_id)) {
                            $glTaxInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $postData['id'],
                                           'gl_account' => $result->fktax_id, 'amount_type' => 2, 'amount' => $tax_total,
                                           'transaction_type' => 1,'account_type' => 4, 'active_status' => $postData['status']));
                        }

                     } else if($postData['status']==2) {

                        $glSelect = DB::table('il_accounting_gl_entry')->select(DB::raw('count(id) as entries'))->where('fktransaction_id',$postData['id'])->where('transaction_type',1)->where('active_status',1)->get();
                        
                        if($glSelect[0]->entries != 0) {
                            $glDelete = DB::table('il_accounting_gl_entry')->where('fktransaction_id',$postData['id'])->where('transaction_type',1)->delete();
                        }

                     }
                     $invoiceUpdate = DB::table('il_accounting_invoice')->where('id',$postData['id'])->update(array('status' => $postData['status'], 'date_modified' => $currentDate));
                     if($invoiceUpdate) {
                        return 1;
                     } else {
                        return 0;
                     }
                 }
            }
        }    


    public function deleteInvoice() {
            if(Request::ajax()){
                 $postData   = Input::all();
                 $actionCall = Input::get('action');
                 if($actionCall == 'delete') {
                     $currentDate  = date('Y-m-d H:i:s',strtotime('now'));

                    $receipts = DB::table('il_accounting_receipts')->select(DB::raw('count(id) as receipt'))->where('invoice_no',$postData['id'])->where('delete_status',1)->get();

                    $cheques = DB::table('il_accounting_cheques')->select(DB::raw('count(id) as cheque'))->where('invoice_no',$postData['id'])->where('delete_status',1)->get();

                    if($receipts[0]->receipt == 0 && $cheques[0]->cheque == 0) {

                        $glSelect = DB::table('il_accounting_gl_entry')->select(DB::raw('count(id) as entries'))->where('fktransaction_id',$postData['id']."-1")->where('active_status',1)->get();
                        
                        if($glSelect[0]->entries != 0) {
                            $glDelete = DB::table('il_accounting_gl_entry')->where('fktransaction_id',$postData['id'])->where('transaction_type',1)->delete();
                        }

                     $invoiceDelete = DB::table('il_accounting_invoice')->where('id',$postData['id'])->update(array('delete_status' => 2, 'date_modified' => $currentDate));
                     if($invoiceDelete) {
                        return 1;
                     } else {
                        return 0;
                     }
                    } else {
                        return 2;
                    }
                 }
            }
        }                           

        public function saveInvoice() {
            if(Request::ajax()){
                 $postData   = Input::all();
                 $actionCall = Input::get('action');
                 if($actionCall == 'save_invoice') {
                    $postData = Input::get('postData');
                    parse_str($postData,$data);

                    $type = Input::get('type');

                    if($type==1) {
                        $approver = $this->id;
                    } else if($type==2) {
                        $approver = $data['approval_by'];
                    }
            
                    $checkStatus = DB::select(DB::raw('select count(id) as invoice_count from il_accounting_invoice'));
                    $branch      = DB::table('il_branch')->select('branch_code')->where('id',$data['branch'])->first();

                    if($checkStatus[0]->invoice_count==0) {
                        $invoice_no = "INV-".date('Ym').str_pad('1', 3, "0", STR_PAD_LEFT)."/".$branch->branch_code;
                    } else {
                        $count_number = ++$checkStatus[0]->invoice_count;
                        $invoice_no   = "INV-".date('Ym').str_pad($count_number, 3, "0", STR_PAD_LEFT)."/".$branch->branch_code;
                    }


                    $data['date'] = date('Y-m-d',strtotime(trim($data['date'])));
                    $data['customerId']   = '';
                    $data['customerName'] = '';
                    $data['invoiceTo']    = '';
                    if($data['customer']==1) {
                        $data['customerId']   = $data['customer_id'];
                        $data['customerName'] = '';
                        $data['invoiceTo']    = $data['invoice_to'];
                        $receivable           = 2;
                    } else if($data['customer']==2) { 
                        $data['customerId']   = '';
                        $data['customerName'] = $data['customer_name'];
                        $data['invoiceTo']    = $data['invoice_to'];
                        $receivable           = 3;
                    }

                    $data['fktax_id']  = '';
                    $data['tax_value'] = '';
                    $taxCode  = $data['tax_code'];
                    $splitTax = explode("_", $taxCode);
                    if(isset($splitTax[0])) {
                        $data['fktax_id'] = $splitTax[0];
                    }
                    if(isset($splitTax[1])) {
                        $data['tax_value'] = $splitTax[1];
                    }

                    //print_r($data);
                    $invoiceInsert = DB::table('il_accounting_invoice')->insertGetId(array('invoice_no' => $invoice_no,'fkbranch_id' => $data['branch'],
                                     'customer_status' => $data['customer'],'fkcustomer_id' => $data['customerId'],'customer_name' => trim($data['customerName']),
                                     'invoice_to' => trim($data['invoiceTo']), 'credit_terms' => $data['credit_term'],'date' => $data['date'] ,
                                     'fktax_id' => $data['fktax_id'], 'tax_percentage' => $data['tax_value'],'transaction_description' => trim($data['memo']),
                                     'approval_for' => $approver, 'status' => $type));

                    if($type==1) {
                      if($data['credit_term']!=1) {
                      $glReceivableInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $invoiceInsert,
                                           'gl_account' => $receivable, 'amount_type' => 1, 'amount' => $data['total_amount'],
                                           'transaction_type' => 1,'account_type' => 1, 'active_status' => $type));
                       }

                      if(isset($data['fktax_id']) && !empty($data['fktax_id'])) {
                          $glTaxInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $invoiceInsert,
                                           'gl_account' => $data['fktax_id'], 'amount_type' => 2, 'amount' => $data['gst_amount'],
                                           'transaction_type' => 1,'account_type' => 4, 'active_status' => $type));
                      }

                    }

                    $counter = $data['counter'];

                    for($i=1;$i<=$counter;$i++) {
                        $income_account = $data['income_account_'.$i];
                        $description    = trim($data['description_'.$i]);
                        $amount         = str_replace(",","", trim($data['amount_'.$i]));

                        $insert = DB::table('il_accounting_invoice_lines')->insertGetId(array('fkinvoice_id' => $invoiceInsert,
                                         'fkincomecoa_id' => $income_account, 'description' => $description, 'amount' => $amount));

                        /*if($type==1) {
                          $glIncomeInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $insert,
                                           'gl_account' => $income_account, 'amount_type' => 2, 'amount' => $amount,
                                           'transaction_type' => 1,'account_type' => 5, 'active_status' => $type));
                        }*/


                    }

                    if(isset($data['payment_trigger']) && $data['payment_trigger']==1) {

                        $data['pay_amount'] = str_replace(",","", trim($data['payment_amount']));

                        $PayInsert = DB::table('il_accounting_payments')->insertGetId(array('fktransaction_id' => $invoiceInsert,
                                         'account_coa' => $data['payment_account'], 'payment_description' => trim($data['payment_description']),
                                         'payment_amount' => $data['pay_amount'], 'cheque_no' => trim($data['cheque_no']), 'transaction_type' => 1));

                        /*if($type==1) {
                          $glPayInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $PayInsert,
                                           'gl_account' => $income_account, 'amount_type' => 1, 'amount' => $data['pay_amount'],
                                           'transaction_type' => 4,'account_type' => 3, 'active_status' => $type));
                        }*/

                    }

                    if($invoiceInsert) {
                        Session::put('successalert','Invoice Created Successfully');
                        return 1;
                    } else {
                        return 2;
                    }

                   // print_r($data);
                 } else if($actionCall == 'save_edit_invoice') {
                    $postData = Input::get('postData');
                    parse_str($postData,$data);

                    $type = Input::get('type');

                    if($type==1) {
                        $approver = $this->id;
                    } else if($type==2) {
                        $approver = $data['approval_by'];
                    }
            
                    $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                    $data['date'] = date('Y-m-d',strtotime(trim($data['date'])));
                    $data['customerId']   = '';
                    $data['customerName'] = '';
                    $data['invoiceTo']    = '';
                    if($data['customer']==1) {
                        $data['customerId']   = $data['customer_id'];
                        $data['customerName'] = '';
                        $data['invoiceTo']    = $data['invoice_to'];
                        $receivable           = 2;
                    } else if($data['customer']==2) { 
                        $data['customerId']   = '';
                        $data['customerName'] = $data['customer_name'];
                        $data['invoiceTo']    = $data['invoice_to'];
                        $receivable           = 3;
                    }

                    $data['fktax_id']  = '';
                    $data['tax_value'] = '';
                    $taxCode  = $data['tax_code'];
                    $splitTax = explode("_", $taxCode);
                    if(isset($splitTax[0])) {
                        $data['fktax_id'] = $splitTax[0];
                    }
                    if(isset($splitTax[1])) {
                        $data['tax_value'] = $splitTax[1];
                    }

                    $invoiceUpdate = DB::table('il_accounting_invoice')->where('id',$data['invoice_id'])->update(array('customer_status' => $data['customer'],'fkcustomer_id' => $data['customerId'],'customer_name' => trim($data['customerName']),
                                     'invoice_to' => trim($data['invoiceTo']), 'credit_terms' => $data['credit_term'],'date' => $data['date'] ,
                                     'fktax_id' => $data['fktax_id'], 'tax_percentage' => $data['tax_value'],'transaction_description' => trim($data['memo']),
                                     'approval_for' => $approver, 'status' => $type, 'date_modified' => $currentDate));

                    if($type==1) {
                      if($data['credit_term']!=1) {
                      $glReceivableInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $data['invoice_id']."-1",
                                           'gl_account' => $receivable, 'amount_type' => 1, 'amount' => $data['total_amount'],
                                           'transaction_type' => 1,'account_type' => 1, 'active_status' => $type));
                      }

                      if(isset($data['fktax_id']) && !empty($data['fktax_id'])) {
                          $glTaxInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $data['invoice_id']."-1",
                                           'gl_account' => $data['fktax_id'], 'amount_type' => 2, 'amount' => $data['gst_amount'],
                                           'transaction_type' => 1,'account_type' => 4, 'active_status' => $type));
                      }

                    }

                    $update_counter = $data['update_counter'];
                    $counter        = $data['counter'];

                    for($i=1;$i<=$update_counter;$i++) {

                        $lid            = $data['invoiceline_id_'.$i];
                        $income_account = $data['income_account_'.$i];
                        $description    = trim($data['description_'.$i]);
                        $amount         = str_replace(",","", trim($data['amount_'.$i]));

                        $update = DB::table('il_accounting_invoice_lines')->where('id',$lid)->update(array('fkincomecoa_id' => $income_account, 'description' => $description, 'amount' => $amount, 'date_modified' => $currentDate));

                        /*if($type==1) {
                          $glIncomeInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $lid,
                                           'gl_account' => $income_account, 'amount_type' => 2, 'amount' => $amount,
                                           'transaction_type' => 1,'account_type' => 5, 'active_status' => $type));
                        }*/
                    }


                    for($i=++$update_counter;$i<=$counter;$i++) {

                        $income_account = $data['income_account_'.$i];
                        $description    = trim($data['description_'.$i]);
                        $amount         = str_replace(",","", trim($data['amount_'.$i]));

                        $insert = DB::table('il_accounting_invoice_lines')->insertGetId(array('fkinvoice_id' => $data['invoice_id'],'fkincomecoa_id' => $income_account, 'description' => $description, 'amount' => $amount));

                        /*if($type==1) {
                          $glIncomeInsert = DB::table('il_accounting_gl_entry')->insert(array('fktransaction_id' => $insert,
                                           'gl_account' => $income_account, 'amount_type' => 2, 'amount' => $amount,
                                           'transaction_type' => 1,'account_type' => 5, 'active_status' => $type));
                        }*/
                    }

                    if(isset($data['payment_trigger']) && $data['payment_trigger']==1 && isset($data['pay_payid']) && $data['credit_term']==1) {

                        $data['pay_amount'] = str_replace(",","", trim($data['payment_amount']));

                        $PayUpdate = DB::table('il_accounting_payments')->where('id',$data['pay_payid'])->update(array('account_coa' => $data['payment_account'], 'payment_description' => trim($data['payment_description']),
                                         'payment_amount' => $data['pay_amount'], 'cheque_no' => trim($data['cheque_no']), 'transaction_type' => 1, 'date_modified' => $currentDate));

                    } else if(isset($data['payment_trigger']) && $data['payment_trigger']==1 && !isset($data['pay_payid']) && $data['credit_term']==1) {

                        $data['pay_amount'] = str_replace(",","", trim($data['payment_amount']));

                        $PayInsert = DB::table('il_accounting_payments')->insert(array('fktransaction_id' => $data['invoice_id'],
                                         'account_coa' => $data['payment_account'], 'payment_description' => trim($data['payment_description']),
                                         'payment_amount' => $data['pay_amount'], 'cheque_no' => trim($data['cheque_no']), 'transaction_type' => 1));

                    } else if(isset($data['payment_trigger']) && $data['payment_trigger']==0 && isset($data['pay_payid']) && $data['credit_term']!=1) {

                      $payDelete  = DB::table('il_accounting_payments')->where('id',$data['pay_payid'])->delete();
                        
                    }

                    if($invoiceUpdate) {
                        Session::put('successalert','Invoice Updated Successfully');
                        return 1;
                    } else {
                        return 2;
                    }
                 }
            }
        }

}
?>