<?php

use Illuminate\Foundation\Console\ClosureCommand;

ClosureCommand::make('inspire', fn () => 'Inspiración para Torre Solento')->purpose('Mostrar un mensaje inspirador');
