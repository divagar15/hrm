@extends('layouts.master')
<?php
 $processMode  = Config::get('local.process_status');
 Session::forget('customerId');
 Session::forget('bioId');
 Session::forget('contract_id');
 Session::forget('contract_no');
 Session::forget('app_status');
 Session::forget('app_id');
 $fbranchId = Request::get('branch');
 $fassign   = Request::get('assign');
 $contractMode = Config::get('local.contractMode');
 if(Request::has('process'))
    $fstatus   = Request::get('process');
 else 
    $fstatus   = Request::get('status'); 
 $feeType = Config::get('local.feeType');
?>
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Contract Manager</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>
                                <a href="javascript::">
                                <i class="icon-bar-chart"></i>
                                </a>
                                </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">Contract Management Process</li>
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
                                         <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Contract Manager</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{URL::to('contract-list')}}" name="frmcontract" id="frmcontract" method="get" style='margin-bottom: 0;'>
                            <div class="form-group">
                                    <label class='control-label col-sm-3' for='filter_by'>Filter By</label>
                                     <div class='controls col-sm-6'>
                                     <select class="form-control" id="filter_by" name="filter_by">
                                        <option value="0" {{ isset($filter_by) && $filter_by == 0 ? "selected='selected'" : '' }}>Contract In-process</option> 
                                        <option value="1" {{ isset($filter_by) && $filter_by == 1 ? "selected='selected'" : '' }}>All Contract</option>
                                     </select>
                                     </div>
                            </div>
                            <div class="form-group">
                                    <label class='control-label col-sm-3' for='f_by_date'>Sort By Date</label>
                                     <div class='controls col-sm-6'>
                                     <select class="form-control" id="f_by_date" name="f_by_date">
                                        <option value="0">Sort By date</option> 
                                        <option value="1" {{ isset($filter_by_date) && $filter_by_date == 1 ? "selected='selected'" : '' }}>Asc</option> 
                                        <option value="2" {{ isset($filter_by_date) && $filter_by_date == 2 ? "selected='selected'" : '' }}>Desc</option>
                                     </select>
                                     </div>
                            </div>
                          <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-5">
                                      <div class="btn-toolbar">
                                        <button class="btn-primary btn" type="submit">Submit</button>
                                        <button class="btn-default btn" type="reset">Reset</button>
                                      </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                      </div>
                    <div class='box-header  blue-background'>
                      <div class='title'>CRM</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' width="125%" style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th width="10%">Contract no</th>  
                                <th width="20%">Employer Name</th>
                                <th width="10%">Maid</th>
                                <th width="10%">Supplier</th>
                                <th width="120%">Sales Personnel</th>
                                <th width="10%">Date</th>
                                <th style="display:none;"></th>
                                <th width="10%">Submit</th>
                                <th style="display:none;"></th>
                                <th width="10%">Approve</th>
                                <th style="display:none;"></th>
                                <th width="10%">Insurance</th>
                                <th style="display:none;"></th>
                                <th width="10%">Arrival</th>
                                <th style="display:none;"></th>
                                <th width="10%">Handover</th>
                                <th style="display:none;"></th>
                                <th width="10%">E-issue</th>
                                <th style="display:none;"></th>
                                <!--<th width="10%" class="nosort">
                                    @if(!empty($assign_list))
                                        <select name="assigned" id="assigned" class="select-filter" data-filter='assign' style="width:100%;">
                                                <option value="0">Assigned</option>
                                                @foreach($assign_list as $as)
                                                   <option value="{{ $as->emp_id }}" {{ isset($fassign) && $fassign == $as->emp_id  ? "selected=selected" : '' }}>{{ $as->emp_name }}</option>
                                                @endforeach
                                       </select>
                                   @endif
                                </th>-->
                                <th width="10%" class="nosort">
                                 @if(!empty($processMode))
                                        <select name="status" id="status" class="select-filter" data-filter='process' style="width:100%;">
                                                <option value="0">Status</option>
                                                @foreach($processMode as $key => $s)
                                                   <option value="{{ $key }}" {{ isset($fstatus) && $fstatus == $key  ? "selected=selected" : '' }}>{{ ucwords($s) }}</option>
                                                @endforeach
                                       </select>
                                   @endif
                                </th>
                               <th width="14%">Contract Mode</th>
                               <th width="5%" class="nosort">
                                   @if($role == 1)
                                    @if(!empty($branch_list))
                                        <select name="branch" id="branch" class="select-filter" data-filter='branch' style="width:120px;">
                                                <option value="0">Branch</option>
                                                @foreach($branch_list as $key => $b)
                                                   <option value="{{ $key }}" {{ isset($fbranchId) && $fbranchId == $key  ? "selected=selected" : '' }}>{{ ucwords($b) }}</option>
                                                @endforeach
                                       </select>
                                   @endif
                                   @else
                                    Branch
                                   @endif
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($contractList)) 
                             @foreach($contractList as $key => $view) 
                                <tr>
                                <td>{{ $view->contract_no }}</td>    
                                <td><a href='{{ URL::to("edit-contract/step".$view->process_status ."/".$view->id) }}'>{{ ucwords($view->customer_name) }}</a></td>
                                <td>{{ ucwords($view->maid_name) }}</td>
                                <td>{{ ucwords($view->agency_name) }}</td>
                                <td>{{ ucwords($view->emp_name) }}</td>
                                <td>{{ $view->contract_from !='' && $view->contract_from != 0 ? date('d-m-Y',strtotime($view->contract_from)) : ''  }}</td>
                                <td style="display:none;">{{ $view->contract_from !='' && $view->contract_from != 0 ? date('Ymd',strtotime($view->contract_from)) : ''  }}</td>
                                <td>{{ $view->date_customer_sign !='' && $view->date_customer_sign != 0 ? date('d-m-Y',strtotime($view->date_customer_sign)) : ''  }}</td>
                                <td style="display:none;">{{ $view->date_customer_sign !='' && $view->date_customer_sign != 0 ? date('Ymd',strtotime($view->date_customer_sign)) : ''  }}</td>
                                <td>{{ $view->app_approval_date !='' && $view->app_approval_date != 0 ? date('d-m-Y',strtotime($view->app_approval_date)) : ''  }}</td>
                                <td style="display:none;">{{ $view->app_approval_date !='' && $view->app_approval_date != 0 ? date('Ymd',strtotime($view->app_approval_date)) : ''  }}</td>
                                <td>{{ $view->insurance_sub_date !='' && $view->insurance_sub_date != 0 ? date('d-m-Y',strtotime($view->insurance_sub_date)) : ''  }}</td>
                                <td style="display:none;">{{ $view->insurance_sub_date !='' && $view->insurance_sub_date != 0 ? date('Ymd',strtotime($view->insurance_sub_date)) : ''  }}</td>
                                <td>{{ $view->arrival_date !='' && $view->arrival_date != 0 ? date('d-m-Y',strtotime($view->arrival_date)) : ''  }}</td>
                                <td style="display:none;">{{ $view->arrival_date !='' && $view->arrival_date != 0 ? date('Ymd',strtotime($view->arrival_date)) : ''  }}</td>
                                <td>{{ $view->handover_date !='' && $view->handover_date != 0 ? date('d-m-Y',strtotime($view->handover_date)) : ''  }}</td>
                                <td style="display:none;">{{ $view->handover_date !='' && $view->handover_date != 0 ? date('Ymd',strtotime($view->handover_date)) : ''  }}</td>
                                <td>{{ $view->e_issue_date !='' && $view->e_issue_date != 0 ? date('d-m-Y',strtotime($view->e_issue_date)) : ''  }}</td>
                                <td style="display:none;">{{ $view->e_issue_date !='' && $view->e_issue_date != 0 ? date('Ymd',strtotime($view->e_issue_date)) : ''  }}</td>
                                <td>{{ array_key_exists($view->process_status,$processMode) ? $processMode[$view->process_status] : '-' }}</td>
                                <td>{{ array_key_exists($view->contract_cases,$contractMode) ? $contractMode[$view->contract_cases] : '-' }}</td>
                                <td>{{ $view->branch_name }}</td>
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
<script>
    $(document).ready(function(){
        $('.confirm_delete').click(function(){
            if(confirm('Are sure to delete this profile?')) {
                $(this).parent('form').submit();
            } else {
                return false;
            }
         });
          var table = $('.data-table-column-filter').dataTable({"aaSorting": [],
                        "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ "nosort" ] },{ "iDataSort": 7, "aTargets": [ 6 ] }]
                        });
        var baseUrl  = '<?php echo URL::to('contract-list') ?>';
        $('.select-filter').change(function(){
           var fvalue = $(this).val();
           var queryString = '?'+$(this).data('filter')+'='+fvalue;
           if(fvalue == 0)
               window.location.href = baseUrl;
           else
               window.location.href = baseUrl+queryString;
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