@extends('layout.layout')
    @section('content')
        <div class="col-md-12">
            <div class="row">
            <div class="filter col-md-7 " style="margin-top: 60px;">
                <form id="filter-form" class="form-inline" action="">
                    <div class="form-group">
                        <label>Дата от:</label>
                        <input class="form-control" id="datepicker" type="text" name="date_from" value="">
                    </div>
                    <div class="form-group">
                        <label>Дата до:</label>
                        <input class="form-control" id="datepicker2" type="text" name="date_till" value="">
                    </div>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    <button class="btn btn-primary" type="submit" value="Выбрать">Выбрать</button>
                </form>
            </div>
            </div>
            <table class="table table-striped" style="margin-top: 60px; text-align: center;">
                <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Описание</th>
                        <th>Тип операции</th>
                        <th>Дата</th>
                        <th>Сумма операции</th>
                        <th>Редактирование операции</th>
                        <th>Удаление операции</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{$transaction->id}}</td>
                            <td>{{$transaction->description}}</td>
                            <td>{{$transaction->name}}</td>
                            <td>{{$transaction->date}}</td>
                            <td>{{$transaction->amount}}</td>
                            <td><a href="{{route('transaction.edit', ['id' => $transaction->id])}}">Редакировать</a></td>
                            <td><a href="{{route('transaction.delete', ['id' => $transaction->id])}}" style="color: red">Удалить</a></td>
                        </tr>
                    @endforeach
                    <tr id="total">
                        <th colspan="4" style="text-align: left">Итого: </th>
                        <th>{{$total}}</th>
                        <th colspan="2"></th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="sale" style="display: none;"> {{$sale}}</div>
@endsection