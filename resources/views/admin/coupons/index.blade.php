@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('coupons.create') }}" class="btn btn-lg btn-teal">
                <i class="ion-plus"></i> New Coupon
            </a>
        </div>

        <div class="title">
            Coupons
        </div>
    </div>


    <section class="page page-white">
        <div class="container-fluid">

            @include('errors.list')

            <div class="mt-10">
                <div class="row">
                    <form class="_form" action="" method="get">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select class="form-control input-lg" name="status">
                                    <option value="">Select status</option>
                                    <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Valid</option>
                                    <option value="0" {{ Request::get('status') == '0' ? 'selected' : '' }}>Cancelled/Expired</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <input type="text"
                                        name="keywords"
                                        class="form-control input-lg"
                                        value="{{ Request::get('keywords') }}"
                                        placeholder="Enter keywords">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-lg btn-wise btn-block">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr class="bold">
                            <th>Coupon</th>
                            <th>Value</th>
                            <th>Max Uses</th>
                            <th>Uses</th>
                            <th>Status</th>
                            <th>Expiry</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($coupons as $item)
                            <tr data-href="{{ route('coupons.edit', $item->id) }}">
                                <td class="bold">{{ $item->name }}</td>
                                <td>{{ $item->value }}{{ $item->type == 'percentage' ? '%' : ' AUD'}}</td>
                                <td>{{ $item->max_use }}</td>
                                <td>{{ $item->nb_use }}</td>
                                <td>{{ $item->status ? 'Valid' : 'Invalid' }}</td>
                                <td>{{ date('d/m/Y', strtotime($item->expiry)) }}</td>
                                <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of table -->

        </div>
    </section>


    <div class="mt-20 text-center">
        {{ $coupons->links() }}
    </div>

@endsection
