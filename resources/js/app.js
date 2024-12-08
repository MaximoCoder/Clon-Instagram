// Importamos Dropzone
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        if(document.querySelector('[name="imagen"]').value.trim() !== '') {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            // obtener el nombre del archivo
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;
            // asignar el objeto file a la propiedad file
            this.options.addedfile.call(this, imagenPublicada);
            // asignar el objeto file a la propiedad thumbnail
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
            // mostrar el preview
            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});


dropzone.on('success', function(file, response){
    console.log(response.imagen);
    // Asignar el nombre de la imagen al input de tipo hidden
    document.querySelector('input[name="imagen"]').value = response.imagen;
});

// Eliminar la imagen
dropzone.on('removedfile', function() {
    // Eliminar el valor del input
    document.querySelector('input[name="imagen"]').value = '';
});