@extends('layouts.master')

@section('title','Statistics')

@section('content')
    <div class="main-content">
        <h1 class="page-title">Statistics</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Statistics</strong></li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel minimal panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">Patients</div>
                    </div>
                    <!-- panel body -->
                    @if($users->has(1))
                    <div class="panel-body">
                        <div class="stack-order">
                            <h1 class="no-margins">{{ $users[1][0] }}</h1>
                            <small>Latest add at: {{ $users[1][1] }}</small>
                        </div>
                        <div class="bar-chart-icon"></div>
                        <strong><a href="{{ route('marketing.patient-statistics') }}" class="link uppercase">Show all</a></strong>
                    </div>
                        @else
                        <div class="panel-body">
                            <strong>No data Added</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel minimal panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">Doctors</div>
                    </div>
                    <!-- panel body -->
                    @if($users->has(4))
                        <div class="panel-body">
                            <div class="stack-order">
                                <h1 class="no-margins">{{ $users[4][0] }}</h1>
                                <small>Latest add at: {{ $users[4][1] }}</small>
                            </div>
                            <div class="bar-chart-icon"></div>
                            <strong><a href="{{ route('marketing.doctor-statistics') }}" class="link uppercase">Show all</a></strong>
                        </div>
                    @else
                        <div class="panel-body">
                            <strong>No data Added</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel minimal panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">Pharmacies</div>
                    </div>
                    <!-- panel body -->
                    @if($users->has(2))
                        <div class="panel-body">
                            <div class="stack-order">
                                <h1 class="no-margins">{{ $users[2][0] }}</h1>
                                <small>Latest add at: {{ $users[2][1] }}</small>
                            </div>
                            <div class="bar-chart-icon"></div>
                            <strong><a href="{{ route('marketing.pharmacy-statistics') }}" class="link uppercase">Show all</a></strong>
                        </div>
                    @else
                        <div class="panel-body">
                            <strong>No data Added</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel minimal panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">Laboratories</div>

                    </div>
                    <!-- panel body -->
                    @if($users->has(3))
                        <div class="panel-body">
                            <div class="stack-order">
                                <h1 class="no-margins">{{ $users[3][0] }}</h1>
                                <small>Latest add at: {{ $users[3][1] }}</small>
                            </div>
                            <div class="bar-chart-icon"></div>
                            <strong><a href="{{ route('marketing.lab-statistics') }}" class="link uppercase">Show all</a></strong>
                        </div>
                    @else
                        <div class="panel-body">
                            <strong>No data Added</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="panel minimal panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">Hospitals / Centers</div>
                    </div>
                    <!-- panel body -->
                    @if($users->has(5))
                        <div class="panel-body">
                            <div class="stack-order">
                                <h1 class="no-margins">{{ $users[5][0] }}</h1>
                                <small>Latest add at: {{ $users[5][1] }}</small>
                            </div>
                            <div class="bar-chart-icon"></div>
                            <strong><a href="{{ route('marketing.hospital-statistics') }}" class="link uppercase">Show all</a></strong>
                        </div>
                    @else
                        <div class="panel-body">
                            <strong>No data Added</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel minimal panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">Healthcare centers</div>
                    </div>
                    <!-- panel body -->
                    @if($users->has(6))
                        <div class="panel-body">
                            <div class="stack-order">
                                <h1 class="no-margins">{{ $users[6][0] }}</h1>
                                <small>Latest add at: {{ $users[6][1] }}</small>
                            </div>
                            <div class="bar-chart-icon"></div>
                            <strong><a href="{{ route('marketing.health-statistics') }}" class="link uppercase">Show all</a></strong>
                        </div>
                    @else
                        <div class="panel-body">
                            <strong>No data Added</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel minimal panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">FOC packs</div>
                    </div>
                    <!-- panel body -->
                    @if($orders->count() > 0)
                        <div class="panel-body">
                            <div class="stack-order">
                                <h1 class="no-margins">{{ $orders->count() }}</h1>
                                <small>Latest add at: {{ $orders->first()->created_at }}</small>
                            </div>
                            <div class="bar-chart-icon"></div>
                        </div>
                    @else
                        <div class="panel-body">
                            <strong>No data Added</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">Patients log</div>
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
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Governorate</th>
                                    <th>Doctor</th>
                                    <th>Diagnosis</th>
                                    <th>Program name</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->age}}</td>
                                        <td>@if($row->sex == 1) Male @else Female @endif</td>
                                        <td>{{$row->governorate->name}}</td>
                                        <td>{{$row->doctorRow->name}}</td>
                                        <td>{{$row->diagnosis}}</td>
                                        <td>{{$row->callCenter->program->name}}</td>
                                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Governorate</th>
                                    <th>Doctor</th>
                                    <th>Diagnosis</th>
                                    <th>Program name</th>
                                    <th>Created At</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
