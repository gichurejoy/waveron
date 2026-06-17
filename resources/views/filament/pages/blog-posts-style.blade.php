<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    /* Global Font Override */
    body, .fi-main, .fi-main *, .fi-fo-field-label *, .fi-input-wrp *, .fi-btn * {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    }

    /* Reset main content container margins and expand to full width */
    .fi-main, 
    main.fi-main {
        padding: 2.5rem !important;
        background-color: #ffffff !important; /* pure white background matching mockup */
    }
    
    .fi-main-ctn,
    .fi-page,
    main.fi-main > div,
    form,
    form.fi-form,
    .fi-fo-component-ctn,
    .fi-fo-builder,
    .fi-fo-grid {
        max-width: 1536px !important; /* expand to prevent squeezed layouts */
        width: 100% !important;
        margin: 0 auto !important;
    }

    /* Style page header area */
    .fi-header {
        border-bottom: 1px solid #e5e7eb !important;
        padding-bottom: 1.25rem !important;
        margin-bottom: 2.5rem !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }
    
    .fi-header-heading {
        font-size: 1.75rem !important;
        font-weight: 700 !important;
        color: #111827 !important;
        margin: 0 !important;
    }

    /* Format action buttons in header */
    .fi-header button,
    .fi-header a,
    .fi-header .fi-ac-action {
        border-radius: 6px !important;
        font-weight: 600 !important;
        font-size: 0.875rem !important;
        padding: 0.5rem 1.25rem !important;
        transition: all 0.2s ease-in-out !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
    }

    /* Style the Cancel button */
    .fi-header button[wire\:click*="cancel"],
    .fi-header a[wire\:click*="cancel"],
    .fi-header [wire\:click*="cancel"] {
        background-color: #ffffff !important;
        color: #374151 !important;
        border: 1px solid #d1d5db !important;
    }
    
    .fi-header button[wire\:click*="cancel"]:hover,
    .fi-header a[wire\:click*="cancel"]:hover,
    .fi-header [wire\:click*="cancel"]:hover {
        background-color: #f9fafb !important;
        color: #111827 !important;
        border-color: #c5c9d1 !important;
    }

    /* Style the Publish/Save button */
    .fi-header button[form="form"],
    .fi-header [form="form"],
    .fi-header button[type="submit"] {
        background-color: #2563eb !important; /* Premium Blue */
        color: #ffffff !important;
        border: 1px solid #2563eb !important;
    }
    
    .fi-header button[form="form"]:hover,
    .fi-header [form="form"]:hover,
    .fi-header button[type="submit"]:hover {
        background-color: #1d4ed8 !important; /* Darker Blue */
        border-color: #1d4ed8 !important;
    }

    /* ------------------------------------------------------------- */
    /* Form Labels Redesign */
    /* ------------------------------------------------------------- */

    /* Hide the required visual asterisk mark (*) */
    .fi-fo-field-label-required-mark {
        display: none !important;
    }

    /* Style label text */
    .fi-fo-field-wrp-label,
    .fi-fo-field-wrp-label span,
    .fi-fo-field-wrp-label label {
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        color: #111827 !important;
    }

    .fi-fo-field-wrp-label span span {
        font-weight: 400 !important;
        color: #6b7280 !important;
    }

    /* ------------------------------------------------------------- */
    /* Inputs Redesign (Borders, Focus states) */
    /* ------------------------------------------------------------- */

    .fi-input-wrp {
        background-color: #ffffff !important;
        border: 1px solid #d1d5db !important;
        border-radius: 6px !important;
        box-shadow: none !important;
        transition: all 0.15s ease-in-out !important;
    }

    /* Focus Ring */
    .fi-input-wrp:focus-within {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08) !important;
        outline: none !important;
    }

    /* Inner inputs reset */
    .fi-input-wrp input,
    .fi-input-wrp textarea,
    .fi-input-wrp select,
    .fi-input-wrp button {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        background-color: transparent !important;
    }

    /* ------------------------------------------------------------- */
    /* Date Picker Icon Reordering */
    /* ------------------------------------------------------------- */

    /* Move the calendar icon to the left using flex layout */
    .fi-fo-date-time-picker .fi-input-wrp,
    .fi-fo-date-time-picker .fi-input-wrp > div,
    .fi-fo-date-time-picker .fi-input-wrp .flex,
    .fi-fo-published-at .fi-input-wrp,
    .fi-fo-published-at .fi-input-wrp > div,
    .fi-fo-published-at .fi-input-wrp .flex,
    .fi-fo-published_at .fi-input-wrp,
    .fi-fo-published_at .fi-input-wrp > div,
    .fi-fo-published_at .fi-input-wrp .flex {
        flex-direction: row-reverse !important;
    }

    /* Fix spacing for reversed date picker icon button */
    .fi-fo-date-time-picker .fi-input-wrp button,
    .fi-fo-date-time-picker .fi-input-wrp .fi-input-wrp-icon,
    .fi-fo-date-time-picker .fi-input-wrp .fi-input-wrp-icon-btn,
    .fi-fo-published-at .fi-input-wrp button,
    .fi-fo-published-at .fi-input-wrp .fi-input-wrp-icon,
    .fi-fo-published-at .fi-input-wrp .fi-input-wrp-icon-btn,
    .fi-fo-published_at .fi-input-wrp button,
    .fi-fo-published_at .fi-input-wrp .fi-input-wrp-icon,
    .fi-fo-published_at .fi-input-wrp .fi-input-wrp-icon-btn {
        order: -1 !important;
        padding-left: 0.75rem !important;
        padding-right: 0.25rem !important;
        margin-right: 0 !important;
        margin-left: 0.5rem !important;
        color: #9ca3af !important;
    }
    /* Date Picker, Category, and Author Selects Redesign */
    /* ------------------------------------------------------------- */

    /* =========================================================
       DATE PICKER (Left-aligned calendar icon override)
       ========================================================= */
    /* Filament 3 uses native input type="date" */
    .fi-fo-date-time-picker {
        position: relative;
    }
    .fi-fo-date-time-picker input[type="date"]::-webkit-calendar-picker-indicator {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        margin: 0;
        padding: 0;
        cursor: pointer;
    }
    .fi-fo-date-time-picker input[type="date"] {
        padding-left: 2.5rem !important;
    }

    /* =========================================================
       CATEGORY SELECT BADGES (Horizontal Inline Flow)
       ========================================================= */
    .fi-fo-select-wrp .fi-select-input-value-ctn,
    .fi-select-input-value-badges-ctn {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        gap: 0.375rem !important;
        align-items: center !important;
    }

    /* =========================================================
       AUTHOR CARD SELECT (Prevent overlapping text)
       ========================================================= */
    .author-select-custom .fi-select-input-value-ctn,
    .author-select-custom .fi-select-input-value-label {
        padding-right: 2.5rem !important; /* Ensure clear button 'x' and chevron do not overlap text */
    }

    /* Target the dropdown option list styling */
    .author-select-custom .fi-dropdown-list-item {
        padding: 0.5rem 1rem !important;
    }

    /* Badge styling to match mockup (white/grey background, thin borders) */
    .fi-select-input-value-badges-ctn .fi-badge {
        background-color: #f3f4f6 !important;
        border: 1.5px solid #e5e7eb !important;
        border-radius: 6px !important;
        padding: 0.25rem 0.625rem !important;
        display: inline-flex !important;
        align-items: center !important;
        color: #4b5563 !important;
        box-shadow: none !important;
        --c-50: 243, 244, 246 !important;
        --c-400: 107, 114, 128 !important;
        --c-500: 75, 85, 99 !important;
        --c-600: 75, 85, 99 !important;
    }

    /* Badge text style */
    .fi-select-input-value-badges-ctn .fi-badge span,
    .fi-select-input-value-badges-ctn .fi-badge label {
        font-weight: 500 !important;
        font-size: 0.8125rem !important;
        color: #4b5563 !important;
    }

    /* Close/Delete button styling */
    .fi-select-input-value-badges-ctn .fi-badge-delete-btn,
    .fi-select-input-value-badges-ctn .fi-badge button {
        color: #9ca3af !important;
        margin-left: 0.375rem !important;
        transition: color 0.15s ease !important;
    }

    .fi-select-input-value-badges-ctn .fi-badge-delete-btn:hover,
    .fi-select-input-value-badges-ctn .fi-badge button:hover {
        color: #374151 !important;
    }

    /* ------------------------------------------------------------- */
    /* RichEditor (Tiptap) Redesign */
    /* ------------------------------------------------------------- */

    .fi-fo-rich-editor {
        border: 1px solid #d1d5db !important;
        border-radius: 8px !important;
        background-color: #ffffff !important;
        overflow: hidden !important;
        box-shadow: none !important;
    }

    .fi-fo-rich-editor:focus-within {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08) !important;
    }

    /* Style Toolbar */
    .fi-fo-rich-editor-toolbar {
        background-color: #ffffff !important;
        border-bottom: 1px solid #e5e7eb !important;
        padding: 0.5rem 0.75rem !important;
        display: flex !important;
        flex-wrap: wrap !important;
        align-items: center !important;
        gap: 0.25rem !important;
    }

    /* Toolbar button groups */
    .fi-fo-rich-editor-toolbar-group {
        border-right: 1px solid #e5e7eb !important;
        padding-right: 0.5rem !important;
        margin-right: 0.5rem !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.125rem !important;
    }

    .fi-fo-rich-editor-toolbar-group:last-child {
        border-right: none !important;
        padding-right: 0 !important;
        margin-right: 0 !important;
    }

    /* Individual tools - Borderless */
    .fi-fo-rich-editor-tool {
        background: transparent !important;
        border: none !important;
        border-radius: 6px !important;
        color: #4b5563 !important;
        padding: 0.375rem !important;
        width: 32px !important;
        height: 32px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.15s ease !important;
        box-shadow: none !important;
    }

    .fi-fo-rich-editor-tool:hover {
        background-color: #f3f4f6 !important;
        color: #111827 !important;
    }

    .fi-fo-rich-editor-tool[aria-pressed="true"],
    .fi-fo-rich-editor-tool.fi-active {
        background-color: #e5e7eb !important;
        color: #111827 !important;
    }

    .fi-fo-rich-editor-content {
        padding: 1.25rem !important;
        min-height: 250px !important;
        background-color: #ffffff !important;
        color: #374151 !important;
        line-height: 1.625 !important;
    }

    /* ------------------------------------------------------------- */
    /* FilePond Cover Image Uploader Redesign */
    /* ------------------------------------------------------------- */

    .filepond--panel-root {
        background-color: #ffffff !important;
        border: 1.5px dashed #d1d5db !important;
        border-radius: 8px !important;
    }

    .filepond--drop-label {
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
        height: auto !important;
        min-height: 140px !important;
    }

    .filepond--drop-label::before {
        content: "";
        display: block;
        width: 44px;
        height: 44px;
        margin-bottom: 0.5rem;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
    }

    /* Customize filepond labels style */
    .filepond--drop-label label {
        font-size: 0.875rem !important;
        color: #4b5563 !important;
    }

    .filepond--label-action {
        color: #2563eb !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        margin-left: 4px;
    }
    
    .filepond--label-action::before {
        content: "";
        display: inline-block;
        width: 14px;
        height: 14px;
        margin-right: 4px;
        vertical-align: middle;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%232563eb'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
    }

    /* ------------------------------------------------------------- */
    /* Custom Author Card Select Redesign */
    /* ------------------------------------------------------------- */

    /* Outer wrapper */
    .fi-input-wrp.author-select-custom {
        background-color: #ffffff !important;
        border: 1px solid #d1d5db !important;
        border-radius: 8px !important;
        padding: 0.75rem 1rem !important;
        box-shadow: none !important;
        height: auto !important;
    }

    /* Focus border override */
    .fi-input-wrp.author-select-custom:focus-within {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08) !important;
    }

    /* Trigger button reset */
    .fi-input-wrp.author-select-custom .fi-select-input-btn {
        padding: 0 !important;
        height: auto !important;
    }

    /* Align clear/dropdown icons */
    .fi-input-wrp.author-select-custom [class*="items-center"] {
        align-items: center !important;
    }

    /* Force Table display behaviors to override Filament's inline text styles */
    .fi-input-wrp.author-select-custom table {
        display: table !important;
        width: 100% !important;
        border-collapse: collapse !important;
    }
    
    .fi-input-wrp.author-select-custom tr {
        display: table-row !important;
    }
    
    .fi-input-wrp.author-select-custom td {
        display: table-cell !important;
        vertical-align: middle !important;
    }
    
    .fi-input-wrp.author-select-custom td:last-child {
        padding-right: 3.5rem !important; /* Push text away from chevron and x */
    }
    
    .fi-input-wrp.author-select-custom td div {
        display: block !important;
        white-space: nowrap !important;
    }
</style>
