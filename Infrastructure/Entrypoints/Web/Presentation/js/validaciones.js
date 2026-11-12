/**
 * Solicita confirmación antes de enviar un formulario de eliminación.
 *
 * El formulario debe incluir el atributo `data-name` con el nombre del
 * elemento a eliminar y, opcionalmente, `data-entity` con el tipo de
 * elemento (por defecto "usuario"), por ejemplo:
 *   <form ... onsubmit="return confirmDelete(this);" data-entity="estudiante" data-name="Juan">
 *
 * @param {HTMLFormElement} form
 * @returns {boolean}
 */
function confirmDelete(form) {

    var name = form.getAttribute('data-name');
    var entity = form.getAttribute('data-entity') || 'usuario';
    return confirm('¿Eliminar al ' + entity + ' ' + name + '?');
}