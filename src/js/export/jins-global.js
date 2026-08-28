import JinsTabs from '../components/jins-tabs';
document.addEventListener('DOMContentLoaded', () => {
  new JinsTabs();

  const customerReviewCtrl = {
    init() {
      try {
        const swiper = this.initSwiper();
        this.tabsInteractWithSlide( swiper );
      } catch (error) {
        console.warn('CUSTOMER REVIEW ERROR: ', error);
      }
    },
    tabsInteractWithSlide( swiper ) {
      const swiperEls = [...document.querySelectorAll('.customer-review__carousel .swiper-slide')];
      if( swiperEls.length === 0 ) {
        throw new Error( 'Review items can NOT be found.' );
      }
      const reviewItems = swiperEls.reduce( (acc, swiperEl) => {
        const review = swiperEl.querySelector('.review');
        const platform = review.dataset.platform;
        acc[platform] = !acc[platform] || acc[platform].length === 0 ? [swiperEl] : [...acc[platform], swiperEl];
        return acc;
      }, {} );

      const tabsContainer = document.querySelector('.customer-review .jins-tabs');
      tabsContainer.addEventListener('jins_tabs:switch_tab', event => {
        const { clickedNavItem } = event.detail;
        const navItemID = clickedNavItem.id;
        if( navItemID.includes('all-reviews') ) {
          swiperEls.forEach( swiperEl => {
            swiperEl.setAttribute('aria-hidden', 'false');
          } );
        } else {
          swiperEls.forEach( swiperEl => {
            const review = swiperEl.querySelector('.review');
            const platform = review.dataset.platform;
            const isSelectedPlatform = navItemID.includes(platform);
            if( isSelectedPlatform ) {
              swiperEl.setAttribute('aria-hidden', 'false');
            } else {
              swiperEl.setAttribute('aria-hidden', 'true');
            }
          });
        }
        swiper.update();
      });
    },
    initSwiper() {
      if( typeof Swiper === undefined ) {
        throw new Error( 'Swiper library not found!' );
      }
      return new Swiper('.customer-review__carousel .swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
          delay: 5000,
        },
        navigation: {
          prevEl: '.customer-review__carousel .jins-swiper-nav-btn__prev',
          nextEl: '.customer-review__carousel .jins-swiper-nav-btn__next',
        },
        breakpoints: {
          550: {
            slidesPerView: 2,
          },
          850: {
            slidesPerView: 4,
          },
        }
      });
    }
  };
  customerReviewCtrl.init();

  const bookingFormCtrl = {
    init() {
      try {
        const bookingBtn = document.querySelector('.fixed-social-icons__item[data-slug="booking"]');
        const bookingPopover = document.querySelector('#booking-popover');
        if( !bookingPopover ) {
          throw new Error('Booking popover form can NOT be found!');
        }

        const SEASON_KEY = 'is_popup_showed';

        const popupTimeout = setTimeout(() => {
          if( sessionStorage.getItem( SEASON_KEY ) !== 'true' ) {
            bookingPopover.showPopover();
            sessionStorage.setItem( SEASON_KEY, true );
          }
          clearTimeout( popupTimeout );
        }, 1000);

        if( !bookingBtn ) {
          throw new Error('Booking toggle button can NOT be found!');
        }

        bookingBtn.addEventListener('click', event => {
          bookingPopover.showPopover();
        });
      } catch (error) {
        console.warn('BOOKING FORM POPOVER ERROR: ', error);
      }
    }
  };
  bookingFormCtrl.init();
});