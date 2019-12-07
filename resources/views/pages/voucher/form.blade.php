@extends('layouts.master')

@section('title','vouchers')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>vouchers</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <ul class="panel-tool-options">
                            <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                            <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                            <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('patient.vouchers.store',$patient->id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Verification code</label>
                                    <input type="text" class="form-control" id="name" placeholder="Verification code" name="code">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="date">Eye Center name</label>
                                    <select name="user_id" class="form-control">
                                        <option selected value>Select Eye Center</option>
                                        @foreach($eyes as $eye)
                                            <option value="{{$eye->id}}">{{$eye->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="date">notes</label>
                                    <textarea rows="6" class="form-control" placeholder="notes" name="notes"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('patient.vouchers',$patient->id)}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
