Developer: lu.jakob@googlemail.com

Installation Instructions:

- install "scheduler" Extension
- disable "Protokollierung aktivieren [basic.enableBELog]" in scheduler Extension settings ( Extensionmanager ) for "Dateien indexieren" Button to work
- create new task of class "Dateiabstraktionsschicht: Speicherindex aktualisieren", Typ "einmalig"
- create new task of class "Dateiabstraktionsschicht: Metadaten in Speicher entpacken (scheduler)", Typ "einmalig"
- set task id for both created tasks in extension settings of "vz_downloads" (Extensionmanager)
- set storage pid for sys folder containing eula data in ts constants
- delete typo3temp/Cache/Code/*
- clear typo3cache

- rootpath for downloadfiles has to be set in page settings of "download root page" ( e.g. Version1.0 ) in tab "Resources" field "Rootpath for download elements ( "/user_upload/content/" )"
- create new pages underneath this root page and fill with plugin "Downloads". Inside plugin set relative path.
- reindex by clicking on "Reindex files" next to "Logout-Button"


Pitfalls/Problems:

- indexer task ignores identical/copied files. In case indexer button does not work it's necessary to click on directorie's in module filelist to index the typical way