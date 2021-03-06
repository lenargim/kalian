<div class="reviews-block__aside">
  <div class="reviews-block__item-title">Другие отзывы</div>
  <ul>
    <li>
      <a href="@php the_field('yandex-maps',9) @endphp" class="reviews-block__item-link" target="_blank">
        <img src="@asset('images/review1.png')" alt="">
        <span>Отзывы на Яндекс-картах</span>
      </a>
    </li>
    <li>
      <a href="@php the_field('yandex-services',9) @endphp" class="reviews-block__item-link" target="_blank">
        <img src="@asset('images/review2.png')" alt="">
        <span>Отзывы на Яндекс-услугах</span>
      </a>
    </li>
    <li>
      <a href="@php the_field('google-maps',9) @endphp" class="reviews-block__item-link" target="_blank">
        <img src="@asset('images/review3.png')" alt="">
        <span>Отзывы на Google-картах</span>
      </a>
    </li>
    <li>
      <a href="https://www.instagram.com/@php the_field('instagram',9) @endphp" class="reviews-block__item-link" target="_blank">
        <img src="@asset('images/review4.png')" alt="">
        <span>Отзывы в Instagram</span>
      </a>
    </li>
  </ul>
  @if(is_front_page())
    <a href="/reviews" class="reviews-block__item-more button">Все отзывы</a>
  @endif
</div>
