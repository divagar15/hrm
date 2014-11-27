@extends('layouts.master')
@section('content')
<?php
$coaGroup     = Config::get('local.coaGroup');
?>
<div id="content-wrapper" class="row">
       <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <h1 class="pull-left">
                            <i class="icon-table"></i>
                            <span>Allowances</span>
                        </h1>
                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>
                                <a href="javascript::">
                                <i class="icon-bar-chart"></i>
                                </a>Config
                                </li>
                                <li class="separator">
                                <i class="icon-angle-right"></i>
                                </li>
                                <li class="active">Allowances</li>
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
                        <a href="{{ URL::to('employee/config/add-allowance')}}">
                        <div class="header">
                        <div class="icon-comments"></div>
                        </div>
                        <div class="content">Add Allowance</div>
                        </a>
                        </div>
                        </div>
                     </div>
                    <div class='box-header  blue-background'>
                      <div class='title'>Allowances</div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>Allowances</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($allowances)) 
                             @foreach($allowances as $view) 
                                <tr>
                                    <td><a href="{{ URL::to('employee/config/edit-allowance/'.$view->id)}}">{{ ucfirst($view->allowance) }}</a></td>
                                    <td>
                                     <a class="btn btn-primary btn-xs has-tooltip" data-original-title="Edit" data-placement="top" href="{{ URL::to('employee/config/edit-allowance/'.$view->id)}}">Edit</a>
                                     <a class="btn btn-danger btn-xs has-tooltip confirm-delete" data-id="{{ $view->id }}" data-coa="{{ $view->fkcoa_id }}" data-original-title="Delete" data-placement="Delete">Delete</a>
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
        var url = "<?php echo URL::to('employee/config/delete-allowance/'); ?>";
        $('.confirm-delete').click(function(){
        var id  = $(this).data('id');
        var coa = $(this).data('coa');
        if(confirm('Are you sure want to delete this allowance?')) {
            window.location.href = url+'/'+id+'/'+coa;
        }
        });
    }); 
</script>
@stop