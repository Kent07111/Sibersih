import * as pdfjsLib from "pdfjs-dist";
import pdfWorkerUrl from "pdfjs-dist/build/pdf.worker.min.mjs?url";

pdfjsLib.GlobalWorkerOptions.workerSrc = pdfWorkerUrl;

console.log("PDF.js API:", pdfjsLib.version);
console.log("PDF.js Worker:", pdfWorkerUrl);
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

    if (
        !pdfUrl ||
        !canvas ||
        !context ||
        !previousButton ||
        !nextButton ||
        !zoomInButton ||
        !zoomOutButton ||
        !currentPageElement ||
        !totalPageElement ||
        !loadingElement ||
        !errorElement
    ) {
        console.error("Elemen PDF Viewer tidak lengkap.");
        return;
    }

    console.log("PDF.js version:", pdfjsLib.version);
    console.log("PDF worker URL:", pdfWorkerUrl);
    console.log("PDF URL:", pdfUrl);

    let pdfDocument = null;
    let currentPage = 1;
    let zoomScale = 1;
    let renderTask = null;
    let resizeTimer = null;

    async function renderPage(pageNumber) {
        if (!pdfDocument) {
            return;
        }

        try {
            loadingElement.textContent = `Menampilkan halaman ${pageNumber}...`;

            loadingElement.classList.remove("hidden");
            errorElement.classList.add("hidden");

            if (renderTask) {
                renderTask.cancel();
                renderTask = null;
            }

            const page = await pdfDocument.getPage(pageNumber);

            const baseViewport = page.getViewport({
                scale: 1,
            });

            const canvasContainer = canvas.parentElement;

            const availableWidth = Math.max(
                canvasContainer.clientWidth - 32,
                280,
            );

            const fitScale = availableWidth / baseViewport.width;

            const finalScale = fitScale * zoomScale;

            const viewport = page.getViewport({
                scale: finalScale,
            });

            const pixelRatio = window.devicePixelRatio || 1;

            canvas.width = Math.floor(viewport.width * pixelRatio);

            canvas.height = Math.floor(viewport.height * pixelRatio);

            canvas.style.width = `${Math.floor(viewport.width)}px`;

            canvas.style.height = `${Math.floor(viewport.height)}px`;

            const renderContext = {
                canvasContext: context,
                viewport,
                transform:
                    pixelRatio !== 1
                        ? [pixelRatio, 0, 0, pixelRatio, 0, 0]
                        : null,
            };

            renderTask = page.render(renderContext);

            await renderTask.promise;

            renderTask = null;

            currentPageElement.textContent = pageNumber;

            previousButton.disabled = pageNumber <= 1;

            nextButton.disabled = pageNumber >= pdfDocument.numPages;
        } catch (error) {
            if (error?.name === "RenderingCancelledException") {
                return;
            }

            console.error("Gagal merender halaman PDF:", error);

            errorElement.textContent = `Gagal menampilkan halaman PDF: ${error.message}`;

            errorElement.classList.remove("hidden");
        } finally {
            loadingElement.classList.add("hidden");
            loadingElement.textContent = "Memuat materi PDF...";
        }
    }

    async function loadPdf() {
        try {
            loadingElement.textContent = "Mengambil file PDF...";

            loadingElement.classList.remove("hidden");
            errorElement.classList.add("hidden");

            const response = await fetch(pdfUrl, {
                method: "GET",
                headers: {
                    Accept: "application/pdf",
                },
                cache: "no-store",
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

            loadingElement.textContent = "Memproses file PDF...";

            const loadingTask = pdfjsLib.getDocument({
                data: new Uint8Array(arrayBuffer),
            });

            loadingTask.onProgress = ({ loaded, total }) => {
                if (total > 0) {
                    const percentage = Math.round((loaded / total) * 100);

                    loadingElement.textContent = `Memuat PDF ${percentage}%...`;
                }
            };

            pdfDocument = await loadingTask.promise;

            console.log(
                "PDF berhasil dimuat:",
                pdfDocument.numPages,
                "halaman",
            );

            totalPageElement.textContent = pdfDocument.numPages;

            currentPage = 1;

            await renderPage(currentPage);
        } catch (error) {
            console.error("Gagal memuat PDF:", error);

            errorElement.textContent = `PDF gagal dimuat: ${error.message}`;

            errorElement.classList.remove("hidden");
        } finally {
            loadingElement.classList.add("hidden");
            loadingElement.textContent = "Memuat materi PDF...";
        }
    }

    previousButton.addEventListener("click", async () => {
        if (currentPage <= 1) {
            return;
        }

        currentPage--;

        await renderPage(currentPage);
    });

    nextButton.addEventListener("click", async () => {
        if (!pdfDocument || currentPage >= pdfDocument.numPages) {
            return;
        }

        currentPage++;

        await renderPage(currentPage);
    });

    zoomInButton.addEventListener("click", async () => {
        if (zoomScale >= 2.5) {
            return;
        }

        zoomScale += 0.2;

        await renderPage(currentPage);
    });

    zoomOutButton.addEventListener("click", async () => {
        if (zoomScale <= 0.6) {
            return;
        }

        zoomScale -= 0.2;

        await renderPage(currentPage);
    });

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
