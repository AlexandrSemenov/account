@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-md-offset-4 col-md-4" style="margin-top: 100px">
            <h4 style="text-align: center">Редактировать операцию</h4>

            <form action="{{route('transaction.update', ['id' => $transaction->id])}}" method="post">
                <div class="form-group {{ $errors->first('description')? 'has-error' : '' }}">
                    <textarea class="form-control" type="text" name="description" value="" placeholder="Описание операции">{{$transaction->description}}</textarea>
                    @if ($errors->first('description'))
                        <span class="help-block">{{  $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->first('amount')? 'has-error' : '' }}">
                    <input class="form-control" type="number" name="amount" value="{{$transaction->amount}}" placeholder="Сумма">
                    @if ($errors->first('amount'))
                        <span class="help-block">{{  $errors->first('amount') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <select class="form-control" name="type">
                        <option value="1" {{$transaction->type == 1 ? "selected=selected":""}}>Приход</option>
                        <option value="2" {{$transaction->type == 2 ? "selected='selected'":""}}>Расход</option>
                    </select>
                </div>
                <div class="form-group {{ $errors->first('date')? 'has-error' : '' }}">
                    <input class="form-control" id="datepicker" type="text" name="date" value="{{$transaction->date}}">
                    @if ($errors->first('date'))
                        <span class="help-block">{{  $errors->first('date') }}</span>
                    @endif
                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input class="btn btn-primary btn-block" type="submit" value="Обновить">
            </form>
        </div>
    </div>
@endsection