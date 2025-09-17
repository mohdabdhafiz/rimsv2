<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shirt Check-in App (with Firebase)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        #checkin-section, #data-source-section {
            transition: opacity 0.5s ease-in-out;
        }
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Participant Shirt Check-in</h1>
            <p class="mt-2 text-md sm:text-lg text-gray-600">A real-time, multi-device check-in system powered by Firebase.</p>
        </header>

        <!-- Firebase Connection Section -->
        <div id="firebase-setup-section" class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-center">Step 1: Connect to Database</h2>
            <div class="space-y-4">
                <div>
                    <label for="firebase-config" class="block text-sm font-medium text-gray-700 mb-1">Firebase Config (JSON)</label>
                    <textarea id="firebase-config" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg font-mono text-xs" placeholder='{ "apiKey": "...", "authDomain": "...", "projectId": "...", ... }'></textarea>
                    <p class="text-xs text-gray-500 mt-1">Get this from your Firebase project settings.</p>
                </div>
                <div>
                    <label for="session-id" class="block text-sm font-medium text-gray-700 mb-1">Session ID</label>
                    <input type="text" id="session-id" placeholder="Create or join a session, e.g., 'spring-event-2024'" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">All devices using the same Session ID will share data.</p>
                </div>
                <button id="connect-firebase-btn" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700">
                    Connect
                </button>
            </div>
             <div id="firebase-status" class="text-center mt-4"></div>
        </div>

        <!-- Data Source Section (Initially Hidden) -->
        <div id="data-source-section" class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md mt-8 hidden">
            <h2 class="text-xl font-semibold mb-4 text-center">Step 2: Load Registration Data</h2>
            <div class="space-y-4">
                <div>
                    <label for="sheet-url" class="block text-sm font-medium text-gray-700 mb-1">Google Sheet CSV URL</label>
                    <input type="url" id="sheet-url" placeholder="https://docs.google.com/spreadsheets/d/e/.../pub?output=csv" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label for="unique-id-column" class="block text-sm font-medium text-gray-700 mb-1">Unique Participant ID Column</label>
                    <input type="text" id="unique-id-column" placeholder="e.g., 'Email' or 'Registration ID'" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <button id="fetch-button" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700">
                    Load Participant Data
                </button>
            </div>
        </div>
        
        <div id="loading-message-area" class="text-center my-6"></div>

        <!-- Check-in Section (Initially Hidden) -->
        <div id="checkin-section" class="max-w-2xl mx-auto mt-8 hidden">
             <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-center">Step 3: Find Participant</h2>
                <div class="space-y-4">
                    <div>
                        <label for="search-term" class="block text-sm font-medium text-gray-700 mb-1">Search by Unique ID</label>
                        <input type="text" id="search-term" placeholder="Enter participant's ID to search..." class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <button id="search-button" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-700">
                        Search
                    </button>
                </div>
            </div>
            <div id="checkin-result" class="mt-6"></div>
        </div>
    </div>

    <script type="module">
        // --- Firebase SDK Imports ---
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, collection, doc, setDoc, onSnapshot } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // --- DOM Elements ---
        const connectFirebaseBtn = document.getElementById('connect-firebase-btn');
        const firebaseConfigInput = document.getElementById('firebase-config');
        const sessionIdInput = document.getElementById('session-id');
        const firebaseStatusDiv = document.getElementById('firebase-status');
        const firebaseSetupSection = document.getElementById('firebase-setup-section');

        const fetchButton = document.getElementById('fetch-button');
        const sheetUrlInput = document.getElementById('sheet-url');
        const uniqueIdColumnInput = document.getElementById('unique-id-column');
        const loadingMessageArea = document.getElementById('loading-message-area');
        const dataSourceSection = document.getElementById('data-source-section');
        const checkinSection = document.getElementById('checkin-section');
        const searchButton = document.getElementById('search-button');
        const searchTermInput = document.getElementById('search-term');
        const checkinResultDiv = document.getElementById('checkin-result');

        // --- App State ---
        let participants = [];
        let collectedIdSet = new Set();
        let uniqueIdColumn = '';
        let db;
        let sessionId;

        // --- Event Listeners ---
        connectFirebaseBtn.addEventListener('click', initializeFirebase);
        fetchButton.addEventListener('click', handleFetchData);
        searchButton.addEventListener('click', handleSearch);
        searchTermInput.addEventListener('keyup', (event) => {
            if (event.key === 'Enter') handleSearch();
        });

        // --- Firebase Initialization ---
        async function initializeFirebase() {
            const configString = firebaseConfigInput.value.trim();
            sessionId = sessionIdInput.value.trim();

            if (!configString || !sessionId) {
                displayFirebaseStatus('Firebase Config and Session ID are required.', 'error');
                return;
            }

            let firebaseConfig;
            try {
                firebaseConfig = JSON.parse(configString);
            } catch (error) {
                displayFirebaseStatus('Firebase Config is not valid JSON.', 'error');
                return;
            }

            displayFirebaseStatus('Connecting...', 'loading');

            try {
                const app = initializeApp(firebaseConfig);
                db = getFirestore(app);
                const auth = getAuth(app);
                await signInAnonymously(auth);

                displayFirebaseStatus('Database connected successfully!', 'success');
                listenForCollectedUpdates();

                // Hide setup and show next step
                firebaseSetupSection.style.opacity = '0';
                setTimeout(() => {
                    firebaseSetupSection.classList.add('hidden');
                    dataSourceSection.classList.remove('hidden');
                    dataSourceSection.style.opacity = '1';
                }, 500);

            } catch (error) {
                console.error("Firebase Initialization Error:", error);
                displayFirebaseStatus(`Error: ${error.message}`, 'error');
            }
        }

        // --- Real-time Firestore Listener ---
        function listenForCollectedUpdates() {
            const checkinsCollectionRef = collection(db, `/artifacts/${sessionId}/public/data/checkins`);
            
            onSnapshot(checkinsCollectionRef, (snapshot) => {
                snapshot.docs.forEach((doc) => {
                    collectedIdSet.add(doc.id);
                });

                if (searchTermInput.value.trim() !== '' && !checkinSection.classList.contains('hidden')) {
                    handleSearch();
                }
            });
        }

        // --- Core Functions ---
        async function handleFetchData() {
            const url = sheetUrlInput.value.trim();
            uniqueIdColumn = uniqueIdColumnInput.value.trim();

            if (!url || !uniqueIdColumn) {
                displayMessage(loadingMessageArea, 'Please provide the Sheet URL and the Unique ID Column name.', 'error');
                return;
            }
            
            displayMessage(loadingMessageArea, 'Fetching participant data...', 'loading');

            try {
                const proxyUrl = `https://api.codetabs.com/v1/proxy?quest=${encodeURIComponent(url)}`;
                const response = await fetch(proxyUrl);
                if (!response.ok) throw new Error(`Network response was not ok. Status: ${response.status}`);
                
                const csvText = await response.text();
                const data = parseCSV(csvText);
                if (data.length === 0) throw new Error('Sheet is empty or could not be parsed.');
                
                const headers = Object.keys(data[0]);
                if (!headers.includes(uniqueIdColumn)) throw new Error(`Column "${uniqueIdColumn}" not found. Available: ${headers.join(', ')}`);
                
                participants = data;
                displayMessage(loadingMessageArea, `Success! ${participants.length} participants loaded.`, 'success');
                
                dataSourceSection.style.opacity = '0';
                setTimeout(() => {
                    dataSourceSection.classList.add('hidden');
                    checkinSection.classList.remove('hidden');
                    checkinSection.style.opacity = '1';
                    searchTermInput.focus();
                }, 500);

            } catch (error) {
                console.error('Fetch Error:', error);
                displayMessage(loadingMessageArea, `Failed to process sheet. Error: ${error.message}`, 'error');
            }
        }

        function handleSearch() {
            const searchTerm = searchTermInput.value.trim();
            if (!searchTerm) {
                displayCheckinResult('Please enter a participant ID to search.', 'warning');
                return;
            }

            const participant = participants.find(p => p[uniqueIdColumn] && p[uniqueIdColumn].toLowerCase() === searchTerm.toLowerCase());

            if (!participant) {
                displayCheckinResult(`Participant with ID "${searchTerm}" not found.`, 'error');
                return;
            }

            const participantId = participant[uniqueIdColumn];
            if (collectedIdSet.has(participantId)) {
                displayCheckinResult(`This participant (${participantId}) has ALREADY collected their shirt.`, 'warning', participant);
            } else {
                displayCheckinResult(`Participant found! They are ELIGIBLE to collect their shirt.`, 'success', participant);
            }
        }

        async function markAsCollected(participantId) {
            try {
                const docRef = doc(db, `/artifacts/${sessionId}/public/data/checkins`, participantId);
                await setDoc(docRef, { collectedAt: new Date() });
            } catch (error) {
                console.error("Error marking as collected:", error);
                displayCheckinResult(`Could not save status. Error: ${error.message}`, 'error');
            }
        }
        
        window.markAsCollected = markAsCollected;

        // --- Utility and Display Functions ---
        function displayCheckinResult(message, type, participant = null) {
            checkinResultDiv.innerHTML = '';
            const colors = {
                success: { bg: 'bg-green-100', text: 'text-green-800', border: 'border-green-400' },
                error: { bg: 'bg-red-100', text: 'text-red-800', border: 'border-red-400' },
                warning: { bg: 'bg-yellow-100', text: 'text-yellow-800', border: 'border-yellow-400' }
            };
            const color = colors[type];

            let html = `<div class="p-4 rounded-lg border ${color.bg} ${color.text} ${color.border}">`;
            html += `<p class="font-semibold">${message}</p>`;

            if (participant) {
                html += '<div class="mt-2 pt-2 border-t border-gray-300 text-sm">';
                Object.entries(participant).forEach(([key, value]) => {
                     html += `<p><strong>${key}:</strong> ${value}</p>`;
                });
                html += '</div>';
            }

            if (type === 'success') {
                html += `<button onclick="markAsCollected('${participant[uniqueIdColumn]}')" class="w-full mt-4 bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700">Mark as Collected</button>`;
            }
            
            html += '</div>';
            checkinResultDiv.innerHTML = html;
        }

        function displayMessage(area, text, type) {
            area.innerHTML = '';
            const message = document.createElement('p');
            message.textContent = text;
            const typeClasses = {
                success: 'text-green-600', error: 'text-red-600', loading: 'text-blue-600'
            };
            message.className = `p-3 rounded-lg inline-block ${typeClasses[type]}`;
            area.appendChild(message);
        }
        
        function displayFirebaseStatus(text, type) {
             const typeClasses = {
                success: 'text-green-600', error: 'text-red-600', loading: 'text-blue-600'
            };
            firebaseStatusDiv.innerHTML = `<span class="${typeClasses[type]}">${text}</span>`;
        }

        function parseCSV(csvText) {
            const lines = csvText.trim().split('\n');
            if (lines.length < 2) return [];
            const headers = lines[0].replace(/\r$/, '').split(',').map(h => h.trim());
            return lines.slice(1).map(line => {
                const values = line.replace(/\r$/, '').split(',').map(v => v.trim());
                const entry = {};
                headers.forEach((header, index) => {
                    entry[header] = values[index];
                });
                return entry;
            }).filter(entry => Object.values(entry).some(v => v));
        }

    </script>
</body>
</html>
