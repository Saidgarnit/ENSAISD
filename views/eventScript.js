document.addEventListener('DOMContentLoaded', function() {
    fetchEvents();
});

function fetchEvents() {
    fetch('eventOperation.php')
        .then(response => response.json())
        .then(data => {
            populateEvents(data);
        })
        .catch(error => {
            console.error('Error fetching events:', error);
        });
}

function populateEvents(events) {
    const eventContainer = document.getElementById('eventContainer');
    eventContainer.innerHTML = ''; // Clear previous event list

    let currentRow; // Track the current row

    events.forEach((event, index) => {
        // Create a new row for every 3rd event
        if (index % 3 === 0) {
            currentRow = document.createElement('div');
            currentRow.classList.add('row', 'event-row');
            eventContainer.appendChild(currentRow);
        }

        const eventItem = document.createElement('div');
        eventItem.classList.add('col-md-4', 'event-item');

        eventItem.innerHTML = `
            <div class="thumbnail">
                <img src="dim.png" alt="Event Image" style="width:100%">
                <div class="caption">
                    <h1>${event.titre}</h1>
                    <p>${event.description}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">View Details</button>
                    </div>
                    <small class="text-muted">${event.date_evenement}</small>
                </div>
            </div>
        `;

        currentRow.appendChild(eventItem);
    });
}
