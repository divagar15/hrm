<?php
class FinanceController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
        /*
         * result array variable
         */
        protected $result = array();
        public function __construct() {
           if(Session::has('id')) {
                $this->id = Session::get('id');
            } else {
                $this->beforeFilter(function(){
                    return Redirect::to('login');
                });
            }
        }
        
        public function index(){
            
        }
        
        public function contractFeeListing(){
            $getBranch  = DB::table('il_branch')->select('id','branch_name')->get();
            if(!empty($getBranch)){
                foreach($getBranch as $branch){
                    $brancList[$branch->id] = $branch->branch_name;
                }
            }
            $fee_type = DB::table('il_target_fee')->select('id','fee_type')->get();
            if(!empty($fee_type)){
                foreach($fee_type as $fee){
                    $fee_type[$fee->id] = $fee->fee_type;
                }
            }
            $result = DB::select(DB::raw('select c_dtls.id as contract_id,c_dtls.contract_no,c_dtls.fee_type as fee_collected,emp.emp_name,cinvoice_dtls.target_fee as total_amt,sum(cinvoice_dtls.paid_amt) as paid_sum_amt,cus_dtls.branch from il_contract_invoice_details as cinvoice_dtls join il_contract_details as c_dtls ON(c_dtls.id = cinvoice_dtls.fkContractId) join il_customer_details as cus_dtls ON(cus_dtls.id = c_dtls.fkCustomerId) join il_emp_details as emp ON(emp.id = cus_dtls.service_officer_id) group by cinvoice_dtls.fkContractId  order by cinvoice_dtls.id desc'));
            return View::make('FinanceManager.accounting.contractFeeListing')->with(array('contract_list' => $result,'branch' => $brancList,'fee_type' => $fee_type));
        }
        
        /*
         * Purpose : Create Contract Invoice for invoice id
         * Return  : assoicative array 
         */
        public function contractInvoicePreview() {
            $invoiceId = Request::Segment(3);
            $companyInfo = DB::table('il_company_info')->select('organization_name','phone_no','address1','email_id','city','country')->where('id',1)->first();
            $invoice_info = DB::table('il_contract_invoice_details')->join('il_contract_details','il_contract_details.id','=','il_contract_invoice_details.fkContractId')->join('il_customer_details','il_customer_details.id','=','il_contract_details.fkCustomerId')->join('il_emp_details','il_emp_details.id','=','il_customer_details.service_officer_id')->select('il_contract_invoice_details.id','il_contract_invoice_details.fkContractId','il_contract_invoice_details.invoice_no','il_contract_invoice_details.invoice_date','il_contract_invoice_details.version_no','il_contract_invoice_details.pay_mode','il_contract_invoice_details.admin_fee','il_contract_invoice_details.insurance_fee','il_contract_invoice_details.agency_fee','il_contract_invoice_details.paid_admin_fee','il_contract_invoice_details.paid_ins_fee','il_contract_invoice_details.paid_agency_fee','il_contract_invoice_details.bal_admin_fee','il_contract_invoice_details.bal_ins_fee','il_contract_invoice_details.bal_agency_fee','il_contract_invoice_details.target_fee',
                    'il_contract_invoice_details.paid_amt','il_contract_invoice_details.bal_amt','il_contract_details.fee_type','il_contract_details.loan_opt','il_contract_details.loan_amount','il_contract_details.loan_collect_date','il_contract_details.loan_tenure','il_customer_details.customer_name','il_customer_details.address','il_customer_details.email_id','il_customer_details.contact_no','il_emp_details.emp_name')->where('il_contract_invoice_details.id',$invoiceId)->first();
            $applicationInfo = DB::table('il_application_details')->select('handover_date')->where('fkContractId',$invoice_info->fkContractId)->orderBy('id','desc')->first();
            if(!empty($invoice_info)) {
                $feeId = explode(',',$invoice_info->fee_type);
                $getFeeValue = DB::table('il_target_fee')->select('fee_type','fee_amt')->whereIn('id',$feeId)->get();
                if($invoice_info->loan_opt == 1) {
                    $loanInfo = DB::table('il_contract_loan')->select('emi_amt','collect_date','paid_amt')->where('fkContractId',$invoice_info->fkContractId)->get();
                } else
                    $loanInfo = '';
               
            }
            return View::make('FinanceManager.invoice.contract_invoice')->with(array('company_info' => $companyInfo,'invoice_info' => $invoice_info,'fee_list' => $getFeeValue,'handover' => $applicationInfo,'loan_info' => $loanInfo));
        }
        
        /*
         * Purpose : Print contract Invoice generated
         * return Invoice in pdf file
         */
        
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
        /*
         * Purpose : Employee List with basic pay
         * Return  :  array value
         */
        public function employeeListing(){
            $getBranch  = DB::table('il_branch')->select('id','branch_name')->get();
            if(!empty($getBranch)){
                foreach($getBranch as $branch){
                    $branchList[$branch->id] = $branch->branch_name;
                }
            }
            $user_type = DB::table('il_user_type')->select('id','user_type')->get();
            if(!empty($user_type)){
                foreach($user_type as $type){
                    $user_type[$type->id] = $type->user_type;
                }
            }
            $emp_list = DB::table('il_emp_details as emp_dtls')->leftJoin('il_emp_job_info as emp_job','emp_job.fkEmpId','=','emp_dtls.id')->select('emp_dtls.id as emp_id','emp_dtls.emp_name','emp_dtls.user_role','emp_job.fkBranchId as branch','emp_job.basic_wage','emp_job.advance_loan')->where('emp_dtls.user_role','!=',1)->get(); 
            return View::make('FinanceManager.accounting.employeeListing')->with(array('emp_list' => $emp_list,'user_type' => $user_type,'branch' => $branchList));
        }
        
        /*
         * Purpose  : Contract Invoice listing
         * Return   : array value as result 
         *
        public function contractInvoiceListing() {
             $getBranch  = DB::table('il_branch')->select('id','branch_name')->get();
             if(!empty($getBranch)){
                foreach($getBranch as $branch){
                    $branchList[$branch->id] = $branch->branch_name;
                }
              }
              $fee_type = DB::table('il_target_fee')->select('id','fee_type')->get();
              if(!empty($fee_type)){
                    foreach($fee_type as $fee){
                        $fee_type[$fee->id] = $fee->fee_type;
                    }
              }
             $result = DB::table('il_contract_details as cdtls')->join('il_customer_details as cus_dtls','cus_dtls.id','=','cdtls.fkCustomerId')->join('il_emp_details as emp','emp.id','=','cus_dtls.service_officer_id')->select('cdtls.id as contract_id','cdtls.contract_no','cdtls.fee_type as fee_collected','cus_dtls.customer_name','cus_dtls.branch','emp.emp_name')->get();
             return View::make('FinanceManager.invoice.contractInvoiceListing')->with(array('invoice_list' => $result,'fee_type' => $fee_type,'branch' => $branchList));
              
        }*/
        
        /*
         * Purpose : Contract Invoice View for particular contract
         * Return  : List of iteration of invoice
         */
        public function InvoiceByContract() {
             $getBranch  = DB::table('il_branch')->select('id','branch_name')->get();
             if(!empty($getBranch)){
                foreach($getBranch as $branch){
                    $branchList[$branch->id] = $branch->branch_name;
                }
              }
              $fee_type = DB::table('il_target_fee')->select('id','fee_type')->get();
              if(!empty($fee_type)){
                    foreach($fee_type as $fee){
                        $fee_type[$fee->id] = $fee->fee_type;
                    }
              }
              $contract_id = Request::Segment(3);
              $result = DB::select(DB::raw('select c_dtls.id as contract_id,c_dtls.contract_no,c_dtls.fee_type as fee_collected,emp.emp_name,cinvoice_dtls.id as invoice_id,cinvoice_dtls.invoice_date,cinvoice_dtls.version_no,cinvoice_dtls.invoice_date,cinvoice_dtls.pay_mode,cinvoice_dtls.target_fee as total_amt,cinvoice_dtls.paid_amt,cinvoice_dtls.bal_amt,cus_dtls.branch from il_contract_invoice_details as cinvoice_dtls join il_contract_details as c_dtls ON(c_dtls.id = cinvoice_dtls.fkContractId) join il_customer_details as cus_dtls ON(cus_dtls.id = c_dtls.fkCustomerId) join il_emp_details as emp ON(emp.id = cus_dtls.service_officer_id) where c_dtls.id = '.$contract_id.' order by cinvoice_dtls.id desc,cinvoice_dtls.fkContractId desc'));
              return View::make('FinanceManager.accounting.InvoiceListBycontract')->with(array('invoice_list' => $result,'fee_type' => $fee_type,'branch' => $branchList));
        }
        /*
         * Purpose : Target fee listing
         * Return : boolean value
         */
        
        public function targetFeeListing() {
            $targetFee = DB::table('il_target_fee')->select('id','fee_type','fee_amt')->get();
            return View::make('FinanceManager.accounting.targetFeeListing')->with(array('fee_list' => $targetFee));
        }
        
        public function addTargetFee() {
            return View::make('FinanceManager.accounting.addTargetFee');
        }
        
        /*
         * Purpose : Create target fee listing
         * Return : boolean value
        */
        public function createTargetFee() {
            $feeType = Input::get('fee_type');
            $feeAmt  = Input::get('fee_amt');
            $currentDate = date('Y-m-d',strtotime('now'));
            $insert  = DB::table('il_target_fee')->insert(array('fee_type' => $feeType,'fee_amt' => $feeAmt,'dateCreated' => $currentDate));
            if($insert)
                return Redirect::to('account/target-fee-list')->with('successalert','Target fee add successfully');
            else
                return Redirect::to('account/target-fee-list')->with('erroralert','Server Problem not updated successfully'); 
            
        }
        /*
         * Purpose : View Target fee
         * Return : boolean value
        */
        public function ViewTargetFee() {
            $id = Request::Segment(3);
            $select  = DB::table('il_target_fee')->select('fee_type','fee_amt')->where('id',$id)->first();
            return View::make('FinanceManager.accounting.viewTargetFee')->with(array('fee_list' => $select));
        }
        public function updateTargetFee() {
            $feeType = Input::get('fee_type');
            $feeAmt  = Input::get('fee_amt');
            $id      = Input::get('target_id');
            $modifyDate = date('Y-m-d',strtotime('now'));
            $update = DB::table('il_target_fee')->where('id',$id)->update(array('fee_type' => $feeType,'fee_amt' => $feeAmt,'dateModified' => $modifyDate));
            return Redirect::to('account/target-fee-list')->with('successalert','Target fee updated successfully');
          
        }
        
        /*
         * Purpose Contract listing for payment schedule
         * return boolean value
         */
        public function paymentContractList(){
           $result = DB::table('il_contract_details as c_dtls')->join('il_customer_details as cus_dtls','c_dtls.fkCustomerId','=','cus_dtls.id')->join('il_bio_data as mbio','mbio.id','=','c_dtls.fkBioId')->join('il_branch as branch','branch.id','=','cus_dtls.branch')->select('c_dtls.id as contract_id','c_dtls.contract_no','cus_dtls.customer_name','mbio.maid_name','branch.branch_name')->get();
           return View::make('FinanceManager.accounting.paymentContractList')->with(array('contract_list' => $result));
        }
        
        /*
         * Purpose : view Contract payment details to edit value
         * return Boolean value
         */
        public function contractPaymentInfo(){
             $contractId = Request::Segment(3); //contractId 
             $paidLoanList = $unPaidLoanList = array();
             $result = DB::table('il_contract_details as c_dtls')->join('il_customer_details as cus_dtls','c_dtls.fkCustomerId','=','cus_dtls.id')->join('il_bio_data as mbio','mbio.id','=','c_dtls.fkBioId')->join('il_branch as branch','branch.id','=','cus_dtls.branch')->select('c_dtls.id as contract_id','c_dtls.contract_no','c_dtls.fee_type','c_dtls.fee_approval','c_dtls.loan_opt','c_dtls.loan_amount','c_dtls.loan_collect_date','c_dtls.loan_tenure','c_dtls.contract_terms','c_dtls.contract_from','c_dtls.contract_to','c_dtls.maid_basic_salary','c_dtls.maid_salary_date','cus_dtls.customer_name','mbio.id as maid_id','mbio.maid_name','branch.branch_name')->where('c_dtls.id',$contractId)->first();
             $loanPay = DB::table('il_contract_loan as cloan')->select('cloan.id','cloan.emi_amt','cloan.fkContractId as contract_id','cloan.collect_date','cloan.pay_status','cloan.paid_amt')->where('cloan.fKContractId',$contractId)->get();
             $salary_info = DB::table('il_maid_salary_log')->select('id','monthly_salary','salary_pay_date','salary_deduction','salary_earnings','total_pay','salary_issue_date','pay_status')->where('fkContractId',$contractId)->get();
             $fee_type = DB::table('il_target_fee')->select('id','fee_type')->get();
              if(!empty($fee_type)){
                    foreach($fee_type as $fee){
                        $fee_type[$fee->id] = $fee->fee_type;
                    }
              }
             if(!empty($loanPay)){
                 foreach($loanPay as $list) {
                     if($list->pay_status == 1) {
                         $paidLoanList[] = $list;
                     } else {
                         $unPaidLoanList[] = $list;
                     }
                 }
             }
             return View::make('FinanceManager.accounting.viewContractPayInfo')->with(array('contract_info' => $result,'loan_pay_info' =>$unPaidLoanList,'paid_loan_list' => $paidLoanList,'salary_info' => $salary_info,'contract_id' => $contractId,'fee_type' => $fee_type));
          }
        
        /*
         * Purpose : fix maid salary and salary date
         * return array value
         */
        public function maidSalaryFix(){
            $contract_term    = Request::Segment(3);
            $contractId       = Request::Segment(4);
            $maid_salary      = Input::get('maid_salary');
            $maid_salary_date = Input::get('mail_salary_date');
            $maid_id          = Input::get('maid_id');
            $uStatus = DB::table('il_contract_details')->where('id',$contractId)->update(array('maid_basic_salary' => $maid_salary,'maid_salary_date' => $maid_salary_date));
            if($uStatus) {
                $countVal = DB::select(DB::raw('select id as sal_id from il_maid_salary_log where fkContractId ='.$contractId));
                if(empty($countVal)) {
                    for($i=1; $i<=$contract_term;$i++){
                                $salary_date = date('Y-m-d',strtotime(date("Y-m-d", strtotime($maid_salary_date)) . " +".$i." month"));
                                DB::table('il_maid_salary_log')->insert(array('fkContractId' => $contractId,'fkBioId' => $maid_id,'monthly_salary' => $maid_salary,'salary_pay_date' => $salary_date));
                    }
                } else {
                    $i = 1;
                    $currentDate = date('Y-m-d',strtotime('now'));
                    foreach($countVal as $list) {
                        $salary_date = date('Y-m-d',strtotime(date("Y-m-d", strtotime($maid_salary_date)) . " +".$i." month"));
                        DB::table('il_maid_salary_log')->where('id',$list->sal_id)->update(array('fkBioId' => $maid_id,'monthly_salary' => $maid_salary,'salary_pay_date' => $salary_date,'dateModified' => $currentDate));
                        $i++;
                    }
                }
                return Redirect::to('account/contract-payment-info/'.$contractId)->with('successalert','Maid basic salay fix successfully');
            }
            
        }
        
        /*
         * Purpose : pay loan amount to view load amount
         * return boolean
         */
      public function payLoanAmount() {
          $pay_amt    = Input::get('pay_amt');
          $pay_status = 1;
          $contractId = Input::get('contract_id');
          $loan_id    = Input::get('loan_id');
          $uStatus    = DB::table('il_contract_loan')->where('id',$loan_id)->where('fkcontractId',$contractId)->update(array('pay_status' => $pay_status,'paid_amt' => $pay_amt));
          if($uStatus)
              return Redirect::to('account/contract-payment-info/'.$contractId)->with('successalert','Loan Amount paid Successfully');
      }
      
      /*
       * Purpose : Update Salary amount with earning / deducation amount 
       * return salary amount
       */
      public function  paySalaryAmt(){ 
          $salary_id    = Input::get('salary_id');
          $basic_salary =  (double)Input::get('salary_amt');
          $earning      =  (double)Input::get('earn_amt');
          $deducation   =  (double)Input::get('dedu_amt');
          $contractId   =   Input::get('contract_val');
          $total_amt    =   $basic_salary + $earning;
          $total_amt    =   $total_amt - $deducation;
          $currentDate  = date('Y-m-d h;i:s',strtotime('now'));
          $issue_date   = date('Y-m-d',strtotime('now'));
          $update = DB::table('il_maid_salary_log')->where('id',$salary_id)->update(array('salary_deduction' => $deducation,'salary_earnings' => $earning,'total_pay' => $total_amt,'pay_status' => 1,'salary_issue_date' => $issue_date,'dateModified' => $currentDate));
          if($update)
              return Redirect::to('account/contract-payment-info/'.$contractId)->with('successalert','Salary Amount paid Successfully');

      }
      
      /*
       * Purpose : Print payment schedule to particular contract
       * return array value
       * Param : Contract Id as integer
       */
      public function printPaymentSchedule(){
          $contractId = Request::Segment(3);
          $basic_info = DB::table('il_contract_details as c_dtls')->join('il_customer_details as cus_dtls','cus_dtls.id','=','c_dtls.fkCustomerId')->join('il_emp_details as emp','emp.id','=','cus_dtls.service_officer_id')->join('il_bio_data as mbio','mbio.id','=','c_dtls.fkBioId')->select('mbio.maid_name','emp.emp_name','c_dtls.maid_basic_salary as maid_salary','c_dtls.loan_amount')->where('c_dtls.id',$contractId)->first();
          $loanPay = DB::table('il_contract_loan as cloan')->select('cloan.id','cloan.emi_amt','cloan.fkContractId as contract_id','cloan.collect_date','cloan.pay_status','cloan.paid_amt')->where('cloan.fKContractId',$contractId)->get();
          $salary_info = DB::table('il_maid_salary_log')->select('id','monthly_salary','salary_pay_date','salary_deduction','salary_earnings','total_pay','pay_status')->where('fkContractId',$contractId)->get();
          $pay_temp = ScheduleSalaryPayment::printPaymentSchedule($basic_info, $salary_info,$loanPay);
          return PDF::load($pay_temp, 'A3', 'portrait')->download('paymentSchedule_'.$contractId);
         
      }
      
      /*
       * Purpose : config commission range and valuye per contract and bonus
       * return list o record
       */
      public function getCommissionList() {
          $getComList = DB::table('il_commission_dtls')->select('id','cost_type','min_range','max_range','per_cost','range_type')->get();
          return View::make('FinanceManager.accounting.commissionConfigList')->with(array('com_list' => $getComList));
      } 
     
     /*
      * Purpost : Edit configure costing 
      * return boolean value
      */
      public function editCommission() {
          $postData = Input::all();
          $cid = Request::Segment(3);
          $getCom = DB::table('il_commission_dtls')->select('cost_type','min_range','max_range','per_cost','range_type')->where('id',$cid)->first();
          
          if(!empty($postData)) {
              if($cid == 1 || $cid == 3) {
                 $type2Id    = $cid + 1;
                 $max_range  = Input::get('max_range');
                 $update = DB::table('il_commission_dtls')->where('id',$cid)->update($postData);
                 $updateRange2 = DB::table('il_commission_dtls')->where('id',$type2Id)->update(array('min_range' => $max_range));
              } else { 
                 $update = DB::table('il_commission_dtls')->where('id',$cid)->update($postData);
              }
              if($update)
                  return Redirect::to('account/commission-config-list')->with('successalert','Commission value successfully configured');
              else
                  return Redirect::to('account/commission-config-list')->with('erroralert','No modification done or Sorry server problem.. Try again');
          } 
          return View::make('FinanceManager.accounting.editCommission')->with(array('cview' => $getCom,'id' => $cid));
      }


        /*
         * Purpose : Delete commission if there is no employee assigned to that branch
         * Return boolean value
         */
        public function deleteCommission() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_job_info where fkBranchId='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_commission_dtls')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('account/commission-config-list')->with(array('successalert' => 'Commission Deleted Successfully'));
                else
                       return Redirect::to('account/commission-config-list')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('account/commission-config-list')->with(array('erroralert' => 'Commission already assigned so it cannot be deleted'));
            }
        }
}
?>