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
  <div class="map">
    <div class="container">
      <h2 class="title">Карта доставки</h2>
      <div class="map__desc">Уточните стоимость доставки, возможно у администратора найдется бонус для вас.
      </div>
      @include('partials.map')
    </div>
  </div>
  @include('partials.steps')
@endsection
