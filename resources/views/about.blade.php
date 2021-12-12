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
          <span><span class="orange">Шестилетний опыт</span> позволяет называть себя профессионалами</span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about2', ['class' => 'icon'])
          <span>Работаем <br><span class="orange">24/7</span></span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about3', ['class' => 'icon'])
          <span><span class="orange">Честная и понятная цена.</span> Никаких допов, все включено</span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about4', ['class' => 'icon'])
          <span>Мы <span class="orange">слушаем и слышим</span> своих клиентов</span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about5', ['class' => 'icon'])
          <span>Мы дорожим <br>своей <span class="orange">репутацией</span></span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about6', ['class' => 'icon'])
          <span>Мы ставим <span class="orange">жесткие стандарты качества</span> в отборе каждого кальянщика</span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about7', ['class' => 'icon'])
          <span>Понятная <br><span class="orange">бонусная система</span></span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about8', ['class' => 'icon'])
          <span><span class="orange">Честность и добросовестность</span> наши основные принципы</span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about9', ['class' => 'icon'])
          <span>Всегда боле <span class="orange">35-40 банок табака</span> <br>с разными вкусами, а это тонна миксов</span>
        </div>
        <div class="about-page__info-item">
          @include('icon::about10', ['class' => 'icon'])
          <span>Мы никогда <span class="orange">не говорим "нет"</span><br>нашим клиентам</span>
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
              <div class="about-page__slider-img img">
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
    <div class="about-page__team">
      <div class="container">
        <h2 class="title">Фото и видео нашей команды</h2>
      </div>
      <div class="about-page__team-slider-wrap">
        <div class="container">
          <div class="about-page__team-slider">
            @while(have_rows('team')) @php the_row() @endphp
            <div class="about-page__team-item" data-fancybox="gallery" data-src="@php the_sub_field('img') @endphp">
              <img src="@php the_sub_field('img') @endphp" alt="@php the_sub_field('name') @endphp">
              <div class="about-page__team-text">@php the_sub_field('name') @endphp</div>
            </div>
            @endwhile
            @php wp_reset_postdata() @endphp
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
