<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$user = new App\Models\User([
    'name' => 'Kasir Check',
    'email' => 'kasircheck@example.com',
    'role' => 'kasir',
]);
$user->save();

Auth::login($user);

$uris = ['/dashboard','/pembayaran','/pembayaran/create','/pelanggan','/kategori','/studio','/alat-band','/booking-studio','/rental-alat','/detail-rental','/laporan-rental'];
foreach ($uris as $uri) {
    $request = Illuminate\Http\Request::create($uri, 'GET');
    $response = $kernel->handle($request);
    echo $uri, ' => ', $response->getStatusCode(), PHP_EOL;
    $kernel->terminate($request, $response);
}
