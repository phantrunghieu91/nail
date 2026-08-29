import JinsTabs from '../components/jins-tabs';
document.addEventListener('DOMContentLoaded', () => {
  new JinsTabs();

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