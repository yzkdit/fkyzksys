@extends('layouts.master-admin')

@section('title', 'QR発行ラベル')

@section('content')

    <div id="page-wrapper">
        
        <!-- メッセージ -->
        <div class="row">
            <div class="col-lg-12">
                <br />
                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <label class="control-label">{{ Session::get('message') }}</label>
                    </div>
                @endif
            </div>
        </div>
        <!-- /.row -->

        <!-- 検索条件 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="#" class="panel-title" data-toggle="collapse" data-target="#search">検索</a>
                    </div>
                    <div id="search" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="col-lg-12">

                                {!! Form::open(array(
                                    'method' => 'GET',
                                    'url' => '/admin/print/index', 
                                    'class' => 'form-horizontal')) !!}

                                    {{ csrf_field() }}

                                    <!-- 品番 -->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">品番</label>
                                        <div class="col-md-10">
                                            {!! Form::tel('sHinban', Request::get('sHinban'), 
                                            array(
                                                'id' => 'sHinban',
                                                'class' => 'form-control hankaku',
                                                'maxlength' => '255'
                                            )) !!}
                                        </div>
                                    </div>
                                    <!-- 治工具品番 -->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">治工具品番</label>
                                        <div class="col-md-10">
                                            {!! Form::tel('sChikouguhinban', Request::get('sChikouguhinban'), 
                                            array(
                                                'id' => 'sChikouguhinban',
                                                'class' => 'form-control hankaku',
                                                'maxlength' => '10'
                                            )) !!}
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="検索" />
                                    <a class="btn btn-primary" href="/admin/print/index">リセット</a>

                                {!! Form::close() !!}

                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- テーブル -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="panel-title">在庫リスト一覧</p>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            @if($models->count() > 0)
                                <a name="table"></a>
                                {{ $models->appends(request()->input())->fragment('table')->links() }}
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">品番</th>
                                            <th class="text-center">治工具品番</th>
                                            <th class="text-center">印刷</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($models as $model)
                                        <tr>
                                            <td class="text-left">{{ $model->hinban }}</td>
                                            <td>{{ $model->chikouguhinban }}</td>
                                            <td>
                                            	<a href="/admin/print/{{ $model->id }}" target="_blank">印刷</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $models->appends(request()->input())->fragment('table')->links() }}
                            @else
                                <label>データがありません。</label>
                            @endif
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

@endsection