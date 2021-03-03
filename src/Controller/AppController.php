<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Prometheus\CollectorRegistry;
use Prometheus\Storage\InMemory;
use Prometheus\RenderTextFormat;

class AppController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return new Response(
            '<html><body>Awair Prometheus Exporter</body></html>'
        );
    }

    /**
     * @Route("/metrics")
     */
    public function metrics()
    {
        $url = getenv("AWAIR_URL");
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        // print_r($data);exit();

        $registry = new CollectorRegistry(new InMemory());

        foreach ($data as $k=>$v) {
            if (is_numeric($v)) {
                $gauge = $registry->registerGauge('awair', $k, $k, []);
                $gauge->set($v, []);
            }
        }

        $renderer = new RenderTextFormat();
        $result = $renderer->render($registry->getMetricFamilySamples());
        header('Content-type: ' . RenderTextFormat::MIME_TYPE);
        echo $result;
        exit();
    }


}

