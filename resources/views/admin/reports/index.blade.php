@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('reports.create') }}" class="btn btn-lg btn-teal">
                <i class="ion-plus"></i> New Report
            </a>
        </div>

        <div class="title">
            Reports
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">

            @include('errors.list')

            <div class="mt-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Amount</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($reports as $item)
                            <tr data-href="{{ route('reports.edit', $item->id) }}">
                                <td class="bold">{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>${{ $item->amount }}</td>
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

@endsection
