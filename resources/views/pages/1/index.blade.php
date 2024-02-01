<?php

use function Laravel\Folio\{name, middleware};

name('contacts.v1.index');

middleware(config('contacts-manager.features.ui.middleware'));

?>

@include('contacts::themes.'.config('contacts-manager.features.ui.theme').'.index')
