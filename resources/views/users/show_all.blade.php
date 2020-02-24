@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Show table</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                    <table class="table" id="data">
                        <thead>
                        <tr>
                            <th> №(id)</th>
                            <th> fio</th>
                            <th> email</th>
                            <th> department</th>
                            <th> salary</th>
                            <th> hiring time</th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--include css--}}
@section('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
@endsection

{{--include js--}}
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/show_all.js"></script>
@endsection
