@extends('layouts.app')
@section('content')
<div class="panel-body">
    <!-- バリデーションエラーの場合に表示 -->
    @include('common.errors')
    <!-- リスト作成フォーム -->
    <form action="{{ url('listings') }}" method="POST" class="form-horisontal">
        {{csrf_field()}}
            <div class="form-group">
                <label for="listing" class="col-sm-3 control-label">リスト名</label>
                <div class="col-sm-6">
                    <input type="text" name="list-name" class="form-control" value="{{ old('list_name') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-msm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> 作成 </button>
                </div>
            </div>
    </form>
</div>
@endforeach
