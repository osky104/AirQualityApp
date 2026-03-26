<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meteo Trentino - Weather Forecast</title>
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/forecast.css">
</head>
<body>

    <header class="site-header">
        <div class="header-logo">
            <div class="icon-box">
                <i data-lucide="cloud" style="width: 24px; height: 24px;"></i>
            </div>
            <div class="logo-text">
                <h1>Meteo Trentino</h1>
                <p>Air quality and forecasts</p>
            </div>
        </div>
        
        <nav class="nav-menu">
            <a href="../index.php" class="nav-link"><i data-lucide="home" style="width: 16px; height: 16px;"></i> Home</a>
            <a href="forecast.php" class="nav-link active"><i data-lucide="cloud-sun" style="width: 16px; height: 16px;"></i> Weather Forecast</a>
            <a href="airQuality.php" class="nav-link"><i data-lucide="wind" style="width: 16px; height: 16px;"></i> Air Quality</a>
            <a href="historical.php" class="nav-link"><i data-lucide="history" style="width: 16px; height: 16px;"></i> Forecast History</a>
        </nav>
    </header>

    <main class="container">
        
        <div class="section-title-wrapper mb-6">
            <div class="section-title">
                <h2>Weather Forecast</h2>
                <p>Detailed 7-day forecast for <span id="title-city">Trento</span></p>
            </div>
        </div>

        <div class="card city-selector">
            <div class="icon-box" style="border-radius: 50%; padding: 12px; background-color: #3B82F6;">
                <i data-lucide="map-pin" style="width: 20px; height: 20px;"></i>
            </div>
            <div class="select-wrapper">
                <label>Select Location</label>
                <select id="city-select">
                    <option value="Trento">Trento</option>
                    <option value="Rovereto">Rovereto</option>
                    <option value="Riva del Garda">Riva del Garda</option>
                    <option value="Ala">Ala</option>
                </select>
            </div>
        </div>

        <div class="summary-grid">
            <div class="card">
                <p class="stat-card-title flex-title"><i data-lucide="sun" style="width: 14px; height: 14px;"></i> AVERAGE TEMPERATURE</p>
                <p class="stat-value"><span id="avg-max">18°</span> / <span id="avg-min">8°</span></p>
                <p class="stat-trend" style="color: #64748B;">Weekly Max / Min</p>
            </div>
            <div class="card">
                <p class="stat-card-title flex-title"><i data-lucide="droplets" style="width: 14px; height: 14px;"></i> PRECIPITATION</p>
                <p class="stat-value" id="rain-prob">26%</p>
                <p class="stat-trend" style="color: #64748B;">Average probability</p>
            </div>
            <div class="card">
                <p class="stat-card-title flex-title"><i data-lucide="cloud-sun" style="width: 14px; height: 14px;"></i> SUNNY DAYS</p>
                <p class="stat-value" id="sun-days">3</p>
                <p class="stat-trend" style="color: #64748B;">Out of 7 days</p>
            </div>
            <div class="card">
                <p class="stat-card-title flex-title"><i data-lucide="wind" style="width: 14px; height: 14px;"></i> CONDITIONS</p>
                <p class="stat-value text-medium" id="today-cond">Partly cloudy</p>
                <p class="stat-trend" style="color: #64748B;">Today</p>
            </div>
        </div>

        <div class="card forecast-section">
            <h3 class="forecast-section-title">7-Day Forecast</h3>
            
            <div id="forecast-list">
                </div>
        </div>

    </main>

    <script src="../javascript/forecast.js"></script>
</body>
</html>