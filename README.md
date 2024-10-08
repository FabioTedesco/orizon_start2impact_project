# PHP Project - Start2Impact

## Descrizione del Progetto

Questo progetto è stato sviluppato per **gestire e sponsorizzare offerte di viaggi** tramite un set di **API RESTful**. L'applicazione non prevede un'interfaccia frontend; tutte le operazioni vengono effettuate attraverso le API. L'obiettivo è fornire un sistema per gestire **paesi** e **viaggi** con funzionalità CRUD (Create, Read, Update, Delete) e visualizzare offerte filtrate.

## Struttura delle Cartelle

La struttura del progetto è organizzata come segue:

- **controllers**: Contiene i metodi CRUD per le API.
- **core**: Include il file `db.php` per connettersi al database.
- **models**: Contiene le classi `Country` e `Trip`, utilizzate per rappresentare gli oggetti e interagire con il database.
- **vendor**: Contiene i file di Composer e le dipendenze necessarie (ad es. `vlucas/phpdotenv` per la gestione delle variabili di ambiente).

## Configurazione del Database

Il progetto utilizza **MySQL** per gestire le informazioni su paesi e viaggi. Per ricreare la struttura del database, puoi utilizzare il file `migrations.sql`, che include la struttura delle tabelle `country` e `trips`.

### Tabelle Principali

1. **country**: Contiene i paesi con le sole colonne `id` e `country`.
2. **trips**: Contiene i viaggi con le seguenti colonne:
   - `trip_id`: ID del viaggio.
   - `trip_name`: Nome del viaggio.
   - `available_slots`: Numero di posti disponibili.
   - `country_id`: ID del paese associato.
