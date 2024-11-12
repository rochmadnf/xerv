<div id="previewAttachment"
    class="bg-black/85 fixed left-0 top-0 -z-[9999] hidden h-screen w-screen flex-col gap-y-4 transition-all duration-300">
    <button id="closePreviewAttachment"
        class="mr-3 inline-flex items-center self-end rounded-full border border-white/90 font-light text-white/90 transition duration-150 hover:border-gray-300 hover:text-gray-300 md:mt-6">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg></button>
    <div class="flex h-full w-full flex-col rounded-t-3xl bg-white">
        <h1 class="px-8 py-4 text-base font-semibold tracking-wider text-black/90 md:text-xl" id="objectName">Nama
            Lampiran</h1>
        <div class="h-full w-full px-8" id="objectAttachment"></div>
        <object id="objectPreviewAttachment" class="px-8" data="#" type="application/pdf" frameborder="0"
            width="100%" height="100%">
            <a id="gdViewer" target="_blank" class="inline-flex rounded-md bg-emerald-500 px-4 py-2"
                href="#">Lihat</a>
            <a id="btnDownloadUnSupportView" class="inline-flex rounded-md bg-blue-500 px-4 py-2" href="#"><i
                    class="icon-download"></i>
                <span class="text-sm font-medium">Download File</span>
            </a>
        </object>
    </div>
</div>
