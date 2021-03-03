Awair Prometheus Exporter
=========================

Export Awair Local API data to Prometheus.

## Usage:

1. `git clone`
2. `composer install` 
3. create a `.env.local` file and add a line `AWAIR_URL=http://address-of-awair-device/air-data/latest`
4. Run app
5. Add https://address-of-awair-prometheus-exporter/metrics to your prometheus targets
t