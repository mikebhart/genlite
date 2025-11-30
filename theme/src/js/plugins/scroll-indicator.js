export const handleScrollIndicator = function () {

    if ( document.querySelector('.single-post') ) { 
        
        window.addEventListener("scroll", processScrollIndicatorProgress );
    
    } else {

        return; 
        
    }

    function processScrollIndicatorProgress() {

        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = ( winScroll / height ) * 100;

        document.getElementById("scrollIndicator").style.width = scrolled + "%";

    }


}
