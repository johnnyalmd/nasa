<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NasaController extends Controller
{
    private $apiKey = '0wAntSmVVl7GRk0fXP86yc3o2SAPaQc6sGLV5DIi';
    private $startDate = '2023-10-29';
    private $endDate = '2023-11-05';

    public function index()
    {
        return view('index');
    }

    public function roverPhotos(Request $request)
    {
        $infoRover = $this->obterInfoRoverCuriosity();
        $solAtual = $this->obterSolMaisRecente();
        $errorMessage = null;
        $infoFotosSol = null;

        if ($request->has('sol')) {
            $sol = $request->query('sol');

            if (!ctype_digit($sol)) {
                $errorMessage = "Use como base para pesquisa a quantidade de sois que o rover está em Marte. Apenas números dentro deste valor vão funcionar.";
            } else {
                $sol = (int) $sol;
                if ($sol > (int) $infoRover['rover']['max_sol']) {
                    $errorMessage = "O valor inserido é maior do que a quantidade máxima de sois disponíveis.";
                }
            }

            if (!$errorMessage) {
                $infoFotosSol = $this->obterFotosRoverSol($sol);
            }
        } else {
            $infoFotosSol = $this->obterFotosRoverSol(2000);
        }

        return view('rover', [
            'error_message' => $errorMessage,
            'info_fotos_sol' => $infoFotosSol,
            'sol_atual' => $solAtual,
            'info_rover' => $infoRover,
        ]);
    }

    public function asteroids()
    {
        $infoAsteroides = $this->asteroidesProximosTerra();
        $asteroidLabels = [];
        $asteroidMissDistances = [];
        $asteroidSizes = [];

        if ($infoAsteroides) {
            foreach ($infoAsteroides['near_earth_objects']['2023-10-30'] as $asteroide) {
                $asteroidLabels[] = $asteroide['name'];
                $asteroidMissDistances[] = (float) $asteroide['close_approach_data'][0]['miss_distance']['kilometers'];
                $asteroidSizes[] = (float) $asteroide['estimated_diameter']['meters']['estimated_diameter_max'];
            }
        }

        return view('asteroids', [
            'asteroid_labels' => json_encode($asteroidLabels),
            'asteroid_miss_distances' => json_encode($asteroidMissDistances),
            'asteroid_sizes_json' => json_encode($asteroidSizes),
        ]);
    }

    public function apod()
    {
        $urlImagemDoDia = $this->obterImagemDoDia();
        return view('apod', [
            'url_imagem_do_dia' => $urlImagemDoDia,
        ]);
    }

    private function obterImagemDoDia()
    {
        $url = "https://api.nasa.gov/planetary/apod";
        $response = Http::get($url, ['api_key' => $this->apiKey]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['url'];
        }

        return null;
    }

    private function asteroidesProximosTerra()
    {
        $url = "https://api.nasa.gov/neo/rest/v1/feed";
        $response = Http::get($url, [
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'api_key' => $this->apiKey
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    private function obterFotosRoverSol($sol)
    {
        $url = "https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos";
        $response = Http::get($url, ['sol' => $sol, 'api_key' => $this->apiKey]);

        if ($response->successful()) {
            $data = $response->json();
            foreach ($data['photos'] as $index => &$photo) {
                $photo['index'] = $index + 1;
            }
            return $data['photos'];
        }

        return null;
    }

    private function obterInfoRoverCuriosity()
    {
        $url = "https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/";
        $response = Http::get($url, ['api_key' => $this->apiKey]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    private function obterSolMaisRecente()
    {
        $infoRover = $this->obterInfoRoverCuriosity();
        return $infoRover ? $infoRover['rover']['max_sol'] : null;
    }

    public function asteroidChartData(Request $request)
    {
        $infoAsteroides = $this->asteroidesProximosTerra();
        $chartData = [];

        if ($infoAsteroides) {
            foreach ($infoAsteroides['near_earth_objects']['2023-10-30'] as $asteroide) {
                $chartData[] = [
                    'name' => $asteroide['name'],
                    'miss_distance' => (float) $asteroide['close_approach_data'][0]['miss_distance']['kilometers'],
                    'asteroid_size' => (float) $asteroide['estimated_diameter']['meters']['estimated_diameter_max']
                ];
            }
        }

        return response()->json($chartData);
    }
}
