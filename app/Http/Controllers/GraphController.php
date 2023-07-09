<?php

namespace App\Http\Controllers;



use App\Charts\ChartWomanHighJumpp;

use Illuminate\Http\Request;
use Goutte\Client;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class GraphController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function generateGraph()
    {
        $url = 'https://en.wikipedia.org/wiki/Women%27s_high_jump_world_record_progression';

        $client = new Client();
        $crawler = $client->request('GET', $url);
        $table = $crawler->filter('.wikitable');


        $numericColumns = [];
        $table->filter('td:first-child')->each(function ($item, $i) use (&$numericColumns) {
            $value = $item->text();

            preg_match('/\d+\.\d+/', $value, $matches);
            $numericColumns[$i] = $matches[0];
        });


        $years = range(1922, 1978);

        $chart = new ChartWomanHighJumpp();
        $chart->labels($years);

        $chart->dataset("Women's high jump", "bar", $numericColumns);

        $chartHtml = $chart->container();

        return view('chart', ['chart' => $chart]);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
