<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$s = App\Models\Show::orderBy('created_at','desc')->first();
if (! $s) { echo "<no show>\n"; exit; }
echo "id:" . $s->id . "\n";
echo "title:" . $s->title . "\n";
echo "status:" . $s->status . "\n";
echo "created_at:" . $s->created_at . "\n";
