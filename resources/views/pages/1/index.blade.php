<?php

use function Laravel\Folio\name;

name('contacts.v1.index');

?>

@include('contacts::themes.'.config('contacts-manager.features.ui.theme').'.index')
