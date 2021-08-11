export default {
  init() {
  },
  finalize() {
    $('.tel').mask('+7(Z00) 000-00-00', { translation: { 'Z': { pattern: /[0-79]/ } } })
  },
};

$('.price-block__sale a').on('click', function(e){
 e.preventDefault();
})

$('.price-block__form-close').on('click', function(){
  $(this).parent('.price-block__form').removeClass('active')
})

$('.price-block__order').on('click', function(){
  $(this).parents('.price-block__box').siblings('.price-block__form').addClass('active')
})

$('.cup-qty').each(function() {
  let qty = +parseInt($(this).text(), 10);
  if (qty == 0) {
  $('.cup-qty').css('visibility', 'hidden')
  }
  let parent = $(this).parents('.price-block__item');
  parent.find('.input-cups').val(qty);
  parent.find('.input-cups').attr('coef', qty)

  if ( parent.hasClass('good-rent') ) {
    changeTotalRent(parent)
  } else if ( parent.hasClass('good-main') ) {
    changeCoalQty(parent, qty);
  } else if ( parent.hasClass('good-fruit') ) {
    changeCoalFruit(parent, qty);
  }
})

/*  Калькулятор */

$('.change-price').on('input keyup change', function(){
  let parent = $(this).parents('.price-block__item');
  if ( parent.hasClass('good-rent') ) {
    changeTotalRent(parent)
  } else if ( parent.hasClass('good-main') ) {
    changeTotal(parent)
  } else if ( parent.hasClass('good-fruit') ) {
    let qty = parent.find('.input-shisha').val();
    changeCoalFruit(parent, qty);
  }
})


$('.input-keyup').on('input keyup', function(){
  let qty = $(this).val()
  let parent = $(this).parents('.price-block__item');
  if (qty < 1) {
    $(this).val(1)
  }
  if ( $(this).hasClass('input-shisha')  ) {
  parent.hasClass('good-fruit') ? changeCoalFruit(parent, qty) : changeCupsQty(parent, qty)
  } else if ( $(this).hasClass('input-cups') ) {
    changeCoalQty(parent, qty)
  } else {
     changeCoalFruit(parent, qty);
  }
})

$('.change-shisha').on('click', function(e){
  e.preventDefault();
  let input = $(this).siblings('.input-shisha');
  let qty = input.val()
  let parent = $(this).parents('.price-block__item');
  if ( $(this).hasClass('btn-plus') ) {
      input.val( ++qty )
    } else if (qty > 1) {
      input.val( --qty )
    }
  if ( parent.hasClass('good-rent') ) {
      changeTotalRent(parent)
    } else if ( parent.hasClass('good-main') ) {
      changeCupsQty(parent, qty);
    } else {
       changeCoalFruit(parent, qty);
    }
})

$('.change-cups').on('click', function(e){
  e.preventDefault();
  let input = $(this).siblings('.input-cups');
  let qty = input.val();
  let coef = input.attr('coef');
  let parent = $(this).parents('.price-block__item');
  let shishaQty = parent.find('.input-shisha').val()
  if ( $(this).hasClass('btn-plus') ) {
      input.val( ++qty )
    } else if (qty > shishaQty * coef) {
      input.val( --qty )
    }
    changeCoalQty(parent, qty)
})

function changeCupsQty(parent, qty) {
  let coef = parent.find('.input-cups').attr('coef')
  let input = parent.find('.input-cups');
  if (  (qty * coef) > input.val() ) {
    input.val(qty*coef)
  }
  changeCoalQty(parent, input.val())
}

function changeCoalQty(parent, qty) {
  qty = +qty;
  switch (qty) {
    case 0:
      parent.find('.coal').text('Нет');
      break;
    case 1:
      parent.find('.coal').text('4 шт');
      break;
    case 2:
        parent.find('.coal').text('12 шт');
        break;
    default:
        parent.find('.coal').text(`${qty*4 + 4 + (qty-2)*2} шт`);
    }
    changeTotal(parent)
}

function changeCoalFruit(parent, qty) {
    qty = +qty;
    parent.find('.coal').text(`${qty}0 шт`);
    changeTotalFruit(parent)
}

function changeTotal(parent) {
  let shisha = parent.find('.input-shisha').val();
  let cups = parent.find('.input-cups').val();
  let delivery = parent.find('.input-delivery').prop('checked');
  let deliverySum = delivery == true ? 500 : 0;
  let price = parent.find('.calc-price').html();
  let extraCupsPrice = parent.find('.addition').text();
  let coef = parent.find('.input-cups').attr('coef');
  let shishaSum;
  let cupsSum;
  let extraCupsQty = cups - coef * shisha;
  let total = parent.find('.price-block__total');
  if (shisha == 1) {
    shishaSum = +price;
    cupsSum = extraCupsQty * extraCupsPrice;
  } else if (shisha == 2) {
    shishaSum = +price*(1 + 0.8);
    let half = Math.ceil(extraCupsQty/2);
    cupsSum = half * extraCupsPrice + (extraCupsQty - half) * 0.8 * extraCupsPrice
  } else if ( shisha == 3 ) {
    shishaSum = +price*(1 + 0.8 + 0.7);
    let half = Math.ceil(extraCupsQty/2);
    let quarter = Math.ceil( (extraCupsQty - half)/2 );
    cupsSum = Math.round( extraCupsPrice * (half + 0.8*quarter + 0.7*(extraCupsQty-half-quarter)) )
  }
  let totalSum = shishaSum+cupsSum+deliverySum;
  total.html(`Итого: <span class="total">${totalSum}₽</span>`)
   if (!totalSum || totalSum == 'NaN₽' ) {
      total.html('<span class="total">Уточните заполнив форму</span>')
   }
}

function changeTotalRent(parent) {
  let shisha = parent.find('.input-shisha').val();
  let delivery = parent.find('.input-delivery').prop('checked');
  let deliverySum = delivery == true ? 500 : 0;
  let price = parent.find('.calc-price').html();
  let total = parent.find('.price-block__total');
  let totalSum = shisha * price + deliverySum;
  total.html(`Итого: <span class="total">${totalSum}₽</span>`)
   if (!totalSum || totalSum == 'NaN₽' ) {
      total.html('<span class="total">Уточните заполнив форму</span>')
   }

}

function changeTotalFruit(parent) {
  let shisha = parent.find('.input-shisha').val();
  let delivery = parent.find('.input-delivery').prop('checked');
  let deliverySum = delivery == true ? 500 : 0;
  let price = parent.find('.calc-price').html();
  let total = parent.find('.price-block__total');
  let  shishaSum = undefined;

  if (shisha == 1) {
    shishaSum = +price;
  } else if (shisha == 2) {
    shishaSum = +price*(1 + 0.5);
  } else if ( shisha == 3 ) {
    shishaSum = +price*(1 + 0.5 + 0.5);
  }
  let totalSum = shishaSum + deliverySum;
  total.html(`Итого: <span class="total">${totalSum}₽</span>`);
  if (!totalSum || totalSum == 'NaN₽' ) {
    total.html('<span class="total">Уточните заполнив форму</span>')
  }
}



/*  Конец Калькулятор */

$('.reviews-block__item-box, .about-page__team-slider').on('click', '.open-modal' , function() {
  let content = $(this).html();
  $('.modal-img__box').html(content);
  $('.modal-img').addClass('active');
  $('.overlay').addClass('active');
})

$('.modal__close').on('click', closeModal );

$('.overlay').mouseup(function (e) { // событие клика по веб-документу
  let modal = $('.modal.active'); // тут указываем элемент
  if (!modal.is(e.target) // если клик был не по нашему блоку
    && modal.has(e.target).length === 0) { // и не по его дочерним элементам
    closeModal()
  }
});


function closeModal() {
   $('.overlay').removeClass('active')
    $('.modal').removeClass('active')
    $('.modal-img__box').html('');
}

$('.price-block__form-item, .modal-callback__input').on('input', function(){
  if ( $(this).hasClass('name') )  {
    $(this).val().length > 1 ? $(this).addClass('filled') : $(this).removeClass('filled');
  } else if ( $(this).hasClass('tel') ) {
    $(this).val().length == 17 ? $(this).addClass('filled') : $(this).removeClass('filled')
  }
  let form = $(this).parents('form');
  checkForm(form);
})

function checkForm(form) {
  if ( form.find('.tel').hasClass('filled') &&  form.find('.name').hasClass('filled')  ) {
    form.find('input[type="submit"]').prop('disabled', false);
  } else {
    form.find('input[type="submit"]').prop('disabled', true);
  }
}

$('.price-block__form').on('submit', function(e){
  e.preventDefault();
  $('.modal-order').addClass('active');
  $('.overlay').addClass('active');
  let form = $('.modal-order .wpcf7-form')
  let item = $(this).parents('.price-block__item');
  let id = item.data('id')
  $('.modal-order__back').attr('data-id', id);
  form.find('.modal-order__form-input, .modal-order__form-title').attr('readonly', false);
  form.find('.modal-order__form-title').val( item.find('.price-block__name').text() )
  form.find('.shisha').val( item.find('.input-shisha').val() + ' шт' )
  if ( item.hasClass('good-main') ) {
    form.find('.cups').val( item.find('.input-cups').val() + ' шт' )
  } else if ( item.hasClass('good-fruit') ) {
    form.find('.cups').val( item.find('.input-shisha').val() + ' шт' )
  } else {
    form.find('.cups').val( 'Нет' )
  }
  if ( item.hasClass('good-main') || item.hasClass('good-fruit') ) {
    form.find('.coal').val( item.find('.price-block__coal-amount .coal').text() )
  } else {
    form.find('.coal').val( 'Нет' )
  }
  form.find('.time').val( item.find('.time').text() )
  form.find('.tabak').val( item.find('.tobacco').text() )
  let delivery = item.find('.input-delivery').prop('checked');
  delivery == true
  ? form.find('.delivery').removeClass('red').val('Есть (+ 500 ₽)') : form.find('.delivery').addClass('red').val('Нет')
  form.find('.name').val( item.find('.name').val() )
  form.find('.tel').val( item.find('.tel').val() )
  form.find('.modal-order__form-price').val( item.find('.total').text() )
  form.find('.modal-order__form-input, .modal-order__form-title').attr('readonly', true);
})

$('.modal-order__back').on('click', function(){
  let id = $(this).attr('data-id');
  $('.overlay').removeClass('active')
  $('.modal').removeClass('active')
  $(`.price-block__item[data-id="${id}"]`).find('.name').focus()
})

document.addEventListener( 'wpcf7mailsent', function( ) {
 if ( '142' == event.detail.contactFormId ) {
      document.location.href = '/spasibo';
    } else if ( '182' == event.detail.contactFormId ) {
      $('.modal-callback').removeClass('active')
      let phone = event.detail.inputs[1].value
      $('.modal-thx').find('.phone').text(phone);
      $('.modal-thx').addClass('active')
    }
}, false );


let sushiSvg = '<svg class="sushi" viewBox="0 0 27 28" xmlns="http://www.w3.org/2000/svg"><path d="M14.3261 9.08614V7.09068V7.01733H14.3189C14.3065 6.79205 14.2423 6.57331 14.131 6.36244C14.0098 6.13257 13.835 5.91318 13.6084 5.70755C12.5389 4.73568 10.3837 4.07031 7.89313 4.07031C5.40257 4.07031 3.24732 4.73568 2.17788 5.70755C1.95128 5.91318 1.77708 6.13257 1.65527 6.36244C1.54394 6.57331 1.47845 6.79205 1.46732 7.01733H1.45946V7.09068V15.4491C1.4588 17.5192 4.33902 19.1983 7.89248 19.1983C9.46291 19.1983 10.9011 18.8696 12.0176 18.3247V11.8223V11.7489L12.0255 11.094H12.1539C12.1912 10.9906 12.2364 10.8891 12.2901 10.7882C12.4473 10.4909 12.6699 10.2106 12.9509 9.95453C13.315 9.62315 13.7872 9.335 14.3261 9.08614ZM7.89182 8.80061C4.52894 8.80061 2.76728 7.52946 2.76728 7.09003C2.76859 7.06841 2.77645 7.04287 2.78496 7.01668C2.84194 6.84968 3.0777 6.60933 3.49356 6.36178C3.88649 6.12799 4.43988 5.89026 5.1452 5.70689C5.89178 5.51304 6.80732 5.37944 7.89248 5.37944C8.97763 5.37944 9.89383 5.51304 10.6398 5.70689C11.3451 5.89026 11.8985 6.12799 12.2914 6.36178C12.7066 6.60868 12.943 6.84968 13 7.01668C13.0085 7.04287 13.0164 7.06776 13.0164 7.09003C13.0164 7.52946 11.2547 8.80061 7.89182 8.80061Z"/><path d="M25.5333 11.7478C25.5216 11.5225 25.4561 11.3038 25.3447 11.0929C25.2236 10.863 25.0487 10.6437 24.8221 10.438C23.7527 9.46615 21.5974 8.80078 19.1069 8.80078C17.8252 8.80078 16.6373 8.97891 15.6359 9.28213C15.408 9.35089 15.188 9.42555 14.981 9.50741C14.7479 9.59975 14.5305 9.69995 14.3262 9.8067C13.962 9.99727 13.6438 10.2081 13.391 10.438C13.1644 10.6437 12.9902 10.863 12.8684 11.0929C12.757 11.3038 12.6915 11.5225 12.6797 11.7478H12.6719V11.8211V17.9509V18.7191V19.4487V20.1782C12.6719 22.249 15.5528 23.9275 19.1069 23.9275C22.6603 23.9275 25.5405 22.2497 25.5405 20.1782V11.8211V11.7478H25.5333ZM19.1075 13.5317C17.6419 13.5317 16.4801 13.2901 15.6366 12.9816C15.3917 12.8919 15.1729 12.7969 14.9817 12.7C14.7066 12.5605 14.4892 12.4191 14.3268 12.2861C14.0996 12.1001 13.983 11.9338 13.983 11.8211C13.983 11.7989 13.9908 11.7733 13.9994 11.7478C14.0347 11.643 14.15 11.5075 14.3268 11.3614C14.4316 11.2743 14.5541 11.1846 14.708 11.0929C14.7905 11.0438 14.8854 10.9947 14.9817 10.9456C15.1723 10.8493 15.393 10.7556 15.6366 10.6666C15.8586 10.5854 16.0944 10.5074 16.3596 10.438C17.1062 10.2442 18.0211 10.1106 19.1069 10.1106C20.1914 10.1106 21.1076 10.2442 21.8535 10.438C22.5588 10.6214 23.1122 10.8591 23.5051 11.0929C23.921 11.3405 24.1561 11.5808 24.2137 11.7478C24.2222 11.774 24.2294 11.7989 24.2294 11.8211C24.2314 12.2606 22.4697 13.5317 19.1075 13.5317Z"/><path d="M20.0375 11.0923C19.7179 11.0354 19.3931 11 19.1075 11C18.8554 11 18.5718 11.0308 18.2902 11.076C18.1265 11.0282 17.9268 11 17.71 11C17.1546 11 16.7054 11.1834 16.7054 11.41C16.7054 11.4813 16.7538 11.5475 16.8324 11.6064C16.7872 11.6523 16.7499 11.6988 16.7335 11.7472C16.7244 11.7721 16.7054 11.7957 16.7054 11.8206C16.7054 12.2738 18.1422 12.6412 19.1075 12.6412C19.3446 12.6412 19.6118 12.6182 19.8777 12.5783C20.0263 12.6156 20.2051 12.6412 20.4082 12.6412C20.8895 12.6412 21.2811 12.5167 21.2811 12.3628C21.2811 12.3072 21.2169 12.2581 21.1292 12.2148C21.3571 12.0976 21.5103 11.9647 21.5103 11.8206C21.5103 11.7957 21.4913 11.7715 21.4822 11.7472C21.3813 11.4597 20.7356 11.2174 20.0375 11.0923Z" /><path d="M10.2665 7.01687C10.2121 6.8597 9.99796 6.71562 9.69278 6.59643C9.75696 6.52636 9.80018 6.44908 9.80935 6.36198C9.81066 6.35019 9.81983 6.33971 9.81983 6.32727C9.81983 6.04108 9.47797 5.80859 9.05557 5.80859C8.65346 5.80859 8.33256 6.02143 8.30244 6.28929C8.16033 6.27684 8.02215 6.26898 7.89248 6.26898C7.60694 6.26898 7.28081 6.30435 6.96187 6.36132C6.84727 6.38163 6.73528 6.40455 6.62526 6.43074C6.56173 6.40324 6.49755 6.3777 6.42224 6.36132C6.33187 6.34168 6.23691 6.32661 6.1354 6.32661C6.03389 6.32661 5.93893 6.34168 5.84855 6.36132C5.52373 6.43205 5.28928 6.61346 5.28928 6.83154C5.28928 6.89703 5.31351 6.95859 5.35149 7.01622C5.39209 7.07712 5.45038 7.13017 5.52307 7.17667C5.69007 7.58859 6.99003 7.91146 7.89248 7.91146C7.91998 7.91146 7.95076 7.90818 7.97827 7.90753C8.15443 8.14853 8.58601 8.32011 9.09355 8.32011C9.75696 8.32011 10.2946 8.02868 10.2946 7.66849C10.2946 7.54995 10.2318 7.44059 10.1296 7.34432C10.2265 7.26377 10.2946 7.17929 10.2946 7.09022C10.2946 7.06533 10.275 7.0411 10.2665 7.01687Z"/></svg>'
$('.menu-shop a').prepend(sushiSvg)

$('.modal-callback__submit').prop('disabled', true)

$('.open-callback').on('click', function(){
  $('.modal-callback').addClass('active');
    $('.overlay').addClass('active');
})

$('.to-top').on('click', function () {
  $('body,html').animate({
    scrollTop: 0,
  }, 700);
  $('.to-top').removeClass('active')
  return false;
});

$(window).scroll(function() {
  let scrollHeight = $(window).scrollTop();
  let windowHeight = $(window).height();
  scrollHeight > windowHeight ? $('.to-top').addClass('active') : $('.to-top').removeClass('active')

   // sticky menu
    if( scrollHeight > windowHeight/2 ) {
    return
    } else {
    return
    }
});

$('.burger').on('click', function(){
  $(this).toggleClass('active')
})

$('.price-block__more').on('click', function(){
  let info = $(this).parents('.price-block__info');
  info.toggleClass('active');
  info.hasClass('active') ? $(this).siblings('.price-block__mobile').slideDown() : $(this).siblings('.price-block__mobile').slideUp()
})
