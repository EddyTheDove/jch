@extends('front.templates.default')

@section('head')
    <title>{{ $report->name }} | Japanese Car History</title>

    <script>
        var _report = <?php echo json_encode($report) ?>;
        var _reports = <?php echo json_encode($reports) ?>;
        var _countries = <?php echo json_encode($countries) ?>;
    </script>
@endsection

@section('body')
    <section class="home-services">
        <div class="container">
            <new-order></new-order>
        </div>
    </section>
@endsection
