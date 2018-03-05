@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('orders.index') }}" class="btn btn-lg btn-teal">
                <i class="flaticon-undo"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit Order
        </div>
    </div>

    <section class="mt-20">
        <div class="container-fluid">
            @include('errors.list')

            {!! Form::model($order, ['method' => 'PATCH', 'route' => ['orders.update', $order->id], 'class' => '_form' ]) !!}
            {{-- Left side  --}}
            <div class="row">
                <div class="col-sm-8">
                    <div class="block">
                        <div class="block-content">
                            <h4>Client details</h4>

                            <div class="row mt-20">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('First name') !!}
                                        {!! Form::text('firstname', null, [
                                            'class' => 'form-control input-lg',
                                            'placeholder' => 'First name']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Last name') !!}
                                        {!! Form::text('lastname', null, [
                                            'class' => 'form-control input-lg',
                                            'placeholder' => 'Last name']) !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Email') !!}
                                        {!! Form::email('email', null, [
                                            'class' => 'form-control input-lg',
                                            'placeholder' => 'Email']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Mobile') !!}
                                        {!! Form::text('mobile', null, [
                                            'class' => 'form-control input-lg',
                                            'placeholder' => 'Mobile']) !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('Address') !!}
                                        {!! Form::text('address', null, [
                                            'class' => 'form-control input-lg',
                                            'placeholder' => 'Address']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('Suburb') !!}
                                        {!! Form::text('suburb', null, [
                                            'class' => 'form-control input-lg',
                                            'placeholder' => 'Suburb']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('State') !!}
                                        {!! Form::text('state', null, [
                                            'class' => 'form-control input-lg',
                                            'placeholder' => 'State']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('Postcode') !!}
                                        {!! Form::text('postcode', null, [
                                            'class' => 'form-control input-lg',
                                            'placeholder' => 'Postcode']) !!}
                                    </div>
                                </div>
                            </div>
                            {{-- End of client details --}}

<hr>

                            <h4>Car deails</h4>

                            <div class="row mt-20">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('Year') !!}
                                        <input type="text" name="year" value="{{ $car->year }}" class="form-control input-lg">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('Make') !!}
                                        <input type="text" name="make" value="{{ $car->make }}" class="form-control input-lg">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('Model') !!}
                                        <input type="text" name="model" value="{{ $car->model }}" class="form-control input-lg">
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-20">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Original VIN') !!}
                                        <input type="text" name="original_vin" value="{{ $car->original_vin }}" class="form-control input-lg">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Australian VIN') !!}
                                        <input type="text" name="australian_vin" value="{{ $car->australian_vin }}" class="form-control input-lg">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-20">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Original Colour') !!}
                                        <input type="text" name="original_colour" value="{{ $car->original_colour}}" class="form-control input-lg">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Year of export') !!}
                                        <input type="text" name="export_year" value="{{ $car->export_year }}" class="form-control input-lg">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- End of col 9 --}}


                <div class="col-sm-4">
                    <div class="block">
                        <div class="block-content">
                            <label>Report type</label>
                            <div class="form-group">
                                <select class="form-control input-lg" name="report_id">
                                    @foreach($reports as $report)
                                        <option value="{{ $report->id }}" {{ $report->id === $order->report_id ? 'selected' : '' }}>{{ $report->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label>PPSR</label>
                            <div class="form-group">
                                {!! Form::select('ppsr',
                                    [0 => 'No', 1 => 'Yes'],
                                    $order->ppsr, ['class' => 'form-control input-lg']) !!}
                            </div>

                            <label>Status</label>
                            <div class="form-group">
                                {!! Form::select('status',
                                    ['placed' => 'Placed', 'delivered' => 'Delivered'],
                                    $order->status, ['class' => 'form-control input-lg']) !!}
                            </div>


                            <h5 class="mt-20 bold">Paid: ${{ $order->amount }} AUD</h5>
                            <small>{{ $order->stripe_charge_id }}</small>
                        </div>
                    </div>


                    <div class="mt-20">
                        <button type="submit" name="submit" class="btn btn-lg btn-wise btn-block">
                            <i class="flaticon-check"></i> Update Order
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
<script type="text/javascript" src="/backend/tinymce/tinymce.min.js"></script>
<script>

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
