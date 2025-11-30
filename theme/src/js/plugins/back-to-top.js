export const handleBackToTop = function () {
    
    // Back to Top button on all pages

    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    window.addEventListener("scroll", processBackToTop );

    function processBackToTop() {

        let showScrollTopPosition = 50;

        if ( document.body.scrollTop > showScrollTopPosition || document.documentElement.scrollTop > showScrollTopPosition ) {

            $('#genlite-back-to-top').addClass('show');

        } else {

            $('#genlite-back-to-top').removeClass('show');

        }
    }

    $('#genlite-back-to-top').on('click', function (e) {

        e.preventDefault();

        $('html,body').animate( { scrollTop: 0 }, 800 );
      

    });





}