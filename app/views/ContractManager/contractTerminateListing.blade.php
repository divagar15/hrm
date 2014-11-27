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
 if(Request::has('process'))
    $fstatus   = Request::get('process');
 else 
    $fstatus   = Request::get('status'); 
 $feeType = Config::get('local.feeType');
 $role   = Session::get('role');
?>
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Contract Terminate</span>
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
                    <div class='box-header  blue-background'>
                      <div class='title'>Contract Terminate</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' width="100%" style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th width="10%">Customer Name</th>
                                <th width="5%">Contract No</th>
                                <th width="7%">
                                    Assigned
                                </th>
                                <th width="5%">
                                 Status
                                </th>
                                <th width="5%">
                                   Branch
                                </th>
                                <th width="5%">
                                   Actions
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($contractList)) 
                             @foreach($contractList as $view) 
                               <?php 
                                           $termination = '';
                                           if($view->ter_tmp_status==2) {
                                            $termination = 'Full Termination';
                                           } else if($view->ter_tmp_status==3) {
                                            $termination = 'Partial Termination';
                                           } else if($view->ter_tmp_status==4) {
                                            $termination = 'Replacement';
                                           }
                                ?>
                                <tr>
                                <td><a class="view-termiante-fee" data-toggle='modal' data-id= "{{ $view->contract_id }}" data-cust= "{{ ucwords($view->customer_name) }}" href="#terminate_fee">{{ ucwords($view->customer_name) }}</a></td>
                                <td>{{ $view->contract_no }}</td>
                                <td>{{ $view->emp_name }}</td>
                                <td>{{ $termination }}</td>
                                <td>{{ $view->branch_name}}</td>
                                <td>
                                   @if($view->ter_approval == 0 && $role == 1)
                                   <a class="btn btn-primary  btn-xs has-tooltip"  data-original-title="Approval" data-placement="top" href="{{ URL::to('contract/contract-approval/'.$view->ter_tmp_status.'/'.$view->contract_id) }}">Approval</a> 
                                   @elseif($view->issue_cheque==0 && $role == 1)
                                    <a class="btn btn-primary btn-xs has-tooltip" onclick="issueCheque({{ $view->id }});"  data-original-title="Issue Cheque" data-placement="top">Issue Cheque</a> 
                                   @elseif($view->issue_cheque==1 && $role == 1)
                                        @if($view->payment_id != '')
                                            <a class="btn btn-primary btn-xs has-tooltip" href="{{ URL::to('account/payment/print_payment/'.$view->payment_id) }}"   data-original-title="Print Payment" data-placement="top">Print Payment</a> 
                                        @else 
                                        {{ "Cheque Issued" }}
                                        @endif
                                    @elseif($view->issue_cheque==2)    
                                       <a class="btn btn-xs has-tooltip" href="javascript:void(0)"   data-original-title="No Payment" data-placement="top">No Payment</a> 
                                    @elseif($view->issue_cheque==3)    
                                    <a class="btn btn-primary btn-xs has-tooltip" href="javascript:void(0)" onclick="return recontract({{ $view->customer_id }});" data-original-title="Re-Contract" data-placement="top">Re-Contract</a> 
                                    @else
                                       <a class="btn btn-xs has-tooltip" href="javascript:void(0)"   data-original-title="No Access" data-placement="top">No Action</a> 
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
                  </div>
                </div>
              </div>
       </div>
</div>

<div class='modal fade' id='terminate_fee' tabindex='-1'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                            <h4 class='modal-title' id='myModalLabel'>Termination Details</h4>
                          </div>
                          <div class='modal-body'>
                              <p><strong>Customer Name</strong>&nbsp;:<span id="customer_name"></span></p>
                              <p><strong>Termination Type</strong>&nbsp;:<span id="ter_type"></span></p>
                              <p><strong>Termination Date</strong>&nbsp;:<span id="ter_date"></span></p>
                              <table id="theader" width="90%" border="1">
                              </table>
                          </div>
                          <div class='modal-footer'>
                            
          <button class='btn btn-default btn-xs' data-dismiss='modal' type='button'>Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
@include('includes.jscript')
<script>
  function issueCheque(id) {
    var answer = confirm ("Can You Issue Cheque Now?")
        if (answer) {
          window.location.href = "<?php echo URL::to('contract/cheque-issue/'); ?>/"+id;
        }
  }
  
  function recontract(id) {
       var answer = confirm ("Are you sure to recontract?")
        if (answer) {
          window.location.href = "<?php echo URL::to('create-contract/step1/'); ?>/"+id+"/customer?r=1";
        }
        }
   /* $(document).ready(function(){
        $('.confirm_delete').click(function(){
            if(confirm('Are sure to delete this profile?')) {
                $(this).parent('form').submit();
            } else {
                return false;
            }
         });
          var table = $('.data-table-column-filter').dataTable({"aaSorting": [],
                        "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ "nosort" ] }]
                        });
        var baseUrl  = '<?php //echo URL::to('contract-list') ?>';
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
        }).call(this);*/
  
  $('.view-termiante-fee').click(function(){
          id = $(this).data('id');
          $('#customer_name').html($(this).data('cust'));
          
          var vhtml ='';
          $.ajax({
             type : 'POST',
             url  : actionPath+'contract/ajax-call',
             data : 'actionCall=terminateContract&getId='+id,
             success:function(response){
                 if(response != 0){
                     $('#theader').html('');
                      /*vhtml +='<tr>';
                      vhtml +='<th>Leave Type</th>';
                      vhtml +='<th style="text-align: center;">No of days</th>';
                      vhtml +='</tr>';*/
                     var obj = $.parseJSON(response);
                    // $.each(obj,function(i,val){

                        $("#ter_date").html(obj.terminate_date);

                        var type = '';
                        if(obj.contract_cases==2) {
                          var type = 'Full Termination';
                        } else if(obj.contract_cases==3) {
                          var type = 'Partial Termination';
                        }

                        $("#ter_type").html(type);

                        var total = 0.00;

                        total += Number(obj.ter_admin_fee)+Number(obj.ter_insurance_fee)+Number(obj.ter_agency_fee)+Number(obj.ter_loan_fee);

                         vhtml += '<tr>'; 
                         vhtml += '<th>Admin Fee</th><td align="right">'+obj.ter_admin_fee+'</td>';
                         vhtml += '</tr>';

                         vhtml += '<tr>'; 
                         vhtml += '<th>Insurance Fee</th><td align="right">'+obj.ter_insurance_fee+'</td>';
                         vhtml += '</tr>';

                         vhtml += '<tr>'; 
                         vhtml += '<th>Agency Fee</th><td align="right">'+obj.ter_agency_fee+'</td>';
                         vhtml += '</tr>';

                         vhtml += '<tr>'; 
                         vhtml += '<th>Loan Balance</th><td align="right">'+obj.ter_loan_fee+'</td>';
                         vhtml += '</tr>';

                         vhtml += '<tr>'; 
                         vhtml += '<th>Total</th><td align="right">'+total+'</td>';
                         vhtml += '</tr>';
                     //});
                     $('#theader').append(vhtml);
                 }
             }
          });
       });

</script>
@stop