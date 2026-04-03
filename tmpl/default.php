<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  system.vigilara_websec
 * @copyright   Copyright (C) 2026 Steven Naschold Computerservice
 * @license     GNU General Public License version 3 or later;
 */

defined('_JEXEC') or die;
?>

<div id="vigilara-dashboard">

    <!-- 🔥 BLOCK 5.1 – TAB LEISTE -->
    <div class="vigilara-tabs">
        <div class="vigilara-tab active" data-tab="dashboard">
            <span class="icon">🛡</span>
            <span class="label">Dashboard</span>
        </div>

        <div class="vigilara-tab" data-tab="events">
            <span class="icon">📜</span>
            <span class="label">Events</span>
        </div>

        <div class="vigilara-tab" data-tab="system">
            <span class="icon">💻</span>
            <span class="label">System</span>
        </div>

        <div class="vigilara-tab" data-tab="permissions">
            <span class="icon">🔐</span>
            <span class="label">Permissions</span>
        </div>

        <div class="vigilara-tab" data-tab="php">
            <span class="icon">⚙</span>
            <span class="label">PHP</span>
        </div>
    </div>

    <!-- 🔥 BLOCK 5.1 – TAB INHALTE -->
    <div class="vigilara-tab-content">

        <!-- DASHBOARD -->
        <div class="vigilara-panel active" id="tab-dashboard">

            <!-- 🔥 BLOCK 5.2 – VIGILARA GAUGE -->
            <div id="vigilara-gauge-container">

                <div class="vigilara-gauge">

                    <!-- Puls-Effekt -->
                    <div class="vigilara-gauge-pulse"></div>

                    <svg class="vigilara-gauge-svg" viewBox="0 0 200 200">
                        <circle class="gauge-bg" cx="100" cy="100" r="85" stroke-width="18" />
                        <circle class="gauge-progress" cx="100" cy="100" r="85"
                            stroke-width="18" stroke-linecap="round"
                            stroke-dasharray="534" stroke-dashoffset="534" />

                        <text id="vigilara-gauge-score" x="100" y="95"
                            text-anchor="middle" class="gauge-score">0</text>

                        <text id="vigilara-gauge-status" x="100" y="125"
                            text-anchor="middle" class="gauge-status">Loading…</text>
                    </svg>

                </div>

            </div>

            <!-- 🔥 BLOCK 5.4 – SUMMARY PANELS -->
            <div id="vigilara-summary"></div>
        </div>

        <!-- EVENTS -->
        <div class="vigilara-panel" id="tab-events">
            <!-- 🔥 BLOCK 5.3 – EVENT LOG -->
            <div id="vigilara-events-log"></div>
        </div>

        <!-- SYSTEM -->
        <div class="vigilara-panel" id="tab-system">
            <!-- 🔥 BLOCK 5.4 – SYSTEM INFO -->
            <div id="vigilara-system-info"></div>
        </div>

        <!-- PERMISSIONS -->
        <div class="vigilara-panel" id="tab-permissions">
            <!-- 🔥 BLOCK 5.4 – PERMISSIONS -->
            <div id="vigilara-permissions"></div>
        </div>

        <!-- PHP -->
        <div class="vigilara-panel" id="tab-php">
            <!-- 🔥 BLOCK 5.4 – PHP CHECKS -->
            <div id="vigilara-php-checks"></div>
        </div>

    </div>

</div>

/* ============================================================
   🔥 BLOCK 5.5 – VIGILARA CSS
   ============================================================ */

/* ------------------------------------------------------------
   GLOBAL CONTAINER
   ------------------------------------------------------------ */
#vigilara-dashboard {
    background: #0B1628;
    padding: 20px;
    border-radius: 10px;
    color: #E8F7FF;
    font-family: "Segoe UI", sans-serif;
}

/* ------------------------------------------------------------
   TABS
   ------------------------------------------------------------ */
.vigilara-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    border-bottom: 2px solid rgba(0,255,200,0.15);
    padding-bottom: 10px;
}

.vigilara-tab {
    padding: 10px 16px;
    background: #10243F;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    gap: 8px;
    align-items: center;
    color: #9BB4C9;
    transition: 0.25s;
}

.vigilara-tab:hover {
    background: #15345A;
    color: #E8F7FF;
}

.vigilara-tab.active {
    background: #00E5D4;
    color: #0B1628;
    font-weight: 600;
    box-shadow: 0 0 12px rgba(0,255,200,0.4);
}

/* ------------------------------------------------------------
   PANELS
   ------------------------------------------------------------ */
.vigilara-panel {
    display: none;
}

.vigilara-panel.active {
    display: block;
}

/* ------------------------------------------------------------
   GAUGE
   ------------------------------------------------------------ */
.vigilara-gauge {
    position: relative;
    width: 100%;
    max-width: 380px;
    min-width: 220px;
    margin: 0 auto 25px auto;
}

.vigilara-gauge-svg {
    width: 100%;
    height: auto;
}

.gauge-bg {
    fill: none;
    stroke: #10243F;
}

.gauge-progress {
    fill: none;
    stroke: #00E5D4;
    filter: drop-shadow(0 0 8px #00FFC8);
    transition: stroke-dashoffset 1.2s ease;
}

.gauge-score {
    font-size: 42px;
    fill: #E8F7FF;
    font-weight: 700;
}

.gauge-status {
    font-size: 18px;
    fill: #00E5D4;
    font-weight: 500;
}

/* Puls-Effekt */
.vigilara-gauge-pulse {
    position: absolute;
    top: 50%; left: 50%;
    width: 200px; height: 200px;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    border: 3px solid rgba(0, 255, 200, 0.3);
    animation: pulse 2.5s infinite ease-out;
}

@keyframes pulse {
    0% { transform: translate(-50%, -50%) scale(1); opacity: 0.7; }
    100% { transform: translate(-50%, -50%) scale(1.4); opacity: 0; }
}

/* ------------------------------------------------------------
   SUMMARY PANELS
   ------------------------------------------------------------ */
#vigilara-summary {
    margin-top: 20px;
    display: grid;
    gap: 12px;
}

.vigilara-summary-box {
    background: #10243F;
    padding: 15px;
    border-radius: 8px;
    box-shadow: inset 0 0 10px rgba(0,255,200,0.1);
}

/* ------------------------------------------------------------
   EVENT LOG
   ------------------------------------------------------------ */
#vigilara-events-log {
    background: #10243F;
    padding: 15px;
    border-radius: 8px;
    max-height: 500px;
    overflow-y: auto;
    box-shadow: inset 0 0 10px rgba(0,255,200,0.1);
}

.vigilara-event-row {
    display: flex;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.vigilara-event-row:last-child {
    border-bottom: none;
}

.event-icon {
    font-size: 22px;
    width: 30px;
    text-align: center;
}

.event-message {
    color: #E8F7FF;
    font-size: 15px;
}

.event-meta {
    font-size: 12px;
    color: #9BB4C9;
    display: flex;
    gap: 15px;
}

/* ------------------------------------------------------------
   SYSTEM / PERMISSIONS / PHP PANELS
   ------------------------------------------------------------ */
.vigilara-info-panel,
.vigilara-perm-row,
.vigilara-php-row {
    background: #10243F;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
}

.vigilara-perm-row.ok,
.vigilara-php-row.ok {
    border-left: 4px solid #00E5D4;
}

.vigilara-perm-row.bad,
.vigilara-php-row.bad {
    border-left: 4px solid #FF3860;
}

/* ------------------------------------------------------------
   SCROLLBAR (Dark Mode)
   ------------------------------------------------------------ */
#vigilara-events-log::-webkit-scrollbar {
    width: 8px;
}

#vigilara-events-log::-webkit-scrollbar-thumb {
    background: #00E5D4;
    border-radius: 4px;
}

#vigilara-events-log::-webkit-scrollbar-track {
    background: #0B1628;
}

/* ============================================================
   🔥 BLOCK 5.6 – VIGILARA JAVASCRIPT
   ============================================================ */

/* ------------------------------------------------------------
   TAB SYSTEM
   ------------------------------------------------------------ */
document.querySelectorAll('.vigilara-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.vigilara-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.vigilara-panel').forEach(p => p.classList.remove('active'));

        tab.classList.add('active');
        document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
    });
});

/* ------------------------------------------------------------
   AJAX ENGINE
   ------------------------------------------------------------ */
async function loadVigilaraData() {
    try {
        const width = document.getElementById('vigilara-dashboard').offsetWidth;

        const response = await fetch(
            'index.php?option=com_ajax&plugin=vigilara_websec&format=json&width=' + width
        );

        const json = await response.json();
        const data = json.data;

        if (!data) return;

        // Update Gauge
        updateGauge(data.score, data.status);

        // Summary
        renderSummary(data);

        // Events
        renderEvents(data.events);

        // System
        renderSystemInfo(data.system);

        // Permissions
        renderPermissions(data.permissions);

        // PHP Checks
        renderPhpChecks(data.php);

        // Polling
        startPolling(data.polling);

    } catch (e) {
        console.error('Vigilara AJAX Error:', e);
    }
}

/* ------------------------------------------------------------
   POLLING ENGINE
   ------------------------------------------------------------ */
let vigilaraPolling = null;

function startPolling(interval) {
    if (vigilaraPolling) clearInterval(vigilaraPolling);

    vigilaraPolling = setInterval(() => {
        loadVigilaraData();
    }, interval);
}

/* ------------------------------------------------------------
   BLOCK 5.2 – GAUGE UPDATE FUNKTION
   ------------------------------------------------------------ */
function updateGauge(score, status) {
    const circle = document.querySelector('.gauge-progress');
    const scoreText = document.getElementById('vigilara-gauge-score');
    const statusText = document.getElementById('vigilara-gauge-status');

    const max = 534;
    const offset = max - (max * score / 100);

    circle.style.strokeDashoffset = offset;
    scoreText.textContent = score;
    statusText.textContent = status;

    if (status === 'Secure') {
        circle.style.stroke = '#00E5D4';
        statusText.style.fill = '#00E5D4';
    } else if (status === 'Warning') {
        circle.style.stroke = '#FFC107';
        statusText.style.fill = '#FFC107';
    } else {
        circle.style.stroke = '#FF3860';
        statusText.style.fill = '#FF3860';
    }
}

/* ------------------------------------------------------------
   BLOCK 5.3 – EVENT LOG RENDERER
   ------------------------------------------------------------ */
function renderEvents(events) {
    const container = document.getElementById('vigilara-events-log');
    container.innerHTML = '';

    events.forEach(ev => {
        const row = document.createElement('div');
        row.classList.add('vigilara-event-row');

        let icon = 'ℹ️';
        let color = '#00A8FF';

        if (ev.type === 'login_fail') {
            icon = '⛔';
            color = '#FF3860';
        } else if (ev.type === 'warning') {
            icon = '⚠️';
            color = '#FFC107';
        }

        row.innerHTML = `
            <div class="event-icon" style="color:${color}">${icon}</div>
            <div class="event-content">
                <div class="event-message">${ev.message}</div>
                <div class="event-meta">
                    <span>${ev.created}</span>
                    ${ev.data?.username ? `<span>User: ${ev.data.username}</span>` : ''}
                    ${ev.data?.ip ? `<span>IP: ${ev.data.ip}</span>` : ''}
                </div>
            </div>
        `;

        container.appendChild(row);
    });

    container.scrollTop = container.scrollHeight;
}

/* ------------------------------------------------------------
   BLOCK 5.4 – SUMMARY PANELS
   ------------------------------------------------------------ */
function renderSummary(data) {
    const el = document.getElementById('vigilara-summary');

    el.innerHTML = `
        <div class="vigilara-summary-box">
            <strong>Status:</strong> ${data.status}
        </div>
        <div class="vigilara-summary-box">
            <strong>Events:</strong> ${data.eventCount}
        </div>
        <div class="vigilara-summary-box">
            <strong>Polling:</strong> ${data.polling / 1000}s
        </div>
    `;
}

/* ------------------------------------------------------------
   BLOCK 5.4 – SYSTEM INFO RENDERER
   ------------------------------------------------------------ */
function renderSystemInfo(data) {
    const el = document.getElementById('vigilara-system-info');
    el.innerHTML = `
        <div class="vigilara-info-panel">
            <div><strong>PHP:</strong> ${data.php_version}</div>
            <div><strong>Joomla:</strong> ${data.joomla_version}</div>
            <div><strong>MySQL:</strong> ${data.mysql_version}</div>
            <div><strong>Memory:</strong> ${data.memory_limit}</div>
            <div><strong>Upload:</strong> ${data.upload_limit}</div>
        </div>
    `;
}

/* ------------------------------------------------------------
   BLOCK 5.4 – PERMISSIONS RENDERER
   ------------------------------------------------------------ */
function renderPermissions(list) {
    const el = document.getElementById('vigilara-permissions');
    el.innerHTML = list.map(item => `
        <div class="vigilara-perm-row ${item.safe ? 'ok' : 'bad'}">
            <span>${item.path}</span>
            <span>${item.safe ? '✔️' : '❌'}</span>
        </div>
    `).join('');
}

/* ------------------------------------------------------------
   BLOCK 5.4 – PHP CHECKS RENDERER
   ------------------------------------------------------------ */
function renderPhpChecks(data) {
    const el = document.getElementById('vigilara-php-checks');
    el.innerHTML = Object.entries(data).map(([key, val]) => `
        <div class="vigilara-php-row ${val ? 'ok' : 'bad'}">
            <span>${key}</span>
            <span>${val ? '✔️' : '❌'}</span>
        </div>
    `).join('');
}

/* ------------------------------------------------------------
   INITIAL LOAD
   ------------------------------------------------------------ */
document.addEventListener('DOMContentLoaded', () => {
    loadVigilaraData();
});
