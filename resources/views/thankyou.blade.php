<?php
/**
 * Template Name: Thankyou
 */
?>

@extends('layouts.app')

@section('content')
  <div class="thx">
    <div class="container">
      <div class="thx__wrap">
        @include('icon::thx', ['class' => 'thx__icon'])
        <div class="thx__text">
          <h1 class="thx__title">{{ the_title() }}</h1>
          <div class="thx__desc">Заказ на Ваше имя создан, пожалуйста ожидайте звонка оператора, он подтвердит и
            подробно объяснит детали.
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('partials.steps')
@endsection
