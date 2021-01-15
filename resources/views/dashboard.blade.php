@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>Баланс кошелька <span>{{$user->wallet->balance}}</span></div>

                    <form class="form-inline mb-3" action="{{route('wallet.update', ['id' => $user->wallet->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="wallet">Пополнить кошелек</label>
                            <input name="amount" type="number" id="wallet" class="form-control mx-sm-3">
                        </div>

                        <button type="submit" class="btn btn-success">Пополнить</button>
                    </form>

                    <form class="form-inline" action="{{route('deposit.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="wallet_id" value="{{$user->wallet->id}}">
                        <div class="form-group">
                            <label for="deposit">Открыть депозит</label>
                            <input name="amount" type="number"  id="deposit" class="form-control mx-sm-3">
                        </div>

                        <button type="submit" class="btn btn-success">Открыть</button>
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Депозиты</div>
                <div class="card-body">

                    @if($user->deposits->isEmpty())
                        <div>У Вас нет депозитов</div>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Сумма вклада</th>
                                <th scope="col">Процент</th>
                                <th scope="col">Кол-во текущих начислений</th>
                                <th scope="col">Сумма начислений</th>
                                <th scope="col">Статус депозита</th>
                                <th scope="col">Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->deposits as $deposit)
                                <tr>
                                    <th scope="row">{{$deposit->id}}</th>
                                    <td>{{$deposit->invested}}</td>
                                    <td>{{$deposit->percent}}</td>
                                    <td>{{$deposit->accrue_times}}</td>
                                    <td>{{$deposit->profit}}</td>
                                    <td>
                                        @if($deposit->active)
                                            <span class="text-success">Открыт</span>
                                        @else
                                            <span class="text-danger">Закрыт</span>
                                        @endif
                                    </td>
                                    <td>{{$deposit->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Транзакции</div>
                <div class="card-body">

                    @if($user->transactions->isEmpty())
                        <div>Транзакции отсутствуют</div>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Тип</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Дата</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($user->transactions as $transaction)
                                <tr>
                                    <th scope="row">{{$transaction->id}}</th>
                                    <td>{{$transaction->type}}</td>
                                    <td>{{$transaction->amount > 0 ? $transaction->amount : ''}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
