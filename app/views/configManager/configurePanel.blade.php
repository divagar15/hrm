@extends('layouts.master')
<?php
?>
@section('content')
<style>
    .tabh{padding-bottom: 5px;}
    .txtheight{line-height: 35px;}
</style>
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Configuration Panel</span>
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
                          Configuration Panel
                        </li>
                        <!-- <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add employee</li> -->
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- top navigation  -->
                <div class="row">
                  <div class='col-sm-12'>
                      <div class="row" style="margin-left:50px;">
                      <div class='col-sm-12 col-md-6'>
                              <div class='box'>
                                <div class='box-header'>
                                  <div class='title'>
                                    <div class='icon-inbox'></div>
                                    Configure Company 
                                  </div>
                                </div>
                                <div class='row'>
                                  <div class='col-sm-6'>
                                      <!--<a href="{{ URL::to('leave/holiday-list') }}">  
                                        <div class='box-content box-statistic tabh'>
                                             <small class="txtheight">Holiday</small>
                                             <div class='text-success  icon-gamepad align-right'></div>
                                        </div>
                                      </a> -->   
                                      <a href="{{ URL::to('calendar/calendar-list') }}">
                                      <div class='box-content box-statistic tabh'>
                                       <small class="txtheight">Calendar</small>
                                       <div class='text-primary icon-calendar align-right'></div>
                                      </div>
                                      </a>
                                      <a href="{{ URL::to('branch/branch-list') }}">
                                       <div class='box-content box-statistic tabh'>
                                        <small class="txtheight">Branch</small>
                                        <div class='text-warning icon-sitemap align-right'></div>
                                        </div>
                                      </a>
                                  </div>
                                  <div class='col-sm-6'>
                                  <a href="{{ URL::to('config/company') }}">
                                    <div class='box-content box-statistic tabh'>
                                      <small class="txtheight">CPF AND Co. Registration No</small>
                                      <div class='text-primary icon-flag align-right'></div>
                                    </div>
                                  </a>
                                  <a href="{{ URL::to('company/config/bank') }}">
                                        <div class='box-content box-statistic tabh'>
                                          <small class="txtheight">Bank Account </small>
                                          <div class='text-success icon-credit-card align-right'></div>
                                        </div>
                                  </a>
                                    <!-- <div class='box-content box-statistic tab'>
                                      <small class="txtheight">Co. Registration No</small>
                                      <div class='text-success icon-flag align-right'></div>
                                    </div> -->
                                  </div>
                                </div>
                              </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                                <div class="box">
                                        <div class="box-header">
                                             <div class="title">
                                             <div class="icon-inbox"></div>
                                               Configure Personnel 
                                             </div>
                                         </div>
                                        <div class='row'>
                                                <div class='col-sm-6'>
                                                  <a href="{{ URL::to('config/nationality') }}">
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Nationality</small>
                                                    <div class='text-primary icon-globe align-right'></div>
                                                  </div>
                                                  </a>
                                                  <a href="{{ URL::to('config/pob') }}">
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Country of Birth</small>
                                                    <div class='text-warning icon-meh align-right'></div>
                                                  </div>
                                                  </a>
                                                  <a href="{{ URL::to('config/martial-status') }}">
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Marital Status</small>
                                                    <div class='text-success icon-male align-right'></div>
                                                  </div>
                                                  </a>    
                                                </div>
                                                <div class='col-sm-6'>
                                                  <a href="{{ URL::to('employee/config/residential-status') }}">    
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Residential Status</small>
                                                    <div class='text-primary icon-home align-right'></div>
                                                  </div>
                                                  </a>
                                                  <a href="{{ URL::to('employee/config/race') }}">  
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Race</small>
                                                    <div class='text-warning icon-compass align-right'></div>
                                                  </div>
                                                  </a>
                                                </div>
                                         </div>
                                 </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="box">
                                        <div class="box-header">
                                             <div class="title">
                                             <div class="icon-inbox"></div>
                                               Configure Employment 
                                             </div>
                                         </div>
                                        <div class='row'>
                                                <div class='col-sm-6'>
                                                  <a href="{{ URL::to('config/category') }}">
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Category</small>
                                                    <div class='text-primary icon-archive align-right'></div>
                                                  </div>
                                                  </a>
                                                  <a href="{{ URL::to('config/employment-level') }}">
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Employment Level</small>
                                                    <div class='text-warning icon-group align-right'></div>
                                                  </div>
                                                  </a>
                                                </div>
                                                <div class='col-sm-6'>
                                                 <a href="{{ URL::to('config/designation') }}">  
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Designation</small>
                                                    <div class='text-success icon-signal align-right'></div>
                                                  </div>
                                                  </a>      
                                                  <a href="{{ URL::to('config/cessation') }}">    
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Cessation Code</small>
                                                    <div class='text-primary icon-code align-right'></div>
                                                  </div>
                                                  </a>
                                                </div>
                                         </div>
                                 </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="box">
                                        <div class="box-header">
                                             <div class="title">&nbsp;
                                             </div>
                                         </div>
                                        <div class='row'>
                                                <div class='col-sm-6'>
                                                  <a href="{{ URL::to('account/commission-config-list') }}">
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Commission</small>
                                                    <div class='text-primary icon-dollar align-right'></div>
                                                  </div>
                                                  </a>
                                                   <a href="{{ URL::to('employee/config/allowance') }}">
                                                    <div class='box-content box-statistic tabh'>
                                                      <small class="txtheight">Allowances</small>
                                                      <div class='text-warning icon-collapse-top align-right'></div>
                                                    </div>
                                                  </a>   
                                                </div>
                                                <div class='col-sm-6'>
                                                  <a href="{{ URL::to('leave/leave-type-list') }}">    
                                                  <div class='box-content box-statistic tabh'>
                                                    <small class="txtheight">Leaves</small>
                                                    <div class='text-primary icon-sun align-right'></div>
                                                  </div>
                                                  </a>  
                                                </div>
                                        </div>
                                    
                                 </div>
                            </div> 
 
                        </div>
                      
                      </div>
                    </div>
                       <!-- cash collection approval listing -->
                
@include('includes.jscript')
@stop
