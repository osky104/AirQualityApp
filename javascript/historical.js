document.addEventListener('DOMContentLoaded', () => {
    // Inizializza le icone
    lucide.createIcons();

    // Dati finti per le date (Ultimi 7 giorni)
    const labels = ['26 Feb', '27 Feb', '28 Feb', '1 Mar', '2 Mar', '3 Mar', '4 Mar'];

    // 1. Inizializza il Grafico della Temperatura (Linea morbida)
    const ctxTemp = document.getElementById('tempChart').getContext('2d');
    new Chart(ctxTemp, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Average Temperature (°C)',
                data: [18, 19, 16, 20, 18, 20, 21],
                borderColor: '#06b6d4', // Colore azzurro della linea
                backgroundColor: 'rgba(6, 182, 212, 0.1)',
                borderWidth: 3,
                pointBackgroundColor: '#06b6d4',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                fill: true,
                tension: 0.4 // Rende la linea curva morbida invece che a zig-zag
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 30
                }
            }
        }
    });

    // 2. Inizializza il Grafico AQI (Linea dritta)
    const ctxAqi = document.getElementById('aqiChart').getContext('2d');
    new Chart(ctxAqi, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'AQI',
                data: [52, 48, 51, 47, 46, 45, 42],
                borderColor: '#8b5cf6', // Colore viola
                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                borderWidth: 2,
                pointBackgroundColor: '#8b5cf6',
                tension: 0.1 // Linea più spigolosa
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 80
                }
            }
        }
    });

    // 3. Inizializza il Grafico Inquinanti (Barre verticali)
    const ctxPollutants = document.getElementById('pollutantsChart').getContext('2d');
    new Chart(ctxPollutants, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'PM2.5 (µg/m³)',
                    data: [12, 10, 11, 9, 8, 9, 7],
                    backgroundColor: '#3b82f6', // Blu scuro
                    borderRadius: 4
                },
                {
                    label: 'PM10 (µg/m³)',
                    data: [20, 18, 22, 16, 15, 14, 12],
                    backgroundColor: '#06b6d4', // Azzurro chiaro
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Cambia il nome della città quando si cambia il menù a tendina
    const citySelect = document.getElementById('city-select');
    const titleCity = document.getElementById('title-city');

    citySelect.addEventListener('change', (e) => {
        titleCity.textContent = e.target.value;
    });
});

// Funzione globale per cambiare le schede (Tabs)
function switchTab(tabId) {
    // Aggiorna l'estetica dei bottoni
    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    // Nascondi tutte le sezioni
    const sections = document.querySelectorAll('.chart-section');
    sections.forEach(sec => sec.style.display = 'none');

    // Mostra solo la sezione scelta
    if(tabId === 'temp') {
        document.getElementById('temp-section').style.display = 'block';
    } else if(tabId === 'air') {
        document.getElementById('air-section').style.display = 'block';
    }
}