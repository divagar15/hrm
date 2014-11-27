<?php
class CompanyController extends BaseController {
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
        }
        
        
        /*
         * Purpose : Configurate Calendar or add Calendar
         * Return  : Boolean value
         */
        public function addCalendarConfig() {
            $postData = Input::all();
            if(!empty($postData)) {
                $calName  = trim(Input::get('cal_name'));
                $calType  = trim(Input::get('cal_type'));
                $cYear    = trim(Input::get('cal_year'));
                $sun      = Input::get('sun') == 1 ? 0 : 9;
                $mon      = Input::get('mon') == 1 ? 1 : 9;
                $tue      = Input::get('tue') == 1 ? 2 : 9;
                $wed      = Input::get('wed') == 1 ? 3 : 9;
                $thurs    = Input::get('thurs') == 1 ? 4 : 9;
                $fri      = Input::get('fri') == 1 ? 5 : 9;
                $sat      = Input::get('sat') == 1? 6 : 9;
                $insertArray  = array('cal_name' =>  $calName,'cal_type' => $calType,'cal_year' => $cYear,'mon' => $mon,'tue' => $tue,'wed' => $wed,'thurs' => $thurs,'fri' => $fri,'sat' => $sat,'sun' => $sun);
                $insertStatus = DB::table('il_calendar_config')->insert($insertArray);
                if($insertStatus) {
                     return Redirect::to('calendar/calendar-list')->with('successalert','Calendar added successfully');
                }
            }
            return View::make('Company.calendar.addCalendar');
        }
        
        /*
         * Purpose : Configurate Calendar or add Calendar
         * Return  : Boolean value
         */
        public function editCalendarConfig() {
            $id = Request::Segment(3);
            $getCalInfo = DB::table('il_calendar_config')->select('cal_name','cal_type','cal_year','sun','mon','tue','wed','thurs','fri','sat')->where('id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                $calName  = trim(Input::get('cal_name'));
                $calType  = trim(Input::get('cal_type'));
                $cYear    = trim(Input::get('cal_year'));
                $sun      = Input::get('sun') == 1 ? 0 : 9;
                $mon      = Input::get('mon') == 1 ? 1 : 9;
                $tue      = Input::get('tue') == 1 ? 2 : 9;
                $wed      = Input::get('wed') == 1 ? 3 : 9;
                $thurs    = Input::get('thurs') == 1 ? 4 : 9;
                $fri      = Input::get('fri') == 1 ? 5 : 9;
                $sat      = Input::get('sat') == 1? 6 : 9;
                $updateArray  = array('cal_name' =>  $calName,'cal_type' => $calType,'cal_year' => $cYear,'mon' => $mon,'tue' => $tue,'wed' => $wed,'thurs' => $thurs,'fri' => $fri,'sat' => $sat,'sun' => $sun,'dateModified' => date('Y-m-d H:i:s'));
                $updateStatus = DB::table('il_calendar_config')->where('id',$id)->update($updateArray);
                return Redirect::to('calendar/calendar-list')->with('successalert','Calendar updated successfully');
            }
            return View::make('Company.calendar.editCalendar')->with(array('id' => $id,'cal' => $getCalInfo));
        }
        
        /*
         * Purpose : List Calendar 
         * Return  : array value
         */
        public function calendarList() {
            $getCal = DB::table('il_calendar_config')->select('id','cal_name','cal_type','cal_year','mon','tue','wed','thurs','fri','sat','sun','alt_holiday')->get();
            return View::make('Company.calendar.calendarList')->with(array('calList' => $getCal));
        }


        /*
         * Purpose : Delete calendar if there is no employee assigned to that calendar
         * Return boolean value
         */
        public function deleteCalendar() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_job_info where calendar='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_calendar_config')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('calendar/calendar-list')->with(array('successalert' => 'Calendar Deleted Successfully'));
                else
                       return Redirect::to('calendar/calendar-list')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('calendar/calendar-list')->with(array('erroralert' => 'Calendar already assigned so it cannot be deleted'));
            }
        }


        /*
         * Purpose : Delete branch if there is no employee assigned to that branch
         * Return boolean value
         */
        public function deleteBranch() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_job_info where fkBranchId='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_branch')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('branch/branch-list')->with(array('successalert' => 'Branch Deleted Successfully'));
                else
                       return Redirect::to('branch/branch-list')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('branch/branch-list')->with(array('erroralert' => 'Branch already assigned so it cannot be deleted'));
            }
        }
        
        /*
         * Purpose : View Calendar
         * Return  : array value
         */
        public function viewcalendar(){
           $calId         = Request::Segment(3);
           $pholiday      = $choliday = array();
           $getCal        = DB::table('il_calendar_config')->select('id','cal_name','cal_type','cal_year','mon','tue','wed','thurs','fri','sat','sun','alt_holiday')->where('id',$calId)->first();
           $getAltHoliday = DB::table('il_assign_alt_holiday as asCal')->join('il_alternate_holiday as altholy','altholy.id','=','asCal.fkAltHolyId')->join('il_holiday as h','h.id','=','altholy.fkHolyId')->select('altholy.fkHolyId','altholy.holiday_date','h.holiday_type')->where('asCal.fkCalId',$calId)->get();
           $getHoliday = DB::table('il_holiday')->select('holiday_date','holiday_type');
           if(!empty($getAltHoliday)) {
               foreach($getAltHoliday as $alt) {
                   $getId[]   =  $alt->fkHolyId;
                   if($alt->holiday_type == 1) // public holiday
                       $pholiday[] = $alt->holiday_date;
                   else                       // conpany holiday
                       $choliday[] = $alt->holiday_date;
               }
               $getHoliday = $getHoliday->whereNotIn('id',$getId)->get();
           } else {
               $getHoliday = $getHoliday->get();
           }
           
           if(!empty($getHoliday)) {
               foreach($getHoliday as $hd) {
                   if($hd->holiday_type == 1) // public holiday
                       $pholiday[] = $hd->holiday_date;
                   else                       // conpany holiday
                       $choliday[] = $hd->holiday_date;
               }    
           }
           $getOfferDay = array($getCal->sun,$getCal->mon,$getCal->tue,$getCal->wed,$getCal->thurs,$getCal->fri,$getCal->sat);
           return View::make('Company.calendar.viewCalendar')->with(array('calView' => $getCal,'woffer' => $getOfferDay,'p_holiday' => $pholiday,'c_holiday' => $choliday,'id' => $calId));
        }
        
        /* Purposer : Assign Alternate Holiday to calendar
         * Return   : Boolean Value
         */
        public function assignAltHolidaycalendar() {
            $getCal        = DB::table('il_calendar_config')->select('id','cal_name')->get();
            $getAltHoliday = DB::table('il_alternate_holiday')->select('id','holiday_name','holiday_date')->get();
            $postData      = Input::all();
            $calId         = Input::get('fkCalId');
            $altHolyId     = Input::get('fkAltHolyId');
            if(!empty($postData)) {
                $getDtls = DB::table('il_assign_alt_holiday')->select('id')->where('fkCalId',$calId)->where('fkAltHolyId',$altHolyId)->get();
                if(empty($getDtls)) {
                    $insertStatus = DB::table('il_assign_alt_holiday')->insert($postData);
                    if($insertStatus)
                       DB::table('il_calendar_config')->where('id',$calId)->update(array('alt_holiday' => 1));
                       return Redirect::to('calendar/assign-alt-holiday-list')->with(array('successalert','Alternate Holiday already assigned to this calendar'));
                } else {
                    return Redirect::to('calendar/assign-alt-holiday-list')->with(array('warningalert','Alternate Holiday already assigned to this calendar'));
                }
            }
            return View::make('Company.calendar.assignAltHolyCalendar')->with(array('cal_list' => $getCal,'alt_holiday' => $getAltHoliday));
        }
        
        
        /* 
         * Purpose : Assigned Calendar List
         * Return  : Boolean value true or false
         */ 
        public function assignedCalendarList() {
            $getCalInfo = DB::table('il_assign_alt_holiday as assholy')->join('il_alternate_holiday as altHoly','altHoly.id','=','assholy.fkAltHolyId')->join('il_calendar_config as calConfig','calConfig.id','=','assholy.fkCalId')->join('il_holiday as h','h.id','=','altHoly.fkHolyId')->select('assholy.id as assign_id','altHoly.holiday_name','altHoly.holiday_date','calConfig.cal_name','calConfig.cal_type','h.holiday_name as actual_holiday_name','h.holiday_date as actual_holiday_date','h.holiday_type')->get();
            return View::make('Company.calendar.assignedCalendarList')->with(array('calList' => $getCalInfo));
            
        }
       
        /*
         * Purpose : Edit assigned Holiday
         * Return  : Boolean value true or false 
         */
        public function editAssignAltHoliday() {
            $id            = Request::Segment(3);
            $getCal        = DB::table('il_calendar_config')->select('id','cal_name')->get();
            $getAltHoliday = DB::table('il_alternate_holiday')->select('id','holiday_name','holiday_date')->get();
            $getInfo       = DB::table('il_assign_alt_holiday')->select('fkCalId','fkAltHolyId')->where('id',$id)->first();
            $postData      = Input::all();
            $calId         = Input::get('fkCalId');
            $altHolyId     = Input::get('fkAltHolyId');
            if(!empty($postData)) {
                $postData['dateModified'] = date('Y-m-d H:i:s');
                $updateStatus = DB::table('il_assign_alt_holiday')->where('id',$id)->update($postData);
                return Redirect::to('calendar/assign-alt-holiday-list')->with('successalert','Alternate Holiday updated successfully');
            }
            return View::make('Company.calendar.editAssignHoliday')->with(array('id' => $id,'aView' => $getInfo,'cal_list' => $getCal,'alt_holiday' => $getAltHoliday));
        }
        
        /*
         * Purpose : Delete Assigned Holiday
         * Return  : Boolean value 
         */
        public function deleteAssignHoliday() {
          $id            = Request::Segment(3);
          $delStatus     = DB::table('il_assign_alt_holiday')->where('id',$id)->delete();
          if($delStatus)
              return Redirect::to('calendar/assign-alt-holiday-list')->with('successalert','Assigned Holiday deleted successfully');
          else
              return Redirect::to('calendar/assign-alt-holiday-list')->with('erroralert','Sorry Server problem try again');
        }
        
        /*
         * Purpose :  Add Branch Details
         * Return : boolean value
         */
        public function addBranch() {
            $postData = Input::all();
            if(!empty($postData)){
                $branch_code = Input::get('branch_code');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_branch where branch_code="'.$branch_code.'"'));
                if($checkStatus[0]->count == 0) {
                    $insertStatus = DB::table('il_branch')->insert($postData);
                    if($insertStatus)
                       return Redirect::to('branch/branch-list')->with('successalert','Branch updated successfully');
               } else {
                    return Redirect::to('branch/add-branch')->with('erroralert','Branch Code already exists');
                }
            }
            return View::make('Company.branch.addBranch');
        }
        /*
         * Purpose :  edit Branch Details
         * Return : boolean value
         */
        public function editBranch() {
            $postData = Input::all();
            $id = Request::Segment(3);
            if(!empty($postData)){
                $branch_code = Input::get('branch_code');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_branch where branch_code="'.$branch_code.'" AND id!='.$id));
                    if($checkStatus[0]->count == 0) {
                    $postData['dateModified'] = date('Y-m-d H:i:s');
                    $updateStatus = DB::table('il_branch')->where('id',$id)->update($postData);
                    return Redirect::to('branch/branch-list')->with('successalert','Branch updated successfully');
                } else {
                    return Redirect::to('branch/edit-branch/'.$id)->with('erroralert','Branch Code already exists');
                }
            } else {
                $getBranch = DB::table('il_branch')->select('id','branch_name','branch_code','address')->where('id',$id)->first();
            }
            return View::make('Company.branch.editBranch')->with(array('id' => $id,'bView' => $getBranch));
        }
        
        /*
         * Purpose : Get Branch list view in table
         * Return  : array value
         */
        public function branchListing(){
            $getBranch = DB::table('il_branch')->select('id','branch_name','branch_code','address')->get();
            return View::make('Company.branch.branchListing')->with(array('branch_list' => $getBranch));
        }


        /*
         * Purpose : Get Nationality list view in table
         * Return  : array value
         */
        public function nationalityListing(){
            $nationalityListing = DB::table('il_nationality')->get();
            return View::make('Company.nationality.nationalityListing')->with(array('nationality_list' => $nationalityListing));
        }


        /*
         * Purpose :  Add Nationality Details
         * Return : boolean value
         */
        public function addNationality() {
            $postData = Input::all();
            if(!empty($postData)){
                $code = Input::get('nationality_code');
                $name = Input::get('nationality_name');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_nationality where nationality_name="'.$name.'"'));
                if($checkStatus[0]->count == 0) {
                    $insertStatus = DB::table('il_nationality')->insert($postData);
                    if($insertStatus)
                       return Redirect::to('config/nationality')->with('successalert','Nationality Created successfully');
                } else {
                    return Redirect::to('config/add-nationality')->with('erroralert','Nationality Code or Name already exists');
                }
            }
            return View::make('Company.nationality.addNationality');
        }


         /*
         * Purpose :  edit Nationality Details
         * Return : boolean value
         */
        public function editNationality() {
            $postData = Input::all();
            $id = Request::Segment(3);
            if(!empty($postData)){
                $code = Input::get('nationality_code');
                $name = Input::get('nationality_name');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_nationality where id!='.$id.' AND (nationality_name="'.$name.'")'));
                if($checkStatus[0]->count == 0) {
                    $postData['date_modified'] = date('Y-m-d H:i:s');
                    $updateStatus = DB::table('il_nationality')->where('id',$id)->update($postData);
                    return Redirect::to('config/nationality')->with('successalert','Nationality updated successfully');
                } else {
                    return Redirect::to('config/edit-nationality/'.$id)->with('erroralert','Nationality Code or Name already exists');
                }
            } else {
                $getNationality = DB::table('il_nationality')->where('id',$id)->first();
            }
            return View::make('Company.nationality.editNationality')->with(array('id' => $id,'view' => $getNationality));
        }


        /*
         * Purpose : Delete nationality if there is no employee assigned to that nationality
         * Return boolean value
         */
        public function deleteNationality() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_info where nationality='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_nationality')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('config/nationality')->with(array('successalert' => 'Nationality Deleted Successfully'));
                else
                       return Redirect::to('config/nationality')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('config/nationality')->with(array('erroralert' => 'Nationality already assigned so it cannot be deleted'));
            }
        }


        /*
         * Purpose : Get Place of Birth list view in table
         * Return  : array value
         */
        public function pobListing(){
            $pobListing = DB::table('il_pob')->get();
            return View::make('Company.pob.pobListing')->with(array('pob_list' => $pobListing));
        }


        /*
         * Purpose :  Add Place of Birth Details
         * Return : boolean value
         */
        public function addPob() {
            $postData = Input::all();
            if(!empty($postData)){
                $pob = Input::get('place_of_birth');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_pob where place_of_birth ="'.$pob.'"'));
                if($checkStatus[0]->count == 0) {
                    $insertStatus = DB::table('il_pob')->insert($postData);
                    if($insertStatus)
                       return Redirect::to('config/pob')->with('successalert','Place of Birth Created successfully');
                } else {
                    return Redirect::to('config/add-pob')->with('erroralert','Place of Birth already exists');
                }
            }
            return View::make('Company.pob.addPob');
        }


         /*
         * Purpose :  edit Place of Birth Details
         * Return : boolean value
         */
        public function editPob() {
            $postData = Input::all();
            $id = Request::Segment(3);
            if(!empty($postData)){
                $pob = Input::get('place_of_birth');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_pob where id!='.$id.' AND (place_of_birth ="'.$pob.'")'));
                if($checkStatus[0]->count == 0) {
                    $postData['date_modified'] = date('Y-m-d H:i:s');
                    $updateStatus = DB::table('il_pob')->where('id',$id)->update($postData);
                    return Redirect::to('config/pob')->with('successalert','Place of Birth updated successfully');
                } else {
                    return Redirect::to('config/edit-pob/'.$id)->with('erroralert','Place of Birth already exists');
                }
            } else {
                $getPob = DB::table('il_pob')->where('id',$id)->first();
            }
            return View::make('Company.pob.editPob')->with(array('id' => $id,'view' => $getPob));
        }


        /*
         * Purpose : Delete Place of Birth if there is no employee assigned to that Place of Birth
         * Return boolean value
         */
        public function deletePob() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_info where cob='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_pob')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('config/pob')->with(array('successalert' => 'Place of Birth Deleted Successfully'));
                else
                       return Redirect::to('config/pob')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('config/pob')->with(array('erroralert' => 'Place of Birth already assigned so it cannot be deleted'));
            }
        }


        /*
         * Purpose : Get Martial Status list view in table
         * Return  : array value
         */
        public function martialStatusListing(){
            $martialStatusListing = DB::table('il_martial_status')->get();
            return View::make('Company.martial.martialStatusListing')->with(array('martial_status_list' => $martialStatusListing));
        }


        /*
         * Purpose :  Add Martial Status Details
         * Return : boolean value
         */
        public function addMartialStatus() {
            $postData = Input::all();
            if(!empty($postData)){
                $martial = Input::get('martial_status');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_martial_status where martial_status ="'.$martial.'"'));
                if($checkStatus[0]->count == 0) {
                    $insertStatus = DB::table('il_martial_status')->insert($postData);
                    if($insertStatus)
                       return Redirect::to('config/martial-status')->with('successalert','Martial Status Created successfully');
                } else {
                    return Redirect::to('config/add-martial-status')->with('erroralert','Martial Status already exists');
                }
            }
            return View::make('Company.martial.addMartialStatus');
        }


         /*
         * Purpose :  edit Martial Status Details
         * Return : boolean value
         */
        public function editMartialStatus() {
            $postData = Input::all();
            $id = Request::Segment(3);
            if(!empty($postData)){
                $martial = Input::get('martial_status');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_martial_status where id!='.$id.' AND (martial_status ="'.$martial.'")'));
                if($checkStatus[0]->count == 0) {
                    $postData['date_modified'] = date('Y-m-d H:i:s');
                    $updateStatus = DB::table('il_martial_status')->where('id',$id)->update($postData);
                    return Redirect::to('config/martial-status')->with('successalert','Martial Status updated successfully');
                } else {
                    return Redirect::to('config/edit-martial-status/'.$id)->with('erroralert','Martial Status already exists');
                }
            } else {
                $getMartial = DB::table('il_martial_status')->where('id',$id)->first();
            }
            return View::make('Company.martial.editMartialStatus')->with(array('id' => $id,'view' => $getMartial));
        }


        /*
         * Purpose : Delete Martial Status if there is no employee assigned to that Martial Status
         * Return boolean value
         */
        public function deleteMartialStatus() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_info where marital_status='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_martial_status')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('config/martial-status')->with(array('successalert' => 'Martial Status Deleted Successfully'));
                else
                       return Redirect::to('config/martial-status')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('config/martial-status')->with(array('erroralert' => 'Martial Status already assigned so it cannot be deleted'));
            }
        }



        /*
         * Purpose : Get Cessation Code list view in table
         * Return  : array value
         */
        public function cessationListing(){
            $cessationListing = DB::table('il_cessation')->get();
            return View::make('Company.cessation.cessation')->with(array('cessation_list' => $cessationListing));
        }


        /*
         * Purpose :  Add Cessation Code Details
         * Return : boolean value
         */
        public function addCessation() {
            $postData = Input::all();
            if(!empty($postData)){
                $cessation_code = Input::get('cessation_code');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_cessation where cessation_code ="'.$cessation_code.'"'));
                if($checkStatus[0]->count == 0) {
                    $insertStatus = DB::table('il_cessation')->insert($postData);
                    if($insertStatus)
                       return Redirect::to('config/cessation')->with('successalert','Cessation Code Created successfully');
                } else {
                    return Redirect::to('config/add-cessation')->with('erroralert','Cessation Code already exists');
                }
            }
            return View::make('Company.cessation.addCessation');
        }


         /*
         * Purpose :  edit Cessation Code Details
         * Return : boolean value
         */
        public function editCessation() {
            $postData = Input::all();
            $id = Request::Segment(3);
            if(!empty($postData)){
                $cessation_code = Input::get('cessation_code');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_cessation where id!='.$id.' AND (cessation_code ="'.$cessation_code.'")'));
                if($checkStatus[0]->count == 0) {
                    $postData['date_modified'] = date('Y-m-d H:i:s');
                    $updateStatus = DB::table('il_cessation')->where('id',$id)->update($postData);
                    return Redirect::to('config/cessation')->with('successalert','Cessation Code updated successfully');
                } else {
                    return Redirect::to('config/edit-cessation/'.$id)->with('erroralert','Cessation Code already exists');
                }
            } else {
                $getCessation = DB::table('il_cessation')->where('id',$id)->first();
            }
            return View::make('Company.cessation.editCessation')->with(array('id' => $id,'view' => $getCessation));
        }


        /*
         * Purpose : Delete Cessation Code if there is no employee assigned to that Cessation Code
         * Return boolean value
         */
        public function deleteCessation() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_job_info where cessation_code='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_cessation')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('config/cessation')->with(array('successalert' => 'Cessation Code Deleted Successfully'));
                else
                       return Redirect::to('config/cessation')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('config/cessation')->with(array('erroralert' => 'Cessation Code already assigned so it cannot be deleted'));
            }
        }


        public function addEmploymentLevel() {
            /* get job title from db contract array */
            $employmentLevel = DB::table('il_user_type')/*->where('id','!=',1)*/->get();    
            //return $jobQuery;        
            return View::make('Company.employment.addEmploymentLevel')->with(array('employmentLevel' => $employmentLevel));
        }

        public function insertEmploymentLevel(){
            $name   = Input::get('name');
            $jobQuery = DB::table('il_user_type')->select('id')->where('user_type',$name)->first();
            if(isset($jobQuery)) {
                return Redirect::to('config/employment-level/')->with(array('erroralert' => 'Employment Level  '.$name.' already exists. '));
            } else {          
                $insert = DB::table('il_user_type')->insert(array('user_type' => $name));
                if($insert) {
                    return Redirect::to('config/employment-level')->with('successalert','Employment Level added successfully');
                }
            }
        }


        /*
         * Purpose : Delete Employment Level if there is no employee assigned to it
         * Return boolean value
         */
        public function deleteEmploymentLevel() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_details where user_role='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_user_type')->where('id','=',$id)->where('id','!=',1)->delete();
                if($delete)
                       return Redirect::to('config/employment-level')->with(array('successalert' => 'Employment Level Deleted Successfully'));
                else
                       return Redirect::to('config/employment-level')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('config/employment-level')->with(array('erroralert' => 'Employment Level already assigned so it cannot be deleted'));
            }
        }


        /*
         * Purpose : edit Employment Level
         * Return   boolean value
         */
        public function editEmploymentLevel(){
            $id = Request::Segment(3);
            $employmentLevel = DB::table('il_user_type')->select('*')->where('id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                $name = Input::get('name');
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                $jobQuery = DB::table('il_user_type')->select('id')->where('user_type',$name)->where('id','!=',$id)->first();
                if($jobQuery) {
                    return Redirect::to('config/employment-level')->with(array('erroralert' => 'Employment Level already exists'));
                } else {
                    $update = DB::table('il_user_type')->where('id',$id)->update(array('user_type' => $name,'dateModified' => $currentDate));
                    if($update)
                        return Redirect::to('config/employment-level')->with(array('successalert' => 'Employment Level updated Successfully'));
                    else
                        return Redirect::to('config/employment-level')->with(array('erroralert' => 'Server problem Try again'));
                }
            }
            return View::make('Company.employment.editEmploymentLevel')->with(array('view' => $employmentLevel,'id' => $id));
        }



        /*
         * Purpose :  company CPF and Registration Number Details
         * Return : boolean value
         */
        public function company() {
            $postData = Input::all();
            if(!empty($postData)){
                /*$cpf_no          = Input::get('cpf_no');
                $registration_no = Input::get('registration_no');*/
               
                $postData['dateModified'] = date('Y-m-d H:i:s');
                $updateStatus = DB::table('il_company_info')->where('id',1)->update($postData);
                    return Redirect::to('config/company')->with('successalert','Company Details Updated Successfully');
                
            } else {
                $comapny = DB::table('il_company_info')->where('id',1)->first();
            }
            return View::make('Company.config')->with(array('view' => $comapny));
        }



        /*
         * Purpose : Get Category list view in table
         * Return  : array value
         */
        public function categoryListing(){
            $categoryListing = DB::table('il_category')->get();
            return View::make('Company.category.categoryListing')->with(array('category_list' => $categoryListing));
        }


        /*
         * Purpose :  Add Category Details
         * Return : boolean value
         */
        public function addCategory() {
            $postData = Input::all();
            if(!empty($postData)){
                $category = Input::get('category_name');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_category where category_name ="'.$category.'"'));
                if($checkStatus[0]->count == 0) {
                    $insertStatus = DB::table('il_category')->insert($postData);
                    if($insertStatus)
                       return Redirect::to('config/category')->with('successalert','Category Created successfully');
                } else {
                    return Redirect::to('config/add-category')->with('erroralert','Category already exists');
                }
            }
            return View::make('Company.category.addCategory');
        }


         /*
         * Purpose :  edit Category Details
         * Return : boolean value
         */
        public function editCategory() {
            $postData = Input::all();
            $id = Request::Segment(3);
            if(!empty($postData)){
                $category = Input::get('category_name');
                $checkStatus = DB::select(DB::raw('select count(id) as count from il_category where id!='.$id.' AND (category_name ="'.$category.'")'));
                if($checkStatus[0]->count == 0) {
                    $postData['date_modified'] = date('Y-m-d H:i:s');
                    $updateStatus = DB::table('il_category')->where('id',$id)->update($postData);
                    return Redirect::to('config/category')->with('successalert','Category updated successfully');
                } else {
                    return Redirect::to('config/edit-category/'.$id)->with('erroralert','Category already exists');
                }
            } else {
                $getCategory = DB::table('il_category')->where('id',$id)->first();
            }
            return View::make('Company.category.editCategory')->with(array('id' => $id,'view' => $getCategory));
        }


        /*
         * Purpose : Delete Category if there is no employee assigned to that Category
         * Return boolean value
         */
        public function deleteCategory() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as emp_count from il_emp_job_info where category='.$id));
            if($checkStatus[0]->emp_count == 0) {
                $delete = DB::table('il_category')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('config/category')->with(array('successalert' => 'Category Deleted Successfully'));
                else
                       return Redirect::to('config/category')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('config/category')->with(array('erroralert' => 'Category already assigned so it cannot be deleted'));
            }
        }


}
?>