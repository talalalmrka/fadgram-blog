<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        #viewer-container {
            height: 100vh;
        }

        #main-content {
            overflow-y: auto;
            position: relative;
            margin-top: 40px;
            height: calc(100vh - 40px);
        }

        .pdf-page {
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: white;
        }

        #controls {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #fff;
            padding: 5px 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 1000;
        }

        .control-btn {
            padding: 6px;
            background: none;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            display: flex;
            align-items: center;
        }

        .control-btn:hover {
            background: #f0f0f0;
        }

        .control-btn svg {
            width: 20px;
            height: 20px;
            fill: #2196F3;
        }

        #page-indicator {
            padding: 0 12px;
            font-size: 14px;
            min-width: 100px;
        }

        #zoom-slider {
            width: 100px;
            margin: 0 10px;
        }

        .loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div id="controls">
        <button class="control-btn" onclick="previousPage()">
            <svg viewBox="0 0 24 24">
                <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z" />
            </svg>
        </button>
        <span id="page-indicator">Page 1/1</span>
        <button class="control-btn" onclick="nextPage()">
            <svg viewBox="0 0 24 24">
                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" />
            </svg>
        </button>

        <div style="flex-grow: 1;"></div>

        <button class="control-btn" onclick="zoomOut()">
            <svg viewBox="0 0 24 24">
                <path d="M19 13H5v-2h14v2z" />
            </svg>
        </button>
        <input type="range" id="zoom-slider" min="50" max="200" value="100">
        <button class="control-btn" onclick="zoomIn()">
            <svg viewBox="0 0 24 24">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
            </svg>
        </button>
        <button class="control-btn" onclick="fitToPage()">
            <svg viewBox="0 0 24 24">
                <path d="M6 16h12V8H6v8zm2-6h8v4H8v-4zM4 4h16v2H4zm0 14h16v2H4z" />
            </svg>
        </button>
    </div>

    <div class="loader" id="loader"></div>

    <div id="viewer-container">
        <div id="main-content"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.min.js"></script>

    <script>
        let pdfDoc = null;
        let currentPage = 1;
        let scale = 1;
        let originalPageWidth = null;
        let observer = null;
        const canvasCache = new Map();
        let isZooming = false;

        // PDF Initialization
        pdfjsLib.getDocument('{{ $url }}').promise.then(pdf => {
            pdfDoc = pdf;
            document.getElementById('loader').style.display = 'none';
            initializeFirstPage();
            initializeSolidPages(); // Changed from virtual pages
            setupEventListeners();
        });

        async function initializeFirstPage() {
            const firstPage = await pdfDoc.getPage(1);
            const viewport = firstPage.getViewport({
                scale: 1
            });
            originalPageWidth = viewport.width;
            await fitToPage(); // Ensure initial scale is set
        }

        function initializeSolidPages() {
            const container = document.getElementById('main-content');
            container.innerHTML = '';

            // Create actual page containers with proper initial dimensions
            for (let i = 1; i <= pdfDoc.numPages; i++) {
                const div = document.createElement('div');
                div.className = 'pdf-page';
                div.dataset.page = i;
                div.style.margin = '20px auto';
                container.appendChild(div);
            }

            // Immediately render first 2 pages
            renderPage(1);
            renderPage(2);
            setupIntersectionObserver();
        }

        function setupIntersectionObserver() {
            if (observer) observer.disconnect();

            observer = new IntersectionObserver(handleIntersection, {
                root: document.getElementById('main-content'),
                rootMargin: '200px 0px',
                threshold: 0.1
            });

            document.querySelectorAll('.pdf-page').forEach(page => {
                observer.observe(page);
            });
        }

        async function handleIntersection(entries) {
            for (const entry of entries) {
                if (entry.isIntersecting) {
                    const pageNumber = parseInt(entry.target.dataset.page);
                    await renderPage(pageNumber);
                }
            }
        }

        async function renderPage(pageNumber) {
            if (canvasCache.has(pageNumber)) return;

            const page = await pdfDoc.getPage(pageNumber);
            const viewport = page.getViewport({
                scale
            });
            const container = document.querySelector(`[data-page="${pageNumber}"]`);

            // Set container dimensions before rendering
            container.style.width = `${viewport.width}px`;
            container.style.height = `${viewport.height}px`;

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            try {
                await page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise;

                container.innerHTML = '';
                container.appendChild(canvas);
                canvasCache.set(pageNumber, canvas);
            } catch (error) {
                console.error(`Error rendering page ${pageNumber}:`, error);
                container.innerHTML = `Loading page ${pageNumber}...`;
            }
        }
        async function applyZoom() {
            if (isZooming) return;
            isZooming = true;

            const container = document.getElementById('main-content');
            const scrollTop = container.scrollTop;

            // Clear existing canvas and re-render at new scale
            const pages = document.querySelectorAll('.pdf-page');
            pages.forEach(page => {
                const pageNumber = parseInt(page.dataset.page);
                if (canvasCache.has(pageNumber)) {
                    canvasCache.delete(pageNumber); // Clear previous rendering
                    page.innerHTML = ''; // Remove old canvas
                }
                renderPage(pageNumber); // Re-render at new scale
            });

            requestAnimationFrame(() => {
                container.scrollTop = scrollTop; // Maintain scroll position
                isZooming = false;
            });

            updateZoomUI();
        }


        async function applyZoomm() {
            if (isZooming) return;
            isZooming = true;

            const container = document.getElementById('main-content');
            const scrollTop = container.scrollTop;

            // Update existing pages
            const pages = Array.from(document.querySelectorAll('.pdf-page'));
            for (const page of pages) {
                const pageNumber = parseInt(page.dataset.page);
                if (canvasCache.has(pageNumber)) {
                    await renderPage(pageNumber);
                }
            }

            // Restore scroll position
            requestAnimationFrame(() => {
                container.scrollTop = scrollTop;
                isZooming = false;
            });

            updateZoomUI();
        }

        async function zoomIn() {
            scale = Math.min(2, scale * 1.1);
            await applyZoom();
        }

        async function zoomOut() {
            scale = Math.max(0.5, scale * 0.9);
            await applyZoom();
        }

        async function fitToPage() {
            if (!originalPageWidth) return;
            const containerWidth = document.getElementById('main-content').clientWidth;
            scale = containerWidth / originalPageWidth;
            await applyZoom();
        }

        function updateZoomUI() {
            document.getElementById('zoom-slider').value = Math.round(scale * 100);
        }

        // Navigation
        function goToPage(pageNum) {
            currentPage = Math.max(1, Math.min(pageNum, pdfDoc.numPages));
            const pageElement = document.getElementById(`page-${currentPage}`);
            if (pageElement) {
                pageElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
            updatePageIndicator();
        }

        function nextPage() {
            goToPage(currentPage + 1);
        }

        function previousPage() {
            goToPage(currentPage - 1);
        }

        // Scroll Handling
        let scrollTimeout;

        function handleScroll() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(updateCurrentPage, 100);
        }

        function updateCurrentPage() {
            const pages = Array.from(document.querySelectorAll('.pdf-page'));
            const container = document.getElementById('main-content');

            const visiblePage = pages.find(page => {
                const rect = page.getBoundingClientRect();
                return rect.top <= container.clientHeight / 2 &&
                    rect.bottom >= container.clientHeight / 2;
            });

            if (visiblePage) {
                currentPage = parseInt(visiblePage.dataset.page);
                updatePageIndicator();
            }
        }

        function updatePageIndicator() {
            if (pdfDoc) {
                document.getElementById('page-indicator').textContent =
                    `Page ${currentPage}/${pdfDoc.numPages}`;
            }
        }

        // Event Listeners
        function setupEventListeners() {
            document.getElementById('zoom-slider').addEventListener('input', async (e) => {
                scale = e.target.value / 100;
                await applyZoom();
            });

            document.getElementById('main-content').addEventListener('scroll', handleScroll);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') previousPage();
                if (e.key === 'ArrowRight') nextPage();
            });
        }
    </script>
</body>

</html>
