@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
{{--todo errors display --}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>Баланс {{$user->wallet->balance}}</div>

                    <form action="{{route('wallet.update', ['id' => $user->wallet->id])}}" method="post">
                        @csrf
                        Пополнить кошелек
                        <input type="number" name="amount">
                        <input type="submit">
                    </form>

                    <form action="{{route('deposit.store')}}" method="post">
                        <input type="hidden" name="wallet_id" value="{{$user->wallet->id}}">
                        @csrf
                        Открыть депозит на сумму
                        {{-- todo --}}
                        <input type="number" name="amount" min="10" max="100">
                        <input type="submit">
                    </form>


                    <form action="{{route('deposit.test')}}" method="post">
                        @csrf
                        провести платеж по депозиту,потом удалить
                        <input type="submit">
                    </form>


                    @foreach($user->deposits ?? [] as $deposit)
                        <div>
                            {{$deposit}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
