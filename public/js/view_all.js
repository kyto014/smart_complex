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

$('.page-table-td').on("click",function(){
    window.location = $(this).closest('tr').data('href');
    return false;
});

$('.deletePerson').on("click",function(){
    $("#personName").text($(this).data('content'));
    $("#btn-continue").attr('data-href', $(this).data('href'));
    $("#continue-modal").modal("toggle");
    return false;
});

$('.deleteAccess').on("click",function(){
    $("#accessName").text($(this).data('content'));
    $("#btn-continue").attr('data-href', $(this).data('href'));
    $("#continue-modal").modal("toggle");
    return false;
});

$('.deleteKey').on("click",function(){
    $("#keyName").text($(this).data('content'));
    $("#btn-continue").attr('data-href', $(this).data('href'));
    $("#continue-modal").modal("toggle");
    return false;
});

$('.deleteSecondFactor').on("click",function(){
    $("#secondFactorName").text($(this).data('content'));
    $("#btn-continue").attr('data-href', $(this).data('href'));
    $("#continue-modal").modal("toggle");
    return false;
});


$('.deleteProfile').on("click",function(){
    $("#profileName").text($(this).data('content'));
    $("#btn-continue").attr('data-href', $(this).data('href'));
    $("#continue-modal").modal("toggle");
    return false;
});