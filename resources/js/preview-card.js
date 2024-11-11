const previewBtns = document.querySelectorAll(`[data-fn="preview"]`);

previewBtns.forEach((btn) => {
    btn.addEventListener("click", async () => {
        const res = await fetch(
            `${location.protocol}//${location.host}/api/files/${btn.dataset.fileType}/${btn.dataset.id}/preview`
        ).then((res) => res.json());

        if (res.status === "success") {
            openPreviewWindow(res);
        }
    });
});

const previewAttachment = document.getElementById("previewAttachment");
const attachmentObject = document.getElementById("objectPreviewAttachment");

function openPreviewWindow(file) {
    previewAttachment.classList.remove("hidden", "-z-[9999]");
    previewAttachment.classList.add("flex", "z-[9999]");
    attachmentObject.setAttribute("data", file.url_path);
    document.getElementById("objectName").innerText = file.filename;
}

function closePreviewWindow() {
    previewAttachment.classList.add("hidden", "-z-[9999]");
    previewAttachment.classList.remove("flex", "z-[9999]");
}

document
    .getElementById("closePreviewAttachment")
    .addEventListener("click", closePreviewWindow);
previewAttachment.addEventListener("click", closePreviewWindow);
