document.addEventListener('DOMContentLoaded', () => {
  const heroCtrl = {
    init() {
      try {
        if( typeof Swiper === undefined ) {
          throw new Error('Swiper library can NOT be found!');
        }
        const swiper = new Swiper( '.hero .swiper', {
          spaceBetween: 10,
          loop: true,
          autoplay: {
            delay: 3000,
          },
          effect: 'fade',
          navigation: {
            prevEl: '.hero .jins-swiper-nav-btn__prev',
            nextEl: '.hero .jins-swiper-nav-btn__next',
          },
          pagination: {
            el: '.hero .jins-pagination'
          }
        } );
      } catch (error) {
        console.warn('ABOUT SECTION ERROR: ', error);
      }
    }
  };
  heroCtrl.init();
  const aboutCtrl = {
    init() {
      try {
        if( typeof Swiper === undefined ) {
          throw new Error('Swiper library can NOT be found!');
        }
        const swiper = new Swiper( '.about__carousel .swiper', {
          spaceBetween: 10,
          loop: true,
          autoplay: {
            delay: 3000,
          },
          navigation: {
            prevEl: '.about__carousel .jins-swiper-nav-btn__prev',
            nextEl: '.about__carousel .jins-swiper-nav-btn__next',
          }
        } );
      } catch (error) {
        console.warn('ABOUT SECTION ERROR: ', error);
      }
    }
  };
  aboutCtrl.init();

});