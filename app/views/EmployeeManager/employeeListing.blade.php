@extends('layouts.master')
<?php
$branch      =   Config::get('local.branchlist');
$resStatus   =   Config::get('local.resultStatus'); 
$leadMode    =   Config::get('local.leadMode');
?>
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Employee Listing</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
		                         <li>
		                            <i class='icon-folder-open '></i>
		                        </li>
		                        <li class='separator'>
		                          <i class='icon-angle-right'></i>
		                        </li>
		                        <li>
		                          HRM
		                        </li>
		                        <li class='separator'>
		                          <i class='icon-angle-right'></i>
		                        </li>
		                        <li>
		                          Employee
		                        </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                
                                <li class="active">Employee list</li>
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
                                       <i class="icon-ok-sign"></i>
                                       Success
                                       </h4>
                                    {{Session::get('erroralert')}}
                            </div>
                            @endif

                            <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Leave Report Filter</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{URL::to('employee')}}" name="frmleave" id="frmleave" method="post" style='margin-bottom: 0;'>
                           
                             <div class="form-group">
                                    <label class='control-label col-sm-3' for='branch'>Branch</label>
                                     <div class='controls col-sm-6'>
                                     <select class="form-control" id="branch" name="branch">
                                        <option value="0" selected>All</option>
                                        @foreach($branches as $branch)
                                        <?php 
                                           if($branch->id==$br)
                                            $selected = 'selected';
                                           else
                                            $selected = '';
                                        ?>
                                          <option value="{{ $branch->id }}" {{ $selected }}>{{ ucwords($branch->branch_name) }}</option>
                                        @endforeach
                                     </select>
                                     </div>
                            </div>  

                             <div class="form-group">
                                    <label class='control-label col-sm-3' for='branch'>Cessation Code</label>
                                     <div class='controls col-sm-6'>
                                     <select class="form-control" id="cessation" name="cessation">
                                        <option value="" selected>Select</option>
                                        @foreach($cessation as $cess)
                                        <?php 
                                           if($cess->id==$cd)
                                            $selected = 'selected';
                                           else
                                            $selected = '';
                                        ?>
                                          <option value="{{ $cess->id }}" {{ $selected }}>{{ ucwords($cess->cessation_code) }}</option>
                                        @endforeach
                                     </select>
                                     </div>
                            </div>  
                                                
                          <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-5">
                                      <div class="btn-toolbar">
                                        <button class="btn-primary btn" type="submit">Submit</button>
                                        <button class="btn-default btn resetbtn" type="button">Reset</button>
<!--                                         <button class="btn-primary btn" type="button" onclick="generatePdf();">Export to PDF</button>
 -->                                      </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                      </div>

                         <!-- alert box section end -->
                        <div class='box-header blue-background'>
                          <div class='title'>Employee List</div>
                          <!-- <div class='actions'>
                            <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                            </a>

                            <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                            </a>
                          </div> -->
                        </div>
                  </div>
                </div>
                        <div class='box-content box-no-padding'>
                                  <div class='responsive-table'>
                                    <div class='scrollable-area'>
                                      <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                        <thead>
                                          <tr>
                                            <th></th>
                                            <th>EID</th>
                                            <th>Name</th>
                                            <th>DOJ</th>
                                            <th>Designation</th>
                                            <th>Branch</th>
                                            <th>Cessation Code</th>
                                            <th>Cessation Date</th>
                                          <!--   <th width="5%">Action</th> -->
                                            </tr>
                                          </thead>
                                        <tbody>
                                        <?php $i=1; ?>
                                        @foreach($sysList as $view)
                                          <tr>
                                            <td>{{$i}}</td>
                                            <td>{{{ $view->employee_id }}}</td>
                                            <td><a href="{{ URL::to('employee/view-employee-profile/'.$view->id) }}">{{{ ucwords($view->emp_name) }}}</a></td>
                                            <td>{{{ date('d-m-Y',strtotime($view->hire_date)) }}}</td>
                                            <td>{{{ ucwords($view->job_title) }}}</td>
                                            <td>{{{ ucwords($view->branch_name) }}}</td>
                                            <td>{{{ ucwords($view->cessation_code) }}}</td>
                                             <td>
                                              @if($view->cessation_date!=0)  {{ date('d-m-Y',strtotime($view->cessation_date)) }} @endif
                                            </td>
                                           <!--  <td>
                                              <div class='text-right'>
                                                <a class='btn btn-success btn-xs has-tooltip'  data-placement="top" data-original-title="View" href='{{ URL::to("system-user/".base64_encode($view->id)) }}'>
                                                    <i class='icon-ok'></i>
                                                </a>
                                                <a class='btn btn-success btn-xs has-tooltip'  data-placement="top" data-original-title="Edit" href='{{  URL::to("system-user/".base64_encode($view->id)."/edit") }}'>
                                                    <i class='icon-edit'></i>
                                                </a>
                                                <a class='btn btn-danger btn-xs has-tooltip'  data-placement="top" data-original-title="Delete" href='#'>
                                                  <form method="POST" action="{{ URL::to('system-user/'.base64_encode($view->id)) }}" accept-charset="UTF-8">
                                                      <input name="_method" type="hidden" value="DELETE">
                                                      <i class='icon-remove confirm_delete'>
                                                      </i>
                                                </form>
                                                </a> 
                                              </div>
                                            </td>-->
                                          </tr>
                                          <?php $i++; ?>
                                          @endforeach
                                        </tbody>
                                      </table>
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
            if(confirm('Are sure to delete this user?')) {
                $(this).parent('form').submit();
            } else {
                return false;
            }
         });
         $('.emaillink').click(function(){
               var emailId  = $(this).data('val');
               $('#email_id').val(emailId);
         });
    });
  
</script>
@stop