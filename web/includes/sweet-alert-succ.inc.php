
function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 10000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('success', success_msg);
   