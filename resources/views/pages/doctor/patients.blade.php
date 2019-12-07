@extends('layouts.master')

@section('title','patients')

@section('content')
    <div class="main-content">
        <h1 class="page-title">patients</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>tests</strong></li>
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
                                    <th>call center</th>
                                    @if($doctor->callcenter->program->id == 1)
                                        <th>All packs</th>
                                        <th>Paid packs</th>
                                        <th>Free packs</th>
                                    @endif
                                    @if($doctor->callcenter->program->id == 2)
                                        <th>All tests</th>
                                        <th>Activated tests</th>
                                        <th>Inactivated tests</th>
                                    @endif
                                    @if($doctor->callcenter->program->id == 3)
                                        <th>All examinations</th>
                                        <th>Activated examinations</th>
                                        <th>Inactivated examinations</th>
                                    @endif
                                    @if($doctor->callcenter->program->id == 4)
                                        <th>All Vouchers</th>
                                        <th>Used Vouchers</th>
                                        <th>Unused Vouchers</th>
                                    @endif


                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->username}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->callCenter->name}}</td>
                                        @if($doctor->callcenter->program->id == 1)
                                            <td>{{ $row->patientOrders->count() }}</td>
                                            <td>{{ $row->patientOrders->where('has_free', 0)->count() }}</td>
                                            <td>{{ $row->patientOrders->where('has_free', 1)->count()}}</td>
                                        @endif
                                        @if($doctor->callcenter->program->id == 2)
                                            <td>{{ $row->patientTests->count() }}</td>
                                            <td>{{ $row->patientTests->where('activated', 1)->count()}}</td>
                                            <td>{{ $row->patientTests->where('activated', 0)->count()}}</td>
                                        @endif
                                        @if($doctor->callcenter->program->id == 3)
                                            <td>{{ $row->patientExamination->count() }}</td>
                                            <td>{{ $row->patientExamination->where('activated', 1)->count()}}</td>
                                            <td>{{ $row->patientExamination->where('activated', 0)->count()}}</td>
                                        @endif
                                        @if($doctor->callcenter->program->id == 4)
                                            <td>{{ $row->patientVouchers->count() }}</td>
                                            <td>{{ $row->patientVouchers->where('was_used', 1)->count() }}</td>
                                            <td>{{ $row->patientVouchers->where('was_used', 0)->count() }}</td>
                                        @endif
                                        <td>{{$row->created_at->format('Y-m-d')}}</td>
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
                                    <th>call center</th>
                                    @if($doctor->callcenter->program->id == 1)
                                        <th>All packs</th>
                                        <th>Paid packs</th>
                                        <th>Free packs</th>
                                    @endif
                                    @if($doctor->callcenter->program->id == 2)
                                        <th>All tests</th>
                                        <th>Activated tests</th>
                                        <th>Inactivated tests</th>
                                    @endif
                                    @if($doctor->callcenter->program->id == 3)
                                        <th>All examinations</th>
                                        <th>Activated examinations</th>
                                        <th>Inactivated examinations</th>
                                    @endif
                                    @if($doctor->callcenter->program->id == 4)
                                        <th>All Vouchers</th>
                                        <th>Used Vouchers</th>
                                        <th>Unused Vouchers</th>
                                    @endif
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
@endsection

@section('js')
    <script>
        $(document).on('change','.changeStatus',function () {
            let  active = $(this).val();
            let  id = $(this).data('id');
            $.ajax({
                data:{id:id,active:active},
                success:function (result) {
                    $('#statusResult').removeClass('sr-only');
                    $('#statusResult').html(result);
                },
                error:function (errors) {
                    console.log(errors);
                }
            });
        });
    </script>
@endsection
