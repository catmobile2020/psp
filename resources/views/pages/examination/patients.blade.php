@extends('layouts.master')

@section('title','examinations')

@section('content')
    <div class="main-content">
        <h1 class="page-title">examinations</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>examinations</strong></li>
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
                                    <th>ACTIVATED</th>
                                    <th>Status</th>
                                    <th>name</th>
                                    <th>Test Date</th>
                                    <th>CLIENT CODE</th>
                                    <th>CLIENT NAME</th>
                                    <th>CLIENT Result</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td><span class="label label-{{$row->activated ? 'success':'danger'}}">{{$row->activated ? 'Yes' : 'No'}}</span></td>
                                        <td>
                                            <select class="form-control changeStatus" name="active" data-id="{{$row->id}}">
                                                <option value="1" {{$row->activated ? 'selected' : ''}}>Yes</option>
                                                <option value="0" {{$row->activated ? '' : 'selected'}}>No</option>
                                            </select>
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($row->date)->format('Y-m-d h:i A')}}</td>
                                        <td>{{$row->patient->serial_number}}</td>
                                        <td>{{$row->patient->name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_{{$row->id}}">
                                                Upload Results
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal_{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Upload Patient Results</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{route('examinations.patient.upload-test.result',$row->id)}}" method="post" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Upload Images:(You can Upload Many Images In One Time?)</label>
                                                                <input type="file" name="photos[]" multiple class="form-control" id="recipient-name" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>ACTIVATED</th>
                                    <th>Status</th>
                                    <th>name</th>
                                    <th>Test Date</th>
                                    <th>CLIENT CODE</th>
                                    <th>CLIENT NAME</th>
                                    <th>CLIENT Result</th>
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