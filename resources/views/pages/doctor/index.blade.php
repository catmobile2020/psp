@extends('layouts.master')

@section('title','doctors')

@section('content')
    <div class="main-content">
        <h1 class="page-title">doctors</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>doctors</strong></li>
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
                                    <th>name</th>
                                    <th>username</th>
                                    <th>email</th>
                                    <th>specialty</th>
                                    <th>call center</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->username}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->specialty}}</td>
                                        <td>{{$row->callCenter->name}}</td>
                                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                                        <td class="size-80">
                                            <a href="{{route('doctors.edit',$row->id)}}">Edit</a>
                                            <a href="{{route('doctors.destroy',$row->id)}}">Delete</a>
{{--                                            <div class="dropdown">--}}
{{--                                                <a href="" data-toggle="dropdown" class="more-link"><i class="icon-dot-3 ellipsis-icon"></i></a>--}}
{{--                                                <ul class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <li><a href="{{route('doctors.edit',$row->id)}}">Edit</a></li>--}}
{{--                                                    <li><a href="{{route('doctors.destroy',$row->id)}}">Delete</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>username</th>
                                    <th>email</th>
                                    <th>specialty</th>
                                    <th>call center</th>
                                    <th>Created At</th>
                                    <th>Action</th>
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