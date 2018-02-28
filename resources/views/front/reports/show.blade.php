@extends('front.templates.default')

@section('head')
    <title>Reports | Japanese Car History</title>

    <script>
        var _report = <?php echo json_encode($report) ?>;
        var _reports = <?php echo json_encode($reports) ?>;
    </script>
@endsection

@section('body')
    <section class="home-services">
        <div class="container">
            <new-order></new-order>
        </div>
    </section>
@endsection
