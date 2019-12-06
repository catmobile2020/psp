@extends('layouts.master')

@section('title','vouchers')

@section('content')
    <div class="main-content">
        <h1 class="page-title">Programs</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Programs</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title">All programs</div>
                    </div>
                    <div class="panel-body">
                        <div class="accordion" id="accordion2">
                        @foreach($programs as $program)
                        
						<div class="panel accordion-group">
							<div class="accordion-heading">
								<h4 class="title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{ $program->id }}" aria-expanded="false">{{ $program->name }}</a></h4>
							</div>
							<div id="collapse{{ $program->id }}" class="accordion-body collapse in" aria-expanded="false" style="">
								<div class="accordion-inner">
								    <ul>
								        <li>Card serial Number/Code</li>
								        <li>Activity  Status</li>
								        <li>Adverse Events Reported</li>
								    </ul>
								</div>
							</div>
						</div>
					
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection