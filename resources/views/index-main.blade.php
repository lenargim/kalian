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
  @include('partials.faq')
@endsection
