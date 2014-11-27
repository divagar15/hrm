@extends('layouts.master')
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Maid Arrival Listing</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>
                                <a href="javascript::">
                                <i class="icon-bar-chart"></i>
                                </a>Contract Management
                                </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">Maid Arrival Listing</li>
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
                    	              <div class='row' style="margin-left:0px;">
			                <div class='col-sm-12'>
			                  <div class='box bordered-box blue-border' style='margin-bottom:0; width: 100%;'>
			                    <div class='box-header blue-background'>
			                      <div class='title'>Maid Arrival Listing</div>
			                    </div>
			                    <div class='box-content box-no-padding'>
			                      <div class='responsive-table'>
			                        <div class='scrollable-area'>
			                         @if(!empty($arrival_list))
			                          <table class='data-table-column-filter table table-bordered table-striped dataTable' style='margin-bottom:0;'>
			                            <thead>
			                              <tr width="30%">
			                                <th>
			                                  Contract Number
			                                </th>
			                                <th>
			                                 Maid Name
			                                </th>
			                                <th>
			                                  Customer Name
			                                </th>
			                                <th>
			                                  Target Date
			                                </th>
			                                <th>
			                                  Actual Date
			                                </th>
			                              </tr>
			                            </thead>
			                            <tbody>
			                             @foreach($arrival_list as $alist)
			                              <tr>
                                                        <td><a href="{{ URL::to('edit-contract/step5/'.$alist->contract_id) }}">{{ $alist->contract_no }}</a></td>
			                                <td>{{ ucwords($alist->maid_name) }}</td>
			                                <td>{{ ucwords($alist->customer_name) }}</td>
			                                <td>{{ $alist->target_date != '' ? $alist->target_date : '-' }}</td>
			                                <td>{{ $alist->arrival_date != '' ? $alist->arrival_date : '-' }}</td>
			                              </tr>
			                              @endforeach
			                            </tbody>
			                          </table>
			                          @endif
			                        </div>
			                      </div>
			                    </div>
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