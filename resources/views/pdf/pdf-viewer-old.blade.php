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
            overflow-y: auto;
        }

        #main-content {
            position: relative;
            margin-top: 40px;
            padding-bottom: 20px;
        }

        .pdf-page {
            display: flex;
            justify-content: center;
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
    </style>
</head>

<body>
    <div id="controls">
        <button class="control-btn" onclick="previousPage()">&#9664;</button>
        <span id="page-indicator">Page 1/1</span>
        <button class="control-btn" onclick="nextPage()">&#9654;</button>
        <input type="range" id="zoom-slider" min="50" max="200" value="100">
        <button class="control-btn" onclick="fitToPage()">Fit</button>
    </div>

    <div id="viewer-container" onscroll="updateCurrentPage()">
        <div id="main-content"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.min.js"></script>
    <script>
        let pdfDoc = null;
        let currentPage = 1;
        let scale = 1;

        pdfjsLib.getDocument('{{ $url }}').promise.then(pdf => {
            pdfDoc = pdf;
            renderPages();
        });

        async function renderPages() {
            const container = document.getElementById('main-content');
            container.innerHTML = '';
            for (let i = 1; i <= pdfDoc.numPages; i++) {
                const pageDiv = document.createElement('div');
                pageDiv.className = 'pdf-page';
                pageDiv.id = `page-${i}`;
                container.appendChild(pageDiv);
                renderPage(i);
            }
        }

        async function renderPage(pageNumber) {
            const page = await pdfDoc.getPage(pageNumber);
            const viewport = page.getViewport({
                scale
            });
            const pageDiv = document.getElementById(`page-${pageNumber}`);
            pageDiv.innerHTML = '';

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = viewport.width;
            canvas.height = viewport.height;

            await page.render({
                canvasContext: context,
                viewport
            }).promise;
            pageDiv.appendChild(canvas);
        }

        async function zoom() {
            scale = document.getElementById('zoom-slider').value / 100;
            renderPages();
        }

        async function fitToPage() {
            const page = await pdfDoc.getPage(1);
            const viewport = page.getViewport({
                scale: 1
            });
            const containerWidth = document.getElementById('viewer-container').clientWidth;
            scale = containerWidth / viewport.width;
            document.getElementById('zoom-slider').value = scale * 100;
            renderPages();
        }

        function updatePageIndicator() {
            document.getElementById('page-indicator').textContent = `Page ${currentPage}/${pdfDoc.numPages}`;
        }

        function nextPage() {
            if (currentPage < pdfDoc.numPages) {
                currentPage++;
                document.getElementById(`page-${currentPage}`).scrollIntoView({
                    behavior: 'smooth'
                });
                updatePageIndicator();
            }
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                document.getElementById(`page-${currentPage}`).scrollIntoView({
                    behavior: 'smooth'
                });
                updatePageIndicator();
            }
        }

        function updateCurrentPage() {
            const pages = document.querySelectorAll('.pdf-page');
            let closestPage = 1;
            let minDistance = Infinity;
            pages.forEach((page, index) => {
                const rect = page.getBoundingClientRect();
                const distance = Math.abs(rect.top);
                if (distance < minDistance) {
                    minDistance = distance;
                    closestPage = index + 1;
                }
            });
            currentPage = closestPage;
            updatePageIndicator();
        }

        document.getElementById('zoom-slider').addEventListener('input', zoom);
    </script>
</body>

</html>
