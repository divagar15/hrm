<?php
class HumanResourceController extends BaseController {
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
        
        
        /*
         * Purpose : Track Punch In / Punch Out for attendance tracking
         * return boolean value true or false  
         */
        public function punchLogTracking() {
           $empLogId       = $this->id;
           $currentDate    = date('Y-m-d',strtotime('now'));
           $checkLogStatus = DB::table('il_time_sheet')->select('attend_date','punch_in','punch_out_mode')->where('fkEmpId',$empLogId)->where('attend_date',$currentDate)->first();
           return View::make('Hrm.attendance_punch')->with(array('logView' => $checkLogStatus));
        }
        
        /*
         * Purpose : update Punch In / Punch Out for attendance tracking with time
         * return boolean value true or false
         */
        public function punchInOutProcess() { 
           $postData  = Input::all();
           if(!empty($postData)) {
                $empLogId      = $this->id;
                $punch_time = Input::get('log_time');
                $punch_note = Input::get('attend_note');
                $log_status    = Input::get('log_status');
                $attend_date   = Input::get('attend_date');
                if($log_status == 0) { // Yet not punch out till date
                    $punchInStatus = DB::table('il_time_sheet')->insert(array('fkEmpId' => $empLogId,'attend_date' => $attend_date,'punch_in' => $punch_time,'punchIn_note' => $punch_note));
                    if($punchInStatus) {
                        return Redirect::to('attendance/punch-out')->with('successalert','Your Punch-In time updated successfully');
                    }
                } elseif($log_status == 1) {
                      $empLogId       = $this->id;
                      $currentDate    = date('Y-m-d',strtotime('now'));
                      $getPunchInTime = DB::table('il_time_sheet')->select('punch_in')->where('fkEmpId',$empLogId)->where('attend_date',$currentDate)->first();
                      if(!empty($getPunchInTime)) {
                          $total_work_hrs = CommonFunction::calculateDuration($attend_date.' '.$getPunchInTime->punch_in,$attend_date.' '.$punch_time);
                          $punchOutStatus = DB::table('il_time_sheet')->where('fkEmpId',$empLogId)->where('attend_date',$attend_date)->update(array('punch_out' => $punch_time,'punchOut_note' => $punch_note,'total_hrs' => $total_work_hrs,'punch_out_mode' => 2,'dateModified' => date('Y-m-d H:i:s',strtotime('now'))));
                      }
                      //$punchOutStatus = DB::table('il_time_sheet')->where('fkEmpId',$empLogId)->where('attend_date',$attend_date)->update(array('punch_out' => $punch_time,'punchOut_note' => $punch_note,'punch_out_mode' => 2,'dateModified' => date('Y-m-d H:i:s',strtotime('now'))));
                    if($punchOutStatus) {
                        return Redirect::to('attendance/punch-in')->with('successalert','Your Punch-Out time updated successfully');
                    }
                } elseif($log_status == 2) {
                        return Redirect::to('attendance/punch-in')->with('erroralert','Already Punch-Out, Punch-In or Punch-Out can process only once per day.');
                }
           }
        }
        
        /*
         * Purpose : View attendance records
         * return boolean value true or false
         */
        public function ViewAttendanceRecord() {
            $empLogId       =   $this->id;
            $attendanceList = DB::table('il_time_sheet as ts')->join('il_emp_details as emp','emp.id','=','ts.fkEmpId')->select('ts.id','ts.attend_date','ts.punch_in','ts.punchIn_note','ts.punch_out','ts.punchOut_note','ts.punch_out_mode','emp.emp_name')->where('ts.fkEmpid',$empLogId)->get();
            return View::make('Hrm.viewAttendanceRecord')->with(array('attendance_list' => $attendanceList));
            
        }
        
        /*
         * Purpose : View Holiday listing
         * Return  : array value
         */
        public function holidayList() {
            $holidayList  = DB::table('il_holiday')->select('id','holiday_name','holiday_type','holiday_date')->orderby('holiday_date')->get();
            return View::make('Hrm.leave.holidayList')->with(array('holiday_list' => $holidayList));
        }



        
        /*
         * Purpose : Add holiday
         * Return   boolean value
         */
        public function addHoliday(){
            $postData = Input::all();
            if(!empty($postData)) {
                $holiday_name = Input::get('holiday_name');
                $holiday_date = Input::get('holiday_date');
                $holiday_date = date('Y-m-d',strtotime($holiday_date));
                $holiday_type = Input::get('holiday_type');
                $insert = DB::table('il_holiday')->insert(array('holiday_name' => $holiday_name,'holiday_type' => $holiday_type,'holiday_date' => $holiday_date));
                if($insert)
                    return Redirect::to('leave/holiday-list')->with(array('successalert' => 'Holiday added Successfully'));
                else
                    return Redirect::to('leave/holiday-list')->with(array('erroralert' => 'Server problem Try again'));
            }
            return View::make('Hrm.leave.addHoliday');
        }
        /*
         * Purpose : edt holiday
         * Return   boolean value
         */
        public function editHoliday(){
            $id = Request::Segment(3);
            $getHoliday = DB::table('il_holiday')->select('holiday_name','holiday_type','holiday_date')->where('id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                $holiday_name = Input::get('holiday_name');
                $holiday_date = Input::get('holiday_date');
                $holiday_date = date('Y-m-d',strtotime($holiday_date));
                $holiday_type = Input::get('holiday_type');
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                $update = DB::table('il_holiday')->where('id',$id)->update(array('holiday_name' => $holiday_name,'holiday_type' => $holiday_type,'holiday_date' => $holiday_date,'dateModified' => $currentDate));
                if($update)
                    return Redirect::to('leave/holiday-list')->with(array('successalert' => 'Holiday update Successfully'));
                else
                    return Redirect::to('leave/holiday-list')->with(array('erroralert' => 'Server problem Try again'));
            }
            return View::make('Hrm.leave.editHoliday')->with(array('view_holiday' => $getHoliday,'id' => $id));
        }
        
        /*
         * Purpose : Delete holiday date
         * Return boolean value
         */
        public function deleteHoliday() {
            $id = Request::Segment(3);
            $delete = DB::table('il_holiday')->where('id','=',$id)->delete();
            if($delete)
                   return Redirect::to('leave/holiday-list')->with(array('successalert' => 'Holiday delete Successfully'));
            else
                   return Redirect::to('leave/holiday-list')->with(array('erroralert' => 'Server problem Try again'));
        }
        
        /*
         * Purpose : add Alternate Holiday date
         * Return  : boolean value
         */
        public function addAltHoliday() {
            $postData = Input::all();
            if(!empty($postData)) {
                $holyId      = $postData['fkHolyId'];
                $holy_name   = $postData['holiday_name'];
                $holy_date   = date('Y-m-d',strtotime($postData['holiday_date']));
                $insertStatus = DB::table('il_alternate_holiday')->insert(array('fkHolyId' => $holyId,'holiday_name' => $holy_name,'holiday_date' => $holy_date));
                if($insertStatus) {
                    return Redirect::to('leave/alt-holiday-list')->with('successalert','Alternate Holiday updated Successfully');
                }
            }
            $holidayList = DB::table('il_holiday')->select('id','holiday_name','holiday_date')->get();
            return View::make('Hrm.leave.addAltHoliday')->with(array('holiday_list' => $holidayList));
        }
        
         /*
         * Purpose : add Alternate Holiday date
         * Return  : boolean value
         */
        public function editAltHoliday() {
            $id = Request::Segment(3);
            $postData = Input::all();
            if(!empty($postData)) {
                $postData['holiday_date']     = date('Y-m-d',strtotime($postData['holiday_date']));
                $postData['dateModified']     = date('Y-m-d H:i:s',strtotime('now'));
                $updateStatus = DB::table('il_alternate_holiday')->where('id',$id)->update($postData);
                if($updateStatus) 
                    return Redirect::to('leave/alt-holiday-list')->with('successalert','Alternate Holiday updated Successfully');
            } 
            $getAltLeave = DB::table('il_alternate_holiday')->select('id as alt_id','fkHolyId','holiday_name','holiday_date')->where('id',$id)->first();
            $holidayList = DB::table('il_holiday')->select('id','holiday_name','holiday_date')->get();
            return View::make('Hrm.leave.editAltHoliday')->with(array('holiday_list' => $holidayList,'id' => $id,'lview' => $getAltLeave));
        }
        
        /*
         * Purposer : delete alternate holiday
         * Return   : boolean value
         */
        public function deleteAltHoliday(){
            $id = Request::Segment(3);
            $delete = DB::table('il_alternate_holiday')->where('id','=',$id)->delete();
            if($delete)
                   return Redirect::to('leave/alt-holiday-list')->with(array('successalert' => 'Holiday Delete Successfully'));
            else
                   return Redirect::to('leave/alt-holiday-list')->with(array('erroralert' => 'Server problem Try again'));
        }
        /*
         * Purpose : alt Holiday List
         * Return  : Boolean value 
         */
        public function altHolidayList(){
            $selAltLeave = DB::table('il_alternate_holiday as alt_hol')->join('il_holiday as hol','hol.id','=','alt_hol.fkHolyId')->select('alt_hol.id as alt_id','alt_hol.holiday_name as alt_holiday_name','alt_hol.holiday_date as alt_holiday_date','hol.holiday_name','hol.holiday_date')->get();
            return View::make('Hrm.leave.altHolidayListing')->with(array('alt_leave' => $selAltLeave));
        }
        
        /*
         * Purpose : View Leave Type
         * Return  : array value
         */
        public function leaveType() {
            $leaveList  = DB::table('il_leaves')->select('id','leave_type','leave_count')->where('id','!=',7)->where('id','!=',14)->get();
            return View::make('Hrm.leave.leaveList')->with(array('leaveList' => $leaveList));
        }


        /*
         * Purpose : Add Leave Type
         * Return   boolean value
         */
        public function addLeaveType(){
            $postData = Input::all();
            if(!empty($postData)) {
                $leave_type  = Input::get('leave_type');
                $leave_count = Input::get('leave_count');
                $getLeave = DB::table('il_leaves')->select('id')->where('leave_type',$leave_type)->first();
                if(isset($getLeave)) {
                    return Redirect::to('leave/add-leave-type')->with(array('erroralert' => 'Leave name '.$leave_type.' already exists. '));
                } else {
                    $insert = DB::table('il_leaves')->insert(array('leave_type' => $leave_type,'leave_count' => $leave_count));
                    if($insert)
                        return Redirect::to('leave/leave-type-list')->with(array('successalert' => 'Leave Type added Successfully'));
                    else
                        return Redirect::to('leave/leave-type-list')->with(array('erroralert' => 'Server problem Try again'));
                }
            }
            return View::make('Hrm.leave.addLeaveType');
        }

       /*
         * Purpose : edt leave type
         * Return   boolean value
         */
        public function editLeaveType() {
            $id = Request::Segment(3);
            $getLeave = DB::table('il_leaves')->select('leave_type','leave_count')->where('id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                $leave_type = Input::get('leave_type');
                $leave_count = Input::get('leave_count');
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                $getLeave = DB::table('il_leaves')->select('id')->where('leave_type',$leave_type)->where('id','!=',$id)->first();
                if(isset($getLeave)) {
                    return Redirect::to('leave/edit-leave-type/'.$id)->with(array('erroralert' => 'Leave name  '.$leave_type.' already exists. '));
                } else {
                    $update = DB::table('il_leaves')->where('id',$id)->update(array('leave_type' => $leave_type,'leave_count' => $leave_count,'date_modified' => $currentDate));
                    if($update)
                        return Redirect::to('leave/leave-type-list')->with(array('successalert' => 'Leave Type update Successfully'));
                    else
                        return Redirect::to('leave/leave-type-list')->with(array('erroralert' => 'Server problem Try again'));
                }
            }
            return View::make('Hrm.leave.editLeaveType')->with(array('view_leave' => $getLeave,'id' => $id));
        }

        /*
         * Purpose : Delete leave type if there is no entry in the leave table
         * Return boolean value
         */
        public function deleteLeaveType() {
            $id = Request::Segment(3);
            $checkStatus = DB::select(DB::raw('select count(id) as leave_count from il_applied_leaves where fkLeaveType='.$id));
            if($checkStatus[0]->leave_count == 0) {
                $delete = DB::table('il_leaves')->where('id','=',$id)->delete();
                if($delete)
                       return Redirect::to('leave/leave-type-list')->with(array('successalert' => 'Leave Type delete Successfully'));
                else
                       return Redirect::to('leave/leave-type-list')->with(array('erroralert' => 'Server problem Try again'));
            } else {
                return Redirect::to('leave/leave-type-list')->with(array('erroralert' => 'Leave type already assigned so it cannot be deleted'));
            }
        }
        

        
        
        /*
         * Purpose : employee listing with overall working hrs
         * Return   boolean value
         */
        public function viewEmployeeWorkSheet() {
            
        }
        
        /*
         * Purpose : View All Employee all working hrs for one month
         * Return Boolean value
         */
        public function viewEmployeeTotalHrsSheet() {
            $getHolidayList = DB::table('il_holiday')->select('holiday_date')->get();
            if(!empty($getHolidayList)){
                foreach($getHolidayList as $list) {
                    $holidayList[] = $list->holiday_date;
                }
            }
            $month_start_date   = date('Y-m-01',strtotime('now'));
            $month_end_date     = date('Y-m-t',strtotime('now')); // t give no of days current month
            $no_of_working_days = CommonFunction::getWorkingDays($month_start_date,$month_end_date,$holidayList);
            if($no_of_working_days > 0)
             $calHrs =  CommonFunction::convertTimeFormat($no_of_working_days);
            $totalWorkingHrs  = $calHrs['h'];
            $totalWorkInSeconds = $calHrs['h'] * 3600;
            //echo $no_of_working_days;die();
            //echo $totalWorkingHrs;
            //echo '<pre>'; print_r($calHrs); echo '</pre>';
            // $holidays=array("2014-01-01","2014-01-26");
           // echo getWorkingDays("2014-01-01","2014-01-31",$holidays);
            $getEmployeeTotalHrs = DB::select(DB::raw('SELECT emp.id as emp_id,emp.emp_name, SEC_TO_TIME(SUM(TIME_TO_SEC(ts.total_hrs))) as emp_total_hrs FROM il_time_sheet as ts inner join il_emp_details as emp ON(emp.id = ts.fkEmpId) WHERE 1 group by ts.fkEmpId'));
            return View::make('Hrm.attendance.viewEmployeeTotalHrsList')->with(array('emptotalHrsList' => $getEmployeeTotalHrs,'total_work_days' => $no_of_working_days,'total_work_hrs' => $totalWorkingHrs,'total_work_second' => $totalWorkInSeconds,'month_start_date' => $month_start_date,'month_end_date' => $month_end_date));
        }
        
        /*
         * Purpose : view employee time sheet for month
         * return boolean array value
         */
        public function viewEmployeeMonthTimeSheet() {
            $id = Request::Segment(3);
            $month_start_date   = date('Y-m-01',strtotime('now'));
            $month_end_date     = date('Y-m-t',strtotime('now')); // t give no of days current month
            $getEmployeeInfo    = DB::table('il_emp_details as emp')->leftJoin('il_emp_job_info as emp_job','emp.id','=','emp_job.fkEmpId')->leftJoin('il_job_title as jt','jt.id','=','emp_job.job_title')->leftJoin('il_branch as br','br.id','=','emp_job.fkBranchId')->select('emp.emp_name','emp.email_id','jt.job_title','br.branch_name')->where('emp.id',$id)->first();
            $getTimeSheet       = DB::table('il_time_sheet')->select('attend_date','punch_in','punch_out','total_hrs as duration','overtime_approval','punch_out_mode')->where('fkEmpId',$id)->where('punch_out_mode','!=','1')->get();
            return View::make('Hrm.attendance.viewMonthTimeSheet')->with(array('month_start_date' => $month_start_date,'month_end_date' => $month_end_date,'emp_timesheet' => $getTimeSheet,'emp_info' => $getEmployeeInfo));
        }



        /*
         * Purpose : View all applied leaves
         * Return  : array value
         */
        public function appliedLeaves() {
            $leaveApplied = DB::table('il_leave_application')->select('id','fkuser_id','fkleave_type','from_date','to_date')->where('fkuser_id',Session::get('id'))->get();
            return View::make('Hrm.leave.leaveApplied')->with(array('leaveApplied' => $leaveApplied));
        }


         /*
         * Purpose : Apply Leave 
         * Return   boolean value
         */
        public function applyLeave(){
            $postData = Input::all();
            $uRole        =  Session::get('role');
            $emp_id       = Input::get('emp_id'); 
            $getLeaveList = DB::table('il_leaves')->select('id','leave_type')->get();
            $getEmpList   = DB::table('il_emp_details as emp')->join('il_emp_job_info as ejob','ejob.fkEmpId','=','emp.id')->select('emp.id','emp.emp_name')->where('ejob.cessation_code',0)->where('emp.is_active',1)->orderby('emp.emp_name','asc')->get();
            if(!empty($postData)) {
                $empId      = Input::get('emp_id');
                $from_date  = date('Y-m-d',strtotime(Input::get('from_date')));
                $to_date    = date('Y-m-d',strtotime(Input::get('to_date')));
                $off_day    = Input::has('off_day') ? Input::get('off_day') : 1;
                $ph_day     = Input::has('ph_day') ? Input::get('ph_day') : 1;
                $desp       = Input::get('desp');
                $getLeaveList = DB::table('il_leave_apply')->select('id')->where('fkEmpId',$emp_id)->where('status',3)->get();
                if($getLeaveList) {
                    return Redirect::to('leave/apply-leave')->with('erroralert','Leave already pending for approval.');
                }
                else {
                    $insertId     = DB::table('il_leave_apply')->insertGetId(array('fkEmpId' => $empId,'from_date' => $from_date,'to_date' => $to_date,'off_day' => $off_day,'ph_day' => $ph_day,'reason' => $desp));
                    /* Get leave type */
                    $leave_type   = Input::get('leave_type');
                    $day_count    = Input::get('no_of_days');
                    if(!empty($leave_type) && !empty($day_count) && !empty($insertId)) {
                       foreach($leave_type as $key => $ltype){
                           if(array_key_exists($key,$day_count) && trim($day_count[$key]) != ''){
                               $iStatus = DB::table('il_applied_leaves')->insert(array('fkAppLeaveId' => $insertId,'fkLeaveType' => $ltype,'leave_count' => trim($day_count[$key])));
                           }
                       }
                    }
                    if($iStatus) {
                        if($uRole == 1)
                             return Redirect::to('leave/leave-approval-list')->with('successalert','Leave process updated successfully');
                        else 
                             return Redirect::to('leave/applied')->with('successalert','Leave Applied successfully. Waiting for approval');
                    }
                }
                /* leave end */
                //echo '<pre>'; print_r($insertArray); echo '</pre>';
                /* die();
                $empId      = Input::get('emp_id');
                $leave_type = Input::get('leave_type');
                $from_date  = Input::get('from_date');
                $to_date    = Input::get('to_date');
                $no_of_days = Input::get('no_of_days');
                $desp       = Input::get('desp');
                //$insert = DB::table('il_leave_apply')->insert(array('fkEmpId' => $empId,'fkLeaveType' => $leave_type,'from_date' => $from_date,'to_date' => $to_date,'no_of_days' => $no_of_days,'reason' => $desp));
                /*if($insert)
                    return Redirect::to('leave/type')->with(array('successalert' => 'Leave Type added Successfully'));
                else
                    return Redirect::to('leave/type')->with(array('erroralert' => 'Server problem Try again'));*/
            }
            return View::make('Hrm.leave.applyLeave')->with(array('leave_type' => $getLeaveList,'emp_id' => $emp_id,'emp_list' => $getEmpList));
        }
        
        /*
         * Purpose : Leave Approval listing
         * Return  Boolean value
         */
        public function leaveApprovalListing(){
           $pending_status = Request::Segment(3);
           $postData = Input::all();
           $from = 0;
           $to   = 0;
           $resultList = DB::table('il_leave_apply as al')->join('il_emp_details as emp','emp.id','=','al.fkEmpId')->select('emp.id as emp_id','emp.emp_name','al.id as apply_id','al.from_date','al.to_date','al.off_day','al.ph_day','al.reason','al.status','al.date_created as postedDate');    
           if(!empty($postData)) {
                $from_date    =  Input::get('from_date');
                $to_date      =  Input::get('to_date');
                $from         = date('Y-m-d',strtotime($from_date));
                $to           = date('Y-m-d',strtotime($to_date));
            } else {
                $from = 0;
                $to   = 0;
            }
            if(!empty($from) && !empty($to)) {
                $resultList =   $resultList->where(function($query)use($from,$to) {  
                                 $query->whereBetween('al.from_date',array($from,$to))
                                  ->orwhereBetween('al.to_date',array($from,$to));
                                });
            } 

            
            if(isset($pending_status) && $pending_status!=''){
                $pendingApproval = $resultList->where('al.status',$pending_status);
            } else {
                $pendingApproval = $resultList->whereIn('al.status',array('1','2','3'));
            }
            $pendingApproval = $resultList->get();    
            return View::make('Hrm.approval.leaveApprovalListing')->with(array('p_list' => $pendingApproval,'from' => $from,'to' => $to));
        }

         /*
         * Purpose : Leave Applied for particular user
         * Return  Boolean value
         */
        public function leaveAppliedListing(){
           // echo $this->id;
            $postData = Input::all();
            $from = 0;
            $to   = 0;
           $resultList = DB::table('il_leave_apply as al')->join('il_emp_details as emp','emp.id','=','al.fkEmpId')->select('emp.id as emp_id','emp.emp_name','al.id as apply_id','al.from_date','al.to_date','al.off_day','al.ph_day','al.reason','al.status','al.date_created as postedDate');    
           if(!empty($postData)) {
                $from_date    =  Input::get('from_date');
                $to_date      =  Input::get('to_date');
                $from         = date('Y-m-d',strtotime($from_date));
                $to           = date('Y-m-d',strtotime($to_date));
            } else {
                $from = 0;
                $to   = 0;
            }
            if(!empty($from) && !empty($to)) {
                $resultList =   $resultList->where(function($query)use($from,$to) {  
                                 $query->whereBetween('al.from_date',array($from,$to))
                                  ->orwhereBetween('al.to_date',array($from,$to));
                                });
            } 
            $applied    = $resultList->where('al.fkEmpId',$this->id)->get();
            return View::make('Hrm.leave.leaveAppliedListing')->with(array('applied' => $applied,'from' => $from,'to' => $to));
        }
        
        /*
         * Purpose : Leave Approval process
         * Return  : boolean value
         */
        public function leaveApprovalRow(){
            $approve_type = Request::Segment(3);
            $appId        = Request::Segment(4);
            $updateStatus = DB::table('il_leave_apply')->where('id',$appId)->update(array('status' => $approve_type));
            if($updateStatus)
                return Redirect::to('leave/leave-approval-list')->with('successalert','Leave approval successfully');
            else
                return Redirect::to('leave/leave-approval-list')->with('warningalert','You has click same action,please click alternate option');
        }
        
        /*
         * Purpose : Configure Job Title for leaves count per annual
         * Return boolean value
         */
        public function allocateLeaveForJobTitle(){
            $postData = Input::all();
            if(!empty($postData)) {
                $insertStatus = DB::table('il_leave_config')->insert($postData);
                if($insertStatus)
                    return Redirect::to('leave/entitled-leave-list')->with('successalert','Leave Updated Successfully');
            } else {
                 $jobId  = DB::select(DB::raw('select fkJobTitleId from il_leave_config'));
                if(!empty($jobId)) {
                    foreach($jobId as $jobs) {
                        $jobTitleId[] = $jobs->fkJobTitleId;
                    }
                 $jobTitle = DB::table('il_job_title')->select('id','job_title')->whereNotIn('id', $jobTitleId)->get();
                }
            }
            return View::make('Hrm.leave.configureLeave')->with(array('job_title' => $jobTitle));
        }
        /*
         * Purpose : Listing configured Leave with allocated period
         * Return boolean value or array
         */
        public function allocatedLeaveList() {
            $allocatedList = DB::table('il_leave_config as lc')->join('il_job_title as jt','jt.id','=','lc.fkJobTitleId')->select('lc.id','jt.job_title','lc.overall_allocated_leave as total_leave_per_year','lc.paid_leave','lc.period_from','lc.period_to')->get();
            return View::make('Hrm.leave.allocatedLeaveListing')->with(array('leave_list' => $allocatedList));
            
        }
		
		//update by ganeshbabu on 30-Jun-2014(start)
		public function CashApproval()
		{       
                        $pay_mode = Request::get('pay_mode');
                                if(isset($pay_mode) && $pay_mode != 0)
                                         $payCond = ' AND cin_dtls.pay_mode ='.$pay_mode;
                                        elseif(isset($pay_mode) && $pay_mode == 0)
                                         $payCond = '';
                                        else
                                         $payCond = '';
			if(isset($_GET['branch']))
			{       
				if(is_numeric($_GET['branch']))
				{
					$role    = Session::get('role');
                                	$getApproveFeeList = DB::select(DB::raw('select cus_dtls.customer_name,branch.branch_name,cin_dtls.id as main_id,cin_dtls.fee_update_date,c_dtls.id as contract_id,c_dtls.contract_no,cin_dtls.paid_amt,emp.emp_name,cin_dtls.fee_approval, cin_dtls.pay_mode from il_contract_invoice_details as cin_dtls inner join il_contract_details as c_dtls ON (c_dtls.id = cin_dtls.fkContractId) inner join il_customer_details as cus_dtls ON(c_dtls.fkCustomerId = cus_dtls.id) inner join il_emp_details as emp ON(emp.id = cus_dtls.service_officer_id) inner join il_branch as branch ON(branch.id = cus_dtls.branch) where (cin_dtls.fee_approval = 0 or cin_dtls.fee_approval = 2)'.$payCond.' AND branch.id='.$_GET['branch']));
					return View::make('Hrm.approval.cash_approval')->with(array('user_role' => $role,'approval_list' => $getApproveFeeList));
				}
				else 
				{
					$role    = Session::get('role');
                                        //$pay_mode = Request::get('pay_mode');
                                        //if(isset($pay_mode))
                                         //   $payCond = ' AND cin_dtls.pay_mode ='.$pay_mode;
                                        //else
                                         //   $payCond = '';
					$getApproveFeeList = DB::select(DB::raw('select cus_dtls.customer_name,branch.branch_name,cin_dtls.id as main_id,cin_dtls.fee_update_date,c_dtls.id as contract_id,c_dtls.contract_no,cin_dtls.paid_amt,emp.emp_name,cin_dtls.fee_approval, cin_dtls.pay_mode from il_contract_invoice_details as cin_dtls inner join il_contract_details as c_dtls ON (c_dtls.id = cin_dtls.fkContractId) inner join il_customer_details as cus_dtls ON(c_dtls.fkCustomerId = cus_dtls.id) inner join il_emp_details as emp ON(emp.id = cus_dtls.service_officer_id) inner join il_branch as branch ON(branch.id = cus_dtls.branch) where (cin_dtls.fee_approval = 0 or cin_dtls.fee_approval = 2)'. $payCond));
					return View::make('Hrm.approval.cash_approval')->with(array('user_role' => $role,'approval_list' => $getApproveFeeList));
				}
			}
			else 
			{
				$role    = Session::get('role');
				$getApproveFeeList = DB::select(DB::raw('select cus_dtls.customer_name,branch.branch_name,cin_dtls.id as main_id,cin_dtls.fee_update_date,c_dtls.id as contract_id,c_dtls.contract_no,cin_dtls.paid_amt,emp.emp_name,cin_dtls.fee_approval, cin_dtls.pay_mode from il_contract_invoice_details as cin_dtls inner join il_contract_details as c_dtls ON (c_dtls.id = cin_dtls.fkContractId) inner join il_customer_details as cus_dtls ON(c_dtls.fkCustomerId = cus_dtls.id) inner join il_emp_details as emp ON(emp.id = cus_dtls.service_officer_id) inner join il_branch as branch ON(branch.id = cus_dtls.branch) where (cin_dtls.fee_approval = 0 or cin_dtls.fee_approval = 2)'.$payCond));
				//$getApproveFeeList = DB::select(DB::raw('select cin_dtls.id as main_id,c_dtls.id as contract_id,c_dtls.contract_no,cin_dtls.paid_amt,emp.emp_name,c_dtls.fee_approval, cin_dtls.pay_mode from il_contract_invoice_details as cin_dtls inner join il_contract_details as c_dtls ON (c_dtls.id = cin_dtls.fkContractId) inner join il_customer_details as cus_dtls ON(c_dtls.fkCustomerId = cus_dtls.id) inner join il_emp_details as emp ON(emp.id = cus_dtls.service_officer_id) where (c_dtls.fee_approval = 0 or c_dtls.fee_approval = 2)'));	
				return View::make('Hrm.approval.cash_approval')->with(array('user_role' => $role,'approval_list' => $getApproveFeeList));
			}
		}
		//update by ganeshbabu on 30-Jun-2014(end)
		//update by ganeshbabu on 01-Jul-2014(start)
		public function CashApprovalById($id='')
		{
			date_default_timezone_set('Asia/Kolkata');
			$update = DB::table('il_contract_invoice_details')
						->where('id','=',$id)
						->where('fee_approval','=','0')
						->orwhere('fee_approval','=','2')
						->update(array('fee_approval'=>'1','fee_update_date'=>date('Y-m-d')));
			if($update)
			{
				return Redirect::to('approval/contract-payment-approval')->with('successalert','Approval Process Successfully Updated.');
			}
			else 
			{
				return Redirect::to('approval/contract-payment-approval')->with('erroralert','Sorry!!! Could not update your record.');
			}
		} 
		public function CashRejectById($id='')
		{
			date_default_timezone_set('Asia/Kolkata');
			$update = DB::table('il_contract_invoice_details')
						->where('id','=',$id)
						->where('fee_approval','=','0')
						->orwhere('fee_approval','=','2')
						->update(array('fee_approval'=>'2','fee_update_date'=>date('Y-m-d')));
			if($update)
			{
				return Redirect::to('approval/contract-payment-approval')->with('successalert','Reject Process Successfully Updated.');
			}
			else 
			{
				return Redirect::to('approval/contract-payment-approval')->with('erroralert','Sorry!!! Could not update your record. Because already rejected or approved.');
			}	
		}

        /*
         * Purpose : View all loans that staff applied
         * Return  : array value
         */
        public function appliedLoans() {
            $empId         = $this->id;
            $resultList  = DB::table('il_staff_loan')->select('*');
            $postData = Input::all();
            $from = 0;
            $to   = 0;
            if(!empty($postData)) {
                $from_date = Input::get('from_date');
                $to_date   = Input::get('to_date');
                $from      = date('Y-m-d',strtotime($from_date));
                $to        = date('Y-m-d',strtotime($to_date));
             } else {
                $from = 0;
                $to   = 0;
             }
             if(!empty($from) && !empty($to)) {
                $resultList =   $resultList->where(function($query)use($from,$to) {  
                                 $query->whereBetween('request_date',array($from,$to))
                                  ->orwhereBetween('approve_date',array($from,$to));
                                });
             }

            $appliedLoans = $resultList->where('fkEmpId','=',$empId)->get();
            return View::make('Hrm.staff.appliedLoans')->with(array('appliedLoans' => $appliedLoans,'from' => $from,'to' => $to));
        }

         /*
         * Purpose : Request Loan
         * Return   boolean value
         */
        public function requestLoan(){
                $getEmpList   = DB::table('il_emp_details')->select('id','emp_name')/*->where('user_role','!=',1)*/->where('is_active',1)->get();
                $postData = Input::all();
                if(!empty($postData)) {
                    $empId               = Input::get('emp_id');
                    $request_date        = Input::get('request_date');
                    $request_date        = date('Y-m-d',strtotime($request_date));
                    $loan_amount         = Input::get('amount');
                    $loan_bal_amt        = Input::get('amount');
                    $installment_terms   = Input::get('installment');
                    //$empId         = $this->id;
                    $checkStatus = DB::select(DB::raw('select count(id) as loan_count from il_staff_loan where fkEmpId="'.$empId.'" AND loan_bal_amt!=0 AND status!=2'));
                    if($checkStatus[0]->loan_count == 0) {
                    $insert = DB::table('il_staff_loan')->insert(array('fkEmpId' => $empId,'request_date' => $request_date,
                            'loan_amount' => $loan_amount,'loan_bal_amt' => $loan_bal_amt,'installment_terms' => $installment_terms));
                    if($insert)
                        return Redirect::to('staff/appliedloans')->with(array('successalert' => 'Loan Requested Successfully and Waiting for Approval'));
                    else
                        return Redirect::to('staff/appliedloans')->with(array('erroralert' => 'Server problem Try again'));
                    } else {
                       return Redirect::to('staff/appliedloans')->with(array('erroralert' => 'Loan already pending so you cannot request another'));
                    }
                }
                return View::make('Hrm.staff.requestLoan')->with('emp_list' , $getEmpList);
        }


        /*
         * Purpose : View all loans that all staffs applied
         * Return  : array value
         */
        public function allLoans() {
            if(session::has('cheque')) {
               session::forget('cheque');
            }
            $empId  = $this->id;
            $resultList  = DB::table('il_staff_loan as loan')->join('il_emp_details as emp','emp.id','=','loan.fkEmpId')->leftJoin('il_user_type as type','type.id','=','emp.user_role')->select('loan.*','emp.emp_name','type.user_type');
            $postData = Input::all();
            $from = 0;
            $to   = 0;
            if(!empty($postData)) {
                $from_date = Input::get('from_date');
                $to_date   = Input::get('to_date');
                $from      = date('Y-m-d',strtotime($from_date));
                $to        = date('Y-m-d',strtotime($to_date));
             } else {
                $from = 0;
                $to   = 0;
             }
             if(!empty($from) && !empty($to)) {
                $resultList =   $resultList->where(function($query)use($from,$to) {  
                                 $query->whereBetween('request_date',array($from,$to))
                                  ->orwhereBetween('approve_date',array($from,$to));
                                });
             }
             $loans = $resultList->get();
            return View::make('Hrm.staff.loans')->with(array('loans' => $loans,'from' => $from,'to' => $to));
        }


         /*
         * Purpose : reject Loan by admin
         * Return  : boolean value
         */
        public function rejectLoan() {
            $id = Request::Segment(4);
            $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
            $updateStatus = DB::table('il_staff_loan')->where('id',$id)->update(array('status' => 2,'date_modified' => $currentDate));
            if($updateStatus) {
                return Redirect::to('staff/loans')->with('successalert','Loan Rejected Successfully');
            } else {
                return Redirect::to('staff/loans')->with('erroralert','Server problem Try again');
            }
        }


        /*
         * Purpose : Process Loan
         * Return   boolean value
         */
        public function processLoan() {
            $id    = Request::Segment(3);
            $loan  = DB::table('il_staff_loan as loan')->join('il_emp_details as emp','emp.id','=','loan.fkEmpId')
                    ->leftJoin('il_user_type as type','type.id','=','emp.user_role')->leftJoin('il_emp_job_info as ij','emp.id','=','ij.fkEmpId')
                    ->select('loan.*','emp.emp_name','type.user_type','ij.fkBranchId')->where('loan.id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                /*$request_date        = Input::get('request_date');
                $request_date        = date('Y-m-d',strtotime($request_date));
                $loan_amount         = Input::get('amount');
                $installment_terms   = Input::get('installment');*/
                $branchId            = Input::get('branch');
                $approve_date        = trim(Input::get('approve_date'));
                $approve_date        = date('Y-m-d',strtotime($approve_date));
                $deduction           = trim(Input::get('deduction'));
                $split               = explode("-", $deduction);
                $deduction_start_month = date('m',strtotime($split[0]));
                $deduction_start_year  = $split[1];
                $amount                = trim(Input::get('amount'));
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));

                $checkStatus = DB::select(DB::raw('select count(id) as journal_count from il_accounting_journal_entries'));
                $branch      = DB::table('il_branch')->select('branch_code')->where('id',$branchId)->first();

                    if($checkStatus[0]->journal_count==0) {
                        $invoice_no = "JRNL-".date('Ym').str_pad('1', 3, "0", STR_PAD_LEFT)."/".$branch->branch_code;
                    } else {
                        $count_number = ++$checkStatus[0]->journal_count;
                        $invoice_no   = "JRNL-".date('Ym').str_pad($count_number, 3, "0", STR_PAD_LEFT)."/".$branch->branch_code;
                    }
                    
                    $status=1;

                    $journalInsert = DB::table('il_accounting_journal_entries')
                                    ->insertGetID(
                                        array(
                                            'journal_no' => $invoice_no,
                                            'fkbranch_id' => $branchId,
                                            'date' => $approve_date,
                                            'description' => "Staff Loan",
                                            'approval_for' => $this->id,
                                            'status' => $status,
                                        )
                                    );
                    
                            DB::table('il_accounting_journal_entries_list')
                               ->insert(
                                    array(
                                    'fkjournal_id'=>$journalInsert,
                                    'fkaccount_id'=>4,
                                    'journal_description'=>'Staff Loan',
                                    'debit'=>$amount,
                                    'credit'=>'',
                                    )
                               );

                               DB::table('il_accounting_journal_entries_list')
                               ->insert(
                                    array(
                                    'fkjournal_id'=>$journalInsert,
                                    'fkaccount_id'=>11,
                                    'journal_description'=>'Staff Payables - Loan',
                                    'debit'=>'',
                                    'credit'=>$amount,
                                    )
                               );
                        

                $update = DB::table('il_staff_loan')->where('id',$id)->update(array('approve_date' => $approve_date,'deduction_start_month' => $deduction_start_month,'deduction_start_year' => $deduction_start_year,'status' => 1,'mode' => 2,'date_modified' => $currentDate));
                if($update) {
                    session::put('cheque',1);
                    return Redirect::to('staff/process-loan/'.$id)->with(array('successalert' => 'Loan Approved Successfully'));
                }
                else {
                    return Redirect::to('staff/process-loan/'.$id)->with(array('erroralert' => 'Server problem Try again'));
                }
            }
            return View::make('Hrm.staff.processLoan')->with(array('view' => $loan,'id' => $id));
        }



        /*
         * Purpose : Issue Cheque
         * Return   boolean value
         */
        public function chequeIssue() {
            $id    = Request::Segment(3);
            $account = DB::table('il_accounting_coa_level3 as l3')->join('il_accounting_coa_level4 as l4','l3.id','=','l4.fklevel3_id')
                     ->select('l4.id','l4.level4_name','l4.debit_opening_balance','l4.credit_opening_balance')->whereIn('l3.id',array(1,2))->get();
            $loan  = DB::table('il_staff_loan as loan')->join('il_emp_details as emp','emp.id','=','loan.fkEmpId')->leftJoin('il_user_type as type','type.id','=','emp.user_role')->leftJoin('il_emp_job_info as ij','emp.id','=','ij.fkEmpId')->select('loan.*','emp.emp_name','type.user_type','ij.fkBranchId')->where('loan.id',$id)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                /*$request_date        = Input::get('request_date');
                $request_date        = date('Y-m-d',strtotime($request_date));
                $loan_amount         = Input::get('amount');
                $installment_terms   = Input::get('installment');*/
                $name                = Input::get('name');
                $amount              = Input::get('amount');
                $branchId            = Input::get('branch');
                $date                = trim(Input::get('date'));
                $date                = date('Y-m-d',strtotime($date));
                $bank                = trim(Input::get('bank'));
                $cheque              = trim(Input::get('cheque'));
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));


                     $checkStatus   = DB::select(DB::raw('select count(id) as payment_count from il_accounting_expense_payment'));
                     $branch        = DB::table('il_branch')->select('branch_code')->where('id',$branchId)->first();
                     $expense_count = $checkStatus[0]->payment_count;
                     $expense_count =  ++$expense_count;
                     $payment_no    = "PYMT-".date('Ym'). str_pad($expense_count, 3, "0", STR_PAD_LEFT)."/".$branch->branch_code;
                     $data['fktax_id']  = '';
                     $data['tax_value'] = '';
                     $type              = 1;
                     $approver = $this->id;
                       $paymentInsert = DB::table('il_accounting_expense_payment')->insertGetId(array('payment_no' => $payment_no,'fkbranch_id' => $branchId,
                                     'paid_to' => $name/*,'invoice_no' => $payment_no*/,'date' => $date,'bank_cash_account' => $bank,'cheque_no' => $cheque,'fktax_id' => $data['fktax_id'],'tax_percentage' => $data['tax_value'],
                                     'remarks' => "Loan Paid",'approval_for' => $approver, 'status' => $type));
                     
                            
                                $insert = DB::table('il_accounting_payment_lines')->insertGetId(array('fkPaymentId' => $paymentInsert,
                                             'fkExpenseCoaId' => 11, 'description' => "Loan Paid", 'amount' => $amount));
                            if($type==1) {
                                
                                    $insertArray = array('fktransaction_id' => $paymentInsert,
                                                         'gl_account'       => $bank,
                                                         'amount_type'      => 2,
                                                         'amount'           => $amount,
                                                         'transaction_type' => 4,
                                                         'account_type'     => 3,
                                                         'active_status'    => $type);            
                               $glSelect = DB::table('il_accounting_gl_entry')->select(DB::raw('count(id) as entries'))->where('fktransaction_id',$paymentInsert)->where('transaction_type',4)->first();
                               if($glSelect->entries == 0) {
                                $glInsert = DB::table('il_accounting_gl_entry')->insert($insertArray);
                               }
                            }


                $update = DB::table('il_staff_loan')->where('id',$id)->update(array('bank' => $bank,'cheque_no' => $cheque,'status' => 1,'mode' => 1,'date_modified' => $currentDate));
                
                if($update) {
                    return Redirect::to('staff/loans/')->with(array('successalert' => 'Cheque Issued Successfully'));
                }
                else {
                    return Redirect::to('staff/cheque-issue/'.$id)->with(array('erroralert' => 'Server problem Try again'));
                }
            }
            return View::make('Hrm.staff.issueCheque')->with(array('account' => $account,'view' => $loan,'id' => $id));
        }


        /*
         * Purpose : View Particular loan
         * Return   boolean value
         */
        public function viewLoan() {
            $id    = Request::Segment(3);
            $account = DB::table('il_accounting_coa_level3 as l3')->join('il_accounting_coa_level4 as l4','l3.id','=','l4.fklevel3_id')
                     ->select('l4.id','l4.level4_name','l4.debit_opening_balance','l4.credit_opening_balance')->whereIn('l3.id',array(1,2))->get();
            $loan  = DB::table('il_staff_loan as loan')->join('il_emp_details as emp','emp.id','=','loan.fkEmpId')->leftJoin('il_user_type as type','type.id','=','emp.user_role')->select('loan.*','emp.emp_name','type.user_type')->where('loan.id',$id)->first();
            return View::make('Hrm.staff.viewLoan')->with(array('account' => $account,'view' => $loan,'id' => $id));
        }

        /*
         * Purpose : edt Race
         * Return   boolean value
         */
        public function configBank(){
            $bank = DB::table('il_bank_config')->select('bank','branch','account_no','id')->where('id',1)->first();
            $postData = Input::all();
            if(!empty($postData)) {
                $bank       = Input::get('name');
                $branch     = Input::get('branch');
                $account_no = Input::get('account_no');
                $currentDate  = date('Y-m-d H:i:s',strtotime('now'));
                $update = DB::table('il_bank_config')->where('id',1)->update(array('bank' => $bank,'branch' => $branch,'account_no' => $account_no,'date_modified' => $currentDate));
                if($update)
                    return Redirect::to('company/config/bank')->with(array('successalert' => 'Bank Details updated Successfully'));
                else
                    return Redirect::to('company/config/bank')->with(array('erroralert' => 'Server problem Try again'));
            }
            return View::make('Hrm.bankConfig')->with(array('view' => $bank,'id' => 1));
        }
         
                
                
                
         public function ajaxCall() {
             if(Request::ajax()){
                 $postData = Input::all();
                 $actionCall = Input::get('action');
                 if($actionCall == 'getAppliedLeave') {
                     $availArray = array();
                     $applyId = Input::get('appId');
                     $getLeaveInfo = DB::table('il_applied_leaves as al')->join('il_leave_apply as lapp','lapp.id','=','al.fkAppLeaveId')->join('il_leaves as l','l.id','=','al.fkLeaveType')->select('l.id as leave_id','l.leave_type','l.leave_count as l_entitled','al.leave_count as l_applied')->where('lapp.id',$applyId)->get();
                     if(!empty($getLeaveInfo)){
                         echo json_encode($getLeaveInfo);
                     } else {
                         echo 0;
                     }
                 } elseif($actionCall == 'checkAvailedLeave') {
                     $empId     = Input::get('empId');
                     $l_type    = Input::get('l_type');
                     $from_date = Input::get('from_date');
                     $lmonth    = date('n',strtotime($from_date));
                     $sYear   = (date('Y')).'-01-01';
                     $eYear   = date('Y-m').'-'.date('t');
                     $getAvailedLeaveCount = DB::select(DB::raw("select sum(al.leave_count) as l_availed,l.leave_count as leave_entitled from il_applied_leaves as al join il_leave_apply as lapp ON(lapp.id = al.fkAppLeaveId) join il_leaves as l ON(l.id = al.fkLeaveType) where  lapp.fkEmpId ='".$empId."' and lapp.status = 1 and al.fkLeaveType ='".$l_type."' and lapp.from_date between '".$sYear."' and '".$eYear."' and lapp.to_date between '".$sYear."' and '".$eYear."'"));
                     $getAvail = $getAvailedLeaveCount[0];
                     if($getAvail->leave_entitled != 0){
                        if($getAvail->l_availed > 0) {
                            $leave_limit = round(($getAvail->leave_entitled/12)*$lmonth);
                            $leave_avail = $leave_limit - (int)$getAvail->l_availed;
                            echo trim($leave_avail); 
                        } else {
                            $leave_avail = round(($getAvail->leave_entitled/12)*$lmonth);
                            echo trim($leave_avail);
                        }
                     } elseif($getAvail->leave_entitled == 0) {
                         echo '-1';
                     } else {
                         echo 0;
                     }
                 }
             }
         }
}
?>