(function () {
    const scriptTag = document.currentScript || document.querySelector('script[src$="/nps-widget.js"]');
    const siteId = scriptTag ? scriptTag.getAttribute('data-site-id') : null;
    const widgetDelay = parseInt(scriptTag ? scriptTag.getAttribute('data-delay') : '5000', 10); // Delay in ms, default 5s
    const localStorageKey = `nps_submitted_${siteId}`;

    if (!siteId) {
        console.error('NPS Widget: data-site-id attribute not found.');
        return;
    }

    // --- Basic Styling --- 
    const styles = `
        .nps-widget-overlay {
            position: fixed; inset: 0; z-index: 50;
            background-color: rgba(0, 0, 0, 0.75);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.3s ease-out;
        }
        .nps-widget-overlay.nps-visible {
            opacity: 1;
        }
        .nps-widget-modal {
            background-color: white; border-radius: 8px; padding: 24px;
            width: 100%; max-width: 450px; margin: auto;
            transform: scale(0.9); transition: transform 0.3s ease-out;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .nps-widget-overlay.nps-visible .nps-widget-modal {
             transform: scale(1);
        }
        .nps-widget-modal h3 { margin-bottom: 16px; font-size: 1.125rem; font-weight: 500; color: #1f2937; }
        .nps-widget-score-container { display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; margin-bottom: 16px; }
        .nps-widget-score-btn {
            display: flex; align-items: center; justify-content: center;
            width: 32px; height: 32px; border-radius: 9999px; border: 1px solid #d1d5db;
            color: #374151; background-color: white; cursor: pointer;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, color 0.15s ease-in-out;
        }
        .nps-widget-score-btn:hover { background-color: #f3f4f6; }
        .nps-widget-score-btn.nps-selected.nps-detractor { background-color: #ef4444; border-color: #dc2626; color: white; }
        .nps-widget-score-btn.nps-selected.nps-passive { background-color: #f59e0b; border-color: #d97706; color: white; }
        .nps-widget-score-btn.nps-selected.nps-promoter { background-color: #22c55e; border-color: #16a34a; color: white; }
        .nps-widget-feedback { width: 100%; margin-top: 16px; margin-bottom: 24px; }
        .nps-widget-feedback label { display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 4px; }
        .nps-widget-feedback textarea {
            display: block; width: 100%; border-radius: 6px; border: 1px solid #d1d5db;
            padding: 8px 12px; font-size: 0.875rem; box-shadow: inset 0 1px 2px 0 rgba(0,0,0,0.05);
            min-height: 80px;
        }
         .nps-widget-feedback textarea:focus { outline: 2px solid transparent; outline-offset: 2px; border-color: #4f46e5; box-shadow: 0 0 0 2px #4f46e5; }
        .nps-widget-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px; }
        .nps-widget-btn {
            padding: 8px 16px; border-radius: 6px; font-size: 0.875rem; font-weight: 500;
            cursor: pointer; transition: background-color 0.15s ease-in-out;
        }
        .nps-widget-btn-cancel { background-color: white; border: 1px solid #d1d5db; color: #374151; }
        .nps-widget-btn-cancel:hover { background-color: #f9fafb; }
        .nps-widget-btn-submit { background-color: #4f46e5; border: 1px solid transparent; color: white; }
        .nps-widget-btn-submit:hover { background-color: #4338ca; }
        .nps-widget-btn-submit:disabled { opacity: 0.7; cursor: not-allowed; }
        .nps-thank-you { text-align: center; padding: 20px; font-size: 1.1rem; color: #1f2937; }
    `;

    // --- Modal HTML Structure --- 
    const modalHtml = `
        <div class="nps-widget-modal" role="dialog" aria-modal="true" aria-labelledby="nps-modal-title">
            <form id="nps-widget-form">
                <h3 id="nps-modal-title">Hoe waarschijnlijk is het dat je ons zou aanbevelen?</h3>
                <div class="nps-widget-score-container" id="nps-score-buttons">
                    <!-- Score buttons 0-10 will be generated here -->
                </div>
                <div class="nps-widget-feedback">
                    <label for="nps-feedback">Optionele feedback:</label>
                    <textarea id="nps-feedback" placeholder="Wat is de belangrijkste reden voor je score?"></textarea>
                </div>
                <div class="nps-widget-actions">
                    <button type="button" class="nps-widget-btn nps-widget-btn-cancel" id="nps-cancel-btn">Annuleren</button>
                    <button type="submit" class="nps-widget-btn nps-widget-btn-submit" id="nps-submit-btn" disabled>Versturen</button>
                </div>
            </form>
        </div>
    `;

    const thankYouHtml = `
        <div class="nps-widget-modal">
             <div class="nps-thank-you">Bedankt voor je feedback!</div>
        </div>
    `;

    let selectedScore = null;
    let overlayElement = null;
    let siteConfig = { allowed_paths: null }; // Store fetched config

    // --- Functions --- 

    function injectStyles() {
        const styleSheet = document.createElement("style");
        styleSheet.type = "text/css";
        styleSheet.innerText = styles;
        document.head.appendChild(styleSheet);
    }

    function createModal() {
        overlayElement = document.createElement('div');
        overlayElement.className = 'nps-widget-overlay';
        overlayElement.innerHTML = modalHtml;
        document.body.appendChild(overlayElement);

        // Generate score buttons
        const scoreContainer = overlayElement.querySelector('#nps-score-buttons');
        for (let i = 0; i <= 10; i++) {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'nps-widget-score-btn';
            button.textContent = i;
            button.dataset.score = i;
            scoreContainer.appendChild(button);
        }

        addEventListeners();
    }

    function showModal() {
        if (!overlayElement) createModal();
        // Delay to allow CSS transition
        requestAnimationFrame(() => {
            overlayElement.classList.add('nps-visible');
        });
    }

    function hideModal() {
        if (!overlayElement) return;
        overlayElement.classList.remove('nps-visible');
        // Remove from DOM after transition
        setTimeout(() => {
            if (overlayElement && document.body.contains(overlayElement)) {
                document.body.removeChild(overlayElement);
            }
            overlayElement = null;
            selectedScore = null; // Reset score
        }, 300); // Match CSS transition duration
    }

    function showThankYou() {
        if (!overlayElement) return;
        overlayElement.innerHTML = thankYouHtml;
        setTimeout(hideModal, 2000); // Show thank you for 2 seconds
    }

    function handleScoreClick(event) {
        if (!event.target.classList.contains('nps-widget-score-btn')) return;

        selectedScore = parseInt(event.target.dataset.score, 10);
        const buttons = overlayElement.querySelectorAll('.nps-widget-score-btn');
        const submitButton = overlayElement.querySelector('#nps-submit-btn');

        buttons.forEach(btn => {
            btn.classList.remove('nps-selected', 'nps-detractor', 'nps-passive', 'nps-promoter');
            if (parseInt(btn.dataset.score, 10) === selectedScore) {
                btn.classList.add('nps-selected');
                if (selectedScore <= 6) btn.classList.add('nps-detractor');
                else if (selectedScore <= 8) btn.classList.add('nps-passive');
                else btn.classList.add('nps-promoter');
            }
        });

        submitButton.disabled = false;
    }

    async function handleFormSubmit(event) {
        event.preventDefault();
        if (selectedScore === null) return;

        const feedbackInput = overlayElement.querySelector('#nps-feedback');
        const feedback = feedbackInput.value.trim();
        const submitButton = overlayElement.querySelector('#nps-submit-btn');
        submitButton.disabled = true;
        submitButton.textContent = 'Versturen...';

        await submitNps(selectedScore, feedback || null);
    }

    async function submitNps(score, feedback = null, tag = null) {
        const apiUrl = '/api/nps';
        const fingerprint = null; // TODO: Add fingerprinting
        const payload = { site_id: siteId, score, feedback, fingerprint, tag };

        try {
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(payload)
            });
            const result = await response.json();
            if (!response.ok) {
                console.error('NPS Submission Error:', result);
                alert('Er is een fout opgetreden.'); // Simple feedback
                hideModal(); // Hide modal even on error
            } else {
                console.log('NPS Submission Success:', result);
                try {
                    localStorage.setItem(localStorageKey, Date.now().toString());
                } catch (e) {
                    console.warn('Could not write to localStorage');
                }
                showThankYou(); // Show thank you and then hide
            }
        } catch (error) {
            console.error('NPS Network Error:', error);
            alert('Kon geen verbinding maken.'); // Simple feedback
            hideModal(); // Hide modal even on error
        }
    }

    function addEventListeners() {
        const form = overlayElement.querySelector('#nps-widget-form');
        const scoreContainer = overlayElement.querySelector('#nps-score-buttons');
        const cancelButton = overlayElement.querySelector('#nps-cancel-btn');

        scoreContainer.addEventListener('click', handleScoreClick);
        form.addEventListener('submit', handleFormSubmit);
        cancelButton.addEventListener('click', hideModal);
        // Close on overlay click
        overlayElement.addEventListener('click', (event) => {
            if (event.target === overlayElement) {
                hideModal();
            }
        });
    }

    async function fetchSiteConfig() {
        const configUrl = `/api/sites/${siteId}/config`;
        try {
            const response = await fetch(configUrl, {
                headers: { 'Accept': 'application/json' },
            });
            if (!response.ok) {
                console.error('NPS Widget: Failed to fetch site config', response.status);
                return false; // Indicate failure
            }
            siteConfig = await response.json();
            return true; // Indicate success
        } catch (error) {
            console.error('NPS Widget: Error fetching site config:', error);
            return false; // Indicate failure
        }
    }

    function normalizePath(path) {
        if (!path) return '/';
        let normalized = path.trim();
        // Remove .html extension
        if (normalized.endsWith('.html')) {
            normalized = normalized.slice(0, -5);
        }
        // Ensure leading slash, remove trailing slash (unless it's just "/")
        if (!normalized.startsWith('/')) {
            normalized = '/' + normalized;
        }
        if (normalized.length > 1 && normalized.endsWith('/')) {
            normalized = normalized.slice(0, -1);
        }
        return normalized;
    }

    function isPathAllowed(currentPath, allowedPaths) {
        if (!allowedPaths || allowedPaths.length === 0) {
            return true; // No restrictions set
        }

        const normalizedCurrentPath = normalizePath(currentPath);

        for (const pattern of allowedPaths) {
            const normalizedPattern = normalizePath(pattern);

            if (normalizedPattern.endsWith('*')) {
                // Wildcard match (/blog/* should match /blog/anything)
                const basePattern = normalizedPattern.slice(0, -1); // Remove the *
                // Ensure the current path starts with the base and has something after the slash (or is the base itself)
                if (normalizedCurrentPath.startsWith(basePattern) &&
                    (normalizedCurrentPath.length === basePattern.length || normalizedCurrentPath.charAt(basePattern.length) === '/')) {
                    return true;
                }
            } else if (normalizedPattern === normalizedCurrentPath) {
                // Exact match
                return true;
            }
        }

        return false; // No match found
    }

    // --- Initialization ---
    async function init() { // Make init async
        // Fetch config first
        const configFetched = await fetchSiteConfig();
        if (!configFetched) {
            // Optionally handle config fetch failure, maybe default to not showing?
            console.warn('NPS Widget: Could not fetch config, widget will not show.');
            return;
        }

        // Check if path is allowed
        if (!isPathAllowed(window.location.pathname, siteConfig.allowed_paths)) {
            console.log('NPS Widget: Path not allowed.', window.location.pathname, siteConfig.allowed_paths);
            return;
        }

        // Check local storage (existing logic)
        try {
            const lastSubmission = localStorage.getItem(localStorageKey);
            if (lastSubmission && (Date.now() - parseInt(lastSubmission, 10)) < 30 * 24 * 60 * 60 * 1000) {
                console.log('NPS Widget: Already submitted recently.');
                return;
            }
        } catch (e) {
            console.warn('Could not read from localStorage');
        }

        // If allowed and not submitted recently, proceed to show
        injectStyles();
        setTimeout(showModal, widgetDelay);
        console.log(`NPS Widget Initialized for site ${siteId}. Path allowed. Modal will show in ${widgetDelay / 1000}s.`);
    }

    // Run init when the DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})(); 