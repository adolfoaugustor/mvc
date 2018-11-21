let Editor = {

    init: function (id) {

        ClassicEditor
            .create(document.querySelector(id), {
                language: 'pt-br',
                ckfinder: {
                    uploadUrl: '/src/js/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                }
            }).then(editor => {
            console.log(Array.from( editor.ui.componentFactory.names()));
        })
            .catch(error => {
                console.error(error);
            });

    }
};