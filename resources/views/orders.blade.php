<?php
/**
 * Created by PhpStorm.
 * User: dg
 * Date: 09.10.2019
 * Time: 11:54
 *
 * @var $orders \Illuminate\Support\Collection
 */

?>

@extends('layout')



@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>ид_заказа</td>
                    <td>название_партнера</td>
                    <td>стоимость_заказа</td>
                    <td>наименование_состав_заказа</td>
                    <td>статус_заказа</td>
                </tr>
                </thead>
                <tbody>
                @foreach($orders->all() as $order)
                    @php
                        $data = $order->getData();
                    @endphp
                    <tr>
                        <td><a href="{{ route('orders_edit', ['id' => $order->id]) }}" target="_blank">
                                {{$order->id}}
                            </a>
                        </td>
                        <td>{{$data['partner']->name}}</td>
                        <td>{{$data['sum']}}</td>
                        <td>
                            @if($data['products'])
                                <ul>
                                    @foreach($data['products'] as $product)
                                        <li>{{$product->name}} ({{$product->quantity}} * {{$product->price}})</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>{{$data['status']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection