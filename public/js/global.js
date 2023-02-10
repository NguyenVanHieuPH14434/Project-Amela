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

function handleFileSelect() {
    if (window.File && window.FileList && window.FileReader) {
        document.getElementById('result').textContent = '';
        var files = event.target.files; //FileList object
        var output = document.getElementById("result");
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;
            var picReader = new FileReader();
            picReader.addEventListener("load", function(event) {
                var picFile = event.target;
                var div = document.createElement("div");
                div.innerHTML = "<img class='thumbnail' style='width: 100px; height: 90px' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>";
                console.log(file.name + '::' + file.size);
                output.insertBefore(div, null);
            });
            picReader.readAsDataURL(file);
        }
    } else {
        console.log("Your browser does not support File");
    }
}

// select multiple
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

// tags input
$(function() {
    $('#tags-inp').tagsinput();
});
$(function() {
    $('#inputTaggs').tagsinput();
});

