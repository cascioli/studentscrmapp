# Documentazione Completa del Sistema

Questa documentazione copre l'intero sistema, composto da:

- **CRM Backend:** un'applicazione Laravel 12.x/Livewire per gestire gli studenti, i corsi dei vari ITS e la gestione degli amministratori, oltre a fornire API sicure tramite Laravel Sanctum.
- **Database MySQL:** per la gestione di studenti, its e corsi e altre tabelle per la gestione degli utenti amministratori e delle chiavi API con Sanctum.
- **App Flutter:** un'app mobile minimalista, basata su Flutter e Bloc, che permette agli studenti di effettuare il login e visualizzare i corsi loro assegnati.

Il progetto serve a gestire gli studenti e i corsi dei vari ITS, permettendo agli studenti di accedere tramite app per visualizzare i corsi a cui sono assegnati.

## Database MySQL

Il database MySQL è strutturato con diverse tabelle per gestire in maniera efficiente gli studenti, i corsi, i centri ITS e gli utenti amministratori. Le tabelle principali sono:

- **students:** Contiene i dati degli studenti (nome, email, password, its_id, ecc.).
- **courses_by_its:** Memorizza le informazioni sui corsi associati ai vari ITS.
- **its_centers:** Gestisce i centri ITS e le relative informazioni.
- **course_student:** Tabella pivot che gestisce la relazione molti-a-molti tra studenti e corsi.
- **Amministratori e Sanctum:** Tabelle aggiuntive per la gestione degli utenti amministratori e per le chiavi API necessarie per l'autenticazione tramite Laravel Sanctum.

## CRM Backend

Il CRM Backend è sviluppato in Laravel 12.x con Livewire e fornisce un'interfaccia web per la gestione degli studenti, dei corsi e degli ITS. Le principali funzionalità includono:

- **Gestione degli Studenti:** Possibilità di aggiungere, modificare ed eliminare studenti.
- **Assegnazione dei Corsi:** Utilizzo della tabella pivot `course_student` per assegnare e rimuovere corsi agli studenti, garantendo che vengano visualizzati solo i corsi relativi all'ITS di appartenenza.
- **Filtraggio per ITS:** I corsi sono organizzati e filtrati in base al centro ITS, permettendo agli amministratori di vedere a quali its appartengono i corsi.
- **API Sicure:** Implementazione di API RESTful per il login, il logout e il recupero dei corsi assegnati, protette da Laravel Sanctum per garantire una comunicazione sicura con l'app mobile.

## App Flutter

L'app mobile è sviluppata con Flutter e utilizza l'architettura Bloc per gestire lo stato in modo modulare e mantenere il codice pulito e manutenibile. Le principali funzionalità e caratteristiche sono:

- **Login & Logout:** Gli studenti possono autenticarsi tramite API sicure, con il token di autenticazione memorizzato in modo sicuro usando Flutter Secure Storage.
- **Visualizzazione dei Corsi:** Dopo il login, l'app mostra una lista dei corsi assegnati allo studente, aggiornata tramite un meccanismo di polling.
- **Architettura Modulare:** Il codice è organizzato in cartelle distinte per Bloc, models, repositories, services e screens, separando chiaramente la logica di business dalla UI.
- **Design Minimal & Carino:** L'interfaccia utente è pensata per essere semplice, intuitiva e visivamente piacevole, concentrandosi su un design minimalista che facilita l'usabilità.

Questa struttura assicura una gestione efficiente dello stato e una comunicazione sicura con il backend, rendendo l'app facilmente estendibile per future funzionalità.

## Installazione e Configurazione

### Laravel

1. **Installazione delle Dipendenze:**
   - Assicurati di avere PHP, Composer e Laravel 12.x installati.
   - Esegui `composer install` per installare le dipendenze del progetto.
   - Configura il file `.env` con le credenziali del database e le altre variabili di ambiente necessarie.

2. **Migrazioni e Seed:**
   - Esegui le migrazioni per creare le tabelle:  

     ```bash
     php artisan migrate
     ```

   - (Opzionale) Popola il database con dati di test utilizzando i seed:  

     ```bash
     php artisan db:seed
     ```

3. **Configurazione di Laravel Sanctum:**
   - Installa Sanctum con:  

     ```bash
     composer require laravel/sanctum
     ```

   - Pubblica la configurazione e le migration di Sanctum:  

     ```bash
     php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
     ```

   - Esegui nuovamente le migrazioni per creare le tabelle necessarie per l'autenticazione API.

4. **Avvio del Server:**
   - Avvia il server di sviluppo con:  

     ```bash
     php artisan serve
     ```

### App

1. **Installazione delle dipendenze:**
   - Assicurati di avere Flutter installato.
   - Vai nella cartella:  

     ```bash
     flutter_app
     ```

   - Esegui:  

     ```bash
     flutter pub get
     ```

2. **Organizzazione del Progetto:**
   - Configura il valore del baseUrl in `ApiService` per gestire le chiamate HTTP al backend.

3. **Esecuzione dell'App:**
   - Avvia l'app Flutter con:  

     ```bash
     flutter run
     ```

   - Oppure eseguila direttamente dal tuo IDE preferito.

## Utilizzo e Funzionamento

### Laravel

- **Gestione Studenti e Corsi:**  
  Gli amministratori possono:
  - Aggiungere, modificare ed eliminare studenti.
  - Assegnare o rimuovere corsi agli studenti.
  - Visualizzare i corsi in base al centro ITS.

- **API per Studenti:**  
  Gli studenti possono:
  - Effettuare il login tramite l'endpoint API `/login`.
  - Recuperare la lista dei corsi a loro assegnati tramite l'endpoint API `/courses`.
  - Effettuare il logout tramite l'endpoint API `/logout`.

### App

- **Login:**  
  L'utente inserisce email e password nella schermata di login.  
  Se le credenziali sono corrette, il token di autenticazione viene salvato in modo sicuro e l'utente viene reindirizzato alla home.

- **Visualizzazione dei Corsi:**  
  Nella schermata home, l'app invia una richiesta per recuperare la lista dei corsi assegnati.  
  I corsi vengono mostrati in una lista.

- **Logout:**  
  L'utente può effettuare il logout, il che revoca il token di autenticazione e lo reindirizza alla schermata di login.

## Considerazioni Finali e Futuri Sviluppi

Il sistema descritto offre una soluzione completa per la gestione degli studenti e dei corsi associati ai vari centri ITS. Grazie all'integrazione tra il CRM e l'app Flutter, è possibile garantire una gestione centralizzata e sicura dei dati, con un'interfaccia utente semplice e minimal.

### Punti di forza

- **Sicurezza:** Utilizzo di Laravel Sanctum per proteggere le API e di Flutter Secure Storage per la memorizzazione sicura dei token.
- **Modularità:** Architettura a moduli che separa la logica di business dalla presentazione, sia nel backend che nell'app mobile.

### Possibili Miglioramenti Futuri

- **Implementazione di WebSocket:** Passare dal polling a una connessione WebSocket per aggiornamenti in tempo reale.
- **Miglioramenti UI/UX:** Ulteriori ottimizzazioni dell'interfaccia utente per migliorare l'usabilità e l'accessibilità.
- **Funzionalità Aggiuntive:** Estendere il sistema con nuove funzionalità come notifiche push, reportistica avanzata, e dashboard dedicate agli amministratori.

### Licenza

Questo progetto è rilasciato sotto la [MIT License](LICENSE).
