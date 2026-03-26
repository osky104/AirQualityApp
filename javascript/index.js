// === index.js ===

// Inizializza le icone della libreria Lucide
lucide.createIcons();

// Funzione per mostrare la data e l'ora correnti
const updateDateString = () => {
    const now = new Date();
    const options = { day: 'numeric', month: 'long', hour: '2-digit', minute: '2-digit' };
    document.getElementById('last-update').innerText = `Ultimo aggiornamento: ${now.toLocaleDateString('it-IT', options)}`;
};
updateDateString();

// Mappatura dei codici meteo ai testi e alle icone
const weatherMapping = {
    0: { desc: "Sereno", icon: "sun" },
    1: { desc: "Poco nuvoloso", icon: "sun" },
    2: { desc: "Parzialmente nuvoloso", icon: "cloud-sun" },
    3: { desc: "Nuvoloso", icon: "cloud" },
    45: { desc: "Nebbia", icon: "cloud-fog" },
    61: { desc: "Pioggia", icon: "cloud-rain" },
    71: { desc: "Neve", icon: "cloud-snow" },
    95: { desc: "Temporale", icon: "cloud-lightning" }
};

// Dati finti per la Home
const mockDataHome = {
    "Trento": { temp: 18, hum: 62, wind: 8, feels: 17, code: 2, aqi: 45, pm25: 9.2, pm10: 18.5, no2: 28.3, o3: 52.8 },
    "Rovereto": { temp: 19, hum: 60, wind: 10, feels: 18, code: 0, aqi: 52, pm25: 11.5, pm10: 22.3, no2: 32.7, o3: 58.2 },
    "Ala": { temp: 20, hum: 58, wind: 6, feels: 19, code: 61, aqi: 38, pm25: 7.8, pm10: 15.2, no2: 24.1, o3: 48.3 }
};

// Funzione principale per aggiornare l'interfaccia della Home
function updateHome(city) {
    const data = mockDataHome[city] || mockDataHome["Trento"];

    // Aggiorna Meteo
    document.getElementById('city-name').innerText = city;
    document.getElementById('temp-val').innerText = data.temp;
    document.getElementById('hum-val').innerText = data.hum + '%';
    document.getElementById('wind-val').innerText = data.wind + ' km/h';
    document.getElementById('feels-val').innerText = data.feels + '°C';
    
    const weatherInfo = weatherMapping[data.code] || { desc: "Sconosciuto", icon: "help-circle" };
    document.getElementById('weather-desc').innerText = weatherInfo.desc;
    
    const iconContainer = document.getElementById('weather-icon-container');
    iconContainer.innerHTML = `<i data-lucide="${weatherInfo.icon}" style="width: 48px; height: 48px;"></i>`;
    
    // Aggiorna Qualità Aria
    document.getElementById('aqi-val').innerText = data.aqi;
    document.getElementById('pm25-val').innerText = data.pm25;
    document.getElementById('pm10-val').innerText = data.pm10;
    document.getElementById('no2-val').innerText = data.no2;
    document.getElementById('o3-val').innerText = data.o3;

    const badge = document.getElementById('aqi-badge');
    if (data.aqi < 50) {
        badge.className = "badge badge-good";
        badge.innerText = "Buona";
    } else {
        badge.className = "badge badge-fair";
        badge.innerText = "Discreta";
    }

    // Re-inizializza le icone
    lucide.createIcons();
}

// Ascolta i cambiamenti nel menu a tendina
document.getElementById('city-select').addEventListener('change', function(e) {
    updateHome(e.target.value);
});

// Avvia la pagina mostrando i dati di Trento di default
updateHome("Trento");