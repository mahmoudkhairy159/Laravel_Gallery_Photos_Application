$(function () {

    $("form.delete-btn").on("submit", function (event) {
        event.preventDefault();

        let msg = event.target.dataset.message ?
            event.target.dataset.message :
            "Are you sure?";

        Swal.fire({
            title: msg,
            // text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    });


});
