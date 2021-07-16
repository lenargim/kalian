<div class="reviews">
  <div class="container">
    <h2 class="title">Отзывы</h2>
    <div class="reviews__wrap">
      <div class="reviews__item-box">
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
          <div class="reviews__item img open-modal"><img src="@php the_post_thumbnail_url() @endphp" alt="Отзыв"></div>
        @endforeach
        @php wp_reset_postdata() @endphp
      </div>
      <div class="reviews__aside">
        <div class="reviews__item-title">Другие отзывы</div>
        <ul>
          <li>
            <a href="#" class="reviews__item-link">
              <img src="@asset('images/review1.png')" alt="">
              <span>Отзывы на Яндекс-картах</span>
            </a>
          </li>
          <li>
            <a href="#" class="reviews__item-link">
              <img src="@asset('images/review2.png')" alt="">
              <span>Отзывы на Яндекс-услугах</span>
            </a>
          </li>
          <li>
            <a href="#" class="reviews__item-link">
              <img src="@asset('images/review3.png')" alt="">
              <span>Отзывы на Google-картах</span>
            </a>
          </li>
          <li>
            <a href="#" class="reviews__item-link">
              <img src="@asset('images/review4.png')" alt="">
              <span>Отзывы в Instagram</span>
            </a>
          </li>
        </ul>
        <a href="/reviews" class="reviews__item-more button">Все отзывы</a>
      </div>
    </div>
  </div>
</div>
