<div class="reviews-block">
  <div class="container">
    <h2 class="title">Отзывы</h2>
    <div class="reviews-block__wrap">
      <div class="reviews-block__item-box reviews-block__item-box_slider">
        @php
        global $post;
        $reviewsArgs = [
            'numberposts' => 5,
            'post_type'   => 'post'
        ];
        $reviews = get_posts($reviewsArgs);
        @endphp
        @foreach( $reviews as $post )
          @php setup_postdata($post) @endphp
          <div class="reviews-block__item img open-modal"><img src="@php the_post_thumbnail_url() @endphp" alt="Отзыв"></div>
        @endforeach
        @php wp_reset_postdata() @endphp
      </div>
      @include('partials.reviews-aside')
    </div>
  </div>
</div>
