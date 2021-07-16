<div class="faq">
  <div class="container">
    <h2 class="title">FAQ</h2>
    <div class="faq__wrap">
      <div class="faq__questions">
        @while ( have_rows('faq', 27) ) @php the_row() @endphp
        <div class="faq__questions-item">@php the_sub_field('question') @endphp</div>
        @endwhile
      </div>
      <div class="faq__answers">
        @while ( have_rows('faq', 27) ) @php the_row() @endphp
        <div class="faq__answers-item">
          <div class="faq__answers-title">@php the_sub_field('question') @endphp</div>
          <div class="faq__answers-box">@php the_sub_field('answer') @endphp
          </div>
        </div>
        @endwhile
      </div>
    </div>
  </div>
</div>
