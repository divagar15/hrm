@extends('layouts.master')
<?php

?>
@section('content')
  <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Add Pay Grade</span>
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
                        <li class='active'>Add Pay Grade</li>
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
                        <div class='title'>Add Pay Grade</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{URL::to('insert-pay-grade')}}" name="frmsysuser" id="frmsysuser" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='Job Title'>Job Title</label>
                               <div class='controls col-sm-6'>
                                  <select class='form-control' data-rule-required="true"  id='job_title' name='job_title'>
                                      <option value="">Job Title</option>
                                      @foreach($jobTitle as $key => $list)
                                       <option value="{{ $key }}">{{{ $list }}}</option>
                                      @endforeach
                                  </select>
                               </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='min_sal'>Min Salary</label>
                             <div class='col-sm-6 controls'>
                               <input class='form-control'  data-rule-required="true" le="true" id='min_salary' name='min_salary' placeholder='Min Salary' type='text'>
                             </div>
                          </div>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='max-sal'>Max Salary</label>
                             <div class='col-sm-6 controls'>
                               <input class='form-control'  data-rule-required="true" ge="true" id='max_salary' name='max_salary' placeholder='Max Salary' type='text'>
                             </div>
                          </div>
                          <div class="panel-footer">
                                  <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                      <div class="btn-toolbar">
                                        <button class="btn-primary btn" type="submit">Save &amp; Submit</button>
                                        <button class="btn-default btn resetbtn" type="button">Reset</button>
                                      </div>
                                    </div>
                                  </div>
                           </div>
                          </form>
                        </div>
                      </div>
                      <div class='box-content box-no-padding'>
                                  <div class='responsive-table'>
                                    <div class='scrollable-area'>
                                      <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                                        <thead>
                                          <tr>
                                            <th width="25%">Job Title</th>
                                            <th>Min Salary</th>
                                            <th>Max Salary</th>
                                            <th width="20px">Action</th>
                                            </tr>
                                          </thead>
                                        <tbody>
                                        @foreach($payGradeList as $view)
                                          <tr>
                                            <td><a href="{{ URL::to('edit-pay-grade/'.$view->id) }}">{{{ ucwords($view->job_title) }}}</a></td>
                                            <td>{{{ $view->min_salary }}}</td>
                                            <td>{{{ $view->max_salary  }}}</td>
                                            <td><a class='btn btn-danger btn-xs has-tooltip confirm-delete'  data-placement="top" data-original-title="Delete" href='javascript:void(0);' data-id="{{ $view->id }}"><i class='icon-remove'></i>&nbsp;Delete</a></td>
                                          </tr>
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
          $.validator.addMethod('le', function(value, element, param) {
                return  parseInt(value) <= parseInt($('#max_salary').val());
          }, 'Must be less than or equal to Max Salary');
          $.validator.addMethod('ge', function(value, element, param) {
                return parseInt(value) >= parseInt($('#min_salary').val());
          }, 'Must be greater than or equal to Min Salary');
          $('.resetbtn').click(function(){
             $('#job_title').val('');
             $('#min_salary').val('');
             $('#max_salary').val('');
          });
          $('.confirm-delete').click(function(){
             var id = $(this).data('id');
             if(confirm('Are you sure delete this pay grade?')) {
                window.location.href = 'delete-pay-grade/'+id;
             }
          });
    });
</script>
@stop
