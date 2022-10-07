console.log("Page is Ready");
    // Variables for toaster and sweetalert2
    const success = 'success';
    const info = 'info';
    const error = 'error';
    const warning = 'warning';
    const question = 'question';

    toastr.options = {
        //closeButton: $('#closeButton').prop('checked'),
        debug: true,
        newestOnTop: true,
        progressBar: true,
        //rtl: true,
        positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
        preventDuplicates: true,
        onclick: null
    };

    var Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 3000,
        padding: '1.5rem'
    });

    // Function to manipulate the toaster notification
    const showToast = (type, text) =>
        Toast.fire({
            type: type,//'success',
            //title: title,//'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            text: text,
            customClass: {container: 'border rounded p-0 border-'+type, content: 'text-'+type}
        });
