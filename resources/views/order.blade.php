<?php
/**
 * Created by PhpStorm.
 * User: dg
 * Date: 09.10.2019
 * Time: 13:01
 *
 * @var \Illuminate\Support\ViewErrorBag $errors
 */


?>
@extends('layout')



@section('content')
    <div class="row">
        <div class="col-md-12">

            @if(isset($message) && $message == 'ok')
                <div class="alert alert-success" role="alert">
                    Заказ обновлен
                </div>
            @endif


            @if($errors->count())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('order_update', ['id' => $data['id']]) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label">Email клиента</label>
                    <input type="email" class="form-control" placeholder="Email" name="client_email" value="{{ $data['client_email'] }}" required/>
                </div>

                <div class="form-group">
                    <label>Партнёр</label>
                    <select class="form-control" name="partner" required>
                        @foreach ($partners as $partner)
                            @if ($partner->id === $order->partner_id)
                                <option value="{{ $partner->id }}" selected>{{ $partner->name }}</option>
                            @else
                                <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <ul>
                        @foreach($data['products'] as $product)
                            <li>{{$product->name}} ({{ $product->quantity }} * {{ $product->price }})</li>
                        @endforeach
                    </ul>
                </div>

                <div class="form-group">
                    <label>Статус</label>
                    <select class="form-control" name="status" required>
                        @foreach ($status_list as $key => $value)
                            @if ($key === $order->status)
                                <option value="{{ $key }}" selected>{{ $value }}</option>
                            @else
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Стоимость</label>
                    <p>{{ $data['sum'] }}</p>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
