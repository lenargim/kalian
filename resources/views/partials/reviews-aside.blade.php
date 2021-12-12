<div class="reviews-block__aside">
  <div class="reviews-block__item-title">Другие отзывы</div>
  <ul>
    <li>
      <a href="https://yandex.ru/profile/89847807565" class="reviews-block__item-link" target="_blank">
        <img src="@asset('images/review1.png')" alt="">
        <span>Отзывы на Яндекс-картах</span>
      </a>
    </li>
    <li>
      <a href="https://uslugi.yandex.ru/search?action=addReview&profile=Vinipykh-1783745" class="reviews-block__item-link" target="_blank">
        <img src="@asset('images/review2.png')" alt="">
        <span>Отзывы на Яндекс-услугах</span>
      </a>
    </li>
    <li>
      <a href="https://g.page/r/CcM-TRz5fGFwEAg/review" class="reviews-block__item-link" target="_blank">
        <img src="@asset('images/review3.png')" alt="">
        <span>Отзывы на Google-картах</span>
      </a>
    </li>
    <li>
      <a href="https://www.instagram.com/vini_smr" class="reviews-block__item-link" target="_blank">
        <img src="@asset('images/review4.png')" alt="">
        <span>Отзывы в Instagram</span>
      </a>
    </li>
  </ul>
  @if(is_front_page())
    <a href="/reviews" class="reviews-block__item-more button">Все отзывы</a>
  @endif
</div>
