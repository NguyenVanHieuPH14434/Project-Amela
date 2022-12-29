// checked checkbox childrent of checkbox parent
$(document).on('click', '.checkbox_parent', function() {
    $(this).parents('.Card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
});

// checked all checkbox
$(document).on('click', '.checkall', function() {
    $(this).parents().find('.checkbox_parent').prop('checked', $(this).prop('checked'));
    $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
});

// preview image
function preview() {
    previewImage.src = URL.createObjectURL(event.target.files[0]);
}