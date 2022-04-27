class Orden {
    mostrarModalOrdenPendiente(id_modal) {
        var myModal = new bootstrap.Modal(document.getElementById(id_modal))
        myModal.show()
    }
}

export default Orden;