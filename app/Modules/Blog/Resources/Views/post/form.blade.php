<?php
$id = isset($row->id)?$row->id:0;
$category_id = isset($row->category_id)?$row->category_id:0;
$title = isset($row->title)?$row->title:'';
$description = isset($row->description)?$row->description:'';
$image = isset($row->image)?$row->image:[];
$content = isset($row->content)?$row->content:'';
$option = isset($row->option)?$row->option:'';
$meta_title = isset($row->meta_title)?$row->meta_title:'';
$meta_description = isset($row->meta_description)?$row->meta_description:'';

?>


@extends('layouts.admin-list')

@section('title',_t('Post'))

@section('css')
    @parent
    <link href="{{ $base_url }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="{{ $base_url }}assets/cropit.css" rel="stylesheet" type="text/css" />
    <style>
        .cropit-preview {
            width: 100px;
            height: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="row show-form">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">{{ _t('Post Form') }}</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ url('blog/admin/post-save') }}" class="form-horizontal save-form" method="post" role="form" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        {!! Form::hidden('id',0,['class'=>'need-clear']) !!}
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ _t('Category') }}</label>
                                <div class="col-md-9">
                                    <select name="category_id" id="category_id" class="form-control need-clear-select" style="width: 100%;">
                                        <option value="0"></option>
                                        {!! App\Modules\Blog\Models\PostCategory::getOption($category_id) !!}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-md-3 control-label">{{ _t('Title') }}</label>
                                <div class="col-md-9">
                                    <input name="title" id="title" value="{{ $title }}" type="text" class="form-control need-clear">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-3 control-label">{{ _t('Description') }}</label>
                                <div class="col-md-9">
                                    <input name="description" id="description" value="{{ $description }}" type="text" class="form-control need-clear">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="meta_title" class="col-md-3 control-label">{{ _t('Meta Title') }}</label>
                                <div class="col-md-9">
                                    <input name="meta_title" id="meta_title" value="{{ $meta_title }}" type="text" class="form-control need-clear">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="meta_description" class="col-md-3 control-label">{{ _t('Meta Description') }}</label>
                                <div class="col-md-9">
                                    <input name="meta_description" id="meta_description" value="{{ $meta_description }}" type="text" class="form-control need-clear">
                                </div>
                            </div>
                            @if(count($image)>0 && $id > 0)
                            <div class="form-group cropit-add-img" data-index="0">
                                <label for="meta_description" class="col-md-3 control-label">{{ _t('Image') }}</label>
                                <div class="col-md-9">
                                    <div class="image-data2-remove-hidden"></div>
                                    @foreach($image as $img)

                                        <div style="position:relative;width: 100px;float: left;margin: 5px;">
                                            <img src = "{{ url("photo/custom/{$img}?size=100x100") }}" style="min-width:100px;max-width:100px;">
                                            <div style="position:absolute;width:100px;top:0;left:0;text-align: right;">
                                                <a data-img="{{ $img }}" href="#" class="btn btn-xs red image-data2-remove"><i class="fa fa-remove"></i></a>
                                            </div>
                                            <input type="hidden" name="image_data2[]" value="{{ $img }}" class="image_data2" />
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="form-group cropit-add-img" data-index="0">

                                <label for="meta_description" class="col-md-3 control-label">{{ _t('Image') }}</label>
                                <div class="col-md-9">
                                    <div class="image-editor">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
                                                     <span class="fileinput-new"> Select file </span>
                                                     <span class="fileinput-exists"> Change </span>
                                                     <input type="file" class="cropit-image-input need-clear file-use">
                                                </span>
                                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists remove-photo"> {{ _t('Remove') }} </a>
                                                <a href="javascript:;" class="input-group-addon btn blue fileinput-exists add-photo"> {{ _t('Add') }} </a>
                                            </div>
                                        </div>

                                        <div class="cropit-preview"></div>
                                        <div class="image-size-label">
                                            Resize image
                                        </div>
                                        <input type="range" class="cropit-image-zoom-input">
                                        <input type="hidden" name="image_data[]" class="hidden-image-data need-clear image_data" />
                                    </div>
                                </div>
                            </div>



                            <div class="form-body">
                                <div class="form-group last">
                                    <div class="col-md-12">
                                        {!! Form::textarea('content',$content,['class'=>"form-control ckeditor need-clear",'rows' => 6,'style'=>"display: none;"]) !!}
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" class="btn green f-save">{{ _t('Submit') }}</button>
                                    <button type="button" class="btn default f-cancel">{{ _t('Cancel') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->

        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="{{ $base_url }}assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

    <script type="text/javascript" src="{{ $base_url }}assets/global/plugins/ckeditor/ckeditor.js"></script>
@endsection

@section('script')
    <script>
        var c_img = [];
        var i_img = 0;
        var imgx;
        $(function () {
            imgx = $('.cropit-add-img:last').html();

            $('[name=category_id]').select2();

            c_img[i_img] = $('.image-editor');
            c_img[i_img].cropit({
                exportZoom:4
            });

            $('body').delegate('.remove-photo','click',function () {
                if($('.remove-photo').length > 1){
                    $(this).parentsUntil('.cropit-add-img').parent().remove();
                    $('.add-photo:last').show();
                }
            });

            $('body').delegate('.add-photo','click',function () {
                i_img++;
                var new_img = $('<div class="form-group cropit-add-img" data-index="'+i_img+'">');
                new_img.html(imgx);
                $('.cropit-add-img:last').after(new_img);
                c_img[i_img] = $('.cropit-add-img:last').find('.image-editor');

                c_img[i_img].cropit({
                    exportZoom:4
                });

                $(this).hide();
            });




            $('.f-save').click(function (e) {


                $('.cropit-add-img').each(function () {
                    var d = $(this);
                    var c_index = $(this).data('index')-0;
                    if(c_img[c_index]) {
                        $editor = c_img[c_index];

                        var img_export = $editor.cropit('export');

                        d.find('.image_data').val(img_export);



                    }

                });

                $('.save-form').submit();

            });

            $('.f-cancel').click(function (e) {

            });
        });
    </script>
@endsection