# Dublinbikes-PHP

This package is a client for using the [JCDecaux self-service bikes API](https://developer.jcdecaux.com) for [Dublinbikes](http://www.dublinbikes.ie/).

## Usage

```
$client = new ConorSmith\Dublinbikes\Dublinbikes("your-api-key");

$allStations = $client->getStations();
$statuses = $client->getCurrentStatuses();

$dameStreet = $client->getStationStatus(10);
```
