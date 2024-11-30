<x-layout>
    <div class="flex flex-col justify-center items-center min-h-screen bg-gray-100 p-4">
        <!-- Back Button -->
        <div class="w-full max-w-4xl mb-4">
            <a href="{{ url()->previous() }}"
                class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                ← Back
            </a>
        </div>

        <!-- PDF Display -->
        <div class="w-full max-w-4xl border-2 border-gray-300 rounded-lg shadow-lg bg-white p-4">
            <iframe src="{{ asset($book->book_url) }}#toolbar=0&navpanes=0&scrollbar=0&oncontextmenu=0" width="100%"
                height="600px" class="rounded-lg" frameborder="0" id="pdf-frame">
                Your browser does not support iframes.
            </iframe>
        </div>
    </div>

    <script>
        // Block right-click on the iframe by disabling context menu
        const iframe = document.getElementById('pdf-frame');

        iframe.onload = function() {
            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            iframeDoc.oncontextmenu = function(e) {
                e.preventDefault(); // Disable right-click
            };
        };

        // Optionally, block other interactions like text selection
        iframe.onload = function() {
            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            iframeDoc.body.style.userSelect = 'none'; // Disable text selection
        };
    </script>
</x-layout>
