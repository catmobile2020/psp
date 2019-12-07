@extends('layouts.master')

@section('title','Patient statistics')
@section('css')
    <style>
        li h5 {
            text-align:left;
        }
        .chartx {
            max-width: 650px;
            margin: 35px auto;
        }
        ul.doughnut-legend {
            padding: 0;
            margin: 0;
            list-style: none;
            position: absolute;
            top: 30px;
            right: 28px;
            font-size: 13px;
        }
    </style>
@endsection
@section('content')
    <div class="main-content">
        <h1 class="page-title">Patient statistics</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('marketing.index')}}"><i class="fa fa-home"></i>Statistics</a></li>
            <li class="active"><strong>Patient statistics</strong></li>
        </ol>
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
                                    <th>Government</th>
                                    <th>Doctor</th>
                                    <th>Diagnosis</th>
                                    <th>Program name</th>
                                    <th>Benefit</th>
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
                                        @if($row->callCenter->program->id == 1)
                                            <td>{{ $row->patientOrders->count() }}</td>
                                            @elseif($row->callCenter->program->id == 2)
                                            <td>{{ $row->patientTests->count() }}</td>
                                            @elseif($row->callCenter->program->id == 3)
                                            <td>{{ $row->patientExamination->count() }}</td>
                                            @else
                                            <td>{{ $row->patientVouchers->count() }}</td>
                                            @endif
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
                                    <th>Government</th>
                                    <th>Doctor</th>
                                    <th>Diagnosis</th>
                                    <th>Program name</th>
                                    <th>Benefit</th>
                                    <th>Created At</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading no-border clearfix">
                        <h3 class="panel-title">Gender Distribution</h3>
                    </div>
                    <div class="panel-body">
                        <div class="canvas-chart has-doughnut-legend">
                            <canvas id="doughnutChart" width="308" height="226"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading no-border clearfix">
                        <h3 class="panel-title">Program Distribution</h3>
                    </div>
                    <div class="panel-body">
                        <div class="canvas-chart has-doughnut-legend">
                            <canvas id="program" width="308" height="226"></canvas>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection

@section('js')

    <!--ChartJs-->
    <script src="{{ URL::asset('assets/js/plugins/chartjs/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function () {
            // pie graph
            var doughnutData = [
                {
                    value: {{ $rows->where('sex', 1)->count() }},
                    color: "#6B767D",
                    highlight: "#D1148D",
                    label: "Male"
                },
                {
                    value: {{ $rows->where('sex', 0)->count() }},
                    color: "#C8198D",
                    highlight: "#AE228E",
                    label: "Female"
                }
            ];
            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 4,
                percentageInnerCutout: 60, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,
            };

            var canvas = document.getElementById("doughnutChart");
            var helpers = Chart.helpers;
            //var ctx = document.getElementById("doughnutChart").getContext("2d");
            var moduleDoughnut = new Chart(canvas.getContext("2d")).Doughnut(doughnutData, doughnutOptions);
            var legendHolder = document.createElement('div');
            legendHolder.innerHTML = moduleDoughnut.generateLegend();
            helpers.each(legendHolder.firstChild.childNodes, function (legendNode, index) {
                helpers.addEvent(legendNode, 'mouseover', function () {
                    var activeSegment = moduleDoughnut.segments[index];
                    activeSegment.save();
                    activeSegment.fillColor = activeSegment.highlightColor;
                    moduleDoughnut.showTooltip([activeSegment]);
                    activeSegment.restore();
                });
            });
            helpers.addEvent(legendHolder.firstChild, 'mouseout', function () {
                moduleDoughnut.draw();
            });
            canvas.parentNode.parentNode.appendChild(legendHolder.firstChild);



            // Program
            var programData = [
                {
                    value: {{ $programCount[0] }},
                    color: "#6B767D",
                    highlight: "#D1148D",
                    label: '{{ $programName[0] }}'
                },
                {
                    value: {{ $programCount[1] }},
                    color: "#C8198D",
                    highlight: "#AE228E",
                    label: '{{ $programName[1] }}'
                },
                {
                    value: {{ $programCount[2] }},
                    color: "#EC1760",
                    highlight: "#F0532E",
                    label: '{{ $programName[2] }}'
                },
                {
                    value: {{ $programCount[3] }},
                    color: "#FCB419",
                    highlight: "#F3712A",
                    label: '{{ $programName[3] }}'
                }
            ];
            var programOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 4,
                percentageInnerCutout: 60, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,
            };

            var canvasProgram = document.getElementById("program");
            var helpersProgram = Chart.helpers;
            //var ctx = document.getElementById("doughnutChart").getContext("2d");
            var moduleProgram = new Chart(canvasProgram.getContext("2d")).Doughnut(programData, programOptions);
            var legendHolderProgram = document.createElement('div');
            legendHolderProgram.innerHTML = moduleProgram.generateLegend();
            helpersProgram.each(legendHolderProgram.firstChild.childNodes, function (legendNode, index) {
                helpersProgram.addEvent(legendNode, 'mouseover', function () {
                    var activeSegment = moduleProgram.segments[index];
                    activeSegment.save();
                    activeSegment.fillColor = activeSegment.highlightColor;
                    moduleProgram.showTooltip([activeSegment]);
                    activeSegment.restore();
                });
            });
            helpersProgram.addEvent(legendHolderProgram.firstChild, 'mouseout', function () {
                moduleProgram.draw();
            });
            canvasProgram.parentNode.parentNode.appendChild(legendHolderProgram.firstChild);


        });
</script>
@endsection
