@extends('layouts.master')
 <?php
 $baseUrl    = Config::get('local.baseUrl');
 $holidayType = Config::get('local.holiday_type');
 ?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Edit Designation</span>
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
                          Designation
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Edit Designation</li>
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
                        <a class="btn btn-warning btn-xs has-tooltip" data-placement="top" data-original-title="Back" href="{{ URL::to('config/designation/') }}">Back</a>
                        </div>
                        </div>
                        </div>  
                      <div class='box'>
                      <div class='box-header blue-background'>
                        <div class='title'>Edit Designation</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{ URL::to('config/edit-designation/'.$id) }}" name="frmrace" id="frmrace" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='name'>Designation</label>
                             <div class='col-sm-6 controls'>
                               <input class="form-control" data-rule-required='true' data-rule-minlength="2"  id='name' name='name' type='text' value="{{ $view->job_title }}">
                             </div>
                          </div>
                           <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar" id="edit-mode">
                                          <button class="btn-primary btn" type="submit" id="add-btn">Save &amp; Submit</button>
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