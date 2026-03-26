// === aria.js ===

lucide.createIcons();

// Dati finti per i dettagli della singola città
const mockAriaData = {
    "Trento": { aqi: 45, status: "Buona", pm25: 9.2, pm10: 18.5, no2: 28.3, o3: 52.8, trend: "In miglioramento", rec: "Qualità dell'aria eccellente. Ideale per attività all'aperto." },
    "Rovereto": { aqi: 52, status: "Discreta", pm25: 11.5, pm10: 22.3, no2: 32.7, o3: 58.2, trend: "Stabile", rec: "Aria accettabile. Persone sensibili dovrebbero limitare gli sforzi prolungati all'aperto." }
};

// Dati finti per la classifica generale
const mockRanking = [
    { city: "Cavalese", aqi: 25 },
    { city: "Cles", aqi: 28 },
    { city: "Riva del Garda", aqi: 33 },
    { city: "Arco", aqi: 35 },
    { city: "Bolzano", aqi: 38 },
    { city: "Pergine Valsugana", aqi: 42 },
    { city: "Trento", aqi: 45 },
    { city: "Rovereto", aqi: 52 }
];

function updateAria(city) {
    const data = mockAriaData[city] || mockAriaData["Trento"];

    // Aggiorna titolo card
    document.getElementById('title-city').innerText = city;

    // Aggiorna valori card principale
    document.getElementById('aqi-val').innerText = data.aqi;
    document.getElementById('pm25-val').innerText = data.pm25;
    document.getElementById('pm10-val').innerText = data.pm10;
    document.getElementById('no2-val').innerText = data.no2;
    document.getElementById('o3-val').innerText = data.o3;

    // Gestione Badge AQI
    const badge = document.getElementById('aqi-badge');
    badge.innerText = data.status;
    badge.className = data.aqi <= 50 ? "badge badge-good" : "badge badge-fair";

    // Aggiorna Tendenza e Raccomandazioni
    document.getElementById('trend-text').innerText = data.trend;
    document.getElementById('rec-text').innerText = data.rec;

    lucide.createIcons();
}

function renderRanking() {
    const listContainer = document.getElementById('ranking-list');
    listContainer.innerHTML = '';

    mockRanking.forEach((item, index) => {
        const rankNum = index + 1;
        // Assegna colori speciali ai primi 3
        let rankClass = "rank-number";
        if (rankNum === 1) rankClass += " rank-1";
        if (rankNum === 2) rankClass += " rank-2";
        if (rankNum === 3) rankClass += " rank-3";

        const badgeClass = item.aqi <= 50 ? "rank-badge good" : "rank-badge fair";

        const rowHTML = `
            <div class="ranking-item">
                <div class="ranking-left">
                    <div class="${rankClass}">${rankNum}</div>
                    <span class="rank-city">${item.city}</span>
                </div>
                <div class="${badgeClass}">AQI ${item.aqi}</div>
            </div>
        `;
        listContainer.innerHTML += rowHTML;
    });
}

// Event Listeners
document.getElementById('city-select').addEventListener('change', function(e) {
    updateAria(e.target.value);
});

// Inizializzazione
updateAria("Trento");
renderRanking();