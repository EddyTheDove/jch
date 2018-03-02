@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="title">
            Orders
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
                                    <option value="placed" {{ Request::get('status') == 'placed' ? 'selected' : '' }}>Placed</option>
                                    <option value="delivered" {{ Request::get('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
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
            <!-- End of table -->

        </div>
    </section>


    <div class="mt-20 text-center">
        {{ $orders->links() }}
    </div>

@endsection
