// Mostrar/ocultar contraseña
document.addEventListener("DOMContentLoaded", function () {
    // Funcionalidad para el botón de ver contraseña
    const togglePassword = document.querySelector("#togglePassword");
    if (togglePassword) {
        togglePassword.addEventListener("click", function () {
            const password = document.querySelector("#password");
            const type =
                password.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            password.setAttribute("type", type);
            this.classList.toggle("fa-eye-slash");
        });
    }

    // Inicializar tooltips de Bootstrap
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
