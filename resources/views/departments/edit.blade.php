@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit department</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <form action="{{route('departments.update')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$department->id??old('id')}}">
                                    @include('departments.form')
                                    <button type="submit" class="btn btn-success">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
