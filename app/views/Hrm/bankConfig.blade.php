@extends('layouts.master')
 <?php
 $baseUrl    = Config::get('local.baseUrl');
 ?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Bank Details</span>
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
                          Config
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Update Bank Details</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class='col-sm-12'>
                  @if(Session::has('successalert'))
                        <div class="alert alert-success alert-dismissable">
                               <a class="close" href="#" data-dismiss="alert">× </a>
                                   <h4>
                                   <i class="icon-ok-sign"></i>
                                   Success
                                   </h4>
                                {{ Session::get('successalert') }}
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
                       <div class="row">
                        <div class="col-sm-12">
                        <div class="pull-right">
                        <!-- <a class="btn btn-warning btn-xs has-tooltip" data-placement="top" data-original-title="Back" href="{{ URL::to('company/config/bank/') }}">Back</a> -->
                        </div>
                        </div>
                        </div>  
                      <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Update Bank Details</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('company/config/bank/') }}" name="frmbank" id="frmbank" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='name'>Bank</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' data-rule-minlength="2"  id='name' name='name' placeholder="Bank Name" type='text' value="{{ $view->bank }}">
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='name'>Branch</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' data-rule-minlength="2"  id='branch' name='branch' placeholder="Branch Name" type='text' value="{{ $view->branch }}">
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='name'>Account No</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' data-rule-minlength="2"  id='account_no' name='account_no' placeholder="Account Number" type='text' value="{{ $view->account_no }}">
                             </div>
                          </div>
                          
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar" id="edit-mode">
                                          <button class="btn-primary btn" type="submit" id="add-btn">Save & Submit</button>
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
@stop