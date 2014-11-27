@extends('layouts.master')
 <?php
 $baseUrl    = Config::get('local.baseUrl');
 $arrLen     =  sizeof($leave_type);
 $userRole   = Session::get('role');
 $userId     = Session::get('id');
 $firstName   = Session::get('log_name');
 ?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Leave Apply</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                            <i class='icon-folder-open '></i>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li>
                          Hrm
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Leave Apply</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class='col-sm-12'>
                       <div class="row">
                        <div class="col-sm-12">
                        <div class="pull-right">
                        </div>
                        </div>
                        </div>  
                      <div class='box'>
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
                      <div class='box-header blue-background'>
                        <div class='title'>Leave Apply</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('leave/apply-leave') }}" name="frmleave" id="frmleave" method="post" style='margin-bottom: 0;'>
                            <div class='form-group'>
                                <label class='control-label col-sm-3' for='emp_name'>Employee Name</label>
                                <div class='col-sm-6 controls'>
                                    <input type="hidden" id="h_count" name="h_count" value='0' />
                                    @if($userRole == 1)
                                        <select id="emp_id" class="form-control select2" name="emp_id" data-rule-required="true">
                                            <option value="">Select Employee Name</option>
                                            @if(!empty($emp_list))
                                              @foreach($emp_list as $clist) 
                                            <option value="{{ $clist->id }}">{{ ucwords($clist->emp_name) }}</option>
                                              @endforeach
                                            @endif
                                        </select>
                                    @else
                                        <input type="hidden" id="emp_id" name="emp_id" value='{{ $userId }}' />
                                        <label class='control-label col-sm-3' for='emp_name'>{{ $firstName }}</label>
                                    @endif
                                </div>
                             </div>
                            <div class="form-group">
                                    <label class='control-label col-sm-3' for='from_date'>From Date</label>
                                     <div class='controls col-sm-6 input-group'>
                                          <input class='form-control datepicker' id='from_date' name='from_date'  data-rule-required="true" placeholder='DD-MM-YYYY' type='text' /> 
                                          <span class="input-group-addon">
                                           <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                          </span>
                                     </div>
                                     <div class='col-sm-9 pull-right'> 
                                          <span class="help-block has-error" for="from_date"></span>
                                     </div>
                            </div>
                            <div class="form-group">
                                    <label class='control-label col-sm-3' for='to_date'>To Date</label>
                                     <div class='controls col-sm-6 input-group'>
                                          <input class='form-control datepicker' id='to_date' name='to_date'  data-rule-required="true" placeholder='DD-MM-YYYY' type='text' /> 
                                          <span class="input-group-addon">
                                           <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                          </span>
                                     </div>
                                     <div class='col-sm-9 pull-right'> 
                                          <span class="help-block has-error" for="to_date"></span>
                                     </div>
                            </div>
                             <div class='form-group'>
                                  <label class='control-label col-sm-3' for='from_date'>Leave Type</label>
                                <div class='col-sm-6 controls'>
                                    <select id="leave_type_1" class="form-control leave_type" name="leave_type[]" data-rule-required="true">
                                        @if(!empty($leave_type))
                                          @foreach($leave_type as $clist) 
                                          <option value="{{ $clist->id }}">{{ ucwords($clist->leave_type) }}</option>
                                          @endforeach
                                        @endif
                                   </select>
                                </div> 
                            </div>
                            <div class="form-group">
                                     <label class='control-label col-sm-3' for='no_of_days'>No of Days</label>
                                     <div class='controls col-sm-6' id="no_of_days">
                                          <input class='form-control cal-days' id='no_of_days_1' name='no_of_days[]'  data-rowid="1" data-rule-required="true" data-rule-minlength="1" placeholder='No of days' type='text' /> 
                                     </div>
                           </div>
                            <div class="row" id="add_row" style="margin-left:1px;">
                              
                            </div>

                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                  <button class="btn-primary btn" type="button" id="add-row-btn">Add Row</button>
                              </div>
                            </div>
                            
                            <div class="form-group" style="margin-top:5px;">
                                     <label class='control-label col-sm-3' for='reason'>Including Off Days</label>
                                     <div class='controls col-sm-6' id="reason">
                                         <input type="checkbox" name="off_day" id="off_day" value="2" />&nbsp;Include Off Days
                                     </div>
                           </div>
                            <div class="form-group">
                                     <label class='control-label col-sm-3' for='reason'>Including Public Holiday Days</label>
                                     <div class='controls col-sm-6' id="reason">
                                         <input type="checkbox" name="ph_day" id="ph_day"  value="2" />&nbsp;Include Public Holiday Days
                                     </div>
                           </div>
                           <div class="form-group">
                                     <label class='control-label col-sm-3' for='reason'>Reason (If any)</label>
                                     <div class='controls col-sm-6' id="reason">
                                         <textarea class="form-control" id='desp' name="desp"  data-rule-minlength="5"  placeholder='Reason (If any)'></textarea>
                                     </div>
                           </div>      
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar" id="edit-mode">
                                          <button class="btn-primary btn" type="submit" id="add-btn">Submit For Approval</button>
                                          <!-- <button class="btn-primary btn" type="button" id="add-row-btn">Add Row</button> -->
                                      </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                      </div>
                    </div>
        </div>
      </div>
    </div>
@include('includes.jscript')
<script type="text/javascript">
    //var selected_leave_type = [];
    $(document).ready(function(){
    $('#h_count').val(0);
    $('.cal-days').live('keyup',function(){
        var txtVal    = $(this).val();
        var rowId     = $(this).data('rowid');
        var leaveType = $.trim($('#leave_type_'+rowId).val());
        var empId     = $.trim($('#emp_id').val());
        var from_date = $.trim($('#from_date').val());
        
        if(txtVal != '' && empId != '' && from_date !='') {
            $.ajax({
               type : 'POST',
               url  : actionPath+'hrm/ajax-call',
               data : 'action=checkAvailedLeave&empId='+empId+'&l_type='+leaveType+'&from_date='+from_date,
               success:function(response){
                   response  = $.trim(response);
                   if(response > 0) {
                       if(parseInt(txtVal) > parseInt(response)) {
                           alert('You have elibable to apply for maximum '+response+' days only');
                           $('#no_of_days_'+rowId).val($.trim(response));
                       } 
                   }
               }
            });
        }  else {
            alert('Please specify the employee name or from date and to date');
            $('#no_of_days_'+rowId).val('');
        }
    });
    
    $('#add-row-btn').live('click',function(){
       var counter = 0;
        var vhtml = '';
        var len        = '<?php echo $arrLen; ?>';
        var cVal = $('#h_count').val();
        if(parseInt(cVal)<parseInt(len)) {
          /*$('#h_count').val(parseInt(cVal) + 1);
          cVal = $('#h_count').val();*/
        }
        var crow; 
        var selected_leave_type = [];
        var lstatus = 1;
        var leave_type = '<?php echo json_encode($leave_type); ?>';
        
        var obj        = $.parseJSON(leave_type);
                $(".leave_type").each(function(){
                    if($.isNumeric($(this).val()))
                      selected_leave_type.push(parseInt($(this).val()));
                      counter++;
                });
                //alert(selected_leave_type.length);
                //console.log(cVal+"_"+len);
        if(parseInt(cVal) <= parseInt(len-1)) {
                // $('#h_count').val(parseInt(cVal) + 1);
                // cVal = $('#h_count').val();
                $('#h_count').val(counter);
                crow =  counter;
                vhtml  += '<div class="form-group leave_row_'+crow+'">';
                vhtml  += '<label class="control-label col-sm-3" for="leave_type">Leave Type</label>';
                vhtml  += '<div class="col-sm-6 controls">';
                vhtml  += '<select id="leave_type_'+crow+'" class="form-control leave_type" name="leave_type[]" data-rule-required="true">';
                $.each(obj ,function(i,val){
                   if($.inArray(val.id,selected_leave_type) == -1) {
                     vhtml  += '<option value="'+val.id+'">'+$.ucfirst(val.leave_type)+'</option>';
                      lstatus = 1;
                   } else {
                      lstatus = 0;
                   }
                });
               
                vhtml  += '</select>';
                vhtml  += '</div> <a class="btn-primary btn-xs btn" type="button" id="delete-row-btn-'+crow+'" onclick="deleteRow('+crow+');">Delete Row</a>'; 
                vhtml  += '</div>';
                vhtml  += '<div class="form-group leave_row_'+crow+'">';
                vhtml  += '<label class="control-label col-sm-3" for="no_of_days">No of Days</label>';
                vhtml  += '<div class="controls col-sm-6">';
                vhtml  += '<input class="form-control cal-days" id="no_of_days_'+crow+'" data-rowid="'+crow+'" name="no_of_days[]"  data-rule-required="true"  placeholder="No of days" type="text" />'; 
                vhtml  += '</div>';
                vhtml  += '</div>';
                //console.log(leave_type);
               $('#add_row').append(vhtml);
           } else {
               alert('You have selected all leaves');
           }
        });

    
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



    });

  function deleteRow(value) {
    if(value>1){
      var confirmMsg = confirm('Are you sure want to delete this row?');
      if(confirmMsg) {
        var selected_leave_type = [];
        var counter = 0;
        var leave_type = $("#leave_type_"+value).val();
        //selected_leave_type.splice($.inArray(leave_type, selected_leave_type),1);
        //alert(selected_leave_type.length);
        $(".leave_row_"+value).remove();
        $(".leave_type").each(function(){
            if($.isNumeric($(this).val()))
              selected_leave_type.push(parseInt($(this).val()));
              counter ++;
         });
        //alert(selected_leave_type.length);
        /*var h_count = $('#h_count').val();
        var counter = (Number(h_count)-1);*/
        $('#h_count').val(counter);
      }
    }
  }
</script>
@stop