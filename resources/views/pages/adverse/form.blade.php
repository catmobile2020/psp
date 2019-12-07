@extends('layouts.master')

@section('title','adverse reporting')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>adverse reporting</strong></li>
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
                        @if (session()->has('message'))
                            <div class="alert alert-info">
                                <h4>{{session()->get('message')}}</h4>
                            </div>
                        @endif
                        <form action="{{route('adverse-reporting.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Report type</label>
                                    <select name="report_type" class="form-control" >
                                        <option value="primary">Primary</option>
                                        <option value="follow-up">Follow-up</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="patient_initials">Patient Initials</label>
                                    <input type="text" name="patient_initials" class="form-control" id="patient_initials" placeholder="Patient Initial">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" name="age" class="form-control" id="age" placeholder="Age">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control select" >
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="reaction_onset_date">Reaction Onset Date</label>
                                    <input type="text" name="reaction_onset_date" class="form-control" id="reaction_onset_date" placeholder="Reaction Onset Date">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="suspected_novartis_drug">Suspected Novartis Drug</label>
                                    <input type="text" name="suspected_novartis_drug" class="form-control" id="suspected_novartis_drug" placeholder="Suspected Novartis Drug">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="dose">Dose</label>
                                    <input type="text" name="dose" class="form-control" id="dose" placeholder="Dose">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="indication">Indication</label>
                                    <input type="text" name="indication" class="form-control" id="indication" placeholder="Indication">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="reaction_description">Reaction Description</label>
                                    <input type="text" name="reaction_description" class="form-control" id="reaction_description" placeholder="Reaction Description">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Is it serious</label>
                                    <select name="is_serious" class="form-control select" >
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Is it drug-related</label>
                                    <select name="is_drug_related" class="form-control select" >
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="indication">Concomitant Medications</label>
                                    <input type="text" name="concomitant_medications" class="form-control" id="concomitant_medications" placeholder="Concomitant Medications">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="medical_history">Other relevant medical history</label>
                                    <input type="text" name="medical_history" class="form-control" id="medical_history" placeholder="Other relevant medical history">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="batch_number">Batch number</label>
                                    <input type="text" name="batch_number" class="form-control" id="batch_number" placeholder="Batch number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="treating_physician">Treating Physician</label>
                                    <input type="text" name="treating_physician" class="form-control" id="treating_physician" placeholder="Treating Physician">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="reporter_name">Reporter name</label>
                                    <input type="text" name="reporter_name" class="form-control" id="reporter_name" placeholder="Reporter name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Date">Date</label>
                                    <input type="date" name="Date" class="form-control" id="Date" placeholder=Date">
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
