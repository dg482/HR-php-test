<?php
/**
 * Created by PhpStorm.
 * User: dg
 * Date: 09.10.2019
 * Time: 15:11
 */
?>
@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Погода в Брянске: {{ceil($result['currently']['temperature'])}}</h3>
        </div>
        <br>
        <br>
    </div>
@endsection
