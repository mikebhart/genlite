export const handleContactUsForm = function () {

    if ( !document.querySelector('.block-contact-us') ) { 
        return;
    }

    var forms = document.querySelectorAll('.needs-contact-validation');

    Array.prototype.slice.call(forms)    
        
        .forEach(function (form) {

            form.addEventListener('submit', function (event) {

                if ( !form.checkValidity() ) {

                    event.preventDefault();
                    event.stopPropagation();

                }

                form.classList.add('was-validated');

        
            }, false);
    });


}
