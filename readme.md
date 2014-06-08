## Anti Gatunos

AntiGatunos is a Laravel web application created to track and report armed robberies that occur near the [Pólo II - Asprela](https://sigarra.up.pt/up/pt/web_base.gera_pagina?p_pagina=1005841) zone, in Oporto, Portugal.

### Use Cases

When a user detects a suspicious situation or is a victim of a robbery, he can fill in a occurrence in the platform, which will then be listed in the homepage timeline and on the map too.

### Used Composer Packages

* Jeffrey Way's Generators - Used during the development of the application for easy resources creation.
* toin0u's Geocoder - Used to geocode the address to coordinates, which are then used on the Google Map in the homepage.
* Facebook PHP SDK - The Facebook platform was used to handle all the app login system.