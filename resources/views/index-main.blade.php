<?php
/**
 * Template Name: Main
 */
?>

@extends('layouts.app')

@section('content')
  @include('partials.bannner')
  @include('partials.actions-slider')
  @include('partials.covid-block')
  @include('partials.price-block')
  @include('partials.brands')
  @include('partials.steps')
  @include('partials.reviews')
  <div class="map">
    <div class="container">
      <h2 class="title">Карта доставки</h2>
      <div class="map__desc map__desc_center">На карте указаны зоны доставки и стоимость в зависимости от отдаленности вашего района.
      </div>
      @include('partials.map')
    </div>
  </div>
  @include('partials.faq')
@endsection
