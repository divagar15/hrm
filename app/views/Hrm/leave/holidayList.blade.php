@extends('layouts.master')
@section('content')
<?php  $holidayType = Config::get('local.holiday_type'); ?>
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Holiday List</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li><i class="icon-folder-open"></i></li>
                                <li class="separator"><i class="icon-angle-right"></i></li>
                                <li><a href="{{ URL::to('config/configure-panel') }}">Configure Panel</a></li>
                                <li class="separator"><i class="icon-angle-right"></i></li>
                                <li><a href="{{ URL::to('calendar/calendar-list') }}">Calendar List</a></li>
                                <li class="separator"><i class="icon-angle-right"></i></li>
                                <li class="active">Holiday List</li>
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
                        <a href="{{ URL::to('leave/add-holiday')}}">
                        <div class="header">
                        <div class="icon-comments"></div>
                        </div>
                        <div class="content">Add Holiday</div>
                        </a>
                        </div>
                        </div>
                     </div>
                    <div class='box-header  blue-background'>
                      <div class='title'>Holiday List</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>Holiday Name</th>
                                <th>Holiday Type</th>
                                <th>Day</th>
                                <th>Holiday Date</th>
                                <th width="1%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($holiday_list)) 
                             @foreach($holiday_list as $view) 
                                <tr>
                                    <td><a href="{{ URL::to('leave/edit-holiday/'.$view->id)}}">{{ $view->holiday_name }}</a></td>
                                    <td>{{ array_key_exists($view->holiday_type,$holidayType) ? $holidayType[$view->holiday_type] : '-' }}</td>
                                    <td>{{ date('l',strtotime($view->holiday_date)) }}</td>
                                    <td>{{ date('d-m-Y',strtotime($view->holiday_date)) }}</td>
                                    <td>
                                    <a class="btn btn-primary btn-xs has-tooltip" href="{{ URL::to('leave/edit-holiday/'.$view->id)}}" data-original-title="Edit" data-placement="top">Edit</a>
                                    <a class="btn btn-danger btn-xs has-tooltip confirm-delete" data-id="{{ $view->id }}" href="javascript:void(0);" data-original-title="Delete" data-placement="top">Delete</a>
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
@include('includes.jscript')
<script>
    $(document).ready(function(){
        var url = "<?php echo URL::to('leave/delete-holiday/'); ?>";
        $('.confirm-delete').click(function(){
        var id = $(this).data('id');
        if(confirm('Are you sure want to delete this holiday date then the holiday will be removed from calendar also?')) {
            window.location.href = url+'/'+id;
        }
        });
    }); 
</script>
@stop