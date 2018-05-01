$(document).on('click', '#btn-continue', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "DELETE",
        url: $(this).data("href"),
        //data: $(this).serialize(),
        success: function (data) {
            window.location.reload();
            //console.log(data);
        }
    });
    e.preventDefault();
});
