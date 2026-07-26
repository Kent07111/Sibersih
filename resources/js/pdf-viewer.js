import * as pdfjsLib from "pdfjs-dist";
import pdfWorkerUrl from "pdfjs-dist/build/pdf.worker.min.mjs?url";

pdfjsLib.GlobalWorkerOptions.workerSrc = pdfWorkerUrl;

document.addEventListener("DOMContentLoaded", () => {
    const viewer = document.getElementById("pdf-viewer");

    if (!viewer) {
        return;
    }

    const pdfUrl = viewer.dataset.pdfUrl;

    const canvas = document.getElementById("pdf-canvas");
    const context = canvas.getContext("2d");

    const previousButton = document.getElementById("pdf-prev");
    const nextButton = document.getElementById("pdf-next");
    const zoomInButton = document.getElementById("pdf-zoom-in");
    const zoomOutButton = document.getElementById("pdf-zoom-out");

    const currentPageElement = document.getElementById("pdf-current-page");

    const totalPageElement = document.getElementById("pdf-total-page");

    const loadingElement = document.getElementById("pdf-loading");

    const errorElement = document.getElementById("pdf-error");

    let pdfDocument = null;
    let currentPage = 1;
    let scale = 1.3;
    let renderTask = null;

    async function renderPage(pageNumber) {
        if (!pdfDocument) {
            return;
        }

        try {
            loadingElement.classList.remove("hidden");
            errorElement.classList.add("hidden");

            // Batalkan render sebelumnya jika masih berjalan
            if (renderTask) {
                renderTask.cancel();
                renderTask = null;
            }

            const page = await pdfDocument.getPage(pageNumber);

            const originalViewport = page.getViewport({
                scale,
            });

            const container = canvas.parentElement;

            const availableWidth = container.clientWidth - 32;

            let finalScale = scale;

            if (originalViewport.width > availableWidth) {
                finalScale = scale * (availableWidth / originalViewport.width);
            }

            const viewport = page.getViewport({
                scale: finalScale,
            });

            const pixelRatio = window.devicePixelRatio || 1;

            canvas.width = Math.floor(viewport.width * pixelRatio);

            canvas.height = Math.floor(viewport.height * pixelRatio);

            canvas.style.width = `${Math.floor(viewport.width)}px`;

            canvas.style.height = `${Math.floor(viewport.height)}px`;

            context.setTransform(pixelRatio, 0, 0, pixelRatio, 0, 0);

            renderTask = page.render({
                canvasContext: context,
                viewport,
            });

            await renderTask.promise;

            renderTask = null;

            currentPageElement.textContent = currentPage;

            previousButton.disabled = currentPage <= 1;

            nextButton.disabled = currentPage >= pdfDocument.numPages;
        } catch (error) {
            /*
             * RenderingCancelledException bukan error utama.
             * Ini terjadi saat render lama dibatalkan.
             */
            if (error?.name === "RenderingCancelledException") {
                return;
            }

            console.error("Gagal merender PDF:", error);

            errorElement.textContent = `Gagal menampilkan halaman PDF: ${error.message}`;

            errorElement.classList.remove("hidden");
        } finally {
            loadingElement.classList.add("hidden");
        }
    }

    async function loadPdf() {
        try {
            loadingElement.classList.remove("hidden");
            errorElement.classList.add("hidden");

            console.log("URL PDF:", pdfUrl);
            console.log("Worker PDF:", pdfjsLib.GlobalWorkerOptions.workerSrc);

            const response = await fetch(pdfUrl, {
                method: "GET",
                headers: {
                    Accept: "application/pdf",
                },
            });

            console.log("Status PDF:", response.status);
            console.log("Content-Type:", response.headers.get("content-type"));

            if (!response.ok) {
                throw new Error(
                    `File PDF gagal diambil. HTTP ${response.status}`,
                );
            }

            const contentType = response.headers.get("content-type") || "";

            if (
                !contentType.includes("application/pdf") &&
                !contentType.includes("application/octet-stream")
            ) {
                throw new Error(
                    `Respons bukan PDF. Content-Type: ${contentType}`,
                );
            }

            const arrayBuffer = await response.arrayBuffer();

            if (arrayBuffer.byteLength === 0) {
                throw new Error("File PDF kosong.");
            }

            const pdfData = new Uint8Array(arrayBuffer);

            const loadingTask = pdfjsLib.getDocument({
                data: pdfData,
            });

            pdfDocument = await loadingTask.promise;

            totalPageElement.textContent = pdfDocument.numPages;

            currentPage = 1;

            await renderPage(currentPage);
        } catch (error) {
            console.error("Gagal memuat PDF:", error);

            errorElement.textContent = `PDF gagal dimuat: ${error.message}`;

            errorElement.classList.remove("hidden");
        } finally {
            loadingElement.classList.add("hidden");
        }
    }

    previousButton.addEventListener("click", () => {
        if (currentPage <= 1) {
            return;
        }

        currentPage--;

        renderPage(currentPage);
    });

    nextButton.addEventListener("click", () => {
        if (!pdfDocument || currentPage >= pdfDocument.numPages) {
            return;
        }

        currentPage++;

        renderPage(currentPage);
    });

    zoomInButton.addEventListener("click", () => {
        if (scale >= 3) {
            return;
        }

        scale += 0.2;

        renderPage(currentPage);
    });

    zoomOutButton.addEventListener("click", () => {
        if (scale <= 0.6) {
            return;
        }

        scale -= 0.2;

        renderPage(currentPage);
    });

    let resizeTimer;

    window.addEventListener("resize", () => {
        clearTimeout(resizeTimer);

        resizeTimer = setTimeout(() => {
            if (pdfDocument) {
                renderPage(currentPage);
            }
        }, 300);
    });

    loadPdf();
});
