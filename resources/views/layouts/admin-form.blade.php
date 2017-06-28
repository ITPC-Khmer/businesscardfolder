@extends('layouts.admin')

@section('css')
    @parent
    {{--fileupload--}}
    <link href="{{ $base_url }}assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
    <link href="{{ $base_url }}assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ $base_url }}assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css"/>
    <link href="{{ $base_url }}assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css"/>

    <link href="{{ $base_url }}assets/global/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ $base_url }}assets/pages/css/image-crop.min.css" rel="stylesheet" type="text/css" />
    {{--end fileupload--}}

    <link href="{{ $base_url }}assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ $base_url }}assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

@endsection

@section('js')
    @parent
    {{--fileupload--}}
    <script src="{{ $base_url }}assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>

    <script src="{{ $base_url }}assets/global/plugins/jcrop/js/jquery.color.js" type="text/javascript"></script>
    <script src="{{ $base_url }}assets/global/plugins/jcrop/js/jquery.Jcrop.min.js" type="text/javascript"></script>
    {{-- end fileupload--}}

    <script src="{{ $base_url }}assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
@endsection