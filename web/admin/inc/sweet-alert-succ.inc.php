<script type="text/javascript">
var success_msg = 'Sign Up successful.';
function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 10000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('success', success_msg);
</script>    