export const handleBackToTopButton = function () {

    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    var showScrollTopPosition = 50;

    window.onscroll = function() { scrollFunction() };

    // show button after reaches y position
    function scrollFunction() {

        if (document.body.scrollTop > showScrollTopPosition || document.documentElement.scrollTop > showScrollTopPosition) {

            $('#genlite-back-to-top').addClass('show');

        } else {

            $('#genlite-back-to-top').removeClass('show');

        }
    }

    // Go Back to Top
    $('#genlite-back-to-top').on('click', function (e) {

        e.preventDefault();

        $('html,body').animate( { scrollTop: 0 }, 800 );
      

    });





}
