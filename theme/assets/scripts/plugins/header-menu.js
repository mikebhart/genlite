export const handleHeaderMenu = function () {


    $('#mobile-menu-button').on('click', function (e) {

        var x = document.getElementById("mobile-links");
        
        if (x.style.display === "block") {

            x.style.display = "none";

        } else {
            
            x.style.display = "block";

        }

    });

}
