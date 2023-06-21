export const handleBackToTopButton = function () {

    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    var showScrollTopPosition = 50;

    window.onscroll = function() { scrollFunction() };

    // show button after reaches y position
    function scrollFunction() {

        if (document.body.scrollTop > showScrollTopPosition || document.documentElement.scrollTop > showScrollTopPosition) {

            $('#kkr-back-to-top').addClass('show');

        } else {

            $('#kkr-back-to-top').removeClass('show');

        }
    }

    // Go Back to Top
    $('#kkr-back-to-top').on('click', function (e) {

        e.preventDefault();

        $('html,body').animate( { scrollTop: 0 }, 800 );
      

    });





}
