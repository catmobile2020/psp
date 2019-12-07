@extends('layouts.master')

@section('title','adverse')

@section('content')
    <div class="main-content">
        <h1 class="page-title">adverse</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>adverse</strong></li>
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
                                    <th>Report type</th>
                                    <th>Patient initials</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Reaction onset date</th>
                                    <th>Suspected Novartis Drug</th>
                                    <th>Dose</th>
                                    <th>Indication</th>
                                    <th>Reaction description</th>
                                    <th>Is it serious</th>
                                    <th>Is it drug-related</th>
                                    <th>Concomitant medications</th>
                                    <th>Other relevant medical history</th>
                                    <th>Batch number</th>
                                    <th>Treating physician</th>
                                    <th>Reporter name</th>
                                    <th>Date</th>
                                    <th>NAME</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->report_type}}</td>
                                        <td>{{$row->patient_initials}}</td>
                                        <td>{{$row->age}}</td>
                                        <td>{{$row->gender}}</td>
                                        <td>{{$row->reaction_onset_date}}</td>
                                        <td>{{$row->suspected_novartis_drug}}</td>
                                        <td>{{$row->dose}}</td>
                                        <td>{{$row->indication}}</td>
                                        <td>{{$row->reaction_description}}</td>
                                        <td>{{$row->is_serious ? 'Yes' : 'No'}}</td>
                                        <td>{{$row->is_drug_related ? 'Yes' : 'No'}}</td>
                                        <td>{{$row->concomitant_medications}}</td>
                                        <td>{{$row->medical_history}}</td>
                                        <td>{{$row->batch_number}}</td>
                                        <td>{{$row->treating_physician}}</td>
                                        <td>{{$row->reporter_name}}</td>
                                        <td>{{$row->Date}}</td>
                                        <td>{{$row->callCenter->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Report type</th>
                                    <th>Patient initials</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Reaction onset date</th>
                                    <th>Suspected Novartis Drug</th>
                                    <th>Dose</th>
                                    <th>Indication</th>
                                    <th>Reaction description</th>
                                    <th>Is it serious</th>
                                    <th>Is it drug-related</th>
                                    <th>Concomitant medications</th>
                                    <th>Other relevant medical history</th>
                                    <th>Batch number</th>
                                    <th>Treating physician</th>
                                    <th>Reporter name</th>
                                    <th>Date</th>
                                    <th>NAME</th>
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