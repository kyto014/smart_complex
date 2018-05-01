$("#create-person-form").submit(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    console.log($(this).serializeArray());

    $.ajax({
        type: "POST",
        url: $(this).data("href"),
        data: $(this).serialize(),
        success: function (data) {
            console.log(data);
        }
    });
    e.preventDefault();
});
