<?php
/**
 * Template Name: delivery
 */
?>

@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="map">
    <div class="container">
      <h2 class="title">Карта доставки</h2>
      <div class="map__desc">Уточните стоимость доставки, возможно у администратора найдется бонус для вас.
      </div>
      @include('partials.map')
    </div>
  </div>
  <div class="steps">
    <div class="container">
      <h2 class="title delivery__steps-title">Доставка</h2>
      <div class="delivery__steps-desc">Доставка зависит от района и удаленности, зоны доставки можно посмотреть на карте доставки</div>
    </div>
    @include('partials.steps-box')
    <div class="steps__link">
      <a href="/price" class="button">Смотреть каталог</a>
    </div>
  </div>
  <div class="paying">
    <div class="container">
      <h2 class="title">Оплата</h2>
      <div class="paying__desc">Оплата производится двумя способами</div>
      <div class="paying__wrap">
        <div class="paying__item">
          @include('icon::payment1', ['class' => 'icon'])
          <span>Наличным курьеру</span>
        </div>
        <div class="paying__item">
          @include('icon::payment2', ['class' => 'icon'])
          <span>Оплата на сайте</span>
        </div>
      </div>
    </div>
  </div>
@endsection
