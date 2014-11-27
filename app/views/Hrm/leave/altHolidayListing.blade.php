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
                            <span>Alternate Holiday List</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li><i class="icon-folder-open"></i></li>
                                <li class="separator"><i class="icon-angle-right"></i></li>
                                <li><a href="{{ URL::to('config/configure-panel') }}">Configure Panel</a></li>
                                <li class="separator"><i class="icon-angle-right"></i></li>
                                <li><a href="{{ URL::to('calendar/calendar-list') }}">Calendar List</a></li>
                                <li class="separator"><i class="icon-angle-right"></i></li>
                                <li class="active">Alternate Holiday List</li>
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
                      <div class="row box box-transparent">
                        <div class="col-xs-4 col-sm-2">
                        <div class="box-quick-link blue-background">
                        <a href="{{ URL::to('leave/add-alt-holiday')}}">
                        <div class="header">
                        <div class="icon-comments"></div>
                        </div>
                        <div class="content">Add</div>
                        </a>
                        </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                             <div class="box-quick-link green-background">
                                <a href="{{ URL::to('calendar/assign-alt-holiday')}}">
                                    <div class="header">
                                        <div class="icon-table"></div>
                                    </div>
                                    <div class="content">Assign</div>
                                </a>
                            </div>
                         </div>  
                        <div class="col-xs-4 col-sm-2">
                             <div class="box-quick-link orange-background">
                                <a href="{{ URL::to('calendar/assign-alt-holiday-list')}}">
                                    <div class="header">
                                        <div class="icon-eye-open"></div>
                                    </div>
                                    <div class="content">View</div>
                                </a>
                            </div>
                         </div>
                     </div>
                    <div class='box-header  blue-background'>
                      <div class='title'>Alternate Holiday List</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>Alter Holiday Name</th>
                                <th>Alter Holiday Date</th>
                                <th>For Holiday</th>
                                <th>For Holiday Date</th>
                                <th width="1%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($alt_leave)) 
                             @foreach($alt_leave as $view) 
                                <tr>
                                    <td><a href="{{ URL::to('leave/edit-alt-holiday/'.$view->alt_id)}}">{{ $view->alt_holiday_name }}</a></td>
                                    <td>{{ date('d-m-Y',strtotime($view->alt_holiday_date)).' - '.date('l',strtotime($view->alt_holiday_date)) }}</td>
                                    <td>{{ $view->holiday_name }}</td>
                                    <td>{{ date('d-m-Y',strtotime($view->holiday_date)).' - '.date('l',strtotime($view->holiday_date)) }}</td>
                                    <td><a class="btn btn-danger btn-xs has-tooltip confirm-delete" data-id="{{ $view->alt_id }}" href="javascript:void(0);" data-original-title="Delete" data-placement="top">Delete</a></td>
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
        var url = "<?php echo URL::to('leave/delete-alt-holiday/'); ?>";
        $('.confirm-delete').click(function(){
        var id = $(this).data('id');
        if(confirm('Are you sure delete this holiday date?')) {
            window.location.href = url+'/'+id;
        }
        });
    }); 
</script>
@stop