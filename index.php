<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meteo Trentino - Qualità Aria e Previsioni</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F0F4F8; }
        .card-shadow { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); }
    </style>
</head>
<body class="text-slate-800 pb-12">

    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-10">
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 text-white p-2 rounded-xl">
                <i data-lucide="cloud" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="font-bold text-xl text-slate-900 leading-tight">Meteo Trentino</h1>
                <p class="text-xs text-slate-500">Qualità dell'aria e previsioni</p>
            </div>
        </div>
        
        <nav class="hidden md:flex gap-2 bg-slate-100 p-1 rounded-lg">
            <a href="#" class="flex items-center gap-2 bg-white px-4 py-2 rounded-md shadow-sm text-sm font-medium text-slate-800">
                <i data-lucide="home" class="w-4 h-4"></i> Home
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium text-slate-500 hover:text-slate-800 hover:bg-slate-200/50 transition">
                <i data-lucide="cloud-sun" class="w-4 h-4"></i> Previsioni
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium text-slate-500 hover:text-slate-800 hover:bg-slate-200/50 transition">
                <i data-lucide="wind" class="w-4 h-4"></i> Qualità Aria
            </a>
            <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium text-slate-500 hover:text-slate-800 hover:bg-slate-200/50 transition">
                <i data-lucide="history" class="w-4 h-4"></i> Storico
            </a>
        </nav>
    </header>

    <main class="max-w-6xl mx-auto px-4 mt-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold text-slate-900">Condizioni Attuali</h2>
                <p class="text-sm text-slate-500 mt-1" id="last-update">Ultimo aggiornamento: Caricamento...</p>
            </div>
            <button onclick="location.reload()" class="mt-4 sm:mt-0 flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition shadow-sm font-medium text-sm">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i> Aggiorna
            </button>
        </div>

        <div class="bg-white rounded-2xl p-4 card-shadow mb-6 flex items-center gap-4">
            <div class="bg-blue-600 text-white p-3 rounded-full">
                <i data-lucide="map-pin" class="w-5 h-5"></i>
            </div>
            <div class="flex-1 max-w-xs">
                <label class="block text-xs text-slate-500 font-medium mb-1">Seleziona Località</label>
                <select id="city-select" class="w-full bg-slate-50 border border-gray-200 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none">
                    <option value="Trento">Trento</option>
                    <option value="Rovereto">Rovereto</option>
                    <option value="Riva del Garda">Riva del Garda</option>
                    <option value="Ala">Ala</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 card-shadow relative">
                <div class="absolute top-6 right-6 text-slate-400">
                    <i data-lucide="cloud" class="w-12 h-12" id="weather-icon"></i>
                </div>
                <p class="text-sm text-slate-500">Località</p>
                <h3 class="text-2xl font-bold text-slate-900" id="city-name">Trento</h3>
                
                <div class="mt-8">
                    <div class="flex items-start">
                        <span class="text-7xl font-bold tracking-tight text-slate-900" id="temp-val">18</span>
                        <span class="text-3xl font-medium text-slate-400 mt-2">°C</span>
                    </div>
                    <p class="text-slate-500 mt-2 font-medium" id="weather-desc">Parzialmente nuvoloso</p>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-8 pt-6 border-t border-slate-100">
                    <div>
                        <p class="text-xs text-slate-500 flex items-center gap-1 mb-1"><i data-lucide="droplet" class="w-3 h-3"></i> Umidità</p>
                        <p class="font-bold text-slate-800" id="hum-val">62%</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 flex items-center gap-1 mb-1"><i data-lucide="wind" class="w-3 h-3"></i> Vento</p>
                        <p class="font-bold text-slate-800" id="wind-val">8 km/h</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 flex items-center gap-1 mb-1"><i data-lucide="thermometer" class="w-3 h-3"></i> Percepita</p>
                        <p class="font-bold text-slate-800" id="feels-val">17°C</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 card-shadow flex flex-col">
                <div class="flex justify-between items-start mb-6">
                    <p class="text-sm text-slate-500 flex items-center gap-2 font-medium">
                        <i data-lucide="wind" class="w-4 h-4"></i> Qualità dell'Aria
                    </p>
                    <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full" id="aqi-badge">Buona</span>
                </div>
                
                <div class="mb-6">
                    <span class="text-5xl font-bold text-slate-900" id="aqi-val">45</span>
                    <span class="text-slate-400 font-medium ml-1">AQI</span>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-auto">
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <p class="text-xs text-slate-500 font-medium mb-1">PM2.5</p>
                        <p class="font-bold text-slate-800 text-lg"><span id="pm25-val">9.2</span> <span class="text-[10px] text-slate-400 font-normal">µg/m³</span></p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <p class="text-xs text-slate-500 font-medium mb-1">PM10</p>
                        <p class="font-bold text-slate-800 text-lg"><span id="pm10-val">18.5</span> <span class="text-[10px] text-slate-400 font-normal">µg/m³</span></p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <p class="text-xs text-slate-500 font-medium mb-1">NO₂</p>
                        <p class="font-bold text-slate-800 text-lg"><span id="no2-val">28.3</span> <span class="text-[10px] text-slate-400 font-normal">µg/m³</span></p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                        <p class="text-xs text-slate-500 font-medium mb-1">O₃</p>
                        <p class="font-bold text-slate-800 text-lg"><span id="o3-val">52.8</span> <span class="text-[10px] text-slate-400 font-normal">µg/m³</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-5 card-shadow relative overflow-hidden">
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-2">Temperatura Media Trentino</p>
                <div class="flex items-center justify-between">
                    <p class="text-3xl font-bold text-slate-900">18.2<span class="text-xl text-slate-400 font-normal">°C</span></p>
                    <i data-lucide="trending-up" class="text-green-500 w-5 h-5"></i>
                </div>
                <p class="text-xs text-green-600 mt-2 font-medium">+2.5°C rispetto a ieri</p>
            </div>

            <div class="bg-white rounded-2xl p-5 card-shadow relative overflow-hidden">
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-2">AQI Medio Regionale</p>
                <div class="flex items-center justify-between">
                    <p class="text-3xl font-bold text-slate-900">37<span class="text-xl text-slate-400 font-normal"> AQI</span></p>
                    <i data-lucide="trending-down" class="text-green-500 w-5 h-5"></i>
                </div>
                <p class="text-xs text-green-600 mt-2 font-medium">Qualità dell'aria in netto miglioramento</p>
            </div>

            <div class="bg-white rounded-2xl p-5 card-shadow relative overflow-hidden">
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-2">Località Monitorate</p>
                <div class="flex items-center justify-between">
                    <p class="text-3xl font-bold text-slate-900">8</p>
                    <i data-lucide="map-pin" class="text-blue-500 w-5 h-5"></i>
                </div>
                <p class="text-xs text-slate-500 mt-2 font-medium">Stazioni attive in Trentino</p>
            </div>
        </div>
    </main>

    <script>
        // Inizializza le icone di Lucide
        lucide.createIcons();

        // 1. Funzione per impostare la data odierna
        const updateDateString = () => {
            const now = new Date();
            const options = { day: 'numeric', month: 'long', hour: '2-digit', minute: '2-digit' };
            document.getElementById('last-update').innerText = `Ultimo aggiornamento: ${now.toLocaleDateString('it-IT', options)}`;
        };
        updateDateString();

        // 2. Il Dizionario dei Codici Meteo (quello di cui parlavamo!)
        const weatherMapping = {
            0: { desc: "Sereno", icon: "sun" },
            1: { desc: "Poco nuvoloso", icon: "sun" },
            2: { desc: "Parzialmente nuvoloso", icon: "cloud-sun" },
            3: { desc: "Nuvoloso", icon: "cloud" },
            45: { desc: "Nebbia", icon: "cloud-fog" },
            48: { desc: "Nebbia ghiacciata", icon: "cloud-fog" },
            51: { desc: "Pioviggine", icon: "cloud-drizzle" },
            61: { desc: "Pioggia", icon: "cloud-rain" },
            71: { desc: "Neve", icon: "cloud-snow" },
            95: { desc: "Temporale", icon: "cloud-lightning" }
        };

        // Dati temporanei mock (In futuro qui farai una `fetch('api.php?city=' + cityName)`)
        const mockData = {
            "Trento": { temp: 18, hum: 62, wind: 8, feels: 17, code: 2, aqi: 45, pm25: 9.2, pm10: 18.5, no2: 28.3, o3: 52.8 },
            "Rovereto": { temp: 19, hum: 60, wind: 10, feels: 18, code: 0, aqi: 52, pm25: 11.5, pm10: 22.3, no2: 32.7, o3: 58.2 },
            "Ala": { temp: 20, hum: 58, wind: 6, feels: 19, code: 61, aqi: 38, pm25: 7.8, pm10: 15.2, no2: 24.1, o3: 48.3 }
        };

        // 3. Funzione per aggiornare la Dashboard
        document.getElementById('city-select').addEventListener('change', function(e) {
            const city = e.target.value;
            const data = mockData[city] || mockData["Trento"];

            // Aggiorna Meteo
            document.getElementById('city-name').innerText = city;
            document.getElementById('temp-val').innerText = data.temp;
            document.getElementById('hum-val').innerText = data.hum + '%';
            document.getElementById('wind-val').innerText = data.wind + ' km/h';
            document.getElementById('feels-val').innerText = data.feels + '°C';
            
            // Decodifica il Weather Code e cambia icona!
            const weatherInfo = weatherMapping[data.code] || { desc: "Sconosciuto", icon: "help-circle" };
            document.getElementById('weather-desc').innerText = weatherInfo.desc;
            
            // Trucco per cambiare icona Lucide via JS
            const iconContainer = document.getElementById('weather-icon').parentElement;
            iconContainer.innerHTML = `<i data-lucide="${weatherInfo.icon}" class="w-12 h-12"></i>`;
            lucide.createIcons(); // Re-inizializza la nuova icona

            // Aggiorna Aria
            document.getElementById('aqi-val').innerText = data.aqi;
            document.getElementById('pm25-val').innerText = data.pm25;
            document.getElementById('pm10-val').innerText = data.pm10;
            document.getElementById('no2-val').innerText = data.no2;
            document.getElementById('o3-val').innerText = data.o3;

            // Logica colore AQI
            const badge = document.getElementById('aqi-badge');
            if (data.aqi < 50) {
                badge.className = "bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full";
                badge.innerText = "Buona";
            } else {
                badge.className = "bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full";
                badge.innerText = "Discreta";
            }
        });
    </script>
</body>
</html>