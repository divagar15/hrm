@extends('layouts.master')
<?php
$baseUrl        = Config::get('local.baseUrl');
$nric           = Config::get('local.nric');
//$nationality    = Config::get('local.nationality');
//$countries      = Config::get('local.country');
$addressType    = Config::get('local.address_type');
//$category       = Config::get('local.category');
//$cessationCode  = Config::get('local.cessationCode');
$cutOff         = Config::get('local.commissionCutoff');
//$systemUser = Config::get('local.systemUser'); 
//echo '<pre>'; print_r($nationality); echo '</pre>'; die();
?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>View Employee</span>
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
                          HR
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>View Employee Profile</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class='col-sm-12'>
                     <div class="row" style="margin: 0px 2px 0px 2px;">
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
                    </div>
                    <div class='box'>
                        <div class="row">
                            <div class="pull-right" style="margin-bottom:2px;">
                                <form accept-charset="UTF-8" action="{{ URL::to('employee').'/'.base64_encode($empId) }}" id='frmdelete' name='frmdelete' method="POST" style="float: left;">
                                    <input type="hidden" value="DELETE" name="_method">
                                    <a class="btn btn-danger btn-xs has-tooltip confirm_delete" href="javascript:void(0);" data-cid="{{ $empId }}" data-original-title="Delete" data-placement="top">
                                     <i class="icon-remove"></i>&nbsp;Delete</a>
                                </form>&nbsp;
                                <a class='btn btn-success btn-xs change-password has-tooltip'  data-placement="top" data-original-title="Change Password" href="#change-password" data-toggle="modal"><i class='icon-edit'></i>&nbsp;Change Password</a>
                                <a class="btn btn-warning btn-xs has-tooltip" href="{{ URL::to('employee') }}" data-original-title="Back" data-placement="top">
                                    <i class="icon-reply-all"></i>
                                     &nbsp;Back
                                 </a>
                            </div>
                        </div>
                        <div class='box-header blue-background'>
                          <div class='title'>Personal Information</div>
                        </div>
                      <div class='box-content'>
                      <form class='form form-horizontal validate-form' action="{{URL::to('employee/addEmployeeInfo/'.$empId)}}" name="frmEmpInfo" id="frmEmpInfo" method="post" style='margin-bottom: 0;' enctype="multipart/form-data">
                          <div class="row">
                            <div class='col-sm-6'>
                                  <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='name'>Employee Name</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control basic_info'  data-rule-required='true' id='employee_name' name='employee_name' placeholder='Name' type='text' value="{{{ $vEmp->emp_name }}}">
                                      </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='Email Id'>Email Id</label>
                                        <div class='col-sm-8 controls'>
                                             <input class='form-control basic_info'  data-rule-required='true' data-rule-email="true" id='email_id' name='email_id' placeholder='Email ID' type='text' value="{{{ $vEmp->email_id }}}">
                                        </div>
                                    </div>
                             </div>
                          </div>
                          <div class="row">
                            <div class='col-sm-6'>
                                  <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='nric_type'>NRIC/FIN Type</label>
                                      <div class='col-sm-8 controls'>
                                         <select name="nric_type" id="nric_type" data-rule-required='true' class="form-control basic_info">
                                         <option value="">Select NRIC/FIN Type</option>
                                         @foreach($nric as $key => $type)
                                         <?php 
                                            if($key==$vEmp->nric_fin_type)
                                              $selected = 'selected';
                                            else 
                                              $selected = '';
                                         ?>
                                            <option value="{{ $key }}" {{ $selected }}>{{ $type }}</option>
                                         @endforeach
                                         </select>
                                      </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='nric_no'>NRIC/FIN No </label>
                                        <div class='col-sm-8 controls'>
                                             <input class='form-control basic_info'  data-rule-required='true' id='nric_no' name='nric_no' placeholder='NRIC/FIN No' type='text' value="{{ $vEmp->nric_fin_no }}"   onchange="checkNric(this.value);">
                                        </div>
                                    </div>
                             </div>
                          </div>
                          <div class="row">
                            <div class='col-sm-6'>
                                  <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='nationality'>Nationality</label>
                                      <div class='col-sm-8 controls'>
                                        <select name="nationality" id="nationality" data-rule-required='true' class="form-control basic_info">
                                        <option value="">Select Nationality</option>
                                         @foreach($nationality as $key => $national)
                                         <?php 
                                            if($key==$vEmp->nationality)
                                              $selected = 'selected';
                                            else 
                                              $selected = '';
                                         ?>
                                            <option value="{{ $key }}" {{ $selected }}>{{ ucfirst($national) }}</option>
                                         @endforeach
                                         </select>
                                      </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='cob'>Country of Birth</label>
                                        <div class='col-sm-8 controls'>
                                        <select name="cob" id="cob" data-rule-required='true' class="form-control basic_info">
                                           <option value="">Select Country of Birth</option>
                                         @foreach($countries as $key => $country)
                                         <?php 
                                            if($key==$vEmp->cob)
                                              $selected = 'selected';
                                            else 
                                              $selected = '';
                                         ?>
                                            <option value="{{ $key }}" {{ $selected }}>{{ ucfirst($country) }}</option>
                                         @endforeach
                                        </select>
                                        </div>
                                    </div>
                             </div>
                          </div>
                          <div class="row">
                            <div class='col-sm-6'>
                                  <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='residential_status'>Residential Status</label>
                                      <div class='col-sm-8 controls'>
                                         <select name="residential_status" id="residential_status" data-rule-required='true' class="form-control basic_info">
                                         <option value="">Select Residential Status</option>
                                         @foreach($residential as $key => $resident)
                                         <?php 
                                            if($key==$vEmp->fkresidential_status)
                                              $selected = 'selected';
                                            else 
                                              $selected = '';
                                         ?>
                                            <option value="{{ $key }}" {{ $selected }}>{{ ucfirst($resident) }}</option>
                                         @endforeach
                                         </select>
                                      </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='date_birth'>Date of Birth</label>
                                      <div class='col-sm-8 controls input-group'>
                                            <input class="form-control date-picks" autocomplete="off" type="text" id='date_birth' name='date_birth'  placeholder="Date of birth"  data-rule-required="true" value="@if($vEmp->date_of_birth!=0){{date('d-m-Y',strtotime($vEmp->date_of_birth))}}@endif">
                                            <span class="input-group-addon">
                                            <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                            </span>
                                      </div>
                                      <div class='col-sm-9 pull-right'> 
                                               <span class="help-block has-error" for="date_birth"></span>
                                       </div>
                                    </div>
                                </div>
                          </div>
                           <div class="row">
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='age'>Age</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control basic_info' readonly  data-rule-required='true' data-rule-number="true" id='age' name='age' placeholder='Age' type='text' value="{{ $vEmp->age }}">
                                      </div>
                                    </div>
                                </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='gender'>Sex</label>
                                        <div class='col-sm-8 controls'>
                                                <select name="gender" id="gender"   data-rule-required='true' class="form-control basic_info">
                                                     <option value="1" <?php if($vEmp->gender == 1) echo "selected='selected'"; ?>>Male</option>
                                                     <option value="2" <?php if($vEmp->gender == 2) echo "selected='selected'"; ?> >Female</option>
                                                </select>
                                        </div>
                                    </div>
                             </div>
                          </div>
                          <div class="row">
                                <div class='col-sm-6'>
                                     <div class='form-group'>
                                        <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Marital Status</label>
                                        <div class='col-sm-8 controls'>
                                            <select name="martial_status" id="martial_status"   data-rule-required='true' class="form-control basic_info">
                                                                                                 @foreach($martialStatus as $key => $martial)
                                                 <?php 
                                                    if($key==$vEmp->marital_status)
                                                      $selected = 'selected';
                                                    else 
                                                      $selected = '';
                                                 ?>
                                                    <option value="{{ $key }}" {{ $selected }}>{{ ucfirst($martial) }}</option>
                                                 @endforeach
                                            </select>
                                        </div>
                                      </div> 
                                </div>
                                <div class='col-sm-6'>
                                  <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='race'>Race</label>
                                      <div class='col-sm-8 controls'>
                                         <select name="race" id="race" data-rule-required='true' class="form-control basic_info">
                                          <option value="">Select Race</option>
                                         @foreach($race as $key => $races)
                                         <?php 
                                            if($key==$vEmp->fkrace)
                                              $selected = 'selected';
                                            else 
                                              $selected = '';
                                         ?>
                                            <option value="{{ $key }}" {{ $selected }}>{{ ucfirst($races) }}</option>
                                         @endforeach
                                         </select>
                                      </div>
                                  </div>
                              </div>
                                 
                          </div>
                          <div class="row">
                                <div class='col-sm-6'>
                                  <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='address_type'>Address Type</label>
                                      <div class='col-sm-8 controls'>
                                         <select name="address_type" id="address_type" data-rule-required='true' class="form-control basic_info">
                                          <option value="">Select Address Type</option>
                                         @foreach($addressType as $key => $address)
                                         <?php 
                                            if($key==$vEmp->address_type)
                                              $selected = 'selected';
                                            else 
                                              $selected = '';
                                         ?>
                                            <option value="{{ $key }}" {{ $selected }}>{{ $address }}</option>
                                         @endforeach
                                         </select>
                                      </div>
                                  </div>
                                </div>
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='address2'>Block / Hse No</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control' data-rule-required='true' id='block_hse' name='block_hse' placeholder='Block / Hse No' type='text' value="{{ $vEmp->block_hse_no }}">
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='street_name'>Street Name</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control'  data-rule-required='true' id='street_name' name='street_name' placeholder='Street Name' type='text' value="{{ $vEmp->street_name }}">
                                      </div>
                                    </div>
                                </div>
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='level'>Level</label>
                                      <div class='col-sm-8 controls'>
                                            <input class='form-control' id='level' name='level' placeholder='Level' type='text' value="{{ $vEmp->level }}">
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='unit_no'>Unit No</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control' id='unit_no' name='unit_no' placeholder='Unit No' type='text' value="{{ $vEmp->unit_no }}">
                                      </div>
                                    </div>
                                </div>
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='city'>City</label>
                                      <div class='col-sm-8 controls'>
                                            <input class='form-control'  data-rule-required='true'  id='city' name='city' placeholder='City' type='text' value="{{ $vEmp->city }}">
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='state'>State</label>
                                        <div class='col-sm-8 controls'>
                                          <input class='form-control' data-rule-required='true' id='state' name='state' placeholder='state' type='text' value="{{ $vEmp->state }}">
                                        </div>
                                    </div>
                                </div>
                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='city'>Country</label>
                                      <div class='col-sm-8 controls'>
                                          <input class='form-control'  data-rule-required='true'  id='country' name='country' placeholder='Country' type='text' value="{{ $vEmp->country }}">
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='telephone_no'>Residential Telephone No</label>
                                        <div class='col-sm-8 controls'>
                                          <input class='form-control' id='telephone_no' name='telephone_no' data-rule-number="true" placeholder='Residential Telephone No' type='text' value="@if($vEmp->telephone!=0){{ $vEmp->telephone }}@endif">
                                        </div>
                                    </div>
                                </div>

                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='mobile_no'>Mobile No</label>
                                        <div class='col-sm-8 controls'>
                                          <input class='form-control' id='mobile_no' name='mobile_no' data-rule-number="true" placeholder='Mobile No' type='text' value="@if($vEmp->mobile!=0){{ $vEmp->mobile }}@endif">
                                        </div>
                                    </div>
                                </div>
						</div>
                          <div class="row">
                              <div class='col-sm-6'>
                                  <div class='form-group'>
                                      <label class='control-label col-sm-3' for='user_type'>Employment Level</label>
                                      <div class='col-sm-8 controls'>
                                        <select class='form-control' data-rule-required="true"  id='user_type' name='user_type'>
                                           <option value=''>Select Employment Level</option>
                                           @if(!empty($userType))
                                            @foreach($userType as $key => $list)
                                             <option value="{{ $key }}" {{ $vEmp->user_role == $key ? 'selected="selected"' : '' }}>{{{ ucwords($list) }}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                      </div>
                                  </div>
                            </div>
                          </div>
						
                          <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar" id="basic_action">
                                        <button class="btn-primary btn" type="button" id="edit_basic_info">Edit</button>
                                       </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                      </div>
                      <!-- job Information start -->
                     <div class='box'>
                        <div class='box-header blue-background'>
                          <div class='title'>Job</div>
                        </div>
                      <div class='box-content'>
                      <form class='form form-horizontal validate-form' action="{{URL::to('employee/addEmployeeJob/'.$empId)}}" name="frmEmpJob" id="frmEmpJob" method="post" style='margin-bottom: 0;' enctype="multipart/form-data">
                          <div class="row">
                           <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='employee_id'>Employee ID</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control basic_info'  data-rule-required='true'  id='employee_id' name='employee_id' placeholder='Employee ID' type='text' value="{{ $vEmp->employee_id }}">
                                      </div>
                                    </div>
                                </div>
                                 <div class='col-sm-6'>
                                  <div class='form-group'>
                                         <label class='control-label col-sm-3 col-sm-3' for='branch'>Branch</label>
                                            <div class='col-sm-8 controls'>
                                                 <select class='form-control' name="branch" id="branch" data-rule-required="true">
                                                       <option value=''>Select Branch Title</option>
                                                       @if(!empty($branchList))
                                                          @foreach($branchList as $key => $branch) 
                                                              <option value='{{ $key }}'  {{ array_key_exists($vEmp->fkBranchId,$branchList) && ($vEmp->fkBranchId == $key) ? 'selected' : '' }}>{{{ $branch }}}</option>
                                                          @endforeach
                                                       @endif
                                                 </select>
                                            </div>
                                  </div>
                            </div>
                            </div>
                          <div class="row">
                          <div class='col-sm-6'>
                                  <div class='form-group'>
                                         <label class='control-label col-sm-3 col-sm-3' for='category'>Category</label>
                                            <div class='col-sm-8 controls'>
                                                 <select class='form-control' name="category" id="category" data-rule-required="true" >
                                                      <option value=''>Select Category</option>
                                                      @foreach($category as $key => $cat)
                                                       <?php 
                                                          if($key==$vEmp->category)
                                                            $selected = 'selected';
                                                          else 
                                                            $selected = '';
                                                       ?>
                                                          <option value="{{ $key }}" {{ $selected }}>{{ ucwords($cat) }}</option>
                                                       @endforeach
                                                 </select>
                                            </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                  <div class='form-group'>
                                         <label class='control-label col-sm-3 col-sm-3' for='job_title'>Designation</label>
                                            <div class='col-sm-8 controls'>
                                                 <select class='form-control' name="job_title" id="job_title" data-rule-required="true" >
                                                       <option value=''>Select Designation</option>
                                                       @if(!empty($jobList))
                                                          @foreach($jobList as $key => $jobTag) 
                                                              <option value='{{ $key }}' {{ array_key_exists($vEmp->job_title,$jobList) && ($vEmp->job_title == $key) ? 'selected' : '' }} >{{{ ucfirst($jobTag) }}}</option>
                                                          @endforeach
                                                       @endif
                                                 </select>
                                            </div>
                                  </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                     <label class='control-label col-sm-3 col-sm-3' for='hire_date'>Hire Date:</label>
                                      <div class='col-sm-8 controls input-group'>
                                            <input class="form-control date-pick" autocomplete="off" type="text" id='hire_date' name='hire_date' data-format="DD-MM-YYYY" value="@if($vEmp->hire_date!=0){{ date('d-m-Y',strtotime($vEmp->hire_date)) }}@endif" placeholder="Joined Date"  data-rule-required="true" onchange="getConfirmDate();">
                                            <span class="input-group-addon">
                                            <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                            </span>
                                      </div>
                                    </div>
                             </div>
                               <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='probation_period'>Probation Period</label>
                                      <div class='col-sm-4 controls'>
                                        <input class='form-control basic_info' data-rule-number="true"  id='probation_period' name='probation_period' placeholder='Probation Period' type='text' value="{{ $vEmp->probation_period }}" onchange="getConfirmDate();">
                                      </div>
                                      <label class='control-label col-sm-3 col-sm-3' for='' style="text-align:left;">Months</label>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                     <label class='control-label col-sm-3 col-sm-3' for='confirmed_date'>Confirmation Date:</label>
                                      <div class='col-sm-8 controls input-group'>
                                            <input class="form-control date-pick" autocomplete="off" type="text" id='confirmed_date' name='confirmed_date' data-format="DD-MM-YYYY" value="{{ $vEmp->confirm_date != 0 && $vEmp->confirm_date != '' ? date('d-m-Y',strtotime($vEmp->confirm_date)) : '' }}" placeholder="Confirmation Date">
                                            <span class="input-group-addon">
                                            <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                            </span>
                                      </div>
                                    </div>
                             </div>
                             <div class='col-sm-6'>
                                  <div class='form-group'>
                                         <label class='control-label col-sm-3 col-sm-3' for='calendar'>Calendar</label>
                                            <div class='col-sm-8 controls'>
                                                 <select class='form-control' name="calendar" id="calendar" data-rule-required="true" >
                                                       <option value=''>Select Calendar</option>
                                                       @foreach($calendar as $key => $cal)
                                                       <?php 
                                                          if($key==$vEmp->calendar)
                                                            $selected = 'selected';
                                                          else 
                                                            $selected = '';
                                                       ?>
                                                          <option value="{{ $key }}" {{ $selected }}>{{ $cal }}</option>
                                                       @endforeach
                                                 </select>
                                            </div>
                                  </div>
                            </div>
                            
                          </div>
                          <div class="row">
                           <div class='col-sm-6'>
                                  <div class='form-group'>
                                         <label class='control-label col-sm-3 col-sm-3' for='cessation_code'>Cessation Code</label>
                                            <div class='col-sm-8 controls'>
                                                 <select class='form-control' name="cessation_code" id="cessation_code">
                                                       <option value=''>Select Cessation Code</option>
                                                       @foreach($cessationCode as $key => $cessation)
                                                       <?php 
                                                          if($key==$vEmp->cessation_code)
                                                            $selected = 'selected';
                                                          else 
                                                            $selected = '';
                                                       ?>
                                                          <option value="{{ $key }}" {{ $selected }}>{{ ucfirst($cessation) }}</option>
                                                       @endforeach
                                                 </select>
                                            </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                     <label class='control-label col-sm-3 col-sm-3' for='cessation_date'>Cessation Date:</label>
                                      <div class='col-sm-8 controls input-group'>
                                          <input class="form-control date-pick" autocomplete="off" type="text" data-rule-required='true' id='cessation_date' name='cessation_date' data-format="DD-MM-YYYY" value="@if($vEmp->cessation_date!=0){{ date('d-m-Y',strtotime($vEmp->cessation_date)) }}@endif" placeholder="Cessation Date" >
                                            <span class="input-group-addon">
                                            <span class="icon-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
                                            </span>
                                      </div>
                                    </div>
                             </div>
                             
                          </div>

                          <!--    <div class="row">
                           
                         <div class='col-sm-6'>
                             </div>
                          </div>
                          <div class='row'>
                              <div class='col-sm-6'>
                              <h4>All Earnings</h4>
                              </div>
                          </div>
 -->                          <div class="row">
                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='wages'>Basic Wages</label>
                                      <div class='col-sm-8 controls'>
                                        <!-- <input type="hidden" id="min_salary" name="min_salary" value="{{-- $vEmp->min_salary --}}" /> 
                                        <input type="hidden" id="max_salary" name="max_salary" value="{{-- $vEmp->max_salary --}}" />  -->
                                        <input class='form-control basic_info'  data-rule-required='true' data-rule-number="true" id='basic_wage' name='basic_wage' placeholder='Basic Wages' type='text' value="{{ $vEmp->basic_wage }}">
                                        <span id="salary_disp"></span>
                                      </div>
                                    </div>
                                </div>
                                 <div class='col-sm-6'>
                                  <div class='form-group'>
                                         <label class='control-label col-sm-3 col-sm-3' for='commission'>Commission Cut-Off Date / Month</label>
                                            <div class='col-sm-8 controls'>
                                                 <select class='form-control' name="commission" id="commission">
                                                       <!-- <option value=''>Select Cut-Off Date / Month</option> -->
                                                       @foreach($cutOff as $key => $commission)
                                                       <?php 
                                                          if($key==$vEmp->cutoff)
                                                            $selected = 'selected';
                                                          else 
                                                            $selected = '';
                                                       ?>
                                                          <option value="{{ $key }}" {{ $selected }}>{{ $commission }}</option>
                                                       @endforeach
                                                 </select>
                                            </div>
                                  </div>
                            </div>
                          </div>
                          <div class="row">
                                <div class='col-sm-6'>
                                     <div class='form-group'>
                                        <label class='control-label col-sm-3 col-sm-3' for='employee_cpf_rate'>Employee CPF Rate (%)</label>
                                        <div class='col-sm-8 controls'>
                                                <input class='form-control basic_info'  data-rule-required='true'  id='employee_cpf_rate' name='employee_cpf_rate'  placeholder='Employee CPF Rate' type='text' value="{{ $vEmp->employee_cpf_rate }}">
                                        </div>
                                      </div> 
                                </div>
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='employer_cpf_rate'>Employer CPF Rate (%)</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control'  data-rule-required='true' id='employer_cpf_rate' name='employer_cpf_rate' placeholder='Employer CPF Rate' type='text' value="{{ $vEmp->employer_cpf_rate }}">
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                <div class='col-sm-6'>
                                     <div class='form-group'>
                                        <label class='control-label col-sm-3 col-sm-3' for='levy'>Levy</label>
                                        <div class='col-sm-8 controls'>
                                                <input class='form-control basic_info'  id='levy' name='levy' placeholder='Levy' type='text' value="{{ $vEmp->levy }}">
                                        </div>
                                      </div> 
                                </div>
                                 <div class='col-sm-6'>
                                        <div class='form-group'>
                                           <label class='control-label col-sm-3 col-sm-3' for='bank'>Bank / Branch</label>
                                            <div class='col-sm-8 controls'>
                                                 <input class='form-control' id='bank' name='bank' placeholder='Bank / Branch' type='text' value="{{ $vEmp->bank_branch }}">
                                            </div>
                                        </div>
                                </div>
                          </div>
                          <!-- <div class='row'>
                              <div class='col-sm-6'>
                              <h4>All Deductions</h4>
                              </div>
                          </div> -->
                          <div class="row">
                                <div class='col-sm-6'>
                                        <div class='form-group'>
                                           <label class='control-label col-sm-3 col-sm-3' for='account_no'>Account No</label>
                                            <div class='col-sm-8 controls'>
                                                 <input class='form-control'  id='account_no' name='account_no' placeholder='Account No' type='text' value="{{ $vEmp->account_no }}">
                                            </div>
                                        </div>
                                </div>
                               
								<div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='mom_reg_no'>Mom Reg No</label>
                                        <div class='col-sm-8 controls'>
                                          <input class='form-control' id='mom_reg_no' name='mom_reg_no'  data-rule-required='true' placeholder='Mom Reg No' type='text' value="@if(isset($vEmp->mom_reg_no)){{ $vEmp->mom_reg_no }}@endif">
                                        </div>
                                    </div>
                                </div>                               
                        
                          </div>
                          
                          <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar" id="salary_action">
                                        <button class="btn-primary btn" type="button" id="edit_salary_info">Edit</button>
                                       </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                      </div>
                      <!-- end job information -->
                    </div>
        </div>
      </div>
      <div class='modal' id='change-password' tabindex='-1'>
                                         <div class='modal-dialog'>
                                           <div class='modal-content'>
                                             <div class='modal-header'>
                                               <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                               <h4 class='modal-title' id='myModalLabel'>Change profile password</h4>
                                             </div>
                                             <div class='modal-body' id="recent-followup">
                                              <form class="form form-horizontal validate-form" name="empreqfrm" id="empreqfrm" style="margin-bottom: 0;" action="{{ URL::to('employee/change-password') }}"method="post" />
                                              <div class='form-group'>
                                                <label for='inputText1'>Email Id</label>
                                                <input type="hidden" class="form-control" name="view_page" id="view_page" value="1" />
                                                <input type="hidden" class="form-control" name="emp_empId" id="e_empId" value="{{ Request::Segment(3) }}" />
                                                <input type="text" class="form-control" name="ec_email" id="c_email" value="{{ $vEmp->email_id }}"  placeholder="Email" disabled="disabled" data-rule-required="true" data-rule-email="true"  />
                                                <span class="help-block has-error" for="ec_email"></span>
                                              </div>
                                              <div class='form-group'>
                                                <label for='inputText1'>New password</label>
                                                <input class="form-control" id="enew_pass" class="form-control" type="password" placeholder="Password" name="enew_pass" data-rule-minlength="2" data-rule-required="true" value="" />
                                                <span class="help-block has-error" for="enew_pass"></span>
                                              </div>
                                              <div class='form-group'>
                                                <label for='inputText1'>Confirm password</label>
                                                <input class="form-control" id="ec_pass" type="password" placeholder="Confirm Password" name="ecfm_pass" data-rule-minlength="2" data-rule-equalto="#enew_pass" data-rule-required="true" />
                                                <span class="help-block has-error" for="ec_pass"></span>
                                              </div>
                                              </form>
                                             </div>
                                             <div class='modal-footer'>
                                               <button class='btn btn-primary' type='button' id='empchange-pass'>Save & Submit</button>   
                                               <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                             </div>
                                           </div>
                                         </div>
        </div>
    </div>

@include('includes.jscript')
<script>
    $(document).ready(function(){
        //$('#date_birth').datepicker();
        $('.date-pick').datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true,
         });
         
         $('#empchange-pass').click(function(){
            $('#empreqfrm').submit(); 
         });
        
        var baseUrl  = "'"+<?php echo '"'.$baseUrl.'employee/view-employee-profile/'.$empId."'".'";' ?>;
        var basePath = <?php echo '"'.$baseUrl.'"'; ?>;
         $('.confirm_delete').click(function(){
            if(confirm('Are sure to delete this employee?')) {
               $('#frmdelete').submit();
            } else {
                return false;
            }
        });

         $('#frmEmpInfo .form-control').prop( "disabled", true );
         $('#frmEmpJob .form-control').prop( "disabled", true );

        <?php 
          if(!isset($vEmp->nric_fin_no) && empty($vEmp->nric_fin_no)) {
        ?>

             var btnHtml  = '<button class="btn-primary btn" type="submit" id="edit_basic_info">Save &amp; Submit</button>';
                 btnHtml += '<button class="btn-primary btn" type="button"  onclick="window.location.href='+baseUrl+'">Cancel</button>';
             $('#frmEmpInfo .form-control').prop( "disabled", false );
             $('#basic_action').html(btnHtml);

        <?php 
          }
        ?>


         <?php 
          if(!isset($vEmp->category) && empty($vEmp->category)) {
        ?>

          var btnHtml  = '<button class="btn-primary btn" type="submit" >Save &amp; Submit</button>';
                btnHtml += '<button class="btn-primary btn" type="button"  onclick="window.location.href='+baseUrl+'">Cancel</button>';
             $('#frmEmpJob .form-control').prop( "disabled", false );
             $('#salary_action').html(btnHtml);

        <?php
          }
        ?>
        
        
        $('#edit_basic_info').click(function(){
             var btnHtml  = '<button class="btn-primary btn" type="submit" id="edit_basic_info">Save &amp; Submit</button>';
                 btnHtml += '<button class="btn-primary btn" type="button"  onclick="window.location.href='+baseUrl+'">Cancel</button>';
             $('#frmEmpInfo .form-control').prop( "disabled", false );
             $('#basic_action').html(btnHtml);
        });
        $('#edit_salary_info').on('click',function(){
            var btnHtml  = '<button class="btn-primary btn" type="submit" >Save &amp; Submit</button>';
                btnHtml += '<button class="btn-primary btn" type="button"  onclick="window.location.href='+baseUrl+'">Cancel</button>';
             $('#frmEmpJob .form-control').prop( "disabled", false );
             $('#cessation_date').prop( "disabled", true );
             $('#salary_action').html(btnHtml);
        });
        $('#cessation_date').click(function(){
            var cession_option = $('#cessation_code').val();
            if(cession_option == ''){
                $('#cessation_date').val('');
                $(this).datepicker('hide');
                $('#cessation_date').prop( "disabled", true );
                alert('Please select Cessation Code then enter Cessation Date');
                $('#cessation_code').focus();
            }
        });
        $('#cessation_code').change(function(){
            if($(this).val() == ''){
                $('#cessation_date').val('');
                $('#cessation_date').prop( "disabled", true);
                $("#cessation_date").datepicker('hide');
                alert('Please select Cessation Code to enable Cessation Date fields');
            } else {
                $('#cessation_date').prop( "disabled", false);
            }
        });
        
        
/*        $('#basic_wage').blur(function() {
            var jobId = $('#job_title').val();
            if(jobId == '') {
                $('#basic_wage').val('');
                alert('Please select Job Title');
            } else {
                var wage_amt = $('#basic_wage').val();
                $.ajax({
                    type: 'POST',
                    url : basePath+'employee/ajax-call',
                    data : 'action=checkSalaryRange&basic_wage='+wage_amt+'&jobId='+jobId,
                    success:function(response){
                        if(response != 0){
                            var obj = $.parseJSON(response);
                            $('#min_salary').val(obj.min_salary);
                            $('#max_salary').val(obj.max_salary);
                            $('#salary_disp').html('Salary should between '+obj.min_salary+' and '+obj.max_salary);
                        }
                    }
                });
                
                    
            }

                
        });*/
        /*$('#cancel_salary_info').live('click',function(){
             $('#frmEmpJob .form-control').prop( "disabled", true );
             var btnHtml =   '<button class="btn-primary btn" type="button" id="edit_salary_info">Edit</button>';
             $('#salary_action').html(btnHtml);
        });*/
   });
   
 /**
 * Submit form whether salary correctly fixed
 */
/*function jobSubmit() {
    var minSalary = parseInt($('#min_salary').val());
    var maxSalary = parseInt($('#max_salary').val());
    var basicWage = parseInt($('#basic_wage').val());
    if(minSalary != '' && maxSalary != '' && $('#basic_wage').val() != '') {
        if(basicWage >= minSalary  && basicWage <= maxSalary) {
            $('#frmEmpJob').submit();
        } else {
            alert('Please check basic wage in not lies between pay grade salary');
        }
    } else {
        alert('Please enter basic wage');
    }
}*/

var calculateAge = function(birthday) {

        var today = new Date();
        var dd = Number(today.getDate());
        var mm = Number(today.getMonth()+1);

        var yyyy = Number(today.getFullYear()); 

        var myBDM = Number(birthday.split("-")[1])
        var myBDD = Number(birthday.split("-")[0])
        var myBDY = Number(birthday.split("-")[2])
        var age = yyyy - myBDY;
        //$('#age input').attr("disabled","disabled")

        if(mm < myBDM)
        {
        age = age - 1;      
        }
        else if(mm == myBDM && dd < myBDD)
        {
        age = age - 1
        };


    return age;
};

jQuery('#date_birth').datepicker({ format: 'dd-mm-yyyy',
     autoclose: true }).on('changeDate', function(ev){
    var birthday = $('#date_birth').val();
    var age = calculateAge(birthday);
    if(age<=0 || age<18) {
      alert("Please select valid date of birth. Age must be minimum 18 years");
      $("#age").val("");
    } else {
      $("#age").val(age);
    }
});

/*$('#date_birth').blur(function(e) {
    e.preventDefault();
    var birthday = $('#date_birth').val();
    var age = calculateAge(birthday);
    if(age<=0 && age<18) {
      alert("Please select valid date of birth. Age must be minimum 18 years");
      $("#age").val("");
    } else {
      $("#age").val(age);
    }
});*/

function getConfirmDate() {

/*  var hire_date = $("#hire_date").val();
  var probation_period = Number($("#probation_period").val());
  var month = Number(hire_date.split("-")[1]);
  var day   = Number(hire_date.split("-")[0]);
  var year  = Number(hire_date.split("-")[2]);*/
/*
  var someDate = new Date();


  var dd = someDate.getDate();
  var mm = ((someDate.getMonth()+7));
  var y = someDate.getFullYear();

  var someFormattedDate = dd + '-'+ mm + '-'+ y;
   console.log(someFormattedDate);*/

//  $("#confirmed_date").val(someFormattedDate);

  var hire_date = $("#hire_date").val();
  var probation_period = Number($("#probation_period").val());
  if(hire_date!='' && probation_period!='') {

    var month = Number(hire_date.split("-")[1])
    var day   = Number(hire_date.split("-")[0])
    var year  = Number(hire_date.split("-")[2])
    var d = new Date(year, month, day);
    d.setMonth(d.getMonth() + probation_period);
    var month = '' + d.getMonth(),
        day = '' + d.getDate(),
        year = d.getFullYear();


    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    if(month=='00') {
      month = 12;
    }

    var date =  [day, month, year].join('-');
    $("#confirmed_date").val(date);


  } else if(hire_date=='' && probation_period!='') {
    alert("Please enter hire date to calculate confirmation date");
    return false;
  } /*else if(hire_date!='' && probation_period=='') {
    alert("Please enter probation period to calculate confirmation date");
    return false;
  }*/

/*
    var myDate = new Date("01/31/2012");
    var result1 = myDate.addMonths(1);

    var myDate2 = new Date("01/31/2011");
    var result2 = myDate.addMonths(1);

    console.log(result1);
    console.log(result2);*/

} 
/*
function getConfirmDate(){
 var obj=document.getElementById('hire_date');
 var val=obj.value;
 var date=new Date(val.split('-')[2],(val.split('-')[1]-0+5),val.split('-')[0]);
 var con = Format(date.getDate())+'/'+Format(date.getMonth())+'/'+date.getFullYear();
 console.log(con);
}
function Format(nu){
 if (nu<10){ nu='0'+nu; }
 return nu;
}*/

function checkNric(value) {
  var url = "<?php echo URL::to('employee/check-config/'); ?>";
  var id  = "<?php echo $empId; ?>";
  if(value!='' && value!=0) {
        $.ajax({
        type: "POST",
        url: actionPath+'employee/ajax-call',
        data: 'action=checkNricFinUpdate&nric='+value+'&id='+id,
        success: function (html) {
            if($.trim(html)==2) {
              $("#nric_no").val('');
              alert("NRIC / Fin No Already exists");
              $("#nric_no").focus();
            } 
        }
      }); 
  } 
}
</script>
@stop
