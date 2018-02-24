$(document).ready(function () {
    $('#dataTable').DataTable({
        responsive: true
    });
    $.uploadPreview({
        input_field: "#image-upload",   // Default: .image-upload
        preview_box: "#image-preview",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Choose File",   // Default: Choose File
        label_selected: "Change File",  // Default: Change File
        no_label: false                 // Default: false
    });
    $previewField = $('#image-upload');
    if ($previewField.attr('data-image')) {
        $('#image-preview').css('background', 'url(' + $previewField.attr('data-image') + ') no-repeat center center');
        $('#image-preview').css('backgroundSize', 'cover');
    }
    $(".select2").select2();
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
});
