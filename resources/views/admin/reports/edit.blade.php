@extends('admin.body')


@section('head')
    <link rel="stylesheet" type="text/css" href="/backend/fancybox/jquery.fancybox.css" media="screen" />
@endsection

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('reports.index') }}" class="btn btn-lg btn-teal">
                <i class="flaticon-undo"></i> Cancel
            </a>
            <a href="/{{ $report->slug }}" class="btn btn-lg btn-success" target="_blank">
                <i class="flaticon-view"></i> View Report
            </a>
        </div>

        <div class="title">
            Edit Page
        </div>
    </div>

    <section class="mt-20">
        <div class="container-fluid">
            @include('errors.list')

            {!! Form::model($report, ['method' => 'PATCH', 'route' => ['reports.update', $report->id], 'class' => '_form' ]) !!}
            {{-- Left side  --}}
            <div class="row">
                <div class="col-sm-8">
                    <div class="block">
                        <div class="block-content">
                            <div class="form-group">
                                {!! Form::label('Report name') !!}
                                {!! Form::text('name', null, [
                                    'class' => 'form-control input-lg',
                                    'required' => 'required',
                                    'placeholder' => 'Report name']) !!}
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Report Slug') !!}
                                        {!! Form::text('slug', null, [
                                            'class' => 'form-control input-lg',
                                            'required' => 'required',
                                            'disabled' => 'disabled']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Report Cost') !!}
                                        {!! Form::text('amount', null, [
                                            'class' => 'form-control input-lg',
                                            'required' => 'required']) !!}
                                    </div>
                                </div>
                            </div>




                            <label>Sample report link</label>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" name="sample" value="{{ $report->sample }}"
                                            placeholder="Sample report link"
                                            id="sample"
                                            class="form-control input-lg">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <a href="/backend/filemanager/dialog.php?type=3&field_id=sample" class="iframe-btn btn-dark btn btn-lg btn-block">
                                        <i class='ion-folder'></i> Files
                                    </a>
                                </div>
                            </div>


                            <div class="mt-20">
                                {!! Form::label('Description') !!}
                                {!! Form::textarea('description', null, ['class' => 'tiny']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of col 9 --}}


                <div class="col-sm-4">
                    <div class="block">
                        <div class="block-content">
                            <label>Status</label>
                            <div class="form-group">
                                {!! Form::select('status',
                                    ['0' => 'Unpublished', '1' => 'Published'],
                                    $report->status, ['class' => 'form-control input-lg']) !!}
                            </div>
                        </div>
                    </div>


                    <div class="mt-20">
                        <button type="submit" name="submit" class="btn btn-lg btn-wise btn-block">
                            <i class="flaticon-check"></i> Update Report
                        </button>
                    </div>
                </div>
                {{-- End of col 3 --}}


            </div>

            {!! Form::close() !!}

        </div>
    </section>
@endsection


@section('js')
<script type="text/javascript" src="/backend/js/scripts.js"></script>
<script type="text/javascript" src="/backend/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="/backend/tinymce/tinymce.min.js"></script>
<script>
$(document).ready(function() {

    $('.iframe-btn').fancybox({
        'width'     : 900,
        'maxHeight' : 600,
        'minHeight'    : 400,
        'type'      : 'iframe',
        'autoSize'      : false
    });
})

tinymce.init({
    selector: ".tiny",
    theme: "modern",
    relative_urls: false,
    height : 280,
    fontsize_formats: "8px 10px 12px 14px 16px 18px 24px 32px 36px 60px",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor filemanager code"
   ],
   toolbar1: "undo redo | fontsizeselect bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
   toolbar2: "|filemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | styleselect",
   image_advtab: true ,

    external_filemanager_path:"/backend/filemanager/",
    filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : "/backend/filemanager/plugin.min.js"}
});
</script>
@endsection
