$( function() {
    var $signupForm = $( '#SignupForm' );
    
  
    
    $signupForm.formToWizard({
        submitButton: 'SaveAccount',
        nextBtnClass: 'btn btn-primary next',
        prevBtnClass: 'btn btn-default prev',
        buttonTag:    'button',
        validateBeforeNext: function(form, step) {
            var stepIsValid = true;
            var validator = form.validate();
            $(':input', step).each( function(index) {
                var xy = validator.element(this);
                stepIsValid = stepIsValid && (typeof xy == 'undefined' || xy);
            });
            return stepIsValid;
        },
        progress: function (i, count) {
            $('#progress-complete').width(''+(i/count*100)+'%');
        }
    });
    
    
});
function votar(){
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Estas seguro de registrar el voto ?',
      text: "Nombre de la empresa!",
      value: 1,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si , estoy seguro!',
      cancelButtonText: 'No, no estoy seguro!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        swalWithBootstrapButtons.fire(
          'Succes!',
          'Voto seleccionado.',
          'success'
          
        )

       
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Voto cancelado',          
          'error'
        )      

        jQuery("input[type=checkbox]").prop("checked",false);
          
       
      }
    })
}




// Wait for the DOM to be ready
jQuery(function () {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  jQuery("#SignupForm").validate({
    // Specify validation rules
    rules: {
      nombre: {
        required: true,
        
        // namestring: true ,
      },
      cedula: {
        required: true,
       
        // namestring: true ,
      },

      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side

      email: {
        required: true,     
        email: true,
        
      },
     
      aceptacion: {
        required: true,
      },

      ciudad: {
        required: true,
      }
    },
    // Specify validation error messages
    messages: {
      nombre: {
        required: "Este campo es obligatorio.",
       
        // namestring : "Ingrese sólo letras o espacios"
      },
      cedula: {
        required :  "Este campo es obligatorio.",
       
      },
      email: {
        required: "Por favor ingrese un email válido.",
        
      }
      ,
      aceptacion: {
        required: "Debe aceptar términos y condiciones y políticas de protección de datos personales.",
      },

      ciudad: {
        required: "Debe seleccionar una ciudad.",
      },

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function (form) {
      form.submit();
    }
  });
});

