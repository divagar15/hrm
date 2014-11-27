@extends('layouts.master')
<?php
$approval_status = Config::get('local.fee_approval');
$payMode         = Config::get('local.payMode');
$bId = Request::get('branch');
$pMode = Request::get('pay_mode');
?>
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Cash / Cheque Collection for Approval</span>
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
                                <li class="active">Cash / Cheque Collection for Approval</li>
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
                        @if(Session::has('alertMsg') && Session::get('alertMsg'))
			              <div class='col-xs-12'>
			                <div class="row">
			                   <div class="alert alert-success alert-dismissable">
			                      <a class="close" href="#" data-dismiss="alert">× </a>
			                      <i class="icon-ok-sign"></i>
			                      Fee Amount processed successfully
			                   </div>
			                </div>
			              </div>
			              <?php Session::forget('alertMsg'); ?>
			              @endif
                     <!-- alert box section end -->
                     <!-- updated by ganeshbabu on 01-Jul-2014(start) -->
                     @if(isset($_GET['branch']))
                     	@if($user_role == 1 && !empty($approval_list)) 
			              <div class='row' style="margin-left:0px;">
			                <div class='col-sm-12'>
			                  <div class='box bordered-box blue-border' style='margin-bottom:0; width: 100%;'>
			                    <div class='box-header blue-background'>
			                      <div class='title'>Cash / Cheque Collection for Approval</div>
			                    </div>
			                    <div class='box-content box-no-padding'>
			                      <div class='responsive-table'>
			                        <div class='scrollable-area'>
			                         @if(!empty($approval_list))
			                          <table class='data-table-column-filter table table-bordered table-striped dataTable' style='margin-bottom:0; width:100%;'>
			                            <thead>
			                              <tr width="30%">
			                                  <th><input id="checkAll" class="checklist" type="checkbox"  value="-1" name="approve[]"></th>
			                                <th>
			                                  Contract No
			                                </th>
			                                <th>
			                                  Branch Name
			                                </th>
			                                <th>
			                                  Customer Name
			                                </th>
			                                <th>
			                                  Service officer
			                                </th>
			                                <th class="nosort">
			                                  <select id="pay_mode" name="pay_mode">
                                                                <option value="0">Pay Mode</option>
                                                                @if(!empty($payMode))
                                                                  @foreach($payMode as $key => $pl)
                                                                  <option value="{{ $key }}"  <?php if(isset($pMode) && $pMode == $key) { echo 'selected=selected'; } ?>>{{ $pl }}</option>
                                                                  @endforeach
                                                                @endif
                                                            </select>
			                                </th>
                                                        <th>
                                                           $ Cash 
			                                </th>
			                                <th>Status Updated</th>
			                                <th>Status</th>
			                                <th>Action</th>
			                              </tr>
			                            </thead>
			                            <tbody>
			                             @foreach($approval_list as $alist)
			                              <tr>
			                                <td><input class="checklist" type="checkbox" value="{{ $alist->main_id }}" name="approve[]" /></td>
			                                <td>{{ $alist->contract_no }}</td>
			                                <td>{{ $alist->branch_name }}</td>
			                                <td>{{ $alist->customer_name }}</td>
			                                <td>{{ $alist->emp_name }}</td>
			                                <td>@if($alist->pay_mode=='1'){{ 'Cash' }}@else{{'Cheque'}}@endif</td>
			                                <td>${{ number_format($alist->paid_amt) }}</td>
			                                <td>@if($alist->fee_update_date!=NULL){{date('d-M-Y',strtotime($alist->fee_update_date))}}@else{{'-----'}}@endif</td>
			                                <td>
			                                  {{ $approval_status[$alist->fee_approval] }}
			                                </td>
			                                <td>
			                                  <a href="{{URL::to('cash-approval/approval/'.$alist->main_id)}}" title="" class="btn btn-success btn-xs">Approve</a>
			                                  <a href="{{URL::to('cash-approval/reject/'.$alist->main_id)}}" title="" class="btn btn-danger btn-xs">Reject</a>
			                                </td>
			                              </tr>
			                              @endforeach
			                            </tbody>
			                          </table>
			                          @endif
			                        </div>
			                      </div>
			                    </div>
			                    <div class="row">
			                        <div class="pull-right"><a href="javascript:" class="btn btn-primary" onclick="return changeStatus(1);" style="margin-right:4px; margin-top: 10px;">Approve</a><a href="javascript::" onclick="return changeStatus(2);" class="btn btn-primary" style='margin-top: 10px;'>Reject</a></div>
			                    </div>
			                </div>
			              </div>
			         	 </div>
	            		@endif
                     @else
	                     @if($user_role == 1 && !empty($approval_list)) 
			              <div class='row' style="margin-left:0px;">
			                <div class='col-sm-12'>
			                  <div class='box bordered-box blue-border' style='margin-bottom:0; width: 100%;'>
			                    <div class='box-header blue-background'>
			                      <div class='title'>Contract Payment Approval</div>
			                    </div>
			                    <div class='box-content box-no-padding'>
			                      <div class='responsive-table'>
			                        <div class='scrollable-area'>
			                         @if(!empty($approval_list))
			                          <table class='data-table-column-filter table table-bordered table-striped dataTable' style='margin-bottom:0;'>
			                            <thead>
			                              <tr width="30%">
			                                  <th><input id="checkAll" class="checklist" type="checkbox"  value="-1" name="approve[]"></th>
			                                <th>
			                                  Contract Number
			                                </th>
			                                <th>
			                                  Branch Name
			                                </th>
			                                <th>
			                                  Customer Name
			                                </th>
			                                <th width="30%">
			                                  Servicing officer
			                                </th>
			                                <th class="nosort">
			                                  <select id="pay_mode" name="pay_mode">
                                                                <option value="0">Pay Mode</option>
                                                                @if(!empty($payMode))
                                                                  @foreach($payMode as $key => $pl)
                                                                  <option value="{{ $key }}">{{ $pl }}</option>
                                                                  @endforeach
                                                                @endif
                                                            </select>
			                                </th>
                                                        <th width="20%" class="nosort">
			                                  Cash $
			                                </th>
			                                <th>Status Updated</th>
			                                <th>Status</th>
			                                <th>Action</th>
			                              </tr>
			                            </thead>
			                            <tbody>
			                             @foreach($approval_list as $alist)
			                              <tr>
			                                <td><input class="checklist" type="checkbox" value="{{ $alist->main_id }}" name="approve[]" /></td>
			                                <td>{{ $alist->contract_no }}</td>
			                                <td>{{ $alist->branch_name }}</td>
			                                <td>{{ $alist->customer_name }}</td>
			                                <td>{{ $alist->emp_name }}</td>
			                                <td>@if($alist->pay_mode=='1'){{ 'Cash' }}@else{{'Cheque'}}@endif</td>
			                                <td>${{ number_format($alist->paid_amt) }}</td>
			                                <td>@if($alist->fee_update_date!=NULL){{date('d-M-Y',strtotime($alist->fee_update_date))}}@else{{'-----'}}@endif</td>
			                                <td>
			                                  <span class='label label-important'>{{ $approval_status[$alist->fee_approval] }}</span>
			                                </td>
			                                <td>
			                                  <a href="{{URL::to('cash-approval/approval/'.$alist->main_id)}}" title="" class="btn btn-success btn-xs">Approve</a>
			                                  <a href="{{URL::to('cash-approval/reject/'.$alist->main_id)}}" title="" class="btn btn-danger btn-xs">Reject</a>
			                                </td>
			                              </tr>
			                              @endforeach
			                            </tbody>
			                          </table>
			                          @endif
			                        </div>
			                      </div>
			                    </div>
			                    <div class="row">
			                        <div class="pull-right"><a href="javascript:" class="btn btn-primary" onclick="return changeStatus(1);" style="margin-right:4px; margin-top: 10px;">Approve</a><a href="javascript::" onclick="return changeStatus(2);" class="btn btn-primary" style='margin-top: 10px;'>Reject</a></div>
			                    </div>
			                </div>
			              </div>
			         	 </div>
	            		@endif
	            	 @endif
                     <!-- updated by ganeshbabu on 01-Jul-2014(end) -->
                  </div>
                </div>
              </div>
       </div>
</div>
@include('includes.jscript')
<script type="text/javascript">
 $(document).ready(function(){
      
      <?php 
            $br = '';
            if(isset($bId))
                $br =  '?branch='.$bId.'&pay_mode=';
            else
                $br = '?pay_mode=';
      ?>
      var  baseUrl = '<?php echo URL::to('approval/contract-payment-approval'.$br); ?>';
      var table = $('.data-table-column-filter').dataTable({
                        "aaSorting": [],"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ "nosort" ] }]
                   }); 
     $('#pay_mode').change(function(){
            if($(this).val() == 0)
                window.location.href = baseUrl+$(this).val(); //'<?php //echo URL::to('approval/contract-payment-approval') ?>';
            else
                window.location.href = baseUrl+$(this).val();
            //table.fnFilter($(this).val(),6);
     });           
                   
 });   
 (function() {
            $(document).ready(function() {
                      var body, click_event, content, nav, nav_toggler;
              nav_toggler = $("header .toggle-nav");
              nav = $("#main-nav");
              content = $("#content");
              body = $("body");
              click_event = (jQuery.support.touch ? "tap" : "click");
              $("#main-nav .dropdown-collapse").on(click_event, function(e) {
                var link, list;
                e.preventDefault();
                link = $(this);
                list = link.parent().find("> ul");
                if (list.is(":visible")) {
                  if (body.hasClass("main-nav-closed") && link.parents("li").length === 1) {
                    false;
                  } else {
                    link.removeClass("in");
                    list.slideUp(300, function() {
                      return $(this).removeClass("in");
                    });
                  }
                } else {
                  if (list.parents("ul.nav.nav-stacked").length === 1) {
                    $(document).trigger("nav-open");
                  }
                  link.addClass("in");
                  list.slideDown(300, function() {
                    return $(this).addClass("in");
                  });
                }
                return false;
              });
              if (jQuery.support.touch) {
                nav.on("swiperight", function(e) {
                  return $(document).trigger("nav-open");
                });
                nav.on("swipeleft", function(e) {
                  return $(document).trigger("nav-close");
                });
              }
              nav_toggler.on(click_event, function() {
                if (nav_open()) {
                  $(document).trigger("nav-close");
                } else {
                  $(document).trigger("nav-open");
                }
                return false;
              });
              $(document).bind("nav-close", function(event, params) {
                var nav_open;
                body.removeClass("main-nav-opened").addClass("main-nav-closed");
                return nav_open = false;
              });
              return $(document).bind("nav-open", function(event, params) {
                var nav_open;
                body.addClass("main-nav-opened").removeClass("main-nav-closed");
                return nav_open = true;
              });
              });
            this.nav_open = function() {
              return $("body").hasClass("main-nav-opened") || $("#main-nav").width() > 50;
            };
        }).call(this);
 </script>
@stop