@extends('layouts.app')

@section('content')
  @include('partials.breadcrumbs')
  <div class="reviews-page">
    <div class="container">
      <div class="reviews-page__wrap">
        <div class="reviews-block__item-box">
          @php
            global $query_string;
            query_posts( $query_string .'&posts_per_page=10' );
          @endphp
          @while(have_posts()) @php the_post() @endphp
          <div class="reviews-block__item img open-modal"><img src="@php the_post_thumbnail_url() @endphp" alt="Отзыв"></div>
          @endwhile
          @php wp_reset_query() @endphp
          @php
            global $wp_query;
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $max_pages = $wp_query->max_num_pages;
          @endphp
        </div>
        @include('partials.reviews-aside')
      </div>
      {{--    если страница не последняя показать кнопку "еще"   --}}
      @if( $paged < $max_pages )
        @php
          echo '<div id="loadmore-reviews" class="loadmore"><a href="#" data-max_pages="' . $max_pages . '" data-paged="' . $paged . '">Ещё</a></div>';
        @endphp
      @endif
    </div>
  </div>
@endsection
