<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        /* Add adjusted height and style the map container */
        #map-container {
            height: 80vh; /* Adjust the height as needed */
            border: 4px solid #ccc;
            border-radius: 10px;
            overflow: hidden; /* Prevents the map from overflowing the container */
        }

        /* Adjust the map height to fill the container */
        #map {
            height: 100%;
        }
    </style>
    <title>User Map</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <div id="map-container">
                    <div id="map"></div>
                </div>
            </div>
            <div class="col-md-3">
                <h4>Worker List</h4>
                <ul id="worker-list" class="list-group">
                    <!-- Worker items will be added here -->
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        const users = [
            { name: "User 1", lat: 40.7128, lon: -74.0060, status: "online" },
            { name: "User 2", lat: 34.0522, lon: -118.2437, status: "busy" },
            { name: "User 3", lat: 51.5074, lon: -0.1278, status: "offline" },
            { name: "User 4", lat: 48.8566, lon: 2.3522, status: "offwork" },
            { name: "User 5", lat: 52.5200, lon: 13.4050, status: "available" },
            // ... Add more users here
        ];

        const map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        users.forEach(user => {
            const marker = L.marker([user.lat, user.lon], {
                icon: user.status === 'online' ? L.icon({ iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41] }) : L.icon({ iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41] })
            });
            const workerList = document.getElementById('worker-list');
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item';
            
            if (user.status === 'online') {
                listItem.classList.add('user-online');
                listItem.innerHTML = `<b>${user.name}</b><br><span class="user-status">${user.status} - Accepting Work</span>`;
            } else {
                listItem.innerHTML = `<b>${user.name}</b><br><span class="user-status">${user.status}</span>`;
                if (user.status === 'busy') {
                    listItem.classList.add('list-group-item-warning');
                } else if (user.status === 'offline') {
                    listItem.classList.add('list-group-item-danger');
                }
            }

            workerList.appendChild(listItem);
            marker.addTo(map);
        });
    </script>
</body>
</html>
