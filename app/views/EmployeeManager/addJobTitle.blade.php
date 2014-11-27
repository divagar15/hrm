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
                      <span>Add Designation</span>
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
                        <li class='active'>Add Designation</li>
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
                        <div class='title'>Add Designation</div>
                      </div>
                      <div class='box-content'>
                        <form class='form form-horizontal validate-form' action="{{URL::to('config/create-designation')}}" name="frmsysuser" id="frmsysuser" method="post" style='margin-bottom: 0;'>
                          <div class='form-group'>
                             <label class='control-label col-sm-3' for='Job Title'>Designation</label>
                              <div class='col-sm-6 controls'>
                               <input class='form-control'  data-rule-required="true" le="true" id='job_title' name='job_title' placeholder='Designation' type='text'>
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
                                            <th width="25%">Designation</th>                                            
                                            <th width="20px">Actions</th>
                                            </tr>
                                          </thead>
                                        <tbody>
                                        @foreach($jobTitleList as $view)
                                          <tr>
                                            <td><a href="{{ URL::to('config/edit-designation/'.$view->id) }}">{{ ucwords($view->job_title) }}</a></td>                                            
                                            <td width="50%">
                                            <a class="btn btn-primary btn-xs has-tooltip" data-original-title="Edit" data-placement="top" href="{{ URL::to('config/edit-designation/'.$view->id) }}">Edit</a>
                                            <a class='btn btn-danger btn-xs has-tooltip confirm-delete'  data-placement="top" data-original-title="Delete" href='javascript:void(0);' data-id="{{ $view->id }}"><i class='icon-remove'></i>&nbsp;Delete</a>
                                            </td>
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
          $('.resetbtn').click(function(){
             $('#job_title').val('');         
          });
        var url = "<?php echo URL::to('config/delete-designation/'); ?>";
        $('.confirm-delete').click(function(){
        var id = $(this).data('id');
        if(confirm('Are you sure want to delete this designation?')) {
            window.location.href = url+'/'+id;
        }
        });
    });
</script>
@stop
