<?php
class EmployeeController extends BaseController {

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
        public function __construct(SystemUser $sysUser) {
            $this->sysUser = $sysUser;
            if(Session::has('id')) {
                $this->id = Session::get('id');
            } else {
                $this->beforeFilter(function(){
                    return Redirect::to('login');
                });
            }
            $this->martial      =   Config::get('local.MartialStatus');
            $this->avail        =   Config::get('local.availStatus');
            $this->resStatus    =   Config::get('local.resultStatus');
            $this->branchlist   =   Config::get('local.branchlist');
            $userType           =   DB::table('il_user_type')->select('id','user_type')->get();
             if(!empty($userType)) {
                foreach($userType as $user) {
                    $userRole[$user->id] = $user->user_type;
                }
                $this->userType = $userRole;    
            }
        }
        
        
        public function index() {
            $postData = Input::all();
            $br = 0;
            $cd = 0;
            $resultList = DB::table('il_emp_details as ed')->leftJoin('il_emp_job_info as ej','ej.fkEmpId','=','ed.id')->leftJoin('il_job_title as ij','ej.job_title','=','ij.id')
                        ->leftJoin('il_cessation as ic','ej.cessation_code','=','ic.id')->leftJoin('il_branch as ib','ej.fkBranchId','=','ib.id')
                        ->select(array('ed.id','ej.employee_id','ed.emp_name','ed.email_id','ed.user_role','ed.dateCreated','ej.employee_id','ib.branch_name',
                        'ij.job_title','ic.cessation_code','ej.cessation_date','ej.hire_date'))->where('is_active',1)->orderBy('ed.user_role','asc')->orderBy('ed.id','desc')->orderBy('ej.cessation_code','asc');
            if(!empty($postData)) {
                $br    =  Input::get('branch');
                $cd    =  Input::get('cessation');
                if($br!=0) {
                    $resultList   = $resultList->where('ej.fkBranchId',$br);
                }
                if($cd!=0) {
                    $resultList   = $resultList->where('ej.cessation_code',$cd);
                }
            } else {
                $br = 0;
                $cd = 0;
            }
            $branches   = DB::table('il_branch')->get();
            $cessation  = DB::table('il_cessation')->get();
            $results    = $resultList->get();
           /* $resultList = DB::table('il_emp_details as ed')->join('il_emp_job_info as ej','ej.fkEmpId','=','ed.id')->join('il_job_title as ij','ej.job_title','=','ij.id')
                        ->leftJoin('il_cessation as ic','ej.cessation_code','=','ic.id')->leftJoin('il_branch as ib','ej.fkBranchId','=','ib.id')
                        ->select(array('ed.id','ej.employee_id','ed.emp_name','ed.email_id','ed.user_role','ed.dateCreated','ej.employee_id','ib.branch_name',
                        'ij.job_title','ic.cessation_code','ej.cessation_date','ej.hire_date'))->where('is_active',1)->OrderBy('id','desc')->get();*/
            return View::make('EmployeeManager.employeeListing')->with(array('sysList' => $results,'br' => $br,'cd' => $cd,'cessation' => $cessation,'branches' => $branches,'userType' => $this->userType));
        }
        
        public function create() {
            /* get job title from db contract array */
            $getJobTitle = DB::table('il_job_title')/*->join('il_pay_grade','il_pay_grade.fkJobTitleId','=','il_job_title.id')*/->select('il_job_title.id','il_job_title.job_title')->get();
            if(!empty($getJobTitle)) {
                foreach($getJobTitle as $getJob) {
                    $jobTitle[$getJob->id] = $getJob->job_title;
                }
                $this->jobTitle = $jobTitle;    
            }
            /* end job title */
            /* get branch list */
            $branchList = DB::table('il_branch')->select('id','branch_name')->get();
            if(!empty($branchList)) {
                foreach($branchList as $blist) {
                    $branchArray[$blist->id] = $blist->branch_name;
                }
            }
            /* end branch list */
            /* get residential status */
            $residentialArray = array();
            $residentialStatus = DB::table('il_residential_status')->select('id','residential_status')->get();
            if(!empty($residentialStatus)) {
                foreach($residentialStatus as $residential) {
                    $residentialArray[$residential->id] = $residential->residential_status;
                }
            }
             /* end residential status */
            /* get race */
            $raceArray = array();
            $raceList = DB::table('il_race')->select('id','race')->get();
            if(!empty($raceList)) {
                foreach($raceList as $race) {
                    $raceArray[$race->id] = $race->race;
                }
            }
             /* end race */
             /* get calendar list */
            $calendarArray = array();
            $calendarList = DB::table('il_calendar_config')->select('id','cal_name')->get();
            if(!empty($calendarList)) {
                foreach($calendarList as $calendar) {
                    $calendarArray[$calendar->id] = $calendar->cal_name;
                }
            }
             /* end calendar list */
              /* get nationality list */
             $nationalityArray    = array();
             $nationalityList = DB::table('il_nationality')->select('id','nationality_name')->get();
            if(!empty($nationalityList)) {
                foreach($nationalityList as $nation) {
                    $nationalityArray[$nation->id] = $nation->nationality_name;
                }
            }
             /* end nationality list */
             /* get pob list */
             $pobArray    = array();
             $pobList = DB::table('il_pob')->select('id','place_of_birth')->get();
            if(!empty($pobList)) {
                foreach($pobList as $place) {
                    $pobArray[$place->id] = $place->place_of_birth;
                }
            }
             /* end pob list */
             /* get cessation list */
             $cessationArray    = array();
             $cessationList = DB::table('il_cessation')->select('id','cessation_code')->get();
            if(!empty($cessationList)) {
                foreach($cessationList as $cess) {
                    $cessationArray[$cess->id] = $cess->cessation_code;
                }
            }
             /* end cessation list */
             /* get martial status list */
             $martialArray    = array();
             $martial_status = DB::table('il_martial_status')->select('id','martial_status')->get();
            if(!empty($martial_status)) {
                foreach($martial_status as $martial) {
                    $martialArray[$martial->id] = $martial->martial_status;
                }
            }
             /* end martial status list */
             /* get category list */
             $categoryArray    = array();
             $category         = DB::table('il_category')->select('id','category_name')->get();
            if(!empty($category)) {
                foreach($category as $cat) {
                    $categoryArray[$cat->id] = $cat->category_name;
                }
            }
             /* end category list */
            return View::make('EmployeeManager.addEmployee')->with('userType',$this->userType)->with(array('jobList' => $this->jobTitle,'residential' => $residentialArray,'race' => $raceArray,'branchList' => $branchArray,'calendar' => $calendarArray,'nationality' => $nationalityArray,'countries' => $pobArray,'cessationCode' => $cessationArray,'martialStatus' => $martialArray,'category' => $categoryArray));
        }
        
        public function store(){
            /*$nric_no           = Input::get('nric_no');
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_info where nric_fin_no ="'.$nric_no.'"'));
            if($checkStatus[0]->emp_count == 0) {
            */ 
                /*echo '<pre>'; print_r(Input::all()); echo '</pre>'; die();*/

               $this->sysUser->emp_name     = Input::get('employee_name');
                $this->sysUser->user_role    = Input::get('user_type');
                $this->sysUser->email_id     = Input::get('email_id');
                if(Input::get('user_type') == '1' || Input::get('user_type') == '2' || Input::get('user_type') == '3') {
                   $this->sysUser->password     = md5(Input::get('password'));
                } 
                $this->sysUser->dateCreated  = date('Y-m-d h:i:s',strtotime('now'));
                if($this->sysUser->save()) {
                    $insertedId = $this->sysUser->id;

                 $emp_name          = Input::get('employee_name');
                 $email_id          = Input::get('email_id');
                 $nric_type         = Input::get('nric_type');
                 $nric_no           = Input::get('nric_no');
                 $nationality       = Input::get('nationality');
                 $cob               = Input::get('cob');
                 $fkresidential_status = Input::get('residential_status');
                 $fkrace            = Input::get('race');
                 $age               = Input::get('age');
                 $gender            = Input::get('gender');
                 $date_birth        = Input::get('date_birth');
                 $date_birth        = date('Y-m-d',strtotime(Input::get('date_birth')));
                 $address_type      = Input::get('address_type');
                 $block_hse         = Input::get('block_hse');
                 $street_name       = Input::get('street_name');
                 $level             = Input::get('level');
                 $unit_no           = Input::get('unit_no');
                 $city              = Input::get('city');
                 $state             = Input::get('state');
                 $country           = Input::get('country');
                 $telephone         = Input::get('telephone_no');
                 $mobile            = Input::get('mobile_no');
                 $marital_status    = Input::get('martial_status');
		 $mom_reg_no	    = Input::get('mom_reg_no');

                 $uStatus =  DB::table('il_emp_info')->insert(array('fkEmpId' => $insertedId,'nric_fin_type' => $nric_type,
                                 'nric_fin_no' => $nric_no,'nationality' => $nationality,'cob' => $cob,
                                 'fkresidential_status' => $fkresidential_status,'fkrace' => $fkrace,'address_type' => $address_type,
                                 'age' => $age,'gender' => $gender,'date_of_birth' => $date_birth,
                                 'marital_status' => $marital_status,'block_hse_no' => $block_hse,'street_name' => $street_name,
                                 'level' => $level,'unit_no' => $unit_no,'telephone' => $telephone,
                                 'city' => $city,'state' => $state,'country' => $country,'mobile' => $mobile));

                $jobTitle     =   Input::get('job_title');
               // $hireDate     =   Input::get('hire_date');
                $hireDate        = date('Y-m-d',strtotime(trim(Input::get('hire_date'))));
                $category     =   Input::get('category');
                $branch       =   Input::get('branch');
                $probation_period  =   Input::get('probation_period');
                
                $confirmed_date    = '';
                $confirm_date    =   Input::get('confirmed_date');
                if($confirm_date!='') {
                    $confirmed_date        = date('Y-m-d',strtotime(trim(Input::get('confirmed_date'))));
                }
                $cessation_code    =   Input::get('cessation_code');
                /*$cessation_date    =   Input::get('cessation_date');
                if(!empty($cessation_date)) {
                 $cessation_date        = date('Y-m-d',strtotime(trim(Input::get('cessation_date'))));
                }*/
                
                $cessation_date  = Input::has('cessation_date') ? date('Y-m-d',strtotime(trim(Input::get('cessation_date')))) : '';
                $calendar     =   Input::get('calendar');
                $basicWage    =   Input::get('basic_wage');
                $commission   =   Input::get('commission');
                $employee_cpf_rate   =   Input::get('employee_cpf_rate');
                $employer_cpf_rate    =   Input::get('employer_cpf_rate');
                $levy         =   Input::get('levy');
                $bank_branch  =   Input::get('bank');
                $account_no   =   Input::get('account_no');
                $employee_id  = "E_".$insertedId;

                $insertStatus = DB::table('il_emp_job_info')->insert(array('fkEmpId' => $insertedId,'employee_id' => $employee_id,'job_title' => $jobTitle,
                                    'hire_date' => $hireDate,'fkBranchId' => $branch,'category' => $category,
                                    'probation_period' => $probation_period,'confirm_date' => $confirmed_date,
                                    'cessation_code' => $cessation_code,'cessation_date' => $cessation_date,
                                    'calendar' => $calendar,'basic_wage' => $basicWage,'cutoff' => $commission,
                                    'employee_cpf_rate'=> $employee_cpf_rate,'employer_cpf_rate'=> $employer_cpf_rate,
                                    'levy' => $levy,'bank_branch' => $bank_branch,'account_no' => $account_no,'mom_reg_no'=>$mom_reg_no));

                    return Redirect::to('employee/view-employee-profile/'.$insertedId)->with('successalert','Employee Added Successfully');
                } else 
                    return Redirect::to('employee/create')->with('erroralert','Sorry!!! Server problem try again.');
            /*} else {
                return Redirect::to('employee/create')->with('erroralert','NRIC/FIN No already exists');
            }*/
        }
        
        public function edit($id){
             $userId =  $id;
             $id  = base64_decode($id);
             $resultList = $this->sysUser->select(array('id','emp_name','email_id','password','user_role'))->where('is_active',1)->where('id',$id)->first();
             return View::make('EmployeeManager.editEmployee')->with(array('sysList' => $resultList,'id' => $userId));
        }
        
      
        /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 *
        public function show($id) {
            /*
                    $getJobTitle = DB::table('il_job_title')->select('id','job_title')->get();
            if(!empty($getJobTitle)) {
                foreach($getJobTitle as $getJob) {
                    $jobTitle[$getJob->id] = $getJob->job_title;
                }
                $this->jobTitle = $jobTitle;    
            }
             * 
            
            $id          = base64_decode($id);
            $showuser    = SystemUser::select(array('id','name','username','user_role','dateCreated'))
                            ->where('id','=',$id)
                            ->first();
            return View::make('systemUser.viewSystemUser')->with(array('showuser' => $showuser,'id' => $id));
            
        }
       /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 *
        
        public function update($id) {
            $uid = $id;
            $id = base64_decode($id);
            $sysUser               = $this->sysUser->find($id);
            $sysUser->emp_name     = Input::get('name');
            $sysUser->user_role    = Input::get('user_type');
            $sysUser->username     = Input::get('username');
            if(Input::has('password')) {
                $sysUser->password     = md5(Input::get('password'));
            }
            $sysUser->dateModified = date('Y-m-d h:i:s',strtotime('now'));
            if($sysUser->save()) {
                return Redirect::to('system-user')->with('successalert','User Added Successfully');
            } else 
                return Redirect::to('system-user/'.$uid.'/edit')->with('erroralert','Sorry!!! Server problem try again.');
       }
        
        /**
	 * Show delete specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
        public function destroy($id) {
            $id   = base64_decode($id);
            $sys = $this->sysUser->find($id);
            $sys->is_active         = 0;
            if($sys->save()) {
                return Redirect::to('employee')->with('successalert','Employee Deleted Successfully');
            } else {
                return Redirect::to('employee')->with('erroralert','Sorry server problem... Try again');
            }
            
        }
        
        
        /**
         * View user infomation
         */
        public function viewEmployeeInfo() {
            /* get job title from db contract array */
            $getJobTitle = DB::table('il_job_title')/*->join('il_pay_grade','il_pay_grade.fkJobTitleId','=','il_job_title.id')*/->select('il_job_title.id','il_job_title.job_title')->get();
            if(!empty($getJobTitle)) {
                foreach($getJobTitle as $getJob) {
                    $jobTitle[$getJob->id] = $getJob->job_title;
                }
                $this->jobTitle = $jobTitle;    
            }
            /* end job title */
            /* get branch list */
            $branchList = DB::table('il_branch')->select('id','branch_name')->get();
            if(!empty($branchList)) {
                foreach($branchList as $blist) {
                    $branchArray[$blist->id] = $blist->branch_name;
                }
            }
            /* end branch list */
            /* get residential status */
            $residentialArray = array();
            $residentialStatus = DB::table('il_residential_status')->select('id','residential_status')->get();
            if(!empty($residentialStatus)) {
                foreach($residentialStatus as $residential) {
                    $residentialArray[$residential->id] = $residential->residential_status;
                }
            }
             /* end residential status */
            /* get race */
            $raceArray = array();
            $raceList = DB::table('il_race')->select('id','race')->get();
            if(!empty($raceList)) {
                foreach($raceList as $race) {
                    $raceArray[$race->id] = $race->race;
                }
            }
             /* end race */
             /* get calendar list */
            $calendarArray = array();
            $calendarList = DB::table('il_calendar_config')->select('id','cal_name')->get();
            if(!empty($calendarList)) {
                foreach($calendarList as $calendar) {
                    $calendarArray[$calendar->id] = $calendar->cal_name;
                }
            }
             /* end calendar list */
                /* get nationality list */
             $nationalityArray    = array();
             $nationalityList = DB::table('il_nationality')->select('id','nationality_name')->get();
            if(!empty($nationalityList)) {
                foreach($nationalityList as $nation) {
                    $nationalityArray[$nation->id] = $nation->nationality_name;
                }
            }
             /* end nationality list */
             /* get pob list */
             $pobArray    = array();
             $pobList = DB::table('il_pob')->select('id','place_of_birth')->get();
            if(!empty($pobList)) {
                foreach($pobList as $place) {
                    $pobArray[$place->id] = $place->place_of_birth;
                }
            }
             /* end pob list */
             /* get cessation list */
             $cessationArray    = array();
             $cessationList = DB::table('il_cessation')->select('id','cessation_code')->get();
            if(!empty($cessationList)) {
                foreach($cessationList as $cess) {
                    $cessationArray[$cess->id] = $cess->cessation_code;
                }
            }
             /* end cessation list */
             /* get martial status list */
             $martialArray    = array();
             $martial_status = DB::table('il_martial_status')->select('id','martial_status')->get();
            if(!empty($martial_status)) {
                foreach($martial_status as $martial) {
                    $martialArray[$martial->id] = $martial->martial_status;
                }
            }
             /* end martial status list */
             /* get category list */
             $categoryArray    = array();
             $category         = DB::table('il_category')->select('id','category_name')->get();
            if(!empty($category)) {
                foreach($category as $cat) {
                    $categoryArray[$cat->id] = $cat->category_name;
                }
            }
             /* end category list */
            $empId = Request::Segment(3);
            $result = DB::table('il_emp_details')->leftJoin('il_emp_info','il_emp_info.fkEmpId','=','il_emp_details.id')->leftJoin('il_emp_job_info','il_emp_job_info.fkEmpId','=','il_emp_details.id')->leftJoin('il_pay_grade','il_pay_grade.fkJobTitleId','=','il_emp_job_info.job_title')->select(array('il_emp_details.*','il_emp_info.*','il_emp_job_info.*','il_pay_grade.*'))->where('il_emp_details.id',$empId)->first();
            return View::make('EmployeeManager.viewEmployeeProfile')->with(array('empId' => $empId,'jobList' => $this->jobTitle,'residential' => $residentialArray,'race' => $raceArray,'branchList' => $branchArray,'calendar' => $calendarArray,'vEmp' => $result,'nationality' => $nationalityArray,'countries' => $pobArray,'cessationCode' => $cessationArray,'martialStatus' => $martialArray,'category' => $categoryArray,'userType' => $this->userType));
        }
        
        public function addEmployeeInfo() {
             $empId = Request::Segment(3);
            // echo '<pre>'; print_r(Input::all()); echo '</pre>'; die();
             $emp_name          = Input::get('employee_name');
             $email_id          = Input::get('email_id');
             $user_role         = Input::get('user_type');
             $nric_type         = Input::get('nric_type');
             $nric_no           = Input::get('nric_no');
             $nationality       = Input::get('nationality');
             $cob               = Input::get('cob');
             $fkresidential_status = Input::get('residential_status');
             $fkrace            = Input::get('race');
             $age               = Input::get('age');
             $gender            = Input::get('gender');
             $date_birth        = Input::get('date_birth');
             $date_birth        = date('Y-m-d',strtotime(Input::get('date_birth')));
             $address_type      = Input::get('address_type');
             $block_hse         = Input::get('block_hse');
             $street_name       = Input::get('street_name');
             $level             = Input::get('level');
             $unit_no           = Input::get('unit_no');
             $city              = Input::get('city');
             $state             = Input::get('state');
             $country           = Input::get('country');
             $telephone         = Input::get('telephone_no');
             $mobile            = Input::get('mobile_no');
             $marital_status    = Input::get('martial_status');			
             $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_info where fkEmpId ='.$empId));
             DB::table('il_emp_details')->where('id',$empId)->update(array('emp_name' => $emp_name ,'email_id' => $email_id,'user_role' => $user_role));
             if($checkStatus[0]->emp_count == 0) {
                 $uStatus =  DB::table('il_emp_info')->insert(array('fkEmpId' => $empId,'nric_fin_type' => $nric_type,
                             'nric_fin_no' => $nric_no,'nationality' => $nationality,'cob' => $cob,
                             'fkresidential_status' => $fkresidential_status,'fkrace' => $fkrace,'address_type' => $address_type,
                             'age' => $age,'gender' => $gender,'date_of_birth' => $date_birth,
                             'marital_status' => $marital_status,'block_hse_no' => $block_hse,'street_name' => $street_name,
                             'level' => $level,'unit_no' => $unit_no,'telephone' => $telephone,
                             'city' => $city,'state' => $state,'country' => $country,'mobile' => $mobile));
                 if($uStatus)
                     return Redirect::to('employee/view-employee-profile/'.$empId)->with('successalert','Personal Infomation updated Successfully');
             } else {
                  $uStatus = DB::table('il_emp_info')->where('fkEmpId',$empId)->update(array('fkEmpId' => $empId,'nric_fin_type' => $nric_type,
                             'nric_fin_no' => $nric_no,'nationality' => $nationality,'cob' => $cob,
                             'fkresidential_status' => $fkresidential_status,'fkrace' => $fkrace,'address_type' => $address_type,
                             'age' => $age,'gender' => $gender,'date_of_birth' => $date_birth,
                             'marital_status' => $marital_status,'block_hse_no' => $block_hse,'street_name' => $street_name,
                             'level' => $level,'unit_no' => $unit_no,'telephone' => $telephone,
                             'city' => $city,'state' => $state,'country' => $country,'mobile' => $mobile,'dateModified' => date('Y-m-d h:i:s',strtotime('now'))));
                  return Redirect::to('employee/view-employee-profile/'.$empId)->with('successalert','Personal Infomation updated Successfully');
             }
			 
        }
        
        public function addEmployeeJob(){
            $empId = Request::Segment(3);
            //echo '<pre>'; print_r(Input::all()); echo '</pre>'; die();
            $employeeId   =   Input::get('employee_id');
            $jobTitle     =   Input::get('job_title');
           // $hireDate     =   Input::get('hire_date');
            $hireDate        = date('Y-m-d',strtotime(trim(Input::get('hire_date'))));
            $category     =   Input::get('category');
            $branch       =   Input::get('branch');
            $probation_period  =   Input::get('probation_period');
           // $confirmed_date    =   Input::get('confirmed_date');
            $confirmed_date        = date('Y-m-d',strtotime(trim(Input::get('confirmed_date'))));
            $cessation_code    =   Input::get('cessation_code');
            //$cessation_date    =   Input::get('cessation_date');
            $cessation_date        = Input::has('cessation_date') ? date('Y-m-d',strtotime(trim(Input::get('cessation_date')))) : '';
            $calendar     =   Input::get('calendar');
            $basicWage    =   Input::get('basic_wage');
            $commission   =   Input::get('commission');
            $employee_cpf_rate   =   Input::get('employee_cpf_rate');
            $employer_cpf_rate    =   Input::get('employer_cpf_rate');
            $levy         =   Input::get('levy');
            $bank_branch  =   Input::get('bank');
            $account_no   =   Input::get('account_no');
			$mom_reg_no		= Input::get('mom_reg_no');
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_job_info where fkEmpId ='.$empId));
            if($checkStatus[0]->emp_count == 0) {
                $insertStatus = DB::table('il_emp_job_info')->insert(array('fkEmpId' => $empId,'job_title' => $jobTitle,
                                'hire_date' => $hireDate,'fkBranchId' => $branch,'category' => $category,'employee_id' => $employeeId,
                                'probation_period' => $probation_period,'confirm_date' => $confirmed_date,
                                'cessation_code' => $cessation_code,'cessation_date' => $cessation_date,
                                'calendar' => $calendar,'basic_wage' => $basicWage,'cutoff' => $commission,
                                'employee_cpf_rate'=> $employee_cpf_rate,'employer_cpf_rate'=> $employer_cpf_rate,
                                'levy' => $levy,'bank_branch' => $bank_branch,'account_no' => $account_no,'mom_reg_no'=>$mom_reg_no));
                if($insertStatus)
                   return Redirect::to('employee/view-employee-profile/'.$empId)->with('successalert','Job Infomation updated Successfully');
            } else {
                $uStatus = DB::table('il_emp_job_info')->where('fkEmpId',$empId)->update(array('fkEmpId' => $empId,'job_title' => $jobTitle,
                                'hire_date' => $hireDate,'fkBranchId' => $branch,'category' => $category,'employee_id' => $employeeId,
                                'probation_period' => $probation_period,'confirm_date' => $confirmed_date,
                                'cessation_code' => $cessation_code,'cessation_date' => $cessation_date,
                                'calendar' => $calendar,'basic_wage' => $basicWage,'cutoff' => $commission,
                                'employee_cpf_rate'=> $employee_cpf_rate,'employer_cpf_rate'=> $employer_cpf_rate,
                                'levy' => $levy,'bank_branch' => $bank_branch,'account_no' => $account_no,'mom_reg_no'=>$mom_reg_no,'dateModified' => date('Y-m-d h:i:s',strtotime('now'))));
                return Redirect::to('employee/view-employee-profile/'.$empId)->with('successalert','Job Infomation updated Successfully');
            } 
        }

        public function addJobTitle() {
            /* get job title from db contract array */
            $jobQuery = DB::table('il_job_title')->select('id','job_title')->get();    
            //return $jobQuery;        
            return View::make('EmployeeManager.addJobTitle')->with(array('jobTitleList' => $jobQuery));
        }

        public function insertJobTitle(){
            $jobTitle   = Input::get('job_title');
            $jobQuery = DB::table('il_job_title')->select('id')->where('job_title',$jobTitle)->first();
            if(isset($jobQuery)) {
                return Redirect::to('config/designation/')->with(array('erroralert' => 'Designation  '.$jobTitle.' already exists. '));
            } else {          
                $insert = DB::table('il_job_title')->insert(array('job_title' => $jobTitle));
                if($insert) {
                    return Redirect::to('config/designation')->with('successalert','Designation added successfully');
                }
            }
        }
        
        public function addPayGrade() {
            /* get job title from db contract array */
            $jobQuery = DB::table('il_job_title')->select('id','job_title');
            $getPayGradeList = DB::table('il_job_title')->join('il_pay_grade','il_job_title.id','=','il_pay_grade.fkJobTitleId')->select('il_job_title.id','il_job_title.job_title','il_pay_grade.min_salary','il_pay_grade.max_salary')->get();
            if(!empty($getPayGradeList)) {
                foreach($getPayGradeList as $list) {
                  $jobIds[] = $list->id;  
                }
               $jobQuery->whereNotIn('id', $jobIds);
            }
            $getJobTitle = $jobQuery->get();
            if(!empty($getJobTitle)) {
                foreach($getJobTitle as $getJob) {
                    $jobTitle[$getJob->id] = $getJob->job_title;
                }
                $this->jobTitle = $jobTitle;    
            }
            /* end job title */
            return View::make('EmployeeManager.addPayGrade')->with(array('jobTitle' => $this->jobTitle,'payGradeList' => $getPayGradeList));
        }        
        
        public function editPayGrade(){
            $jobId  =   Request::Segment(2);
            $getPayGradeList = DB::table('il_job_title')->join('il_pay_grade','il_job_title.id','=','il_pay_grade.fkJobTitleId')->select('il_job_title.id','il_job_title.job_title','il_pay_grade.min_salary','il_pay_grade.max_salary')->where('il_job_title.id',$jobId)->first();
            return View::make('EmployeeManager.editPayGrade')->with(array('gradeView' => $getPayGradeList,'jobTitleId' => $jobId));
            
        }
        public function insertPayGrade(){
            $jobTitle   = Input::get('job_title');
            $min_salary = Input::get('min_salary');
            $max_salary = Input::get('max_salary');
            $insert = DB::table('il_pay_grade')->insert(array('fkJobTitleId' => $jobTitle,'min_salary' => $min_salary,'max_salary' => $max_salary));
            if($insert) {
                return Redirect::to('pay-grade')->with('successalert','Pay Grade Updated Successfully');
            }
            
        }
       
        public function updatePayGrade() {
            $jobId      = Input::get('job_id');
            $min_salary = Input::get('min_salary');
            $max_salary = Input::get('max_salary');
            $uStatus    = DB::table('il_pay_grade')->where('fkJobTitleId',$jobId)->update(array('min_salary' => $min_salary,'max_salary' => $max_salary));
            if($uStatus)
                return Redirect::to('pay-grade')->with('successalert','Pay Grade Updated Successfully');
            else
                return Redirect::to('pay-grade')->with('erroralert','Pay Grade not update');
        }
        
        public function deletePayGrade() {
            $id = Request::Segment(2);
            $status  = DB::table('il_pay_grade')->where('id',$id)->delete();
            if($status)
                return Redirect::to('pay-grade')->with('successalert','Pay Grade Delete Successfully');
            else
                return Redirect::to('pay-grade')->with('erroralert','Pay Grade not delete,try again');

        }   

        /*
         * Purpose : View Residential
         * Return  : array value
         */
        public function residentialStatus() {
            $residentialStatus  = DB::table('il_residential_status')->select('id','residential_status')->orderby('id')->get();
            return View::make('EmployeeManager.residentialStatus')->with(array('residentialStatus' => $residentialStatus));
        }


                /*
         * Purpose : Add Residential
         * Return   boolean value
         */
        public function addresidentialStatus(){
            $postData = Input::all();
            if(!empty($postData)) {
                $name = Input::get('name');
                $insert = DB::table('il_residential_status')->insert(array('residential_status' => $name));
                if($insert)
                    return Redirect::to('employee/config/residential-status')->with(array('successalert' => 'Residential Status added Successfully'));
                else
                    return Redirect::to('employee/config/residential-status')->with(array('erroralert' => 'Server problem Try again'));
            }
            return View::make('EmployeeManager.addResidentialStatus');
        }


        /*
         * Purpose : edit Residential
         * Return   boolean value
         */
        public function editresidentialStatus(){
            $id = Request::Segment(4);
            $residentialStatus = DB::table('il_residential_status')->select('residential_status','id')->where('id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                $name = Input::get('name');
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                $update = DB::table('il_residential_status')->where('id',$id)->update(array('residential_status' => $name,'date_modified' => $currentDate));
                if($update)
                    return Redirect::to('employee/config/residential-status')->with(array('successalert' => 'Residential Status updated Successfully'));
                else
                    return Redirect::to('employee/config/residential-status')->with(array('erroralert' => 'Server problem Try again'));
            }
            return View::make('EmployeeManager.editResidentialStatus')->with(array('view' => $residentialStatus,'id' => $id));
        }



                /*
         * Purpose : View Race
         * Return  : array value
         */
        public function race() {
            $race  = DB::table('il_race')->select('id','race')->orderby('id')->get();
            return View::make('EmployeeManager.race')->with(array('races' => $race));
        }


        /*
         * Purpose : Add Race
         * Return   boolean value
         */
        public function addRace(){
            $postData = Input::all();
            if(!empty($postData)) {
                $name = Input::get('name');
                $insert = DB::table('il_race')->insert(array('race' => $name));
                if($insert)
                    return Redirect::to('employee/config/race')->with(array('successalert' => 'Race added Successfully'));
                else
                    return Redirect::to('employee/config/race')->with(array('erroralert' => 'Server problem Try again'));
            }
            return View::make('EmployeeManager.addRace');
        }



        /*
         * Purpose : edt Race
         * Return   boolean value
         */
        public function editRace(){
            $id = Request::Segment(4);
            $races = DB::table('il_race')->select('race','id')->where('id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                $name = Input::get('name');
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                $update = DB::table('il_race')->where('id',$id)->update(array('race' => $name,'date_modified' => $currentDate));
                if($update)
                    return Redirect::to('employee/config/race')->with(array('successalert' => 'Race updated Successfully'));
                else
                    return Redirect::to('employee/config/race')->with(array('erroralert' => 'Server problem Try again'));
            }
            return View::make('EmployeeManager.editRace')->with(array('view' => $races,'id' => $id));
        }



        /*
         * Purpose : View Allowance
         * Return  : array value
         */
        public function allowance() {
            $allowance  = DB::table('il_allowances')->select('id','fkcoa_id','allowance')->orderby('id')->get();
            return View::make('EmployeeManager.allowance')->with(array('allowances' => $allowance));
        }


        /*
         * Purpose : Add Allowance
         * Return   boolean value
         */
        public function addAllowance(){
            $postData = Input::all();
            if(!empty($postData)) {
                $name  = Input::get('name');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_accounting_coa_level4 where level4_name="'.$name.'"'));
                if($checkStatus[0]->count == 0) {
                    $insertCoa = DB::table('il_accounting_coa_level4')->insertGetId(array('level4_name' => $name,'fklevel3_id' => 27,'edit_status' => 2));
                    $insert = DB::table('il_allowances')->insert(array('allowance' => $name,'fkcoa_id' => $insertCoa));
                    if($insert)
                        return Redirect::to('employee/config/allowance')->with(array('successalert' => 'Allowance added Successfully'));
                    else
                        return Redirect::to('employee/config/allowance')->with(array('erroralert' => 'Server problem Try again'));
                } else {
                    return Redirect::to('employee/config/add-allowance')->with(array('erroralert' => 'Allowance name already exists'));
                }
            }
            return View::make('EmployeeManager.addAllowance');
        }


        /*
         * Purpose : edt Allowance
         * Return   boolean value
         */
        public function editAllowance(){
            $id = Request::Segment(4);
            $allowance = DB::table('il_allowances')->select('id','fkcoa_id','allowance')->where('id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                $name = Input::get('name');
                $coa  = Input::get('coa_id');
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_accounting_coa_level4 where id!='.$coa.' AND level4_name="'.$name.'"'));
                if($checkStatus[0]->count == 0) {
                    $updateCoa = DB::table('il_accounting_coa_level4')->where('id',$coa)->update(array('level4_name' => $name,'date_modified' => $currentDate));
                    $update = DB::table('il_allowances')->where('id',$id)->update(array('allowance' => $name,'date_modified' => $currentDate));
                    if($update)
                        return Redirect::to('employee/config/allowance')->with(array('successalert' => 'Allowance updated Successfully'));
                    else
                        return Redirect::to('employee/config/allowance')->with(array('erroralert' => 'Server problem Try again'));
                } else {
                    return Redirect::to('employee/config/edit-allowance/'.$id)->with(array('erroralert' => 'Allowance name already exists'));
                }
            }
            return View::make('EmployeeManager.editAllowance')->with(array('view' => $allowance,'id' => $id));
        }

        /*
         * Purpose : Delete allowance if there is no employee assigned to that branch
         * Return boolean value
         */
        public function deleteAllowance() {
            $id  = Request::Segment(4);
            $coa = Request::Segment(5);
            $checkStatus = DB::select(DB::raw('select count(id) as count from il_emp_allowance where fkAllowId='.$id));
            if($checkStatus[0]->count == 0) {
                $delete = DB::table('il_accounting_coa_level4')->where('id','=',$coa)->delete();
                $delete = DB::table('il_allowances')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('employee/config/allowance')->with(array('successalert' => 'Allowance Deleted Successfully'));
                else
                       return Redirect::to('employee/config/allowance')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('employee/config/allowance')->with(array('erroralert' => 'Allowance already assigned so it cannot be deleted'));
            }
        }


        /*
         * Purpose : Delete residential status if there is no employee assigned to it
         * Return boolean value
         */
        public function deleteresidentialStatus() {
            $id = Request::Segment(4);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_info where fkresidential_status='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_residential_status')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('employee/config/residential-status')->with(array('successalert' => 'Residential Status Deleted Successfully'));
                else
                       return Redirect::to('employee/config/residential-status')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('employee/config/residential-status')->with(array('erroralert' => 'Residential Status already assigned so it cannot be deleted'));
            }
        }

        /*
         * Purpose : Reset Password
         * Return boolean value 
         */
        public function changePassword(){
            $postData  = Input::all();
            if(Input::has('view_page')){
               $empId       = $postData['emp_empId'];
               $password    = md5(trim($postData['enew_pass']));
            } else {
               $empId       = $postData['e_empId'];
               $password    = md5(trim($postData['new_pass']));
            }
            $currentDate = date('Y-m-d H:i:s');
            $role      = Session::get('role');
            $updatePassword  = DB::table('il_emp_details')->where('id',$empId)->update(array('password' => $password,'dateModified' => $currentDate));
                if($updatePassword) {
                    if($role == 1)
                        return Redirect::to('employee/view-employee-profile/'.$empId)->with('successalert','Password changed successfully');
                    else
                        return Redirect::to('dashboard')->with('successalert','Password changed successfully');
                } else {
                    if($role == 1)
                        return Redirect::to('employee/view-employee-profile/'.$empId)->with('erroralert','Sorry srvewr problem Try again');
                    else
                        return Redirect::to('dashboard')->with('erroralert','Sorry srvewr problem Try again');
                }
        }

        /*
         * Purpose : Delete race if there is no employee assigned to it
         * Return boolean value
         */
        public function deleteRace() {
            $id = Request::Segment(4);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_info where fkrace='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_race')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('employee/config/race')->with(array('successalert' => 'Race Deleted Successfully'));
                else
                       return Redirect::to('employee/config/race')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('employee/config/race')->with(array('erroralert' => 'Race already assigned so it cannot be deleted'));
            }
        }


        /*
         * Purpose : Delete designation if there is no employee assigned to it
         * Return boolean value
         */
        public function deleteJobTitle() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_job_info where job_title='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_job_title')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('config/designation')->with(array('successalert' => 'Designation Deleted Successfully'));
                else
                       return Redirect::to('config/designation')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('config/designation')->with(array('erroralert' => 'Designation already assigned so it cannot be deleted'));
            }
        }


        /*
         * Purpose : edit designation
         * Return   boolean value
         */
        public function editJobTitle(){
            $id = Request::Segment(3);
            $designation = DB::table('il_job_title')->select('*')->where('id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                $name = Input::get('name');
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                $jobQuery = DB::table('il_job_title')->select('id')->where('job_title',$name)->where('id','!=',$id)->first();
                if($jobQuery) {
                    return Redirect::to('config/designation')->with(array('erroralert' => 'Designation name already exists'));
                } else {
                    $update = DB::table('il_job_title')->where('id',$id)->update(array('job_title' => $name,'dateModified' => $currentDate));
                    if($update)
                        return Redirect::to('config/designation')->with(array('successalert' => 'Designation updated Successfully'));
                    else
                        return Redirect::to('config/designation')->with(array('erroralert' => 'Server problem Try again'));
                }
            }
            return View::make('EmployeeManager.editJobTitle')->with(array('view' => $designation,'id' => $id));
        }

        
        public function ajaxCall() {
           $actionCall =  Input::get('action');
           if($actionCall == 'checkSalaryRange') {
               $basic_wage = Input::get('basic_wage');
               $jobId      = Input::get('jobId');
               $result     =  DB::table('il_pay_grade')->select('fkJobTitleId','min_salary','max_salary')->where('fkJobTitleId',$jobId)->first();
               echo json_encode($result);
           } else if($actionCall == 'checkNricFin') {
               $nric = Input::get('nric');
               $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_info where nric_fin_no ="'.$nric.'"'));
               if($checkStatus[0]->emp_count == 0) {
                 echo 1;
               } else {
                 echo 2;
               }
           } else if($actionCall == 'checkNricFinUpdate') {
               $nric = Input::get('nric');
               $id   = Input::get('id');
               $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_info where nric_fin_no ="'.$nric.'" AND fkEmpId!='.$id));
               if($checkStatus[0]->emp_count == 0) {
                 echo 1;
               } else {
                 echo 2;
               }
           }
        }

	
}
?>