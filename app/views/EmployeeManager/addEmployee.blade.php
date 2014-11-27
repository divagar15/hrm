@extends('layouts.master')
<?php

$branch     = Config::get('local.branchlist');
$resStatus  = Config::get('local.resultStatus'); 
$leadMode   = Config::get('local.leadMode');
$nric           = Config::get('local.nric');
//$nationality    = Config::get('local.nationality');
//$countries      = Config::get('local.country');
$addressType    = Config::get('local.address_type');
//$category       = Config::get('local.category');
//$cessationCode  = Config::get('local.cessationCode');
$cutOff         = Config::get('local.commissionCutoff');
//$systemUser = Config::get('local.systemUser'); 
?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Add Employee</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                            <i class='icon-folder-open '></i>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li>HRM</li>
                         <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li> Employee</li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add employee</li>
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
                      <div class='box-header blue-background'>
                        <div class='title'>Add Employee</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{URL::to('employee/store')}}" name="frmsysuser" id="frmsysuser" method="post" style='margin-bottom: 0;'>
                          
                           
                          <div class='row'>
                              <div class='col-sm-6'>
                              <h4>Personal Information</h4>
                              </div>
                          </div>

                           <div class="row">
                            <div class='col-sm-6'>
                                  <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='name'>Employee Name</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control basic_info'  data-rule-required='true' id='employee_name' name='employee_name' placeholder='Name' type='text'>
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
                                                              <option value='{{ $key }}'  >{{{ $branch }}}</option>
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
                                      <label class='control-label col-sm-3' for='user_type'>Employment Level</label>
                                      <div class='col-sm-8 controls'>
                                        <select class='form-control' data-rule-required="true"  id='user_type' name='user_type'>
                                           <option value=''>Select Employment Level</option>
                                            @foreach($userType as $key => $list)
                                             <option value="{{{ $key }}}">{{{ ucwords($list) }}}</option>
                                            @endforeach
                                            <!-- <option value="0">Others</option> -->
                                        </select>
                                      </div>
                                  </div>
                            </div>
                             <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='Email Id'>Email Id</label>
                                        <div class='col-sm-8 controls'>
                                             <input class='form-control basic_info'  data-rule-required='true' id='email_id' name='email_id' placeholder='Email ID' type='text' >
                                        </div>
                                    </div>
                             </div>
                            
                          </div>

                          <div class="row pass-dtls">
                            <div class='col-sm-6'>
                                  <div class='form-group'>
                                      <label class='control-label col-sm-3' for='password' id="password">Password</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control'  data-rule-required="true" data-rule-minlength="2" id='spassword' name='password' placeholder='Password' type='password'>
                                      </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3' for='confirm_password'>Confirm Password</label>
                                        <div class='col-sm-8 controls'>
                                            <input class='form-control'  data-rule-required="true" data-rule-equalto="#spassword" data-rule-minlength="2" id='confirm_password' name='confirm_password' placeholder='Confirm Password' type='password'>
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
                                         
                                            <option value="{{ $key }}">{{ $type }}</option>
                                         @endforeach
                                         </select>
                                      </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='nric_no'>NRIC/FIN No </label>
                                        <div class='col-sm-8 controls'>
                                             <input class='form-control basic_info'  data-rule-required='true' id='nric_no' name='nric_no' placeholder='NRIC/FIN No' type='text'  onchange="checkNric(this.value);">
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
                                        
                                            <option value="{{ $key }}">{{ ucfirst($national) }}</option>
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
                                         
                                            <option value="{{ $key }}">{{ ucfirst($country) }}</option>
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
                                         
                                            <option value="{{ $key }}">{{ ucfirst($resident) }}</option>
                                         @endforeach
                                         </select>
                                      </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='date_birth'>Date of Birth</label>
                                      <div class='col-sm-8 controls input-group'>
                                            <input class="form-control date-picks" autocomplete="off" type="text" id='date_birth' name='date_birth'  placeholder="Date of birth"  data-rule-required="true" >
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
                                        <input class='form-control basic_info' readonly  data-rule-required='true' data-rule-number="true" id='age' name='age' placeholder='Age' type='text'>
                                      </div>
                                    </div>
                                </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='gender'>Sex</label>
                                        <div class='col-sm-8 controls'>
                                                <select name="gender" id="gender"   data-rule-required='true' class="form-control basic_info">
                                                     <option value="1">Male</option>
                                                     <option value="2">Female</option>
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
                                         
                                                    <option value="{{ $key }}">{{ ucfirst($martial) }}</option>
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
                                         
                                            <option value="{{ $key }}">{{ ucfirst($races) }}</option>
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
                                         
                                            <option value="{{ $key }}">{{ $address }}</option>
                                         @endforeach
                                         </select>
                                      </div>
                                  </div>
                                </div>
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='address2'>Block / Hse No</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control' data-rule-required='true' id='block_hse' name='block_hse' placeholder='Block / Hse No' type='text' >
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='street_name'>Street Name</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control'  data-rule-required='true' id='street_name' name='street_name' placeholder='Street Name' type='text'>
                                      </div>
                                    </div>
                                </div>
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='level'>Level</label>
                                      <div class='col-sm-8 controls'>
                                            <input class='form-control' id='level' name='level' placeholder='Level' type='text'>
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='unit_no'>Unit No</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control' id='unit_no' name='unit_no' placeholder='Unit No' type='text'>
                                      </div>
                                    </div>
                                </div>
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='city'>City</label>
                                      <div class='col-sm-8 controls'>
                                            <input class='form-control'  data-rule-required='true'  id='city' name='city' placeholder='City' type='text' >
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='state'>State</label>
                                        <div class='col-sm-8 controls'>
                                          <input class='form-control' data-rule-required='true' id='state' name='state' placeholder='state' type='text'>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='city'>Country</label>
                                      <div class='col-sm-8 controls'>
                                          <input class='form-control'  data-rule-required='true'  id='country' name='country' placeholder='Country' type='text'>
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='telephone_no'>Residential Telephone No</label>
                                        <div class='col-sm-8 controls'>
                                          <input class='form-control' id='telephone_no' name='telephone_no' data-rule-number="true" placeholder='Residential Telephone No' type='text' >
                                        </div>
                                    </div>
                                </div>

                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='mobile_no'>Mobile No</label>
                                        <div class='col-sm-8 controls'>
                                          <input class='form-control' id='mobile_no' name='mobile_no' data-rule-number="true" placeholder='Mobile No' type='text' >
                                        </div>
                                    </div>
                                </div>
			
						 </div>
						

                           <!-- <div class="row">
                           
                                 <div class='col-sm-6'>
                                  <div class='form-group'>
                                         <label class='control-label col-sm-3 col-sm-3' for='branch'>Branch</label>
                                            <div class='col-sm-8 controls'>
                                                 <select class='form-control' name="branch" id="branch" data-rule-required="true">
                                                       <option value=''>Select Branch Title</option>
                                                       @if(!empty($branchList))
                                                          @foreach($branchList as $key => $branch) 
                                                              <option value='{{ $key }}'  >{{{ $branch }}}</option>
                                                          @endforeach
                                                       @endif
                                                 </select>
                                            </div>
                                  </div>
                            </div>
                            </div> -->
                            <div class='row'>
                              <div class='col-sm-6'>
                              <h4>Job Information</h4>
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
                                                       
                                                          <option value="{{ $key }}" >{{ ucwords($cat) }}</option>
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
                                                              <option value='{{ $key }}' >{{{ ucfirst($jobTag) }}}</option>
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
                                            <input class="form-control date-pick" autocomplete="off" type="text" id='hire_date' name='hire_date' data-format="DD-MM-YYYY" placeholder="Joined Date"  data-rule-required="true" onchange="getConfirmDate();">
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
                                        <input class='form-control basic_info' data-rule-number="true"  id='probation_period' name='probation_period' placeholder='Probation Period' type='text' onchange="getConfirmDate();">
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
                                            <input class="form-control date-pick" autocomplete="off" type="text" id='confirmed_date' name='confirmed_date' data-format="DD-MM-YYYY" placeholder="Confirmation Date">
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
                                                       
                                                          <option value="{{ $key }}">{{ $cal }}</option>
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
                                                      
                                                          <option value="{{ $key }}">{{ ucfirst($cessation) }}</option>
                                                       @endforeach
                                                 </select>
                                            </div>
                                  </div>
                            </div>
                            <div class='col-sm-6'>
                                    <div class='form-group'>
                                     <label class='control-label col-sm-3 col-sm-3' for='cessation_date'>Cessation Date:</label>
                                      <div class='col-sm-8 controls input-group'>
                                          <input class="form-control date-pick" autocomplete="off" data-rule-required='true' disabled="disabled" type="text" id='cessation_date' name='cessation_date' data-format="DD-MM-YYYY" placeholder="Cessation Date" >
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
                                        <input class='form-control basic_info'  data-rule-required='true' data-rule-number="true" id='basic_wage' name='basic_wage' placeholder='Basic Wages' type='text'>
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
                                                       
                                                          <option value="{{ $key }}">{{ $commission }}</option>
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
                                                <input class='form-control basic_info'  data-rule-required='true'  id='employee_cpf_rate' name='employee_cpf_rate' placeholder='Employee CPF Rate' type='text' >
                                        </div>
                                      </div> 
                                </div>
                                 <div class='col-sm-6'>
                                    <div class='form-group'>
                                      <label class='control-label col-sm-3 col-sm-3' for='employer_cpf_rate'>Employer CPF Rate (%)</label>
                                      <div class='col-sm-8 controls'>
                                        <input class='form-control'  data-rule-required='true' id='employer_cpf_rate' name='employer_cpf_rate' placeholder='Employer CPF Rate' type='text' >
                                      </div>
                                    </div>
                                </div>
                          </div>
                          <div class="row">
                                <div class='col-sm-6'>
                                     <div class='form-group'>
                                        <label class='control-label col-sm-3 col-sm-3' for='levy'>Levy</label>
                                        <div class='col-sm-8 controls'>
                                                <input class='form-control basic_info'  id='levy' name='levy' placeholder='Levy' type='text' >
                                        </div>
                                      </div> 
                                </div>
                                 <div class='col-sm-6'>
                                        <div class='form-group'>
                                           <label class='control-label col-sm-3 col-sm-3' for='bank'>Bank / Branch</label>
                                            <div class='col-sm-8 controls'>
                                                 <input class='form-control' id='bank' name='bank' placeholder='Bank / Branch' type='text' >
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
                                                 <input class='form-control'  id='account_no' name='account_no' placeholder='Account No' type='text' >
                                            </div>
                                        </div>
                                </div>
	                            
	                             <div class='col-sm-6'>
                                    <div class='form-group'>
                                       <label class='control-label col-sm-3 col-sm-3' for='mom_reg_no'>Mom Reg No</label>
                                        <div class='col-sm-8 controls'>
                                          <input class='form-control' id='mom_reg_no' name='mom_reg_no' data-rule-required='true' placeholder='Mom Reg No' type='text' >
                                        </div>
                                    </div>
                                </div>
                          </div>
						 
                         
                          <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-5">
                                      <div class="btn-toolbar">
                                        <button class="btn-primary btn" type="submit">Save &amp; Submit</button>
                                        <button class="btn-default btn resetbtn" type="button">Reset</button>
                                        <button class="btn-default btn" type="button" onclick="window.location.href='{{ URL::to('employee')}}'">Cancel</button>
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
<script>
    $(document).ready(function(){

        $('.date-pick').datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true,
         });

        $('.resetbtn').click(function(){
            $('#Name').val('');
            $('#username').val('');
            $('#spassword').val('');
            $('#confirm_password').val('');
            $('#branch_list').val('0');
            $('#user_type').val('1');
        });
        $('#user_type').change(function(){
            var utype = $(this).val();
            console.log(utype);
            if(utype == '1' || utype == '2' || utype == '3'){
              $('.pass-dtls').css('display','block');
            } else {
                $('.pass-dtls').css('display','none');
            }
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
        
    });

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

function checkNric(value) {
  var url = "<?php echo URL::to('employee/check-config/'); ?>";
  if(value!='' && value!=0) {
        $.ajax({
        type: "POST",
        url: actionPath+'employee/ajax-call',
        data: 'action=checkNricFin&nric='+value,
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
