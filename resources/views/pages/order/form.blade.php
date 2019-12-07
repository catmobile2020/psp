@extends('layouts.master')

@section('title','orders')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>orders</strong></li>
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
                        <form action="{{isset($order->id) ? route('orders.update',$order->id) : route('orders.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @isset($order->id)
                                <input type="hidden" name="_method" value="PUT"/>
                            @endisset
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="serial_number">Patient Card</label>
                                    <input type="text" class="form-control" id="serial_number" placeholder="Patient Card" name="serial_number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pack_number">Pack Serial Number</label>
                                    <input type="text" class="form-control" id="pack_number" placeholder="Pack Serial Number" name="pack_number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="photo">upload a photo of the pack with sticker</label>
                                    <input type="file" name="photo" class="form-control" id="photo" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="comment">Comments</label>
                                    <textarea class="form-control" id="comment" name="comment" placeholder="Comments"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('orders.index')}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
