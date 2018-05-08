var profilesRows = $('#bodyTableProfiles tr').size();
var factorsRows = $('#bodyTableFactors tr').size();
var keysRows = $('#bodyTableKeys tr').size();

$(document).on('click', '#removeRowProfiles', function() {
    var number = $(this).closest('tr').attr('id').match(/\d+/)[0];
    $("#iProfile"+number).remove();
    if (profilesRows > 0) {
        $(this).closest('tr').remove();
        profilesRows--;
        if(profilesRows == 0){
            $('#tableProfilesEmpty').css('display', 'block');
            $("#tableProfiles").css('display', 'none');
        }
    }
    return false;
});

$(document).on('click', '#removeRowFactors', function() {
    var number = $(this).closest('tr').attr('id').match(/\d+/)[0];
    $("#iFact"+number).remove();
    if (factorsRows > 0) {
        $(this).closest('tr').remove();
        factorsRows--;
        if(factorsRows == 0){
            $('#tableFactorsEmpty').css('display', 'block');
            $("#tableFactors").css('display', 'none');
        }
    }
    return false;
});

$(document).on('click', '#removeRowKeys', function() {
    var number = $(this).closest('tr').attr('id').match(/\d+/)[0];
    $("#iKey"+number).remove();
    if (keysRows > 0) {
        $(this).closest('tr').remove();
        keysRows--;
        if (keysRows == 0) {
            $('#tableKeysEmpty').css('display', 'block');
            $("#tableKeys").css('display', 'none');
        }
    }
    return false;
});
