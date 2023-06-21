
export const handleNavSections = function () {

    // Go to sticky navbar section links
    $(".block-nav-sections a").on('click', function(event) {

        if ( this.hash !== "" ) {

            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top -56
            }, 800, function(){

                window.location.hash = hash;

            });

        } 

    });

    // Mobile page hero image page down

    $(".block-hero-image__mobile-button-container a").on('click', function(event) {

        if ( this.hash !== "" ) {

            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){

                window.location.hash = hash;

            });

        } 

    });


    // // Go to document url section link
    var hash_url = window.location.hash;

    if ( hash_url !== "" ) {

        $('html, body').animate( {

            scrollTop: $( hash_url ).offset().top

        }, 0, function(){

            window.location.hash = hash_url;
        });

    }

 
    if ( document.querySelector('.block-nav-sections') ) { 

        const sections = document.querySelectorAll("section[id]");
        const navLi = document.querySelectorAll("nav .nav-container ul li");

        window.onscroll = () => {
            
            var current = "";

            sections.forEach(( section) => {
                const sectionTop = section.offsetTop;

                if ( window.pageYOffset >= sectionTop - 56 ) {
                    current = section.getAttribute("id"); 
                }

            });

            navLi.forEach((li) => {
                
                li.classList.remove("active");

                if ( li.classList.contains(current) ) {
                    li.classList.add("active");
                }

            });
       };

    }

}
