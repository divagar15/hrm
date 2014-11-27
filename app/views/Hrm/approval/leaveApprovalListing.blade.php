@extends('layouts.master')
<?php
$approval_status = Config::get('local.fee_approval');
?>
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Leave Approval Listing</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>                               
                                <i class='icon-folder-open '></i>
                                HRM
                                </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li> Leave</li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">Leave Approval Listing</li>
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
                        @if(Session::has('warningalert'))
                        <div class="alert alert-warning alert-dismissablee">
                               <a class="close" href="#" data-dismiss="alert">× </a>
                                   <h4>
                                   <i class="icon-exclamation-sign"></i>
                                   Warning
                                   </h4>
                                {{Session::get('warningalert')}}
                        </div>
                        @endif
                      <!-- alert box section end -->

                                          <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Leave Filter</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{URL::to('leave/leave-approval-list')}}" name="frmleave" id="frmleave" method="post" style='margin-bottom: 0;'>
                          <div class="form-group">
                                    <label class='control-label col-sm-3' for='from_date'>From</label>
                                     <div class='controls col-sm-6 input-group'>
                                          <input class='form-control datepicker' id='from_date' name='from_date'  data-rule-required="true" placeholder='DD-MM-YYYY' type='text' value="@if($from!=0){{ date('d-m-Y',strtotime($from)) }}@endif" /> 
                                          <span class="input-group-addon">
                                           <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                          </span>
                                     </div>
                                     <div class='col-sm-9 pull-right'> 
                                          <span class="help-block has-error" for="from_date"></span>
                                     </div>
                            </div>
                            <div class="form-group">
                                    <label class='control-label col-sm-3' for='to_date'>To</label>
                                     <div class='controls col-sm-6 input-group'>
                                          <input class='form-control datepicker' id='to_date' name='to_date'  data-rule-required="true" placeholder='DD-MM-YYYY' type='text' value="@if($to!=0){{ date('d-m-Y',strtotime($to)) }}@endif" /> 
                                          <span class="input-group-addon">
                                           <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                          </span>
                                     </div>
                                     <div class='col-sm-9 pull-right'> 
                                          <span class="help-block has-error" for="to_date"></span>
                                     </div>
                            </div>
                                       
                          <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-5">
                                      <div class="btn-toolbar">
                                        <button class="btn-primary btn" type="submit">Submit</button>
                                        <a class="btn-default btn resetbtn" href="{{ URL::to('leave/leave-approval-list'); }}" type="button">Cancel</a>
                                   </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                      </div>

                    <div class='row' style="margin-left:0px;">
			                <div class='col-sm-12'>
			                  <div class='box bordered-box blue-border' style='margin-bottom:0; width: 100%;'>
			                    <div class='box-header blue-background'>
			                      <div class='title'>Leave Approval Listing</div>
			                    </div>
			                    <div class='box-content box-no-padding'>
			                      <div class='responsive-table'>
			                        <div class='scrollable-area'>
			                          <table class='data-table-column-filter table table-bordered table-striped dataTable' style='margin-bottom:0; width:100%;'>
			                            <thead>
			                              <tr width="30%">
			                                 <!--  <th><input id="checkAll" class="checklist" type="checkbox"  value="-1" name="approve[]"></th> -->
			                                <th>Employee Name</th>
			                                <th>From Date</th>
			                                <th>To Date</th>
			                                <th>Include Off</th>
			                                <th>Include Public Holiday</th>
                                                        <th>Reason</th>
			                                <th>Status</th>
                                                        <th>Applied Date</th>
			                                <th>Action</th>
			                              </tr>
			                            </thead>
			                            <tbody>
                                                     @if(!empty($p_list))   
			                             @foreach($p_list as $alist)
			                              <tr>
			                                <!-- <td><input class="checklist" type="checkbox" value="{{ $alist->apply_id }}" name="approve[]" /></td> -->
                                                        <td><a class="view-leave has-popover" data-toggle='modal' data-empid= "{{ $alist->emp_id }}" data-from="{{ date('d-m-Y',strtotime($alist->from_date)) }}" data-to="{{ date('d-m-Y',strtotime($alist->to_date)) }}" data-off="{{ $alist->off_day == 1 ? 'No' : 'Yes' }}" data-ph="{{ $alist->ph_day == 1 ? 'No' : 'Yes' }}" data-appid="{{ $alist->apply_id }}" href="#leave_list_info">{{ ucwords($alist->emp_name) }}</a></td>
			                                <td>{{ date('d-m-Y',strtotime($alist->from_date)) }}</td>
			                                <td>{{ date('d-m-Y',strtotime($alist->to_date)) }}</td>
			                                <td>{{ $alist->off_day == 1 ? 'No' : 'Yes' }}</td>
			                                <td>{{ $alist->ph_day == 1 ? 'No' : 'Yes' }}</td>
			                                <td>{{ substr($alist->reason,0,100).'...' }}</td>
                                                        <td> @if($alist->status == 2) {{ 'Rejected' }} @elseif($alist->status == 3) {{ 'Pending' }} @elseif($alist->status == 1) {{ 'Approved' }} @endif</td>
                                                        <td>{{  date('d-m-Y',strtotime($alist->postedDate)) }}</td>
			                                <td>
                                                          @if($alist->status != 1)  
			                                  <a href="{{URL::to('leave/approval-type/1/'.$alist->apply_id)}}" title="" class="btn btn-success btn-xs">Approve</a>
			                                  <a href="{{URL::to('leave/approval-type/2/'.$alist->apply_id)}}" title="" class="btn btn-danger btn-xs">Reject</a>
                                                          @else
                                                           <button class='btn btn-xs'>Approved</buttom>
                                                          @endif
                                                        </td>
			                              </tr>
			                              @endforeach
                                                      @endif
			                            </tbody>
			                          </table>
			                          
			                        </div>
			                      </div>
			                    </div>
			                    <!-- <div class="row">
			                        <div class="pull-right"><a href="javascript:" class="btn btn-primary" onclick="return changeStatus(1);" style="margin-right:4px; margin-top: 10px;">Approve</a><a href="javascript::" onclick="return changeStatus(2);" class="btn btn-primary" style='margin-top: 10px;'>Reject</a></div>
			                    </div> -->
			                </div>
			              </div>
			         	 </div>
	          </div>
                </div>
              </div>
       </div>
</div>
<!-- popup details -->
                    <div class='modal fade' id='leave_list_info' tabindex='-1'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                            <h4 class='modal-title' id='myModalLabel'>View Applied Leave Details</h4>
                          </div>
                          <div class='modal-body'>
                              <p><strong>From Date</strong>&nbsp;:<span id="pfrom_date"></span></p>
                              <p><strong>To Date</strong>&nbsp;:<span id="pto_date"></span></p>
                              <p><strong>Including Off Day</strong>&nbsp;:<span id="inc_off"></span></p>
                              <p><strong>Including Public Holiday Day</strong>&nbsp;:<span id="inc_ph"></span></p>
                              <table id="theader" width="90%" border="1">
                              </table>
                          </div>
                          <div class='modal-footer'>
                            <a href="" title="" id="p_approve" class="btn btn-success btn-xs">Approve</a>
			    <a href="" title="" id="p_reject" class="btn btn-danger btn-xs">Reject</a>
			    <button class='btn btn-default btn-xs' data-dismiss='modal' type='button'>Close</button>
                          </div>
                        </div>
                      </div>
                    </div
                    <!-- popup end details -->
@include('includes.jscript')
<script type="text/javascript">
    $(document).ready(function(){

        
      $('.datepicker').datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true,
         });

        var dateStart = $('#from_date')
        .datepicker({
            startDate: new Date()
        })
        .on('changeDate', function(ev){
            dateEnd.datepicker('setStartDate', ev.date);
            dateStart.datepicker('hide');
            dateEnd.focus();
        });

        var dateEnd = $('#to_date')
        .datepicker()
        .on('changeDate', function(ev){
            dateStart.datepicker('setEndDate', ev.date);
            dateEnd.datepicker('hide');
        });


        var applyId,empId;
        $('.view-leave').click(function(){
          applyId = $(this).data('appid');
          empId   = $(this).data('empid');
          $('#inc_off').html($(this).data('off'));
          $('#inc_ph').html($(this).data('ph'));
          $('#pfrom_date').html($(this).data('from'));
          $('#pto_date').html($(this).data('to'));
          $('#p_approve').prop('href',actionPath+'leave/approval-type/1/'+applyId);
          $('#p_reject').prop('href',actionPath+'leave/approval-type/2/'+applyId);
          var vhtml ='';
          $.ajax({
             type : 'POST',
             url  : actionPath+'hrm/ajax-call',
             data : 'action=getAppliedLeave&empId='+empId+'&appId='+applyId,
             success:function(response){
                 if(response != 0){
                     $('#theader').html('');
                      vhtml +='<tr>';
                      vhtml +='<th>Leave Type</th>';
                      vhtml +='<th style="text-align: center;">No of days</th>';
                      vhtml +='</tr>';
                     var obj = $.parseJSON(response);
                     $.each(obj,function(i,val){
                         vhtml += '<tr>'; 
                         vhtml += '<td>'+$.ucfirst(val.leave_type)+'</td><td align="center">'+val.l_applied+'</td>';
                         vhtml += '</tr>';
                     });
                     $('#theader').append(vhtml);
                 }
             }
          });
          //alert(applyId);
       });
    });
</script>
@stop