<?php
$arr_field = [
    'title' => _t('title'),
    'description' => _t('description'),
    'category_name' => _t('category'),
    'image' => _t('image'),
    'status' => _t('status'),
];


/*`role_id` int(11) DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',*/
?>


@extends('layouts.admin-list')

@section('title',_t('Post'))

@section('content')

    <div class="row show-grid">
        <div class="col-md-12">
            <div class="portlet light bordered" style="margin-bottom: 0px !important;">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-social-dribbble font-green hide"></i>
                    <span class="caption-subject font-dark bold uppercase">{{ _t('Post') }}</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar">
                        <div class="pull-right search">
                            <input class="form-control" type="text" placeholder="Search">
                        </div>
                        <div class="columns columns-right btn-group pull-right">
                            {{ Form::select('s',['0'=>'All']+$arr_field,null,['class'=>'search-select']) }}
                            <div class="keep-open btn-group" title="Columns">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="glyphicon glyphicon-th icon-th"></i> <span
                                            class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($arr_field as $k=>$v)
                                        <li>
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" data-field="{{ $k }}" data-value="{{ $v }}" class="checkbox-field"
                                                       value="{{ $k }}" checked="checked">
                                                {{ $v }} <span></span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="clearfix"></div>

            </div>
        </div>
        </div>
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->

            <div class="portlet box">
                <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                        <tr>
                            <th width="120" class="field-head">
                                <a class="btn btn-success show-add-form" href="{{ url('blog/admin/post-form') }}">
                                    <i class="fa fa-plus-square"></i>
                                </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="content-body"></tbody>
                    </table>
                    <div class="pull-right pagination"></div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection


@section('script')
    <script>
        var url = '{{ url('/blog/admin/post-index-ajax') }}';

        var url_edit = '{{ url('/blog/admin/post-edit') }}';

        var url_delete = '{{ url('/blog/admin/post-delete') }}';

        $(function () {
            showTable(url,url_edit,url_delete);

            $('body').delegate('.checkbox-field','click',function () {
                showTable(url,url_edit,url_delete);
            });
        });
    </script>
@endsection