console.log("ADMIN JS CARGADO");


document.addEventListener("DOMContentLoaded", () => {

    // ============================
    // MODAL DE CONFIRMACIÓN
    // ============================

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

    document.querySelectorAll("form[data-confirmar]").forEach(form => {
        form.addEventListener("submit", e => {
            e.preventDefault();
            formularioPendiente = form;

            document.getElementById("modal-mensaje").textContent =
                form.getAttribute("data-confirmar");

            modal.classList.add("visible");
        });
    });

    document.getElementById("modal-si").addEventListener("click", () => {
        modal.classList.remove("visible");
        if (formularioPendiente) formularioPendiente.submit();
    });

    document.getElementById("modal-no").addEventListener("click", () => {
        modal.classList.remove("visible");
        formularioPendiente = null;
    });


    // ============================
    // OCULTAR ELEMENTOS SEGÚN ROL
    // ============================

    const metaRol = document.querySelector('meta[name="rol-usuario"]');
    if (metaRol) {
        const rol = metaRol.content;

        if (rol !== "admin") {
            document.querySelectorAll('[data-admin="true"]').forEach(el => {
                el.style.display = "none";
            });
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const msg = document.getElementById("flash-message");

        if (msg) {
            setTimeout(() => {
                msg.style.transition = "opacity 0.8s ease";
                msg.style.opacity = "0";

                setTimeout(() => {
                    if (msg.parentNode) {
                        msg.parentNode.removeChild(msg);
                    }
                }, 800);
            }, 3000);
        }
    });



});
