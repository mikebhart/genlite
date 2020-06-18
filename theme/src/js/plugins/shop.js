export default {

    setup() {

        filterButton();

        function filterButton() {

            $('[data-toggle="offcanvas"]').click(function () {
                $('#genlite-shop-wrapper').toggleClass('toggled');
            });  


        }



    }

}

