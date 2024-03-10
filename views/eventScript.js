document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('eventContainer')) {
        fetchEvents(populateEvents);
    } else if (document.getElementById('mu-latest-course-slide')) {
        fetchEvents(populateLatestEvents);
    }
});

function fetchEvents(populateFunction) {
    fetch('eventOperation.php')
        .then(response => response.json())
        .then(data => {
            populateFunction(data);
            if (populateFunction !== populateLatestEvents) {
                fetchEvents(populateLatestEvents);
            }
        })
        .catch(error => {
            console.error('Error fetching events:', error);
        });
}

function populateEvents(events) {
    const eventContainer = document.getElementById('eventContainer');
    eventContainer.innerHTML = ''; // Clear previous event list

    let currentRow;

    events.forEach((event, index) => {
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
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-view-details" title="View Event Details">View Details</button>
                    </div>
                    <small class="text-muted">${event.eve_date}</small>
                </div>
            </div>
        `;

        currentRow.appendChild(eventItem);

        // Add event listener to the "View Details" button
        const viewDetailsButton = eventItem.querySelector('.btn-view-details');
        viewDetailsButton.addEventListener('click', function () {
            // Redirect to eventDetails.html with event ID as query parameter
            window.location.href = `eventDetails.html?id=${event.id}`;
        });
    });
}
function populateLatestEvents(events) {
    const eventContainer = document.getElementById('mu-latest-course-slide');
    eventContainer.innerHTML = ''; // Clear previous event list

    events.forEach(event => {
        const eventItem = document.createElement('div');
        eventItem.classList.add('col-lg-4', 'col-md-4', 'col-xs-12');
        
        try {
            eventItem.innerHTML = `
                <div class="mu-latest-course-single">
                    <figure class="mu-latest-course-img">
                        <a href="#"><img src="data:image/${event.image_type};base64,${event.image_data}" alt="Event Image"></a>
                        <figcaption class="mu-latest-course-imgcaption">
                            <a href="#">Details</a>
                            <span><i class="fa fa-clock-o"></i>${event.date_evenement}</span>
                        </figcaption>
                    </figure>
                    <div class="mu-latest-course-single-content">
                        <h3><a href="#">${event.titre}</a></h3>
                        <p>${event.description}</p>
                    </div>
                </div>
            `;
        } catch (error) {
            console.error('Error converting binary data to Base64:', error);
            // Handle the error as needed, e.g., display a placeholder image
            eventItem.innerHTML = `<p>Error loading image</p>`;
        }

        eventContainer.appendChild(eventItem);
    });
}