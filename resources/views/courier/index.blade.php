@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Добро пожаловать, {{ auth()->user()->name }}!</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Доступные заказы для взятия --}}
    <h4 class="text-success mt-4">Доступные заказы</h4>
    <table class="table table-bordered mb-4">
        <thead class="table-success">
            <tr><th>#</th><th>Откуда</th><th>Куда</th><th>Дата</th><th>Действие</th></tr>
        </thead>
        <tbody>
        @forelse($available as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->address_from }}</td>
                <td>{{ $order->address_to }}</td>
                <td>{{ \Carbon\Carbon::parse($order->order_date)->setTimezone('Asia/Baku')->format('d.m.Y H:i') }}</td>
                <td>
                    <form action="{{ route('courier.take', $order) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-primary">Взять</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted">Нет доступных заказов</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Мои активные заказы --}}
    <h4 class="text-warning">Мои заказы (в процессе)</h4>
    <table class="table table-bordered">
        <thead class="table-warning">
            <tr><th>#</th><th>Откуда</th><th>Куда</th><th>Дата</th><th>Изменить статус</th></tr>
        </thead>
        <tbody>
        @forelse($myOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->address_from }}</td>
                <td>{{ $order->address_to }}</td>
                <td>{{ \Carbon\Carbon::parse($order->order_date)->setTimezone('Asia/Baku')->format('d.m.Y H:i') }}</td>
                <td>
                    {{-- Одна форма с двумя кнопками, каждая отправляет своё значение --}}
                    <form action="{{ route('courier.status', $order) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <button name="status" value="done" class="btn btn-sm btn-success">Выполнен</button>
                        <button name="status" value="cancelled" class="btn btn-sm btn-danger">Отменить</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted">Нет активных заказов</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection