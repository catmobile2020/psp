@extends('layouts.master')

@section('title','tests')

@section('content')
    <div class="main-content">
        <h1 class="page-title">tests</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>tests</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title">
                            <a class="btn btn-success btn-rounded" href="{{route('patient.tests.create',$patient->id)}}">Add Test</a>
                        </h3>
                        <ul class="panel-tool-options">
                            <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                            <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                            <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        @if (session()->has('message'))
                            <div class="alert alert-info">
                               <h4>{{session()->get('message')}}</h4>
                            </div>
                        @endif
                            <div class="alert alert-success text-center sr-only" id="statusResult">

                            </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ACTIVATED</th>
                                    <th>name</th>
                                    <th>Test Date</th>
                                    <th>CLIENT CODE</th>
                                    <th>CLIENT NAME</th>
                                    <th>Lab NAME</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td><span class="label label-{{$row->activated ? 'success':'danger'}}">{{$row->activated ? 'Yes' : 'No'}}</span></td>
                                        <td>{{$row->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($row->date)->format('Y-m-d h:i A')}}</td>
                                        <td>{{$row->patient->serial_number}}</td>
                                        <td>{{$row->patient->name}}</td>
                                        <td>{{$row->user->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>ACTIVATED</th>
                                    <th>name</th>
                                    <th>Test Date</th>
                                    <th>CLIENT CODE</th>
                                    <th>CLIENT NAME</th>
                                    <th>Lab NAME</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection