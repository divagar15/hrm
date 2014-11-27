<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('login','HomeController@signin');
Route::post('login-process','HomeController@signin');
Route::get('logout','HomeController@signout');
Route::post('login/forgot-password','HomeController@forgotPassword');
Route::post('login/change-password','HomeController@changePassword');
Route::resource('/', 'HomeController');
Route::get('export/{string}','ReportController@export');
Route::post('import/{string}','ReportController@import');
Route::get('import-lead','LeadController@importLead');
Route::get('lead/mass-mail','LeadController@sendMassMail');
Route::post('lead/mass-mail','LeadController@sendMassMail');
Route::get('lead/contracted-lead','LeadController@contractedLead');
Route::post('lead/contracted-lead','LeadController@contractedLead');
Route::get('lead-transfer/assign','LeadController@changeLead');
Route::post('lead-transfer/assign','LeadController@changeLead');
//Route::get('docpdf','LeadController@pdf');
Route::get('docTest','LeadController@pdfTest');
Route::get('contract/generate-forms/{id}','LeadController@Form');

Route::resource('lead','LeadController');

Route::get('lead/delete/{id}','LeadController@destroy');
Route::get('contractSuccess',function()
{
  Session::forget('customerId');
  Session::forget('bioId');
  Session::forget('contract_id');
  Session::forget('contract_no');
  Session::forget('app_status');
  Session::forget('app_id');
  return Redirect::to('contract-list')->with('successalert','Contract processed successfully');
});
Route::get('contract-closed',function()
{
  Session::forget('customerId');
  Session::forget('bioId');
  Session::forget('contract_id');
  Session::forget('contract_no');
  Session::forget('app_status');
  Session::forget('app_id');
  return Redirect::to('contract-list')->with('erroralert','Your contract closed due application failed');
});
Route::post('lead/mail','LeadController@sendMail');
Route::post('lead/ajax-call','LeadController@ajaxCall');
Route::post('follow','LeadController@followup');
Route::get('leadExport','LeadController@exportLead');
Route::get('create-contract','ContractController@createCustomer');

//Route::get('create-contract-from-lead/{leadId}','ContractController@createContractFromLead'); /// edit

Route::post('createcustomer','ContractController@storeCustomer');
Route::get('create-contract/{string1}/{string2}','ContractController@createContract');
Route::get('create-contract/{string1}/{string2}/{string3}','ContractController@createContract');
Route::post('contract-process/{string}','ContractController@contractProcess');
Route::post('contract/ajax-call','ContractController@ajaxCall');
Route::get('edit-contract/{string1}/{string2}','ContractController@editContract');
Route::get('edit-contract/{string1}/{string2}/{string3}','ContractController@editContract');
Route::post('edit-contract-process/{string1}','ContractController@editContractProcess');
Route::get('edit-contracts/step1/status/{string1}/{string2}','ContractController@draftContract');
Route::get('contract/terminate/{string1}/{string2}','ContractController@terminateContract');
Route::post('contract/terminate/{string1}/{string2}','ContractController@terminateContract');
Route::get('contract/cheque-issue/{string1}/','ContractController@issueCheque');
Route::post('contract/cheque-issue/{string1}/','ContractController@issueCheque');
Route::get('contract-list','ContractController@contractListing');
Route::get('contract/contract-terminate-list','ContractController@contractTerminateListing');
Route::get('contract/contract-cases','ContractController@contractTerminateProcess');
Route::post('contract/contract-cases','ContractController@contractTerminateProcess');
Route::get('contract/contract-approval/{status}/{id}','ContractController@contractTerminateApproval');
Route::post('contract/vendor-balance-payment','ContractController@payToVendor');
Route::get('change-contract-cases/{string1}/{string2}','ContractController@changeContractCases');
Route::post('contract/balance-payment','ContractController@contractBalPayment');
Route::post('contract/opt-loan','ContractController@optLoan');
Route::get('contract/pay-salary-schedule/{string}','ReportsController@printPaymentSchedule');
Route::get('contract/mail-arrival-list','ContractController@mailArrivalListing');
Route::get('contract/contract-renewal/{string}','ContractController@contractRenewal');
Route::post('contract/add-admin-rebate','ContractController@addAdminRebate');
Route::get('account/on-going-contract-fee-list','FinanceController@contractFeeListing');
Route::get('account/employee-pay-list','FinanceController@employeeListing');
Route::get('account/target-fee-list','FinanceController@targetFeeListing');
Route::get('account/view-target-fee','FinanceController@viewTargetFee');
Route::get('account/add-target-fee','FinanceController@addTargetFee');
Route::post('account/create-target-fee','FinanceController@createTargetFee');
Route::get('account/view-target-fee/{string}','FinanceController@viewTargetFee');
Route::post('account/update-target-fee','FinanceController@updateTargetFee');
Route::get('account/invoice-list-by-contract/{string}','FinanceController@InvoiceByContract');
Route::get('account/payment-contract-list','FinanceController@paymentContractList');
Route::get('account/contract-payment-info/{string}','FinanceController@contractPaymentInfo');
Route::post('account/maid-salary-fix/{string1}/{string2}','FinanceController@maidSalaryFix');
Route::post('account/pay-salary-amt','FinanceController@paySalaryAmt');
Route::get('invoice/pay-salary-schedule/{string}','FinanceController@printPaymentSchedule');
Route::post('account/pay-loan-amt','FinanceController@payLoanAmount');
Route::get('invoice/contract-invoice-preview/{string}','FinanceController@contractInvoicePreview');
Route::get('account/commission-config-list','FinanceController@getCommissionList');
Route::get('account/edit-commission-config/{string}','FinanceController@editCommission');
Route::post('account/edit-commission-config/{string}','FinanceController@editCommission');
Route::get('account/delete-commission/{string}','FinanceController@deleteCommission');


Route::get('print',function(){
return View::make('FinanceManager.invoice.contract_invoice_print');
    
});
Route::get('invoice/print-contract-invoice/{string}','FinanceController@contractInvoicePrint');
Route::post('store-contract','LeadController@storeContract');
Route::get('create-application','LeadController@getApplicationNumber');
Route::resource('user-profile','BioDataController');
Route::get('user-profile/delete/{id}','BioDataController@destroy');
Route::get('import-bio-data','BioDataController@importBioData');
Route::post('ajax-call','BioDataController@ajaxCall');
Route::post('user-profile/ajax-call','BioDataController@ajaxCall');
//Route::get('lead/leadListing','LeadController');
Route::get('dashboard','HomeController@dashboard');
Route::post('home/ajax-call','HomeController@ajaxCall');

//Route::get('/', 'HomeController@test');
Route::resource('testaction/', 'HomeController@testaction');
/* system user start */
Route::resource('employee','EmployeeController');
Route::post('employee','EmployeeController@index');
Route::post('employee/store','EmployeeController@store');
Route::get('employee/view-employee-profile/{string}','EmployeeController@viewEmployeeInfo');
Route::post('employee/addEmployeeInfo/{string}','EmployeeController@addEmployeeInfo');
Route::post('employee/addEmployeeJob/{string}','EmployeeController@addEmployeeJob');
Route::post('employee/change-password','EmployeeController@changePassword');
Route::get('pay-grade','EmployeeController@addPayGrade');
Route::post('insert-pay-grade','EmployeeController@insertPayGrade');
Route::get('edit-pay-grade/{string}','EmployeeController@editPayGrade');
Route::post('update-pay-grade','EmployeeController@updatePayGrade');
Route::get('delete-pay-grade/{string}','EmployeeController@deletePayGrade');
Route::get('paygrade/create-jobTitle','EmployeeController@addJobTitle');
Route::post('insert-jobTitle','EmployeeController@insertJobTitle');
Route::post('employee/ajax-call','EmployeeController@ajaxCall');
Route::get('attendance/punch-in','HumanResourceController@punchLogTracking');
Route::post('attendance/punch-in-out-process','HumanResourceController@punchInOutProcess');
Route::get('attendance/punch-out','HumanResourceController@punchLogTracking');
Route::get('attendance/view-my-attendance-record','HumanResourceController@viewAttendanceRecord');
Route::get('attendance/view-employee-total-work-sheet','HumanResourceController@viewEmployeeTotalHrsSheet');
Route::post('attendance/view-employee-total-work-sheet','HumanResourceController@viewEmployeeTotalHrsSheet');
Route::get('attendance/view-employee-month-time-sheet/{string}','HumanResourceController@viewEmployeeMonthTimeSheet');
//Route::get('payroll/calculate-net-pay/{string}','PayRollController@calculateEmpNetPaySalary');
Route::get('leave/holiday-list','HumanResourceController@holidayList');
Route::get('leave/add-holiday','HumanResourceController@addHoliday');
Route::post('leave/add-holiday','HumanResourceController@addHoliday');
Route::get('leave/edit-holiday/{string}','HumanResourceController@editHoliday');
Route::post('leave/edit-holiday/{string}','HumanResourceController@editHoliday');
Route::get('leave/delete-holiday/{string}','HumanResourceController@deleteHoliday');
Route::get('leave/add-alt-holiday','HumanResourceController@addAltHoliday');
Route::post('leave/add-alt-holiday','HumanResourceController@addAltHoliday');
Route::get('leave/edit-alt-holiday/{string}','HumanResourceController@editAltHoliday');
Route::post('leave/edit-alt-holiday/{string}','HumanResourceController@editAltHoliday');
Route::get('leave/delete-alt-holiday/{string}','HumanResourceController@deleteAltHoliday');
Route::get('leave/alt-holiday-list','HumanResourceController@altHolidayList');
Route::get('payroll/employee-work-sheet','HumanResourceController@viewEmployeeWorkSheet');

/*Residential Status,race,bank and allowance Config*/
Route::get('employee/config/residential-status','EmployeeController@residentialStatus');
Route::get('employee/config/add-residential-status','EmployeeController@addresidentialStatus');
Route::post('employee/config/add-residential-status','EmployeeController@addresidentialStatus');
Route::get('employee/config/edit-residential-status/{string}','EmployeeController@editresidentialStatus');
Route::post('employee/config/edit-residential-status/{string}','EmployeeController@editresidentialStatus');
Route::get('employee/config/delete-residential-status/{string}','EmployeeController@deleteresidentialStatus');

Route::get('employee/config/race','EmployeeController@race');
Route::get('employee/config/add-race','EmployeeController@addRace');
Route::post('employee/config/add-race','EmployeeController@addRace');
Route::get('employee/config/edit-race/{string}','EmployeeController@editRace');
Route::post('employee/config/edit-race/{string}','EmployeeController@editRace');
Route::get('employee/config/delete-race/{string}','EmployeeController@deleteRace');

Route::get('employee/config/allowance','EmployeeController@allowance');
Route::get('employee/config/add-allowance','EmployeeController@addAllowance');
Route::post('employee/config/add-allowance','EmployeeController@addAllowance');
Route::get('employee/config/edit-allowance/{string}','EmployeeController@editAllowance');
Route::post('employee/config/edit-allowance/{string}','EmployeeController@editAllowance');
Route::get('employee/config/delete-allowance/{string}/{string2}','EmployeeController@deleteAllowance');

Route::get('company/config/bank','HumanResourceController@configBank');
Route::post('company/config/bank','HumanResourceController@configBank');

Route::get('config/designation','EmployeeController@addJobTitle');
Route::post('config/create-designation','EmployeeController@insertJobTitle');
Route::get('config/edit-designation/{string}','EmployeeController@editJobTitle');
Route::post('config/edit-designation/{string}','EmployeeController@editJobTitle');
Route::get('config/delete-designation/{string}','EmployeeController@deleteJobTitle');

Route::get('config/nationality','CompanyController@nationalityListing');
Route::get('config/add-nationality','CompanyController@addNationality');
Route::post('config/add-nationality','CompanyController@addNationality');
Route::get('config/edit-nationality/{string}','CompanyController@editNationality');
Route::post('config/edit-nationality/{string}','CompanyController@editNationality');
Route::get('config/delete-nationality/{string}','CompanyController@deleteNationality');

Route::get('config/pob','CompanyController@pobListing');
Route::get('config/add-pob','CompanyController@addPob');
Route::post('config/add-pob','CompanyController@addPob');
Route::get('config/edit-pob/{string}','CompanyController@editPob');
Route::post('config/edit-pob/{string}','CompanyController@editPob');
Route::get('config/delete-pob/{string}','CompanyController@deletePob');


Route::get('config/category','CompanyController@categoryListing');
Route::get('config/add-category','CompanyController@addCategory');
Route::post('config/add-category','CompanyController@addCategory');
Route::get('config/edit-category/{string}','CompanyController@editCategory');
Route::post('config/edit-category/{string}','CompanyController@editCategory');
Route::get('config/delete-category/{string}','CompanyController@deleteCategory');

Route::get('config/martial-status','CompanyController@martialStatusListing');
Route::get('config/add-martial-status','CompanyController@addMartialStatus');
Route::post('config/add-martial-status','CompanyController@addMartialStatus');
Route::get('config/edit-martial-status/{string}','CompanyController@editMartialStatus');
Route::post('config/edit-martial-status/{string}','CompanyController@editMartialStatus');
Route::get('config/delete-martial-status/{string}','CompanyController@deleteMartialStatus');

Route::get('config/cessation','CompanyController@cessationListing');
Route::get('config/add-cessation','CompanyController@addCessation');
Route::post('config/add-cessation','CompanyController@addCessation');
Route::get('config/edit-cessation/{string}','CompanyController@editCessation');
Route::post('config/edit-cessation/{string}','CompanyController@editCessation');
Route::get('config/delete-cessation/{string}','CompanyController@deleteCessation');


Route::get('config/employment-level','CompanyController@addEmploymentLevel');
Route::post('config/create-employment-level','CompanyController@insertEmploymentLevel');
Route::get('config/edit-employment-level/{string}','CompanyController@editEmploymentLevel');
Route::post('config/edit-employment-level/{string}','CompanyController@editEmploymentLevel');
Route::get('config/delete-employment-level/{string}','CompanyController@deleteEmploymentLevel');

Route::get('config/company','CompanyController@company');
Route::post('config/company','CompanyController@company');

/*Staff Loan Starts */
Route::get('staff/appliedloans','HumanResourceController@appliedLoans');
Route::post('staff/appliedloans','HumanResourceController@appliedLoans');
Route::get('staff/request-loan','HumanResourceController@requestLoan');
Route::post('staff/request-loan','HumanResourceController@requestLoan');

Route::get('staff/loans','HumanResourceController@allLoans');
Route::post('staff/loans','HumanResourceController@allLoans');
Route::get('staff/loan/reject-id/{string}','HumanResourceController@rejectLoan');
Route::get('staff/process-loan/{string}','HumanResourceController@processLoan');
Route::post('staff/process-loan/{string}','HumanResourceController@processLoan');
Route::get('staff/cheque-issue/{string}','HumanResourceController@chequeIssue');
Route::post('staff/cheque-issue/{string}','HumanResourceController@chequeIssue');
Route::get('staff/view-loan/{string}','HumanResourceController@viewLoan');

/*Accounting Module Starts*/
Route::get('account/coa','AccountController@coaListing');
Route::post('account/ajax-call','AccountController@ajaxCall');
Route::post('account/create-coa','AccountController@createCoa');
Route::post('account/create-level','AccountController@createLevel');
Route::post('account/create-level','AccountController@createLevel');
Route::post('account/edit-level','AccountController@editLevel');
Route::post('account/edit-coa','AccountController@editCoa');
Route::get('account/delete-coa/{string}','AccountController@deleteCoa');
Route::get('account/delete-level/{string}','AccountController@deleteLevel');
Route::get('account/opening-balance','AccountController@openingBalance');
Route::post('account/opening-balance','AccountController@openingBalance');
Route::get('account/taxcodes','AccountController@taxcodes');
Route::get('account/settax/{string}','AccountController@setTax');
Route::get('account/unsettax/{string}','AccountController@unsetTax');

/*Accounting Invoice Starts */
Route::get('account/invoice','InvoicesController@index');
Route::get('account/invoice/add','InvoicesController@add');
Route::get('account/invoice/edit/{string}','InvoicesController@edit');
Route::get('account/invoice/copy/{string}','InvoicesController@copy');
Route::get('account/invoice/print/{string}','InvoicesController@printInvoice');
Route::post('account/invoice/approve/','InvoicesController@approveInvoice');
Route::post('account/invoice/delete/','InvoicesController@deleteInvoice');
Route::post('account/invoice/save-draft','InvoicesController@saveDraft');
Route::post('account/invoice/save-invoice','InvoicesController@saveInvoice');
Route::post('invoice/add-payment-vendor','InvoicesController@payToMaidVendor');
Route::post('invoice/edit-payment-vendor','InvoicesController@editToMaidVendor');

/*Accounting Invoice Ends */

/*Accounting Journal Starts*/
Route::get('account/journal','JournalController@index');
Route::get('account/journal/add','JournalController@add');
Route::post('account/journal/save-draft','JournalController@saveDraft');
Route::post('account/journal/save-draft-edit/{id}','JournalController@saveDraftEdit');
Route::post('account/journal/save-draft-copy','JournalController@saveDraftCopy');
Route::post('account/journal/save-journal','JournalController@saveDraft');
Route::post('account/journal/save-journal-edit/{id}','JournalController@saveDraftEdit');
Route::post('account/journal/save-journal-copy/{id}','JournalController@saveCopy');
Route::post('account/journal/save-journal-approve','JournalController@saveDraft');
Route::post('account/journal/save-journal-approve-edit/{id}','JournalController@saveDraftEdit');
Route::post('account/journal/save-journal-approve-copy','JournalController@saveDraftCopy');
Route::get('account/journal/edit/{id}','JournalController@editJournal');
Route::get('account/journal/copy/{id}','JournalController@copyJournal');
Route::post('account/journal/approve/','JournalController@approveJournal');
Route::post('account/journal/delete/','JournalController@deleteJournal');
/*Accounting journal ends*/

/*Accounting Receipts Starts */
Route::get('account/receipts','ReceiptController@index');
Route::get('account/receipts/add','ReceiptController@add');
Route::get('account/receipts/edit/{string}','ReceiptController@edit');
Route::get('account/receipts/copy/{string}','ReceiptController@copy');
Route::post('account/receipts/approve/','ReceiptController@approveReceipt');
Route::post('account/receipts/delete/','ReceiptController@deleteReceipt');
Route::post('account/receipts/save-draft','ReceiptController@saveDraft');
Route::post('account/receipts/save-receipt','ReceiptController@saveReceipt');
Route::post('account/receipts/ajax-call','ReceiptController@ajaxCall');
/*Accounting Receipts Ends */

/*Accounting Post Date Cheque Starts */
Route::get('account/cheques','ChequeController@index');
Route::get('account/cheques/add','ChequeController@add');
Route::get('account/cheques/edit/{string}','ChequeController@edit');
Route::get('account/cheques/copy/{string}','ChequeController@copy');
Route::post('account/cheques/move-receipt/','ChequeController@moveReceipt');
Route::post('account/cheques/delete/','ChequeController@deleteCheque');
Route::post('account/cheques/save-cheque','ChequeController@saveCheque');
/*Accounting Post Date Cheque Ends */

Route::get('account/entries','AccountController@accountingEntries');
Route::get('account/income','AccountController@income');
Route::get('account/overhead','AccountController@expense');
Route::post('account/add-income','AccountController@addIncome');
Route::get('account/edit-income','AccountController@editIncome');

/* Expense request */
Route::get('account/expense','ExpenseController@index');
Route::get('account/expense/add','ExpenseController@addExpense');
Route::post('account/expense/add','ExpenseController@addExpense');
Route::get('account/expense/edit/{string}','ExpenseController@editExpense');
Route::post('account/expense/edit/{string}','ExpenseController@editExpense');
Route::get('account/expense/copy/{string}','ExpenseController@copyExpense');
Route::post('account/expense/copy/{string}','ExpenseController@copyExpense');
Route::post('account/expense/ajax-call','ExpenseController@ajaxCall');
//Route::get('account/edit-expense','ExpenseController@editExpense');


/* Expense payment request */
Route::get('account/payment/add','PaymentController@addPayment');
Route::post('account/payment/add','PaymentController@addPayment');
Route::get('account/payment/edit/{string}','PaymentController@editPayment');
Route::post('account/payment/edit/{string}','PaymentController@editPayment');
Route::get('account/payment','PaymentController@index');
Route::post('account/payment/ajax-call','PaymentController@ajaxCall');
Route::post('account/payment/copy/{string}','PaymentController@copyPayment');
Route::get('account/payment/copy/{string}','PaymentController@copyPayment');


/*Accounting Reports Starts */
Route::get('account/reports','AccountingReportsController@index');
Route::get('account/reports/trial-balance','AccountingReportsController@trialBalance');
Route::get('account/reports/general-ledger','AccountingReportsController@generalLedger');
Route::post('account/reports/general-ledger','AccountingReportsController@generalLedger');
Route::get('account/reports/account-transactions','AccountingReportsController@accountTransactions');
Route::post('account/reports/account-transactions','AccountingReportsController@accountTransactions');
Route::get('account/reports/income-statement','AccountingReportsController@incomeStatement');
Route::post('account/reports/income-statement','AccountingReportsController@incomeStatement');
Route::get('account/reports/balance-sheet','AccountingReportsController@balanceSheet');
Route::post('account/reports/balance-sheet','AccountingReportsController@balanceSheet');
Route::get('account/reports/sales-tax','AccountingReportsController@salesTax');
Route::post('account/reports/sales-tax','AccountingReportsController@salesTax');
Route::get('account/reports/bank-reconcilation','AccountingReportsController@bankReconcilation');
Route::post('account/reports/bank-reconcilation','AccountingReportsController@bankReconcilation');
Route::get('account/reports/receivable','AccountingReportsController@ReceivableReport');
Route::get('account/reports/receivable-payment-details','AccountingReportsController@getPaymentDetails');
Route::get('account/reports/payable','AccountingReportsController@payableReport');
Route::post('account/reports/payable','AccountingReportsController@payableReport');
Route::get('account/reports/payable-detail','AccountingReportsController@payableDetailReport');
/* pdf routes */
Route::get('account/reports/monthly-salary/pdf','ReportPdfController@MonthlySalaryPdf');
Route::get('account/reports/yearly-salary/pdf','ReportPdfController@YearlySalaryPdf');
Route::get('account/reports/payslip/pdf','ReportPdfController@PaySlipPdf');
Route::get('account/reports/bank/pdf','ReportPdfController@BankPdf');
Route::get('account/reports/cpf/pdf','ReportPdfController@CpfPdf');
Route::get('account/reports/incometax/pdf','ReportPdfController@incomeTaxPdf');
Route::get('account/reports/leave/pdf','ReportPdfController@LeaveSummaryPdf');
Route::get('account/reports/balancesheet/pdf','ReportPdfController@BalanceSheetPdf');
Route::get('account/reports/trialbalance/pdf','ReportPdfController@TrialBalancePdf');
Route::get('account/reports/accounts-trans/pdf','ReportPdfController@AccountTransPdf');
Route::get('account/reports/payable/pdf','ReportPdfController@PayablePdf');
Route::get('account/reports/incomestatement/pdf','ReportPdfController@IncomePdf');
Route::get('account/reports/generalledger/pdf','ReportPdfController@GeneralLedgerPdf');
Route::get('account/reports/bank-reconcilation/pdf','ReportPdfController@BankReconcilationPdf');
Route::get('account/reports/receivables/pdf','ReportPdfController@ReceivablesPdf');
Route::get('account/reports/salestax/pdf','ReportPdfController@SalesTaxPdf');
/* pdf routes end */


/*Accounting Reports Ends */

/* supplier request */
Route::get('supplier/supplier-list','SupplierController@supplierListing');
Route::get('supplier/add-supplier','SupplierController@addSupplier');
Route::get('supplier/add-supplier/{string}','SupplierController@addSupplier');
Route::post('supplier/add-supplier','SupplierController@addSupplier');
Route::get('supplier/edit-supplier/{string}','SupplierController@editSupplier');
Route::get('supplier/edit-supplier/{string1}/{string2}','SupplierController@editSupplier');
Route::post('supplier/edit-supplier/{string}','SupplierController@editSupplier');
Route::get('supplier/supplier-delete/{string}','SupplierController@deleteSupplier');


Route::get('leave/leave-type-list','HumanResourceController@leaveType');
Route::get('leave/add-leave-type','HumanResourceController@addLeaveType');
Route::post('leave/add-leave-type','HumanResourceController@addLeaveType');
Route::get('leave/edit-leave-type/{string}','HumanResourceController@editLeaveType');
Route::post('leave/edit-leave-type/{string}','HumanResourceController@editLeaveType');
Route::get('leave/delete-leave-type/{string}','HumanResourceController@deleteLeaveType');

Route::get('leave/add-leave-entitlement','HumanResourceController@allocateLeaveForJobTitle');
Route::post('leave/add-leave-entitlement','HumanResourceController@allocateLeaveForJobTitle');
Route::get('leave/entitled-leave-list','HumanResourceController@allocatedLeaveList');
Route::get('leave/applied','HumanResourceController@leaveAppliedListing');
Route::post('leave/applied','HumanResourceController@leaveAppliedListing');
Route::get('leave/apply-leave','HumanResourceController@applyLeave');
Route::post('leave/apply-leave','HumanResourceController@applyLeave');
Route::get('leave/leave-approval-list','HumanResourceController@leaveApprovalListing');
Route::get('leave/leave-approval-list/{string}','HumanResourceController@leaveApprovalListing');
Route::post('leave/leave-approval-list','HumanResourceController@leaveApprovalListing');
Route::get('leave/approval-type/{string1}/{string2}','HumanResourceController@leaveApprovalRow');
Route::post('hrm/ajax-call','HumanResourceController@ajaxCall');


/* Confiuration Panel */
Route::get('config/configure-panel','ConfigureController@configPanel');
/* Configuration Panel end */

/* Company Config */
Route::get('branch/branch-list','CompanyController@branchListing');
Route::get('branch/add-branch','CompanyController@addBranch');
Route::post('branch/add-branch','CompanyController@addBranch');
Route::get('branch/edit-branch/{string}','CompanyController@editBranch');
Route::post('branch/edit-branch/{string}','CompanyController@editBranch');
Route::get('branch/delete-branch/{string}','CompanyController@deleteBranch');
Route::get('calendar/add-calendar','CompanyController@addCalendarConfig');
Route::post('calendar/add-calendar','CompanyController@addCalendarConfig');
Route::get('calendar/edit-calendar/{string}','CompanyController@editCalendarConfig');
Route::post('calendar/edit-calendar/{string}','CompanyController@editCalendarConfig');
Route::get('calendar/calendar-list','CompanyController@calendarList');
Route::get('calendar/delete-calendar/{string}','CompanyController@deleteCalendar');
Route::get('calendar/view-calendar/{string}','CompanyController@viewcalendar');
Route::get('calendar/assign-alt-holiday','CompanyController@assignAltHolidaycalendar');
Route::post('calendar/assign-alt-holiday','CompanyController@assignAltHolidaycalendar');
Route::get('calendar/assign-alt-holiday-list','CompanyController@assignedCalendarList');
Route::get('calendar/edit-assign-alt-holiday/{string}','CompanyController@editAssignAltHoliday');
Route::post('calendar/edit-assign-alt-holiday/{string}','CompanyController@editAssignAltHoliday');
Route::get('calendar/delete-assigned-holiday/{string}','CompanyController@deleteAssignHoliday');
//Route::post('calendar/assign-alt-holiday','CompanyController@assignAltHolidaycalendar');

/*customer customer Controller */
Route::get('customer/customer-listing','CustomerController@getCustomerList');
Route::get('customer/add-customer','CustomerController@addCustomer');
Route::post('customer/add-customer','CustomerController@addCustomer');
Route::get('customer/edit-customer/{string}','CustomerController@editCustomer');
Route::post('customer/edit-customer/{string}','CustomerController@editCustomer');
Route::get('customer/view-customer/{string}','CustomerController@viewCustomer');
Route::get('customer/delete-customer/{string}','CustomerController@deleteCustomer');

/* payroll process Controller */
Route::get('payroll/calculate-net-pay/{string}','PayRollController@calculateEmpNetPaySalary');
Route::get('payroll/process-salary','PayRollController@processSalary');
Route::post('payroll/calculate-salary-process','PayRollController@calculateEmpSalary');
Route::get('payroll/processed-employee-salary-list','PayRollController@processedEmpListing');
Route::get('payroll/salary-process-for-approval-list','PayRollController@salaryApprovalListing');
Route::get('payroll/edit-processed-salary/{string}','PayRollController@editSalaryProcess');
Route::get('payroll/reprocess-salary','PayRollController@reProcesEmpSalary');
Route::post('payroll/recalculate-process','PayRollController@recalculateSalary');
Route::post('payroll/ajax-call','PayRollController@ajaxCall');
Route::get('payroll/delete-salary/{string1}/{string2}/{string3}','PayRollController@deleteProcessedSalary');
/* payroll process end */


/* print transcation */
 Route::get('account/receipt/print-receipt/{string}','ReceiptController@printReceipt');
 Route::get('account/payment/print_payment/{id}','PaymentController@printPayment');
 Route::get('account/journal/print-journal/{id}','JournalController@printJournal');

/* end print transcation */
/* end customer Controller */
/*Route::get('mailTest',function(){
$data = array('mail_box' => 'fffffff');
Mail::queue('emails.contact_customer', $data, function($message)
{
    $message->from('samkrish07@gmail.com', 'Laravel');

    $message->to('sam07krish87@gmail.com', 'John Smith')->subject('Welcome!');
});
    
});*/
/* End Company Config */

/*Accounting Module Ends*/

/*Route::get('pdf_file', function()
{
    $html = '<html><body>'
            . '<p>Put your html here, or generate it with your favourite '
            . 'templating system.</p>'
            . '</body></html>';
    return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
});*/
/* system user end */
//update by ganeshbabu on 30-Jun-2014(start)
Route::get('approval/contract-payment-approval','HumanResourceController@CashApproval');
Route::get('cash-approval/approval/{id}','HumanResourceController@CashApprovalById');
Route::get('cash-approval/reject/{id}','HumanResourceController@CashRejectById');
//update by ganeshbabu on 30-Jun-2014(end)


/* Reports Module Starts */
Route::get('reports/leave','ReportsController@leave');
Route::post('reports/leave','ReportsController@leave');
Route::post('reports/leave','ReportsController@leave');
Route::get('reports/leave-print/','ReportsController@leavePdf');
Route::post('reports/leave-print/','ReportsController@leavePdf');
Route::get('reports/monthly-salary','ReportsController@monthlySalary');
Route::post('reports/monthly-salary','ReportsController@monthlySalary');
Route::get('reports/yearly','ReportsController@yearly');
Route::post('reports/yearly','ReportsController@yearly');
Route::get('reports/payslip','ReportsController@payslip');
Route::post('reports/payslip','ReportsController@payslip');
Route::get('reports/payslip-print/','ReportsController@payslipPrint');
Route::post('generate/pay-slip/','ReportsController@payslipGenerate');
Route::post('generate/pay-slip-all','ReportsController@generatePaySlipAll');
Route::get('reports/leave/{string}/{string1}/{string2}','ReportsController@leaveEmployee');
Route::get('reports/leave-summary','ReportsController@leaveSummaryReport');
Route::post('reports/leave-summary','ReportsController@leaveSummaryReport');
Route::get('reports/bank','ReportsController@bank');
Route::post('reports/bank','ReportsController@bank');
Route::get('reports/cpf','ReportsController@cpf');
Route::post('reports/cpf','ReportsController@cpf');
Route::get('reports/income','ReportsController@incomeTax');
Route::post('reports/income','ReportsController@incomeTax');
Route::get('reports/sales-tracking','ReportsController@salesTrackingReport');
Route::post('reports/sales-tracking','ReportsController@salesTrackingReport');

/* Reimbursement Configuration */
Route::get('reimburse/add','ReimbursementController@addReimburse');
Route::post('reimburse/add','ReimbursementController@addReimburse');
Route::post('reimburse/edit/{id}','ReimbursementController@editReimburse');
Route::get('reimburse/edit/{id}','ReimbursementController@editReimburse');
Route::get('reimburse/delete/{id}','ReimbursementController@deleteReimburse');
Route::get('reimburse','ReimbursementController@index');
Route::get('reimburse/add-item','ReimbursementController@postReimburseDtls');
Route::post('reimburse/add-item','ReimbursementController@postReimburseDtls');
Route::get('reimburse/add-item/{id}','ReimbursementController@postReimburseDtls');
Route::post('reimburse/add-item/{id}','ReimbursementController@postReimburseDtls');
Route::get('reimburse/edit-item/{id}/{gid}','ReimbursementController@editReimburseDtls');
Route::post('reimburse/edit-item/{id}/{gid}','ReimbursementController@editReimburseDtls');
Route::get('reimburse/submission-summary','ReimbursementController@SubmissionSummary');
Route::get('reimburse/add-reimbure-item-list','ReimbursementController@addReimburseItemList');
Route::get('reimburse/add-reimbure-item-list/{id}','ReimbursementController@addReimburseItemList');
Route::get('reimburse/change-ritem-status/{id}/{status}','ReimbursementController@changeReimburseStatus');
Route::get('reimburse/delete-item/{id}/{gId}','ReimbursementController@deleteItemEntry');
Route::get('reimburse/applied-summary','ReimbursementController@userAppliedSummary');
Route::get('reimburse/applied-item-summary/{id}','ReimbursementController@ReimburseItemAppliedList');
Route::post('reimburse/check-commission','ReimbursementController@checkCommission');
Route::get('reimburse/approve-reimbure-item/{id}','ReimbursementController@reimburseApproveProcess');
Route::get('reimburse/cheque-issue/{id}','ReimbursementController@reimburseChequeIssueProcess');
Route::post('reimburse/cheque-issue/{id}','ReimbursementController@reimburseChequeIssueProcess');
Route::get('reimburse/print-items/{id}','ReimbursementController@printReimburseItem');
Route::get('reimburse/reject/{id}','ReimbursementController@ReimbursementReject');

/* Reimbursement Configuration end */

Route::get('get-lead-scrab','WebScraperController@getIndex');

//Route::get('reports/leave-print/{string1}/','ReportsController@leavePdf');

//Reports
Route::get('reports/streport','SalesTaxReportController@index');

//
 
 