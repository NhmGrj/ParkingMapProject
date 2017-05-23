ParkingMapProject
=================

## Project details
ParkingMapProject was a technical project asked to be done by https://www.parkingmap.fr/ .

The test was to record a parking traffic. For the purpose of extracting re-usable data.

I had to realise a PHP program in order to display:
    - The total slots number (Assumed available and occupied)
    - The number of entry/exit by hour

## Stack used

I naturally choose Symfony as a framework for his simple installation and set-up.
With Symfony come Doctrine2 for entities relational mapping.
I used Bootstrap(CSS)/Twig(HTML)/jQuery(JS) for the front-end part and HighChart.js for the chart displaying.
Composer is used to manage packages for the Symfony app.
Bower is used to manage dependencies for the front-end.

This project is service-oriented, it means I consider that the controller is here to return a view filled by variables, but nothing else.
And all the logic and data handling is done by external-services to the controller and injected by the symfony3 container.

Installation
===

```sh
$ git clone https://github.com/NhmGrj/ParkingMapProject.git
$ make set-up
```
You should now be able to access the project by browsing "http://localhost:8000"
