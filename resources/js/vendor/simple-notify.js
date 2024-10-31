import Notify from "simple-notify";
import "simple-notify/dist/simple-notify.css";

window.addEventListener("load", () => {
    const flashMsg = document.getElementById("flashMessage");
    if (flashMsg) {
        new Notify({
            status: flashMsg.getAttribute("data-variants"),
            text: flashMsg.value,
            position: "top x-center",
            effect: "slide",
            speed: 500,
            autotimeout: 5000,
        });
    }
});
