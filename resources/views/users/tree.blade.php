@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tree</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <div>
                                    <div id="tree"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="{{route('users.tree.create_update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="hidden" id="input">
                                    <div>
                                        <h4 class="text-center"><p><span id="id">Create</span></p>
                                            <span id="title"></span></h4>
                                    </div>
                                    <div>
                                        <div class="col-md-12">
                                            <input type="hidden" name="id">
                                            <div class="form-group">
                                                <lable>Full name*:</lable>
                                                <div class="input-group">
                                                    <input type="text" name="full_name" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <lable>Email*:</lable>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <lable>Salary*:</lable>
                                                <input type="number" name="salary" class="form-control" step="any" required>
                                            </div>
                                            <div class="form-group">
                                                <lable>Department*:</lable>
                                                <select name="department_id" class="form-control">
                                                    @foreach($departments as $department)
                                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <lable>Hiring time*:</lable>
                                                <input type="text" name="hiring_time" class="form-control" required>
                                                <span class="exemple">exemple: 2001-11-23 11:11:11</span>
                                            </div>
                                            <div class="col-md-12" id="avatar-img">
                                            </div>
                                            <div class="form-group">
                                                <lable>Ava:</lable>
                                                <input type="file" name="image" id="avatar"  class="form-control" multiple>
                                            </div>

                                            <div class="form-group">
                                                <lable>Password*:</lable>
                                                <input type="password" name="password" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <lable>Password confirmation*:</lable>
                                                <input type="password" class="form-control" name="password_confirmation" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success">Send</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.9/jstree.min.js"></script>
    <script src="/js/users/tree.js"></script>
@endsection
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.9/themes/default/style.min.css" rel="stylesheet" type="text/css"/>
@endsection
