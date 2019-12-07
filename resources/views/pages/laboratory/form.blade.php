@extends('layouts.master')

@section('title','laboratories')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>laboratories</strong></li>
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
                        <form action="{{isset($laboratory->id) ? route('laboratories.update',$laboratory->id) : route('laboratories.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @isset($laboratory->id)
                                <input type="hidden" name="_method" value="PUT"/>
                            @endisset
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{$laboratory->name}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="username">username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="username" value="{{$laboratory->username}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="specialty">Governorate</label>
                                    <select name="governorate_id" class="form-control">
                                        <option selected value>Select Governorate</option>
                                        @foreach($governorates as $governorate)
                                            <option value="{{$governorate->id}}" {{$governorate->id == $laboratory->governorate_id ? 'selected' : ''}}>{{$governorate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="email" value="{{$laboratory->email}}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="phone">phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="phone" value="{{$laboratory->phone}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="address" value="{{$laboratory->address}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="password">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password_confirmation">confirm password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="password confirmation">
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('laboratories.index')}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
