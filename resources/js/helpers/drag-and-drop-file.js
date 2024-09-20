export const dragAndDropFile = () => {
    
    $('.before-upload').off('click');
    $('.before-upload').on('click', function () {

        $('#upload-image').click();
    });

    $('#upload-image').on('change', function () {
        const file = $(this)[0].files[0];

        console.log(file);

        let size = file.size / 1024 / 1024;

        updateFileIU(file.name, size.toFixed(3));

    });

    $('.before-upload').on('dragover', function (e) {
        e.preventDefault();
        $(this).addClass('dragging');
    })

    $('.before-upload').on('dragleave', function (e) {
        e.preventDefault();
        $(this).removeClass('dragging');
    })

    $('.before-upload').on('drop', function (e) {
        e.preventDefault();
        $(this).removeClass('dragging');

        const file = e.originalEvent.dataTransfer.files[0];

        let size = file.size / 1024 / 1024;
        console.log(file);

        updateFileIU(file.name, size.toFixed(3));
    })



}

const updateFileIU = (name, size) => {

    $('#fileName').text(name);
    $('#fileSize').text(size + ' MB');
    $('#containerFiles').removeClass('d-none');

}
