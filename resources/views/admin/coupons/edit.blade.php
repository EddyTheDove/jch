@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('coupons.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Go Back
            </a>
        </div>

        <div class="title">
            Edit Coupon
        </div>
    </div>

    <section class="mt-20">
        <div class="container-fluid">
            @include('errors.list')

            {!! Form::model($coupon, ['method' => 'PATCH', 'route' => ['coupons.update', $coupon->id], 'class' => '_form' ]) !!}
            {{-- Left side  --}}
            <div class="row">
                <div class="col-sm-8">
                    <div class="block">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Coupon</label>
                                        <input type="text" name="name" value="{{ $coupon->name }}"
                                        required
                                        placeholder="Coupon name"
                                        class="form-control input-lg">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Value</label>
                                        <input type="text" name="value" value="{{ $coupon->value }}"
                                        required
                                        placeholder="Coupon value"
                                        class="form-control input-lg">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Type of value</label>
                                        <select class="form-control input-lg" name="type">
                                            <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : '' }}>Percentage Off</option>
                                            <option value="dollar" {{ $coupon->type == 'dollar' ? 'selected' : '' }}>AUD Off</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Maximum number of use</label>
                                        <input type="text" name="max_use" value="{{ $coupon->max_use }}"
                                        required
                                        placeholder="Max use"
                                        class="form-control input-lg">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input type="text" name="expiry" value="{{ $coupon->expiry }}"
                                        required
                                        placeholder="Expiry date"
                                        class="form-control input-lg datepicker">
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

                            <label>Status</label>
                            <div class="form-group">
                                {!! Form::select('status',
                                    ['1' => 'Valid', '0' => 'Invalid'],
                                    $coupon->status, ['class' => 'form-control input-lg']) !!}
                            </div>
                        </div>
                    </div>


                    <div class="mt-20">
                        <button type="submit" name="submit" class="btn btn-lg btn-wise btn-block">
                            <i class="flaticon-check"></i> Update Coupon
                        </button>
                    </div>
                </div>
                {{-- End of col 3 --}}
            </div>

            {!! Form::close() !!}


            <div class="mt-10">
                <h5>Orders: {{ $orders->count() }}</h5>

                @if ($orders->count())
                    <div class="mt-10">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bold">
                                    <th>#</th>
                                    <th>Report Type</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($orders as $item)
                                    <tr data-href="{{ route('orders.edit', $item->number) }}">
                                        <td class="bold">{{ $item->number }}</td>
                                        <td>{{ $item->report->name }}</td>
                                        <td>{{ $item->fullname() }}</td>
                                        <td class="capitalize">{{ $item->status }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($item->updated_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </section>
@endsection


@section('js')
<script type="text/javascript" src="/backend/js/scripts.js"></script>
<script>
$(document).ready(function() {
    $('.datepicker').datepicker({
        autoclose: true,
        startDate: 'd',
        format: 'dd-mm-yyyy'
    })
})
</script>
@endsection
