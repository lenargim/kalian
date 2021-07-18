<?php
/**
 * Template Name: faq
 */
?>

@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="faq-page">
    <div class="container">
      @include('partials.faq-wrap')
    </div>
    <div class="covid">
      <div class="container">
        <h2 class="title">anti-covid 19</h2>
      </div>
      <div class="covid__wrap">
        <div class="container">
          <iframe class="covid__iframe" id="covid" src="https://www.youtube.com/embed/yuIeESIKu9c"
                  title="Anti-Covid-19"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
@endsection
