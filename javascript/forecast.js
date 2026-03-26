// === previsioni.js ===

// Inizializza le icone della libreria Lucide
lucide.createIcons();

// Dati finti per le Previsioni a 7 giorni
const mockDataForecast = {
    "Trento": {
        summary: { avgMax: 18, avgMin: 8, rainProb: 26, sunDays: 3, todayCond: "Parzialmente nuvoloso" },
        days: [
            { day: "Oggi", date: "26 Mar", icon: "cloud-sun", desc: "Parzialmente nuvoloso", rain: 20, max: 18, min: 8 },
            { day: "Ven", date: "27 Mar", icon: "sun", desc: "Soleggiato", rain: 5, max: 20, min: 9 },
            { day: "Sab", date: "28 Mar", icon: "cloud", desc: "Nuvoloso", rain: 35, max: 17, min: 7 },
            { day: "Dom", date: "29 Mar", icon: "cloud-rain", desc: "Pioggia", rain: 75, max: 15, min: 6 },
            { day: "Lun", date: "30 Mar", icon: "cloud-lightning", desc: "Temporali", rain: 90, max: 14, min: 5 },
            { day: "Mar", date: "31 Mar", icon: "cloud", desc: "Coperto", rain: 40, max: 16, min: 7 },
            { day: "Mer", date: "1 Apr", icon: "sun", desc: "Sereno", rain: 0, max: 21, min: 10 }
        ]
    },
    "Rovereto": {
        summary: { avgMax: 19, avgMin: 9, rainProb: 15, sunDays: 5, todayCond: "Soleggiato" },
        days: [
            { day: "Oggi", date: "3 Mar", icon: "sun", desc: "Soleggiato", rain: 0, max: 19, min: 9 },
            { day: "Dom", date: "4 Mar", icon: "sun", desc: "Soleggiato", rain: 0, max: 21, min: 10 },
            { day: "Lun", date: "5 Mar", icon: "cloud-sun", desc: "Poco nuvoloso", rain: 10, max: 18, min: 8 },
            { day: "Mar", date: "6 Mar", icon: "cloud", desc: "Nuvoloso", rain: 40, max: 16, min: 7 }
        ]
    }
};

// Funzione principale per aggiornare l'interfaccia delle Previsioni
function updatePrevisioni(city) {
    const data = mockDataForecast[city] || mockDataForecast["Trento"];

    // Aggiorna i 4 box riassuntivi in alto
    document.getElementById('title-city').innerText = city;
    document.getElementById('avg-max').innerText = data.summary.avgMax + '°';
    document.getElementById('avg-min').innerText = data.summary.avgMin + '°';
    document.getElementById('rain-prob').innerText = data.summary.rainProb + '%';
    document.getElementById('sun-days').innerText = data.summary.sunDays;
    document.getElementById('today-cond').innerText = data.summary.todayCond;

    // Genera la lista dei giorni
    const listContainer = document.getElementById('forecast-list');
    listContainer.innerHTML = ''; // Svuota la lista vecchia

    data.days.forEach(day => {
        const rowHTML = `
            <div class="forecast-item">
                <div class="forecast-date">
                    <span class="forecast-day">${day.day}</span>
                    <span class="forecast-date-num">${day.date}</span>
                </div>
                <div class="forecast-desc">
                    <i data-lucide="${day.icon}" style="width: 24px; height: 24px;"></i>
                    <span>${day.desc}</span>
                </div>
                <div class="forecast-rain" title="Probabilità pioggia">
                    <i data-lucide="cloud-drizzle" style="width: 16px; height: 16px;"></i>
                    ${day.rain}%
                </div>
                <div class="forecast-temps">
                    <span class="forecast-max">${day.max}°</span>
                    <span class="forecast-min">${day.min}°</span>
                </div>
            </div>
        `;
        listContainer.innerHTML += rowHTML;
    });

    // Re-inizializza le icone per le nuove righe appena create
    lucide.createIcons();
}

// Ascolta i cambiamenti nel menu a tendina
document.getElementById('city-select').addEventListener('change', function(e) {
    updatePrevisioni(e.target.value);
});

// Avvia la pagina mostrando i dati di Trento di default
updatePrevisioni("Trento");