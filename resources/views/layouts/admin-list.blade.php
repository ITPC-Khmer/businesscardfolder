@extends('layouts.admin')

@section('css')
    @parent
    <style>
        .form-group.form-md-line-input{
            margin: 0 !important;
            padding-top: 0px !important;
        }
    </style>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ $base_url }}assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ $base_url }}assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="{{ $base_url }}assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <link href="{{ $base_url }}assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ $base_url }}assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

    <style>
        .search-select{
            /*width: 100%;*/
            height: 34px;
            padding: 6px 12px;
            background-color: #fff;
            border: 1px solid #c2cad8;
        }

        .inline{
            float: left !important;margin-right: 3px;
        }
    </style>
@endsection

@section('js')
    @parent
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ $base_url }}assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ $base_url }}assets/pages/scripts/ui-sweetalert.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ $base_url }}assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{ $base_url }}assets/jquery.simplePagination.js" type="text/javascript"></script>


    <script src="{{ $base_url }}assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/jquery.cropit.js" type="text/javascript"></script>
@endsection

<script>
    function showTable(url_p,url_edit,url_delete) {
        var ch = [];
        var chv = [];
        var i = 0;
        $('.checkbox-field:checked').each(function () {
            ch[i] = $(this).data('field');
            chv[i] = $(this).data('value');
            i++;
        });

        $('.field-head-r').remove();
        $('.content-body').html('');
        if(ch.length>0)
        {
            var f = '';
            $.each(chv,function (i,item) {
                f += '<th  class="field-head-r">'+item+'</th>';
            });
            $('.field-head').after(f);

            $.ajax({
                url: url_p,
                //data: {},
                error: function () {
                    swal({
                        title: "{{ _t('error') }}",
                        text: "{{ _t('An error has occurred!') }}",
                        type: "warning",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Close",
                        closeOnConfirm: false
                    });
                },
                dataType: 'json',
                success: function (d) {
                    dd(d);
                    if(d.data.length>0)
                    {
                        var tr = '';
                        $.each(d.data,function (i,item) {
                            tr += ('<tr>'+
                                '<td>'+
                                '{!! Form::open(['method' => 'put','url'=>'####','class'=>'inline']) !!}'+
                                '<input type="hidden" name="id" value="'+item.id+'">'+
                                '<button type="submit" class="btn btn-primary">'+
                                '<i class="fa fa-edit"></i>'+
                                '</button>'+
                                '{!! Form::close() !!}'+
                                '{!! Form::open(['method' => 'delete','url'=>'##']) !!}'+
                                '<input type="hidden" name="id" value="'+item.id+'">'+
                                '<button type="submit" class="btn btn-danger">'+
                                '<i class="fa fa-remove"></i>'+
                                '</button>'+
                                '{!! Form::close() !!}'+
                                '</td>').replace(/####/g, url_edit).replace(/##/g, url_delete);

                            $.each(ch,function (j,c) {
                                if(item[c] == null){
                                    tr += '<td></td>';
                                }else if( (typeof  item[c]) == 'string' || (typeof  item[c]) == 'number') {
                                    tr += '<td>' + item[c] + '</td>';
                                }else {

                                    $.each(item[c],function (i,images) {
                                        if(images && images != '') {
                                            tr += '<td width="50"><img src="{{ url('/imagecache/50x50') }}/' + images + '" height="50"></td>';

                                            return false;
                                        }
                                    });

                                }
                            });

                            tr +=    '</tr>';
                        });
                        $('.content-body').html(tr);

                        $('.pagination').pagination({
                            items: d.total,
                            itemsOnPage: d.per_page,
                            listStyle: 'pagination',
                            currentPage: d.current_page,
                            onPageClick: function(pageNumber, event) {
                                url = d.path+'?page='+pageNumber;
                                showTable(url)
                            }
                        });

                    }
                },
                type: 'GET'
            });

        }

    }


</script>

@section('script')

    @parent
    <script type="text/javascript">
        var current_url = '{{ url()->current() }}';

        $(function () {
            $('.status-ch').on('change',function () {
                var id = $(this).data('id');
                var status = $(this).val() - 0;
                var url  = $(this).data('url');
                $.ajax({
                    url: url,
                    data: {id: id,status:status},
                    error: function () {
                        swal({
                            title: "{{ _t('error') }}",
                            text: "{{ _t('An error has occurred!') }}",
                            type: "warning",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Close",
                            closeOnConfirm: false
                        });
                    },
                    dataType: 'html',
                    success: function (data) { },
                    type: 'POST'
                });

            });

            $('body').delegate('.vm-del', 'click', function (e) {
                e.preventDefault();
                var tr = $(this).parent().parent().parent();
                var id = $(this).data('id') - 0;
                var href = $(this).data('href');
                swal({
                        title: "{{ _t('Are you sure?') }}",
                        text: "{{ _t('You will not be able to recover this data!') }}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function () {
                        $.ajax({
                            url: href,
//                            async: false,
                            data: {id: id,_method:'delete'},
                            error: function () {
                                swal({
                                    title: "{{ _t('error') }}",
                                    text: "{{ _t('An error has occurred!') }}",
                                    type: "warning",
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Close",
                                    closeOnConfirm: false
                                });
                            },
                            dataType: 'json',
                            success: function (data) {
//                                console.log(data);// affected
                                if (data.affected - 0 > 0) {
                                    tr.remove();
                                    swal("Deleted!", "{{ _t('Your imaginary file has been deleted') }}", "success");
                                } else {
                                    swal({
                                        title: "{{ _t('error') }}",
                                        text: "{{ _t('An error has occurred!') }}",
                                        type: "warning",
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Close",
                                        closeOnConfirm: false
                                    });
                                }
                            },
                            type: 'POST'
                        });


                    });
            });

            $('.head-search-th').on('click',function () {
                go_search();
            });

            $('.head-search-input').on( "keydown", function(event) {
                var keycode = event.keyCode || event.which;
                if(keycode == '13') {
                    go_search();
                }
            });
        });

        //
        function go_search() {
            var url_param = current_url + '?' ;
            $('.head-search-th').each(function () {
                var input = $(this).parent().parent().find('input');
                if(input.length > 0){
                    var n = input.data('name');
                    var v = input.val();
                }else {
                    input = $(this).parent().parent().find('.select');

                    var n = input.data('name');
                    var v = input.val();
                }

                if($.trim(v) != '')  url_param += '&'+n+'='+encodeURIComponent($.trim(v));

            });

            location.href = url_param;
        }
    </script>
@endsection

