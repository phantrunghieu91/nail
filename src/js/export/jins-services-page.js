document.addEventListener('DOMContentLoaded', () => {
  const packageCtrl = {
    init() {
      try {
        this.wrapperEls = [...document.querySelectorAll('.packages__item')];
        if( this.wrapperEls.length == 0 ) {
          throw new Error('Swiper elements can NOT be found!');
        }
        // this.initSwiper();
        this.bindFancybox();
      } catch (error) {
        console.warn('PACKAGE SECTION ERROR: ', error);
      }
    },
    initSwiper() {
      if( typeof Swiper === undefined ) {
        throw new Error('Swiper library have NOT registered!');
      }
      
      this.wrapperEls.forEach( wrapperEl => {
        const swiperEl = wrapperEl.querySelector('.swiper');
        new Swiper( swiperEl, {
          navigation: {
            prevEl: swiperEl.querySelector('.jins-swiper-nav-btn__prev'),
            nextEl: swiperEl.querySelector('.jins-swiper-nav-btn__next'),
          }
        });
      });
    },
    bindFancybox() {
      if( typeof Fancybox === undefined ) {
        throw new Error('Fancybox library have NOT registered!');
      }
      this.wrapperEls.forEach( swiperEl => {
        const gallerySlug = `gallery-${swiperEl.dataset.slug}`;
        Fancybox.bind(`[data-fancybox="${gallerySlug}"]`, {
          Thumbs: {
            type: 'classic',
          }
        });
      });
    }
  };
  packageCtrl.init();
});