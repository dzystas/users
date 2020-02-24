@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"> Show table</div>
                        <div class="col-md-6 text-right"><a href="{{route('departments.create')}}" class="btn btn-success">Create</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" id="data">
                                <thead>
                                <tr>
                                    <th> №(id)</th>
                                    <th> name</th>
                                    <th> action</th>
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
    <script src="/js/departments/index.js"></script>
@endsection
