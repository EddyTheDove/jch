@extends('admin.body')



@section('body')
<div class="page-title">
    <h3>Dashboard</h3>
</div>

<div class="dashboard">
    <div class="container-fluid">
        <div class="cards row">
            <div class="col-sm-3">
                <div class="card blue">
                    <h3>{{ $orders }}</h3>
                    <h5>Orders</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card red">
                    <h3>{{ $pending }}</h3>
                    <h5>Pending Orders</h5>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card green">
                    <h3>{{ $delivered }}</h3>
                    <h5>Delivered Orders</h5>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
