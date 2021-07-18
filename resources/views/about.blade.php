<?php
/**
 * Template Name: about
 */
?>

@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="about-page">
    <section class="about-page__box" style='background-image: url( @asset("images/about-bg.svg"); )'>
      <div class="container">
        <div class="about-page__wrap">
          <div class="about-page__img img"><img src="{{ the_post_thumbnail_url() }}" alt="{{ the_title() }}"></div>
          <div class="about-page__content">{{ the_content() }}</div>
        </div>
      </div>
    </section>
    <div class="container">
      <div class="about-page__info">
        <div class="about-page__info-item">
          @include('icon::about1', ['class' => 'icon'])
          <span>Работаем <span class="orange">24/7</span><br>с <span class="orange">2015</span> года</span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about2', ['class' => 'icon'])
          <span>Доставим<br>за <span class="orange">30-40</span> мин</span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about3', ['class' => 'icon'])
          <span>С собой более<br><span class="orange">40 разных вкусов</span></span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about4', ['class' => 'icon'])
          <span>Гарантируем качество<br><span class="orange">100%</span></span>
        </div>
      </div>
    </div>
    <div class="about-page__tools">
      <div class="container">
        <h2 class="title">Наше оборудование</h2>
      </div>
      <div class="about-page__slider-wrap">
        <div class="container">
          <div class="about-page__slider">
            @while(have_rows('equipment')) @php the_row() @endphp
            <div class="about-page__slider-item">
              <div class="about-page__slider-img">
                <img src="@php the_sub_field('img'); @endphp" alt="@php the_title() @endphp">
              </div>
              <div class="about-page__slider-info">
                <div class="about-page__slider-name">@php the_sub_field('name') @endphp</div>
                <div class="about-page__slider-text">@php the_sub_field('desc') @endphp
                </div>
              </div>
            </div>
            @endwhile
            @php wp_reset_postdata() @endphp
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
