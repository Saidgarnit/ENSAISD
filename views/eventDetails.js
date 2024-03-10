document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const eventId = urlParams.get('id');

    if (eventId) {
        fetchArticle(eventId);
    } else {
        // Handle case where no event ID is provided
        console.error('Event ID not provided.');
    }
});

function fetchArticle(eventId) {
    fetch(`eventOperation.php?id=${eventId}`)
        .then(response => response.json())
        .then(articleData => {
            populateArticle(articleData);
        })
        .catch(error => {
            console.error('Error fetching article:', error);
            // Handle error gracefully, e.g., display an error message to the user
        });
}

function populateArticle(articleData) {
    const articleContainer = document.getElementById('articleContainer');
    articleContainer.innerHTML = ''; // Clear previous article content
    articleContainer.innerHTML = `
        <div class="row">
            <div class="container">
                <article>
                    <h1>${articleData.titre}</h1>
                    <div class="container">
                        <article>
                            ${articleData.article}
                        </article>
                    </div>
                    <div class="spacer" style="margin-bottom: 4%"></div>
                </article>
            </div>
            <div class="spacer" style="margin-bottom: 4%"></div>
        </div>
    `;
}
