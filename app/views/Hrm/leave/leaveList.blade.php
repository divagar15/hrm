@extends('layouts.master')
@section('content')
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Leave Types</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>
                                <a href="javascript::">
                                <i class="icon-bar-chart"></i>
                                </a>Leave Config
                                </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">Leave Types</li>
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
                     <!-- alert box section end -->
                     <!-- <div class="col-sm-12">
                         <a href="" class="btn-primary btn">Add Holiday</a>
                     </div>-->
                     
                     <div class="row box box-transparent">
                        <div class="col-xs-4 col-sm-2">
                        <div class="box-quick-link blue-background">
                        <a href="{{ URL::to('leave/add-leave-type')}}">
                        <div class="header">
                        <div class="icon-comments"></div>
                        </div>
                        <div class="content">Add Leave Type</div>
                        </a>
                        </div>
                        </div>
                     </div>
                    <div class='box-header  blue-background'>
                      <div class='title'>Leave Types</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th width="6%">S.No</th>
                                <th>Leave Type</th>
                                <th width="15%">No of days Leave</th>
                                <th width="1%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                              $i=1;
                            ?>
                             @if(!empty($leaveList)) 
                             @foreach($leaveList as $view) 
                                <tr>
                                <td>{{ $i }}</td>
                                <td><a href="{{ URL::to('leave/edit-leave-type/'.$view->id)}}">{{ ucwords($view->leave_type) }}</a></td>
                                <td>{{ $view->leave_count }}</td>
                                
                                <td>
                                 <a class="btn btn-primary btn-xs has-tooltip" data-original-title="Delete" data-placement="top" href="{{ URL::to('leave/edit-leave-type/'.$view->id)}}">Edit</a>
                                 <a class="btn btn-danger btn-xs has-tooltip confirm-delete" data-id="{{ $view->id }}" data-original-title="Delete" data-placement="Delete">Delete</a>
                                </td>
                              </tr>
                              <?php
                                $i++;
                              ?> 
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
        var url = "<?php echo URL::to('leave/delete-leave-type/'); ?>";
        $('.confirm-delete').click(function(){
        var id = $(this).data('id');
        if(confirm('Are you sure delete this leave type?')) {
            window.location.href = url+'/'+id;
        }
        });
    }); 
</script>
@stop