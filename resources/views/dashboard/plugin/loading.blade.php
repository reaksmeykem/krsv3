{{-- 
<script>
    // Show the loading spinner when the page is loading
    document.addEventListener('DOMContentLoaded', function () {
        const spinner = document.getElementById('loading-spinner');
        spinner.style.display = 'flex';
    });

    // Hide the loading spinner once the page is fully loaded
    window.addEventListener('load', function () {
        const spinner = document.getElementById('loading-spinner');
        spinner.style.display = 'none';
    });

    // Example: Hide the loading spinner once the custom JavaScript component is initialized
    // Replace this with the actual initialization code of your component
    document.addEventListener('componentInitialized', function () {
        const spinner = document.getElementById('loading-spinner');
        spinner.style.display = 'none';
    });

    // Example initialization trigger for the custom component
    // This is just for demonstration purposes
    function initializeComponent() {
        const event = new Event('componentInitialized');
        document.dispatchEvent(event);
    }

    // Call the initializeComponent function after some delay or condition
    // This should be replaced with the actual condition that indicates your component is ready
    setTimeout(initializeComponent, 0); // Example delay of 3 seconds
</script> --}}
<script>
    // Show the loading spinner when the page is loading
    document.addEventListener('DOMContentLoaded', function () {
        const spinner = document.getElementById('loading-spinner');
        spinner.style.display = 'flex';
    });

    // Hide the loading spinner once the page is fully loaded
    window.addEventListener('load', function () {
        const spinner = document.getElementById('loading-spinner');
        spinner.style.display = 'none';
    });

    // Example: Hide the loading spinner once the custom JavaScript component is initialized
    // Replace this with the actual initialization code of your component
    document.addEventListener('componentInitialized', function () {
        const spinner = document.getElementById('loading-spinner');
        spinner.style.display = 'none';
    });

    // Example initialization trigger for the custom component
    // This is just for demonstration purposes
    function initializeComponent() {
        const event = new Event('componentInitialized');
        document.dispatchEvent(event);
    }

    // Call the initializeComponent function when your component is ready
    // Replace this with the actual condition or code that indicates your component is ready
    // For example, you could call initializeComponent() after an API call, after a certain element is rendered, etc.
    // Here, replace with your actual initialization logic
    initializeComponent(); // Replace with the actual condition
</script>
