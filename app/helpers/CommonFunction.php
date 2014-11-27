<?php
class CommonFunction {
    
    public static function calculateDuration($startTime,$endTime) {
        if($endTime != '00:00:00') {
          $inTime  = new DateTime($startTime);
          $outTime = new DateTime($endTime);
          $interval = $inTime->diff($outTime);
          if(!empty($interval)) {
              $duration = '';
              $hrsArray = array('h','i','s');
              foreach($interval as $key => $list) {
                  if(in_array($key,$hrsArray))
                          if($list != 0)
                           $duration .= str_pad($list, 2, '0', STR_PAD_LEFT).':';
                          else
                           $duration .= '00:';
              }
              return  trim($duration,':');
          } 
         } else {
              return '00:00:00';
         }
      }
     
      /* 
       * Purpose : The function returns the no. of business days between two dates and it skips the holidays
       * Param   : $startdate, $endData,$holiday list
       * Return  : Interger as no of working date
       * 
       */ 
    public static function getWorkingDays($startDate,$endDate,$holidays){
                // do strtotime calculations just once
                $endDate = strtotime($endDate);
                $startDate = strtotime($startDate);
                //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
                //We add one to inlude both dates in the interval.
                $days = ($endDate - $startDate) / 86400 + 1;
                $no_full_weeks = floor($days / 7);
                $no_remaining_days = fmod($days, 7);
                //It will return 1 if it's Monday,.. ,7 for Sunday
                $the_first_day_of_week = date("N", $startDate);
                $the_last_day_of_week = date("N", $endDate);
                //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
                //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
                if ($the_first_day_of_week <= $the_last_day_of_week) {
                    if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
                    if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
                }
                else {
                    // (edit by Tokes to fix an edge case where the start day was a Sunday
                    // and the end day was NOT a Saturday)
                    // the day of the week for start is later than the day of the week for end
                    if ($the_first_day_of_week == 7) {
                        // if the start date is a Sunday, then we definitely subtract 1 day
                        $no_remaining_days--;
                        if ($the_last_day_of_week == 6) {
                            // if the end date is a Saturday, then we subtract another day
                            $no_remaining_days--;
                        }
                    }
                    else {
                        // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
                        // so we skip an entire weekend and subtract 2 days
                        $no_remaining_days -= 2;
                    }
                }
                //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
            //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
               $workingDays = $no_full_weeks * 5;
                if ($no_remaining_days > 0 )
                {
                  $workingDays += $no_remaining_days;
                }
                //We subtract the holidays
                foreach($holidays as $holiday){
                    $time_stamp=strtotime($holiday);
                    //If the holiday doesn't fall in weekend
                    if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
                        $workingDays--;
                }

                return $workingDays;
            }
      /*
       * Purpose : Calculate the hours,minutes,seconds
       * Param : $no_of_days integer no of days 
       * return time format array value
       */      
       public static function convertTimeFormat($no_of_days) {
             // extract hours
            $seconds = 3600 * 8 * $no_of_days;
            $hours = floor($seconds / (60 * 60));

            // extract minutes
            $divisor_for_minutes = $seconds % (60 * 60);
            $minutes = floor($divisor_for_minutes / 60);

            // extract the remaining seconds
            $divisor_for_seconds = $divisor_for_minutes % 60;
            $seconds = ceil($divisor_for_seconds);

            // return the final array
            $obj = array(
                "h" => (int) $hours,
                "m" => (int) $minutes,
                "s" => (int) $seconds,
            );
            return $obj;
       }
            
       /*
        * Purpose : Convert time to seconds
        * Return no of seconds
        */
       public static function seconds_from_time($time) { 
           list($h, $m, $s) = explode(':', $time); 
           return ($h * 3600) + ($m * 60) + $s; 
       } 
       /*
        * Purpose : Convert seconds to time
        * Return time format HH:MM::SS
        */
       public static function time_from_seconds($seconds) { 
            $h = floor($seconds / 3600); 
            $m = floor(($seconds % 3600) / 60); 
            $s = $seconds - ($h * 3600) - ($m * 60); 
            return sprintf('%02d:%02d:%02d', $h, $m, $s); 
       } 
       /*
        * Purpose : Calculate Overtime 
        * Param : $total_emp_work_hrs Total Worked hrs in time format HH:MM:SS,$total_month_work_hrs in no of hrs
        * return if true return hrs in time format else false
        */
       public static function calculate_overtime($total_emp_work_hrs,$total_month_work_hrs) {
          $total_emp_work_in_seconds    =  CommonFunction::seconds_from_time($total_emp_work_hrs);
          $total_month_work_in_seconds  =  $total_month_work_hrs * 3600;
          if( $total_emp_work_in_seconds > $total_month_work_in_seconds ) {
               $cal_sec = $total_emp_work_in_seconds - $total_month_work_in_seconds;
               $over_time_hrs = CommonFunction::time_from_seconds($cal_sec);
               return $over_time_hrs;
          } else {
              return '-';
          }
       }
       
        /*
        * Purpose : Calculate salary for overtime 
        * Param : $overtime in time format,$per_hrs_rate
        * return interger as total amount for overtime
        */
        public static function calculate_salary_overtime($overtime,$per_hrs_rate) {
            list($h, $m, $s) = explode(':',$overtime);
            $oSalary = '';
            $oSalary = (double)$h * (double)$per_hrs_rate;
            if($m != 00) {
                $oSalary = $oSalary +((double)$m / 60) * (double)$per_hrs_rate;
            }
            return $oSalary;
        }
        
        /*
         * Purpose : Calculate Commission for contract closure
         * Param   : No of Contract
         * return  : interger total Commission amount per contract 
         */
        public static function calculate_commission_amt($no_of_contracts,$commission_config) {
            /* Contract logic
               fixed commission per contract ( if 1 to 12 contract as $50) per contract
               Greater than 12 contract closure - 60$ per contract
            */
            foreach($commission_config as $cclist) {
                if($cclist->cost_type == 1) {// get contract costing as type 1
                    if($cclist->range_type == 1) {
                        $contract1_min_range = $cclist->min_range;
                        $contract1_max_range = $cclist->max_range;
                        $contract1_per_cost  = $cclist->per_cost;
                    } else {
                        $contract2_exmin_range = $cclist->min_range;
                        $contract2_per_cost    = $cclist->per_cost;
                    }
                } else if($cclist->cost_type == 2) {
                     if($cclist->range_type == 1) {
                        $bonus1_min_range = $cclist->min_range;
                        $bonus1_max_range = $cclist->max_range;
                        $bonus1_per_cost  = $cclist->per_cost;
                    } else {
                        $bonus2_exmin_range = $cclist->min_range;
                        $bonus2_per_cost    = $cclist->per_cost;
                    }
                }
            }
            if($no_of_contracts != 0) { 
                if($no_of_contracts >  $contract2_exmin_range) { // greater than max value
                    $contract_60 = $no_of_contracts - $contract2_exmin_range;
                    $contract_60 = $contract_60  * $contract2_per_cost;    
                    $contract_50 = $contract1_max_range * $contract1_per_cost;
                    $commission_amt =  $contract_50  +  $contract_60; 
                } elseif($no_of_contracts <= $contract1_max_range) { // within ranges
                    $commission_amt  =  $no_of_contracts * $contract1_per_cost;
                }
            } else {
                $commission_amt = 0.00;
            }
            /*
             * Bonus logic
             * For 13 to 15 contracts closure - 200$
             * Greater than  15 contracts - 500$
             */
            if($no_of_contracts >= $bonus1_min_range && $no_of_contracts <= $bonus1_max_range) {
                $bonus =  $bonus1_per_cost;
            } elseif($no_of_contracts > $bonus2_exmin_range) { // greater than 12
                $bonus =  $bonus2_per_cost; 
            } else {
                $bonus =  0.00; 
            }
            $commission_array = $commission_amt + $bonus; //array($commission_amt,$bonus);
            return $commission_array;
        }
        
        /*
         * Purpose display collected fee amount
         * return vaue
         */
        public static function displayFeeCollected($admin_fee,$insurance_fee,$agency_fee) {
                  if($admin_fee!=0.00) {
                    $collected_fee = 'Admin Fee';
                  } 
                  if($insurance_fee!=0.00) {
                    if(empty($collected_fee)) {
                      $collected_fee = 'Insurance Fee';
                    } else {
                      $collected_fee .= ', Insurance Fee';
                    }
                  }
                  if($agency_fee!=0.00) {
                    if(empty($collected_fee)) {
                      $collected_fee = 'Agency Fee';
                    } else {
                      $collected_fee .= ', Agency Fee';
                    }
                  }
                  if($admin_fee==0.00 && $insurance_fee==0.00 && $agency_fee==0.00) {
                    $collected_fee = 'No Fee Collected';
                  }
                  return $collected_fee;
        }
        
        
        /*
         * Purpose : Calculate working per month
         * Param   : $month as integer,$year as integer,$calendar type as array
         * Return  : Interger No of days of working
         */
        public static function CalculateWorkingPerMonth($pMonth,$pYear,$calType,$calInfo) {
            $timestamp = mktime(0,0,0,$pMonth,1,$pYear);
            $maxday    = date("t",$timestamp);
            $wd        = 0;
            for ($j=1; $j <=$maxday; $j++) {
                   $mdate = $pYear.'-'.str_pad($pMonth, 2 ,0,STR_PAD_LEFT).'-'.str_pad($j, 2 ,0,STR_PAD_LEFT);
                   $cdt = date('w',strtotime($mdate));
                   if(array_key_exists($calType,$calInfo) && in_array($cdt,$calInfo[$calType])) {
                       $wd = $wd+ 1;
                   } 
            }
            return $wd;
        }
        
        /*
         * Purpose : Calculate no pay leave base calendar type excluding offer days(resign,hire,terminated employees) in salary process month
         * Param   : $month as integer,$year as integer,$calendar type as array,$sCal as cal start,$eCal as end Cal
         * Return  : Interger No of no-pay-leave exclude off days
         */
        public static function CalculateEmpWorkDays($pMonth,$pYear,$sCal,$eCal,$calType,$calInfo) {
            $timestamp = mktime(0,0,0,$pMonth,1,$pYear);
            $sday      = $sCal;
            $maxday    = $eCal;
            $wd        = 0;
            for ($j=$sday; $j <=$maxday; $j++) {
                   $mdate = $pYear.'-'.str_pad($pMonth, 2 ,0,STR_PAD_LEFT).'-'.str_pad($j, 2 ,0,STR_PAD_LEFT);
                   $cdt = date('w',strtotime($mdate));
                   if(array_key_exists($calType,$calInfo) && in_array($cdt,$calInfo[$calType])) {
                       $wd = $wd+ 1;
                   } 
            }
            return $wd;
        }
        
        /*
         * Purpose display notification content 
         * return html content
         */
        public static function showNotification(){
            $logId    = Session::get('id');
            $role     = Session::get('role');
            $vhtml ="";
            $getFollowNotification = DB::table('il_lead_entries as lead')->leftJoin('li_followup_lead as flead','lead.id','=','flead.fkLeadId')->select('lead.id as lead_id','customer_name','lead.dateCreated')->where('lead.service_officer_id',$logId)->where('lead.is_delete',0)->where('lead.status','!=',1)->where('flead.id','=',NULL)->groupBy('lead.id')->orderBy('lead.id','desc')->get();
            if(!empty($getFollowNotification)) {
            $vhtml .="<li class='dropdown medium only-icon widget'>
            <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
              <i class='icon-rss'></i>
              <div class='label'>".sizeOf($getFollowNotification)."</div>
            </a>
            <ul class='dropdown-menu'>";
            foreach($getFollowNotification as $list) { 
            $vhtml .="<li>
                <a href='".URL::to('lead/'.base64_encode($list->lead_id))."'>
                  <div class='widget-body'>
                    <div class='pull-left icon'>
                      <i class='icon-user text-success'></i>
                    </div>
                    <div class='pull-left text'>".$list->customer_name."
                      <small class='text-muted'> - ".CommonFunction::calculateTimeStampDtls($list->dateCreated)."</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class='divider'></li>";
              }
               $vhtml .="</ul>
          </li>";
         }
          return $vhtml;
        }
        
        /**
	 * calculate year,month,day,hour,minutes,seconds
	 *
	 * @param string $datetime Current timestamp values
	 * @return string with year,month,day etc
	 */
	public static function calculateTimeStampDtls($datetime1) {
				$datetime2 = date('Y-m-d H:i:s',strtotime('now'));
                                $diff      = abs(strtotime($datetime2) - strtotime($datetime1)); 
                                $years     = floor($diff / (365*60*60*24)); 
                                $months    = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                                $days      = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                $hours     = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
                                $minuts    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
                                $seconds   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 
				$quantities = array('year'   => $years,
						    'month'  => $months,
						    'week'   => floor($days/7),
						    'day'    => $days ,
						    'hour'   => $hours,
						    'minute' => $minuts,
                                                    'second' => $seconds);
                                $str 		= '';
				foreach($quantities as $unit => $value) {
					if($value == 0) continue;
					$str .= $value . ' ' . $unit;
					if($value != 1) {
						$str .= 's';
					}
					$str .=  ', ';
				}
				$str = $str == '' ? 'a moment ' : substr($str, 0, -2);
				$str = current(explode(',',$str));
				return $str.' ago';	
	}
        
}
?>