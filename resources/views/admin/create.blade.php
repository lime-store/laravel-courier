@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 500px">
    <h2>Новый заказ</h2>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3">← Назад</a>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf {{-- защита от CSRF-атак, обязательно в каждой форме --}}

        <div class="mb-3">
            <label class="form-label">Адрес откуда</label>
            <input type="text"
                   name="address_from"
                   class="form-control @error('address_from') is-invalid @enderror"
                   value="{{ old('address_from') }}"
                   placeholder="ул. Ленина, 1">
            {{-- показываем ошибку валидации если есть --}}
            @error('address_from')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Адрес куда</label>
            <input type="text"
                   name="address_to"
                   class="form-control @error('address_to') is-invalid @enderror"
                   value="{{ old('address_to') }}"
                   placeholder="ул. Пушкина, 5">
            @error('address_to')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success w-100">Создать заказ</button>
    </form>
</div>
@endsection