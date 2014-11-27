@extends('layouts.master')
@section('content')
<?php 
function calculateDuration($punchIn,$punchOut) {
  if($punchOut != '00:00:00') {
    $inTime  = new DateTime($punchIn);
    $outTime = new DateTime($punchOut);
    $interval = $inTime->diff($outTime);
    if(!empty($interval)) {
        $duration = '';
        $hrsArray = array('h','i','s');
        $hrs       = array('h' => 'hrs', 'i' => 'min','s' => 'sec');
        
        foreach($interval as $key => $list) {
            if(in_array($key,$hrsArray) && $list != 0)
                $duration .= $list.'&nbsp;'.$hrs[$key].':';
        }
        echo trim($duration,':');
    } 
  } else {
        echo '-';
    }
}

//The function returns the no. of business days between two dates and it skips the holidays
/*function getWorkingDays($startDate,$endDate,$holidays){
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
$holidays=array("2014-01-01","2014-01-26");
echo getWorkingDays("2014-01-01","2014-01-31",$holidays);
    */
?>
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Attendance Records</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>
                                <a href="javascript::">
                                <i class="icon-bar-chart"></i>
                                </a>HRM
                                </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">Attendance Records</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                     <!-- alert box section -->
                        @if(Session::has('successalert'))
                        <div class="alert alert-success alert-dismissable">
                               <a class="close" href="#" data-dismiss="alert">× </a>
                                   <h4>
                                   <i class="icon-ok-sign"></i>
                                   Success
                                   </h4>
                                {{Session::get('successalert')}}
                        </div>
                        @endif
                        @if(Session::has('erroralert'))
                        <div class="alert alert-danger alert-dismissablee">
                               <a class="close" href="#" data-dismiss="alert">× </a>
                                   <h4>
                                   <i class="icon-warning-sign"></i>
                                   Error
                                   </h4>
                                {{Session::get('erroralert')}}
                        </div>
                        @endif
                     <!-- alert box section end -->
                    <div class='box-header  blue-background'>
                      <div class='title'>Attendance Log Records</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>Employee Name</th>
                                <th>Attend Date</th>
                                <th width="10%">Punch-In</th>
                                <th width="5%">Punch-In note</th>
                                <th width="7%">Punch-Out</th>
                                <th width="5%">Punch-Out note</th>
                                <th width="2%">Duration(hours)</th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($attendance_list)) 
                             @foreach($attendance_list as $view) 
                                <tr>
                                <td>{{ $view->emp_name }}</td>
                                <td>{{ date('d-m-Y',strtotime($view->attend_date)) }}</td>
                                <td>{{ $view->punch_in }}</td>
                                <td>{{ $view->punchIn_note }}</td>
                                <td>{{ $view->punch_out }}</td>
                                <td>{{  $view->punchOut_note }}</td>
                                <td>{{ calculateDuration($view->attend_date.' '.$view->punch_in,$view->attend_date.' '.$view->punch_out) }}</td>
                              </tr> 
                             @endforeach
                             @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
       </div>
</div>
@include('includes.jscript')
@stop