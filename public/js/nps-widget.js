(function () {
    // Find the script tag itself to read the data-site-id
    const scriptTag = document.currentScript || document.querySelector('script[src$="/nps-widget.js"]');
    const siteId = scriptTag ? scriptTag.getAttribute('data-site-id') : null;

    if (!siteId) {
        console.error('NPS Widget: data-site-id attribute not found on script tag.');
        return;
    }

    console.log('NPS Widget Loaded for site:', siteId);

    // --- Placeholder for UI --- 
    // TODO: Implement logic to show the NPS form (modal, inline, etc.)
    // Example: Show after delay, on scroll, etc.
    // const showForm = () => { ... };
    // setTimeout(showForm, 5000); // Show after 5 seconds

    // --- Placeholder for data submission --- 
    async function submitNps(score, feedback = null, tag = null) {
        const apiUrl = '/api/nps'; // Relative path assumes same domain

        // TODO: Add fingerprinting logic here if desired
        const fingerprint = null; // e.g., await getFingerprint();

        const payload = {
            site_id: siteId,
            score: score,
            feedback: feedback,
            fingerprint: fingerprint,
            tag: tag
            // IP address is typically best handled server-side from the request
        };

        try {
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    // Add CSRF token if needed and applicable for API routes (check Laravel docs)
                    // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (!response.ok) {
                console.error('NPS Submission Error:', result);
                alert('Er is een fout opgetreden bij het versturen van de feedback.'); // Simple user feedback
            } else {
                console.log('NPS Submission Success:', result);
                alert('Bedankt voor je feedback!'); // Simple user feedback
                // TODO: Hide the form or show a thank you message in the UI
            }
        } catch (error) {
            console.error('NPS Network Error:', error);
            alert('Kon geen verbinding maken om feedback te versturen.'); // Simple user feedback
        }
    }

    // --- Example Usage (Needs to be triggered by UI interaction) ---
    // Example: Call this when a user clicks the submit button in the form
    // window.submitNpsForm = (score, feedback) => {
    //     submitNps(score, feedback);
    // };

    // Make the submit function globally accessible if needed for inline event handlers
    window.npsWidgetSubmit = submitNps;

    console.log('NPS Widget Initialized. Waiting for UI interaction or trigger.');

})(); 