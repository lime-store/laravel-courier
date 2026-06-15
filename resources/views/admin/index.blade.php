@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Кнопка создания заказа --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Панель администратора</h2>
        <a href="{{ route('admin.create') }}" class="btn btn-primary">+ Новый заказ</a>
    </div>

    {{-- Сообщение об успехе --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Доступные заказы --}}
    <h4 class="text-success">Доступные ({{ $available->count() }})</h4>
    <table class="table table-bordered mb-4">
        <thead class="table-success">
            <tr><th>#</th><th>Откуда</th><th>Куда</th><th>Дата</th></tr>
        </thead>
        <tbody>
        @forelse($available as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->address_from }}</td>
                <td>{{ $order->address_to }}</td>
                <td>{{ \Carbon\Carbon::parse($order->order_date)->setTimezone('Asia/Baku')->format('d.m.Y H:i') }}</td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted">Нет заказов</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- В процессе --}}
    <h4 class="text-warning">В процессе ({{ $inProgress->count() }})</h4>
    <table class="table table-bordered mb-4">
        <thead class="table-warning">
            <tr><th>#</th><th>Откуда</th><th>Куда</th><th>Курьер</th><th>Дата</th></tr>
        </thead>
        <tbody>
        @forelse($inProgress as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->address_from }}</td>
                <td>{{ $order->address_to }}</td>
                <td>{{ $order->courier->name ?? '—' }}</td>
                <td>{{ \Carbon\Carbon::parse($order->order_date)->setTimezone('Asia/Baku')->format('d.m.Y H:i') }}</td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted">Нет заказов</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Архив --}}
    <h4 class="text-secondary">Архив ({{ $archived->count() }})</h4>
    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr><th>#</th><th>Откуда</th><th>Куда</th><th>Статус</th><th>Курьер</th><th>Дата</th></tr>
        </thead>
        <tbody>
        @forelse($archived as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->address_from }}</td>
                <td>{{ $order->address_to }}</td>
                <td>
                    <span class="badge {{ $order->status === 'done' ? 'bg-success' : 'bg-danger' }}">
                        {{ $order->status === 'done' ? 'Выполнен' : 'Отменён' }}
                    </span>
                </td>
                <td>{{ $order->courier->name ?? '—' }}</td>
                <td>{{ \Carbon\Carbon::parse($order->order_date)->setTimezone('Asia/Baku')->format('d.m.Y H:i') }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Нет заказов</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection