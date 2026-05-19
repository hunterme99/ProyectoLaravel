document.addEventListener("DOMContentLoaded", () => {

    // Crear modal
    const modal = document.createElement("div");
    modal.id = "modal-confirmacion";
    modal.innerHTML = `
        <div class="modal-contenido">
            <p id="modal-mensaje"></p>
            <div class="modal-botones">
                <button id="modal-si">Sí</button>
                <button id="modal-no">No</button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);

    let formularioPendiente = null;

    // Activar modal en formularios con data-confirmar
    document.querySelectorAll("form[data-confirmar]").forEach(form => {
        form.addEventListener("submit", e => {
            e.preventDefault();
            formularioPendiente = form;

            document.getElementById("modal-mensaje").textContent =
                form.getAttribute("data-confirmar");

            modal.classList.add("visible");
        });
    });

    // Botón Sí
    document.getElementById("modal-si").addEventListener("click", () => {
        modal.classList.remove("visible");
        if (formularioPendiente) formularioPendiente.submit();
    });

    // Botón No
    document.getElementById("modal-no").addEventListener("click", () => {
        modal.classList.remove("visible");
        formularioPendiente = null;
    });

    document.addEventListener("DOMContentLoaded", () => {

        // Leer el rol desde un meta tag
        const rol = document.querySelector('meta[name="rol-usuario"]').content;

        if (rol !== "admin") {
            document.querySelectorAll('[data-admin="true"]').forEach(el => {
                el.style.display = "none";
            });
        }

    });

});
