@extends('layouts.master')

@section('title','Hospital statistics')
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
        <h1 class="page-title">Hospital statistics</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('marketing.index')}}"><i class="fa fa-home"></i>Statistics</a></li>
            <li class="active"><strong>Hospital statistics</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">Laboratory log</div>
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
                                    <th>Government</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th># of activated Examinations</th>
                                    <th># of all Examinations</th>
                                    <th># of patients</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->governorate->name}}</td>
                                        <td>{{$row->name }}</td>
                                        <td>{{$row->phone}}</td>
                                        <td>{{$row->address}}</td>
                                        <td>{{$row->examinations->where('activated',1)->count()}}</td>
                                        <td>{{$row->examinations->count()}}</td>
                                        <td>{{$row->tests->unique('patient_id')->count()}}</td>
                                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Government</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th># of activated Examinations</th>
                                    <th># of all Examinations</th>
                                    <th># of patients</th>
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
                        <h3 class="panel-title">Examinations Distribution</h3>
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
                // Program
                var programData = [
                    {
                        value: {{ $tests->where('activated', 1)->count() }},
                        color: "red",
                        highlight: "green",
                        label: "Activated examination"
                    },
                    {
                        value: {{ $tests->where('activated', 0)->count() }},
                        color: "blue",
                        highlight: "green",
                        label: "Inactivated examination"
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
