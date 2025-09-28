export const handleScrollEvents = function () {

    // Back to Top button on all pages

    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    window.addEventListener("scroll", processBackToTop );

    if ( document.querySelector('.single-post') ) { 

        window.addEventListener("scroll", processScrollIndicatorProgress );

    }

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

    // Scroll Indicator on blog posts
    function processScrollIndicatorProgress() {

        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = ( winScroll / height ) * 100;

        document.getElementById("scrollIndicator").style.width = scrolled + "%";

    }

}
