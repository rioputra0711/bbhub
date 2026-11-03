<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Http\Request;

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

function hit($url, $query = ''): array
{
    global $kernel;

    $request = Request::create($url.($query ? '?'.$query : ''), 'GET');
    $response = $kernel->handle($request);
    $html = $response->getContent();

    preg_match_all('#<h3 class="mt-1\.5[^"]*">(.*?)</h3>#s', $html, $titles);
    preg_match('#(\d+) products#', $html, $count);
    preg_match('#Showing ([0-9]+)–([0-9]+) of ([0-9]+) products#', $html, $showing);

    return [
        'status' => $response->getStatusCode(),
        'titles' => array_map('trim', $titles[1]),
        'count' => $count[1] ?? null,
        'showing' => isset($showing[3]) ? $showing[0] : null,
        'pages' => substr_count($html, 'aria-label="Pagination"'),
    ];
}

$cases = [
    'all' => '',
    'search teak' => 'q=teak',
    'search sku' => 'q=BB-MH',
    'species teak+mahogany' => 'species[]=teak&species[]=mahogany',
    'grade export' => 'grade[]=Export+Grade',
    'price 5-10jt' => 'price_min=5000000&price_max=10000000',
    'in stock' => 'in_stock=1',
    'sort price asc' => 'sort=price_asc',
    'sort volume' => 'sort=volume',
    'page 2' => 'page=2',
    'no match' => 'q=zzzz',
];

foreach ($cases as $label => $query) {
    $r = hit('http://localhost/products', $query);
    echo str_pad($label, 24).' status='.$r['status'].' count='.$r['count'].' titles='.count($r['titles']).PHP_EOL;
    if ($r['titles']) {
        echo '   '.implode(' | ', array_slice($r['titles'], 0, 4)).PHP_EOL;
    }
    if ($r['showing']) {
        echo '   '.$r['showing'].PHP_EOL;
    }
}
