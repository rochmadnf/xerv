const previewBtns = document.querySelectorAll(`[data-fn="download"]`);

previewBtns.forEach((btn) => {
    btn.addEventListener("click", async () => {
        const res = await fetch(
            `${location.protocol}//${location.host}/api/files/${btn.dataset.fileType}/${btn.dataset.id}/download`
        ).then((res) => res.json());

        if (res.status === "success") {
            const downLoad = document.createElement("a");
            downLoad.href = res.filepath;
            downLoad.download = res.filename;
            document.body.appendChild(downLoad);
            downLoad.click();
            document.body.removeChild(downLoad);
        }
    });
});
