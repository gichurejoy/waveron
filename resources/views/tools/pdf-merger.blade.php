@extends('layouts.app')

@section('title', 'Free Client-Side PDF Merger | Waveron Technologies')
@section('meta_description', 'Merge multiple PDF files into a single document securely inside your browser. No files are uploaded to any server, keeping your confidential data private.')

@section('content')
<div class="container-fluid py-4" style="background-color: #fafafa;">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools.index') }}" class="text-muted text-decoration-none">Tools</a></li>
                <li class="breadcrumb-item active text-success fw-bold" aria-current="page">PDF Merger</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Left Column: PDF File Drag & Drop Queue -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h3 class="fw-bold mb-3 text-primary d-flex align-items-center">
                        <i class="bi bi-files me-2"></i> PDF Document Merger
                    </h3>
                    <p class="text-muted small mb-4">
                        <i class="bi bi-shield-lock-fill text-success"></i> <strong>100% Private & Secure:</strong> All merging is performed locally inside your web browser. Your sensitive files never touch our servers or the cloud.
                    </p>

                    <!-- Drag & Drop Upload Zone -->
                    <div id="drop-zone" class="border border-2 border-dashed rounded-4 p-5 text-center bg-light cursor-pointer mb-4" style="border-color: #cbd5e1 !important; transition: all 0.2s ease;">
                        <i class="bi bi-file-earmark-pdf-fill text-danger display-3 mb-3"></i>
                        <h5 class="fw-bold text-dark mb-1">Drag and Drop PDF files here</h5>
                        <p class="text-muted small mb-3">Or click to select files from your computer</p>
                        <input type="file" id="pdf-input" class="d-none" accept="application/pdf" multiple>
                        <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-4" onclick="document.getElementById('pdf-input').click()">
                            Select PDF Files
                        </button>
                    </div>

                    <!-- Selected Files Queue -->
                    <div id="queue-container" class="d-none">
                        <h6 class="fw-bold text-dark mb-3 font-monospace text-uppercase small">Merge Queue (<span id="queue-count">0</span> files)</h6>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr class="text-muted small" style="font-size:0.75rem;">
                                        <th style="width: 5%">Order</th>
                                        <th>File Name</th>
                                        <th style="width: 15%">File Size</th>
                                        <th style="width: 25%" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="queue-list">
                                    <!-- Dynamic rows will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Column: Output controls & Merge action -->
            <div class="col-lg-5">
                <div class="preview-sticky">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="text-muted small font-monospace mb-4"><i class="bi bi-sliders"></i> MERGER SETTINGS</h5>

                        <!-- Output File Name -->
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Merged PDF File Name</label>
                            <div class="input-group">
                                <input type="text" id="output-filename" class="form-control" value="merged-document" placeholder="merged-document">
                                <span class="input-group-text bg-light text-muted font-monospace">.pdf</span>
                            </div>
                        </div>

                        <!-- Processing State / Progress -->
                        <div id="processing-state" class="d-none mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="small fw-semibold text-primary" id="progress-text">Merging documents...</span>
                                <span class="small font-monospace text-muted" id="progress-percent">0%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <button id="merge-btn" class="btn btn-danger w-100 rounded-pill py-2.5 fw-semibold shadow-sm mb-3" disabled>
                            <i class="bi bi-plus-circle me-1"></i> Merge Documents
                        </button>
                        
                        <div class="text-center text-muted small" style="font-size: 0.75rem;">
                            Supports multiple, password-free PDF document files.
                        </div>
                    </div>

                    <!-- Contextual CTA -->
                    <div class="card border-0 rounded-4 p-4 text-center" style="background-color: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.12) !important;">
                        <h5 class="fw-bold mb-2 text-danger">Custom Document Pipeline?</h5>
                        <p class="small mb-3 text-muted">Need custom automated document compilation, automated invoice PDF parsing, or report extraction script workflows for your business?</p>
                        <div>
                            <a href="{{ route('contact') }}" class="btn btn-danger rounded-pill px-4 py-2 fw-semibold btn-sm shadow-sm">
                                Talk to Document Engineers <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .preview-sticky {
        position: sticky;
        top: 96px;
    }
    
    .cursor-pointer {
        cursor: pointer;
    }

    #drop-zone.dragover {
        background-color: rgba(220, 38, 38, 0.05) !important;
        border-color: #ef4444 !important;
    }
</style>
@endpush

@push('scripts')
<!-- Load pdf-lib CDN client-side -->
<script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropZone = document.getElementById('drop-zone');
    const pdfInput = document.getElementById('pdf-input');
    const queueList = document.getElementById('queue-list');
    const queueContainer = document.getElementById('queue-container');
    const queueCountText = document.getElementById('queue-count');
    const mergeBtn = document.getElementById('merge-btn');
    const outputFilenameInput = document.getElementById('output-filename');
    
    const processingState = document.getElementById('processing-state');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');
    const progressPercent = document.getElementById('progress-percent');

    // Store array of file objects: { name, size, fileRef }
    let pdfQueue = [];

    // Drag events
    dropZone.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', function () {
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    dropZone.addEventListener('click', function () {
        pdfInput.click();
    });

    pdfInput.addEventListener('change', function () {
        handleFiles(pdfInput.files);
        pdfInput.value = ''; // clear input
    });

    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (file.type === 'application/pdf') {
                pdfQueue.push({
                    name: file.name,
                    size: file.size,
                    fileRef: file
                });
            }
        });
        renderQueue();
    }

    // Helper: format size in bytes
    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const dm = 2;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    function renderQueue() {
        queueList.innerHTML = '';
        if (pdfQueue.length === 0) {
            queueContainer.classList.add('d-none');
            mergeBtn.disabled = true;
            return;
        }

        queueContainer.classList.remove('d-none');
        mergeBtn.disabled = pdfQueue.length < 2; // Need at least 2 files to merge
        queueCountText.innerText = pdfQueue.length;

        pdfQueue.forEach((file, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <span class="badge bg-secondary rounded-pill font-monospace">${index + 1}</span>
                </td>
                <td class="text-truncate" style="max-width: 250px;">
                    <span class="fw-semibold text-dark small">${file.name}</span>
                </td>
                <td>
                    <span class="text-muted small font-monospace">${formatBytes(file.size)}</span>
                </td>
                <td class="text-end">
                    <button class="btn btn-light btn-sm rounded-circle me-1 move-up-btn" data-index="${index}" ${index === 0 ? 'disabled' : ''}>
                        <i class="bi bi-arrow-up"></i>
                    </button>
                    <button class="btn btn-light btn-sm rounded-circle me-2 move-down-btn" data-index="${index}" ${index === pdfQueue.length - 1 ? 'disabled' : ''}>
                        <i class="bi bi-arrow-down"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm rounded-circle delete-btn" data-index="${index}">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            queueList.appendChild(tr);
        });

        // Add listeners to actions
        document.querySelectorAll('.move-up-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const idx = parseInt(this.getAttribute('data-index'));
                swapElements(idx, idx - 1);
            });
        });

        document.querySelectorAll('.move-down-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const idx = parseInt(this.getAttribute('data-index'));
                swapElements(idx, idx + 1);
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const idx = parseInt(this.getAttribute('data-index'));
                pdfQueue.splice(idx, 1);
                renderQueue();
            });
        });
    }

    function swapElements(i, j) {
        const temp = pdfQueue[i];
        pdfQueue[i] = pdfQueue[j];
        pdfQueue[j] = temp;
        renderQueue();
    }

    // Merge engine
    mergeBtn.addEventListener('click', async function () {
        if (pdfQueue.length < 2) return;

        mergeBtn.disabled = true;
        processingState.classList.remove('d-none');
        progressBar.style.width = '10%';
        progressPercent.innerText = '10%';
        progressText.innerText = 'Initializing compilation...';

        try {
            // Load pdf-lib library
            const { PDFDocument } = PDFLib;
            const mergedPdf = await PDFDocument.create();
            
            for (let i = 0; i < pdfQueue.length; i++) {
                const fileObj = pdfQueue[i];
                progressText.innerText = `Reading file ${i + 1} of ${pdfQueue.length}...`;
                
                // Read file to ArrayBuffer
                const fileBuffer = await fileObj.fileRef.arrayBuffer();
                
                progressText.innerText = `Loading document: ${fileObj.name}...`;
                const srcPdf = await PDFDocument.load(fileBuffer);
                
                progressText.innerText = `Copying pages from: ${fileObj.name}...`;
                const copiedPages = await mergedPdf.copyPages(srcPdf, srcPdf.getPageIndices());
                
                copiedPages.forEach((page) => {
                    mergedPdf.addPage(page);
                });

                // Update progress percentage
                const progressPct = Math.round(10 + (80 * (i + 1) / pdfQueue.length));
                progressBar.style.width = progressPct + '%';
                progressPercent.innerText = progressPct + '%';
            }

            progressText.innerText = 'Packing and saving merged document...';
            progressBar.style.width = '95%';
            progressPercent.innerText = '95%';

            // Serialize document bytes
            const mergedPdfBytes = await mergedPdf.save();

            // Create download trigger
            const blob = new Blob([mergedPdfBytes], { type: 'application/pdf' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            
            let filename = outputFilenameInput.value.trim();
            if (!filename) filename = 'merged-document';
            a.download = filename.endsWith('.pdf') ? filename : filename + '.pdf';
            
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            
            // Done
            progressBar.style.width = '100%';
            progressPercent.innerText = '100%';
            progressText.innerText = 'Documents merged successfully! Download started.';
            if (window.showToast) {
                window.showToast('Documents merged successfully! Download started.', 'success');
            }
            
            setTimeout(() => {
                processingState.classList.add('d-none');
                mergeBtn.disabled = false;
            }, 3000);

        } catch (err) {
            console.error(err);
            if (window.showToast) {
                window.showToast('Error merging files: ' + err.message + '. Please ensure none of the PDFs are password-protected.', 'error');
            } else {
                alert('Error merging files: ' + err.message + '. Please ensure none of the PDFs are password-protected.');
            }
            processingState.classList.add('d-none');
            mergeBtn.disabled = false;
        }
    });
});
</script>
@endpush
